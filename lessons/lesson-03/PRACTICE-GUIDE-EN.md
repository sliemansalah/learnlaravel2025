# Lesson 3 - Practical Application Guide

## 🚀 How to Run the Project

```bash
cd D:\learnlaravel2025\lessons\lesson-03\practice-app
php artisan serve
```

Server will run on: `http://localhost:8000`

---

## 📋 Available Routes

### 1. Basic Pages
- **GET** `/` - Home page
- **GET** `/about` - About us
- **GET** `/contact` - Contact us

### 2. Products - Resource Controller
- **GET** `/products` - Products list
- **GET** `/products/create` - Add product form
- **POST** `/products` - Save new product
- **GET** `/products/{id}` - Show single product
- **GET** `/products/{id}/edit` - Edit product form
- **PUT/PATCH** `/products/{id}` - Update product
- **DELETE** `/products/{id}` - Delete product

### 3. Posts - Resource Controller
- **GET** `/posts` - Posts list
- **GET** `/posts/create` - Add post form
- **POST** `/posts` - Save new post
- **GET** `/posts/{id}` - Show single post
- **GET** `/posts/{id}/edit` - Edit post form
- **PUT/PATCH** `/posts/{id}` - Update post
- **DELETE** `/posts/{id}` - Delete post

### 4. Dashboard
- **GET** `/dashboard` - Dashboard (Single Action Controller)

### 5. Users
- **POST** `/users` - Create new user (with validation)
- **PUT** `/users/{id}` - Update user (with validation)

---

## ✅ Implemented Controllers

### 1. PageController - Basic Pages

```bash
php artisan make:controller PageController
```

```php
class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
```

**Routes:**
```php
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
```

---

### 2. ProductController - Resource Controller

```bash
php artisan make:controller ProductController --resource
```

```php
class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'HP Laptop', 'price' => 5000, 'stock' => 10],
            ['id' => 2, 'name' => 'iPhone', 'price' => 4000, 'stock' => 15],
            ['id' => 3, 'name' => 'Samsung Tablet', 'price' => 2000, 'stock' => 8],
        ];

        return view('products.index', compact('products'));
    }

    // Show form to create new product
    public function create()
    {
        return view('products.create');
    }

    // Save new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // In real app: Product::create($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Product added successfully');
    }

    // Display single product
    public function show($id)
    {
        $products = [
            1 => ['id' => 1, 'name' => 'HP Laptop', 'price' => 5000, 'stock' => 10],
            2 => ['id' => 2, 'name' => 'iPhone', 'price' => 4000, 'stock' => 15],
            3 => ['id' => 3, 'name' => 'Samsung Tablet', 'price' => 2000, 'stock' => 8],
        ];

        $product = $products[$id] ?? abort(404);

        return view('products.show', compact('product'));
    }

    // Show form to edit product
    public function edit($id)
    {
        $products = [
            1 => ['id' => 1, 'name' => 'HP Laptop', 'price' => 5000, 'stock' => 10],
            2 => ['id' => 2, 'name' => 'iPhone', 'price' => 4000, 'stock' => 15],
            3 => ['id' => 3, 'name' => 'Samsung Tablet', 'price' => 2000, 'stock' => 8],
        ];

        $product = $products[$id] ?? abort(404);

        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // In real app: $product->update($validated);

        return redirect()->route('products.show', $id)
                         ->with('success', 'Product updated successfully');
    }

    // Delete product
    public function destroy($id)
    {
        // In real app: $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully');
    }
}
```

**Routes:**
```php
Route::resource('products', ProductController::class);
```

---

### 3. PostController - Resource Controller

```bash
php artisan make:controller PostController --resource
```

```php
class PostController extends Controller
{
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'Introduction to Laravel', 'author' => 'Ahmed Mohammed', 'date' => '2024-01-15'],
            ['id' => 2, 'title' => 'Learning Controllers', 'author' => 'Mohammed Ali', 'date' => '2024-01-20'],
            ['id' => 3, 'title' => 'MVC Pattern', 'author' => 'Sara Ahmed', 'date' => '2024-01-25'],
        ];

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'author' => 'required|max:100',
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post created successfully');
    }

    public function show($id)
    {
        $posts = [
            1 => [
                'id' => 1,
                'title' => 'Introduction to Laravel',
                'content' => 'Laravel is a modern PHP framework...',
                'author' => 'Ahmed Mohammed',
                'date' => '2024-01-15'
            ],
            2 => [
                'id' => 2,
                'title' => 'Learning Controllers',
                'content' => 'Controllers are the layer that connects...',
                'author' => 'Mohammed Ali',
                'date' => '2024-01-20'
            ],
        ];

        $post = $posts[$id] ?? abort(404);

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $posts = [
            1 => ['id' => 1, 'title' => 'Introduction to Laravel', 'content' => 'Laravel is...', 'author' => 'Ahmed'],
            2 => ['id' => 2, 'title' => 'Learning Controllers', 'content' => 'Controllers are...', 'author' => 'Mohammed'],
        ];

        $post = $posts[$id] ?? abort(404);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'author' => 'required|max:100',
        ]);

        return redirect()->route('posts.show', $id)
                         ->with('success', 'Post updated successfully');
    }

    public function destroy($id)
    {
        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully');
    }
}
```

