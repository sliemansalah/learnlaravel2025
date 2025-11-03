# الدرس الثالث - الجزء العملي: Controllers في Laravel

## 🎯 أهداف الجزء العملي

في هذا الجزء العملي، ستتعلم:
1. ✅ إنشاء Controllers مختلفة باستخدام Artisan
2. ✅ بناء نظام إدارة مكتبة متكامل (Library Management System)
3. ✅ استخدام Resource Controllers
4. ✅ تطبيق Route Model Binding
5. ✅ تمرير البيانات من Controllers إلى Views
6. ✅ استخدام Middleware في Controllers
7. ✅ بناء API Controllers

---

## 📚 المشروع: نظام إدارة مكتبة (Library Management System)

سنبني نظام لإدارة:
- 📖 **Books** (الكتب)
- 👤 **Authors** (المؤلفين)
- 📚 **Categories** (التصنيفات)
- 👥 **Members** (الأعضاء)
- 📝 **Borrowings** (الاستعارات)

---

## الخطوة 1: إعداد المشروع

### إنشاء مشروع Laravel جديد

```bash
composer create-project laravel/laravel library-system
cd library-system
```

### إعداد قاعدة البيانات

في ملف `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=
```

### إنشاء قاعدة البيانات

```sql
CREATE DATABASE library_db;
```

---

## الخطوة 2: إنشاء Models و Migrations

### إنشاء Book Model

```bash
php artisan make:model Book -mcr
```

الأمر `-mcr` يُنشئ:
- `m` = Migration
- `c` = Controller
- `r` = Resource Controller

### تعديل Migration للكتب

```php
// database/migrations/xxxx_create_books_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn')->unique();
            $table->text('description')->nullable();
            $table->integer('pages');
            $table->year('published_year');
            $table->decimal('price', 8, 2);
            $table->integer('quantity')->default(0);
            $table->string('cover_image')->nullable();
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};
```

### إنشاء Author Model

```bash
php artisan make:model Author -mc
```

```php
// database/migrations/xxxx_create_authors_table.php

public function up()
{
    Schema::create('authors', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique()->nullable();
        $table->text('bio')->nullable();
        $table->string('country')->nullable();
        $table->date('birth_date')->nullable();
        $table->timestamps();
    });
}
```

### إنشاء Category Model

```bash
php artisan make:model Category -mc
```

```php
// database/migrations/xxxx_create_categories_table.php

public function up()
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->timestamps();
    });
}
```

### تشغيل Migrations

```bash
php artisan migrate
```

---

## الخطوة 3: إعداد Models

### Book Model

```php
// app/Models/Book.php

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'description',
        'pages',
        'published_year',
        'price',
        'quantity',
        'cover_image',
        'author_id',
        'category_id',
    ];

    // Relationships
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Route Model Binding - استخدم isbn
    public function getRouteKeyName()
    {
        return 'isbn';
    }

    // Accessor للسعر
    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 2) . ' ريال';
    }

    // Scope للكتب المتاحة
    public function scopeAvailable($query)
    {
        return $query->where('quantity', '>', 0);
    }
}
```

### Author Model

```php
// app/Models/Author.php

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'bio', 'country', 'birth_date'];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Relationships
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // عدد الكتب
    public function getBooksCountAttribute()
    {
        return $this->books()->count();
    }
}
```

### Category Model

```php
// app/Models/Category.php

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    // Relationships
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Route Model Binding - استخدم slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
```

---

## الخطوة 4: إنشاء Controllers

### BookController (Resource Controller)

```bash
php artisan make:controller BookController --resource --model=Book
```

```php
// app/Http/Controllers/BookController.php

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of books.
     */
    public function index()
    {
        $books = Book::with(['author', 'category'])
            ->latest()
            ->paginate(12);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'isbn' => 'required|unique:books,isbn',
            'description' => 'nullable',
            'pages' => 'required|integer|min:1',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = Book::create($validated);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'تم إضافة الكتاب بنجاح!');
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        // Route Model Binding يجلب Book تلقائياً
        $book->load(['author', 'category']);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * Update the specified book.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'description' => 'nullable',
            'pages' => 'required|integer|min:1',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book->update($validated);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'تم تحديث الكتاب بنجاح!');
    }

    /**
     * Remove the specified book.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'تم حذف الكتاب بنجاح!');
    }

    /**
     * Search books (custom method).
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $books = Book::with(['author', 'category'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('isbn', 'like', "%{$query}%")
            ->orWhereHas('author', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->paginate(12);

        return view('books.index', compact('books', 'query'));
    }
}
```

### AuthorController

