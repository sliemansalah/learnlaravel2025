# Lesson 8 - Quick Reference Card

## ✅ Basic Validation

```php
// In Controller
$validated = $request->validate([
    'title' => 'required|max:255',
    'email' => 'required|email',
    'age' => 'required|integer|min:18',
]);

// Custom messages
$request->validate([...], [
    'title.required' => 'Title is required',
]);
```

---

## 📋 Validation Rules

### String
```php
'name' => 'required|string|min:3|max:255'
'username' => 'alpha_num'
'code' => 'alpha_dash'
'url' => 'url'
```

### Numbers
```php
'age' => 'integer|min:18|max:100'
'price' => 'numeric|min:0'
'quantity' => 'digits:4'
'amount' => 'between:10,1000'
```

### Date
```php
'birth_date' => 'date|before:today'
'start_date' => 'date|after:today'
'end_date' => 'date|after:start_date'
```

### Email
```php
'email' => 'required|email'
'email' => 'email:rfc,dns'
```

### Database
```php
'email' => 'unique:users,email'
'email' => 'unique:users,email,' . $userId
'category_id' => 'exists:categories,id'
```

### Boolean
```php
'agree' => 'required|accepted'
'active' => 'boolean'
```

### Files
```php
'avatar' => 'image|max:2048'
'avatar' => 'image|mimes:jpeg,png,jpg'
'document' => 'file|mimes:pdf,doc,docx|max:10240'
'avatar' => 'dimensions:min_width=100,min_height=100'
```

### Advanced
```php
'status' => 'in:pending,approved,rejected'
'username' => 'not_in:admin,root'
'password_confirmation' => 'same:password'
'new_password' => 'different:old_password'
'phone' => 'required_if:contact_method,phone'
'email' => 'required_unless:contact_method,phone'
'last_name' => 'required_with:first_name'
'phone' => 'required_without:email'
```

---

## 📝 Form Request Classes

### Create
```bash
php artisan make:request StorePostRequest
```

### Code
```php
class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or auth()->check()
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'post title',
        ];
    }
}
```

### Usage
```php
public function store(StorePostRequest $request)
{
    $validated = $request->validated();
    Post::create($validated);
}
```

---

## 🎨 Custom Rules

### Create
```bash
php artisan make:rule Uppercase
```

### Code
```php
class Uppercase implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strtoupper($value) !== $value) {
            $fail('Field must be uppercase');
        }
    }
}
```

### Usage
```php
use App\Rules\Uppercase;

'code' => ['required', new Uppercase],
```

---

## 📦 Array Validation

```php
// Simple array
'tags' => 'required|array|min:1|max:5',
'tags.*' => 'string|max:50',

// Nested array
'products' => 'required|array',
'products.*.name' => 'required|string',
'products.*.price' => 'required|numeric',
'products.*.images' => 'nullable|array',
'products.*.images.*' => 'image|max:2048',
```

---

## 🔄 Conditional Validation

```php
public function rules(): array
{
    $rules = ['title' => 'required'];

    if ($this->input('type') === 'video') {
        $rules['video_url'] = 'required|url';
    }

    if ($this->isMethod('PUT')) {
        $rules['email'] = 'unique:users,email,' . $this->route('user');
    }

    return $rules;
}
```

---

## 🎯 Display Errors

### All errors
```blade
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
```

### Specific field
```blade
@error('title')
    <div>{{ $message }}</div>
@enderror
```

### In Input
```blade
<input name="title" value="{{ old('title') }}" class="@error('title') is-invalid @enderror">
```

---

## 💡 Quick Examples

### User Registration
```php
$request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8|confirmed',
    'avatar' => 'nullable|image|max:2048',
]);
```

### Create Post
```php
$request->validate([
    'title' => 'required|max:255',
    'content' => 'required|min:100',
    'category_id' => 'required|exists:categories,id',
    'tags' => 'array|max:5',
    'tags.*' => 'exists:tags,id',
]);
```

### File Upload
```php
$request->validate([
    'photos' => 'required|array|min:1|max:5',
    'photos.*' => 'image|max:2048',
]);
```

---

## ✅ Best Practices

✅ Use Form Requests
✅ Use validated() only
✅ Clear user messages
✅ Use old() in forms
✅ Custom Rules for complex logic

❌ Don't use all() instead of validated()
❌ Don't forget authorize()
❌ Don't use weak rules

---

## 🔗 Quick Links

- [Main Lesson](./README-EN.md)
- [Previous Lesson](../lesson-07/README-EN.md)
- [Next Lesson](../lesson-09/README-EN.md)
