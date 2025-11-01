# Lesson 3: Controllers - Full Exam
# الدرس الثالث: Controllers - الاختبار الكامل

**Total Questions:** 100
**Lesson Topic:** Laravel Controllers & MVC
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
| C | Fill in the Blanks | 10 | 10 |
| D | Code Analysis | 10 | 10 |
| E | Find the Bug | 10 | 10 |
| F | Code Writing | 5 | 5 |
| G | Method Matching | 5 | 5 |
| **Total** | | **100** | **100** |

---

# Section A: Multiple Choice (40 Questions)

---

### Q1. How do you create a basic controller?

a) `php artisan create:controller Name`
b) `php artisan make:controller Name`
c) `php artisan new:controller Name`
d) `php make controller Name`

**Answer:** _____

---

### Q2. Where are controllers stored?

a) `app/Controllers/`
b) `app/Http/Controllers/`
c) `resources/controllers/`
d) `controllers/`

**Answer:** _____

---

### Q3. How do you create a resource controller?

a) `php artisan make:controller Name`
b) `php artisan make:controller Name --resource`
c) `php artisan make:controller Name --crud`
d) `php artisan make:resource Name`

**Answer:** _____

---

### Q4. How many methods does a resource controller have?

a) 5
b) 6
c) 7
d) 8

**Answer:** _____

---

### Q5. Which method displays a list of resources?

a) `list()`
b) `index()`
c) `show()`
d) `all()`

**Answer:** _____

---

### Q6. Which method displays the create form?

a) `new()`
b) `add()`
c) `create()`
d) `form()`

**Answer:** _____

---

### Q7. Which method saves a new resource?

a) `save()`
b) `create()`
c) `store()`
d) `insert()`

**Answer:** _____

---

### Q8. Which method displays a single resource?

a) `get()`
b) `show()`
c) `view()`
d) `display()`

**Answer:** _____

---

### Q9. Which method displays the edit form?

a) `modify()`
b) `change()`
c) `edit()`
d) `update()`

**Answer:** _____

---

### Q10. Which method updates a resource?

a) `save()`
b) `change()`
c) `modify()`
d) `update()`

**Answer:** _____

---

### Q11. Which method deletes a resource?

a) `delete()`
b) `remove()`
c) `destroy()`
d) `drop()`

**Answer:** _____

---

### Q12. How do you register a resource route?

a) `Route::resource('products', ProductController::class)`
b) `Route::controller('products', ProductController::class)`
c) `Route::crud('products', ProductController::class)`
d) `Route::restful('products', ProductController::class)`

**Answer:** _____

---

### Q13. How do you create a single action controller?

a) `php artisan make:controller Name --single`
b) `php artisan make:controller Name --invokable`
c) `php artisan make:controller Name --one`
d) `php artisan make:controller Name --action`

**Answer:** _____

---

### Q14. What method does a single action controller use?

a) `handle()`
b) `execute()`
c) `__invoke()`
d) `run()`

**Answer:** _____

---

### Q15. How do you route to a single action controller?

a) `Route::get('/path', ControllerName::class)`
b) `Route::get('/path', [ControllerName::class])`
c) `Route::get('/path', ControllerName::invoke())`
d) `Route::get('/path', 'ControllerName@invoke')`

**Answer:** _____

---

### Q16. What does MVC stand for?

a) Model View Controller
b) Main View Component
c) Multiple Version Control
d) Modern Visual Code

**Answer:** _____

---

### Q17. What is the role of the Model in MVC?

a) Display data
b) Handle business logic and data
c) Route requests
d) Validate forms

**Answer:** _____

---

### Q18. What is the role of the View in MVC?

a) Handle database
b) Process requests
c) Display data to users
d) Validate input

**Answer:** _____

---

### Q19. What is the role of the Controller in MVC?

a) Store data
b) Display views
c) Connect Model and View, handle logic
d) Create database tables

**Answer:** _____

---

### Q20. How do you pass data to a view from controller?

a) `return view('name', compact('data'))`
b) `return view('name', ['data' => $data])`
c) `return view('name')->with('data', $data)`
d) All of the above

**Answer:** _____

---

### Q21. What does `compact('products')` return?

a) `['products' => $products]`
b) `$products`
c) `'products'`
d) `products[]`

**Answer:** _____

---

### Q22. How do you validate request data in controller?

a) `$request->validate([...])`
b) `validate($request, [...])`
c) `$request->check([...])`
d) `Validator::make($request, [...])`

**Answer:** _____

---