```php
// app/Http/Controllers/AuthorController.php

<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')
            ->orderBy('name')
            ->paginate(20);

        return view('authors.index', compact('authors'));
    }

    public function show(Author $author)
    {
        $author->load('books');

        return view('authors.show', compact('author'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email|unique:authors,email',
            'bio' => 'nullable',
            'country' => 'nullable|max:100',
            'birth_date' => 'nullable|date|before:today',
        ]);

        $author = Author::create($validated);

        return redirect()
            ->route('authors.show', $author)
            ->with('success', 'تم إضافة المؤلف بنجاح!');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email|unique:authors,email,' . $author->id,
            'bio' => 'nullable',
            'country' => 'nullable|max:100',
            'birth_date' => 'nullable|date|before:today',
        ]);

        $author->update($validated);

        return redirect()
            ->route('authors.show', $author)
            ->with('success', 'تم تحديث المؤلف بنجاح!');
    }

    public function destroy(Author $author)
    {
        // تحقق إذا كان لديه كتب
        if ($author->books()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف مؤلف لديه كتب!');
        }

        $author->delete();

        return redirect()
            ->route('authors.index')
            ->with('success', 'تم حذف المؤلف بنجاح!');
    }
}
```

### CategoryController

```php
// app/Http/Controllers/CategoryController.php

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        // استخدام slug في Route Model Binding
        $books = $category->books()
            ->with('author')
            ->paginate(12);

        return view('categories.show', compact('category', 'books'));
    }
}
```

---

## الخطوة 5: إعداد Routes

```php
// routes/web.php

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

// الصفحة الرئيسية
Route::get('/', function () {
    $recentBooks = \App\Models\Book::with(['author', 'category'])
        ->latest()
        ->take(6)
        ->get();

    return view('welcome', compact('recentBooks'));
})->name('home');

// Books Routes
Route::resource('books', BookController::class);
Route::get('books-search', [BookController::class, 'search'])->name('books.search');

// Authors Routes
Route::resource('authors', AuthorController::class);

// Categories Routes
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
```

### عرض جميع Routes:

```bash
php artisan route:list
```

النتيجة:

```
+--------+----------+------------------------+-------------------+
| Method | URI      | Name                   | Action            |
+--------+----------+------------------------+-------------------+
| GET    | /        | home                   | Closure           |
| GET    | books    | books.index            | BookController@index |
| GET    | books/create | books.create       | BookController@create |
| POST   | books    | books.store            | BookController@store |
| GET    | books/{book} | books.show         | BookController@show |
| GET    | books/{book}/edit | books.edit    | BookController@edit |
| PUT    | books/{book} | books.update       | BookController@update |
| DELETE | books/{book} | books.destroy      | BookController@destroy |
| GET    | authors  | authors.index          | AuthorController@index |
...
```

---

## الخطوة 6: إنشاء Views

### Layout الرئيسي

```blade
<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'نظام إدارة المكتبة')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">📚 نظام المكتبة</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">الكتب</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('authors.index') }}">المؤلفون</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">التصنيفات</a>
                    </li>
                </ul>
                <form class="d-flex" action="{{ route('books.search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="ابحث عن كتاب...">
                    <button class="btn btn-light" type="submit">بحث</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="container my-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2025 نظام إدارة المكتبة - Laravel Learning</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

### Books Index View

```blade
<!-- resources/views/books/index.blade.php -->

@extends('layouts.app')

@section('title', 'قائمة الكتب')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📚 قائمة الكتب</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> إضافة كتاب جديد
    </a>
</div>

@if(isset($query))
    <div class="alert alert-info">
        نتائج البحث عن: <strong>{{ $query }}</strong>
    </div>
@endif

