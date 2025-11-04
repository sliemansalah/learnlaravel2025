# الدرس 9: رفع الملفات والتخزين (File Uploads & Storage)
# Lesson 9: File Uploads and Storage

**المستوى:** مبتدئ | Beginner
**المدة المقدرة:** 3-4 ساعات | 3-4 hours
**المتطلبات السابقة:** إتمام الدروس 1-8 | Completion of Lessons 1-8

---

## 📑 جدول المحتويات | Table of Contents

1. [مقدمة](#مقدمة)
2. [Storage Facade](#storage-facade)
3. [File System Configuration](#file-system-configuration)
4. [رفع الملفات](#رفع-الملفات)
5. [التحقق من الملفات](#التحقق-من-الملفات)
6. [تخزين الملفات](#تخزين-الملفات)
7. [استرجاع الملفات](#استرجاع-الملفات)
8. [حذف الملفات](#حذف-الملفات)
9. [معالجة الصور](#معالجة-الصور)
10. [Cloud Storage](#cloud-storage)
11. [أفضل الممارسات](#أفضل-الممارسات)

---

## 🎯 أهداف الدرس | Lesson Objectives

بنهاية هذا الدرس، ستكون قادراً على:

- ✅ فهم نظام التخزين في Laravel
- ✅ رفع الملفات والصور
- ✅ التحقق من أنواع وأحجام الملفات
- ✅ تخزين الملفات في أماكن مختلفة
- ✅ معالجة الصور (تغيير الحجم، القص، إلخ)
- ✅ استخدام Cloud Storage (S3, Digital Ocean)
- ✅ حماية الملفات وإدارة الصلاحيات
- ✅ تحسين الأداء عند التعامل مع الملفات

By the end of this lesson, you will be able to:

- ✅ Understand Laravel's storage system
- ✅ Upload files and images
- ✅ Validate file types and sizes
- ✅ Store files in different locations
- ✅ Process images (resize, crop, etc.)
- ✅ Use Cloud Storage (S3, Digital Ocean)
- ✅ Secure files and manage permissions
- ✅ Optimize performance when handling files

---

## 📚 مقدمة

### لماذا نحتاج نظام تخزين؟ | Why Do We Need Storage?

```
في التطبيقات الحديثة، نحتاج لتخزين:
✅ صور المستخدمين (Profile pictures)
✅ صور المنتجات (Product images)
✅ المستندات (Documents - PDF, Word, etc.)
✅ ملفات الفيديو (Videos)
✅ ملفات Excel/CSV
✅ النسخ الاحتياطية (Backups)

In modern applications, we need to store:
✅ User profile pictures
✅ Product images
✅ Documents (PDF, Word, etc.)
✅ Video files
✅ Excel/CSV files
✅ Backups
```

### التحديات | Challenges

```
❌ كيف نرفع الملفات بأمان؟
❌ أين نخزن الملفات؟
❌ كيف نتحقق من نوع وحجم الملف؟
❌ كيف نحمي الملفات الحساسة؟
❌ كيف نتعامل مع الملفات الكبيرة؟
❌ كيف نستخدم Cloud Storage؟
```

### حل Laravel | Laravel's Solution

Laravel يوفر **Storage Facade** الذي يجعل التعامل مع الملفات سهلاً جداً، سواء كانت محلية أو على Cloud.

---

## 💾 Storage Facade

### ما هو Storage Facade؟

**Storage** هو واجهة موحدة للتعامل مع الملفات بغض النظر عن مكان تخزينها (محلي، S3، Digital Ocean، إلخ).

```php
use Illuminate\Support\Facades\Storage;

// تخزين ملف
Storage::put('file.txt', 'Contents');

// قراءة ملف
$contents = Storage::get('file.txt');

// حذف ملف
Storage::delete('file.txt');

// التحقق من وجود ملف
if (Storage::exists('file.txt')) {
    // الملف موجود
}
```

### الأقراص (Disks)

Laravel يسمح بتعريف "أقراص" متعددة للتخزين:

```
🗂️ local       - للملفات المحلية الخاصة
🌐 public      - للملفات العامة (صور، CSS، JS)
☁️  s3         - Amazon S3
☁️  digitalocean - Digital Ocean Spaces
```

---

## ⚙️ File System Configuration

### ملف الإعدادات: config/filesystems.php

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    */
    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    */
    'disks' => [
        // القرص المحلي (للملفات الخاصة)
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        // القرص العام (للملفات المتاحة للجمهور)
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        // Amazon S3
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    */
    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
];
```

### إنشاء Symbolic Link

لجعل الملفات في `storage/app/public` متاحة عبر الويب:

```bash
php artisan storage:link
```

هذا ينشئ symbolic link من:
```
public/storage ← storage/app/public
```

الآن يمكن الوصول للملفات عبر:
```
http://example.com/storage/image.jpg
```

---

## 📤 رفع الملفات

### Form HTML لرفع الملفات

```html
<form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="avatar">صورة الملف الشخصي:</label>
    <input type="file" name="avatar" id="avatar">

    <button type="submit">رفع</button>
</form>
```

**⚠️ مهم جداً:** يجب إضافة `enctype="multipart/form-data"` للـ form!

### استقبال الملف في Controller

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // التحقق من وجود الملف
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            // معلومات الملف
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize(); // بالبايت
            $mimeType = $file->getMimeType();

            // الملف جاهز للتخزين
        }
    }
}
```

### معلومات الملف | File Information

```php
$file = $request->file('avatar');

// اسم الملف الأصلي
$file->getClientOriginalName(); // "photo.jpg"

// الامتداد
$file->getClientOriginalExtension(); // "jpg"
$file->extension(); // "jpg"

// الحجم (بالبايت)
$file->getSize(); // 1024000

// نوع MIME
$file->getMimeType(); // "image/jpeg"

// المسار المؤقت
$file->getRealPath(); // "/tmp/php/phpXXXXXX"

// التحقق من صحة الملف
$file->isValid(); // true/false
```

---

## ✅ التحقق من الملفات

### Validation Rules للملفات

```php
$request->validate([
    // الملف مطلوب ويجب أن يكون صورة
    'avatar' => 'required|image',

    // صورة بحجم أقصى 2MB
    'photo' => 'required|image|max:2048',

    // صورة بامتدادات محددة
    'banner' => 'required|image|mimes:jpeg,png,jpg,gif',

    // صورة بأبعاد محددة
    'logo' => 'required|image|dimensions:min_width=100,min_height=100',

    // PDF فقط
    'document' => 'required|file|mimes:pdf|max:10240',

    // ملف عام
    'attachment' => 'required|file|max:5120',
]);
```

### قواعد Validation الشائعة

```php
// file - ملف عام
'file' => 'required|file'

// image - صورة فقط (jpeg, png, bmp, gif, svg, webp)
'avatar' => 'required|image'

// mimes - أنواع MIME محددة
'document' => 'required|mimes:pdf,doc,docx'

// mimetypes - MIME types محددة
'video' => 'required|mimetypes:video/avi,video/mpeg,video/quicktime'

// max - حجم أقصى (بالكيلوبايت)
'file' => 'required|max:2048' // 2MB

// min - حجم أدنى (بالكيلوبايت)
'file' => 'required|min:100'

// dimensions - أبعاد الصورة
'image' => 'required|dimensions:min_width=100,min_height=200'
'image' => 'required|dimensions:max_width=1000,max_height=1000'
'image' => 'required|dimensions:width=500,height=500'
'image' => 'required|dimensions:ratio=3/2'
```

### مثال كامل للتحقق

```php
public function upload(Request $request)
{
    $validated = $request->validate([
        'avatar' => [
            'required',
            'image',
            'mimes:jpeg,png,jpg',
            'max:2048', // 2MB
            'dimensions:min_width=200,min_height=200,max_width=2000,max_height=2000',
        ],
        'resume' => [
            'required',
            'file',
            'mimes:pdf',
            'max:5120', // 5MB
        ],
    ], [
        'avatar.required' => 'الصورة الشخصية مطلوبة',
        'avatar.image' => 'يجب أن يكون الملف صورة',
        'avatar.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت',
        'resume.mimes' => 'السيرة الذاتية يجب أن تكون بصيغة PDF',
    ]);

    // الملفات صحيحة، يمكن المتابعة
}
```

---

## 💾 تخزين الملفات

### الطريقة الأولى: store()

```php
public function upload(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|max:2048',
    ]);

    // تخزين في storage/app/avatars
    $path = $request->file('avatar')->store('avatars');
    // returns: "avatars/random-name.jpg"

    // تخزين في القرص العام
    $path = $request->file('avatar')->store('avatars', 'public');
    // returns: "avatars/random-name.jpg"
    // الملف في: storage/app/public/avatars/random-name.jpg
    // الوصول عبر: http://example.com/storage/avatars/random-name.jpg
}
```

### الطريقة الثانية: storeAs() - مع اسم محدد

```php
public function upload(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|max:2048',
    ]);

    // إنشاء اسم فريد
    $fileName = 'avatar_' . auth()->id() . '_' . time() . '.' . $request->avatar->extension();

    // تخزين مع اسم محدد
    $path = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
    // returns: "avatars/avatar_123_1699999999.jpg"
}
```

### الطريقة الثالثة: Storage::put()

```php
use Illuminate\Support\Facades\Storage;

public function upload(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|max:2048',
    ]);

    $file = $request->file('avatar');
    $fileName = 'avatar_' . time() . '.' . $file->extension();

    // قراءة محتوى الملف وتخزينه
    Storage::disk('public')->put('avatars/' . $fileName, file_get_contents($file));

    // أو مباشرة
    Storage::disk('public')->putFileAs('avatars', $file, $fileName);
}
```

### الطريقة الرابعة: Storage::putFile()

```php
// تخزين مع اسم عشوائي
$path = Storage::disk('public')->putFile('avatars', $request->file('avatar'));

// تخزين مع اسم محدد
$path = Storage::disk('public')->putFileAs(
    'avatars',
    $request->file('avatar'),
    'custom-name.jpg'
);
```

### مثال كامل: حفظ في Database

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        // حذف الصورة القديمة إن وجدت
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // تخزين الصورة الجديدة
        $path = $request->file('avatar')->store('avatars', 'public');

        // حفظ المسار في Database
        $user->update(['avatar' => $path]);

        return redirect()->back()->with('success', 'تم تحديث الصورة بنجاح');
    }
}
```

---

## 📥 استرجاع الملفات

### قراءة محتوى الملف

```php
use Illuminate\Support\Facades\Storage;

// قراءة محتوى الملف
$contents = Storage::get('file.txt');

// قراءة من قرص محدد
$contents = Storage::disk('public')->get('avatars/avatar.jpg');
```

### تحميل الملف (Download)

```php
use Illuminate\Support\Facades\Storage;

public function download($filename)
{
    // التحقق من وجود الملف
    if (!Storage::disk('public')->exists('documents/' . $filename)) {
        abort(404);
    }

    // تحميل الملف
    return Storage::disk('public')->download('documents/' . $filename);

    // أو مع اسم مخصص
    return Storage::disk('public')->download(
        'documents/' . $filename,
        'تقرير-شهري.pdf'
    );
}
```

### عرض الملف في المتصفح

```php
public function show($filename)
{
    $path = 'documents/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return response($file, 200)->header('Content-Type', $type);
}
```

### الحصول على URL الملف

```php
use Illuminate\Support\Facades\Storage;

// URL للملف العام
$url = Storage::disk('public')->url('avatars/avatar.jpg');
// returns: "/storage/avatars/avatar.jpg"

// URL كامل
$url = asset('storage/avatars/avatar.jpg');
// returns: "http://example.com/storage/avatars/avatar.jpg"
```

### معلومات الملف

```php
use Illuminate\Support\Facades\Storage;

// حجم الملف (بالبايت)
$size = Storage::size('file.txt');

// آخر تعديل (timestamp)
$time = Storage::lastModified('file.txt');

// نوع MIME
$mime = Storage::mimeType('file.txt');
```

---

## 🗑️ حذف الملفات

### حذف ملف واحد

```php
use Illuminate\Support\Facades\Storage;

// حذف ملف
Storage::delete('file.txt');

// حذف من قرص محدد
Storage::disk('public')->delete('avatars/avatar.jpg');
```

### حذف عدة ملفات

```php
// حذف عدة ملفات
Storage::delete(['file1.txt', 'file2.txt', 'file3.txt']);

// أو
Storage::disk('public')->delete([
    'avatars/avatar1.jpg',
    'avatars/avatar2.jpg',
]);
```

### حذف مجلد كامل

```php
// حذف مجلد وجميع محتوياته
Storage::deleteDirectory('avatars');

// من قرص محدد
Storage::disk('public')->deleteDirectory('old-images');
```

### مثال: حذف عند حذف السجل

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected static function booted()
    {
        // عند حذف المنشور، احذف الصورة
        static::deleting(function ($post) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
        });
    }
}
```

---

## 🖼️ معالجة الصور

### تثبيت Intervention Image

Laravel لا يأتي مع مكتبة لمعالجة الصور، لكن يمكن استخدام **Intervention Image**:

```bash
composer require intervention/image
```

### إعداد Service Provider (Laravel 11)

```php
// config/app.php

'providers' => [
    // ...
    Intervention\Image\ImageServiceProvider::class,
],

'aliases' => [
    // ...
    'Image' => Intervention\Image\Facades\Image::class,
],
```

### تغيير حجم الصورة

```php
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

public function upload(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:5120',
    ]);

    $file = $request->file('image');

    // قراءة الصورة
    $image = Image::make($file);

    // تغيير الحجم (الحفاظ على النسبة)
    $image->resize(800, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize(); // منع التكبير
    });

    // حفظ في storage
    $filename = 'resized_' . time() . '.jpg';
    $path = 'images/' . $filename;

    Storage::disk('public')->put($path, (string) $image->encode('jpg', 90));

    return $path;
}
```

### قص الصورة (Crop)

```php
use Intervention\Image\Facades\Image;

// قص مربع من المنتصف
$image = Image::make($file)
    ->fit(300, 300); // قص إلى 300x300 من المنتصف

// قص من موقع محدد
$image = Image::make($file)
    ->crop(200, 200, 10, 10); // العرض، الارتفاع، X، Y
```

### إنشاء Thumbnails

```php
public function uploadWithThumbnail(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:5120',
    ]);

    $file = $request->file('image');
    $filename = time() . '.jpg';

    // الصورة الأصلية
    $originalImage = Image::make($file);
    Storage::disk('public')->put(
        'images/original/' . $filename,
        (string) $originalImage->encode('jpg', 90)
    );

    // صورة متوسطة
    $mediumImage = Image::make($file)->resize(800, null, function ($constraint) {
        $constraint->aspectRatio();
    });
    Storage::disk('public')->put(
        'images/medium/' . $filename,
        (string) $mediumImage->encode('jpg', 85)
    );

    // صورة مصغرة
    $thumbnail = Image::make($file)->fit(200, 200);
    Storage::disk('public')->put(
        'images/thumbnails/' . $filename,
        (string) $thumbnail->encode('jpg', 80)
    );

    return [
        'original' => 'images/original/' . $filename,
        'medium' => 'images/medium/' . $filename,
        'thumbnail' => 'images/thumbnails/' . $filename,
    ];
}
```

### إضافة Watermark

```php
use Intervention\Image\Facades\Image;

public function addWatermark($imagePath)
{
    $image = Image::make(storage_path('app/public/' . $imagePath));

    // إضافة نص
    $image->text('© My Company', 120, 100, function($font) {
        $font->file(public_path('fonts/Arial.ttf'));
        $font->size(24);
        $font->color('#ffffff');
        $font->align('center');
        $font->valign('middle');
    });

    // أو إضافة صورة watermark
    $watermark = Image::make(public_path('watermark.png'));
    $image->insert($watermark, 'bottom-right', 10, 10);

    // حفظ
    Storage::disk('public')->put($imagePath, (string) $image->encode());
}
```

---

## ☁️ Cloud Storage

### استخدام Amazon S3

#### 1. التثبيت

```bash
composer require league/flysystem-aws-s3-v3 "^3.0"
```

#### 2. الإعدادات (.env)

```env
AWS_ACCESS_KEY_ID=your-access-key
AWS_SECRET_ACCESS_KEY=your-secret-key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
AWS_USE_PATH_STYLE_ENDPOINT=false
```

#### 3. الاستخدام

```php
use Illuminate\Support\Facades\Storage;

// رفع ملف إلى S3
$path = $request->file('avatar')->store('avatars', 's3');

// قراءة من S3
$contents = Storage::disk('s3')->get('file.txt');

// حذف من S3
Storage::disk('s3')->delete('file.txt');

// URL عام للملف
$url = Storage::disk('s3')->url('avatars/avatar.jpg');

// URL مؤقت (صالح لمدة محددة)
$url = Storage::disk('s3')->temporaryUrl(
    'file.pdf',
    now()->addMinutes(30)
);
```

### استخدام Digital Ocean Spaces

Digital Ocean Spaces متوافق مع S3 API:

```env
# .env
AWS_ACCESS_KEY_ID=your-spaces-key
AWS_SECRET_ACCESS_KEY=your-spaces-secret
AWS_DEFAULT_REGION=nyc3
AWS_BUCKET=your-space-name
AWS_ENDPOINT=https://nyc3.digitaloceanspaces.com
AWS_USE_PATH_STYLE_ENDPOINT=false
```

الاستخدام نفس S3 تماماً!

---

## 🔒 أفضل الممارسات

### 1. الأمان | Security

```php
// ❌ لا تستخدم الاسم الأصلي مباشرة
$filename = $request->file('avatar')->getClientOriginalName();
// خطر: يمكن أن يحتوي على "../" أو أحرف خطرة

// ✅ أنشئ اسم آمن
$filename = Str::random(40) . '.' . $request->file('avatar')->extension();

// ✅ أو استخدم hash
$filename = $request->file('avatar')->hashName();

// ✅ تحقق من نوع الملف
$request->validate([
    'file' => 'required|mimes:jpeg,png,pdf|max:2048',
]);
```

### 2. تنظيم الملفات | File Organization

```php
// ✅ نظم الملفات في مجلدات واضحة
'avatars/' . auth()->id() . '/' . $filename
'products/' . $product->id . '/images/' . $filename
'documents/' . date('Y/m') . '/' . $filename

// مثال
public function store(Request $request)
{
    $path = $request->file('image')->store(
        'products/' . $request->product_id . '/images',
        'public'
    );
}
```

### 3. حفظ المعلومات في Database

```php
// ✅ احفظ معلومات الملف في جدول منفصل
Schema::create('media', function (Blueprint $table) {
    $table->id();
    $table->morphs('mediable'); // للـ polymorphic relation
    $table->string('name');
    $table->string('file_name');
    $table->string('mime_type');
    $table->string('path');
    $table->unsignedBigInteger('size');
    $table->timestamps();
});
```

### 4. الأداء | Performance

```php
// ✅ استخدم Queues للملفات الكبيرة
use App\Jobs\ProcessUploadedImage;

public function upload(Request $request)
{
    $path = $request->file('image')->store('temp', 'public');

    ProcessUploadedImage::dispatch($path);

    return response()->json(['message' => 'جاري المعالجة']);
}
```

### 5. Validation المتقدم

```php
$request->validate([
    'avatar' => [
        'required',
        'image',
        'mimes:jpeg,png,jpg',
        'max:2048',
        'dimensions:min_width=200,min_height=200',
        function ($attribute, $value, $fail) {
            // تحقق مخصص
            if ($value->getSize() > 2048 * 1024) {
                $fail('الصورة كبيرة جداً');
            }
        },
    ],
]);
```

### 6. حذف الملفات غير المستخدمة

```php
// أنشئ command لحذف الملفات القديمة
php artisan make:command CleanupOldFiles

// في الـ Command
public function handle()
{
    $files = Storage::disk('public')->files('temp');

    foreach ($files as $file) {
        $lastModified = Storage::disk('public')->lastModified($file);

        // احذف الملفات الأقدم من 24 ساعة
        if (now()->timestamp - $lastModified > 86400) {
            Storage::disk('public')->delete($file);
            $this->info("Deleted: {$file}");
        }
    }
}
```

### 7. حماية الملفات الخاصة

```php
// لا تضع الملفات الحساسة في public
// استخدم disk('local') بدلاً من disk('public')

// رفع ملف خاص
$path = $request->file('document')->store('private-documents', 'local');

// للوصول إليه، أنشئ route محمي
Route::get('/documents/{filename}', function ($filename) {
    // تحقق من الصلاحيات
    if (!auth()->user()->canAccessDocument($filename)) {
        abort(403);
    }

    $path = 'private-documents/' . $filename;

    if (!Storage::exists($path)) {
        abort(404);
    }

    return response()->file(storage_path('app/' . $path));
})->middleware('auth');
```

---

## 📝 ملخص الدرس | Lesson Summary

### النقاط الرئيسية:

1. **Storage Facade** - واجهة موحدة للتخزين
   - `Storage::put()` - حفظ
   - `Storage::get()` - قراءة
   - `Storage::delete()` - حذف

2. **رفع الملفات**
   - `$request->file('name')` - الحصول على الملف
   - `store()` / `storeAs()` - التخزين
   - Validation للتحقق من النوع والحجم

3. **معالجة الصور**
   - Intervention Image library
   - تغيير الحجم، القص، Watermark
   - إنشاء Thumbnails

4. **Cloud Storage**
   - S3, Digital Ocean Spaces
   - نفس API للتخزين المحلي
   - Temporary URLs

5. **أفضل الممارسات**
   - أسماء ملفات آمنة
   - تنظيم في مجلدات
   - Validation صارم
   - حماية الملفات الحساسة

---

## 🎯 ماذا بعد؟

في الدرس التالي، سنتعلم:

- ✅ إرسال البريد الإلكتروني (Emails)
- ✅ الإشعارات (Notifications)
- ✅ Queues للمهام الثقيلة
- ✅ Events & Listeners

**استعد للدرس القادم! 🚀**

---

## 📚 مصادر إضافية | Additional Resources

### الوثائق الرسمية:
- 📖 [Laravel File Storage](https://laravel.com/docs/11.x/filesystem)
- 📖 [Laravel File Uploads](https://laravel.com/docs/11.x/requests#files)
- 📖 [Intervention Image](http://image.intervention.io/)

### فيديوهات:
- 🎥 [Laracasts - File Uploads](https://laracasts.com/series/laravel-from-scratch/file-uploads)
- 🎥 [Laravel Daily - Image Upload](https://www.youtube.com/watch?v=file-upload)

---

**📌 ملاحظة:** تأكد من فهم جميع المفاهيم قبل الانتقال للدرس العملي!

**تاريخ آخر تحديث:** 2025-11-03
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
