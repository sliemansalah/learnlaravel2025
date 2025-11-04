# الدرس 9: التمارين العملية - رفع الملفات والتخزين
# Lesson 9: Practical Exercises - File Uploads and Storage

---

## 📋 نظرة عامة | Overview

هذه التمارين مصممة لتطبيق ما تعلمته في الدرس التاسع حول رفع الملفات والتخزين في Laravel.

**المدة المقدرة:** 3-4 ساعات
**الصعوبة:** متوسطة

---

## 🎯 الأهداف التعليمية

بعد إكمال هذه التمارين، ستكون قادراً على:
- ✅ إنشاء نظام رفع ملفات متكامل
- ✅ التحقق من أنواع وأحجام الملفات
- ✅ تخزين الملفات في disks مختلفة
- ✅ عرض وحذف وإدارة الملفات
- ✅ استخدام Storage Facade بفعالية
- ✅ معالجة الأخطاء والاستثناءات

---

## التمرين 1: نظام رفع الصور (30 دقيقة)

### المطلوب:

أنشئ نظام بسيط لرفع الصور مع الميزات التالية:
- نموذج رفع صور
- التحقق من نوع الملف (صور فقط)
- الحد الأقصى للحجم 2MB
- عرض الصور المرفوعة في grid
- إمكانية حذف الصور

### المتطلبات:

```
1. Route: GET /gallery
2. Route: POST /gallery/upload
3. Route: DELETE /gallery/delete/{filename}
4. Controller: GalleryController
5. View: gallery.blade.php
```

### معايير التقييم:

- [x] النموذج يعمل بشكل صحيح
- [x] التحقق من الصور فقط (jpeg, png, jpg, gif)
- [x] رسائل خطأ واضحة بالعربية
- [x] الصور تُعرض بشكل جميل
- [x] إمكانية الحذف مع تأكيد

### نصائح:

```php
// استخدم هذا التحقق
'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'

// لعرض الصور
Storage::disk('public')->url($filename)
```

---

## التمرين 2: نظام رفع الوثائق (45 دقيقة)

### المطلوب:

أنشئ نظام لرفع الوثائق (PDF, Word, Excel) مع:
- رفع أنواع متعددة من الملفات
- عرض اسم الملف ونوعه وحجمه وتاريخ الرفع
- تحميل الملفات
- حذف الملفات
- البحث في الملفات

### المتطلبات:

```
1. جدول database: documents
   - id
   - name
   - file_path
   - file_type
   - file_size
   - uploaded_at

2. Model: Document
3. Controller: DocumentController
4. Migration: create_documents_table
```

### معايير التقييم:

- [x] يتم تخزين معلومات الملف في قاعدة البيانات
- [x] يمكن تحميل الملفات
- [x] يمكن البحث في أسماء الملفات
- [x] عرض الحجم بتنسيق مقروء (KB, MB)
- [x] فرز الملفات حسب التاريخ

### Bonus:

- عرض أيقونة مختلفة حسب نوع الملف
- تصنيف الملفات (فواتير، عقود، الخ)

---

## التمرين 3: نظام رفع Avatar للمستخدمين (40 دقيقة)

### المطلوب:

أضف إمكانية رفع صورة شخصية للمستخدمين:
- إضافة حقل `avatar` لجدول users
- صفحة لتعديل الملف الشخصي
- رفع صورة شخصية
- حذف الصورة القديمة عند رفع جديدة
- عرض الصورة الافتراضية إذا لم يرفع المستخدم صورة

### المتطلبات:

```
1. Migration: add avatar to users table
2. Route: GET /profile
3. Route: POST /profile/avatar
4. View: profile.blade.php
```

### معايير التقييم:

- [x] يتم حذف الصورة القديمة تلقائياً
- [x] استخدام اسم فريد للملف
- [x] صورة افتراضية جميلة
- [x] التحقق من أبعاد الصورة (على الأقل 100x100)
- [x] رسائل نجاح واضحة

### كود مساعد:

```php
// Migration
$table->string('avatar')->nullable();

// حذف الصورة القديمة
if (auth()->user()->avatar) {
    Storage::disk('public')->delete(auth()->user()->avatar);
}

// رفع الجديدة
$path = $request->file('avatar')->storeAs(
    'avatars',
    'user_' . auth()->id() . '.' . $request->file('avatar')->extension(),
    'public'
);
```

