# Solution 1: نظام رفع الصور الشخصية الأساسي
# Solution 1: Basic Avatar Upload System

## 📖 الوصف | Description

هذا المثال يوضح كيفية رفع وإدارة الصور الشخصية (Avatars) في Laravel.

This example demonstrates how to upload and manage user avatars in Laravel.

## ✨ المميزات | Features

- ✅ رفع صورة شخصية للمستخدم
- ✅ التحقق من نوع وحجم الصورة
- ✅ عرض الصورة الشخصية
- ✅ حذف الصورة الشخصية
- ✅ استبدال الصورة القديمة تلقائياً
- ✅ واجهة مستخدم جميلة ومتجاوبة

## 🚀 كيفية التشغيل | How to Run

### 1. التأكد من وجود قاعدة البيانات
```bash
# قاعدة البيانات SQLite موجودة بالفعل في database/database.sqlite
```

### 2. تشغيل السيرفر
```bash
php artisan serve
```

### 3. زيارة الرابط
```
http://localhost:8000/profile
```

## 📝 الملفات المهمة | Important Files

### 1. Controller
`app/Http/Controllers/ProfileController.php`
- `show()` - عرض صفحة الملف الشخصي
- `updateAvatar()` - رفع/تحديث الصورة الشخصية
- `deleteAvatar()` - حذف الصورة الشخصية

### 2. Model
`app/Models/User.php`
- تم إضافة `avatar` للـ `$fillable`

### 3. Migration
`database/migrations/*_add_avatar_to_users_table.php`
- إضافة عمود `avatar` لجدول `users`

### 4. Routes
`routes/web.php`
```php
Route::get('/profile', [ProfileController::class, 'show']);
Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar']);
Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar']);
```

### 5. View
`resources/views/profile/show.blade.php`
- صفحة عرض الملف الشخصي مع نموذج رفع الصورة

## 🔧 التقنيات المستخدمة | Technologies Used

### Storage Facade
```php
// تخزين الصورة
Storage::disk('public')->put($path, $file);

// حذف الصورة
Storage::disk('public')->delete($path);
```

### File Upload
```php
// استقبال الملف
$file = $request->file('avatar');

// تخزين الملف
$path = $file->store('avatars', 'public');
```

### Validation
```php
$request->validate([
    'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
]);
```

## 📂 هيكل التخزين | Storage Structure

```
storage/
└── app/
    └── public/
        └── avatars/
            ├── random-name-1.jpg
            ├── random-name-2.png
            └── ...

public/
└── storage/ (symbolic link to storage/app/public)
```

## 🎯 ما تعلمناه | What We Learned

1. **رفع الملفات (File Uploads)**
   - استخدام `enctype="multipart/form-data"` في الـ form
   - الحصول على الملف باستخدام `$request->file()`
   - تخزين الملف باستخدام `store()` method

2. **التحقق من الملفات (File Validation)**
   - `image` - التحقق من أن الملف صورة
   - `mimes` - التحقق من نوع الملف
   - `max` - الحجم الأقصى بالكيلوبايت
   - `dimensions` - التحقق من أبعاد الصورة

3. **Storage Facade**
   - `Storage::disk('public')` - للوصول إلى القرص العام
   - `delete()` - لحذف الملفات
   - `exists()` - للتحقق من وجود الملف

4. **Symbolic Links**
   - `php artisan storage:link` - لربط storage بـ public
   - الوصول للملفات عبر `asset('storage/...')`

5. **Best Practices**
   - حذف الصورة القديمة قبل رفع الجديدة
   - استخدام أسماء عشوائية للملفات
   - التحقق من صحة الملفات قبل التخزين
   - تخزين المسار فقط في قاعدة البيانات

## 🔐 معلومات الاختبار | Test Credentials

```
Name: أحمد محمد
Email: ahmed@example.com
Password: password123
```

## 📊 متطلبات الصورة | Image Requirements

- **الأنواع المقبولة:** JPEG, PNG, JPG, GIF
- **الحد الأقصى للحجم:** 2 ميجابايت (2048 KB)
- **الأبعاد الدنيا:** 100x100 بكسل

## 🎨 واجهة المستخدم | UI Features

- تصميم جذاب بألوان متدرجة
- عرض معاينة للصورة الحالية
- رسائل نجاح وخطأ واضحة
- عرض أخطاء التحقق بشكل منظم
- أيقونات تعبيرية لتحسين التجربة
- تصميم متجاوب يعمل على جميع الأجهزة

## 📚 الدرس التالي | Next Lesson

في Solution 2، سنتعلم:
- معالجة الصور (تغيير الحجم، القص)
- إنشاء thumbnails
- رفع عدة ملفات
- استخدام Intervention Image library

## 💡 ملاحظات | Notes

- تم استخدام `User::first()` للتبسيط
- في تطبيق حقيقي، استخدم `auth()->user()`
- تأكد من وجود symbolic link قبل التشغيل
- الصور تُخزن في `storage/app/public/avatars`

---

**تاريخ الإنشاء:** 2025-11-04
**متوافق مع:** Laravel 11.x
