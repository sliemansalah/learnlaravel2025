# التمارين العملية: Forms & Validation

## نظرة عامة

هذا الملف يحتوي على **6 تمارين متدرجة** من المستوى المبتدئ إلى المستوى المتقدم.

---

## التمرين 1: نموذج اتصل بنا ⭐

### الوصف

أنشئ صفحة "اتصل بنا" بسيطة مع Validation.

### المتطلبات

1. Form يحتوي على:
   - الاسم (مطلوب، 3 أحرف على الأقل)
   - البريد الإلكتروني (مطلوب، email صحيح)
   - الموضوع (مطلوب)
   - الرسالة (مطلوبة، 20 حرف على الأقل)

2. عرض الأخطاء أسفل كل حقل
3. الحفاظ على القيم عند وجود أخطاء (old input)
4. عند النجاح، عرض رسالة "تم إرسال رسالتك بنجاح"
5. حفظ الرسالة في قاعدة البيانات

### خطوات التنفيذ

```bash
# 1. إنشاء Migration
php artisan make:migration create_contact_messages_table

# 2. إنشاء Model
php artisan make:model ContactMessage

# 3. إنشاء Controller
php artisan make:controller ContactController
```

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

#### Migration

```php
// database/migrations/xxxx_create_contact_messages_table.php
public function up()
{
    Schema::create('contact_messages', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('subject');
        $table->text('message');
        $table->ipAddress('ip_address')->nullable();
        $table->timestamps();
    });
}
```

#### Model

```php
// app/Models/ContactMessage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'ip_address',
    ];
}
```

#### Controller

```php
// app/Http/Controllers/ContactController.php
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:20|max:1000',
        ], [
            'name.required' => 'الاسم مطلوب',
            'name.min' => 'الاسم يجب أن يكون 3 أحرف على الأقل',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'subject.required' => 'الموضوع مطلوب',
            'message.required' => 'الرسالة مطلوبة',
            'message.min' => 'الرسالة يجب أن تكون 20 حرف على الأقل',
        ]);

        $validated['ip_address'] = $request->ip();

        ContactMessage::create($validated);

        return redirect()->route('contact')
            ->with('success', 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً!');
    }
}
```

#### Routes

```php
// routes/web.php
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
```

#### View

```blade
{{-- resources/views/contact.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>اتصل بنا</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>اتصل بنا</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم *</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني *</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">الموضوع *</label>
                                <input type="text"
                                       class="form-control @error('subject') is-invalid @enderror"
                                       id="subject"
                                       name="subject"
                                       value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">الرسالة *</label>
                                <textarea class="form-control @error('message') is-invalid @enderror"
                                          id="message"
                                          name="message"
                                          rows="5">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">إرسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
```

</details>

---

## التمرين 2: نموذج تسجيل المستخدم مع رفع الصورة ⭐⭐

### الوصف

أنشئ نموذج تسجيل مستخدم متقدم مع رفع صورة شخصية.

### المتطلبات

1. Form يحتوي على:
   - الاسم (مطلوب، 3-50 حرف)
   - اسم المستخدم (مطلوب، فريد، يبدأ بحرف، أحرف وأرقام فقط)
   - البريد الإلكتروني (مطلوب، email صحيح، فريد)
   - كلمة المرور (مطلوب، 8 أحرف على الأقل، أحرف وأرقام)
   - تأكيد كلمة المرور
   - رقم الجوال (اختياري، رقم سعودي)
   - تاريخ الميلاد (اختياري، في الماضي)
   - الجنس (اختياري)
   - الصورة الشخصية (اختياري، صورة، أقل من 2MB)

2. إنشاء Custom Rule للتحقق من username
3. إنشاء Form Request
4. معاينة الصورة قبل الرفع
5. حفظ المستخدم وتسجيل دخوله تلقائياً

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

#### Custom Rule

```bash
php artisan make:rule ValidUsername
```

```php
// app/Rules/ValidUsername.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidUsername implements Rule
{
    public function passes($attribute, $value)
    {
        // يبدأ بحرف، ويحتوي فقط على أحرف، أرقام، underscore
        return preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $value);
    }

    public function message()
    {
        return 'اسم المستخدم يجب أن يبدأ بحرف ويحتوي فقط على أحرف، أرقام، و underscore';
    }
}
```

