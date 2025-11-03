# Screenshots - لقطات الشاشة
# Screenshots Directory

---

## 📸 الغرض من هذا المجلد

هذا المجلد مخصص لحفظ لقطات الشاشة (Screenshots) التوضيحية للدرس الأول.

---

## 📋 لقطات الشاشة المقترحة

### 1️⃣ **Installation & Setup** (التثبيت والإعداد)

#### `01-composer-version.png`
```bash
composer --version
```
- لقطة شاشة تُظهر إصدار Composer
- للتأكد من تثبيت Composer بنجاح

#### `02-php-version.png`
```bash
php -v
```
- لقطة شاشة تُظهر إصدار PHP
- يجب أن يكون PHP 8.2 أو أحدث

#### `03-laravel-new-project.png`
```bash
composer create-project laravel/laravel my-app
```
- عملية إنشاء مشروع Laravel جديد
- تُظهر progress التثبيت

#### `04-project-structure.png`
- لقطة من VS Code أو IDE
- تُظهر هيكل مجلدات Laravel الكامل

---

### 2️⃣ **Running the Server** (تشغيل السيرفر)

#### `05-artisan-serve.png`
```bash
php artisan serve
```
- Terminal يُظهر رسالة:
  ```
  Laravel development server started: http://127.0.0.1:8000
  ```

#### `06-welcome-page.png`
- متصفح يعرض صفحة Laravel الافتراضية
- URL: http://localhost:8000
- الصفحة الترحيبية بتصميم Laravel الجديد

---

### 3️⃣ **Routes** (المسارات)

#### `07-routes-web-php.png`
- ملف `routes/web.php` مفتوح في المحرر
- يُظهر مثال routes بسيطة

#### `08-route-list.png`
```bash
php artisan route:list
```
- جدول يُظهر جميع الـ routes المُسجلة
- Columns: Method, URI, Name, Action

#### `09-simple-route-output.png`
- متصفح يعرض نتيجة route بسيط
- مثال: "مرحباً بك في Laravel!"

#### `10-route-with-parameter.png`
- متصفح يعرض route مع parameter
- مثال: `/user/ahmed` يعرض "مرحباً أحمد"

---

### 4️⃣ **Views** (العروض)

#### `11-blade-file-structure.png`
- مجلد `resources/views/` في VS Code
- يُظهر ملفات .blade.php

#### `12-simple-blade-view.png`
- ملف blade بسيط مفتوح
- محتوى HTML + Blade syntax

#### `13-blade-variables.png`
- مثال على استخدام `{{ $variable }}` في Blade
- المتصفح يعرض النتيجة

#### `14-blade-loops.png`
- كود Blade يحتوي على @foreach
- المتصفح يعرض القائمة الناتجة

#### `15-layout-example.png`
- ملف Layout (layouts/app.blade.php) مفتوح
- يُظهر @yield و structure كامل

---

### 5️⃣ **Controllers** (المتحكمات)

#### `16-make-controller.png`
```bash
php artisan make:controller UserController
```
- Terminal يُظهر رسالة النجاح:
  ```
  Controller created successfully.
  ```

#### `17-controller-file.png`
- ملف Controller مفتوح في المحرر
- يُظهر namespace, class, methods

#### `18-resource-controller.png`
```bash
php artisan make:controller ProductController --resource
```
- Controller مع جميع الـ methods (index, create, store, ...)

#### `19-route-controller.png`
- ملف `routes/web.php` يُظهر كيفية ربط Route بـ Controller
```php
Route::get('/users', [UserController::class, 'index']);
```

---

### 6️⃣ **Database** (قاعدة البيانات)

#### `20-env-file.png`
- ملف `.env` مفتوح
- يُظهر إعدادات قاعدة البيانات
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
```

#### `21-migrate-command.png`
```bash
php artisan migrate
```
- Terminal يُظهر عملية Migration
- جدول الـ migrations المُنفذة

---

### 7️⃣ **Common Errors** (أخطاء شائعة)

#### `22-404-error.png`
- صفحة 404 في Laravel
- مثال على route غير موجود

#### `23-view-not-found.png`
- رسالة خطأ: "View [welcome] not found"
- كيف تبدو الرسالة في Laravel

#### `24-controller-not-found.png`
- خطأ: "Class 'UserController' not found"
- مثال توضيحي

---

### 8️⃣ **Development Tools** (أدوات التطوير)

#### `25-vscode-laravel.png`
- VS Code مع مشروع Laravel مفتوح
- Extensions موصى بها (Laravel Blade Snippets, ...)

#### `26-postman-test.png`
- Postman يختبر API endpoint
- Request و Response

#### `27-browser-devtools.png`
- متصفح مع DevTools مفتوح
- يُظهر Network tab أو Console

---

## 🎯 كيفية إضافة Screenshots

### الطريقة 1: التقاط لقطات يدوياً

**Windows:**
- `Windows + Shift + S` → اختر المنطقة → احفظ
- أو: `PrtScn` ثم الصق في Paint

**macOS:**
- `Cmd + Shift + 4` → اختر المنطقة
- الصورة تُحفظ على Desktop

**Linux:**
- `Shift + PrtScn` → اختر المنطقة
- أو استخدم `gnome-screenshot`

### الطريقة 2: استخدام أدوات

- **Lightshot** (Windows/macOS): https://app.prntscr.com
- **Snagit** (مدفوع لكن احترافي)
- **ShareX** (Windows - مجاني)

---

## 📐 مواصفات الصور المقترحة

### الحجم:
- **العرض:** 1200-1920 بكسل
- **الارتفاع:** حسب المحتوى
- **التنسيق:** PNG (للجودة) أو JPG

### التسمية:
```
[رقم]-[وصف-قصير].png

