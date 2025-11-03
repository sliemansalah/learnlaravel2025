# أمثلة الكود: Forms & Validation

## نظرة عامة

هذا الملف يحتوي على **35 مثال عملي** تغطي جميع جوانب Forms و Validation في Laravel.

---

## القسم 1: HTML Forms الأساسية

### مثال 1: Form بسيط مع POST

```blade
{{-- View --}}
<form action="{{ route('contact.submit') }}" method="POST">
    @csrf

    <div>
        <label for="name">الاسم:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="email">البريد الإلكتروني:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">إرسال</button>
</form>
```

```php
// Controller
public function submit(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email',
    ]);

    // معالجة البيانات
    return redirect()->back()->with('success', 'تم الإرسال بنجاح');
}
```

---

### مثال 2: Form مع Method Spoofing (PUT)

```blade
{{-- View --}}
<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ old('title', $post->title) }}">

    <button type="submit">تحديث</button>
</form>
```

```php
// Routes
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

// Controller
public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
    ]);

    $post->update($validated);

    return redirect()->route('posts.show', $post);
}
```

---

### مثال 3: Form مع DELETE

```blade
<form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">حذف</button>
</form>
```

```php
public function destroy(Post $post)
{
    $post->delete();

    return redirect()->route('posts.index')->with('success', 'تم الحذف');
}
```

---

## القسم 2: CSRF Protection

### مثال 4: CSRF Token في AJAX

```blade
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
// مع jQuery
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.post('/api/data', { name: 'John' }, function(response) {
    console.log(response);
});

// مع Fetch API
fetch('/api/data', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ name: 'John' })
});
</script>
```

---

### مثال 5: استثناء Routes من CSRF

```php
// app/Http/Middleware/VerifyCsrfToken.php
class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'webhook/*',
        'api/payment/callback',
    ];
}
```

---

## القسم 3: استقبال البيانات

### مثال 6: طرق مختلفة لجلب البيانات

```php
public function store(Request $request)
{
    // 1. جلب حقل واحد
    $title = $request->input('title');
    $title = $request->title;  // نفس الشيء

    // 2. جلب مع قيمة افتراضية
    $status = $request->input('status', 'draft');

    // 3. جلب جميع البيانات
    $all = $request->all();

    // 4. جلب بيانات محددة فقط
    $data = $request->only(['title', 'content', 'status']);

    // 5. جلب كل شيء ماعدا محدد
    $data = $request->except(['_token', '_method']);

    // 6. التحقق من وجود حقل
    if ($request->has('title')) {
        // الحقل موجود
    }

    // 7. التحقق من وجود حقل وله قيمة
    if ($request->filled('title')) {
        // الحقل موجود وليس فارغاً
    }

    // 8. التحقق من عدة حقول
    if ($request->hasAny(['title', 'content'])) {
        // واحد منهم على الأقل موجود
    }
}
```

---

### مثال 7: Old Input

```php
// Controller - حفظ القيم عند الخطأ
return redirect('form')->withInput();

// أو تلقائياً عند استخدام validate()
$request->validate([...]); // يحفظ تلقائياً عند الفشل
```

```blade
{{-- View - جلب القيم القديمة --}}
<input type="text" name="title" value="{{ old('title') }}">

{{-- مع قيمة افتراضية --}}
<input type="text" name="email" value="{{ old('email', $user->email) }}">

{{-- في textarea --}}
<textarea name="content">{{ old('content', $post->content) }}</textarea>

{{-- في checkbox --}}
<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>

{{-- في radio --}}
<input type="radio" name="gender" value="male" {{ old('gender') === 'male' ? 'checked' : '' }}>

{{-- في select --}}
<select name="country">
    <option value="sa" {{ old('country') === 'sa' ? 'selected' : '' }}>السعودية</option>
    <option value="eg" {{ old('country') === 'eg' ? 'selected' : '' }}>مصر</option>
</select>
```

---

## القسم 4: Inline Validation

