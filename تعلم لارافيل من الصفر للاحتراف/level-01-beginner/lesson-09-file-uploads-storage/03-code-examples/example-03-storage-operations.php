<?php

/**
 * ============================================================================
 * مثال 3: عمليات Storage Facade
 * Example 3: Storage Facade Operations
 * ============================================================================
 *
 * هذا المثال يوضح جميع عمليات Storage الأساسية:
 * - إنشاء وحفظ ملفات
 * - قراءة محتوى ملفات
 * - نسخ ونقل ملفات
 * - حذف ملفات ومجلدات
 * - الحصول على معلومات الملفات
 *
 * This example demonstrates all basic Storage operations:
 * - Creating and saving files
 * - Reading file contents
 * - Copying and moving files
 * - Deleting files and directories
 * - Getting file information
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageOperationsController extends Controller
{
    /**
     * ============================================================================
     * 1. حفظ الملفات (Storing Files)
     * ============================================================================
     */

    /**
     * حفظ محتوى نصي في ملف
     * Store text content in a file
     */
    public function storeTextFile()
    {
        // الطريقة 1: استخدام put
        // Method 1: Using put
        Storage::put('file.txt', 'محتوى الملف');

        // الطريقة 2: تحديد disk
        // Method 2: Specifying disk
        Storage::disk('public')->put('public-file.txt', 'محتوى عام');

        // الطريقة 3: حفظ في مجلد فرعي
        // Method 3: Store in subdirectory
        Storage::put('documents/report.txt', 'تقرير مهم');

        // الطريقة 4: حفظ مع visibility
        // Method 4: Store with visibility
        Storage::put('private.txt', 'محتوى خاص', 'private');

        return "تم حفظ الملفات بنجاح!";
    }

    /**
     * حفظ ملف مرفوع
     * Store uploaded file
     */
    public function storeUploadedFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // 1. حفظ مع اسم عشوائي
            $path1 = $file->store('uploads');

            // 2. حفظ مع اسم محدد
            $path2 = $file->storeAs('uploads', 'myfile.pdf');

            // 3. حفظ على disk محدد
            $path3 = $file->store('uploads', 'public');

            // 4. حفظ مع اسم محدد على disk محدد
            $path4 = $file->storeAs('uploads', 'document.pdf', 'public');

            return compact('path1', 'path2', 'path3', 'path4');
        }

        return "لا يوجد ملف مرفوع";
    }

    /**
     * ============================================================================
     * 2. قراءة الملفات (Reading Files)
     * ============================================================================
     */

    /**
     * قراءة محتوى ملف
     * Read file contents
     */
    public function readFile()
    {
        // قراءة ملف كامل
        // Read entire file
        $contents = Storage::get('file.txt');

        // قراءة من disk محدد
        // Read from specific disk
        $publicContents = Storage::disk('public')->get('public-file.txt');

        // التحقق من وجود الملف أولاً
        // Check if file exists first
        if (Storage::exists('file.txt')) {
            $contents = Storage::get('file.txt');
        }

        return $contents;
    }

    /**
     * ============================================================================
     * 3. التحقق من الملفات (Checking Files)
     * ============================================================================
     */

    /**
     * التحقق من وجود ملف
     * Check if file exists
     */
    public function checkFile()
    {
        // التحقق من وجود ملف
        // Check if file exists
        $exists = Storage::exists('file.txt');

        // التحقق من وجود ملف على disk محدد
        // Check on specific disk
        $publicExists = Storage::disk('public')->exists('public-file.txt');

        // التحقق من عدم وجود ملف
        // Check if file doesn't exist
        $missing = Storage::missing('nonexistent.txt');

        return [
            'file_exists' => $exists,
            'public_file_exists' => $publicExists,
            'is_missing' => $missing,
        ];
    }

    /**
     * ============================================================================
     * 4. معلومات الملفات (File Information)
     * ============================================================================
     */

    /**
     * الحصول على معلومات الملف
     * Get file information
     */
    public function getFileInfo($filename)
    {
        if (!Storage::exists($filename)) {
            return "الملف غير موجود";
        }

        // الحصول على حجم الملف (بالبايت)
        // Get file size (in bytes)
        $size = Storage::size($filename);

        // الحصول على آخر تعديل (timestamp)
        // Get last modified time (timestamp)
        $lastModified = Storage::lastModified($filename);

        // تحويل إلى تاريخ قابل للقراءة
        // Convert to readable date
        $date = date('Y-m-d H:i:s', $lastModified);

        // الحصول على MIME type
        // Get MIME type
        $mimeType = Storage::mimeType($filename);

        // الحصول على URL (للـ public disk فقط)
        // Get URL (for public disk only)
        $url = Storage::disk('public')->url($filename);

        // الحصول على المسار الكامل
        // Get full path
        $path = Storage::path($filename);

        return [
            'filename' => $filename,
            'size_bytes' => $size,
            'size_kb' => round($size / 1024, 2),
            'size_mb' => round($size / 1024 / 1024, 2),
            'last_modified' => $date,
            'mime_type' => $mimeType,
            'url' => $url,
            'path' => $path,
        ];
    }

    /**
     * ============================================================================
     * 5. نسخ ونقل الملفات (Copy & Move)
     * ============================================================================
     */

    /**
     * نسخ ملف
     * Copy file
     */
    public function copyFile()
    {
        // نسخ ملف
        // Copy file
        Storage::copy('old.txt', 'new.txt');

        // نسخ إلى مجلد آخر
        // Copy to another directory
        Storage::copy('file.txt', 'backup/file.txt');

        // نسخ بين disks مختلفة
        // Copy between different disks
        Storage::disk('local')->copy('file.txt', 'copied.txt');
        Storage::disk('public')->put(
            'copied.txt',
            Storage::disk('local')->get('file.txt')
        );

        return "تم نسخ الملف بنجاح";
    }

    /**
     * نقل ملف
     * Move file
     */
    public function moveFile()
    {
        // نقل ملف (يحذف الأصل)
        // Move file (deletes original)
        Storage::move('old-location.txt', 'new-location.txt');

        // نقل إلى مجلد آخر
        // Move to another directory
        Storage::move('file.txt', 'archive/file.txt');

        return "تم نقل الملف بنجاح";
    }

    /**
     * ============================================================================
     * 6. حذف الملفات (Deleting Files)
     * ============================================================================
     */

    /**
     * حذف ملف واحد
     * Delete single file
     */
    public function deleteFile($filename)
    {
        // التحقق من وجود الملف
        // Check if file exists
        if (Storage::exists($filename)) {
            // حذف الملف
            // Delete the file
            Storage::delete($filename);
            return "تم حذف الملف: {$filename}";
        }

        return "الملف غير موجود: {$filename}";
    }

    /**
     * حذف ملفات متعددة
     * Delete multiple files
     */
    public function deleteMultipleFiles()
    {
        // حذف ملفات متعددة
        // Delete multiple files
        Storage::delete([
            'file1.txt',
            'file2.txt',
            'file3.txt'
        ]);

        return "تم حذف الملفات";
    }

    /**
     * ============================================================================
     * 7. إدارة المجلدات (Directory Management)
     * ============================================================================
     */

    /**
     * عمليات المجلدات
     * Directory operations
     */
    public function directoryOperations()
    {
        // 1. الحصول على جميع الملفات في مجلد
        // Get all files in a directory
        $files = Storage::files('documents');

        // 2. الحصول على جميع الملفات (بما في ذلك المجلدات الفرعية)
        // Get all files (including subdirectories)
        $allFiles = Storage::allFiles('documents');

        // 3. الحصول على المجلدات فقط
        // Get directories only
        $directories = Storage::directories('uploads');

        // 4. الحصول على جميع المجلدات (بما في ذلك الفرعية)
        // Get all directories (including subdirectories)
        $allDirectories = Storage::allDirectories('uploads');

        // 5. إنشاء مجلد
        // Create directory
        Storage::makeDirectory('new-folder');

        // 6. حذف مجلد
        // Delete directory
        Storage::deleteDirectory('old-folder');

        return [
            'files' => $files,
            'all_files' => $allFiles,
            'directories' => $directories,
            'all_directories' => $allDirectories,
        ];
    }

    /**
     * ============================================================================
     * 8. Visibility (Public/Private)
     * ============================================================================
     */

    /**
     * إدارة visibility
     * Manage visibility
     */
    public function manageVisibility()
    {
        // الحصول على visibility الحالي
        // Get current visibility
        $visibility = Storage::getVisibility('file.txt');

        // تعيين كـ public
        // Set as public
        Storage::setVisibility('file.txt', 'public');

        // تعيين كـ private
        // Set as private
        Storage::setVisibility('file.txt', 'private');

        return "تم تحديث visibility";
    }

    /**
     * ============================================================================
     * 9. تحميل الملفات (Download)
     * ============================================================================
     */

    /**
     * تحميل ملف
     * Download file
     */
    public function downloadFile($filename)
    {
        if (!Storage::exists($filename)) {
            abort(404, 'الملف غير موجود');
        }

        // تحميل الملف
        // Download file
        return Storage::download($filename);

        // تحميل مع اسم مخصص
        // Download with custom name
        // return Storage::download($filename, 'custom-name.pdf');

        // تحميل مع headers
        // Download with headers
        // return Storage::download($filename, 'file.pdf', [
        //     'Content-Type' => 'application/pdf',
        // ]);
    }

    /**
     * ============================================================================
     * 10. Streaming (للملفات الكبيرة)
     * ============================================================================
     */

    /**
     * stream ملف كبير
     * Stream large file
     */
    public function streamFile($filename)
    {
        if (!Storage::exists($filename)) {
            abort(404);
        }

        // إرجاع stream response
        // Return stream response
        return Storage::response($filename);

        // أو استخدام download مع streaming
        // Or use download with streaming
        // return response()->streamDownload(function () use ($filename) {
        //     echo Storage::get($filename);
        // }, $filename);
    }

    /**
     * ============================================================================
     * 11. أمثلة عملية متقدمة
     * Advanced Practical Examples
     * ============================================================================
     */

    /**
     * نسخ احتياطي لجميع الملفات
     * Backup all files
     */
    public function backupAllFiles()
    {
        $files = Storage::allFiles('uploads');
        $backupDir = 'backup-' . date('Y-m-d-H-i-s');

        foreach ($files as $file) {
            $newPath = str_replace('uploads/', "{$backupDir}/", $file);
            Storage::copy($file, $newPath);
        }

        return "تم إنشاء نسخة احتياطية في: {$backupDir}";
    }

    /**
     * تنظيف الملفات القديمة
     * Clean old files
     */
    public function cleanOldFiles($days = 30)
    {
        $files = Storage::allFiles('temp');
        $deleted = 0;

        foreach ($files as $file) {
            $lastModified = Storage::lastModified($file);
            $age = (time() - $lastModified) / 86400; // عدد الأيام

            if ($age > $days) {
                Storage::delete($file);
                $deleted++;
            }
        }

        return "تم حذف {$deleted} ملف قديم";
    }

    /**
     * الحصول على إحصائيات التخزين
     * Get storage statistics
     */
    public function getStorageStats()
    {
        $files = Storage::allFiles();
        $totalSize = 0;
        $fileCount = count($files);

        foreach ($files as $file) {
            $totalSize += Storage::size($file);
        }

        return [
            'total_files' => $fileCount,
            'total_size_bytes' => $totalSize,
            'total_size_mb' => round($totalSize / 1024 / 1024, 2),
            'average_file_size_kb' => $fileCount > 0 ? round(($totalSize / $fileCount) / 1024, 2) : 0,
        ];
    }
}

