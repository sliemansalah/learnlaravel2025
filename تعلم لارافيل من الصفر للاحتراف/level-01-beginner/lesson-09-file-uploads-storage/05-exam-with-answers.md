# الدرس 9: الاختبار النهائي مع الإجابات - رفع الملفات والتخزين
# Lesson 9: Final Exam with Answers - File Uploads and Storage

---

## 📋 معلومات الاختبار | Exam Information

**المدة:** 60 دقيقة
**عدد الأسئلة:** 40 سؤال
**الدرجة الكاملة:** 100 نقطة
**درجة النجاح:** 70%

---

## القسم الأول: أسئلة الاختيار من متعدد (40 نقطة)

### السؤال 1 (2 نقطة)
ما هو الأمر المستخدم لإنشاء رابط رمزي (symbolic link) لمجلد التخزين؟

- a) `php artisan storage:create`
- b) `php artisan make:storage`
- c) `php artisan storage:link` ✅
- d) `php artisan link:storage`

**الإجابة الصحيحة: c**

**الشرح:** الأمر `php artisan storage:link` ينشئ رابطاً رمزياً من `public/storage` إلى `storage/app/public`، مما يسمح بالوصول للملفات المخزنة عبر المتصفح.

---

### السؤال 2 (2 نقطة)
أي attribute يجب إضافته لنموذج HTML عند رفع الملفات؟

- a) `method="multipart"`
- b) `enctype="multipart/form-data"` ✅
- c) `type="file-upload"`
- d) `accept="files"`

**الإجابة الصحيحة: b**

**الشرح:** يجب إضافة `enctype="multipart/form-data"` لعنصر form لكي يتمكن من إرسال الملفات.

---

### السؤال 3 (2 نقطة)
كيف تحصل على الملف المرفوع من Request؟

- a) `$request->get('file')`
- b) `$request->input('file')`
- c) `$request->file('file')` ✅
- d) `$request->upload('file')`

**الإجابة الصحيحة: c**

**الشرح:** method `file()` في Request object يُستخدم للحصول على الملفات المرفوعة.

---

### السؤال 4 (2 نقطة)
ما هو validation rule الصحيح للتحقق من أن الملف صورة؟

- a) `'file' => 'image'` ✅
- b) `'file' => 'is_image'`
- c) `'file' => 'type:image'`
- d) `'file' => 'picture'`

**الإجابة الصحيحة: a**

**الشرح:** rule `image` يتحقق من أن الملف المرفوع هو صورة (jpeg, png, bmp, gif, svg, webp).

---

### السؤال 5 (2 نقطة)
كيف تحدد الحد الأقصى لحجم الملف بـ 2 ميجابايت؟

- a) `'file' => 'size:2mb'`
- b) `'file' => 'max:2048'` ✅
- c) `'file' => 'max_size:2'`
- d) `'file' => 'limit:2048'`

**الإجابة الصحيحة: b**

**الشرح:** rule `max` يحدد الحد الأقصى للحجم بالكيلوبايت، لذا 2MB = 2048KB.

---

### السؤال 6 (2 نقطة)
ما هي الطريقة الصحيحة لحفظ ملف في storage؟

- a) `$file->save('path')`
- b) `$file->store('path')` ✅
- c) `$file->upload('path')`
- d) `$file->put('path')`

**الإجابة الصحيحة: b**

**الشرح:** method `store()` تحفظ الملف وتُرجع المسار الكامل للملف المحفوظ.

---

### السؤال 7 (2 نقطة)
كيف تحفظ ملف مع اسم محدد؟

- a) `$file->store('path', 'filename')`
- b) `$file->save('path/filename')`
- c) `$file->storeAs('path', 'filename')` ✅
- d) `$file->saveAs('path', 'filename')`

**الإجابة الصحيحة: c**

**الشرح:** method `storeAs()` تسمح بتحديد اسم الملف عند الحفظ.

---

### السؤال 8 (2 نقطة)
ما هو disk التخزين الافتراضي في Laravel؟

- a) public
- b) s3
- c) local ✅
- d) cloud

**الإجابة الصحيحة: c**

**الشرح:** `local` هو disk التخزين الافتراضي، ويخزن الملفات في `storage/app`.

---

### السؤال 9 (2 نقطة)
كيف تحدد disk التخزين عند حفظ ملف؟

- a) `$file->store('path', 'public')` ✅
- b) `$file->disk('public')->store('path')`
- c) `$file->saveToDisk('public', 'path')`
- d) `$file->setDisk('public')->store('path')`

**الإجابة الصحيحة: a**

**الشرح:** المعامل الثاني في `store()` يحدد disk التخزين.

---

### السؤال 10 (2 نقطة)
ما هو validation rule للتحقق من أنواع ملفات محددة؟

