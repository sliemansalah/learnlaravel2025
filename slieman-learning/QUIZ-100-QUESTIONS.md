# Laravel Quiz - 100 Multiple Choice Questions
# اختبار Laravel - 100 سؤال اختيار من متعدد
# Lessons 1-3 / الدروس 1-3

**Student Name / اسم الطالب:** ___________________

**Date / التاريخ:** ___________________

**Time Limit / الوقت المحدد:** 120 minutes / دقيقة

---

## Instructions / التعليمات

- Total Questions: 100 / إجمالي الأسئلة: 100
- Each question has 4 options (a, b, c, d)
- Only ONE answer is correct
- Write your answer (a, b, c, or d) in the space provided
- No negative marking / لا يوجد خصم على الإجابات الخاطئة
- Good luck! / بالتوفيق!

---

# Part 1: Laravel Basics (Questions 1-30)
# القسم الأول: أساسيات Laravel

### Q1. What is Laravel?
**س1.** ما هو Laravel؟

a) A JavaScript framework
b) A PHP web application framework
c) A database management system
d) A text editor

**Your Answer:** _____

---

### Q2. Which command is used to create a new Laravel project?
**س2.** ما الأمر المستخدم لإنشاء مشروع Laravel جديد؟

a) `php artisan new project`
b) `composer create-project laravel/laravel project-name`
c) `npm install laravel`
d) `laravel install project`

**Your Answer:** _____

---

### Q3. What is the purpose of the `.env` file in Laravel?
**س3.** ما الغرض من ملف `.env` في Laravel؟

a) To store routes
b) To store environment-specific configuration
c) To store views
d) To store controllers

**Your Answer:** _____

---

### Q4. Which file contains the main application configuration?
**س4.** أي ملف يحتوي على إعدادات التطبيق الرئيسية؟

a) `config/app.php`
b) `routes/web.php`
c) `bootstrap/app.php`
d) `.env`

**Your Answer:** _____

---

### Q5. What command starts the Laravel development server?
**س5.** ما الأمر الذي يشغل خادم التطوير في Laravel؟

a) `php artisan run`
b) `php artisan serve`
c) `php artisan start`
d) `composer serve`

**Your Answer:** _____

---

### Q6. What is the default port for Laravel development server?
**س6.** ما المنفذ الافتراضي لخادم التطوير في Laravel؟

a) 3000
b) 8080
c) 8000
d) 5000

**Your Answer:** _____

---

### Q7. Which directory contains the application's controllers?
**س7.** أي مجلد يحتوي على controllers التطبيق؟

a) `app/Models`
b) `app/Http/Controllers`
c) `resources/controllers`
d) `app/Controllers`

**Your Answer:** _____

---

### Q8. What is the purpose of the `artisan` command?
**س8.** ما الغرض من أمر `artisan`؟

a) To manage database only
b) To create views only
c) Laravel's command-line tool for various tasks
d) To start the server only

**Your Answer:** _____

---

### Q9. Which directory contains Blade template files?
**س9.** أي مجلد يحتوي على ملفات Blade templates؟

a) `app/views`
b) `resources/views`
c) `public/views`
d) `storage/views`

**Your Answer:** _____

---

### Q10. What is the file extension for Blade templates?
**س10.** ما امتداد ملفات Blade templates؟

a) `.html`
b) `.php`
c) `.blade.php`
d) `.blade`

**Your Answer:** _____

---

### Q11. Which command generates the application key?
**س11.** ما الأمر الذي ينشئ مفتاح التطبيق؟

a) `php artisan key:make`
b) `php artisan key:generate`
c) `php artisan generate:key`
d) `php artisan create:key`

**Your Answer:** _____

---

### Q12. Where is the application key stored?
**س12.** أين يُخزن مفتاح التطبيق؟

a) `config/app.php`
b) `.env` file as `APP_KEY`
c) `bootstrap/cache`
d) `storage/app`

**Your Answer:** _____

---

### Q13. What is Composer in Laravel context?
**س13.** ما هو Composer في سياق Laravel؟

a) A music application
b) PHP dependency manager
c) A database tool
d) A testing framework

