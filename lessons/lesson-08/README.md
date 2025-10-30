# الدرس 8: Validation and Form Requests

## 📚 المحتويات

1. [مقدمة عن Validation](#مقدمة-عن-validation)
2. [Basic Validation](#basic-validation)
3. [Validation Rules](#validation-rules)
4. [Custom Error Messages](#custom-error-messages)
5. [Form Request Classes](#form-request-classes)
6. [Custom Validation Rules](#custom-validation-rules)
7. [Conditional Validation](#conditional-validation)
8. [Array Validation](#array-validation)
9. [File Validation](#file-validation)
10. [أمثلة عملية](#أمثلة-عملية)

---

## مقدمة عن Validation

### ما هو Validation؟

**Validation** = التحقق من صحة البيانات قبل معالجتها أو حفظها في قاعدة البيانات.

```
User Input → Validation → ✅ Valid → Process
                      → ❌ Invalid → Show Errors
```

### لماذا Validation مهم؟

✅ حماية قاعدة البيانات من البيانات الخاطئة
✅ تحسين تجربة المستخدم برسائل واضحة
✅ منع الثغرات الأمنية
✅ ضمان تناسق البيانات

---

## Basic Validation

### في Controller

```php
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'email' => 'required|email',
        ]);

        // البيانات صحيحة - يمكن حفظها
        Post::create($validated);

        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }
}
```

### عرض الأخطاء في Blade

```blade
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- خطأ حقل محدد --}}
@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

{{-- في الـ input --}}
<input type="text" name="title" value="{{ old('title') }}" class="@error('title') is-invalid @enderror">
@error('title')
    <span class="invalid-feedback">{{ $message }}</span>
@enderror
```

### الحصول على القيم القديمة

```blade
<input type="text" name="title" value="{{ old('title') }}">
<textarea name="content">{{ old('content') }}</textarea>
<input type="email" name="email" value="{{ old('email', $user->email) }}">
```

---

## Validation Rules

### القواعد الأساسية

```php
$request->validate([
    // مطلوب
    'name' => 'required',

    // نص
    'title' => 'required|string|max:255',
    'bio' => 'nullable|string|max:500',

    // بريد إلكتروني
    'email' => 'required|email|unique:users,email',

    // رقم
    'age' => 'required|integer|min:18|max:100',
    'price' => 'required|numeric|min:0',

    // تاريخ
    'birth_date' => 'required|date',
    'published_at' => 'nullable|date|after:today',

    // منطقي
    'agree' => 'required|accepted',
    'active' => 'boolean',

    // URL
    'website' => 'nullable|url',

    // Confirmation
    'password' => 'required|string|min:8|confirmed',
    // يجب وجود password_confirmation
]);
```

### قواعد النصوص

```php
'name' => [
    'required',
    'string',
    'min:3',           // 3 أحرف على الأقل
    'max:255',         // 255 حرف كحد أقصى
    'alpha',           // حروف فقط
    'alpha_num',       // حروف وأرقام
    'alpha_dash',      // حروف وأرقام و - _
],

'username' => 'required|string|regex:/^[a-zA-Z0-9_]+$/',
```

### قواعد الأرقام

```php
'age' => [
    'required',
    'integer',
    'min:18',          // 18 كحد أدنى
    'max:100',         // 100 كحد أقصى
    'between:18,65',   // بين 18 و 65
],

'price' => 'required|numeric|min:0|max:999999.99',
'quantity' => 'required|integer|digits:4', // 4 أرقام بالضبط
```

### قواعد التاريخ

```php
'birth_date' => [
    'required',
    'date',
    'before:today',        // قبل اليوم
    'after:2000-01-01',    // بعد تاريخ محدد
],

'start_date' => 'required|date',
'end_date' => 'required|date|after:start_date',

'published_at' => 'nullable|date|after_or_equal:today',
```

### قواعد قاعدة البيانات

```php
// Unique - فريد
'email' => 'required|email|unique:users,email',

// Unique مع استثناء (عند التحديث)
'email' => 'required|email|unique:users,email,' . $userId,

// أو
'email' => [
    'required',
    'email',
    Rule::unique('users', 'email')->ignore($user->id),
],

// Exists - موجود
'category_id' => 'required|exists:categories,id',
'user_id' => 'required|exists:users,id,active,1', // مع شرط
```

### قواعد الملفات

```php
'avatar' => [
    'required',
    'image',                        // صورة فقط
    'mimes:jpeg,png,jpg,gif',       // أنواع محددة
    'max:2048',                     // 2MB كحد أقصى
    'dimensions:min_width=100,min_height=100',
],

'document' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB

'video' => 'required|mimetypes:video/mp4,video/avi|max:51200', // 50MB
```

### قواعد متقدمة

```php
// In - ضمن قائمة
'status' => 'required|in:pending,approved,rejected',
'role' => 'required|in:admin,editor,viewer',

// Not In - ليس ضمن قائمة
'username' => 'required|not_in:admin,root,system',

// Same - مطابق لحقل آخر
'password_confirmation' => 'required|same:password',

// Different - مختلف عن حقل آخر
'new_password' => 'required|different:old_password',

// Required If - مطلوب إذا
'phone' => 'required_if:contact_method,phone',
'shipping_address' => 'required_if:delivery_type,home',

// Required Unless - مطلوب ما لم
'email' => 'required_unless:contact_method,phone',

// Required With - مطلوب مع
'last_name' => 'required_with:first_name',

// Required Without - مطلوب بدون
'phone' => 'required_without:email',
```

---

## Custom Error Messages

### رسائل مخصصة في validate()

```php
$request->validate([
    'title' => 'required|max:255',
    'email' => 'required|email',
], [
    'title.required' => 'عنوان المنشور مطلوب',
    'title.max' => 'العنوان يجب ألا يتجاوز 255 حرف',
    'email.required' => 'البريد الإلكتروني مطلوب',
    'email.email' => 'البريد الإلكتروني غير صحيح',
]);
```

### أسماء الحقول المخصصة

```php
$request->validate([
    'title' => 'required',
    'email' => 'required|email',
], [], [
    'title' => 'عنوان المنشور',
    'email' => 'البريد الإلكتروني',
]);
// الرسالة: "عنوان المنشور مطلوب"
```

### رسائل مخصصة في ملف اللغة

**resources/lang/ar/validation.php:**
```php
return [
    'required' => 'حقل :attribute مطلوب',
    'email' => 'حقل :attribute يجب أن يكون بريد إلكتروني صحيح',
    'max' => [
        'string' => 'حقل :attribute يجب ألا يتجاوز :max حرف',
    ],

    'attributes' => [
        'email' => 'البريد الإلكتروني',
        'title' => 'العنوان',
        'content' => 'المحتوى',
    ],
];
```

---

## Form Request Classes

### ما هو Form Request؟

**Form Request** = كلاس منفصل للـ Validation يجعل الكود أنظف وأسهل في الصيانة.

### إنشاء Form Request

```bash
php artisan make:request StorePostRequest
```

**app/Http/Requests/StorePostRequest.php:**
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * تحديد ما إذا كان المستخدم مصرحاً له
     */
    public function authorize(): bool
    {
        return true; // أو auth()->check()
    }

    /**
     * قواعد الـ Validation
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'published_at' => 'nullable|date|after_or_equal:today',
        ];
    }

    /**
     * رسائل الأخطاء المخصصة
     */
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان المنشور مطلوب',
            'title.max' => 'العنوان يجب ألا يتجاوز 255 حرف',
            'content.required' => 'محتوى المنشور مطلوب',
            'category_id.required' => 'التصنيف مطلوب',
            'category_id.exists' => 'التصنيف المختار غير موجود',
        ];
    }

    /**
     * أسماء الحقول المخصصة
     */
    public function attributes(): array
    {
        return [
            'title' => 'عنوان المنشور',
            'content' => 'محتوى المنشور',
            'category_id' => 'التصنيف',
        ];
    }
}
```

### الاستخدام في Controller

```php
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function store(StorePostRequest $request)
    {
        // البيانات صحيحة تلقائياً
        $validated = $request->validated();

        Post::create($validated);

        return redirect()->route('posts.index')
                        ->with('success', 'تم إنشاء المنشور بنجاح');
    }
}
```

### Authorization في Form Request

```php
public function authorize(): bool
{
    // السماح للجميع
    return true;

    // السماح للمستخدمين المسجلين فقط
    return auth()->check();

    // السماح للمستخدم صاحب المنشور فقط
    $post = Post::find($this->route('post'));
    return $post && $this->user()->id === $post->user_id;

    // السماح للمشرفين فقط
    return $this->user()->hasRole('admin');
}
```

---

## Custom Validation Rules

### إنشاء Custom Rule

```bash
php artisan make:rule Uppercase
```

**app/Rules/Uppercase.php:**
```php
<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Uppercase implements ValidationRule
{
    /**
     * التحقق من القاعدة
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strtoupper($value) !== $value) {
            $fail('حقل :attribute يجب أن يكون بأحرف كبيرة');
        }
    }
}
```

### الاستخدام

```php
use App\Rules\Uppercase;

$request->validate([
    'code' => ['required', 'string', new Uppercase],
]);
```

### Custom Rule مع Parameters

```php
<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxWords implements ValidationRule
{
    protected $maxWords;

    public function __construct($maxWords)
    {
        $this->maxWords = $maxWords;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $wordCount = str_word_count($value);

        if ($wordCount > $this->maxWords) {
            $fail("حقل :attribute يجب ألا يتجاوز {$this->maxWords} كلمة");
        }
    }
}
```

**الاستخدام:**
```php
use App\Rules\MaxWords;

$request->validate([
    'summary' => ['required', 'string', new MaxWords(50)],
]);
```

### Closure Rule (قاعدة مباشرة)

```php
use Illuminate\Validation\Rule;

$request->validate([
    'email' => [
        'required',
        'email',
        function ($attribute, $value, $fail) {
            if (!str_ends_with($value, '@company.com')) {
                $fail('يجب أن ينتهي البريد بـ @company.com');
            }
        },
    ],
]);
```

---

## Conditional Validation

### Sometimes Validation

```php
$validator = Validator::make($request->all(), [
    'email' => 'required|email',
]);

$validator->sometimes('reason', 'required|max:500', function ($input) {
    return $input->status === 'rejected';
});

if ($validator->fails()) {
    return redirect()->back()->withErrors($validator);
}
```

### Conditional Rules في Form Request

```php
public function rules(): array
{
    $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];

    if ($this->input('type') === 'video') {
        $rules['video_url'] = 'required|url';
        $rules['duration'] = 'required|integer';
    }

    if ($this->isMethod('PUT')) {
        $rules['email'] = 'required|email|unique:users,email,' . $this->route('user');
    } else {
        $rules['email'] = 'required|email|unique:users,email';
    }

    return $rules;
}
```

---

## Array Validation

### التحقق من Arrays

```php
$request->validate([
    // Array مطلوب
    'tags' => 'required|array',

    // Array بحد أدنى وأقصى
    'tags' => 'required|array|min:1|max:5',

    // كل عنصر في Array
    'tags.*' => 'string|max:50',

    // Array من IDs موجودة
    'category_ids' => 'required|array',
    'category_ids.*' => 'exists:categories,id',
]);
```

### Array متداخل

```php
$request->validate([
    'products' => 'required|array|min:1',
    'products.*.name' => 'required|string|max:255',
    'products.*.price' => 'required|numeric|min:0',
    'products.*.quantity' => 'required|integer|min:1',

    'products.*.images' => 'nullable|array',
    'products.*.images.*' => 'image|max:2048',
]);
```

### مثال عملي

```php
// الطلب:
[
    'products' => [
        [
            'name' => 'Product 1',
            'price' => 100,
            'quantity' => 5,
            'images' => [/* files */],
        ],
        [
            'name' => 'Product 2',
            'price' => 200,
            'quantity' => 3,
        ],
    ],
]

// Validation:
$validated = $request->validate([
    'products' => 'required|array|min:1',
    'products.*.name' => 'required|string|max:255',
    'products.*.price' => 'required|numeric|min:0',
    'products.*.quantity' => 'required|integer|min:1',
    'products.*.images' => 'nullable|array',
    'products.*.images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
]);
```

---

## File Validation

### التحقق من الملفات

```php
$request->validate([
    // ملف مطلوب
    'document' => 'required|file',

    // صورة
    'avatar' => 'required|image|max:2048', // 2MB

    // أنواع محددة
    'document' => 'required|file|mimes:pdf,doc,docx',

    // حجم محدد
    'video' => 'required|file|max:51200', // 50MB

    // أبعاد الصورة
    'avatar' => [
        'required',
        'image',
        'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
    ],
]);
```

### التحقق المتقدم للصور

```php
use Illuminate\Validation\Rules\File;

$request->validate([
    'avatar' => [
        'required',
        File::image()
            ->min(100)              // 100KB min
            ->max(2048)             // 2MB max
            ->dimensions(Rule::dimensions()
                ->minWidth(100)
                ->minHeight(100)
                ->maxWidth(1000)
                ->maxHeight(1000)
            ),
    ],
]);
```

### رفع عدة ملفات

```php
$request->validate([
    'photos' => 'required|array|min:1|max:5',
    'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
]);

// معالجة الملفات
foreach ($request->file('photos') as $photo) {
    $path = $photo->store('photos', 'public');
}
```

---

## أمثلة عملية

### مثال 1: نموذج تسجيل مستخدم

**StoreUserRequest.php:**
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
            'avatar' => 'nullable|image|max:2048',
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

### مثال 2: نموذج إنشاء منشور

**StorePostRequest.php:**
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

### مثال 3: نموذج طلب

**StoreOrderRequest.php:**
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

            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_zip' => 'required|digits:5',

            'notes' => 'nullable|string|max:1000',
        ];
    }
}
```

---

## نصائح مهمة

### ✅ أفضل الممارسات

1. **استخدم Form Requests:**
```php
// ✅ جيد - منظم وقابل لإعادة الاستخدام
public function store(StorePostRequest $request)
{
    Post::create($request->validated());
}

// ❌ سيء - كود مكرر في Controller
public function store(Request $request)
{
    $validated = $request->validate([...]);
}
```

2. **استخدم validated() فقط:**
```php
// ✅ جيد - بيانات صحيحة فقط
$validated = $request->validated();
Post::create($validated);

// ❌ خطر - قد تحتوي على بيانات غير صحيحة
Post::create($request->all());
```

3. **رسائل واضحة:**
```php
// ✅ واضح للمستخدم
'title.required' => 'عنوان المنشور مطلوب'

// ❌ غير واضح
'title.required' => 'This field is required'
```

4. **استخدم Custom Rules للمنطق المعقد:**
```php
// ✅ منظم وقابل لإعادة الاستخدام
new Uppercase

// ❌ صعب القراءة
'regex:/^[A-Z]+$/'
```

### ⚠️ أخطاء شائعة

1. **نسيان old() في النماذج:**
```blade
{{-- ❌ تفقد البيانات عند الخطأ --}}
<input name="title">

{{-- ✅ تحتفظ بالبيانات --}}
<input name="title" value="{{ old('title') }}">
```

2. **استخدام all() بدلاً من validated():**
```php
// ❌ خطر أمني
Post::create($request->all());

// ✅ آمن
Post::create($request->validated());
```

3. **نسيان authorize():**
```php
// ❌ أي شخص يمكنه التحديث
public function authorize(): bool
{
    return true;
}

// ✅ فقط صاحب المنشور
public function authorize(): bool
{
    return $this->user()->id === $this->route('post')->user_id;
}
```

---

## الخطوة التالية

بعد إتمام هذا الدرس، أنت الآن جاهز لـ:

**الدرس 9**: File Upload and Storage
- File Upload
- Storage Configuration
- File Management

---

**تعلم سعيد! 🚀**
