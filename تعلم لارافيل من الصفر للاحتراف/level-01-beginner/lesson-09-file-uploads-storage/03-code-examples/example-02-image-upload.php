<?php

/**
 * ============================================================================
 * مثال 2: رفع الصور مع التحقق المتقدم
 * Example 2: Image Upload with Advanced Validation
 * ============================================================================
 *
 * هذا المثال يوضح:
 * - التحقق من أن الملف صورة
 * - التحقق من نوع الصورة والحجم والأبعاد
 * - حفظ الصورة في public disk
 * - عرض الصورة المرفوعة
 * - إنشاء اسم فريد للصورة
 *
 * This example demonstrates:
 * - Image validation
 * - Type, size, and dimension validation
 * - Saving to public disk
 * - Displaying uploaded image
 * - Generating unique filename
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    /**
     * عرض صفحة رفع الصور
     * Display image upload page
     */
    public function index()
    {
        // جلب جميع الصور من المجلد
        // Get all images from folder
        $images = Storage::disk('public')->files('images');

        return view('image-upload', compact('images'));
    }

    /**
     * رفع صورة واحدة
     * Upload single image
     */
    public function upload(Request $request)
    {
        // التحقق المتقدم من الصورة
        // Advanced image validation
        $request->validate([
            'image' => [
                'required',
                'image',                                    // يجب أن تكون صورة
                'mimes:jpeg,png,jpg,gif',                  // أنواع الصور المسموحة
                'max:2048',                                 // الحد الأقصى 2MB
                'dimensions:min_width=100,min_height=100', // الحد الأدنى للأبعاد
            ]
        ], [
            'image.required' => 'يرجى اختيار صورة',
            'image.image' => 'الملف المرفوع ليس صورة',
            'image.mimes' => 'نوع الصورة غير مدعوم (JPEG, PNG, JPG, GIF فقط)',
            'image.max' => 'حجم الصورة كبير جداً (الحد الأقصى 2 ميجا)',
            'image.dimensions' => 'أبعاد الصورة صغيرة جداً (على الأقل 100x100)',
        ]);

        $image = $request->file('image');

        // إنشاء اسم فريد للصورة
        // Generate unique filename
        $filename = $this->generateUniqueFilename($image);

        // حفظ الصورة في public disk
        // Store image in public disk
        $path = $image->storeAs('images', $filename, 'public');

        // الحصول على معلومات الصورة
        // Get image information
        $imageInfo = $this->getImageInfo($image, $path);

        return back()->with('success', 'تم رفع الصورة بنجاح!')
                     ->with('imageInfo', $imageInfo);
    }

    /**
     * رفع صور متعددة
     * Upload multiple images
     */
    public function uploadMultiple(Request $request)
    {
        // التحقق من الصور المتعددة
        // Validate multiple images
        $request->validate([
            'images' => 'required|array|min:1|max:10',
            'images.*' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ]
        ], [
            'images.required' => 'يرجى اختيار صور',
            'images.min' => 'يجب اختيار صورة واحدة على الأقل',
            'images.max' => 'لا يمكن رفع أكثر من 10 صور في المرة الواحدة',
            'images.*.image' => 'أحد الملفات المرفوعة ليس صورة',
            'images.*.mimes' => 'نوع أحد الصور غير مدعوم',
            'images.*.max' => 'حجم أحد الصور كبير جداً',
        ]);

        $uploadedImages = [];

        // رفع كل صورة
        // Upload each image
        foreach ($request->file('images') as $image) {
            $filename = $this->generateUniqueFilename($image);
            $path = $image->storeAs('images', $filename, 'public');
            $uploadedImages[] = $path;
        }

        $count = count($uploadedImages);

        return back()->with('success', "تم رفع {$count} صورة بنجاح!");
    }

    /**
     * حذف صورة
     * Delete image
     */
    public function delete($filename)
    {
        $filePath = 'images/' . $filename;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return back()->with('success', 'تم حذف الصورة بنجاح');
        }

        return back()->with('error', 'الصورة غير موجودة');
    }

    /**
     * توليد اسم ملف فريد
     * Generate unique filename
     */
    private function generateUniqueFilename($file)
    {
        // طريقة 1: استخدام timestamp + اسم عشوائي
        // Method 1: Using timestamp + random string
        // return time() . '_' . Str::random(10) . '.' . $file->extension();

        // طريقة 2: استخدام timestamp + الاسم الأصلي
        // Method 2: Using timestamp + original name
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($originalName); // إزالة الأحرف الخاصة
        return time() . '_' . $safeName . '.' . $file->extension();

        // طريقة 3: استخدام UUID
        // Method 3: Using UUID
        // return Str::uuid() . '.' . $file->extension();
    }

    /**
     * الحصول على معلومات الصورة
     * Get image information
     */
    private function getImageInfo($file, $path)
    {
        // الحصول على أبعاد الصورة
        // Get image dimensions
        list($width, $height) = getimagesize($file->getRealPath());

        return [
            'original_name' => $file->getClientOriginalName(),
            'size' => round($file->getSize() / 1024, 2) . ' KB',
            'extension' => $file->extension(),
            'mime_type' => $file->getMimeType(),
            'width' => $width,
            'height' => $height,
            'path' => $path,
            'url' => Storage::disk('public')->url($path),
        ];
    }

    /**
     * تحميل صورة
     * Download image
     */
    public function download($filename)
    {
        $filePath = 'images/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'الصورة غير موجودة');
        }

        return Storage::disk('public')->download($filePath);
    }
}