### Q23. What happens if validation fails?

a) Application crashes
b) Redirects back with errors
c) Continues execution
d) Shows 500 error

**Answer:** _____

---

### Q24. How do you redirect from controller?

a) `return redirect('/path')`
b) `return redirect()->route('name')`
c) `return redirect()->back()`
d) All of the above

**Answer:** _____

---

### Q25. How do you flash data to session?

a) `session(['key' => 'value'])`
b) `session()->flash('key', 'value')`
c) `redirect()->with('key', 'value')`
d) Both b and c

**Answer:** _____

---

### Q26. How do you access request input in controller?

a) `$request->input('key')`
b) `$request->key`
c) `$request->get('key')`
d) All of the above

**Answer:** _____

---

### Q27. How do you get all request data?

a) `$request->all()`
b) `$request->input()`
c) `$request->data()`
d) `$request->get()`

**Answer:** _____

---

### Q28. How do you check if request has a field?

a) `$request->has('key')`
b) `$request->exists('key')`
c) `$request->contains('key')`
d) `isset($request->key)`

**Answer:** _____

---

### Q29. What is dependency injection in controllers?

a) Injecting variables
b) Laravel auto-provides dependencies in method parameters
c) Manual object creation
d) Database injection

**Answer:** _____

---

### Q30. How do you type-hint Request in controller?

a) `public function store(Request $request)`
b) `public function store($request: Request)`
c) `public function store(Illuminate\Request)`
d) `public function store($request)`

**Answer:** _____

---

### Q31. How do you create an API resource controller?

a) `php artisan make:controller Name --api`
b) `php artisan make:controller Name --resource --api`
c) Both a and b
d) `php artisan make:api Name`

**Answer:** _____

---

### Q32. How many methods does an API resource controller have?

a) 5
b) 6
c) 7
d) 4

**Answer:** _____

---

### Q33. Which methods are NOT in API resource controller?

a) `index()` and `show()`
b) `create()` and `edit()`
c) `store()` and `update()`
d) `show()` and `destroy()`

**Answer:** _____

---

### Q34. How do you limit resource routes?

a) `Route::resource('products', Controller::class)->only(['index', 'show'])`
b) `Route::resource('products', Controller::class)->except(['destroy'])`
c) Both a and b
d) Not possible

**Answer:** _____

---

### Q35. How do you return JSON from controller?

a) `return json(['data' => $data])`
b) `return response()->json(['data' => $data])`
c) `return ['data' => $data]`
d) Both b and c

**Answer:** _____

---

### Q36. What is middleware in Laravel?

a) Software between database and app
b) Filter for HTTP requests
c) A type of controller
d) A database driver

**Answer:** _____

---

### Q37. How do you apply middleware to a controller method?

a) In constructor: `$this->middleware('auth')`
b) In routes file
c) Both a and b
d) Not possible

**Answer:** _____

---

### Q38. What does `$request->only(['name', 'email'])` do?

a) Gets all input
b) Gets only name and email fields
c) Validates only name and email
d) Removes name and email

**Answer:** _____

---

### Q39. What does `$request->except(['_token'])` do?

a) Gets all input except _token
b) Validates except _token
c) Deletes _token
d) Throws exception for _token

**Answer:** _____

---

### Q40. How do you redirect with success message?

a) `return redirect()->route('home')->with('success', 'Saved!')`
b) `return redirect()->message('Saved!')`
c) `return redirect()->success('Saved!')`
d) `return redirect()->flash('Saved!')`

**Answer:** _____

---

# Section B: True or False (20 Questions)

---

### Q41. Controllers are stored in `app/Http/Controllers/`.

**Answer:** _____

---

### Q42. A resource controller has 7 CRUD methods.

**Answer:** _____

---

### Q43. The `index()` method displays a single resource.

**Answer:** _____

---

### Q44. The `store()` method saves new resources.

**Answer:** _____

---

### Q45. The `create()` method displays a form.

**Answer:** _____

---

### Q46. Single action controllers use `__invoke()` method.

**Answer:** _____

---

### Q47. You can pass data to views using `compact()`.

**Answer:** _____

---

### Q48. `$request->validate()` automatically redirects back on failure.

**Answer:** _____

---

### Q49. Controllers must extend the base Controller class.

**Answer:** _____

---

### Q50. API resource controllers have `create()` and `edit()` methods.

**Answer:** _____

---

### Q51. Dependency injection happens automatically in controller methods.

**Answer:** _____

---

### Q52. `$request->all()` gets all input data.