**Your Answer:** _____

---

### Q14. Which file lists all Composer dependencies?
**س14.** أي ملف يسرد جميع اعتماديات Composer؟

a) `package.json`
b) `composer.json`
c) `dependencies.json`
d) `vendor.json`

**Your Answer:** _____

---

### Q15. What is the purpose of the `vendor` directory?
**س15.** ما الغرض من مجلد `vendor`؟

a) To store user uploads
b) To store Composer dependencies
c) To store application code
d) To store configuration files

**Your Answer:** _____

---

### Q16. Which directory should be web-accessible?
**س16.** أي مجلد يجب أن يكون متاحاً للويب؟

a) `app`
b) `storage`
c) `public`
d) `vendor`

**Your Answer:** _____

---

### Q17. What file is the application entry point?
**س17.** ما الملف الذي يمثل نقطة دخول التطبيق؟

a) `index.php`
b) `public/index.php`
c) `app/index.php`
d) `bootstrap/app.php`

**Your Answer:** _____

---

### Q18. How do you access environment variables in code?
**س18.** كيف تصل إلى متغيرات البيئة في الكود؟

a) `getenv('VAR')`
b) `env('VAR')`
c) `$_ENV['VAR']`
d) All of the above

**Your Answer:** _____

---

### Q19. What is the Laravel version you're learning?
**س19.** ما إصدار Laravel الذي تتعلمه؟

a) Laravel 8
b) Laravel 9
c) Laravel 10
d) Laravel 12

**Your Answer:** _____

---

### Q20. Which command shows Laravel version?
**س20.** ما الأمر الذي يعرض إصدار Laravel؟

a) `php artisan version`
b) `php artisan --version`
c) `composer show laravel`
d) `laravel --version`

**Your Answer:** _____

---

### Q21. What is MVC?
**س21.** ما هو MVC؟

a) Model View Controller
b) Main View Component
c) Modern Visual Code
d) Multiple Version Control

**Your Answer:** _____

---

### Q22. Which directory contains the Models?
**س22.** أي مجلد يحتوي على Models؟

a) `app/Models`
b) `app/Http/Models`
c) `resources/models`
d) `database/models`

**Your Answer:** _____

---

### Q23. What is the purpose of the `storage` directory?
**س23.** ما الغرض من مجلد `storage`؟

a) To store routes
b) To store compiled views, logs, cache
c) To store controllers
d) To store migrations

**Your Answer:** _____

---

### Q24. Which command clears application cache?
**س24.** ما الأمر الذي يمسح الـ cache؟

a) `php artisan cache:delete`
b) `php artisan cache:clear`
c) `php artisan clear:cache`
d) `php artisan remove:cache`

**Your Answer:** _____

---

### Q25. What is the purpose of `config/database.php`?
**س25.** ما الغرض من `config/database.php`؟

a) To create databases
b) To configure database connections
c) To store database data
d) To delete databases

**Your Answer:** _____

---

### Q26. Which is the default database for new Laravel projects?
**س26.** ما قاعدة البيانات الافتراضية للمشاريع الجديدة؟

a) MySQL
b) PostgreSQL
c) SQLite
d) MongoDB

**Your Answer:** _____

---

### Q27. What file should NOT be committed to version control?
**س27.** أي ملف يجب عدم إضافته لـ version control؟

a) `composer.json`
b) `.env`
c) `routes/web.php`
d) `app/Http/Controllers/Controller.php`

**Your Answer:** _____

---

### Q28. Which command lists all available artisan commands?
**س28.** ما الأمر الذي يسرد جميع أوامر artisan؟

a) `php artisan help`
b) `php artisan list`
c) `php artisan`
d) Both b and c

**Your Answer:** _____

---

### Q29. What is the purpose of `bootstrap/app.php`?
**س29.** ما الغرض من `bootstrap/app.php`؟

a) To create the application instance
b) To store routes
c) To display views
d) To manage database

**Your Answer:** _____

---

### Q30. Which directory contains database migrations?
**س30.** أي مجلد يحتوي على database migrations؟