/**
 * ============================================================================
 * Routes لهذا المثال
 * Routes for this example
 * ============================================================================
 */

/*
use App\Http\Controllers\StorageOperationsController;

// حفظ
Route::post('/storage/store-text', [StorageOperationsController::class, 'storeTextFile']);
Route::post('/storage/store-upload', [StorageOperationsController::class, 'storeUploadedFile']);

// قراءة ومعلومات
Route::get('/storage/read', [StorageOperationsController::class, 'readFile']);
Route::get('/storage/check', [StorageOperationsController::class, 'checkFile']);
Route::get('/storage/info/{filename}', [StorageOperationsController::class, 'getFileInfo']);

// نسخ ونقل
Route::post('/storage/copy', [StorageOperationsController::class, 'copyFile']);
Route::post('/storage/move', [StorageOperationsController::class, 'moveFile']);

// حذف
Route::delete('/storage/delete/{filename}', [StorageOperationsController::class, 'deleteFile']);
Route::delete('/storage/delete-multiple', [StorageOperationsController::class, 'deleteMultipleFiles']);

// مجلدات
Route::get('/storage/directories', [StorageOperationsController::class, 'directoryOperations']);

// تحميل
Route::get('/storage/download/{filename}', [StorageOperationsController::class, 'downloadFile']);
Route::get('/storage/stream/{filename}', [StorageOperationsController::class, 'streamFile']);

// متقدم
Route::post('/storage/backup', [StorageOperationsController::class, 'backupAllFiles']);
Route::post('/storage/clean/{days}', [StorageOperationsController::class, 'cleanOldFiles']);
Route::get('/storage/stats', [StorageOperationsController::class, 'getStorageStats']);
*/

