<?php

/**
 * ============================================================================
 * مثال 4: نظام إدارة ملفات متكامل
 * Example 4: Complete File Manager System
 * ============================================================================
 *
 * نظام إدارة ملفات يحتوي على:
 * - رفع ملفات متعددة
 * - عرض قائمة الملفات مع معلوماتها
 * - البحث في الملفات
 * - الفرز والتصفية
 * - تحميل الملفات
 * - حذف الملفات
 * - عرض إحصائيات
 *
 * Complete file manager with:
 * - Multiple file upload
 * - File listing with info
 * - Search functionality
 * - Sorting and filtering
 * - File download
 * - File deletion
 * - Statistics display
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManagerController extends Controller
{
    /**
     * عرض الصفحة الرئيسية لإدارة الملفات
     * Display main file manager page
     */
    public function index(Request $request)
    {
        // جلب المعاملات من URL
        // Get parameters from URL
        $search = $request->input('search');
        $sortBy = $request->input('sort', 'date'); // date, name, size
        $filterType = $request->input('type', 'all'); // all, image, document, video

        // جلب جميع الملفات
        // Get all files
        $files = $this->getFileList($search, $sortBy, $filterType);

        // حساب الإحصائيات
        // Calculate statistics
        $stats = $this->getStatistics();

        return view('file-manager.index', compact('files', 'stats'));
    }

    /**
     * رفع ملف أو ملفات
     * Upload file(s)
     */
    public function upload(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'file|max:10240', // 10MB max
        ], [
            'files.required' => 'يرجى اختيار ملف واحد على الأقل',
            'files.*.max' => 'حجم أحد الملفات يتجاوز 10 ميجا',
        ]);

        $uploadedCount = 0;
        $failedFiles = [];

        foreach ($request->file('files') as $file) {
            try {
                // توليد اسم فريد
                // Generate unique name
                $filename = $this->generateUniqueFilename($file);

                // حفظ الملف
                // Store file
                $file->storeAs('files', $filename, 'public');

                // حفظ metadata في JSON (أو يمكن استخدام قاعدة بيانات)
                // Save metadata in JSON (or can use database)
                $this->saveFileMetadata($filename, $file);

                $uploadedCount++;
            } catch (\Exception $e) {
                $failedFiles[] = $file->getClientOriginalName();
            }
        }

        $message = "تم رفع {$uploadedCount} ملف بنجاح";
        if (!empty($failedFiles)) {
            $message .= ". فشل رفع: " . implode(', ', $failedFiles);
        }

        return back()->with('success', $message);
    }

    /**
     * تحميل ملف
     * Download file
     */
    public function download($filename)
    {
        $filePath = 'files/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'الملف غير موجود');
        }

        // الحصول على الاسم الأصلي من metadata
        // Get original name from metadata
        $metadata = $this->getFileMetadata($filename);
        $originalName = $metadata['original_name'] ?? $filename;

        return Storage::disk('public')->download($filePath, $originalName);
    }

    /**
     * حذف ملف
     * Delete file
     */
    public function delete($filename)
    {
        $filePath = 'files/' . $filename;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);

            // حذف metadata
            // Delete metadata
            $this->deleteFileMetadata($filename);

            return back()->with('success', 'تم حذف الملف بنجاح');
        }

        return back()->with('error', 'الملف غير موجود');
    }

    /**
     * حذف ملفات متعددة
     * Delete multiple files
     */
    public function deleteMultiple(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'string',
        ]);

        $deletedCount = 0;

        foreach ($request->files as $filename) {
            $filePath = 'files/' . $filename;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                $this->deleteFileMetadata($filename);
                $deletedCount++;
            }
        }

        return back()->with('success', "تم حذف {$deletedCount} ملف");
    }

    /**
     * البحث في الملفات
     * Search files
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $files = $this->getFileList($query);

        return response()->json([
            'files' => $files,
            'count' => count($files),
        ]);
    }

    /**
     * عرض معلومات ملف
     * Show file details
     */
    public function show($filename)
    {
        $filePath = 'files/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404);
        }

        $fileInfo = $this->getDetailedFileInfo($filename);

        return view('file-manager.show', compact('fileInfo'));
    }

    /**
     * ============================================================================
     * Private Helper Methods
     * ============================================================================
     */

    /**
     * جلب قائمة الملفات مع الفلترة والفرز
     * Get file list with filtering and sorting
     */
    private function getFileList($search = null, $sortBy = 'date', $filterType = 'all')
    {
        $files = Storage::disk('public')->files('files');
        $fileList = [];

        foreach ($files as $file) {
            $filename = basename($file);
            $metadata = $this->getFileMetadata($filename);

            // الفلترة بالبحث
            // Filter by search
            if ($search && stripos($metadata['original_name'], $search) === false) {
                continue;
            }

            // الفلترة بالنوع
            // Filter by type
            if ($filterType !== 'all' && $metadata['type'] !== $filterType) {
                continue;
            }

            $fileList[] = $metadata;
        }

        // الفرز
        // Sorting
        usort($fileList, function ($a, $b) use ($sortBy) {
            switch ($sortBy) {
                case 'name':
                    return strcmp($a['original_name'], $b['original_name']);
                case 'size':
                    return $b['size'] - $a['size'];
                case 'date':
                default:
                    return $b['uploaded_at'] - $a['uploaded_at'];
            }
        });

        return $fileList;
    }

    /**
     * حساب إحصائيات التخزين
     * Calculate storage statistics
     */
    private function getStatistics()
    {
        $files = Storage::disk('public')->files('files');

        $totalSize = 0;
        $typeCount = [
            'image' => 0,
            'document' => 0,
            'video' => 0,
            'other' => 0,
        ];

        foreach ($files as $file) {
            $totalSize += Storage::disk('public')->size($file);

            $metadata = $this->getFileMetadata(basename($file));
            $type = $metadata['type'] ?? 'other';
            $typeCount[$type]++;
        }

        return [
            'total_files' => count($files),
            'total_size' => $totalSize,
            'total_size_mb' => round($totalSize / 1024 / 1024, 2),
            'type_count' => $typeCount,
        ];
    }

    /**
     * توليد اسم ملف فريد
     * Generate unique filename
     */
    private function generateUniqueFilename($file)
    {
        $extension = $file->extension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($originalName);

        // التأكد من عدم وجود ملف بنفس الاسم
        // Ensure no duplicate filename
        $filename = time() . '_' . $safeName . '.' . $extension;
        $counter = 1;

        while (Storage::disk('public')->exists('files/' . $filename)) {
            $filename = time() . '_' . $safeName . '_' . $counter . '.' . $extension;
            $counter++;
        }

        return $filename;
    }

    /**
     * حفظ metadata للملف
     * Save file metadata
     */
    private function saveFileMetadata($filename, $file)
    {
        $metadata = [
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'extension' => $file->extension(),
            'mime_type' => $file->getMimeType(),
            'type' => $this->getFileType($file->getMimeType()),
            'uploaded_at' => time(),
        ];

        // حفظ في ملف JSON
        // Save in JSON file
        $metadataPath = 'files/metadata/' . $filename . '.json';
        Storage::disk('public')->put($metadataPath, json_encode($metadata));

        return $metadata;
    }

    /**
     * جلب metadata للملف
     * Get file metadata
     */
    private function getFileMetadata($filename)
    {
        $metadataPath = 'files/metadata/' . $filename . '.json';

        if (Storage::disk('public')->exists($metadataPath)) {
            $json = Storage::disk('public')->get($metadataPath);
            return json_decode($json, true);
        }

        // إذا لم يكن هناك metadata، أنشئ واحد من المعلومات المتاحة
        // If no metadata, create from available info
        $filePath = 'files/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            return null;
        }

        return [
            'filename' => $filename,
            'original_name' => $filename,
            'size' => Storage::disk('public')->size($filePath),
            'extension' => pathinfo($filename, PATHINFO_EXTENSION),
            'mime_type' => Storage::disk('public')->mimeType($filePath),
            'type' => 'other',
            'uploaded_at' => Storage::disk('public')->lastModified($filePath),
        ];
    }

    /**
     * حذف metadata للملف
     * Delete file metadata
     */
    private function deleteFileMetadata($filename)
    {
        $metadataPath = 'files/metadata/' . $filename . '.json';

        if (Storage::disk('public')->exists($metadataPath)) {
            Storage::disk('public')->delete($metadataPath);
        }
    }

    /**
     * الحصول على معلومات تفصيلية للملف
     * Get detailed file information
     */
    private function getDetailedFileInfo($filename)
    {
        $filePath = 'files/' . $filename;
        $metadata = $this->getFileMetadata($filename);

        return array_merge($metadata, [
            'url' => Storage::disk('public')->url($filePath),
            'path' => $filePath,
            'size_formatted' => $this->formatFileSize($metadata['size']),
            'uploaded_date' => date('Y-m-d H:i:s', $metadata['uploaded_at']),
        ]);
    }

    /**
     * تحديد نوع الملف من MIME type
     * Determine file type from MIME type
     */
    private function getFileType($mimeType)
    {
        if (Str::startsWith($mimeType, 'image/')) {
            return 'image';
        } elseif (Str::startsWith($mimeType, 'video/')) {
            return 'video';
        } elseif (in_array($mimeType, [
            'application/pdf',
            'application/msword',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])) {
            return 'document';
        }

        return 'other';
    }

    /**
     * تنسيق حجم الملف
     * Format file size
     */
    private function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($bytes >= 1024 && $i < 3) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}