a) `app/migrations`
b) `database/migrations`
c) `storage/migrations`
d) `resources/migrations`

**Your Answer:** _____

---

# Part 2: Routing (Questions 31-65)
# القسم الثاني: التوجيه

### Q31. Where are web routes defined?
**س31.** أين تُعرّف مسارات الويب؟

a) `app/routes.php`
b) `routes/web.php`
c) `config/routes.php`
d) `public/routes.php`

**Your Answer:** _____

---

### Q32. Which HTTP method is used to retrieve data?
**س32.** أي HTTP method تُستخدم لجلب البيانات؟

a) POST
b) GET
c) PUT
d) DELETE

**Your Answer:** _____

---

### Q33. Which HTTP method is used to create new resources?
**س33.** أي HTTP method تُستخدم لإنشاء موارد جديدة؟

a) GET
b) POST
c) PUT
d) PATCH

**Your Answer:** _____

---

### Q34. Which method updates existing resources completely?
**س34.** أي method تحدث الموارد الموجودة بالكامل؟

a) POST
b) GET
c) PUT
d) DELETE

**Your Answer:** _____

---

### Q35. Which method deletes resources?
**س35.** أي method تحذف الموارد؟

a) REMOVE
b) DELETE
c) DESTROY
d) DROP

**Your Answer:** _____

---

### Q36. How do you define a GET route?
**س36.** كيف تعرّف GET route؟

a) `Route::get('/path', function)`
b) `Route::create('/path', function)`
c) `Route::make('/path', function)`
d) `Get::route('/path', function)`

**Your Answer:** _____

---

### Q37. How do you define a POST route?
**س37.** كيف تعرّف POST route؟

a) `Route::create('/path', function)`
b) `Route::post('/path', function)`
c) `Post::route('/path', function)`
d) `Route::send('/path', function)`

**Your Answer:** _____

---

### Q38. What is a route parameter?
**س38.** ما هو route parameter؟

a) A fixed value in URL
b) A variable value in URL enclosed in `{}`
c) A query string
d) A form field

**Your Answer:** _____

---

### Q39. How do you define a required route parameter?
**س39.** كيف تعرّف route parameter إلزامي؟

a) `Route::get('/user/{id}', ...)`
b) `Route::get('/user/[id]', ...)`
c) `Route::get('/user/$id', ...)`
d) `Route::get('/user/:id', ...)`

**Your Answer:** _____

---

### Q40. How do you define an optional route parameter?
**س40.** كيف تعرّف route parameter اختياري؟

a) `Route::get('/user/{id}', ...)`
b) `Route::get('/user/{id?}', ...)`
c) `Route::get('/user/[id?]', ...)`
d) `Route::get('/user/{id:optional}', ...)`

**Your Answer:** _____

---

### Q41. How do you add a constraint to route parameters?
**س41.** كيف تضيف قيد على route parameter؟

a) `->where('id', 'pattern')`
b) `->constraint('id', 'pattern')`
c) `->validate('id', 'pattern')`
d) `->check('id', 'pattern')`

**Your Answer:** _____

---

### Q42. What does `->where('id', '[0-9]+')` mean?
**س42.** ماذا يعني `->where('id', '[0-9]+')`؟

a) ID must be letters
b) ID must be numeric
c) ID must be alphanumeric
d) ID is optional

**Your Answer:** _____

---

### Q43. How do you name a route?
**س43.** كيف تسمي route؟

a) `->name('route.name')`
b) `->setName('route.name')`
c) `->routeName('route.name')`
d) `->called('route.name')`

**Your Answer:** _____

---

### Q44. How do you generate URL for a named route?
**س44.** كيف تنشئ URL لـ route مسمى؟

a) `url('route.name')`
b) `route('route.name')`
c) `path('route.name')`
d) `link('route.name')`

**Your Answer:** _____

---

### Q45. How do you pass parameters to named routes?
**س45.** كيف تمرر parameters لـ routes مسماة؟

a) `route('user.show', $id)`
b) `route('user.show', ['id' => $id])`
c) Both a and b
d) `route('user.show?id=' . $id)`