أمثلة:
✅ 01-composer-version.png
✅ 06-welcome-page.png
✅ 18-resource-controller.png

❌ screenshot1.png (غير واضح)
❌ صورة.png (استخدم إنجليزي)
```

### الجودة:
- ✅ واضحة وسهلة القراءة
- ✅ Font size مناسب
- ✅ ألوان متباينة
- ✅ لا توجد معلومات حساسة (passwords, tokens, ...)

---

## 🎨 نصائح لالتقاط Screenshots احترافية

### 1️⃣ إعدادات Terminal

```bash
# اجعل الـ font أكبر
# Windows Terminal: Ctrl + Plus
# macOS Terminal: Cmd + Plus

# استخدم theme واضح
# موصى به: Dracula, Nord, One Dark
```

### 2️⃣ إعدادات VS Code

```json
{
  "editor.fontSize": 16,
  "editor.fontFamily": "Fira Code, Consolas",
  "editor.lineHeight": 24,
  "workbench.colorTheme": "One Dark Pro"
}
```

### 3️⃣ Browser

- استخدم Zoom: 100% أو 110%
- أغلق Tabs غير الضرورية
- استخدم Incognito (لإخفاء Extensions)

### 4️⃣ التعليقات التوضيحية

استخدم أدوات مثل:
- **Arrows** (أسهم): لتوجيه الانتباه
- **Boxes** (مربعات): لتحديد أجزاء مهمة
- **Text** (نص): لشرح إضافي

---

## 📂 هيكل المجلد المقترح

```
screenshots/
│
├── 01-installation/
│   ├── 01-composer-version.png
│   ├── 02-php-version.png
│   └── 03-laravel-new-project.png
│
├── 02-first-steps/
│   ├── 04-project-structure.png
│   ├── 05-artisan-serve.png
│   └── 06-welcome-page.png
│
├── 03-routes/
│   ├── 07-routes-web-php.png
│   ├── 08-route-list.png
│   └── ...
│
├── 04-views/
│   └── ...
│
├── 05-controllers/
│   └── ...
│
└── 06-errors/
    └── ...
```

---

## 🔗 استخدام Screenshots في Markdown

### في الملفات التعليمية:

```markdown
## مثال: تشغيل السيرفر

اكتب الأمر التالي:
bash
php artisan serve


النتيجة:

![Laravel Server Started](screenshots/05-artisan-serve.png)

سترى رسالة تخبرك أن السيرفر يعمل على المنفذ 8000.
```

---

## ✅ Checklist للـ Screenshots

قبل حفظ أي screenshot، تأكد:

- [ ] الصورة واضحة وسهلة القراءة
- [ ] Font size مناسب (لا صغير جداً)
- [ ] لا توجد معلومات حساسة
- [ ] اسم الملف وصفي
- [ ] الحجم مناسب (ليس كبير جداً)
- [ ] التنسيق: PNG للكود، JPG للصور العادية

---

## 📝 ملاحظات

### لماذا المجلد فارغ؟

هذا المجلد **اختياري** - يمكن للمتعلم:
1. ✅ الاستعانة بالقائمة أعلاه والتقاط صور أثناء التعلم
2. ✅ تحميل screenshots جاهزة (إذا توفرت)
3. ✅ الاستمرار بدون صور (الدروس نصية كافية)

### متى تُستخدم Screenshots؟

- ✅ للمبتدئين تماماً (تساعد في الفهم)
- ✅ عند توثيق خطوات معقدة
- ✅ لتوضيح الأخطاء وحلولها
- ✅ لعرض واجهات المستخدم

---

## 💡 بدائل للـ Screenshots

### 1️⃣ GIF Animations

استخدم أدوات مثل:
- **ScreenToGif** (Windows)
- **LICEcap** (Cross-platform)
- **Kap** (macOS)

مفيد لـ:
- خطوات متعددة
- تفاعلات UI

### 2️⃣ فيديوهات قصيرة

- **Loom** - تسجيل سريع مع شرح صوتي
- **OBS Studio** - تسجيل احترافي

### 3️⃣ Code Snippets مصورة

استخدم:
- **Carbon** (https://carbon.now.sh)
- **Ray.so** (https://ray.so)

---

## 🎯 الخلاصة

هذا المجلد **مرجع** لك لإضافة screenshots عند الحاجة. ليس إلزامياً، لكنه مفيد جداً للمبتدئين!

**نصيحة:** إذا كنت تتعلم، التقط screenshots لخطواتك - ستكون مرجع مستقبلي لك! 📸

---

**بالتوفيق! 🚀**
