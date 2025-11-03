# الدرس السادس: Forms & Validation في Laravel

## المحتويات

1. [مقدمة عن Forms و Validation](#مقدمة)
2. [HTML Forms في Laravel](#html-forms)
3. [CSRF Protection](#csrf-protection)
4. [استقبال البيانات من Forms](#استقبال-البيانات)
5. [Validation في Laravel](#validation)
6. [Validation Rules](#validation-rules)
7. [Custom Error Messages](#custom-error-messages)
8. [Form Requests](#form-requests)
9. [Custom Validation Rules](#custom-validation-rules)
10. [File Upload & Validation](#file-upload)
11. [Best Practices](#best-practices)

---

## 1. مقدمة عن Forms و Validation {#مقدمة}

### ما هو Form Validation؟

**Form Validation** هو عملية التحقق من صحة البيانات التي يدخلها المستخدم في النموذج قبل معالجتها أو حفظها في قاعدة البيانات.

### لماذا نحتاج Validation؟

1. **الأمان**: منع إدخال بيانات ضارة (XSS, SQL Injection)
2. **جودة البيانات**: ضمان صحة البيانات وتناسقها
3. **تجربة المستخدم**: إعلام المستخدم بالأخطاء فوراً
4. **منطق الأعمال**: التأكد من تطابق البيانات مع قواعد النظام

### أنواع Validation

- **Client-Side Validation**: يحدث في المتصفح (JavaScript/HTML5)
- **Server-Side Validation**: يحدث في Laravel (أكثر أماناً)
- **Database Validation**: قيود قاعدة البيانات (Constraints)

**ملاحظة مهمة**: يجب دائماً استخدام Server-Side Validation لأن Client-Side يمكن تجاوزه.

---

## 2. HTML Forms في Laravel {#html-forms}

### إنشاء Form أساسي

```blade
{{-- resources/views/posts/create.blade.php --}}
<form action="{{ route('posts.store') }}" method="POST">
    @csrf

    <div>
        <label for="title">العنوان:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}">
        @error('title')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="content">المحتوى:</label>
        <textarea id="content" name="content">{{ old('content') }}</textarea>
        @error('content')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">إنشاء</button>
</form>
```

### HTTP Methods في Forms

```blade
{{-- GET Method (Default) --}}
<form action="/search" method="GET">
    <input type="text" name="q">
    <button type="submit">بحث</button>
</form>

{{-- POST Method --}}
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <!-- Form fields -->
</form>

{{-- PUT/PATCH Method (Method Spoofing) --}}
<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Form fields -->
</form>

{{-- DELETE Method --}}
<form action="{{ route('posts.destroy', $post) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">حذف</button>
</form>
```

### Form Method Spoofing

HTML Forms تدعم فقط GET و POST، لذلك نستخدم `@method` لمحاكاة PUT/PATCH/DELETE:

```blade
@method('PUT')    {{-- يولد: <input type="hidden" name="_method" value="PUT"> --}}
@method('PATCH')
@method('DELETE')
```

---

## 3. CSRF Protection {#csrf-protection}

### ما هو CSRF؟

**CSRF (Cross-Site Request Forgery)** هو هجوم يجبر المستخدم على تنفيذ إجراءات غير مرغوبة على تطبيق ويب موثوق به.

### كيف يحمي Laravel من CSRF؟

Laravel يولد **CSRF Token** فريد لكل جلسة مستخدم ويتحقق منه عند كل طلب POST/PUT/PATCH/DELETE.

### استخدام CSRF Token

```blade
{{-- الطريقة 1: استخدام Directive --}}
<form method="POST" action="/profile">
    @csrf
    <!-- Form fields -->
</form>

{{-- الطريقة 2: استخدام Helper Function --}}
<form method="POST" action="/profile">
    {{ csrf_field() }}
    <!-- Form fields -->
</form>

{{-- الطريقة 3: في AJAX Requests --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
$.ajax({
    url: '/api/posts',
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
        title: 'New Post'
    }
});
</script>
```

### استثناء Routes من CSRF Protection

```php
// app/Http/Middleware/VerifyCsrfToken.php
class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'stripe/*',           // استثناء جميع routes تحت stripe
        'api/webhook',        // API webhooks
        'payment/callback',   // Payment callbacks
    ];
}
```

**تحذير**: لا تستثني routes إلا إذا كنت متأكداً تماماً من الأمان.

---

## 4. استقبال البيانات من Forms {#استقبال-البيانات}

### الطريقة 1: استخدام Request Object

```php
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // جلب حقل واحد
        $title = $request->input('title');

        // مع قيمة افتراضية
        $status = $request->input('status', 'draft');

        // جلب جميع البيانات
        $data = $request->all();

        // جلب بيانات محددة فقط
        $data = $request->only(['title', 'content']);

        // جلب جميع البيانات ماعدا محددة
        $data = $request->except(['_token', '_method']);

        // التحقق من وجود حقل
        if ($request->has('title')) {
            // الحقل موجود
        }

        // التحقق من وجود حقل وله قيمة
        if ($request->filled('title')) {
            // الحقل موجود وليس فارغاً
        }
    }
}
```

### الطريقة 2: استخدام Dynamic Properties

```php
public function store(Request $request)
{
    $title = $request->title;      // نفس $request->input('title')
    $content = $request->content;
}
```

### جلب Query Parameters

```php
// URL: /posts?page=2&sort=latest

$page = $request->query('page');           // 2
$sort = $request->query('sort', 'oldest'); // latest
$allQuery = $request->query();             // ['page' => 2, 'sort' => 'latest']
```

### Old Input (القيم القديمة)

```php
// في Controller - تخزين القيم القديمة عند الخطأ
return redirect('form')->withInput();

// في View - جلب القيم القديمة
<input type="text" name="title" value="{{ old('title') }}">
<input type="text" name="email" value="{{ old('email', $user->email) }}">
```

---

## 5. Validation في Laravel {#validation}

### الطريقة 1: Inline Validation (في Controller)

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required|min:10',
        'email' => 'required|email|unique:users',
        'age' => 'required|integer|min:18|max:100',
    ]);

    // إذا نجح Validation، الكود يستمر
    // إذا فشل، يعيد التوجيه تلقائياً مع الأخطاء

    Post::create($validated);

    return redirect()->route('posts.index');
}
```

### الطريقة 2: Manual Validation

```php
use Illuminate\Support\Facades\Validator;

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'email' => 'required|email',
    ]);

    if ($validator->fails()) {
        return redirect('posts/create')
                    ->withErrors($validator)
                    ->withInput();
    }

    // Validation نجح
    $validated = $validator->validated();

    Post::create($validated);
}
```

### الطريقة 3: Conditional Validation

```php
$validator = Validator::make($request->all(), [
    'title' => 'required',
]);

$validator->sometimes('reason', 'required|max:500', function ($input) {
    return $input->status === 'rejected';
});

if ($validator->fails()) {
    // Handle errors
}
```

### Validation مع AJAX

```php
public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        return response()->json(['success' => true]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors()
        ], 422);
    }
}
```

---

## 6. Validation Rules {#validation-rules}

### قواعد التحقق الأساسية

```php
$request->validate([
    // مطلوب (لا يمكن أن يكون فارغاً)
    'name' => 'required',

    // اختياري ولكن إذا موجود يجب أن يكون email
    'email' => 'nullable|email',

    // نص (string)
    'title' => 'string',

    // رقم صحيح (integer)
    'age' => 'integer',

    // رقم عشري (numeric)
    'price' => 'numeric',

    // قيمة منطقية (boolean)
    'is_active' => 'boolean',

    // تاريخ
    'birth_date' => 'date',

    // عنوان URL
    'website' => 'url',

    // عنوان IP
    'ip_address' => 'ip',
]);
```

### قواعد الحجم والطول

```php
$request->validate([
    // الحد الأدنى للطول (للنصوص) أو القيمة (للأرقام)
    'name' => 'min:3',
    'age' => 'min:18',

    // الحد الأقصى للطول (للنصوص) أو القيمة (للأرقام)
    'title' => 'max:255',
    'age' => 'max:100',

    // بين حدين
    'username' => 'between:3,20',
    'age' => 'between:18,65',

    // حجم محدد بالضبط
    'code' => 'size:6',          // نص من 6 أحرف
    'quantity' => 'size:10',      // رقم = 10
]);
```

### قواعد المصفوفات

```php
$request->validate([
    // يجب أن يكون مصفوفة
    'tags' => 'array',

    // مصفوفة بحد أدنى من العناصر
    'tags' => 'array|min:1',

    // مصفوفة بحد أقصى من العناصر
    'tags' => 'array|max:5',

    // التحقق من عناصر المصفوفة
    'tags.*' => 'string|max:50',

    // مصفوفة متعددة الأبعاد
    'posts.*.title' => 'required|string',
    'posts.*.content' => 'required|string',
]);
```

### قواعد قاعدة البيانات

```php
$request->validate([
    // يجب أن تكون القيمة موجودة في جدول
    'category_id' => 'exists:categories,id',

    // يجب أن تكون القيمة فريدة في جدول
    'email' => 'unique:users,email',

    // unique مع استثناء سجل معين (للتحديث)
    'email' => 'unique:users,email,' . $user->id,

    // مع شروط إضافية
    'email' => [
        'required',
        Rule::unique('users')->where(function ($query) {
            return $query->where('account_type', 'admin');
        })
    ],

    // exists مع شروط إضافية
    'category_id' => [
        'required',
        Rule::exists('categories', 'id')->where(function ($query) {
            $query->where('is_active', true);
        })
    ],
]);
```

### قواعد التواريخ

```php
$request->validate([
    // تاريخ
    'birth_date' => 'date',

    // تاريخ بتنسيق محدد
    'appointment' => 'date_format:Y-m-d H:i:s',

    // تاريخ قبل تاريخ آخر
    'start_date' => 'date|before:end_date',

    // تاريخ بعد تاريخ آخر
    'end_date' => 'date|after:start_date',

    // تاريخ قبل أو يساوي
    'deadline' => 'date|before_or_equal:2024-12-31',

    // تاريخ بعد أو يساوي
    'valid_from' => 'date|after_or_equal:today',
]);
```

### قواعد الملفات

```php
$request->validate([
    // ملف
    'document' => 'file',

    // صورة (jpg, jpeg, png, bmp, gif, svg, webp)
    'avatar' => 'image',

    // أنواع ملفات محددة
    'document' => 'mimes:pdf,doc,docx',
    'photo' => 'mimes:jpeg,png,jpg',

    // امتدادات محددة
    'document' => 'mimetypes:application/pdf',

    // حجم أقصى (بالكيلوبايت)
    'avatar' => 'max:2048',  // 2MB

    // أبعاد الصورة
    'avatar' => 'dimensions:min_width=100,min_height=100',
    'banner' => 'dimensions:width=1920,height=1080',
]);
```

### قواعد التطابق والمقارنة

```php
$request->validate([
    // يجب أن يطابق حقل آخر
    'password_confirmation' => 'same:password',

    // يجب أن يكون مختلف عن حقل آخر
    'new_password' => 'different:old_password',

    // يجب أن يكون إحدى القيم المحددة
    'status' => 'in:draft,published,archived',

    // يجب أن لا يكون إحدى القيم المحددة
    'status' => 'not_in:banned,suspended',

    // Regex (تعبير نمطي)
    'username' => 'regex:/^[a-zA-Z0-9_]+$/',
    'phone' => 'regex:/^05[0-9]{8}$/',
]);
```

### قواعد كلمة المرور

```php
use Illuminate\Validation\Rules\Password;

$request->validate([
    // كلمة مرور بسيطة (8 أحرف على الأقل)
    'password' => 'required|min:8',

    // كلمة مرور مع confirmed
    'password' => 'required|confirmed|min:8',

    // كلمة مرور معقدة (Laravel 8+)
    'password' => ['required', Password::min(8)],

    // كلمة مرور مع متطلبات محددة
    'password' => [
        'required',
        Password::min(8)
            ->letters()           // حرف واحد على الأقل
            ->mixedCase()         // حرف كبير وصغير
            ->numbers()           // رقم واحد على الأقل
            ->symbols()           // رمز واحد على الأقل
            ->uncompromised()     // ليست في قاعدة بيانات التسريبات
    ],

    // كلمة مرور للإنتاج
    'password' => [
        'required',
        Password::defaults()
    ],
]);

// تعريف القاعدة الافتراضية في AppServiceProvider
public function boot()
{
    Password::defaults(function () {
        return Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols();
    });
}
```

### قواعد متقدمة

```php
$request->validate([
    // مطلوب إذا كان حقل آخر له قيمة محددة
    'reason' => 'required_if:status,rejected',

    // مطلوب إلا إذا كان حقل آخر له قيمة محددة
    'coupon_code' => 'required_unless:payment_method,cash',

    // مطلوب مع حقل آخر
    'city' => 'required_with:state',

    // مطلوب مع جميع الحقول
    'zip_code' => 'required_with_all:city,state,country',

    // مطلوب بدون حقل آخر
    'guest_email' => 'required_without:user_id',

    // يحتوي على قيم محددة
    'permissions' => 'contains:read,write',

    // قبول (yes, on, 1, true)
    'terms' => 'accepted',

    // قبول إذا كان حقل آخر له قيمة محددة
    'terms' => 'accepted_if:age,>=,18',

    // تأكيد (يجب وجود حقل باسم field_confirmation)
    'password' => 'confirmed',
]);
```

---

## 7. Custom Error Messages {#custom-error-messages}

### رسائل مخصصة لجميع القواعد

```php
$request->validate(
    [
        'title' => 'required|max:255',
        'email' => 'required|email|unique:users',
    ],
    [
        'title.required' => 'عنوان المقالة مطلوب',
        'title.max' => 'عنوان المقالة لا يمكن أن يتجاوز 255 حرف',
        'email.required' => 'البريد الإلكتروني مطلوب',
        'email.email' => 'البريد الإلكتروني غير صحيح',
        'email.unique' => 'البريد الإلكتروني مسجل مسبقاً',
    ]
);
```

### رسائل مخصصة لأسماء الحقول

```php
$request->validate(
    [
        'email' => 'required|email',
    ],
    [
        'email.required' => 'حقل :attribute مطلوب',
        'email.email' => 'حقل :attribute غير صحيح',
    ],
    [
        'email' => 'البريد الإلكتروني',  // سيحل محل :attribute
    ]
);
```

### رسائل افتراضية للتطبيق

يمكنك تخصيص الرسائل في ملف اللغة:

```php
// resources/lang/ar/validation.php
return [
    'required' => 'حقل :attribute مطلوب',
    'email' => 'حقل :attribute يجب أن يكون بريد إلكتروني صحيح',
    'max' => [
        'string' => 'حقل :attribute لا يمكن أن يتجاوز :max حرف',
        'numeric' => 'حقل :attribute لا يمكن أن يكون أكبر من :max',
    ],

    'attributes' => [
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'title' => 'العنوان',
    ],
];
```

---

## 8. Form Requests {#form-requests}

### ما هو Form Request؟

**Form Request** هو class مخصص يحتوي على منطق Validation، مما يجعل Controllers أنظف وأكثر قابلية لإعادة الاستخدام.

### إنشاء Form Request

```bash
php artisan make:request StorePostRequest
```

```php
// app/Http/Requests/StorePostRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * تحديد ما إذا كان المستخدم مصرحاً له بهذا الطلب
     */
    public function authorize(): bool
    {
        // التحقق من الصلاحيات
        return true;  // أو auth()->check()
    }

    /**
     * قواعد Validation
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|max:5',
            'tags.*' => 'string|max:50',
        ];
    }

    /**
     * رسائل خطأ مخصصة
     */
    public function messages(): array
    {
        return [
            'title.required' => 'العنوان مطلوب',
            'content.required' => 'المحتوى مطلوب',
            'content.min' => 'المحتوى يجب أن يكون 10 أحرف على الأقل',
        ];
    }

    /**
     * أسماء مخصصة للحقول
     */
    public function attributes(): array
    {
        return [
            'category_id' => 'التصنيف',
            'tags.*' => 'الوسم',
        ];
    }
}
```

### استخدام Form Request في Controller

```php
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function store(StorePostRequest $request)
    {
        // Validation تم تلقائياً، إذا فشل لن يصل الكود هنا

        $validated = $request->validated();

        Post::create($validated);

        return redirect()->route('posts.index');
    }
}
```

### Form Request مع Authorization

```php
public function authorize(): bool
{
    // السماح للمستخدمين المسجلين فقط
    return auth()->check();

    // أو: السماح للإداريين فقط
    return auth()->user()?->is_admin === true;

    // أو: السماح لصاحب المقالة فقط (للتحديث)
    $post = $this->route('post');
    return $post && $this->user()->id === $post->user_id;
}
```

### Form Request مع Conditional Rules

```php
public function rules(): array
{
    $rules = [
        'title' => 'required|max:255',
        'content' => 'required',
    ];

    // إضافة قاعدة unique عند الإنشاء فقط
    if ($this->isMethod('POST')) {
        $rules['slug'] = 'required|unique:posts';
    }

    // تحديث: استثناء السجل الحالي من unique
    if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
        $postId = $this->route('post')->id;
        $rules['slug'] = 'required|unique:posts,slug,' . $postId;
    }

    return $rules;
}
```

### Prepare for Validation

```php
protected function prepareForValidation()
{
    // تنظيف البيانات قبل Validation
    $this->merge([
        'slug' => Str::slug($this->title),
        'is_published' => $this->boolean('is_published'),
    ]);
}
```

---

## 9. Custom Validation Rules {#custom-validation-rules}

### الطريقة 1: Closure Rule (قاعدة بسيطة)

```php
use Illuminate\Validation\Rule;