@if($books->count() > 0)
    <div class="row">
        @foreach($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text text-muted">
                            <i class="bi bi-person"></i> {{ $book->author->name }}<br>
                            <i class="bi bi-tag"></i> {{ $book->category->name }}<br>
                            <i class="bi bi-hash"></i> {{ $book->isbn }}<br>
                            <i class="bi bi-currency-dollar"></i> {{ $book->price_formatted }}
                        </p>
                        @if($book->quantity > 0)
                            <span class="badge bg-success">متوفر ({{ $book->quantity }})</span>
                        @else
                            <span class="badge bg-danger">غير متوفر</span>
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary">عرض التفاصيل</a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">تعديل</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@else
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle"></i> لا توجد كتب حالياً.
    </div>
@endif
@endsection
```

### Books Show View

```blade
<!-- resources/views/books/show.blade.php -->

@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">{{ $book->title }}</h1>

                <div class="mb-3">
                    <strong>المؤلف:</strong>
                    <a href="{{ route('authors.show', $book->author) }}">{{ $book->author->name }}</a>
                </div>

                <div class="mb-3">
                    <strong>التصنيف:</strong>
                    <a href="{{ route('categories.show', $book->category) }}">{{ $book->category->name }}</a>
                </div>

                <div class="mb-3">
                    <strong>ISBN:</strong> {{ $book->isbn }}
                </div>

                <div class="mb-3">
                    <strong>عدد الصفحات:</strong> {{ $book->pages }} صفحة
                </div>

                <div class="mb-3">
                    <strong>سنة النشر:</strong> {{ $book->published_year }}
                </div>

                <div class="mb-3">
                    <strong>السعر:</strong> {{ $book->price_formatted }}
                </div>

                <div class="mb-3">
                    <strong>الحالة:</strong>
                    @if($book->quantity > 0)
                        <span class="badge bg-success">متوفر ({{ $book->quantity }} نسخة)</span>
                    @else
                        <span class="badge bg-danger">غير متوفر</span>
                    @endif
                </div>

                @if($book->description)
                    <div class="mb-3">
                        <strong>الوصف:</strong>
                        <p>{{ $book->description }}</p>
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> تعديل
                </a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> حذف
                    </button>
                </form>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-right"></i> العودة للقائمة
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
```

---

## الخطوة 7: إنشاء API Controllers

### إنشاء API Controller

```bash
php artisan make:controller API/BookController --api --model=Book
```

```php
// app/Http/Controllers/API/BookController.php

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of books.
     */
    public function index()
    {
        $books = Book::with(['author', 'category'])
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'isbn' => 'required|unique:books,isbn',
            'pages' => 'required|integer|min:1',
            'published_year' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = Book::create($validated);
        $book->load(['author', 'category']);

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully',
            'data' => $book
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        $book->load(['author', 'category']);

        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }

    /**
     * Update the specified book.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|max:255',
            'isbn' => 'sometimes|unique:books,isbn,' . $book->id,
            'pages' => 'sometimes|integer|min:1',
            'published_year' => 'sometimes|integer',
            'price' => 'sometimes|numeric|min:0',
            'quantity' => 'sometimes|integer|min:0',
            'author_id' => 'sometimes|exists:authors,id',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $book->update($validated);
        $book->load(['author', 'category']);

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully',
            'data' => $book
        ]);
    }

    /**
     * Remove the specified book.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully'
        ]);
    }
}
```

### API Routes

```php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;

Route::prefix('v1')->group(function () {
    Route::apiResource('books', BookController::class);
});
```

### اختبار API:

```bash
# GET all books
curl http://localhost:8000/api/v1/books

# GET single book
curl http://localhost:8000/api/v1/books/1

# POST create book
curl -X POST http://localhost:8000/api/v1/books \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Laravel من الصفر",
    "isbn": "978-1234567890",
    "pages": 350,
    "published_year": 2024,
    "price": 99.99,
    "quantity": 10,
    "author_id": 1,
    "category_id": 1
  }'
```

---

## الخطوة 8: استخدام Middleware في Controllers

### إضافة Authentication Middleware

```php
// app/Http/Controllers/BookController.php

class BookController extends Controller
{
    public function __construct()
    {
        // جميع methods تحتاج authentication
        $this->middleware('auth');

        // فقط create, store, destroy تحتاج admin
        $this->middleware('admin')->only(['create', 'store', 'destroy']);

        // كل شيء ما عدا index و show
        $this->middleware('verified')->except(['index', 'show']);
    }
}
```

---

## 🎯 تمرين عملي

### المطلوب:

1. ✅ أضف Model و Controller جديد للـ **Members** (الأعضاء)
2. ✅ أضف Model و Controller للـ **Borrowings** (الاستعارات)
3. ✅ أنشئ صفحة لعرض تاريخ استعارات كل عضو
4. ✅ أنشئ API endpoint لاستعارة وإرجاع كتاب

### الحل المقترح:

```bash
# إنشاء Models و Controllers
php artisan make:model Member -mcr
php artisan make:model Borrowing -mcr
```

---

## 📌 خلاصة

في هذا الجزء العملي تعلمت:

1. ✅ إنشاء Controllers مختلفة (Resource, API, Single Action)
2. ✅ ربط Routes بـ Controllers
3. ✅ استخدام Route Model Binding
4. ✅ تمرير البيانات من Controller إلى View
5. ✅ Validation في Controllers
6. ✅ استخدام Middleware في Controllers
7. ✅ بناء CRUD كامل لنظام المكتبة

---

**الدرس التالي**: Views و Blade Template Engine 🎨
