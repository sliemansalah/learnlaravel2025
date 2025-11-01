# Lesson 1: Introduction to Laravel - Full Exam
# الدرس الأول: مقدمة لـ Laravel - الاختبار الكامل

**Total Questions:** 100
**Lesson Topic:** Introduction to Laravel
**Time Limit:** 150 minutes
**Passing Score:** 70/100

---

## Student Information / معلومات الطالب

**Name / الاسم:** ___________________
**Date / التاريخ:** ___________________
**Start Time / وقت البدء:** ___________________
**End Time / وقت الانتهاء:** ___________________

---

## Exam Sections / أقسام الاختبار

| Section | Question Type | Questions | Points |
|---------|--------------|-----------|--------|
| A | Multiple Choice | 40 | 40 |
| B | True/False | 20 | 20 |
| C | Fill in the Blanks | 15 | 15 |
| D | Code Analysis | 10 | 10 |
| E | Find the Bug | 10 | 10 |
| F | Code Completion | 5 | 5 |
| **Total** | | **100** | **100** |

---

# Section A: Multiple Choice (40 Questions)
# القسم أ: اختيار من متعدد

**Instructions:** Choose the best answer for each question.

---

### Q1. What is Laravel?

a) A JavaScript framework
b) A PHP web application framework
c) A database management system
d) A CSS framework

**Answer:** _____

---

### Q2. Who created Laravel?

a) Taylor Otwell
b) Mark Zuckerberg
c) Rasmus Lerdorf
d) Fabien Potencier

**Answer:** _____

---

### Q3. What architectural pattern does Laravel follow?

a) MVP (Model-View-Presenter)
b) MVVM (Model-View-ViewModel)
c) MVC (Model-View-Controller)
d) MVA (Model-View-Adapter)

**Answer:** _____

---

### Q4. Which command creates a new Laravel project?

a) `laravel new project-name`
b) `composer create-project laravel/laravel project-name`
c) Both a and b
d) `npm install laravel`

**Answer:** _____

---

### Q5. What is Composer?

a) A PHP dependency manager
b) A JavaScript package manager
c) A database manager
d) A code editor

**Answer:** _____

---

### Q6. Which file contains environment-specific configuration?

a) `config.php`
b) `.env`
c) `environment.php`
d) `settings.php`

**Answer:** _____

---

### Q7. What command starts the Laravel development server?

a) `php artisan run`
b) `php artisan serve`
c) `php start`
d) `composer serve`

**Answer:** _____

---

### Q8. What is the default port for Laravel development server?

a) 3000
b) 8080
c) 8000
d) 5000

**Answer:** _____

---

### Q9. Which directory contains the application's main code?

a) `src/`
b) `app/`
c) `application/`
d) `code/`

**Answer:** _____

---

### Q10. Where are the routes defined in Laravel?

a) `app/routes/`
b) `routes/`
c) `config/routes/`
d) `resources/routes/`

**Answer:** _____

---

### Q11. What is Artisan?

a) Laravel's command-line interface
b) A database driver
c) A templating engine
d) A testing framework

**Answer:** _____

---

### Q12. Which command lists all Artisan commands?

a) `php artisan help`
b) `php artisan list`
c) `php artisan`
d) Both b and c

**Answer:** _____

---

### Q13. What file is the application entry point?

a) `index.php`
b) `app.php`
c) `public/index.php`
d) `bootstrap/app.php`

**Answer:** _____

---

### Q14. Which directory should be the web server's document root?

a) Root directory
b) `app/`
c) `public/`
d) `resources/`

**Answer:** _____

---

### Q15. What is the purpose of the `vendor/` directory?

a) To store user uploads
b) To store Composer dependencies
c) To store application code
d) To store configuration files

**Answer:** _____

---

### Q16. What file extension do Blade templates use?

a) `.php`
b) `.html`
c) `.blade.php`
d) `.blade`

**Answer:** _____

---

### Q17. Where are Blade templates stored?

a) `app/views/`
b) `resources/views/`
c) `public/views/`
d) `templates/`

**Answer:** _____

---

### Q18. What is the Laravel version installed via `composer create-project` by default?

a) The oldest stable version
b) The latest stable version
c) Version 5.0
d) Version 8.0

**Answer:** _____

---

### Q19. Which command generates the application key?

a) `php artisan key:make`
b) `php artisan key:generate`
c) `php artisan generate:key`
d) `php artisan create:key`

**Answer:** _____

---

### Q20. Where is the application key stored?