**Answer:** _____

---

### Q53. Flash data persists for only one request.

**Answer:** _____

---

### Q54. You can apply middleware in the controller constructor.

**Answer:** _____

---

### Q55. `compact('user')` looks for a variable named `$user`.

**Answer:** _____

---

### Q56. Resource routes can be limited using `only()` or `except()`.

**Answer:** _____

---

### Q57. Controllers handle the logic between routes and views.

**Answer:** _____

---

### Q58. The `edit()` method saves changes to database.

**Answer:** _____

---

### Q59. `Route::resource()` creates 7 routes automatically.

**Answer:** _____

---

### Q60. Controllers can return views, JSON, redirects, and more.

**Answer:** _____

---

# Section C: Fill in the Blanks (10 Questions)

---

### Q61. To create a controller, use `php artisan __________ Name`.

**Answer:** __________________

---

### Q62. Resource controllers have __________ methods by default.

**Answer:** __________________

---

### Q63. The method that displays all resources is called __________.

**Answer:** __________________

---

### Q64. The method that saves a new resource is called __________.

**Answer:** __________________

---

### Q65. To pass data to a view, use `return view('name', __________(variables'))`.

**Answer:** __________________

---

### Q66. To validate request data, use `$request->__________([rules])`.

**Answer:** __________________

---

### Q67. Single action controllers use the `__________()` magic method.

**Answer:** __________________

---

### Q68. To get a specific input field, use `$request->__________('fieldname')`.

**Answer:** __________________

---

### Q69. Flash data is created using `redirect()->__________('key', 'value')`.

**Answer:** __________________

---

### Q70. API resource controllers have __________ methods (not 7).

**Answer:** __________________

---

# Section D: Code Analysis (10 Questions)

---

### Q71. What does this controller method do?

```php
public function index()
{
    $products = Product::all();
    return view('products.index', compact('products'));
}
```

a) Creates products
b) Shows all products
c) Deletes products
d) Updates products

**Answer:** _____

---

### Q72. What's missing in this code?

```php
public function store(Request $request)
{
    Product::create($request->all());
    return redirect()->route('products.index');
}
```

a) Validation
b) Authorization
c) Database connection
d) Nothing

**Answer:** _____

---

### Q73. What will happen with this validation?

```php
$request->validate([
    'email' => 'required|email',
    'age' => 'required|numeric|min:18'
]);
// User submits: email="invalid", age="15"
```

a) Creates the record
b) Redirects back with errors
c) Shows 500 error
d) Continues normally

**Answer:** _____

---

### Q74. What does `compact('user', 'posts')` create?

```php
$user = User::find(1);
$posts = Post::all();
return view('dashboard', compact('user', 'posts'));
```

a) `['user' => $user]`
b) `['posts' => $posts]`
c) `['user' => $user, 'posts' => $posts]`
d) `[$user, $posts]`

**Answer:** _____

---

### Q75. What route will this match?

```php
Route::resource('articles', ArticleController::class);
// Controller method: public function show($id)
```

a) `GET /articles`
b) `GET /articles/{id}`
c) `POST /articles`
d) `DELETE /articles/{id}`

**Answer:** _____

---

### Q76. What's the purpose of this constructor?

```php
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
```

a) Creates authentication
b) Applies auth middleware to all methods
c) Logs in users
d) Creates admin users

**Answer:** _____

---

### Q77. What does this return?

```php
public function api()
{
    return ['status' => 'success', 'data' => []];
}
```

a) View
b) String
c) JSON (auto-converted)
d) Error

**Answer:** _____

---

### Q78. How many routes does this create?

```php
Route::resource('posts', PostController::class)
     ->only(['index', 'show', 'store']);
```

a) 7
b) 3
c) 4
d) 5

**Answer:** _____

---

### Q79. What's wrong with this code?

```php
return view('users.index', compact('posts'));
// Variable is actually named $users
```

a) Variable name mismatch
b) View doesn't exist
c) compact() used incorrectly
d) No error

**Answer:** _____

---

### Q80. What HTTP method is this for?

```php
public function update(Request $request, $id)
{
    $product = Product::find($id);
    $product->update($request->all());
    return redirect()->route('products.show', $id);
}
```

a) GET
b) POST
c) PUT/PATCH
d) DELETE

**Answer:** _____

---

# Section E: Find the Bug (10 Questions)

---

### Q81. Find the bug:

```php
Route::get('/products/{id}', [ProductController::class, 'show']);

// Controller:
public function show($product)
{
    return "Product: " . $product;
}
```