**Your Answer:** _____

---

### Q46. What is a route group?
**س46.** ما هي route group؟

a) A way to apply attributes to multiple routes
b) A collection of models
c) A database table
d) A view component

**Your Answer:** _____

---

### Q47. How do you add a prefix to route groups?
**س47.** كيف تضيف prefix لـ route group؟

a) `Route::prefix('admin')->group(...)`
b) `Route::group(['prefix' => 'admin'], ...)`
c) Both a and b
d) `Route::addPrefix('admin')->group(...)`

**Your Answer:** _____

---

### Q48. How do you add name prefix to route groups?
**س48.** كيف تضيف name prefix لـ route group؟

a) `Route::name('admin.')->group(...)`
b) `Route::namePrefix('admin.')->group(...)`
c) `Route::prefix('admin.')->group(...)`
d) `Route::group(['as' => 'admin.'], ...)`

**Your Answer:** _____

---

### Q49. What does `Route::middleware('auth')` do?
**س49.** ماذا يفعل `Route::middleware('auth')`؟

a) Creates authentication
b) Applies middleware to routes
c) Deletes authentication
d) Displays login form

**Your Answer:** _____

---

### Q50. How do you redirect from one route to another?
**س50.** كيف تعيد التوجيه من route لآخر؟

a) `redirect('/path')`
b) `redirect()->to('/path')`
c) `Route::redirect('/old', '/new')`
d) All of the above

**Your Answer:** _____

---

### Q51. How do you redirect to a named route?
**س51.** كيف تعيد التوجيه لـ route مسمى؟

a) `redirect()->route('route.name')`
b) `redirect('route.name')`
c) `route()->redirect('route.name')`
d) `to()->route('route.name')`

**Your Answer:** _____

---

### Q52. What is the purpose of CSRF protection?
**س52.** ما الغرض من حماية CSRF؟

a) To encrypt data
b) To prevent Cross-Site Request Forgery
c) To validate forms
d) To authenticate users

**Your Answer:** _____

---

### Q53. How do you add CSRF token in forms?
**س53.** كيف تضيف CSRF token في النماذج؟

a) `@csrf`
b) `{{ csrf_token() }}`
c) `<input type="hidden" name="_token" value="{{ csrf_token() }}">`
d) All of the above

**Your Answer:** _____

---

### Q54. Which routes require CSRF protection?
**س54.** أي routes تحتاج حماية CSRF؟

a) GET only
b) POST, PUT, PATCH, DELETE
c) All routes
d) DELETE only

**Your Answer:** _____

---

### Q55. How do you spoof HTTP methods in forms?
**س55.** كيف تحاكي HTTP methods في النماذج؟

a) `@method('PUT')`
b) `{{ method('PUT') }}`
c) `<input type="method" value="PUT">`
d) Forms can use any method directly

**Your Answer:** _____

---

### Q56. What does `Route::view('/path', 'view.name')` do?
**س56.** ماذا يفعل `Route::view('/path', 'view.name')`؟

a) Creates a view file
b) Returns a view without controller
c) Deletes a view
d) Redirects to view

**Your Answer:** _____

---

### Q57. How do you pass data to a view route?
**س57.** كيف تمرر بيانات لـ view route؟

a) `Route::view('/path', 'view', ['key' => 'value'])`
b) `Route::view('/path', 'view')->with('key', 'value')`
c) Only a is correct
d) Both a and b

**Your Answer:** _____

---

### Q58. What is route model binding?
**س58.** ما هو route model binding؟

a) Automatically inject model instance in route
b) Create models from routes
c) Delete models via routes
d) Display models in views

**Your Answer:** _____

---

### Q59. How do you view all registered routes?
**س59.** كيف تعرض جميع الـ routes المسجلة؟

a) `php artisan routes`
b) `php artisan route:list`
c) `php artisan list:routes`
d) `php artisan show:routes`

**Your Answer:** _____

---

### Q60. What does `Route::fallback()` do?
**س60.** ماذا يفعل `Route::fallback()`؟

a) Creates a backup route
b) Handles 404 errors
c) Redirects to homepage
d) Deletes invalid routes