a) `config/app.php`
b) `.env` file
c) `bootstrap/app.php`
d) `storage/app/key`

**Answer:** _____

---

### Q21. What is the purpose of the application key?

a) To encrypt data
b) To access the database
c) To run migrations
d) To compile views

**Answer:** _____

---

### Q22. Which directory contains compiled Blade views?

a) `storage/views/`
b) `storage/framework/views/`
c) `cache/views/`
d) `compiled/views/`

**Answer:** _____

---

### Q23. What file lists all Composer packages?

a) `packages.json`
b) `composer.json`
c) `dependencies.json`
d) `vendor.json`

**Answer:** _____

---

### Q24. Which command installs Composer dependencies?

a) `composer update`
b) `composer install`
c) `composer download`
d) `composer get`

**Answer:** _____

---

### Q25. What is the minimum PHP version required for Laravel 12?

a) PHP 7.4
b) PHP 8.0
c) PHP 8.1
d) PHP 8.2

**Answer:** _____

---

### Q26. Which file should NOT be committed to version control?

a) `composer.json`
b) `.env`
c) `routes/web.php`
d) `app/Http/Controllers/Controller.php`

**Answer:** _____

---

### Q27. What command checks Laravel version?

a) `laravel --version`
b) `php artisan --version`
c) `composer show laravel`
d) `php --laravel-version`

**Answer:** _____

---

### Q28. Where are application configuration files stored?

a) `app/config/`
b) `config/`
c) `settings/`
d) `.env`

**Answer:** _____

---

### Q29. What function retrieves environment variables?

a) `getenv()`
b) `env()`
c) `config()`
d) All of the above

**Answer:** _____

---

### Q30. Which directory contains application logs?

a) `logs/`
b) `storage/logs/`
c) `app/logs/`
d) `var/logs/`

**Answer:** _____

---

### Q31. What is the default database for new Laravel 12 projects?

a) MySQL
b) PostgreSQL
c) SQLite
d) MongoDB

**Answer:** _____

---

### Q32. Which Composer command updates all packages?

a) `composer upgrade`
b) `composer update`
c) `composer refresh`
d) `composer renew`

**Answer:** _____

---

### Q33. What is the purpose of `bootstrap/app.php`?

a) To display the homepage
b) To bootstrap the application
c) To store routes
d) To configure database

**Answer:** _____

---

### Q34. Which directory stores user file uploads?

a) `public/uploads/`
b) `storage/app/public/`
c) `uploads/`
d) `files/`

**Answer:** _____

---

### Q35. What command clears application cache?

a) `php artisan cache:delete`
b) `php artisan cache:clear`
c) `php artisan clear:cache`
d) `php artisan remove:cache`

**Answer:** _____

---

### Q36. What does MVC stand for?

a) Model View Controller
b) Main View Component
c) Multiple Version Control
d) Modern Visual Code

**Answer:** _____

---

### Q37. Which component in MVC handles data and business logic?

a) View
b) Model
c) Controller
d) Route

**Answer:** _____

---

### Q38. Which component in MVC handles presentation?

a) Model
b) Controller
c) View
d) Route

**Answer:** _____

---

### Q39. Which component in MVC connects Model and View?

a) Router
b) Middleware
c) Controller
d) Service Provider

**Answer:** _____

---

### Q40. What package manager is used for frontend assets in Laravel?

a) Composer
b) npm or yarn
c) Bower
d) Grunt

**Answer:** _____

---

# Section B: True or False (20 Questions)
# القسم ب: صح أو خطأ

**Instructions:** Write **T** for True or **F** for False.

---

### Q41. Laravel is a PHP framework.

**Answer:** _____

---

### Q42. The `.env` file should be committed to version control.

**Answer:** _____

---

### Q43. Artisan is Laravel's command-line tool.

**Answer:** _____

---

### Q44. Composer is used to manage PHP dependencies.

**Answer:** _____

---

### Q45. The `public/` directory should be the web root.

**Answer:** _____

---

### Q46. Blade is Laravel's templating engine.

**Answer:** _____

---

### Q47. Laravel requires a web server like Apache or Nginx for development.

**Answer:** _____

---

### Q48. The `vendor/` directory should be committed to Git.

**Answer:** _____

---

### Q49. `php artisan serve` starts a development server on port 8000 by default.

**Answer:** _____

---

### Q50. Laravel follows the MVC architectural pattern.

**Answer:** _____

---

### Q51. The application key is used for encryption and security.

**Answer:** _____

---

### Q52. You can run multiple Laravel projects on the same port simultaneously.