/**
 * ============================================================================
 * ملخص العمليات الأساسية
 * Summary of Basic Operations
 * ============================================================================
 *
 * 1. حفظ (Store):
 *    Storage::put('file.txt', 'content')
 *    $file->store('path')
 *    $file->storeAs('path', 'name')
 *
 * 2. قراءة (Read):
 *    Storage::get('file.txt')
 *
 * 3. التحقق (Check):
 *    Storage::exists('file.txt')
 *    Storage::missing('file.txt')
 *
 * 4. معلومات (Info):
 *    Storage::size('file.txt')
 *    Storage::lastModified('file.txt')
 *    Storage::mimeType('file.txt')
 *
 * 5. نسخ/نقل (Copy/Move):
 *    Storage::copy('old.txt', 'new.txt')
 *    Storage::move('old.txt', 'new.txt')
 *
 * 6. حذف (Delete):
 *    Storage::delete('file.txt')
 *    Storage::delete(['f1.txt', 'f2.txt'])
 *    Storage::deleteDirectory('folder')
 *
 * 7. مجلدات (Directories):
 *    Storage::files('dir')
 *    Storage::allFiles('dir')
 *    Storage::directories('dir')
 *    Storage::makeDirectory('dir')
 *
 * 8. تحميل (Download):
 *    Storage::download('file.txt')
 *    Storage::response('file.txt')
 */