### مثال 8: Validation أساسي

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'email' => 'required|email',
        'age' => 'required|integer|min:18',
    ]);

    // إذا نجح Validation
    Post::create($validated);

    return redirect()->route('posts.index');
}
```

---

### مثال 9: Validation مع رسائل مخصصة

```php
$request->validate(
    [
        'title' => 'required|max:255',
        'email' => 'required|email|unique:users',
    ],
    [
        'title.required' => 'العنوان مطلوب',
        'title.max' => 'العنوان طويل جداً',
        'email.required' => 'البريد الإلكتروني مطلوب',
        'email.email' => 'البريد الإلكتروني غير صحيح',
        'email.unique' => 'البريد الإلكتروني مسجل مسبقاً',
    ]
);
```

---

### مثال 10: Validation مع أسماء مخصصة

```php
$request->validate(
    [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ],
    [
        'email.required' => 'حقل :attribute مطلوب',
    ],
    [
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
    ]
);
```

---

## القسم 5: Manual Validation

### مثال 11: Manual Validation مع تحكم كامل

```php
use Illuminate\Support\Facades\Validator;

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'email' => 'required|email',
    ]);

    // إضافة validation إضافي
    $validator->after(function ($validator) {
        if ($this->somethingElseIsInvalid()) {
            $validator->errors()->add('field', 'هناك خطأ ما!');
        }
    });

    if ($validator->fails()) {
        return redirect('form')
                    ->withErrors($validator)
                    ->withInput();
    }

    $validated = $validator->validated();

    // معالجة البيانات
}
```

---

### مثال 12: Conditional Validation

```php
$validator = Validator::make($request->all(), [
    'email' => 'required|email',
]);

// إضافة قاعدة فقط في حالة معينة
$validator->sometimes('reason', 'required|max:500', function ($input) {
    return $input->status === 'rejected';
});

$validator->sometimes('coupon', 'required|exists:coupons,code', function ($input) {
    return $input->has_discount;
});

if ($validator->fails()) {
    return redirect()->back()->withErrors($validator);
}
```

---

## القسم 6: Validation Rules

### مثال 13: قواعد النصوص

```php
$request->validate([
    'name' => 'required|string|max:255',
    'slug' => 'required|string|alpha_dash',  // أحرف، أرقام، - و _
    'code' => 'required|alpha_num',          // أحرف وأرقام فقط
    'username' => 'required|alpha',          // أحرف فقط
]);
```

---

### مثال 14: قواعد الأرقام

```php
$request->validate([
    'age' => 'required|integer|min:18|max:100',
    'price' => 'required|numeric|min:0',
    'quantity' => 'required|integer|between:1,100',
    'discount' => 'required|numeric|min:0|max:100',
    'rating' => 'required|in:1,2,3,4,5',
]);
```

---

### مثال 15: قواعد قاعدة البيانات

```php
use Illuminate\Validation\Rule;

$request->validate([
    // exists: يجب أن تكون القيمة موجودة
    'category_id' => 'required|exists:categories,id',

    // unique: يجب أن تكون القيمة فريدة
    'email' => 'required|email|unique:users,email',

    // unique مع استثناء (للتحديث)
    'email' => [
        'required',
        'email',
        Rule::unique('users')->ignore($user->id)
    ],

    // مع شروط إضافية
    'email' => [
        'required',
        Rule::unique('users')->where(function ($query) {
            return $query->where('account_type', 'admin');
        })
    ],
]);
```

---

### مثال 16: قواعد المصفوفات

```php
$request->validate([
    // يجب أن يكون مصفوفة
    'tags' => 'required|array|min:1|max:5',

    // التحقق من عناصر المصفوفة
    'tags.*' => 'string|max:50',

    // مصفوفة متعددة الأبعاد
    'users.*.name' => 'required|string|max:255',
    'users.*.email' => 'required|email|unique:users',
    'users.*.age' => 'required|integer|min:18',

    // المفاتيح المحددة
    'metadata.title' => 'required|string',
    'metadata.description' => 'required|string',
]);

// مثال البيانات:
// tags: ['laravel', 'php', 'vue']
// users: [
//     ['name' => 'John', 'email' => 'john@example.com', 'age' => 25],
//     ['name' => 'Jane', 'email' => 'jane@example.com', 'age' => 30],
// ]
```

---

### مثال 17: قواعد التواريخ

```php
$request->validate([
    'birth_date' => 'required|date|before:today',
    'start_date' => 'required|date|after:today',
    'end_date' => 'required|date|after:start_date',
    'appointment' => 'required|date_format:Y-m-d H:i:s',
    'deadline' => 'required|date|before_or_equal:2024-12-31',
    'launch_date' => 'required|date|after_or_equal:2024-01-01',
]);
```

---

### مثال 18: قواعد كلمة المرور

```php
use Illuminate\Validation\Rules\Password;

$request->validate([
    // بسيطة
    'password' => 'required|min:8|confirmed',

    // متقدمة (Laravel 9+)
    'password' => ['required', 'confirmed', Password::min(8)],

    // مع متطلبات محددة
    'password' => [
        'required',
        'confirmed',
        Password::min(8)
            ->letters()           // حرف واحد على الأقل
            ->mixedCase()         // حرف كبير وصغير
            ->numbers()           // رقم واحد على الأقل
            ->symbols()           // رمز واحد على الأقل
            ->uncompromised()     // غير مخترقة
    ],

    // افتراضي للتطبيق
    'password' => ['required', Password::defaults()],
]);