#### Form Request

```bash
php artisan make:request RegisterRequest
```

```php
// app/Http/Requests/RegisterRequest.php
namespace App\Http\Requests;

use App\Rules\ValidUsername;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'username' => ['required', 'string', 'min:3', 'max:30', 'unique:users', new ValidUsername],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'phone' => ['nullable', 'regex:/^05[0-9]{8}$/'],
            'birth_date' => ['nullable', 'date', 'before:today', 'after:1900-01-01'],
            'gender' => ['nullable', 'in:male,female,other'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.min' => 'الاسم يجب أن يكون 3 أحرف على الأقل',
            'username.required' => 'اسم المستخدم مطلوب',
            'username.unique' => 'اسم المستخدم مستخدم مسبقاً',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'phone.regex' => 'رقم الجوال يجب أن يكون رقم سعودي صحيح (05xxxxxxxx)',
            'birth_date.before' => 'تاريخ الميلاد يجب أن يكون في الماضي',
            'avatar.image' => 'الملف يجب أن يكون صورة',
            'avatar.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'username' => strtolower(trim($this->username)),
            'email' => strtolower(trim($this->email)),
        ]);
    }
}
```

#### Controller

```php
// app/Http/Controllers/Auth/RegisterController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        // معالجة رفع الصورة
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create($data);

        // تسجيل الدخول تلقائياً
        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'مرحباً بك، ' . $user->name . '! تم إنشاء حسابك بنجاح.');
    }
}
```

#### View مع معاينة الصورة

```blade
{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>إنشاء حساب جديد</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- الصورة الشخصية --}}
                        <div class="mb-3 text-center">
                            <img id="avatarPreview"
                                 src="{{ asset('images/default-avatar.png') }}"
                                 alt="Avatar Preview"
                                 style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                            <div class="mt-2">
                                <label for="avatar" class="btn btn-sm btn-outline-primary">
                                    اختر صورة
                                </label>
                                <input type="file"
                                       class="d-none @error('avatar') is-invalid @enderror"
                                       id="avatar"
                                       name="avatar"
                                       accept="image/*">
                            </div>
                            @error('avatar')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">الاسم *</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="username">اسم المستخدم *</label>
                                <input type="text"
                                       class="form-control @error('username') is-invalid @enderror"
                                       name="username"
                                       value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">البريد الإلكتروني *</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password">كلمة المرور *</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation">تأكيد كلمة المرور *</label>
                                <input type="password"
                                       class="form-control"
                                       name="password_confirmation">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone">رقم الجوال</label>
                                <input type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="05xxxxxxxx">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="birth_date">تاريخ الميلاد</label>
                                <input type="date"
                                       class="form-control @error('birth_date') is-invalid @enderror"
                                       name="birth_date"
                                       value="{{ old('birth_date') }}">
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>الجنس</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="male" {{ old('gender') === 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label">ذكر</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="female" {{ old('gender') === 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label">أنثى</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="other" {{ old('gender') === 'other' ? 'checked' : '' }}>
                                    <label class="form-check-label">آخر</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">إنشاء الحساب</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
```

</details>

---

## التمرين 3: نموذج إنشاء منتج مع صور متعددة ⭐⭐⭐

### الوصف

أنشئ نظام إدارة منتجات مع إمكانية رفع عدة صور.

### المتطلبات

1. جدول products يحتوي على:
   - الاسم، الوصف، السعر، الكمية، التصنيف، الحالة

2. جدول product_images للصور

3. Form يحتوي على:
   - اسم المنتج (مطلوب، فريد)
   - الوصف (مطلوب، 50-1000 حرف)
   - السعر (مطلوب، رقم، أكبر من 0)
   - الكمية (مطلوب، عدد صحيح، 0 أو أكبر)
   - التصنيف (مطلوب، موجود في جدول categories)
   - الحالة (available, out_of_stock)
   - صور (اختياري، 1-5 صور، كل صورة أقل من 3MB)

