# دليل التطبيق العملي للدرس الثامن

## 🚀 نماذج Validation المنفذة

### 1. Form Request: تسجيل مستخدم

**إنشاء:**
```bash
php artisan make:request StoreUserRequest
```

**الكود:**
```php
class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|regex:/^[0-9]{10}$/',
            'birth_date' => 'required|date|before:today',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'agree_terms' => 'required|accepted',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique' => 'البريد الإلكتروني مستخدم مسبقاً',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed' => 'تأكيد كلمة المرور غير مطابق',
            'agree_terms.accepted' => 'يجب الموافقة على الشروط',
        ];
    }
}
```

**الاستخدام في Controller:**
```php
public function store(StoreUserRequest $request)
{
    $validated = $request->validated();

    if ($request->hasFile('avatar')) {
        $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    $validated['password'] = Hash::make($validated['password']);

    User::create($validated);

    return redirect()->route('users.index')->with('success', 'تم التسجيل بنجاح');
}
```

---

### 2. Form Request: إنشاء منشور

```php
class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug|max:255',
            'content' => 'required|string|min:100',
            'excerpt' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array|max:5',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'published_at' => 'required_if:status,published|nullable|date|after_or_equal:today',
        ];
    }
}
```

---

### 3. Custom Rule: كلمة مرور قوية

**إنشاء:**
```bash
php artisan make:rule StrongPassword
```

**الكود:**
```php
class StrongPassword implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/[A-Z]/', $value)) {
            $fail('يجب أن تحتوي كلمة المرور على حرف كبير واحد على الأقل');
            return;
        }

        if (!preg_match('/[a-z]/', $value)) {
            $fail('يجب أن تحتوي كلمة المرور على حرف صغير واحد على الأقل');
            return;
        }

        if (!preg_match('/[0-9]/', $value)) {
            $fail('يجب أن تحتوي كلمة المرور على رقم واحد على الأقل');
            return;
        }

        if (!preg_match('/[@$!%*?&]/', $value)) {
            $fail('يجب أن تحتوي كلمة المرور على رمز خاص واحد على الأقل');
        }
    }
}
```

**الاستخدام:**
```php
use App\Rules\StrongPassword;

$request->validate([
    'password' => ['required', 'min:8', new StrongPassword],
]);
```

---

### 4. Form Request: طلب شراء

```php
class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',

            'payment_method' => 'required|in:cash,card,transfer',
            'card_number' => 'required_if:payment_method,card|digits:16',
            'card_cvv' => 'required_if:payment_method,card|digits:3',

            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_zip' => 'required|digits:5',
            'notes' => 'nullable|string|max:1000',
        ];
    }
}
```

---

## 🎯 أمثلة Blade

### نموذج مع Validation Errors

```blade
<form action="{{ route('posts.store') }}" method="POST">
    @csrf

    {{-- عرض جميع الأخطاء --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- حقل العنوان --}}
    <div class="form-group">
        <label for="title">العنوان</label>
        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title') }}"
            class="form-control @error('title') is-invalid @enderror"
        >
        @error('title')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    {{-- حقل المحتوى --}}
    <div class="form-group">
        <label for="content">المحتوى</label>
        <textarea
            name="content"
            id="content"
            class="form-control @error('content') is-invalid @enderror"
        >{{ old('content') }}</textarea>
        @error('content')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    {{-- حقل التصنيف --}}
    <div class="form-group">
        <label for="category_id">التصنيف</label>
        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
            <option value="">اختر التصنيف</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">حفظ</button>
</form>
```

---

## 💡 أمثلة Validation مختلفة

### 1. Validation في Controller

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ], [
        'title.required' => 'العنوان مطلوب',
        'title.max' => 'العنوان يجب ألا يتجاوز 255 حرف',
    ]);

    Post::create($validated);
}
```

### 2. Array Validation

```php
$request->validate([
    'products' => 'required|array|min:1',
    'products.*.name' => 'required|string|max:255',
    'products.*.price' => 'required|numeric|min:0',
    'products.*.quantity' => 'required|integer|min:1',
]);
```

### 3. Conditional Validation

```php
public function rules(): array
{
    $rules = [
        'title' => 'required|string|max:255',
    ];

    if ($this->input('type') === 'video') {
        $rules['video_url'] = 'required|url';
        $rules['duration'] => 'required|integer';
    }

    return $rules;
}
```

---

## 📝 أوامر مفيدة

```bash
# إنشاء Form Request
php artisan make:request StorePostRequest
php artisan make:request UpdatePostRequest

# إنشاء Custom Rule
php artisan make:rule Uppercase
php artisan make:rule StrongPassword
```

---

## ✅ أفضل الممارسات

1. استخدم Form Requests للـ validation المعقد
2. استخدم validated() بدلاً من all()
3. اكتب رسائل خطأ واضحة بالعربية
4. استخدم old() للحفاظ على القيم
5. استخدم Custom Rules للمنطق المعقد
6. تحقق من authorization() في Form Request

---

## 📚 الخطوة التالية

**الدرس 9**: File Upload and Storage

---

**تعلم سعيد! 🚀**