**Answer:** _____

---

### Q53. Configuration files are stored in the `config/` directory.

**Answer:** _____

---

### Q54. Laravel can work with multiple database systems.

**Answer:** _____

---

### Q55. The `storage/` directory must be writable.

**Answer:** _____

---

### Q56. `composer install` creates a new Laravel project.

**Answer:** _____

---

### Q57. Routes are defined in the `routes/` directory.

**Answer:** _____

---

### Q58. Laravel 12 requires at least PHP 8.2.

**Answer:** _____

---

### Q59. Blade templates have a `.blade.php` extension.

**Answer:** _____

---

### Q60. The `app/` directory contains the core application code.

**Answer:** _____

---

# Section C: Fill in the Blanks (15 Questions)
# القسم ج: املأ الفراغات

**Instructions:** Complete each statement with the correct word or phrase.

---

### Q61. To create a new Laravel project, you use the command `composer __________ laravel/laravel project-name`.

**Answer:** __________________

---

### Q62. The file `__________` contains environment-specific configuration like database credentials.

**Answer:** __________________

---

### Q63. Laravel's command-line tool is called __________.

**Answer:** __________________

---

### Q64. The command `php artisan __________` starts the development server.

**Answer:** __________________

---

### Q65. Blade templates are stored in the `__________` directory.

**Answer:** __________________

---

### Q66. The `__________` directory should be the web server's document root.

**Answer:** __________________

---

### Q67. To generate the application encryption key, use `php artisan key:__________`.

**Answer:** __________________

---

### Q68. Composer dependencies are stored in the `__________` directory.

**Answer:** __________________

---

### Q69. The MVC pattern consists of Model, View, and __________.

**Answer:** __________________

---

### Q70. Laravel was created by __________ __________.

**Answer:** __________________

---

### Q71. To list all artisan commands, run `php artisan __________`.

**Answer:** __________________

---

### Q72. The application entry point is located at `public/__________`.

**Answer:** __________________

---

### Q73. The function `__________()` retrieves environment variables in Laravel.

**Answer:** __________________

---

### Q74. Compiled Blade views are stored in `storage/framework/__________/`.

**Answer:** __________________

---

### Q75. To clear the application cache, use `php artisan cache:__________`.

**Answer:** __________________

---

# Section D: Code Analysis (10 Questions)
# القسم د: تحليل الكود

**Instructions:** Analyze the code and answer the questions.

---

### Q76. What does this code do?

```php
Route::get('/', function () {
    return view('welcome');
});
```

a) Defines a POST route
b) Defines a GET route that returns the welcome view
c) Creates a new view file
d) Starts the web server

**Answer:** _____

---

### Q77. What will this return?

```php
echo env('APP_NAME');
```

a) The application name from .env file
b) The string "APP_NAME"
c) An error
d) The application version

**Answer:** _____

---

### Q78. What is wrong with this directory structure?

```
my-project/
├── app/
├── public/
│   └── .env
├── routes/
└── vendor/
```

a) Nothing, it's correct
b) .env should be in the root, not in public/
c) vendor/ should be in app/
d) routes/ should be in app/

**Answer:** _____

---

### Q79. What does this command do?

```bash
php artisan
```

a) Starts the server
b) Creates a new project
c) Lists all artisan commands
d) Throws an error

**Answer:** _____

---

### Q80. What is the output of this in a fresh Laravel installation?

```php
echo config('app.name');
```

a) "Laravel"
b) Value from APP_NAME in .env
c) Both a and b are correct
d) An error

**Answer:** _____

---

### Q81. Which statement about this code is true?

```php
return view('users.index');
```

a) It looks for `resources/views/users/index.blade.php`
b) It looks for `app/views/users/index.php`
c) It creates a new view file
d) It redirects to users.index

**Answer:** _____

---

### Q82. What happens when you run this command?

```bash
composer install
```

a) Creates a new Laravel project
b) Installs dependencies listed in composer.json
c) Updates all packages
d) Installs Laravel globally

**Answer:** _____

---

### Q83. What does this artisan command do?

```bash
php artisan serve --port=9000
```

a) Starts server on default port
b) Starts server on port 9000
c) Shows an error
d) Creates 9000 routes

**Answer:** _____

---

### Q84. What is the purpose of this file?

```
// composer.json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0"
    }
}
```

a) Defines JavaScript dependencies
b) Defines PHP dependencies
c) Configures the database
d) Sets environment variables

**Answer:** _____

---

### Q85. What will happen with this .env configuration?