$request->validate([
    'username' => [
        'required',
        function ($attribute, $value, $fail) {
            if (strtolower($value) === 'admin') {
                $fail('اسم المستخدم :attribute محجوز.');
            }
        },
    ],
]);
```

### الطريقة 2: Rule Class (قاعدة معقدة)

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
        return 'حقل :attribute يجب أن يكون بأحرف كبيرة فقط.';
    }
}
```

**الاستخدام:**

```php
use App\Rules\Uppercase;

$request->validate([
    'code' => ['required', new Uppercase],
]);
```

### قاعدة مع معاملات (Parameters)

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
        return "حقل :attribute لا يمكن أن يحتوي أكثر من {$this->max} كلمة.";
    }
}
```

**الاستخدام:**

```php
$request->validate([
    'description' => ['required', new MaxWords(100)],
]);
```

### قاعدة مع الوصول لقاعدة البيانات

```php
// app/Rules/ValidCoupon.php
class ValidCoupon implements Rule
{
    public function passes($attribute, $value)
    {
        return Coupon::where('code', $value)
            ->where('expires_at', '>', now())
            ->where('is_active', true)
            ->exists();
    }

    public function message()
    {
        return 'كود الخصم غير صالح أو منتهي الصلاحية.';
    }
}
```

---

## 10. File Upload & Validation {#file-upload}

### Form لرفع الملفات

```blade
<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="avatar">الصورة الشخصية:</label>
        <input type="file" id="avatar" name="avatar">
        @error('avatar')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">تحديث</button>