// في AppServiceProvider
use Illuminate\Validation\Rules\Password;

public function boot()
{
    Password::defaults(function () {
        return Password::min(8)
            ->letters()
            ->numbers()
            ->mixedCase();
    });
}
```

---

### مثال 19: قواعد مشروطة

```php
$request->validate([
    // مطلوب إذا كان حقل آخر له قيمة محددة
    'reason' => 'required_if:status,rejected',

    // مطلوب إلا إذا كان حقل آخر له قيمة محددة
    'coupon' => 'required_unless:payment_method,cash',

    // مطلوب مع حقل آخر
    'city' => 'required_with:state',

    // مطلوب مع جميع الحقول
    'zip' => 'required_with_all:city,state,country',

    // مطلوب بدون حقل آخر
    'guest_email' => 'required_without:user_id',

    // قبول (yes, on, 1, true)
    'terms' => 'accepted',

    // قبول إذا
    'privacy' => 'accepted_if:age,>=,18',

    // تأكيد (يجب وجود field_confirmation)
    'password' => 'confirmed',
]);
```

---

## القسم 7: File Upload & Validation

### مثال 20: رفع صورة بسيط

```blade
<form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="file" name="avatar" accept="image/*">

    @error('avatar')
        <span class="error">{{ $message }}</span>
    @enderror

    <button type="submit">رفع</button>
</form>
```

```php
public function upload(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $path = $request->file('avatar')->store('avatars', 'public');

    auth()->user()->update(['avatar' => $path]);

    return back()->with('success', 'تم رفع الصورة');
}
```

---

### مثال 21: رفع ملف مع اسم مخصص

```php
public function upload(Request $request)
{
    $request->validate([
        'document' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB
    ]);

    $file = $request->file('document');

    // إنشاء اسم فريد
    $filename = time() . '_' . $file->getClientOriginalName();

    $path = $file->storeAs('documents', $filename, 'public');

    return back()->with('success', 'تم رفع الملف');
}
```

---

### مثال 22: رفع عدة صور

```blade
<form method="POST" enctype="multipart/form-data">
    @csrf

    <input type="file" name="photos[]" multiple accept="image/*">

    @error('photos')
        <span class="error">{{ $message }}</span>
    @enderror

    @error('photos.*')
        <span class="error">{{ $message }}</span>
    @enderror

    <button type="submit">رفع</button>
</form>
```

```php
public function uploadMultiple(Request $request)
{
    $request->validate([
        'photos' => 'required|array|max:5',
        'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $paths = [];

    foreach ($request->file('photos') as $photo) {
        $paths[] = $photo->store('photos', 'public');
    }

    // حفظ في قاعدة البيانات
    foreach ($paths as $path) {
        Photo::create(['path' => $path]);
    }

    return back()->with('success', 'تم رفع الصور');
}
```

---

### مثال 23: Validation أبعاد الصورة

```php
$request->validate([
    'banner' => [
        'required',
        'image',
        'dimensions:min_width=1920,min_height=1080',
    ],

    // أو أبعاد محددة بالضبط
    'thumbnail' => [
        'required',
        'image',
        'dimensions:width=400,height=300',
    ],

    // أو مع ratio
    'cover' => [
        'required',
        'image',
        'dimensions:ratio=16/9',
    ],
]);
```

---

## القسم 8: Form Requests

### مثال 24: Form Request أساسي

```bash
php artisan make:request StorePostRequest
```

```php
// app/Http/Requests/StorePostRequest.php
class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required|min:100',
            'status' => 'required|in:draft,published',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'العنوان مطلوب',
            'content.min' => 'المحتوى قصير جداً',
        ];
    }
}
```

```php
// Controller
public function store(StorePostRequest $request)
{
    $validated = $request->validated();

    Post::create($validated);

    return redirect()->route('posts.index');
}
```

---

### مثال 25: Form Request مع prepareForValidation

```php
class StorePostRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
            'is_featured' => $this->boolean('is_featured'),
            'email' => strtolower(trim($this->email)),
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'email' => 'required|email',
        ];
    }
}
```

---

### مثال 26: Form Request مع Conditional Rules

```php
class UpdatePostRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
        ];

        if ($this->isMethod('POST')) {
            $rules['slug'] = 'required|unique:posts';
        }

        if ($this->isMethod('PUT')) {
            $post = $this->route('post');
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }

        return $rules;
    }
}
```

---

## القسم 9: Custom Validation Rules

### مثال 27: Closure Rule

```php
$request->validate([
    'username' => [
        'required',
        function ($attribute, $value, $fail) {
            if (strtolower($value) === 'admin') {
                $fail('اسم المستخدم محجوز');
            }
        },
    ],
]);
```

---

### مثال 28: Rule Class

```bash
php artisan make:rule Uppercase
```

```php
// app/Rules/Uppercase.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    public function passes($attribute, $value)
    {
        return strtoupper($value) === $value;
    }

    public function message()
    {
        return ':attribute يجب أن يكون بأحرف كبيرة';
    }
}
```

```php
// الاستخدام
$request->validate([
    'code' => ['required', new Uppercase],
]);
```

---

### مثال 29: Rule مع Parameters

```php
// app/Rules/MaxWords.php
class MaxWords implements Rule
{
    protected $max;

