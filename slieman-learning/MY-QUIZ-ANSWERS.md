# Laravel Lessons 1-3 Quiz
# اختبار الدروس 1-3 من Laravel

**Instructions / التعليمات:**
- Answer all questions / أجب على جميع الأسئلة
- Write your answers in a separate file or below each question
- اكتب إجاباتك في ملف منفصل أو تحت كل سؤال
- Take your time and think carefully / خذ وقتك وفكر جيداً

---

## Part 1: Multiple Choice Questions
## القسم الأول: أسئلة اختيار من متعدد

### Lesson 1: Laravel Basics

**Q1.** What command is used to create a new Laravel project?
**س1.** ما الأمر المستخدم لإنشاء مشروع Laravel جديد؟

a) `php artisan new project-name`
b) `composer create-project laravel/laravel project-name`
c) `laravel new project-name`
d) Both b and c / كل من b و c

**Your Answer / إجابتك:**

d

---

**Q2.** Which file contains the main configuration for the Laravel application?
**س2.** أي ملف يحتوي على الإعدادات الرئيسية لتطبيق Laravel؟

a) `config/app.php`
b) `.env`
c) `bootstrap/app.php`
d) `config/database.php`

**Your Answer / إجابتك:**
a
---

**Q3.** What is the purpose of the `.env` file?
**س3.** ما الغرض من ملف `.env`؟

a) To store environment-specific configuration / لتخزين إعدادات خاصة بالبيئة
b) To store routes / لتخزين المسارات
c) To store controllers / لتخزين الـ Controllers
d) To store views / لتخزين العروض

**Your Answer / إجابتك:**
a
---

### Lesson 2: Routing

**Q4.** Which HTTP method is used to retrieve data?
**س4.** أي HTTP method تُستخدم لجلب البيانات؟

a) POST
b) GET
c) PUT
d) DELETE

**Your Answer / إجابتك:**
b
---

**Q5.** What is the correct syntax for a route with an optional parameter?
**س5.** ما الصيغة الصحيحة لمسار مع معامل اختياري؟

a) `Route::get('/user/{name}', function($name) {...});`
b) `Route::get('/user/{name?}', function($name = 'Guest') {...});`
c) `Route::get('/user/[name]', function($name) {...});`
d) `Route::get('/user/{name:optional}', function($name) {...});`

**Your Answer / إجابتك:**
b
---

**Q6.** What does `->name('profile')` do when added to a route?
**س6.** ماذا يفعل `->name('profile')` عند إضافته للمسار؟

a) Changes the route URL / يغير عنوان URL للمسار
b) Gives the route a name for easy reference / يعطي المسار اسماً للإشارة إليه بسهولة
c) Adds middleware / يضيف middleware
d) Makes the route optional / يجعل المسار اختياري

**Your Answer / إجابتك:**

b
---

**Q7.** How do you generate a URL for a named route called 'products.show' with id = 5?
**س7.** كيف تُنشئ URL لمسار مسمى 'products.show' مع id = 5؟

a) `url('products.show', 5)`
b) `route('products.show', 5)`
c) `path('products.show', 5)`
d) `link('products.show', 5)`

**Your Answer / إجابتك:**

b

---

**Q8.** What is the purpose of route groups?
**س8.** ما الغرض من مجموعات المسارات؟

a) To organize routes visually only / لتنظيم المسارات بصرياً فقط
b) To apply common attributes (prefix, middleware, name) to multiple routes
   لتطبيق خصائص مشتركة (prefix, middleware, name) على عدة مسارات
c) To create multiple copies of routes / لإنشاء نسخ متعددة من المسارات
d) To delete routes / لحذف المسارات

**Your Answer / إجابتك:**

b
---

### Lesson 3: Controllers and MVC

**Q9.** How many methods does a Resource Controller have by default?
**س9.** كم عدد الـ methods في Resource Controller افتراضياً؟

a) 5 methods
b) 7 methods
c) 10 methods
d) 3 methods

**Your Answer / إجابتك:**
b
---

**Q10.** What is the purpose of the `__invoke()` method in a controller?
**س10.** ما الغرض من method `__invoke()` في الـ controller؟

a) To initialize the controller / لتهيئة الـ controller
b) To handle a single action controller / لمعالجة controller بوظيفة واحدة
c) To destroy the controller / لحذف الـ controller
d) To validate data / للتحقق من البيانات

**Your Answer / إجابتك:**

b

---

**Q11.** Which command creates a resource controller?
**س11.** أي أمر ينشئ resource controller؟