4. إنشاء Form Request
5. معاينة الصور قبل الرفع
6. Custom Rule للتحقق من السعر بناءً على التصنيف

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

```bash
php artisan make:migration create_products_table
php artisan make:migration create_product_images_table
php artisan make:model Product
php artisan make:model ProductImage
php artisan make:request StoreProductRequest
php artisan make:rule ValidPrice
php artisan make:controller ProductController --resource
```

#### Migrations

```php
// create_products_table
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('slug')->unique();
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->unsignedInteger('quantity')->default(0);
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['available', 'out_of_stock'])->default('available');
        $table->timestamps();
    });
}

// create_product_images_table
public function up()
{
    Schema::create('product_images', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->string('path');
        $table->boolean('is_primary')->default(false);
        $table->timestamps();
    });
}
```

#### Custom Rule

```php
// app/Rules/ValidPrice.php
namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class ValidPrice implements Rule
{
    protected $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function passes($attribute, $value)
    {
        $category = Category::find($this->categoryId);

        if (!$category) {
            return false;
        }

        // مثال: التصنيف الفاخر يجب أن يكون سعره أكبر من 1000
        if ($category->slug === 'luxury' && $value < 1000) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'السعر غير مناسب للتصنيف المحدد';
    }
}
```

#### Form Request

```php
// app/Http/Requests/StoreProductRequest.php
namespace App\Http\Requests;

use App\Rules\ValidPrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'description' => ['required', 'string', 'min:50', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0.01', new ValidPrice($this->category_id)],
            'quantity' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'in:available,out_of_stock'],
            'images' => ['nullable', 'array', 'min:1', 'max:5'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'اسم المنتج موجود مسبقاً',
            'description.min' => 'الوصف قصير جداً',
            'price.min' => 'السعر يجب أن يكون أكبر من 0',
            'images.max' => 'يمكنك رفع 5 صور كحد أقصى',
            'images.*.max' => 'حجم الصورة يجب أن لا يتجاوز 3 ميجابايت',
        ];
    }

    protected function prepareForValidation()
    {
        // توليد slug من الاسم
        if ($this->name) {
            $this->merge(['slug' => Str::slug($this->name)]);
        }

        // تعيين الحالة تلقائياً بناءً على الكمية
        if ($this->quantity == 0) {
            $this->merge(['status' => 'out_of_stock']);
        }
    }
}
```

#### Controller

```php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        DB::transaction(function () use ($request) {
            $product = Product::create($request->validated());

            // رفع وحفظ الصور
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');

                    $product->images()->create([
                        'path' => $path,
                        'is_primary' => $index === 0, // أول صورة هي الأساسية
                    ]);
                }
            }
        });

        return redirect()->route('products.index')
            ->with('success', 'تم إضافة المنتج بنجاح');
    }
}
```

#### View

```blade
{{-- resources/views/products/create.blade.php --}}
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>اسم المنتج *</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>الوصف *</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{ old('description') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label>السعر *</label>
            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label>الكمية *</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity', 0) }}">
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label>التصنيف *</label>
        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
            <option value="">اختر التصنيف</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>الصور (1-5 صور)</label>
        <input type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" multiple accept="image/*" id="productImages">
        @error('images')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div id="imagePreview" class="mt-3 d-flex gap-2 flex-wrap"></div>
    </div>

    <button type="submit" class="btn btn-primary">إضافة المنتج</button>
</form>

<script>
document.getElementById('productImages').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    const files = Array.from(e.target.files);

    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '150px';
            img.style.height = '150px';
            img.style.objectFit = 'cover';
            img.style.borderRadius = '8px';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>
```

</details>

---

## التمرين 4: نموذج بحث متقدم مع Filters ⭐⭐⭐

### الوصف

أنشئ نموذج بحث متقدم للمنتجات مع عدة فلاتر.

### المتطلبات

1. Form بحث يحتوي على:
   - كلمة البحث (اختياري)
   - التصنيف (اختياري، متعدد)
   - نطاق السعر (من - إلى)
   - الحالة (متاح، غير متاح)
   - الترتيب (الأحدث، السعر من الأقل للأعلى، السعر من الأعلى للأقل)