**Your Answer:** _____

---

### Q61. Where are API routes defined?
**س61.** أين تُعرّف API routes؟

a) `routes/api.php`
b) `routes/web.php`
c) `app/api.php`
d) `config/api.php`

**Your Answer:** _____

---

### Q62. What prefix is automatically applied to API routes?
**س62.** ما الـ prefix المطبق تلقائياً على API routes؟

a) `/api`
b) `/rest`
c) `/v1`
d) No prefix

**Your Answer:** _____

---

### Q63. How do you access the current route name?
**س63.** كيف تصل لاسم الـ route الحالي؟

a) `Route::currentRouteName()`
b) `request()->route()->getName()`
c) Both a and b
d) `Route::getName()`

**Your Answer:** _____

---

### Q64. What does `Route::match(['get', 'post'], '/path', ...)` do?
**س64.** ماذا يفعل `Route::match(['get', 'post'], '/path', ...)`؟

a) Creates two routes
b) Route responds to both GET and POST
c) Redirects GET to POST
d) Validates methods

**Your Answer:** _____

---

### Q65. What does `Route::any('/path', ...)` do?
**س65.** ماذا يفعل `Route::any('/path', ...)`؟

a) Responds to any HTTP method
b) Responds to GET only
c) Creates multiple routes
d) Requires authentication

**Your Answer:** _____

---

# Part 3: Controllers & MVC (Questions 66-100)
# القسم الثالث: Controllers و MVC

### Q66. How do you create a controller?
**س66.** كيف تنشئ controller؟

a) `php artisan make:controller Name`
b) `php artisan create:controller Name`
c) `php artisan new:controller Name`
d) `php make controller Name`

**Your Answer:** _____

---

### Q67. How do you create a resource controller?
**س67.** كيف تنشئ resource controller؟

a) `php artisan make:controller Name`
b) `php artisan make:controller Name --resource`
c) `php artisan make:controller Name --crud`
d) `php artisan make:resource Name`

**Your Answer:** _____

---

### Q68. How many methods does a resource controller have?
**س68.** كم عدد methods في resource controller؟

a) 5
b) 6
c) 7
d) 8

**Your Answer:** _____

---

### Q69. Which method displays a list of resources?
**س69.** أي method تعرض قائمة الموارد؟

a) `list()`
b) `index()`
c) `show()`
d) `all()`

**Your Answer:** _____

---

### Q70. Which method displays the create form?
**س70.** أي method تعرض نموذج الإنشاء؟

a) `new()`
b) `add()`
c) `create()`
d) `form()`

**Your Answer:** _____

---

### Q71. Which method saves a new resource?
**س71.** أي method تحفظ مورداً جديداً؟

a) `save()`
b) `create()`
c) `store()`
d) `insert()`

**Your Answer:** _____

---

### Q72. Which method displays a single resource?
**س72.** أي method تعرض مورداً واحداً؟

a) `get()`
b) `show()`
c) `view()`
d) `display()`

**Your Answer:** _____

---

### Q73. Which method displays the edit form?
**س73.** أي method تعرض نموذج التعديل؟

a) `modify()`
b) `change()`
c) `edit()`
d) `update()`

**Your Answer:** _____

---

### Q74. Which method updates a resource?
**س74.** أي method تحدث مورداً؟

a) `save()`
b) `change()`
c) `modify()`
d) `update()`

**Your Answer:** _____

---

### Q75. Which method deletes a resource?
**س75.** أي method تحذف مورداً؟

a) `delete()`
b) `remove()`
c) `destroy()`
d) `drop()`

**Your Answer:** _____

---

### Q76. How do you register a resource route?
**س76.** كيف تسجل resource route؟

a) `Route::resource('products', ProductController::class)`
b) `Route::controller('products', ProductController::class)`
c) `Route::crud('products', ProductController::class)`
d) `Route::restful('products', ProductController::class)`

**Your Answer:** _____

---

### Q77. How do you create a single action controller?
**س77.** كيف تنشئ single action controller؟