a) `php artisan make:controller ProductController`
b) `php artisan make:controller ProductController --resource`
c) `php artisan create:controller ProductController`
d) `php artisan new:controller ProductController --resource`

**Your Answer / إجابتك:**

b

---

**Q12.** In MVC pattern, what does the Controller do?
**س12.** في نمط MVC، ما دور الـ Controller؟

a) Displays the data / يعرض البيانات
b) Stores the data / يخزن البيانات
c) Handles business logic and connects Model with View
   يعالج منطق العمل ويربط بين Model و View
d) Only validates forms / يتحقق من النماذج فقط

**Your Answer / إجابتك:**
c

---

## Part 2: True or False
## القسم الثاني: صح أم خطأ

**Q13.** Routes are defined in the `routes/web.php` file.
**س13.** يتم تعريف المسارات في ملف `routes/web.php`.

**Your Answer / إجابتك:**

true

---

**Q14.** PUT method is used to create new resources.
**س14.** تُستخدم PUT method لإنشاء موارد جديدة.

**Your Answer / إجابتك:**
false
---

**Q15.** `compact('products')` is the same as `['products' => $products]`
**س15.** `compact('products')` تساوي `['products' => $products]`

**Your Answer / إجابتك:**
false 
not sure about it
---

**Q16.** A Resource Controller can only be used with databases.
**س16.** Resource Controller يمكن استخدامه فقط مع قواعد البيانات.

**Your Answer / إجابتك:**
false
---

**Q17.** Named routes make it easier to change URLs without updating all links.
**س17.** المسارات المسماة تسهل تغيير URLs دون تحديث جميع الروابط.

**Your Answer / إجابتك:**
true
---

**Q18.** The `@csrf` directive is required for POST, PUT, and DELETE forms.
**س18.** يجب استخدام `@csrf` في نماذج POST و PUT و DELETE.

**Your Answer / إجابتك:**
true
---

## Part 3: Fill in the Blanks
## القسم الثالث: املأ الفراغات

**Q19.** To start the Laravel development server, use the command: `php artisan _______`
**س19.** لتشغيل خادم التطوير في Laravel، استخدم الأمر: `php artisan _______`

**Your Answer / إجابتك:**
serve
---

**Q20.** The 7 methods in a Resource Controller are: index, create, _______, show, edit, _______, destroy
**س20.** الـ 7 methods في Resource Controller هي: index, create, _______, show, edit, _______, destroy

**Your Answer / إجابتك:**
store,update,destroy
---

**Q21.** To pass data to a view, you can use: `return view('products.index', _______('products'));`
**س21.** لتمرير البيانات إلى view، يمكنك استخدام: `return view('products.index', _______('products'));`

**Your Answer / إجابتك:**
compact
---

**Q22.** To create a route group with prefix 'admin', use: `Route::_______('admin')->group(function() {...});`
**س22.** لإنشاء مجموعة مسارات بـ prefix 'admin'، استخدم: `Route::_______('admin')->group(function() {...});`

**Your Answer / إجابتك:**
prefix
---

## Part 4: Code Writing
## القسم الرابع: كتابة الكود

**Q23.** Write a route that displays a product by its ID (numeric only).
**س23.** اكتب مساراً يعرض منتجاً بمعرّفه (أرقام فقط).

**Your Answer / إجابتك:**
```php
// Write your code here / اكتب الكود هنا

Route::get('/product/${id}', function($id){
   return 'Product ID='. $id;
});

```

---

**Q24.** Create a named route group with prefix 'api' that contains a GET route '/users' pointing to UserController@index
**س24.** أنشئ مجموعة مسارات مسماة بـ prefix 'api' تحتوي على مسار GET '/users' يشير إلى UserController@index

**Your Answer / إجابتك:**
```php
// Write your code here / اكتب الكود هنا
Route::prefix('api', function(){
  Route::get('/users', [UserController::class, 'index'])->name('users');
});

```

---

**Q25.** Write the controller method `store()` for a ProductController that validates 'name' (required) and 'price' (required, numeric), then redirects to products.index
**س25.** اكتب method `store()` في ProductController تتحقق من 'name' (مطلوب) و 'price' (مطلوب، رقمي)، ثم تعيد التوجيه إلى products.index

**Your Answer / إجابتك:**
```php
// Write your code here / اكتب الكود هنا

 public function store()
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
         return redirect()->route('products.index');
    }



```

---