a) Parameter name must match: should be `$id`
b) Missing validation
c) Should use POST
d) No bug

**Answer:** _____

---

### Q82. Find the bug:

```php
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password  // Not validated!
    ]);
}
```

a) Password not validated but used
b) Missing redirect
c) Wrong method
d) No bug

**Answer:** _____

---

### Q83. Find the bug:

```php
public function index()
{
    $users = User::all();
    return view('users.index', compact('$users'));
}
```

a) Should be `compact('users')` not `compact('$users')`
b) Should use get() instead of all()
c) Wrong view name
d) No bug

**Answer:** _____

---

### Q84. Find the bug:

```php
Route::resource('posts', PostController::class);

// Controller has only:
public function index() {}
public function show($id) {}
// Missing other methods!
```

a) Resource route expects 7 methods, only 2 defined
b) Should use Route::get()
c) Missing parameters
d) No bug

**Answer:** _____

---

### Q85. Find the bug:

```php
public function create()
{
    $post = Post::create([
        'title' => 'New Post'
    ]);
    return view('posts.create');
}
```

a) `create()` should show form, not create data
b) Missing validation
c) Wrong view
d) No bug

**Answer:** _____

---

### Q86. Find the bug:

```php
public function update(Request $request, $id)
{
    Product::find($id)->update($request->all());
    return redirect()->route('products.index');
}
// What if product doesn't exist?
```

a) Should use findOrFail() to handle non-existent products
b) Missing validation
c) Wrong redirect
d) No bug

**Answer:** _____

---

### Q87. Find the bug:

```php
Route::get('/dashboard', DashboardController::class);

// Controller:
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
```

a) Single action controller should use `__invoke()` not `index()`
b) Route is wrong
c) Missing parameters
d) No bug

**Answer:** _____

---

### Q88. Find the bug:

```php
public function store(Request $request)
{
    Product::create($request->all());  // Mass assignment!
    return redirect()->back();
}
```

a) Vulnerable to mass assignment (should use only() or validate())
b) Wrong redirect
c) Missing response
d) No bug

**Answer:** _____

---

### Q89. Find the bug:

```php
return view('products')->with([
    'products' => $products,
    'categories' => $categories
]);
```

a) `->with()` doesn't accept array, use compact() or separate with() calls
b) Actually this IS valid!
c) Missing validation
d) Wrong view name

**Answer:** _____

---

### Q90. Find the bug:

```php
public function destroy($id)
{
    Product::find($id)->delete();
    return redirect()->route('products.index');
}
// User sends ID that doesn't exist
```

a) Will throw error on null, use findOrFail() or check first
b) Missing validation
c) Should use DELETE method
d) No bug

**Answer:** _____

---

# Section F: Code Writing (5 Questions)

**Instructions:** Write the complete code.

---

### Q91. Create a resource controller named `PostController` with all 7 methods. Write only the method signatures (no code inside).

```php
















```

---

### Q92. Write a controller method that:
- Validates name (required, min:3) and email (required, email)
- Creates a User with validated data
- Redirects to 'users.index' with success message

```php









```

---

### Q93. Create a single action controller that returns the view 'dashboard'. Write the complete class.

```php







```

---

### Q94. Write code to pass three variables to a view:
- $products (from Product::all())
- $categories (from Category::all())
- $title = "Shop"

```php







```

---

### Q95. Write a destroy method that:
- Finds product by ID (or fail)
- Deletes it
- Redirects to 'products.index' with flash message "Product deleted!"

```php








```

---

# Section G: Method Matching (5 Questions)

**Instructions:** Match the resource controller method to its purpose and HTTP method.

---

### Q96. Match the method to its HTTP verb:

```
Method          HTTP Method      URL Pattern
------          -----------      -----------
index()         ?                ?
create()        ?                ?
store()         ?                ?
show()          ?                ?
edit()          ?                ?
update()        ?                ?
destroy()       ?                ?
```

**Answers:**
- index() → HTTP: _______ URL: _______
- create() → HTTP: _______ URL: _______
- store() → HTTP: _______ URL: _______

---

### Q97-Q100. What resource controller method handles each of these URLs?

**Q97.** `GET /products`
**Answer:** __________

**Q98.** `POST /products`
**Answer:** __________

**Q99.** `GET /products/5/edit`
**Answer:** __________

**Q100.** `DELETE /products/5`
**Answer:** __________

---

## End of Exam / نهاية الاختبار

**Total Questions:** 100
**Your Score:** ____ / 100

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