2. Validation للتأكد من أن "السعر من" أقل من "السعر إلى"
3. الحفاظ على قيم الفلاتر بعد البحث
4. عرض عدد النتائج
5. Pagination مع الحفاظ على query parameters

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

#### Form Request

```bash
php artisan make:request SearchProductsRequest
```

```php
// app/Http/Requests/SearchProductsRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
            'price_from' => ['nullable', 'numeric', 'min:0'],
            'price_to' => ['nullable', 'numeric', 'min:0', 'gte:price_from'],
            'status' => ['nullable', 'in:available,out_of_stock'],
            'sort' => ['nullable', 'in:latest,price_asc,price_desc'],
        ];
    }

    public function messages(): array
    {
        return [
            'price_to.gte' => 'السعر إلى يجب أن يكون أكبر من أو يساوي السعر من',
        ];
    }
}
```

#### Controller

```php
// app/Http/Controllers/ProductController.php
public function index(SearchProductsRequest $request)
{
    $query = Product::with('category');

    // فلتر البحث
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    // فلتر التصنيفات
    if ($request->filled('categories')) {
        $query->whereIn('category_id', $request->categories);
    }

    // فلتر نطاق السعر
    if ($request->filled('price_from')) {
        $query->where('price', '>=', $request->price_from);
    }

    if ($request->filled('price_to')) {
        $query->where('price', '<=', $request->price_to);
    }

    // فلتر الحالة
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // الترتيب
    $sort = $request->input('sort', 'latest');
    switch ($sort) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        default:
            $query->latest();
    }

    $products = $query->paginate(12)->withQueryString();
    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}
```

#### View

```blade
{{-- resources/views/products/index.blade.php --}}
<form action="{{ route('products.index') }}" method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            <input type="text"
                   class="form-control"
                   name="search"
                   placeholder="ابحث عن منتج..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-4 mb-3">
            <select class="form-select" name="categories[]" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            {{ in_array($category->id, request('categories', [])) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <select class="form-select" name="sort">
                <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>الأحدث</option>
                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>السعر: من الأقل للأعلى</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>السعر: من الأعلى للأقل</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-3">
            <input type="number"
                   class="form-control @error('price_from') is-invalid @enderror"
                   name="price_from"
                   placeholder="السعر من"
                   value="{{ request('price_from') }}">
            @error('price_from')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3 mb-3">
            <input type="number"
                   class="form-control @error('price_to') is-invalid @enderror"
                   name="price_to"
                   placeholder="السعر إلى"
                   value="{{ request('price_to') }}">
            @error('price_to')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3 mb-3">
            <select class="form-select" name="status">
                <option value="">جميع الحالات</option>
                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>متاح</option>
                <option value="out_of_stock" {{ request('status') === 'out_of_stock' ? 'selected' : '' }}>غير متاح</option>
            </select>
        </div>

        <div class="col-md-3 mb-3">
            <button type="submit" class="btn btn-primary w-100">بحث</button>
        </div>
    </div>
</form>

<p class="text-muted">عدد النتائج: {{ $products->total() }}</p>

<div class="row">
    @foreach($products as $product)
        <div class="col-md-3 mb-4">
            {{-- عرض المنتج --}}
        </div>
    @endforeach
</div>

{{ $products->links() }}
```

</details>

---

## التمرين 5: نموذج AJAX بدون إعادة تحميل الصفحة ⭐⭐⭐⭐

### الوصف

أنشئ نموذج تعليق يعمل بتقنية AJAX مع Validation في الوقت الفعلي.

### المتطلبات

1. Form تعليق بدون إعادة تحميل الصفحة
2. Validation في الوقت الفعلي
3. عرض الأخطاء بشكل ديناميكي
4. إضافة التعليق للصفحة بعد النجاح
5. رسالة نجاح
6. معالجة الأخطاء

### الحل المقترح

<details>
<summary>اضغط لعرض الحل</summary>

#### Controller

