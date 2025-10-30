# Lesson 4 - Practical Application Guide

## 🚀 How to Run the Project

```bash
cd D:\learnlaravel2025\lessons\lesson-04\practice-app
php artisan serve
```

Server will run on: `http://localhost:8000`

---

## 📋 Available Routes and Pages

### 1. Basic Pages
- **GET** `/` - Home page (with Layout)
- **GET** `/about` - About us
- **GET** `/services` - Our services

### 2. Blade Examples
- **GET** `/blade/conditionals` - Conditional examples
- **GET** `/blade/loops` - Loop examples
- **GET** `/blade/components` - Component examples

### 3. Products
- **GET** `/products` - Product list (with Components)
- **GET** `/products/{id}` - Product details

### 4. Forms
- **GET** `/contact` - Contact form
- **POST** `/contact` - Submit form

---

## ✅ Implemented Files

### 1. Main Layout

**File `resources/views/layouts/app.blade.php`:**

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Site')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        nav { background: #667eea; padding: 15px; }
        nav a { color: white; margin: 0 10px; text-decoration: none; }
        footer { background: #333; color: white; text-align: center; padding: 20px; margin-top: 50px; }
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
```

---

### 2. Components Created

- **Alert Component** - `resources/views/components/alert.blade.php`
- **Card Component** - `resources/views/components/card.blade.php`

### 3. Example Pages

- Conditionals demonstration
- Loops with $loop variable
- Products list with components
- Contact form with validation

---

## 🎯 What We Learned

### 1. Layouts
- ✅ Create main Layout with `@extends`
- ✅ Use `@section` and `@yield`
- ✅ `@stack` and `@push` for CSS/JS

### 2. Components
- ✅ Create reusable Components
- ✅ Use `@props` for properties
- ✅ `{{ $slot }}` for content

### 3. Conditionals & Loops
- ✅ `@if`, `@foreach`, `@forelse`
- ✅ Use `$loop` for iteration info
- ✅ `@auth`, `@guest` for user checks

### 4. Forms
- ✅ `@csrf` for protection
- ✅ `@error` for validation errors
- ✅ `old()` to retain values

---

## 📝 Useful Commands

```bash
# Create Component
php artisan make:component Alert

# Create Component with Class
php artisan make:component Button --class

# Clear Views cache
php artisan view:clear

# Start server
php artisan serve
```

---

## 🔍 Testing Pages

1. ✅ `http://localhost:8000/` - Home page
2. ✅ `http://localhost:8000/blade/conditionals` - Conditionals
3. ✅ `http://localhost:8000/blade/loops` - Loops
4. ✅ `http://localhost:8000/products` - Products
5. ✅ `http://localhost:8000/contact` - Contact form

---

## 💡 Tips

1. **Use Layouts** for reusing structure
2. **Components** are useful for repeated elements
3. **@forelse** is better than @foreach for potentially empty lists
4. **Don't forget @csrf** in all forms
5. **Use @error** to display error messages

---

## 📚 Next Step

After completing this lesson, you're ready for:

**Lesson 5**: Databases and Migrations
- Creating databases
- Migrations
- Schema Builder

---

**Happy Learning! 🚀**