/**
 * ============================================================================
 * Routes
 * ============================================================================
 */

/*
use App\Http\Controllers\FileManagerController;

Route::prefix('file-manager')->group(function () {
    Route::get('/', [FileManagerController::class, 'index'])->name('filemanager.index');
    Route::post('/upload', [FileManagerController::class, 'upload'])->name('filemanager.upload');
    Route::get('/download/{filename}', [FileManagerController::class, 'download'])->name('filemanager.download');
    Route::delete('/delete/{filename}', [FileManagerController::class, 'delete'])->name('filemanager.delete');
    Route::post('/delete-multiple', [FileManagerController::class, 'deleteMultiple'])->name('filemanager.delete.multiple');
    Route::get('/search', [FileManagerController::class, 'search'])->name('filemanager.search');
    Route::get('/show/{filename}', [FileManagerController::class, 'show'])->name('filemanager.show');
});
*/

/**
 * ============================================================================
 * ملاحظات وتحسينات مستقبلية
 * Notes and Future Improvements
 * ============================================================================
 *
 * 1. استخدام قاعدة بيانات بدلاً من JSON:
 *    - إنشاء جدول files مع model
 *    - حفظ metadata في قاعدة البيانات
 *    - استخدام Eloquent للاستعلامات
 *
 * 2. إضافة مصادقة:
 *    - تسجيل دخول المستخدمين
 *    - كل مستخدم يرى ملفاته فقط
 *    - صلاحيات مختلفة (admin, user)
 *
 * 3. تحسين الأداء:
 *    - Pagination للملفات
 *    - Cache للإحصائيات
 *    - Queue لمعالجة الملفات الكبيرة
 *
 * 4. ميزات إضافية:
 *    - معاينة الملفات
 *    - مشاركة الملفات
 *    - مجلدات وتصنيفات
 *    - نسخ احتياطي تلقائي
 *    - ضغط الملفات
 *
 * 5. الأمان:
 *    - فحص الفيروسات
 *    - Rate limiting
 *    - تشفير الملفات الحساسة
 *    - Audit log
 */