a) `php artisan make:controller Name --single`
b) `php artisan make:controller Name --invokable`
c) `php artisan make:controller Name --one`
d) `php artisan make:controller Name --action`

**Your Answer:** _____

---

### Q78. What method does a single action controller use?
**س78.** أي method يستخدم single action controller؟

a) `handle()`
b) `execute()`
c) `__invoke()`
d) `run()`

**Your Answer:** _____

---

### Q79. How do you route to a single action controller?
**س79.** كيف تعمل route لـ single action controller؟

a) `Route::get('/path', ControllerName::class)`
b) `Route::get('/path', [ControllerName::class])`
c) `Route::get('/path', ControllerName::invoke())`
d) `Route::get('/path', ControllerName@invoke)`

**Your Answer:** _____

---

### Q80. What does MVC stand for?
**س80.** ماذا يعني MVC؟

a) Model View Controller
b) Main View Component
c) Multiple Version Control
d) Modern Visual Code

**Your Answer:** _____

---

### Q81. What is the role of the Model in MVC?
**س81.** ما دور الـ Model في MVC؟

a) Display data
b) Handle business logic and data
c) Route requests
d) Validate forms

**Your Answer:** _____

---

### Q82. What is the role of the View in MVC?
**س82.** ما دور الـ View في MVC؟

a) Handle database
b) Process requests
c) Display data to users
d) Validate input

**Your Answer:** _____

---

### Q83. What is the role of the Controller in MVC?
**س83.** ما دور الـ Controller في MVC؟

a) Store data
b) Display views
c) Connect Model and View, handle logic
d) Create database tables

**Your Answer:** _____

---

### Q84. How do you pass data to a view from controller?
**س84.** كيف تمرر بيانات من controller إلى view؟

a) `return view('name', compact('data'))`
b) `return view('name', ['data' => $data])`
c) `return view('name')->with('data', $data)`
d) All of the above

**Your Answer:** _____

---

### Q85. What does `compact('products')` return?
**س85.** ماذا يُرجع `compact('products')`؟

a) `['products' => $products]`
b) `$products`
c) `'products'`
d) `products[]`

**Your Answer:** _____

---

### Q86. How do you validate request data in controller?
**س86.** كيف تتحقق من بيانات request في controller؟

a) `$request->validate([...])`
b) `validate($request, [...])`
c) `$request->check([...])`
d) `Validator::make($request, [...])`

**Your Answer:** _____

---

### Q87. What happens if validation fails?
**س87.** ماذا يحدث إذا فشل التحقق؟

a) Application crashes
b) Redirects back with errors
c) Continues execution
d) Shows 500 error

**Your Answer:** _____

---

### Q88. How do you redirect from controller?
**س88.** كيف تعيد التوجيه من controller؟

a) `return redirect('/path')`
b) `return redirect()->route('name')`
c) `return redirect()->back()`
d) All of the above

**Your Answer:** _____

---

### Q89. How do you flash data to session?
**س89.** كيف ترسل بيانات مؤقتة للـ session؟

a) `session(['key' => 'value'])`
b) `session()->flash('key', 'value')`
c) `redirect()->with('key', 'value')`
d) Both b and c

**Your Answer:** _____

---

### Q90. How do you access request input in controller?
**س90.** كيف تصل لبيانات request في controller؟

a) `$request->input('key')`
b) `$request->key`
c) `$request->get('key')`
d) All of the above

**Your Answer:** _____

---

### Q91. How do you get all request data?
**س91.** كيف تحصل على جميع بيانات request؟

a) `$request->all()`
b) `$request->input()`
c) `$request->data()`
d) `$request->get()`

**Your Answer:** _____

---

### Q92. How do you check if request has a field?
**س92.** كيف تتحقق إذا كان request يحتوي على حقل؟

a) `$request->has('key')`
b) `$request->exists('key')`
c) `$request->contains('key')`
d) `isset($request->key)`

**Your Answer:** _____

---

### Q93. What is dependency injection in controllers?
**س93.** ما هو dependency injection في controllers؟

a) Injecting variables
b) Laravel auto-provides dependencies in method parameters
c) Manual object creation
d) Database injection

