# اختبار المراجعة - الأسئلة الخاطئة فقط
# Re-Exam - Wrong Answers Only

**اسم الطالب / Student Name:** سليمان ماجد سعيد صلاح
**تاريخ الاختبار الأول / First Exam Date:** 11/02/2025
**الدرجة السابقة / Previous Score:** 86/100

---

## معلومات الاختبار / Exam Information

**عدد الأسئلة / Total Questions:** 14
**الأسئلة من الاختبار الأول / Questions from First Exam:**
- Section A: 4 questions
- Section B: 3 questions
- Section C: 2 questions
- Section E: 2 questions
- Section F: 1 question

**الوقت المقترح / Suggested Time:** 20-30 دقيقة

---

## معلومات الطالب / Student Information

**Name / الاسم:** ___________________
**Date / التاريخ:** ___________________
**Start Time / وقت البدء:** ___________________
**End Time / وقت الانتهاء:** ___________________

---

## تعليمات / Instructions

هذا الاختبار يحتوي على الأسئلة التي أجبت عليها بشكل خاطئ في الاختبار الأول.
قم بحل هذه الأسئلة مرة أخرى بعد مراجعة المواضيع المتعلقة بها.

راجع التقرير التفصيلي (Correction-Report-Full.md) لفهم الأخطاء والشرح الكامل.

---

# Section A: Multiple Choice

---

### Q1 (Original Q27). What command checks Laravel version?

a) `laravel --version`
b) `php artisan --version`
c) `composer show laravel`
d) `php --laravel-version`

**إجابتك السابقة / Previous Answer:** a ✗
**الإجابة الصحيحة / Correct Answer:** b

**ملاحظة:** أمر `laravel --version` يستخدم فقط لإنشاء المشاريع الجديدة.

**Answer:** _____

---

### Q2 (Original Q28). Where are application configuration files stored?

a) `app/config/`
b) `config/`
c) `settings/`
d) `.env`

**إجابتك السابقة / Previous Answer:** a ✗
**الإجابة الصحيحة / Correct Answer:** b

**ملاحظة:** المجلد `config/` موجود مباشرة في جذر المشروع، وليس داخل `app/`.

**Answer:** _____

---

### Q3 (Original Q29). What function retrieves environment variables?

a) `getenv()`
b) `env()`
c) `config()`
d) All of the above

**إجابتك السابقة / Previous Answer:** b ✗
**الإجابة الصحيحة / Correct Answer:** d

**ملاحظة:** كنت مترددًا بين b و d. جميع هذه الدوال يمكن استخدامها، لكن `env()` هي الأكثر شيوعاً في Laravel.

**Answer:** _____

---

### Q4 (Original Q33). What is the purpose of `bootstrap/app.php`?

a) To display the homepage
b) To bootstrap the application
c) To store routes
d) To configure database

**إجابتك السابقة / Previous Answer:** a ✗
**الإجابة الصحيحة / Correct Answer:** b

**ملاحظة:** كنت مترددًا بين a و b. "Bootstrap" يعني بدء تشغيل وتهيئة التطبيق.

**Answer:** _____

---

# Section B: True or False

---

### Q5 (Original Q47). Laravel requires a web server like Apache or Nginx for development.

**True** or **False**

**إجابتك السابقة / Previous Answer:** True ✗
**الإجابة الصحيحة / Correct Answer:** False

**الشرح:**
Laravel يأتي مع خادم تطوير مدمج (`php artisan serve`)، لذلك لا تحتاج Apache أو Nginx أثناء التطوير.
هذه الخوادم مطلوبة فقط في بيئة الإنتاج (production).

**Answer:** _____

---

### Q6 (Original Q52). You can run multiple Laravel projects on the same port simultaneously.

**True** or **False**

**إجابتك السابقة / Previous Answer:** True ✗
**الإجابة الصحيحة / Correct Answer:** False

**الشرح:**
لا يمكنك تشغيل مشروعين على نفس المنفذ (port) في نفس الوقت.
كل مشروع يحتاج منفذ مختلف. مثلاً: المشروع الأول على 8000، والثاني على 8001.

**ملاحظة:** كنت غير متأكد من هذه الإجابة.

**Answer:** _____

---

### Q7 (Original Q53). Configuration files are stored in the `config/` directory.

**True** or **False**

**إجابتك السابقة / Previous Answer:** False ✗
**الإجابة الصحيحة / Correct Answer:** True

**الشرح:**
ملفات الإعدادات (Configuration files) موجودة فعلاً في مجلد `config/` في جذر المشروع.
مثل: `config/app.php`, `config/database.php`, إلخ.

**Answer:** _____

---

# Section C: Fill in the Blanks

---

### Q8 (Original Q61). To create a new Laravel project, you use the command:

```bash
composer __________ laravel/laravel project-name
```

**إجابتك السابقة / Previous Answer:** install ✗
**الإجابة الصحيحة / Correct Answer:** create-project

**الشرح:**
- `composer create-project` = إنشاء مشروع جديد
- `composer install` = تثبيت المكتبات من ملف composer.json موجود

**Answer:** __________________

---

### Q9 (Original Q65). Blade templates are stored in the `__________` directory.

**إجابتك السابقة / Previous Answer:** resource/views ✗
**الإجابة الصحيحة / Correct Answer:** resources/views