---

## التمرين 4: معرض صور متقدم (60 دقيقة)

### المطلوب:

أنشئ معرض صور احترافي مع:
- رفع صور متعددة في نفس الوقت
- التحقق من كل صورة
- إنشاء thumbnails (صور مصغرة)
- عرض الصور في modal عند النقر
- تحميل lazy loading للصور
- ترقيم الصفحات

### المتطلبات:

```
1. جدول: photos
   - id
   - title
   - description
   - original_path
   - thumbnail_path
   - created_at

2. استخدم intervention/image لإنشاء thumbnails
```

### تثبيت Intervention Image:

```bash
composer require intervention/image
```

### معايير التقييم:

- [x] رفع متعدد يعمل بشكل صحيح
- [x] إنشاء thumbnails تلقائياً
- [x] modal جميل لعرض الصورة الكاملة
- [x] ترقيم صفحات
- [x] تصميم responsive

### Bonus:

- إضافة فلاتر للصور (أبيض وأسود، Sepia)
- إمكانية تدوير الصور
- ترتيب الصور بـ drag and drop

---

## التمرين 5: نظام تخزين سحابي بسيط (90 دقيقة)

### المطلوب:

أنشئ نظام يشبه Dropbox البسيط:
- رفع ملفات ومجلدات
- إنشاء مجلدات جديدة
- التنقل بين المجلدات
- نقل ونسخ الملفات
- مشاركة الملفات بروابط
- إدارة الصلاحيات

### المتطلبات:

```
1. جدول: folders
   - id
   - name
   - parent_id (للمجلدات الفرعية)
   - user_id

2. جدول: files
   - id
   - name
   - path
   - folder_id
   - user_id
   - is_shared
   - share_token

3. Models مع relationships
```

### الميزات المطلوبة:

```
✓ عرض الملفات والمجلدات في قائمة
✓ إنشاء مجلدات جديدة
✓ رفع ملفات لمجلد محدد
✓ التنقل بين المجلدات (breadcrumb)
✓ نقل ملفات بين المجلدات
✓ مشاركة ملف برابط عام
```

### معايير التقييم:

- [x] هيكل المجلدات يعمل بشكل صحيح
- [x] يمكن التنقل بسهولة
- [x] روابط المشاركة تعمل
- [x] واجهة مستخدم واضحة
- [x] معالجة الأخطاء بشكل صحيح

---

## التمرين 6: ضغط وأرشفة الملفات (45 دقيقة)

### المطلوب:

أضف إمكانية:
- ضغط ملفات متعددة في ملف ZIP
- رفع ملفات ZIP واستخراجها
- تحميل مجلد كامل كـ ZIP
- عرض محتويات ZIP بدون استخراج

### المتطلبات:

```bash
# استخدم ZipArchive من PHP
```

### كود مساعد:

```php
use ZipArchive;

// إنشاء ZIP
$zip = new ZipArchive;
$zipFileName = 'files_' . time() . '.zip';
if ($zip->open(storage_path('app/public/' . $zipFileName), ZipArchive::CREATE) === TRUE) {
    foreach ($files as $file) {
        $zip->addFile(storage_path('app/public/' . $file), basename($file));
    }
    $zip->close();
}

// استخراج ZIP
$zip = new ZipArchive;
if ($zip->open($filePath) === TRUE) {
    $zip->extractTo(storage_path('app/public/extracted'));
    $zip->close();
}
```

### معايير التقييم:

- [x] إنشاء ZIP من ملفات محددة
- [x] استخراج ZIP بنجاح
- [x] تحميل ZIP
- [x] معالجة الأخطاء

---

## التمرين 7: تحسين الأداء (45 دقيقة)

### المطلوب:

حسّن نظام رفع الملفات:
- استخدام queues لمعالجة الصور الكبيرة
- إنشاء thumbnails في الخلفية
- تحسين حجم الصور تلقائياً
- استخدام CDN للملفات الثابتة

### الخطوات:

```bash
# 1. إنشاء Job
php artisan make:job ProcessUploadedImage

# 2. إنشاء جدول jobs
php artisan queue:table
php artisan migrate

# 3. تشغيل queue worker
php artisan queue:work
```

### Job Example:

```php
<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProcessUploadedImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imagePath;

    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function handle()
    {
        $image = Image::make(storage_path('app/public/' . $this->imagePath));

        // تحسين الحجم
        $image->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // إنشاء thumbnail
        $thumbnail = Image::make(storage_path('app/public/' . $this->imagePath));
        $thumbnail->fit(300, 300);

        $thumbnailPath = str_replace('.', '_thumb.', $this->imagePath);

        // حفظ
        $image->save();
        $thumbnail->save(storage_path('app/public/' . $thumbnailPath));
    }
}
```

### معايير التقييم:

- [x] استخدام queues بشكل صحيح
- [x] معالجة الصور في الخلفية
- [x] تحسين الأداء ملحوظ
- [x] معالجة الأخطاء في Jobs

---

## التمرين 8: التحقق المتقدم من الملفات (30 دقيقة)

### المطلوب:

أنشئ Request مخصص للتحقق من الملفات:
- Custom validation rules
- التحقق من MIME type الحقيقي
- فحص الملفات الضارة
- رسائل خطأ مخصصة بالعربية

### الخطوات:

```bash
php artisan make:request FileUploadRequest
```

### Request Example:

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:jpeg,png,jpg,gif,pdf',
                'max:5120',
                function ($attribute, $value, $fail) {
                    // التحقق من MIME type الحقيقي
                    $mimeType = $value->getMimeType();
                    $allowedMimes = [
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                        'application/pdf'
                    ];

                    if (!in_array($mimeType, $allowedMimes)) {
                        $fail('نوع الملف غير مسموح');
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'يرجى اختيار ملف',
            'file.mimes' => 'نوع الملف غير مدعوم. الأنواع المسموحة: JPEG, PNG, GIF, PDF',
            'file.max' => 'حجم الملف كبير جداً. الحد الأقصى 5 ميجابايت',
        ];
    }
}
```

### معايير التقييم:

- [x] استخدام Form Request
- [x] Custom validation rules
- [x] رسائل خطأ بالعربية
- [x] التحقق من MIME type الحقيقي

---

## 🎁 تمرين تحدي (اختياري): نظام إدارة ملفات كامل

### المطلوب:

اجمع كل ما تعلمته وأنشئ نظام إدارة ملفات متكامل يحتوي على:

1. **المستخدمون والصلاحيات:**
   - تسجيل دخول ومصادقة
   - roles (admin, user)
   - صلاحيات مختلفة

2. **إدارة الملفات:**
   - رفع متعدد
   - مجلدات ومجلدات فرعية
   - نقل ونسخ
   - إعادة تسمية
   - مشاركة

3. **معالجة الصور:**
   - تحسين تلقائي
   - thumbnails
   - فلاتر
   - تدوير وقص

4. **البحث والفلترة:**
   - بحث في الأسماء
   - فلتر حسب النوع
   - فلتر حسب التاريخ
   - فلتر حسب الحجم

5. **الأداء:**
   - queues
   - caching
   - pagination
   - lazy loading

6. **الأمان:**
   - التحقق المتقدم
   - فحص الفيروسات (باستخدام ClamAV)
   - rate limiting
   - تشفير الملفات الحساسة

7. **واجهة المستخدم:**
   - drag and drop
   - progress bars
   - modals
   - notifications

### التقييم:

سيتم تقييم:
- جودة الكود
- الأمان
- الأداء
- تجربة المستخدم
- التوثيق

---

## ✅ معايير التسليم

- كود نظيف ومنظم
- comments بالعربية أو الإنجليزية
- اتباع PSR standards
- معالجة الأخطاء بشكل صحيح
- validation شامل
- رسائل واضحة للمستخدم

---

## 📚 مصادر إضافية

- [Laravel File Storage Documentation](https://laravel.com/docs/11.x/filesystem)
- [Intervention Image](http://image.intervention.io/)
- [Laravel Queues](https://laravel.com/docs/11.x/queues)

---

## 🎯 نقاط إضافية (Bonus)

- استخدام TypeScript لجافا سكريبت
- إضافة unit tests
- استخدام Alpine.js أو Vue.js
- responsive design ممتاز
- dark mode
- accessibility (WCAG)

---

**حظاً موفقاً! 🚀**

**تاريخ آخر تحديث:** 2025-11-04
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