- a) `'file' => 'types:pdf,docx'`
- b) `'file' => 'mimes:pdf,docx'` ✅
- c) `'file' => 'extensions:pdf,docx'`
- d) `'file' => 'mime_types:pdf,docx'`

**الإجابة الصحيحة: b**

**الشرح:** rule `mimes` يحدد أنواع MIME المسموح بها.

---

### السؤال 11 (2 نقطة)
كيف تحصل على اسم الملف الأصلي؟

- a) `$file->name()`
- b) `$file->originalName()`
- c) `$file->getClientOriginalName()` ✅
- d) `$file->getOriginalFilename()`

**الإجابة الصحيحة: c**

**الشرح:** method `getClientOriginalName()` ترجع اسم الملف الأصلي من جهاز العميل.

---

### السؤال 12 (2 نقطة)
كيف تحصل على امتداد الملف؟

- a) `$file->ext()`
- b) `$file->extension()` ✅
- c) `$file->getExtension()`
- d) `$file->type()`

**الإجابة الصحيحة: b**

**الشرح:** method `extension()` ترجع امتداد الملف (بدون النقطة).

---

### السؤال 13 (2 نقطة)
ما هو الـ Facade المستخدم للتعامل مع التخزين؟

- a) `File`
- b) `Storage` ✅
- c) `FileSystem`
- d) `Disk`

**الإجابة الصحيحة: b**

**الشرح:** `Storage` facade يوفر واجهة للتعامل مع أنظمة التخزين المختلفة.

---

### السؤال 14 (2 نقطة)
كيف تتحقق من وجود ملف في storage؟

- a) `Storage::has('file.txt')`
- b) `Storage::exists('file.txt')` ✅
- c) `Storage::check('file.txt')`
- d) `Storage::fileExists('file.txt')`

**الإجابة الصحيحة: b**

**الشرح:** method `exists()` تتحقق من وجود ملف في التخزين.

---

### السؤال 15 (2 نقطة)
كيف تحذف ملف من storage؟

- a) `Storage::remove('file.txt')`
- b) `Storage::delete('file.txt')` ✅
- c) `Storage::destroy('file.txt')`
- d) `Storage::unlink('file.txt')`

**الإجابة الصحيحة: b**

**الشرح:** method `delete()` تحذف ملف أو مصفوفة من الملفات.

---

### السؤال 16 (2 نقطة)
كيف تحصل على URL لملف في public disk؟

- a) `Storage::path('file.txt')`
- b) `Storage::link('file.txt')`
- c) `Storage::url('file.txt')` ✅
- d) `Storage::getUrl('file.txt')`

**الإجابة الصحيحة: c**

**الشرح:** method `url()` ترجع URL للوصول للملف عبر الويب.

---

### السؤال 17 (2 نقطة)
كيف تقرأ محتويات ملف من storage؟

- a) `Storage::read('file.txt')`
- b) `Storage::get('file.txt')` ✅
- c) `Storage::content('file.txt')`
- d) `Storage::load('file.txt')`

**الإجابة الصحيحة: b**

**الشرح:** method `get()` تقرأ وترجع محتويات الملف.

---

### السؤال 18 (2 نقطة)
كيف تحفظ محتوى نصي في ملف؟

- a) `Storage::write('file.txt', 'content')`
- b) `Storage::save('file.txt', 'content')`
- c) `Storage::put('file.txt', 'content')` ✅
- d) `Storage::store('file.txt', 'content')`

**الإجابة الصحيحة: c**

**الشرح:** method `put()` تحفظ محتوى في ملف (تُنشئه إذا لم يكن موجوداً).

---

### السؤال 19 (2 نقطة)
كيف تنسخ ملف في storage؟

- a) `Storage::duplicate('old.txt', 'new.txt')`
- b) `Storage::copy('old.txt', 'new.txt')` ✅
- c) `Storage::clone('old.txt', 'new.txt')`
- d) `Storage::replicate('old.txt', 'new.txt')`

**الإجابة الصحيحة: b**

**الشرح:** method `copy()` تنسخ ملف من موقع لآخر.

---

### السؤال 20 (2 نقطة)
كيف تنقل ملف في storage؟

- a) `Storage::transfer('old.txt', 'new.txt')`
- b) `Storage::relocate('old.txt', 'new.txt')`
- c) `Storage::move('old.txt', 'new.txt')` ✅
- d) `Storage::rename('old.txt', 'new.txt')`

**الإجابة الصحيحة: c**

**الشرح:** method `move()` تنقل ملف من موقع لآخر (تحذفه من الموقع القديم).

---

## القسم الثاني: أسئلة صح أو خطأ (20 نقطة)

### السؤال 21 (2 نقطة)
يمكن رفع ملفات متعددة في نفس الوقت باستخدام Laravel.

**الإجابة: صح ✅**

**الشرح:** يمكن استخدام `multiple` attribute في input وحلقة على الملفات في Controller.