**Q26.** Write a Blade template that displays all products from an array `$products` (each has 'name' and 'price') in a table.
**س26.** اكتب قالب Blade يعرض جميع المنتجات من مصفوفة `$products` (كل منتج له 'name' و 'price') في جدول.

**Your Answer / إجابتك:**
```blade
<!-- Write your code here / اكتب الكود هنا -->

  <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name / الاسم</th>
                <th>Price / السعر</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['name'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>



```

---

## Part 5: Code Analysis
## القسم الخامس: تحليل الكود

**Q27.** What does this route do? Explain each part.
**س27.** ما وظيفة هذا المسار؟ اشرح كل جزء.

```php
Route::get('/product/{id}', function($id) {
    return "Product ID: $id";
})->where('id', '[0-9]+')->name('product.show');
```

**Your Answer / إجابتك:**

هذا سيحولني إلى صفحة product بحسب 
id الإلزامي المدخل
وعليه قيود بأنه يجب أن يكون أرقام
وله تسمية خاصة هذا الروات وهي product.show
عند إدخال مثلًا 
/product/1
سيتم إرجاع
Product ID: 1
---

**Q28.** What is wrong with this controller method? Fix it.
**س28.** ما الخطأ في هذا الـ controller method؟ صححه.

```php
public function show($id)
{
    $product = ['id' => $id, 'name' => 'Laptop'];
    return view('products.show');
}
```

**Your Answer / إجابتك:**

أعتقد أن الخطأ لم يتم تمرير الداتا 
فيجب أن يكون 
 return view('products.show', compact($product));
---

**Q29.** Explain what this code does step by step:
**س29.** اشرح ماذا يفعل هذا الكود خطوة بخطوة:

```php
Route::prefix('admin')
     ->name('admin.')
     ->group(function() {
         Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
     });
```

**Your Answer / إجابتك:**

هنا api بهذا الشكل
/admin/dashboard 
وبمسمى admin.dashboard
عند تنفيذها
سيتم تحويلنا إلى AdminController
إلى الميثود الفنكشن index 
---

**Q30.** What will be the output of `route('admin.dashboard')` from Q29?
**س30.** ما ناتج `route('admin.dashboard')` من السؤال 29؟

**Your Answer / إجابتك:**
سيتم توجيهنا إلى AdminController
إلى الميثود أو الفنكشن index
---

## Part 6: Practical Scenario
## القسم السادس: سيناريو عملي

**Q31.** You need to create a simple blog system with posts. Write:
**س31.** تحتاج لإنشاء نظام مدونة بسيط بمقالات. اكتب:

a) The resource route for PostController
b) The controller method `index()` that passes fake posts data to view
c) The route to access a single post by slug (letters, numbers, hyphens only)

**Your Answers / إجاباتك:**
```php
// a) Resource route / مسار Resource

Route::resource('posts', PostController::class);

// b) index() method / method index()

public function index() {
   $posts= ['post1', 'post2', 'post3'];
   return view('posts.index', compact('posts'));
}


// c) Single post by slug route / مسار مقال واحد بالـ slug
Route::get('post/{slug}')
Route::get('/post/{slug}', function ($slug) {
    return "Post " . $slug;
})->where('slug', '[A-Za-z0-9]+')->name('posts.show');

```

---

## Bonus Question (Optional)
## سؤال إضافي (اختياري)

**Q32.** Explain the difference between:
**س32.** اشرح الفرق بين:

```php
// Option 1
Route::get('/products', [ProductController::class, 'index']);

// Option 2
Route::resource('products', ProductController::class);
```

**Your Answer / إجابتك:**

الراوت الأول فقط يذهب إلى فنكشن index

الراوت الثاني عبارة عن عدة راوتات وهي 
index,
create,
store,
show,
edit,
update,
destroy
---

## Submission Instructions
## تعليمات التسليم

1. Save your answers in a file named `MY-QUIZ-ANSWERS.md`
   احفظ إجاباتك في ملف باسم `MY-QUIZ-ANSWERS.md`

2. Place it in the `slieman-learning` folder
   ضعه في مجلد `slieman-learning`

3. Let me know when you're done and I'll review your answers
   أخبرني عندما تنتهي وسأراجع إجاباتك

---

**Good Luck! / بالتوفيق!**

**Total Questions: 32**
**إجمالي الأسئلة: 32**

- Multiple Choice: 12 questions
- True/False: 6 questions
- Fill in the Blanks: 4 questions
- Code Writing: 4 questions
- Code Analysis: 4 questions
- Practical Scenario: 1 question
- Bonus: 1 question