/**
 * ============================================================================
 * Routes لهذا المثال
 * Routes for this example
 * ============================================================================
 */

/*
use App\Http\Controllers\ImageUploadController;

Route::get('/images', [ImageUploadController::class, 'index'])
    ->name('images.index');

Route::post('/images/upload', [ImageUploadController::class, 'upload'])
    ->name('images.upload');

Route::post('/images/upload-multiple', [ImageUploadController::class, 'uploadMultiple'])
    ->name('images.upload.multiple');

Route::delete('/images/{filename}', [ImageUploadController::class, 'delete'])
    ->name('images.delete');

Route::get('/images/download/{filename}', [ImageUploadController::class, 'download'])
    ->name('images.download');
*/

/**
 * ============================================================================
 * View (image-upload.blade.php)
 * ============================================================================
 */

/*
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع الصور</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }
        .upload-section {
            border: 2px dashed #667eea;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .image-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .image-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .image-card .actions {
            padding: 10px;
            text-align: center;
        }
        button {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn {
            background: #dc3545;
            padding: 5px 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>📷 معرض الصور</h1>

    @if(session('success'))
        <div style="background: #d4edda; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
            {{ session('success') }}

            @if(session('imageInfo'))
                <div style="margin-top: 10px; font-size: 14px;">
                    <strong>معلومات الصورة:</strong><br>
                    الاسم: {{ session('imageInfo')['original_name'] }}<br>
                    الحجم: {{ session('imageInfo')['size'] }}<br>
                    الأبعاد: {{ session('imageInfo')['width'] }}x{{ session('imageInfo')['height'] }}
                </div>
            @endif
        </div>
    @endif

    <div class="upload-section">
        <h2>رفع صورة واحدة</h2>
        <form action="{{ route('images.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">رفع الصورة</button>
        </form>
    </div>

    <div class="upload-section">
        <h2>رفع صور متعددة</h2>
        <form action="{{ route('images.upload.multiple') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="images[]" accept="image/*" multiple required>
            <button type="submit">رفع الصور</button>
        </form>
    </div>

    <h2>الصور المرفوعة</h2>
    <div class="image-grid">
        @forelse($images as $image)
            <div class="image-card">
                <img src="{{ Storage::disk('public')->url($image) }}" alt="صورة">
                <div class="actions">
                    <p style="font-size: 12px; margin: 5px 0;">{{ basename($image) }}</p>
                    <form action="{{ route('images.delete', basename($image)) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('هل تريد حذف هذه الصورة؟')">
                            حذف
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p style="grid-column: 1/-1; text-align: center; color: #999;">
                لا توجد صور مرفوعة
            </p>
        @endforelse
    </div>
</body>
</html>
*/

/**
 * ============================================================================
 * ملاحظات مهمة
 * Important Notes
 * ============================================================================
 *
 * 1. Validation Rules للصور:
 *    - image: التحقق من أن الملف صورة
 *    - mimes:jpeg,png,jpg,gif: أنواع الصور المسموحة
 *    - max:2048: الحد الأقصى للحجم (بالكيلوبايت)
 *    - dimensions: التحقق من الأبعاد
 *
 * 2. Public Disk:
 *    - الملفات متاحة للعامة
 *    - يمكن الوصول إليها عبر URL
 *    - يجب تشغيل: php artisan storage:link
 *
 * 3. أمان الصور:
 *    - لا تثق بامتداد الملف فقط
 *    - تحقق من MIME type
 *    - حدد الأنواع المسموح بها
 *    - أعد تسمية الملفات
 *
 * 4. تحسينات الأداء:
 *    - إنشاء thumbnails للصور الكبيرة
 *    - ضغط الصور تلقائياً
 *    - استخدام lazy loading
 *    - استخدام CDN للصور
 */