</form>
```

**ملاحظة**: `enctype="multipart/form-data"` ضروري لرفع الملفات.

### Validation للملفات

```php
$request->validate([
    // ملف أساسي
    'document' => 'required|file|max:10240',  // 10MB

    // صورة
    'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',

    // أبعاد الصورة
    'banner' => [
        'required',
        'image',
        'dimensions:min_width=1920,min_height=1080,max_width=1920,max_height=1080'
    ],

    // ملفات متعددة
    'photos' => 'required|array|max:5',
    'photos.*' => 'image|mimes:jpeg,png|max:2048',
]);
```

### حفظ الملفات

```php
use Illuminate\Support\Facades\Storage;

public function store(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|max:2048',
    ]);

    // الطريقة 1: استخدام store() - اسم تلقائي
    $path = $request->file('avatar')->store('avatars');
    // النتيجة: avatars/abc123def456.jpg

    // الطريقة 2: استخدام storeAs() - اسم مخصص
    $filename = auth()->id() . '_' . time() . '.' . $request->avatar->extension();
    $path = $request->file('avatar')->storeAs('avatars', $filename);
    // النتيجة: avatars/123_1234567890.jpg

    // الطريقة 3: تحديد disk
    $path = $request->file('avatar')->store('avatars', 's3');

    // الطريقة 4: public disk
    $path = $request->file('avatar')->store('avatars', 'public');

    // حفظ المسار في قاعدة البيانات
    auth()->user()->update([
        'avatar' => $path,
    ]);

    return back()->with('success', 'تم رفع الصورة بنجاح');
}
```

### معلومات عن الملف

```php
$file = $request->file('avatar');

