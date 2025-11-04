# أمثلة الكود - رفع الملفات والتخزين
# Code Examples - File Uploads and Storage

---

## 📋 نظرة عامة | Overview

هذا المجلد يحتوي على أمثلة عملية لرفع الملفات والتخزين في Laravel.

---

## 📁 الملفات | Files

### 1. `example-01-basic-upload.php`
**الوصف:** مثال بسيط لرفع ملف واحد
- نموذج رفع ملف
- التحقق الأساسي
- حفظ الملف في storage
- عرض رسالة نجاح

**المفاهيم:**
- Request validation
- `$request->file()`
- `store()` method
- Flash messages

---

### 2. `example-02-image-upload.php`
**الوصف:** رفع الصور مع التحقق المتقدم
- التحقق من نوع الصورة
- التحقق من الحجم والأبعاد
- تخزين في public disk
- عرض الصورة المرفوعة

**المفاهيم:**
- Image validation rules
- `storeAs()` method
- Storage::url()
- Public disk

---

### 3. `example-03-multiple-upload.php`
**الوصف:** رفع ملفات متعددة
- رفع أكثر من ملف في نفس الوقت
- التحقق من كل ملف
- حفظ كل الملفات
- عرض جميع الملفات

**المفاهيم:**
- Multiple file input
- Array validation
- Loop through files
- Batch upload

---

### 4. `example-04-storage-operations.php`
**الوصف:** عمليات Storage Facade
- إنشاء وحفظ ملفات
- قراءة محتوى ملف
- نسخ ونقل ملفات
- حذف ملفات ومجلدات
- الحصول على معلومات الملفات

**المفاهيم:**
- Storage::put()
- Storage::get()
- Storage::copy()
- Storage::move()
- Storage::delete()
- Storage::size()
- Storage::exists()

---

### 5. `example-05-file-manager.php`
**الوصف:** نظام إدارة ملفات متكامل
- رفع ملفات
- عرض قائمة الملفات
- تحميل الملفات
- حذف الملفات
- البحث في الملفات

**المفاهيم:**
- Full CRUD operations
- File download
- Search functionality
- File listing

---

### 6. `upload-form.blade.php`
**الوصف:** نموذج HTML لرفع الملفات
- Form مع enctype صحيح
- CSRF protection
- عرض الأخطاء
- التصميم responsive

---

## 🚀 كيفية الاستخدام | How to Use

### الخطوة 1: نسخ الكود
انسخ الكود من الملف المطلوب

### الخطوة 2: إنشاء Route
أضف route في `routes/web.php`

### الخطوة 3: إنشاء Controller
أنشئ controller وألصق الكود

### الخطوة 4: إنشاء View
أنشئ view file إذا لزم الأمر

### الخطوة 5: التجربة
افتح المتصفح وجرّب الكود

---

## 📝 ملاحظات | Notes

- جميع الأمثلة جاهزة للاستخدام
- يمكنك تعديلها حسب احتياجاتك
- تأكد من تشغيل `php artisan storage:link` قبل التجربة
- راجع comments في الكود للشرح التفصيلي

---

## 🔗 روابط مفيدة | Useful Links

- [Laravel File Storage Documentation](https://laravel.com/docs/11.x/filesystem)
- [Validation Rules](https://laravel.com/docs/11.x/validation#available-validation-rules)
- [Request Files](https://laravel.com/docs/11.x/requests#files)

---

**تاريخ آخر تحديث:** 2025-11-04
**متوافق مع:** Laravel 11.x