    public function __construct($max)
    {
        $this->max = $max;
    }

    public function passes($attribute, $value)
    {
        return str_word_count($value) <= $this->max;
    }

    public function message()
    {
        return ":attribute لا يمكن أن يحتوي أكثر من {$this->max} كلمة";
    }
}
```

```php
// الاستخدام
$request->validate([
    'description' => ['required', new MaxWords(100)],
]);
```

---

### مثال 30: Rule مع Database Query

```php
// app/Rules/ValidCoupon.php
class ValidCoupon implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        $coupon = Coupon::where('code', $value)
            ->where('expires_at', '>', now())
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            return false;
        }

        // التحقق من أن المستخدم لم يستخدم الكوبون
        return !CouponUsage::where('coupon_id', $coupon->id)
            ->where('user_id', $this->userId)
            ->exists();
    }

    public function message()
    {
        return 'كود الخصم غير صالح أو مستخدم مسبقاً';
    }
}
```

```php
// الاستخدام
$request->validate([
    'coupon_code' => ['required', new ValidCoupon(auth()->id())],
]);
```

---

## القسم 10: Error Handling

### مثال 31: عرض جميع الأخطاء

```blade
@if ($errors->any())
    <div class="alert alert-danger">
        <h4>يوجد أخطاء:</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

---

### مثال 32: عرض خطأ حقل محدد

```blade
<input type="text" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">

@error('email')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

{{-- أو --}}
@if ($errors->has('email'))
    <span class="error">{{ $errors->first('email') }}</span>
@endif
```

---

### مثال 33: عرض أخطاء مصفوفة

```blade
{{-- عرض خطأ المصفوفة ككل --}}
@error('photos')
    <div class="error">{{ $message }}</div>
@enderror

{{-- عرض أخطاء العناصر --}}
@foreach ($errors->get('photos.*') as $message)
    <div class="error">{{ $message[0] }}</div>
@endforeach
```

---

## القسم 11: Advanced Techniques

### مثال 34: Validation مع AJAX

```javascript
// Frontend
const form = document.getElementById('contactForm');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    try {
        const response = await fetch('/api/contact', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();

        if (!response.ok) {
            // عرض الأخطاء
            displayErrors(data.errors);
        } else {
            // نجح
            alert('تم الإرسال بنجاح');
        }
    } catch (error) {
        console.error('Error:', error);
    }
});

function displayErrors(errors) {
    // مسح الأخطاء السابقة
    document.querySelectorAll('.error').forEach(el => el.remove());

    // عرض الأخطاء الجديدة
    for (const [field, messages] of Object.entries(errors)) {
        const input = document.querySelector(`[name="${field}"]`);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error';
        errorDiv.textContent = messages[0];
        input.parentNode.appendChild(errorDiv);
    }
}
```

```php
// Backend
public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);

        // معالجة البيانات

        return response()->json([
            'success' => true,
            'message' => 'تم الإرسال بنجاح'
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors()
        ], 422);
    }
}
```

---

### مثال 35: معاينة الصورة قبل الرفع

```blade
<form>
    <div>
        <img id="preview" src="#" alt="Preview" style="max-width: 300px; display: none;">
    </div>

    <input type="file" id="imageInput" name="image" accept="image/*">
</form>

<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>
```

---

## الخلاصة

هذه الأمثلة تغطي:

✅ HTML Forms (GET, POST, PUT, DELETE)
✅ CSRF Protection
✅ استقبال البيانات بطرق مختلفة
✅ Inline Validation
✅ Manual Validation
✅ جميع Validation Rules الشائعة
✅ File Upload & Validation
✅ Form Requests
✅ Custom Validation Rules
✅ Error Handling
✅ AJAX Validation
✅ معاينة الصور

استخدم هذه الأمثلة كمرجع سريع عند العمل مع Forms & Validation! 🚀
