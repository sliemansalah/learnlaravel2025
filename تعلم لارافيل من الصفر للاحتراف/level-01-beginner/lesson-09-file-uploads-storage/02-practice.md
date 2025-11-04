# الدرس 9: التطبيق العملي - رفع الملفات والتخزين
# Lesson 9: Practical Application - File Uploads and Storage

**المدة المقدرة:** 3-4 ساعات | Estimated Duration: 3-4 hours
**المستوى:** مبتدئ | Level: Beginner

---

## 📋 جدول المحتويات | Table of Contents

1. [إعداد المشروع](#إعداد-المشروع)
2. [إنشاء نموذج رفع الملفات](#إنشاء-نموذج-رفع-الملفات)
3. [معالجة رفع الملفات](#معالجة-رفع-الملفات)
4. [التحقق من الملفات](#التحقق-من-الملفات)
5. [تخزين الملفات](#تخزين-الملفات)
6. [عرض وحذف الملفات](#عرض-وحذف-الملفات)
7. [استخدام Storage Facade](#استخدام-storage-facade)

---

## 🎯 أهداف الدرس العملي

بنهاية هذا الدرس، ستكون قد:

- ✅ أنشأت نموذج رفع ملفات
- ✅ تعاملت مع رفع الصور والملفات
- ✅ طبقت التحقق من أنواع وأحجام الملفات
- ✅ خزّنت الملفات في مواقع مختلفة
- ✅ عرضت الملفات المرفوعة
- ✅ حذفت الملفات من التخزين
- ✅ استخدمت Storage Facade بفعالية

---

## 📥 إعداد المشروع

### الخطوة 1: إنشاء مشروع جديد

```bash
# إنشاء مشروع Laravel جديد
composer create-project laravel/laravel file-upload-demo
cd file-upload-demo

# تشغيل السيرفر
php artisan serve
```

### الخطوة 2: إعداد قاعدة البيانات

**ملف `.env`:**

```env
DB_CONNECTION=sqlite
```

**إنشاء ملف قاعدة البيانات:**

```bash
# Windows
type nul > database\database.sqlite

# macOS/Linux
touch database/database.sqlite
```

### الخطوة 3: إنشاء رابط التخزين

```bash
# إنشاء symbolic link للمجلد public
php artisan storage:link

# ستظهر رسالة:
# The [public/storage] link has been connected to [storage/app/public]
```

**ماذا حدث؟**
- تم إنشاء رابط من `public/storage` إلى `storage/app/public`
- الآن يمكن الوصول للملفات المخزنة عبر المتصفح

---

## 📝 إنشاء نموذج رفع الملفات

### الخطوة 1: إنشاء Controller

```bash
php artisan make:controller FileUploadController
```

### الخطوة 2: إنشاء Routes

**ملف `routes/web.php`:**

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

Route::get('/', [FileUploadController::class, 'index'])->name('home');
Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');
Route::delete('/delete/{filename}', [FileUploadController::class, 'delete'])->name('delete');
```

### الخطوة 3: إنشاء View

**أنشئ ملف `resources/views/upload.blade.php`:**

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع الملفات</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        h1 {
            color: #667eea;
            text-align: center;
            margin-bottom: 30px;
        }

        .upload-form {
            border: 2px dashed #667eea;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
        }

        input[type="file"] {
            margin: 20px 0;
        }

        button {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #764ba2;
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .files-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .file-item {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .file-item img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .delete-btn {
            background: #dc3545;
            padding: 8px 15px;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📁 نظام رفع الملفات</h1>

        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                ❌
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="upload-form">
            <h2>📤 رفع ملف جديد</h2>
            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <br>
                <button type="submit">رفع الملف</button>
            </form>
        </div>

        <h2>📂 الملفات المرفوعة</h2>
        <div class="files-grid">
            {{-- سنضيف الملفات هنا لاحقاً --}}
        </div>
    </div>
</body>
</html>
```

---

## 🔧 معالجة رفع الملفات

### تحديث FileUploadController

**ملف `app/Http/Controllers/FileUploadController.php`:**

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        // جلب جميع الملفات من المجلد public
        $files = Storage::disk('public')->files();

        return view('upload', compact('files'));
    }

    public function upload(Request $request)
    {
        // التحقق من الملف
        $request->validate([
            'file' => 'required|file|max:2048' // 2MB max
        ]);

        // رفع الملف
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        return back()->with('success', 'تم رفع الملف بنجاح! المسار: ' . $path);
    }

    public function delete($filename)
    {
        // حذف الملف
        if (Storage::disk('public')->exists($filename)) {
            Storage::disk('public')->delete($filename);
            return back()->with('success', 'تم حذف الملف بنجاح!');
        }

        return back()->with('error', 'الملف غير موجود!');
    }
}
```

---

## ✅ التحقق من الملفات

### أنواع التحقق المختلفة

```php
// 1. التحقق من نوع الملف
$request->validate([
    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
]);

// 2. التحقق من الصور فقط
$request->validate([
    'avatar' => 'required|image|dimensions:min_width=100,min_height=100'
]);

// 3. التحقق من ملفات PDF
$request->validate([
    'document' => 'required|mimes:pdf|max:5120' // 5MB
]);

// 4. التحقق من أنواع متعددة
$request->validate([
    'file' => 'required|mimes:jpeg,png,pdf,docx|max:10240' // 10MB
]);
```

### تحديث Controller مع تحقق أفضل

```php
public function upload(Request $request)
{
    $request->validate([
        'file' => [
            'required',
            'file',
            'mimes:jpeg,png,jpg,gif,pdf',
            'max:2048'
        ]
    ], [
        'file.required' => 'يرجى اختيار ملف',
        'file.mimes' => 'نوع الملف غير مدعوم',
        'file.max' => 'حجم الملف كبير جداً (الحد الأقصى 2 ميجا)'
    ]);

    $file = $request->file('file');

    // توليد اسم فريد
    $filename = time() . '_' . $file->getClientOriginalName();

    // رفع الملف مع اسم مخصص
    $path = $file->storeAs('uploads', $filename, 'public');

    return back()->with('success', 'تم رفع الملف: ' . $filename);
}
```

---

## 💾 تخزين الملفات

### طرق مختلفة للتخزين

```php
// 1. التخزين البسيط
$path = $request->file('file')->store('uploads');

// 2. التخزين مع disk محدد
$path = $request->file('file')->store('uploads', 'public');

// 3. التخزين مع اسم مخصص
$filename = 'user_avatar_' . auth()->id() . '.jpg';
$path = $request->file('file')->storeAs('avatars', $filename, 'public');

// 4. التخزين مع storePublicly (رؤية عامة)
$path = $request->file('file')->storePublicly('documents', 'public');

// 5. الحصول على محتوى الملف
$contents = $request->file('file')->get();
Storage::put('file.txt', $contents);
```

### مثال عملي: رفع صورة Avatar

```php
public function uploadAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|max:1024'
    ]);

    $file = $request->file('avatar');

    // حذف الصورة القديمة إن وجدت
    $oldAvatar = 'avatars/user_' . auth()->id() . '.jpg';
    if (Storage::disk('public')->exists($oldAvatar)) {
        Storage::disk('public')->delete($oldAvatar);
    }

    // رفع الصورة الجديدة
    $filename = 'user_' . auth()->id() . '.' . $file->extension();
    $path = $file->storeAs('avatars', $filename, 'public');

    // تحديث قاعدة البيانات
    auth()->user()->update(['avatar' => $path]);

    return back()->with('success', 'تم تحديث الصورة الشخصية!');
}
```

---

## 📂 عرض وحذف الملفات

### تحديث View لعرض الملفات

```blade
<div class="files-grid">
    @forelse($files as $file)
        <div class="file-item">
            @php
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $url = Storage::disk('public')->url($file);
            @endphp

            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                <img src="{{ $url }}" alt="صورة">
            @else
                <div style="padding: 50px; background: #f0f0f0;">
                    📄 {{ $extension }}
                </div>
            @endif

            <p style="margin-top: 10px; font-size: 14px;">
                {{ basename($file) }}
            </p>

            <form action="{{ route('delete', basename($file)) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn"
                        onclick="return confirm('هل تريد حذف هذا الملف؟')">
                    🗑️ حذف
                </button>
            </form>
        </div>
    @empty
        <p style="grid-column: 1/-1; text-align: center; color: #999;">
            لا توجد ملفات مرفوعة
        </p>
    @endforelse
</div>
```

---

## 🗄️ استخدام Storage Facade

### العمليات الأساسية

```php
use Illuminate\Support\Facades\Storage;

// 1. حفظ ملف
Storage::put('file.txt', 'المحتوى');
Storage::disk('public')->put('file.txt', 'المحتوى');

// 2. قراءة ملف
$contents = Storage::get('file.txt');

// 3. التحقق من وجود ملف
if (Storage::exists('file.txt')) {
    // الملف موجود
}

// 4. حذف ملف
Storage::delete('file.txt');
Storage::delete(['file1.txt', 'file2.txt']); // حذف متعدد

// 5. نسخ ملف
Storage::copy('old.txt', 'new.txt');

// 6. نقل ملف
Storage::move('old.txt', 'new.txt');

// 7. الحصول على حجم الملف
$size = Storage::size('file.txt'); // بالبايت

// 8. الحصول على آخر تعديل
$lastModified = Storage::lastModified('file.txt');

// 9. الحصول على URL للملف
$url = Storage::url('file.txt');

// 10. جلب جميع الملفات
$files = Storage::files('directory');
$allFiles = Storage::allFiles('directory'); // بما في ذلك المجلدات الفرعية
```

---

## ✅ التحقق من الإنجاز

تأكد من إكمال جميع الخطوات:

- [x] إنشاء نموذج رفع ملفات
- [x] التحقق من الملفات المرفوعة
- [x] تخزين الملفات في مواقع مختلفة
- [x] عرض الملفات المخزنة
- [x] حذف الملفات
- [x] استخدام Storage Facade
- [x] إنشاء symbolic link

---

## 🐛 حل المشاكل الشائعة

### مشكلة 1: الملفات لا تظهر

**الحل:**
```bash
# تأكد من إنشاء الرابط الرمزي
php artisan storage:link

# تحقق من الصلاحيات (macOS/Linux)
chmod -R 775 storage
```

### مشكلة 2: خطأ "File too large"

**الحل:**
```php
// تحقق من php.ini:
upload_max_filesize = 10M
post_max_size = 10M
```

### مشكلة 3: لا يمكن حذف الملفات

**الحل:**
```bash
# أعطِ صلاحيات الكتابة
chmod -R 775 storage/app/public
```

---

## 📝 ملخص الدرس العملي

### المفاهيم الرئيسية:

```
✅ رفع الملفات باستخدام Request
✅ التحقق من الملفات (نوع، حجم، أبعاد)
✅ تخزين الملفات في disks مختلفة
✅ استخدام Storage Facade
✅ حذف ونقل ونسخ الملفات
✅ عرض الملفات في Blade
```

---

## 🎯 الخطوة التالية

في الدرس التالي، سنتعلم:
- **Eloquent Relationships**
- **One-to-Many Relations**
- **Many-to-Many Relations**
- **Polymorphic Relations**

**استعد! 🚀**

---

**تاريخ آخر تحديث:** 2025-11-04
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
