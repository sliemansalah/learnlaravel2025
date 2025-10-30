# الدرس 8 - بطاقة مرجعية سريعة

## ✅ Basic Validation

```php
// في Controller
$validated = $request->validate([
    'title' => 'required|max:255',
    'email' => 'required|email',
    'age' => 'required|integer|min:18',
]);

// رسائل مخصصة
$request->validate([...], [
    'title.required' => 'العنوان مطلوب',
]);
```

---

## 📋 Validation Rules

### نص
```php
'name' => 'required|string|min:3|max:255'
'username' => 'alpha_num'
'code' => 'alpha_dash'
'url' => 'url'
```

### أرقام
```php
'age' => 'integer|min:18|max:100'
'price' => 'numeric|min:0'
'quantity' => 'digits:4'
'amount' => 'between:10,1000'
```

### تاريخ
```php
'birth_date' => 'date|before:today'
'start_date' => 'date|after:today'
'end_date' => 'date|after:start_date'
```

### بريد
```php
'email' => 'required|email'
'email' => 'email:rfc,dns'
```

### قاعدة بيانات
```php
'email' => 'unique:users,email'
'email' => 'unique:users,email,' . $userId
'category_id' => 'exists:categories,id'
```

### منطقي
```php
'agree' => 'required|accepted'
'active' => 'boolean'
```

### ملفات
```php
'avatar' => 'image|max:2048'
'avatar' => 'image|mimes:jpeg,png,jpg'
'document' => 'file|mimes:pdf,doc,docx|max:10240'
'avatar' => 'dimensions:min_width=100,min_height=100'
```

### متقدم
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

### إنشاء
```bash
php artisan make:request StorePostRequest
```

### الكود
```php
class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // أو auth()->check()
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
            'title.required' => 'العنوان مطلوب',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'عنوان المنشور',
        ];
    }
}
```

### الاستخدام
```php
public function store(StorePostRequest $request)
{
    $validated = $request->validated();
    Post::create($validated);
}
```

---

## 🎨 Custom Rules

### إنشاء
```bash
php artisan make:rule Uppercase
```

### الكود
```php
class Uppercase implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strtoupper($value) !== $value) {
            $fail('الحقل يجب أن يكون بأحرف كبيرة');
        }
    }
}
```

### الاستخدام
```php
use App\Rules\Uppercase;

'code' => ['required', new Uppercase],
```

---

## 📦 Array Validation

```php
// Array بسيط
'tags' => 'required|array|min:1|max:5',
'tags.*' => 'string|max:50',

// Array متداخل
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

## 🎯 عرض الأخطاء

### جميع الأخطاء
```blade
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
```

### خطأ حقل محدد
```blade
@error('title')
    <div>{{ $message }}</div>
@enderror
```

### في Input
```blade
<input name="title" value="{{ old('title') }}" class="@error('title') is-invalid @enderror">
```

---

## 💡 أمثلة سريعة

### تسجيل مستخدم
```php
$request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8|confirmed',
    'avatar' => 'nullable|image|max:2048',
]);
```

### إنشاء منشور
```php
$request->validate([
    'title' => 'required|max:255',
    'content' => 'required|min:100',
    'category_id' => 'required|exists:categories,id',
    'tags' => 'array|max:5',
    'tags.*' => 'exists:tags,id',
]);
```

### رفع ملفات
```php
$request->validate([
    'photos' => 'required|array|min:1|max:5',
    'photos.*' => 'image|max:2048',
]);
```

---

## ✅ أفضل الممارسات

✅ استخدم Form Requests
✅ استخدم validated() فقط
✅ رسائل واضحة للمستخدم
✅ استخدم old() في النماذج
✅ Custom Rules للمنطق المعقد

❌ لا تستخدم all() بدلاً من validated()
❌ لا تنسى authorize()
❌ لا تستخدم قواعد ضعيفة

---

## 🔗 روابط سريعة

- [الدرس الرئيسي](./README.md)
- [الدرس السابق](../lesson-07/README.md)
- [الدرس التالي](../lesson-09/README.md)