**Routes:**
```php
Route::resource('posts', PostController::class);
```

---

### 4. ShowDashboardController - Single Action

```bash
php artisan make:controller ShowDashboardController --invokable
```

```php
class ShowDashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'users' => 1250,
            'products' => 85,
            'posts' => 342,
            'revenue' => 125000,
            'orders' => 567,
            'visitors' => 8932
        ];

        return view('dashboard', compact('stats'));
    }
}
```

**Route:**
```php
Route::get('/dashboard', ShowDashboardController::class)
    ->name('dashboard');
```

---

### 5. UserController - Dependency Injection & Validation

```bash
php artisan make:controller UserController
```

```php
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Create new user with validation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|regex:/^[0-9]{10}$/',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email address',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        // User::create($validated);

        return redirect()->route('home')
                         ->with('success', 'User created successfully');
    }

    // Update user
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|regex:/^[0-9]{10}$/',
        ]);

        // $user->update($validated);

        return redirect()->route('home')
                         ->with('success', 'User updated successfully');
    }
}
```

**Routes:**
```php
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
```

---

## 🎯 What We Learned

### 1. Controller Types
- ✅ Simple Controller (PageController)
- ✅ Resource Controller (ProductController, PostController)
- ✅ Single Action Controller (ShowDashboardController)
- ✅ Controller with Dependency Injection (UserController)

### 2. Resource Controller Methods
- `index()` - Display list
- `create()` - Show creation form
- `store()` - Save data
- `show($id)` - Display single item
- `edit($id)` - Show edit form
- `update($id)` - Update data
- `destroy($id)` - Delete item

### 3. Data Validation
- Using `validate()` in Controller
- Custom error messages
- Different validation rules

### 4. Responses
- `return view()` - Display page
- `return redirect()` - Redirect
- `->with('success', 'message')` - Flash messages

---

## 📝 Useful Commands

```bash
# Display all routes
php artisan route:list

# Display products routes only
php artisan route:list --name=products

# Display posts routes only
php artisan route:list --name=posts

# Create new controller
php artisan make:controller ControllerName --resource

# Detailed routes view
php artisan route:list -v
```

---

## 🔍 Testing Routes

### Testing Products:
1. ✅ `http://localhost:8000/products` - Products list
2. ✅ `http://localhost:8000/products/1` - Show product #1
3. ✅ `http://localhost:8000/products/create` - Add product form
4. ✅ `http://localhost:8000/products/1/edit` - Edit product form

### Testing Posts:
1. ✅ `http://localhost:8000/posts` - Posts list
2. ✅ `http://localhost:8000/posts/1` - Show post #1
3. ✅ `http://localhost:8000/posts/create` - Add post form
4. ✅ `http://localhost:8000/posts/1/edit` - Edit post form

### Testing Pages:
1. ✅ `http://localhost:8000/` - Home page
2. ✅ `http://localhost:8000/about` - About us
3. ✅ `http://localhost:8000/contact` - Contact us
4. ✅ `http://localhost:8000/dashboard` - Dashboard

---

## 💡 Tips

1. **Use `php artisan route:list`** to display all routes
2. **Resource Controllers** save your time - use them!
3. **Single Action Controllers** are useful for complex pages
4. **Validation** is very important - don't forget it
5. **Test every route** to ensure it works

---

## 🎓 Additional Exercises

### Exercise 1: Create Category Controller
Create a Resource Controller for categories with all 7 methods.

### Exercise 2: Add Middleware
Add authentication middleware to `create`, `store`, `edit`, `update`, `destroy`.

### Exercise 3: Form Request
Create a Form Request for validation instead of putting it in Controller.

```bash
php artisan make:request StoreProductRequest
```

---

## 📚 Next Step

After completing this lesson, you're now ready for:

**Lesson 4**: Blade Templates and User Interfaces
- Blade templating engine
- Directives
- Components
- Layouts

---

**Happy Learning! 🚀**