```
APP_DEBUG=true
APP_ENV=production
```

a) Normal production behavior
b) Dangerous: debug mode in production
c) Server won't start
d) Nothing, it's correct for production

**Answer:** _____

---

# Section E: Find the Bug (10 Questions)
# القسم هـ: اكتشف الخطأ

**Instructions:** Identify the bug or error in each code snippet.

---

### Q86. Find the bug:

```bash
composer create laravel/laravel my-project
```

a) Should be `composer install`
b) Should be `composer create-project`
c) laravel should be capitalized
d) No bug, it's correct

**Answer:** _____

---

### Q87. Find the bug:

```php
// Starting the server
php artisan run
```

a) Should be `php artisan serve`
b) Should be `php artisan start`
c) Need to add --port flag
d) No bug

**Answer:** _____

---

### Q88. Find the bug:

```
Project Structure:
my-app/
├── app/
├── public/
│   └── index.html  ← Entry point
└── routes/
```

a) index.html should be index.php
b) public/ folder is wrong
c) routes/ should be in app/
d) No bug

**Answer:** _____

---

### Q89. Find the bug:

```php
// In .env file
APP_KEY=
```

a) APP_KEY is empty (missing key)
b) Should use lowercase
c) Should be APP_SECRET
d) No bug

**Answer:** _____

---

### Q90. Find the bug:

```blade
<!-- resources/views/welcome.php -->
<h1><?php echo $title; ?></h1>
```

a) File extension should be .blade.php
b) Should use {{ $title }} instead
c) Both a and b
d) No bug

**Answer:** _____

---

### Q91. Find the bug:

```bash
# Running Laravel
cd my-project/public
php artisan serve
```

a) Should run from project root, not public/
b) Should use `php index.php`
c) Port is missing
d) No bug

**Answer:** _____

---

### Q92. Find the bug:

```php
// Getting config value
$name = env('app.name');
```

a) Should be `env('APP_NAME')`
b) Should use `config()` instead
c) Both a and b are issues
d) No bug

**Answer:** _____

---

### Q93. Find the bug:

```gitignore
# .gitignore file
/node_modules
/public/hot
/public/storage
/vendor
.env    ← Should this be here?
```

a) .env should NOT be in .gitignore (should commit it)
b) .env SHOULD be in .gitignore (correct)
c) Should ignore composer.json instead
d) Should not ignore /vendor

**Answer:** _____

---

### Q94. Find the bug:

```bash
# Installing dependencies
npm install
composer update
```

a) Should run composer install, not update
b) Should run npm update
c) Order is wrong
d) No bug for fresh setup

**Answer:** _____

---

### Q95. Find the bug:

```php
return view('welcome.blade.php');
```

a) Should be `return view('welcome');` (no extension)
b) File doesn't exist
c) Should use quotes differently
d) No bug

**Answer:** _____

---

# Section F: Code Completion (5 Questions)
# القسم و: إكمال الكود

**Instructions:** Complete the code to make it work correctly.

---

### Q96. Complete this command to create a new Laravel project named "blog":

```bash
composer __________ laravel/laravel blog
```

**Answer:** __________________

---

### Q97. Complete this code to return a view named "home":

```php
Route::get('/', function () {
    return __________ ('home');
});
```

**Answer:** __________________

---

### Q98. Complete this code to get the APP_NAME from environment:

```php
$appName = __________ ('APP_NAME');
```

**Answer:** __________________

---

### Q99. Complete this artisan command to generate the application key:

```bash
php artisan key: __________
```

**Answer:** __________________

---

### Q100. Complete this code to access a config value:

```php
$timezone = __________ ('app.timezone');
```

**Answer:** __________________

---

## End of Exam / نهاية الاختبار

**Total Questions:** 100
**Your Score:** ____ / 100

---

## Answer Key Summary / ملخص الإجابات

### Section A (1-40): _________________________________

### Section B (41-60): _________________________________

### Section C (61-75): _________________________________

### Section D (76-85): _________________________________

### Section E (86-95): _________________________________

### Section F (96-100): _________________________________

---

## Grading Scale / سلم التقييم

- **90-100:** A+ (ممتاز)
- **80-89:** A (ممتاز -)
- **70-79:** B (جيد جداً)
- **60-69:** C (جيد)
- **50-59:** D (مقبول)
- **Below 50:** F (راسب)

---

**Good Luck! / بالتوفيق!** 🚀

**Instructor Signature:** ___________________
**Date Graded:** ___________________
**Final Score:** ___________________