**ملاحظة:** خطأ إملائي بسيط - الاسم الصحيح هو `resources` (بحرف s).

**Answer:** __________________

---

# Section E: Find the Bug

---

### Q10 (Original Q86). Find the bug in this command:

```bash
composer create laravel/laravel my-project
```

a) Should be `composer install`
b) Should be `composer create-project`
c) laravel should be capitalized
d) No bug, it's correct

**إجابتك السابقة / Previous Answer:** a ✗
**الإجابة الصحيحة / Correct Answer:** b

**الشرح:**
الأمر الصحيح هو `composer create-project` وليس `composer create`.

**ملاحظة:** كنت غير متأكد من هذه الإجابة.

**Answer:** _____

---

### Q11 (Original Q92). Find the bug in this code:

```php
// Getting config value
$name = env('app.name');
```

a) Should be `env('APP_NAME')`
b) Should use `config()` instead
c) Both a and b are issues
d) No bug

**إجابتك السابقة / Previous Answer:** a
**الإجابة الأفضل / Better Answer:** c

**الشرح:**
هناك مشكلتان:
1. متغيرات البيئة في `.env` تكون بأحرف كبيرة: `APP_NAME` وليس `app.name`
2. للوصول إلى قيم الإعدادات، استخدم `config('app.name')` بدلاً من `env('APP_NAME')`
3. استخدم `env()` فقط في ملفات الإعدادات (`config/`)، واستخدم `config()` في باقي الكود

**Answer:** _____

---

### Q12 (Original Q94). Find the bug in this fresh setup:

```bash
# Installing dependencies
npm install
composer update
```

a) Should run composer install, not update
b) Should run npm update
c) Order is wrong
d) No bug for fresh setup

**إجابتك السابقة / Previous Answer:** a ✗
**الإجابة الصحيحة / Correct Answer:** d

**الشرح:**
في الإعداد الأول (fresh setup)، لا يوجد خطأ.
ولكن الأفضل استخدام `composer install` في المشاريع الموجودة للحفاظ على نفس الإصدارات.
`composer update` يقوم بتحديث جميع المكتبات لأحدث إصدار.

**Answer:** _____

---

# Section F: Code Completion

---

### Q13 (Original Q96). Complete this command to create a new Laravel project named "blog":

```bash
composer __________ laravel/laravel blog
```

**إجابتك السابقة / Previous Answer:** install ✗
**الإجابة الصحيحة / Correct Answer:** create-project

**ملاحظة:** نفس الخطأ في Q8 (Q61 الأصلي).

**Answer:** __________________

---

### Q14 (Original Q100). Complete this code to access a config value:

```php
$timezone = __________ ('app.timezone');
```

**إجابتك السابقة / Previous Answer:** env
**الإجابة الأفضل / Better Answer:** config

**الشرح:**
- استخدم `config()` للوصول إلى قيم الإعدادات من مجلد `config/`
- استخدم `env()` فقط داخل ملفات الإعدادات (`config/`)

مثال:
```php
// ✓ صحيح
$timezone = config('app.timezone');

// ✗ ليس الأفضل (استخدم env فقط في ملفات config/)
$timezone = env('APP_TIMEZONE');
```

**Answer:** __________________

---

## نهاية الاختبار / End of Re-Exam

**Your Score:** ____ / 14

---

## ملخص المواضيع المطلوب مراجعتها / Topics to Review

### 1. أوامر Composer
- الفرق بين `create-project`, `install`, و `update`
- متى تستخدم كل أمر

### 2. بنية مجلدات Laravel
- `config/` موجود في الجذر مباشرة
- `resources/views` (وليس resource)
- `app/` لا يحتوي على `config/`

### 3. دوال Laravel
- `env()` للوصول لمتغيرات البيئة (استخدمه فقط في ملفات config/)
- `config()` للوصول لقيم الإعدادات (استخدمه في بقية الكود)
- الفرق بينهما ومتى تستخدم كل واحدة

### 4. متطلبات التطوير
- Laravel له خادم تطوير مدمج (`php artisan serve`)
- لا يحتاج Apache/Nginx للتطوير
- كل مشروع يحتاج منفذ (port) مختلف

### 5. Bootstrap في Laravel
- `bootstrap/app.php` يقوم ببدء تشغيل التطبيق
- ليس له علاقة بعرض الصفحة الرئيسية

---

## مصادر للمراجعة / Resources for Review

1. **Laravel Documentation - Installation**
   https://laravel.com/docs/installation

2. **Laravel Documentation - Configuration**
   https://laravel.com/docs/configuration

3. **Laravel Documentation - Directory Structure**
   https://laravel.com/docs/structure

4. **Composer Documentation**
   https://getcomposer.org/doc/

---

## ملاحظات مهمة / Important Notes

✓ ركز على الفرق بين `env()` و `config()`
✓ احفظ أوامر Composer الأساسية
✓ تأكد من أسماء المجلدات الصحيحة
✓ افهم الفرق بين development و production

**بالتوفيق! / Good Luck!** 🚀

---

**تاريخ إنشاء الاختبار / Exam Created:** 11/02/2025
**الهدف / Goal:** مراجعة وتحسين نقاط الضعف