```php
// app/Http/Controllers/CommentController.php
public function store(Request $request, Post $post)
{
    try {
        $validated = $request->validate([
            'content' => ['required', 'string', 'min:10', 'max:500'],
        ], [
            'content.required' => 'التعليق مطلوب',
            'content.min' => 'التعليق يجب أن يكون 10 أحرف على الأقل',
            'content.max' => 'التعليق لا يمكن أن يتجاوز 500 حرف',
        ]);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        $comment->load('user');

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة تعليقك بنجاح',
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'author' => $comment->user->name,
                'avatar' => $comment->user->avatar_url,
                'created_at' => $comment->created_at->diffForHumans(),
            ]
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors()
        ], 422);
    }
}
```

#### View

```blade
<div id="comments-section">
    <h3>التعليقات</h3>

    <form id="commentForm" class="mb-4">
        <div class="mb-3">
            <textarea class="form-control"
                      id="commentContent"
                      name="content"
                      rows="3"
                      placeholder="اكتب تعليقك..."></textarea>
            <div id="contentError" class="text-danger small mt-1"></div>
        </div>
        <button type="submit" class="btn btn-primary" id="submitBtn">
            <span id="btnText">إضافة تعليق</span>
            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
        </button>
    </form>

    <div id="successMessage" class="alert alert-success d-none"></div>

    <div id="commentsList">
        @foreach($post->comments as $comment)
            <div class="comment mb-3">
                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->content }}</p>
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
</div>

<script>
document.getElementById('commentForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    // مسح الأخطاء السابقة
    document.getElementById('contentError').textContent = '';
    document.getElementById('successMessage').classList.add('d-none');

    // تعطيل الزر وعرض Spinner
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');
    submitBtn.disabled = true;
    btnText.classList.add('d-none');
    btnSpinner.classList.remove('d-none');

    const formData = new FormData(e.target);

    try {
        const response = await fetch('{{ route("comments.store", $post) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();

        if (!response.ok) {
            // عرض الأخطاء
            if (data.errors && data.errors.content) {
                document.getElementById('contentError').textContent = data.errors.content[0];
            }
        } else {
            // نجح - عرض رسالة النجاح
            const successMsg = document.getElementById('successMessage');
            successMsg.textContent = data.message;
            successMsg.classList.remove('d-none');

            // إضافة التعليق للقائمة
            const commentsList = document.getElementById('commentsList');
            const newComment = document.createElement('div');
            newComment.className = 'comment mb-3';
            newComment.innerHTML = `
                <strong>${data.comment.author}</strong>
                <p>${data.comment.content}</p>
                <small class="text-muted">${data.comment.created_at}</small>
            `;
            commentsList.insertBefore(newComment, commentsList.firstChild);

            // مسح الـ form
            e.target.reset();

            // إخفاء رسالة النجاح بعد 3 ثواني
            setTimeout(() => {
                successMsg.classList.add('d-none');
            }, 3000);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ. حاول مرة أخرى.');
    } finally {
        // إعادة تفعيل الزر
        submitBtn.disabled = false;
        btnText.classList.remove('d-none');
        btnSpinner.classList.add('d-none');
    }
});
</script>
```

</details>

---

## التمرين 6: نظام إعدادات المستخدم الشامل ⭐⭐⭐⭐⭐

### الوصف

أنشئ صفحة إعدادات شاملة للمستخدم مع عدة أقسام.

### المتطلبات

1. قسم المعلومات الشخصية
2. قسم تغيير كلمة المرور
3. قسم الإشعارات
4. قسم الأمان (Two-Factor Authentication)
5. قسم الخصوصية
6. Form Requests منفصلة لكل قسم
7. Validation معقد
8. AJAX لبعض الأقسام

### الملاحظة

هذا تمرين شامل يجمع كل ما تعلمته. حاول تنفيذه بنفسك!

---

## الخلاصة

هذه التمارين تغطي:

✅ Forms أساسية مع Validation
✅ File Upload (صورة واحدة وعدة صور)
✅ Form Requests
✅ Custom Validation Rules
✅ Conditional Validation
✅ Filters و Search
✅ AJAX Forms
✅ Real-time Validation
✅ تطبيقات واقعية

**تحدي إضافي**: حاول دمج جميع هذه التمارين في مشروع واحد متكامل! 🚀