$originalName = $file->getClientOriginalName();      // photo.jpg
$extension = $file->extension();                      // jpg
$mimeType = $file->getMimeType();                     // image/jpeg
$size = $file->getSize();                             // بالبايت
$path = $file->getRealPath();                         // المسار المؤقت
```

### حذف الملفات القديمة

```php
public function update(Request $request)
{
    $request->validate([
        'avatar' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('avatar')) {
        // حذف الصورة القديمة
        if (auth()->user()->avatar) {
            Storage::delete(auth()->user()->avatar);
        }

        // رفع الصورة الجديدة
        $path = $request->file('avatar')->store('avatars', 'public');

        auth()->user()->update(['avatar' => $path]);
    }
}
```

---

## 11. Best Practices {#best-practices}

### 1. استخدم Form Requests للـ Validation المعقد

```php
// ❌ سيئ - كل Validation في Controller
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required|min:10',
        // ... 20 سطر آخر
    ]);
}

// ✅ جيد - Validation في Form Request
public function store(StorePostRequest $request)
{
    $validated = $request->validated();
}
```

### 2. استخدم `validated()` بدلاً من `all()`

```php
// ❌ سيئ - قد يحتوي على حقول غير متحقق منها
Post::create($request->all());

// ✅ جيد - فقط الحقول التي نجحت في Validation
Post::create($request->validated());
```

### 3. استخدم `old()` للحفاظ على القيم عند الأخطاء

```blade
{{-- ✅ جيد --}}
<input type="text" name="title" value="{{ old('title', $post->title ?? '') }}">
```

### 4. عرض جميع الأخطاء

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
```

