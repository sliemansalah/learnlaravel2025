<?php

/**
 * ============================================================================
 * مثال 1: رفع ملف بسيط
 * Example 1: Basic File Upload
 * ============================================================================
 *
 * هذا المثال يوضح:
 * - كيفية إنشاء نموذج رفع ملف
 * - التحقق من الملف
 * - حفظ الملف في storage
 * - عرض رسالة نجاح
 *
 * This example demonstrates:
 * - How to create a file upload form
 * - File validation
 * - Saving file to storage
 * - Displaying success message
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BasicUploadController extends Controller
{
    /**
     * عرض صفحة رفع الملف
     * Display the upload page
     */
    public function index()
    {
        return view('basic-upload');
    }

    /**
     * معالجة رفع الملف
     * Handle file upload
     */
    public function upload(Request $request)
    {
        // الخطوة 1: التحقق من الملف
        // Step 1: Validate the file
        $request->validate([
            'file' => 'required|file|max:2048', // الحد الأقصى 2MB
        ], [
            'file.required' => 'يرجى اختيار ملف',
            'file.file' => 'الملف المرفوع غير صالح',
            'file.max' => 'حجم الملف كبير جداً (الحد الأقصى 2 ميجا)',
        ]);

        // الخطوة 2: الحصول على الملف
        // Step 2: Get the file
        $file = $request->file('file');

        // الخطوة 3: الحصول على معلومات الملف
        // Step 3: Get file information
        $originalName = $file->getClientOriginalName();
        $extension = $file->extension();
        $size = $file->getSize(); // بالبايت

        // الخطوة 4: حفظ الملف
        // Step 4: Store the file
        // سيتم حفظ الملف في storage/app/uploads
        $path = $file->store('uploads');

        // الخطوة 5: عرض رسالة نجاح مع معلومات الملف
        // Step 5: Display success message with file info
        return back()->with('success', "
            تم رفع الملف بنجاح!
            الاسم الأصلي: {$originalName}
            الامتداد: {$extension}
            الحجم: " . round($size / 1024, 2) . " كيلوبايت
            المسار: {$path}
        ");
    }

    /**
     * حذف ملف
     * Delete a file
     */
    public function delete($filename)
    {
        // التحقق من وجود الملف
        // Check if file exists
        if (Storage::exists($filename)) {
            // حذف الملف
            // Delete the file
            Storage::delete($filename);

            return back()->with('success', 'تم حذف الملف بنجاح');
        }

        return back()->with('error', 'الملف غير موجود');
    }
}

/**
 * ============================================================================
 * Routes لهذا المثال
 * Routes for this example
 * ============================================================================
 *
 * أضف هذا إلى routes/web.php:
 * Add this to routes/web.php:
 */

/*
use App\Http\Controllers\BasicUploadController;

Route::get('/upload', [BasicUploadController::class, 'index'])
    ->name('upload.index');

Route::post('/upload', [BasicUploadController::class, 'upload'])
    ->name('upload.store');

Route::delete('/upload/{filename}', [BasicUploadController::class, 'delete'])
    ->name('upload.delete');
*/

/**
 * ============================================================================
 * View (basic-upload.blade.php)
 * ============================================================================
 */

/*
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع ملف</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .form-container {
            border: 2px dashed #667eea;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }
        input[type="file"] {
            margin: 20px 0;
        }
        button {
            background: #667eea;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <h1>📁 رفع ملف بسيط</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="form-container">
        <h2>اختر ملف للرفع</h2>

        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="file" name="file" required>
            <br>
            <button type="submit">رفع الملف</button>
        </form>

        <p style="color: #666; margin-top: 20px;">
            الحد الأقصى للحجم: 2 ميجابايت
        </p>
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
 * 1. التحقق من الملف (Validation):
 *    - required: الملف مطلوب
 *    - file: يجب أن يكون ملف صالح
 *    - max:2048: الحد الأقصى 2MB (بالكيلوبايت)
 *
 * 2. حفظ الملف (Storing):
 *    - store('uploads'): يحفظ في storage/app/uploads
 *    - يتم توليد اسم عشوائي تلقائياً
 *    - يتم إرجاع المسار الكامل
 *
 * 3. موقع التخزين (Storage Location):
 *    - local disk (افتراضي): storage/app
 *    - public disk: storage/app/public
 *    - يمكن الوصول عبر المتصفح إذا استخدمت public
 *
 * 4. أمان الملفات (File Security):
 *    - تحقق دائماً من نوع الملف
 *    - حدد الحد الأقصى للحجم
 *    - لا تثق بامتداد الملف فقط
 *    - استخدم validation rules قوية
 *
 * 5. معالجة الأخطاء (Error Handling):
 *    - استخدم validation messages واضحة
 *    - تحقق من وجود الملف قبل الحذف
 *    - اعرض رسائل خطأ مفيدة للمستخدم
 */

/**
 * ============================================================================
 * تحسينات ممكنة
 * Possible Improvements
 * ============================================================================
 *
 * 1. حفظ معلومات الملف في قاعدة البيانات
 * 2. إنشاء thumbnails للصور
 * 3. إضافة progress bar للرفع
 * 4. استخدام queues لمعالجة الملفات الكبيرة
 * 5. إضافة فحص للفيروسات
 * 6. ضغط الملفات تلقائياً
 * 7. إنشاء معاينة قبل الرفع
 */