**Your Answer:** _____

---

### Q94. How do you type-hint Request in controller?
**س94.** كيف تضيف type-hint للـ Request في controller؟

a) `public function store(Request $request)`
b) `public function store($request: Request)`
c) `public function store(Illuminate\Request)`
d) `public function store($request)`

**Your Answer:** _____

---

### Q95. How do you create an API resource controller?
**س95.** كيف تنشئ API resource controller؟

a) `php artisan make:controller Name --api`
b) `php artisan make:controller Name --resource --api`
c) Both a and b
d) `php artisan make:api Name`

**Your Answer:** _____

---

### Q96. How many methods does an API resource controller have?
**س96.** كم عدد methods في API resource controller؟

a) 5
b) 6
c) 7
d) 4

**Your Answer:** _____

---

### Q97. Which methods are NOT in API resource controller?
**س97.** أي methods غير موجودة في API resource controller؟

a) `index()` and `show()`
b) `create()` and `edit()`
c) `store()` and `update()`
d) `show()` and `destroy()`

**Your Answer:** _____

---

### Q98. How do you limit resource routes?
**س98.** كيف تحدد resource routes؟

a) `Route::resource('products', Controller::class)->only(['index', 'show'])`
b) `Route::resource('products', Controller::class)->except(['destroy'])`
c) Both a and b
d) Not possible

**Your Answer:** _____

---

### Q99. How do you return JSON from controller?
**س99.** كيف تُرجع JSON من controller؟

a) `return json(['data' => $data])`
b) `return response()->json(['data' => $data])`
c) `return ['data' => $data]`
d) Both b and c

**Your Answer:** _____

---

### Q100. What is middleware in Laravel?
**س100.** ما هو middleware في Laravel؟

a) Software between database and app
b) Filter for HTTP requests
c) A type of controller
d) A database driver

**Your Answer:** _____

---

## End of Quiz / نهاية الاختبار

**Total Questions: 100**

**Your Score: ___ / 100**

---

## Grading Scale / سلم التقييم

- 90-100: A+ (ممتاز)
- 80-89: A (ممتاز -)
- 70-79: B (جيد جداً)
- 60-69: C (جيد)
- 50-59: D (مقبول)
- Below 50: F (راسب)

---

**Good Luck! / بالتوفيق! 🚀**

---

## Answer Sheet / ورقة الإجابات

Write your answers below:

**Part 1 (1-30):**
1. ___ 2. ___ 3. ___ 4. ___ 5. ___ 6. ___ 7. ___ 8. ___ 9. ___ 10. ___
11. ___ 12. ___ 13. ___ 14. ___ 15. ___ 16. ___ 17. ___ 18. ___ 19. ___ 20. ___
21. ___ 22. ___ 23. ___ 24. ___ 25. ___ 26. ___ 27. ___ 28. ___ 29. ___ 30. ___

**Part 2 (31-65):**
31. ___ 32. ___ 33. ___ 34. ___ 35. ___ 36. ___ 37. ___ 38. ___ 39. ___ 40. ___
41. ___ 42. ___ 43. ___ 44. ___ 45. ___ 46. ___ 47. ___ 48. ___ 49. ___ 50. ___
51. ___ 52. ___ 53. ___ 54. ___ 55. ___ 56. ___ 57. ___ 58. ___ 59. ___ 60. ___
61. ___ 62. ___ 63. ___ 64. ___ 65. ___

**Part 3 (66-100):**
66. ___ 67. ___ 68. ___ 69. ___ 70. ___ 71. ___ 72. ___ 73. ___ 74. ___ 75. ___
76. ___ 77. ___ 78. ___ 79. ___ 80. ___ 81. ___ 82. ___ 83. ___ 84. ___ 85. ___
86. ___ 87. ___ 88. ___ 89. ___ 90. ___ 91. ___ 92. ___ 93. ___ 94. ___ 95. ___
96. ___ 97. ___ 98. ___ 99. ___ 100. ___

---

**Submit your answers when done!**
**سلّم إجاباتك عند الانتهاء!**