### 5. استخدم Array Syntax للقواعد المعقدة

```php
// ✅ أوضح وأسهل للقراءة
'email' => ['required', 'email', 'unique:users'],

// بدلاً من
'email' => 'required|email|unique:users',
```

### 6. Sanitize البيانات قبل Validation

```php
protected function prepareForValidation()
{
    $this->merge([
        'phone' => preg_replace('/[^0-9]/', '', $this->phone),
        'email' => strtolower(trim($this->email)),
    ]);
}
```

### 7. لا تثق أبداً في Client-Side Validation فقط

```php
// ✅ دائماً استخدم Server-Side Validation
```

### 8. استخدم Transaction عند حفظ بيانات متعددة

```php
use Illuminate\Support\Facades\DB;

DB::transaction(function () use ($request) {
    $post = Post::create($request->validated());
    $post->tags()->attach($request->tags);
});
```

### 9. Validate الملفات بعناية

```php
// ✅ جيد - تحديد الأنواع والحجم بوضوح
'document' => 'required|file|mimes:pdf,doc,docx|max:5120',
```

### 10. استخدم Custom Rules للمنطق المعقد

```php
// ✅ قابل لإعادة الاستخدام ونظيف
'coupon' => ['required', new ValidCoupon($userId)],
```

---

## الخلاصة

في هذا الدرس تعلمنا:

✅ إنشاء Forms في Laravel مع CSRF Protection
✅ استقبال ومعالجة بيانات Forms
✅ Validation بطرق مختلفة (Inline, Manual, Form Requests)
✅ جميع Validation Rules الأساسية والمتقدمة
✅ تخصيص رسائل الأخطاء
✅ إنشاء Custom Validation Rules
✅ رفع وحفظ الملفات مع Validation
✅ Best Practices للعمل مع Forms

**Forms و Validation** هما أساس أي تطبيق ويب آمن ومستقر. تأكد من فهم هذه المفاهيم جيداً! 🚀