---

### السؤال 22 (2 نقطة)
يتم تخزين الملفات في مجلد `public` بشكل افتراضي.

**الإجابة: خطأ ❌**

**الشرح:** يتم التخزين في `storage/app` بشكل افتراضي (local disk).

---

### السؤال 23 (2 نقطة)
يجب إنشاء symbolic link لعرض الملفات من public disk.

**الإجابة: صح ✅**

**الشرح:** الأمر `php artisan storage:link` ضروري لإنشاء رابط من `public/storage` إلى `storage/app/public`.

---

### السؤال 24 (2 نقطة)
validation rule `image` يقبل ملفات PDF.

**الإجابة: خطأ ❌**

**الشرح:** rule `image` يقبل الصور فقط (jpeg, png, bmp, gif, svg, webp).

---

### السؤال 25 (2 نقطة)
يمكن تخزين الملفات على Amazon S3 باستخدام Laravel.

**الإجابة: صح ✅**

**الشرح:** Laravel يدعم Amazon S3 كـ disk تخزين بعد تثبيت `league/flysystem-aws-s3-v3`.

---

### السؤال 26 (2 نقطة)
method `storeAs()` تولد اسم ملف عشوائي تلقائياً.

**الإجابة: خطأ ❌**

**الشرح:** `storeAs()` تستخدم الاسم المحدد، بينما `store()` تولد اسماً عشوائياً.

---

### السؤال 27 (2 نقطة)
يمكن استخدام Storage facade لحذف مجلدات كاملة.

**الإجابة: صح ✅**

**الشرح:** `Storage::deleteDirectory('folder')` تحذف مجلداً وكل محتوياته.

---

### السؤال 28 (2 نقطة)
الحد الأقصى لحجم الملف في validation يُحدد بالميجابايت.

**الإجابة: خطأ ❌**

**الشرح:** يُحدد بالكيلوبايت، لذا 2MB = 2048KB.

---

### السؤال 29 (2 نقطة)
يمكن الحصول على حجم الملف باستخدام `Storage::size()`.

**الإجابة: صح ✅**

**الشرح:** `Storage::size('file.txt')` ترجع حجم الملف بالبايت.

---

### السؤال 30 (2 نقطة)
Laravel يقوم تلقائياً بفحص الملفات من الفيروسات.

**الإجابة: خطأ ❌**

**الشرح:** يجب دمج أداة خارجية مثل ClamAV لفحص الفيروسات.

---

## القسم الثالث: أسئلة إكمال الكود (30 نقطة)

### السؤال 31 (5 نقاط)
أكمل الكود التالي لرفع صورة وحفظها في مجلد `avatars` على public disk:

```php
public function uploadAvatar(Request $request)
{
    $request->validate([
        'avatar' => '_______________' // أكمل validation
    ]);

    $file = $request->_______('avatar');

    $path = $file->_______(
        '_______',
        'user_' . auth()->id() . '.' . $file->extension(),
        '_______'
    );

    return back()->with('success', 'تم رفع الصورة!');
}
```

**الإجابة:**

```php
public function uploadAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|max:2048' // أو أي validation مناسب
    ]);

    $file = $request->file('avatar');

    $path = $file->storeAs(
        'avatars',
        'user_' . auth()->id() . '.' . $file->extension(),
        'public'
    );

    return back()->with('success', 'تم رفع الصورة!');
}
```

---

### السؤال 32 (5 نقاط)
أكمل الكود لعرض الملفات وحذفها:

```php
public function index()
{
    $files = Storage::____('public')->______();
    return view('files', compact('files'));
}

public function delete($filename)
{
    if (Storage::disk('public')->______($filename)) {
        Storage::disk('public')->______($filename);
        return back()->with('success', 'تم الحذف!');
    }
    return back()->with('error', 'الملف غير موجود!');
}
```

**الإجابة:**

```php
public function index()
{
    $files = Storage::disk('public')->files();
    return view('files', compact('files'));
}

public function delete($filename)
{
    if (Storage::disk('public')->exists($filename)) {
        Storage::disk('public')->delete($filename);
        return back()->with('success', 'تم الحذف!');
    }
    return back()->with('error', 'الملف غير موجود!');
}
```

---

### السؤال 33 (5 نقاط)
أكمل Form لرفع الملفات:

```blade
<form action="{{ route('upload') }}" method="POST" ________="____________">
    @csrf

    <input type="____" name="file" ________>

    <button type="submit">رفع</button>
</form>
```

**الإجابة:**

```blade
<form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="file" name="file" required>

    <button type="submit">رفع</button>
</form>
```

---

### السؤال 34 (5 نقاط)
أكمل الكود لرفع ملفات متعددة:

```php
public function uploadMultiple(Request $request)
{
    $request->validate([
        'files.*' => '___________________'
    ]);

    foreach ($request->______('files') as $file) {
        $file->______('uploads', 'public');
    }

    return back()->with('success', 'تم رفع الملفات!');
}
```

**الإجابة:**

```php
public function uploadMultiple(Request $request)
{
    $request->validate([
        'files.*' => 'required|file|max:2048' // أو validation مناسب
    ]);

    foreach ($request->file('files') as $file) {
        $file->store('uploads', 'public');
    }

    return back()->with('success', 'تم رفع الملفات!');
}
```

---

### السؤال 35 (5 نقاط)
أكمل الكود لنسخ ونقل ملف:

```php
// نسخ ملف
Storage::______('old/file.txt', 'new/file.txt');

// نقل ملف
Storage::______('old/file.txt', 'new/file.txt');

// حذف مجلد
Storage::______________('folder');

// الحصول على حجم ملف
$size = Storage::______('file.txt');
```

**الإجابة:**

```php
// نسخ ملف
Storage::copy('old/file.txt', 'new/file.txt');

// نقل ملف
Storage::move('old/file.txt', 'new/file.txt');

// حذف مجلد
Storage::deleteDirectory('folder');

// الحصول على حجم ملف
$size = Storage::size('file.txt');
```

---

### السؤال 36 (5 نقاط)
أكمل الكود لعرض صورة في Blade:

```blade
@foreach($images as $image)
    <img src="{{ Storage::____('public')->___($image) }}"
         alt="صورة">
@endforeach
```

**الإجابة:**

```blade
@foreach($images as $image)
    <img src="{{ Storage::disk('public')->url($image) }}"
         alt="صورة">
@endforeach
```

---

## القسم الرابع: أسئلة مقالية (10 نقاط)

### السؤال 37 (3 نقاط)
اشرح الفرق بين `store()` و `storeAs()`.

**الإجابة:**

- **`store()`**: تحفظ الملف مع اسم عشوائي تولده Laravel تلقائياً. مفيدة عندما لا تحتاج للتحكم في اسم الملف.

```php
$path = $file->store('uploads', 'public');
// النتيجة: uploads/kd8f7sdkf8sdf.jpg
```

- **`storeAs()`**: تحفظ الملف مع اسم محدد تختاره أنت. مفيدة عندما تريد التحكم الكامل في اسم الملف.

```php
$path = $file->storeAs('uploads', 'avatar.jpg', 'public');
// النتيجة: uploads/avatar.jpg
```

---

### السؤال 38 (3 نقاط)
ما هي فوائد استخدام Storage Facade بدلاً من PHP file functions؟

**الإجابة:**

1. **Abstraction**: واجهة موحدة للتعامل مع أنظمة تخزين مختلفة (local, S3, FTP)
2. **Flexibility**: يمكن تغيير نظام التخزين من الإعدادات دون تغيير الكود
3. **Testing**: سهولة عمل mock في الاختبارات
4. **Features**: ميزات إضافية مثل visibility, metadata, streaming
5. **Security**: معالجة آمنة للملفات والمسارات

---

### السؤال 39 (2 نقطة)
اذكر ثلاثة validation rules مفيدة للملفات.

**الإجابة:**

1. **`image`**: التحقق من أن الملف صورة
2. **`mimes:pdf,docx`**: تحديد أنواع MIME المسموح بها
3. **`max:2048`**: تحديد الحد الأقصى للحجم (بالكيلوبايت)
4. **`dimensions:min_width=100,min_height=100`**: التحقق من أبعاد الصورة (bonus)

---

### السؤال 40 (2 نقطة)
كيف تحمي تطبيقك من رفع ملفات ضارة؟

**الإجابة:**

1. **Validation**: استخدام validation rules قوية للتحقق من النوع والحجم
2. **MIME Type Check**: التحقق من MIME type الحقيقي وليس الامتداد فقط
3. **File Scanning**: دمج أداة فحص فيروسات مثل ClamAV
4. **Storage Location**: تخزين الملفات خارج المجلد العام
5. **Rename Files**: إعادة تسمية الملفات لمنع تنفيذ كود ضار
6. **Limit Extensions**: السماح فقط بامتدادات محددة وآمنة

---

## 📊 مفتاح التصحيح

| القسم | عدد الأسئلة | الدرجة |
|-------|-------------|--------|
| اختيار من متعدد | 20 | 40 |
| صح وخطأ | 10 | 20 |
| إكمال الكود | 6 | 30 |
| مقالية | 4 | 10 |
| **المجموع** | **40** | **100** |

---

## 🎯 تقييم الأداء

- **90-100**: ممتاز 🏆
- **80-89**: جيد جداً ⭐
- **70-79**: جيد ✓
- **أقل من 70**: يحتاج مراجعة 📚

---

**حظاً موفقاً! 🚀**

**تاريخ آخر تحديث:** 2025-11-04
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
