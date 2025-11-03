# امتحان الدرس السادس: Forms & Validation - مع الإجابات

**الوقت المحدد**: 90 دقيقة
**مجموع الدرجات**: 100 نقطة

---

## القسم الأول: أسئلة الاختيار من متعدد (60 نقطة)

**اختر الإجابة الصحيحة لكل سؤال (2 نقطة لكل سؤال)**

### السؤال 1
ما هو الأمر الصحيح لإضافة CSRF Token في Form؟

A) `{{ csrf() }}`
B) `@csrf`
C) `<csrf-token>`
D) `{{ token() }}`

**الإجابة الصحيحة**: B
**الشرح**: `@csrf` هو Blade directive الذي يضيف hidden input يحتوي على CSRF token.

---

### السؤال 2
كيف تحاكي HTTP Method PUT في HTML Form؟

A) `<input type="method" value="PUT">`
B) `@method('PUT')`
C) `<form method="PUT">`
D) `{{ method('PUT') }}`

**الإجابة الصحيحة**: B
**الشرح**: `@method('PUT')` ينشئ hidden input باسم `_method` لمحاكاة PUT/PATCH/DELETE.

---

### السؤال 3
ما هو الغرض من `enctype="multipart/form-data"` في Form؟

A) لتشفير البيانات
B) لإرسال البيانات بشكل آمن
C) لرفع الملفات
D) لاستخدام AJAX

**الإجابة الصحيحة**: C
**الشرح**: `multipart/form-data` ضروري لرفع الملفات عبر Forms.

---

### السؤال 4
ما هي الطريقة الصحيحة لجلب قيمة حقل من Request؟

A) `$request->get('name')`
B) `$request->input('name')`
C) `$request->name`
D) جميع ما سبق صحيح

**الإجابة الصحيحة**: D
**الشرح**: Laravel يوفر عدة طرق لجلب قيم الحقول، وكلها صحيحة.

---

### السؤال 5
ما الفرق بين `$request->all()` و `$request->validated()`؟

A) لا يوجد فرق
B) `validated()` ترجع فقط الحقول التي نجحت في Validation
C) `all()` أسرع من `validated()`
D) `validated()` تستخدم مع GET فقط

**الإجابة الصحيحة**: B
**الشرح**: `validated()` آمن أكثر لأنه يرجع فقط البيانات التي تم التحقق منها.

---

### السؤال 6
كيف تحصل على القيم القديمة (Old Input) في Blade؟

A) `{{ previous('field') }}`
B) `{{ old('field') }}`
C) `{{ last('field') }}`
D) `{{ input('field') }}`

**الإجابة الصحيحة**: B
**الشرح**: `old('field')` يجلب القيمة القديمة للحقل بعد إعادة التوجيه.

---

### السؤال 7
ما هي الطريقة الصحيحة لعمل Inline Validation في Controller؟

A) `$request->check([...])`
B) `$request->validate([...])`
C) `$request->verify([...])`
D) `Validator::validate([...])`

**الإجابة الصحيحة**: B
**الشرح**: `$request->validate()` هو الطريقة الأبسط للـ validation المباشر.

---

### السؤال 8
ماذا يحدث إذا فشل Validation عند استخدام `$request->validate()`؟

A) يرجع null
B) يعيد التوجيه تلقائياً مع الأخطاء
C) يرمي Exception
D) يطبع رسالة خطأ

**الإجابة الصحيحة**: B
**الشرح**: Laravel تلقائياً يعيد التوجيه مع الأخطاء والقيم القديمة.

---

### السؤال 9
أي من التالي يتحقق من أن الحقل مطلوب فقط إذا كان حقل آخر له قيمة محددة؟

A) `required_with`
B) `required_if`
C) `required_unless`
D) `required_when`

**الإجابة الصحيحة**: B
**الشرح**: `required_if:field,value` يجعل الحقل مطلوب فقط إذا كان حقل آخر له قيمة محددة.

---

### السؤال 10
ما هو التنسيق الصحيح لقاعدة `unique` مع استثناء سجل معين؟

A) `unique:table,column,except:id`
B) `unique:table,column,id`
C) `unique:table:column:id`
D) `unique:table|column|id`

**الإجابة الصحيحة**: B
**الشرح**: `unique:table,column,id` يستثني السجل بالـ id المحدد.

---

### السؤال 11
كيف تتحقق من أن القيمة موجودة في جدول معين؟

A) `in_database:table,column`
B) `exists:table,column`
C) `present:table,column`
D) `found:table,column`

**الإجابة الصحيحة**: B
**الشرح**: `exists:table,column` يتحقق من وجود القيمة في الجدول المحدد.

---

### السؤال 12
ما هي قاعدة التحقق من أن الحقل يحتوي فقط على أحرف وأرقام؟

A) `alpha`
B) `numeric`
C) `alpha_num`
D) `letters_numbers`

**الإجابة الصحيحة**: C
**الشرح**: `alpha_num` يتحقق من أن القيمة تحتوي فقط على أحرف وأرقام.

---

### السؤال 13
كيف تتحقق من أن كلمة المرور تحتوي على 8 أحرف على الأقل وأحرف وأرقام؟

A) `min:8|alpha_num`
B) `Password::min(8)->letters()->numbers()`
C) `password:8,mixed`
D) `secure:8`

**الإجابة الصحيحة**: B
**الشرح**: `Password::min(8)->letters()->numbers()` (Laravel 9+) يوفر validation معقد لكلمة المرور.

---

### السؤال 14
ما هي قاعدة التحقق من أن الحقل يطابق حقل آخر؟

A) `match:field`
B) `same:field`
C) `equal:field`
D) `identical:field`

**الإجابة الصحيحة**: B
**الشرح**: `same:field` يتحقق من أن القيمة تطابق قيمة حقل آخر.

---

### السؤال 15
كيف تتحقق من أن الحقل يحتوي على بريد إلكتروني صحيح؟

A) `email`
B) `email_address`
C) `valid_email`
D) `mail`

**الإجابة الصحيحة**: A
**الشرح**: `email` هو القاعدة الأساسية للتحقق من البريد الإلكتروني.

---

### السؤال 16
ما هي قاعدة التحقق من أن التاريخ قبل تاريخ معين؟

A) `before_date`
B) `before:date`
C) `earlier:date`
D) `prior:date`

**الإجابة الصحيحة**: B
**الشرح**: `before:date` يتحقق من أن التاريخ قبل التاريخ المحدد.

---

### السؤال 17
كيف تتحقق من أن الملف المرفوع صورة؟

A) `file:image`
B) `image`
C) `picture`
D) `photo`

**الإجابة الصحيحة**: B
**الشرح**: `image` يتحقق من أن الملف صورة (jpg, jpeg, png, bmp, gif, svg, webp).

---

### السؤال 18
ما هي قاعدة التحقق من حجم الملف (بالكيلوبايت)؟

A) `size:value`
B) `max:value`
C) `filesize:value`
D) `limit:value`

**الإجابة الصحيحة**: B
**الشرح**: `max:value` يحدد الحجم الأقصى بالكيلوبايت للملفات.

---

### السؤال 19
كيف تتحقق من أنواع ملفات محددة؟

A) `types:pdf,doc`
B) `mimes:pdf,doc`
C) `formats:pdf,doc`
D) `extensions:pdf,doc`

**الإجابة الصحيحة**: B
**الشرح**: `mimes:pdf,doc` يتحقق من أن الملف من الأنواع المحددة.

---

### السؤال 20
ما هو الأمر لإنشاء Form Request؟

A) `php artisan create:request RequestName`
B) `php artisan make:request RequestName`
C) `php artisan new:request RequestName`
D) `php artisan generate:request RequestName`

**الإجابة الصحيحة**: B
**الشرح**: `php artisan make:request RequestName` ينشئ Form Request class.

---

### السؤال 21
ما هو الغرض من دالة `authorize()` في Form Request؟

A) تحديد قواعد Validation
B) التحقق من صلاحيات المستخدم
C) تشفير البيانات
D) حفظ البيانات

**الإجابة الصحيحة**: B
**الشرح**: `authorize()` تحدد ما إذا كان المستخدم مصرحاً له بهذا الطلب.

---

### السؤال 22
أين يتم تعريف قواعد Validation في Form Request؟

A) `validate()`
B) `rules()`
C) `constraints()`
D) `requirements()`

**الإجابة الصحيحة**: B
**الشرح**: `rules()` method يحتوي على قواعد Validation.

---

### السؤال 23
كيف تحصل على البيانات المتحقق منها من Form Request؟

A) `$request->all()`
B) `$request->validated()`
C) `$request->verified()`
D) `$request->checked()`

**الإجابة الصحيحة**: B
**الشرح**: `$request->validated()` يرجع فقط البيانات التي نجحت في Validation.

---

### السؤال 24
ما هو الغرض من `prepareForValidation()` في Form Request؟

A) تنظيف أو تعديل البيانات قبل Validation
B) تحديد قواعد إضافية
C) حفظ البيانات
D) إرسال الأخطاء

**الإجابة الصحيحة**: A
**الشرح**: `prepareForValidation()` تسمح بتعديل البيانات قبل عملية Validation.

---

### السؤال 25
ما هو الأمر لإنشاء Custom Validation Rule؟

A) `php artisan create:rule RuleName`
B) `php artisan make:rule RuleName`
C) `php artisan new:rule RuleName`
D) `php artisan generate:rule RuleName`

**الإجابة الصحيحة**: B
**الشرح**: `php artisan make:rule RuleName` ينشئ Custom Rule class.

---

### السؤال 26
ما هي الطريقة التي تحتوي على منطق التحقق في Custom Rule؟

A) `validate()`
B) `check()`
C) `passes()`
D) `verify()`

**الإجابة الصحيحة**: C
**الشرح**: `passes($attribute, $value)` تحتوي على منطق التحقق وترجع true/false.

---

### السؤال 27
كيف تعرض جميع أخطاء Validation في Blade؟

A) `@errors`
B) `@if ($errors->any())`
C) `@showerrors`
D) `@displayerrors`

**الإجابة الصحيحة**: B
**الشرح**: `@if ($errors->any())` للتحقق من وجود أخطاء ثم عرضها.

---

### السؤال 28
كيف تعرض خطأ حقل معين في Blade؟

A) `@error('field')`
B) `@showerror('field')`
C) `@fielderror('field')`
D) `@displayerror('field')`

**الإجابة الصحيحة**: A
**الشرح**: `@error('field')` directive يعرض خطأ الحقل المحدد.

---

### السؤال 29
كيف تحصل على أول رسالة خطأ لحقل معين؟

A) `$errors->get('field')`
B) `$errors->first('field')`
C) `$errors->one('field')`
D) `$errors->single('field')`

**الإجابة الصحيحة**: B
**الشرح**: `$errors->first('field')` يرجع أول رسالة خطأ للحقل.

---

### السؤال 30
كيف تحفظ ملف مرفوع في storage؟

A) `$request->file('field')->upload('folder')`
B) `$request->file('field')->store('folder')`
C) `$request->file('field')->save('folder')`
D) `$request->file('field')->put('folder')`

**الإجابة الصحيحة**: B
**الشرح**: `store('folder')` يحفظ الملف في المجلد المحدد ويرجع المسار.

---

## القسم الثاني: صح أو خطأ (20 نقطة)

**اكتب (صح) أو (خطأ) أمام كل عبارة (1 نقطة لكل سؤال)**

### السؤال 31
CSRF Token ضروري في جميع Forms (GET, POST, PUT, DELETE).

**الإجابة**: خطأ
**الشرح**: CSRF Token مطلوب فقط في POST, PUT, PATCH, DELETE وليس GET.

---

### السؤال 32
`@method('DELETE')` ينشئ hidden input باسم `_method`.

**الإجابة**: صح
**الشرح**: هذا صحيح، Laravel يستخدم Method Spoofing عبر `_method` hidden field.

---

### السؤال 33
`old('field')` يعمل فقط بعد استخدام `validate()` method.

**الإجابة**: خطأ
**الشرح**: `old()` يعمل بعد أي redirect مع `withInput()` أو بعد `validate()`.

---

### السؤال 34
يمكن استخدام `$request->all()` مباشرة في `Model::create()` بشكل آمن.

**الإجابة**: خطأ
**الشرح**: غير آمن، يجب استخدام `validated()` أو `only()` لتحديد الحقول المسموحة.

---

### السؤال 35
قاعدة `required` تتحقق من أن الحقل موجود وليس فارغاً.

**الإجابة**: صح
**الشرح**: `required` يتحقق من وجود الحقل وأن له قيمة.

---

### السؤال 36
قاعدة `nullable` تسمح للحقل بأن يكون غير موجود أو فارغ.

**الإجابة**: صح
**الشرح**: `nullable` يسمح بعدم وجود الحقل أو أن يكون null.

---

### السؤال 37
`unique:users,email` تتحقق من أن البريد فريد في جدول users عمود email.

**الإجابة**: صح
**الشرح**: هذا صحيح، `unique:table,column` يتحقق من التفرد.

---

### السؤال 38
`confirmed` rule تتطلب وجود حقل باسم `field_confirmation`.

**الإجابة**: صح
**الشرح**: `confirmed` تبحث تلقائياً عن حقل باسم `{field}_confirmation`.

---

### السؤال 39
`min:10` للنصوص تعني 10 أحرف، وللأرقام تعني قيمة 10.

**الإجابة**: صح
**الشرح**: `min` تطبق على الطول للنصوص والقيمة للأرقام.

---

### السؤال 40
`image` rule يتحقق من جميع أنواع الملفات وليس الصور فقط.

**الإجابة**: خطأ
**الشرح**: `image` يتحقق فقط من أنواع الصور المحددة.

---

### السؤال 41
`max:2048` للملفات يعني 2048 بايت.

**الإجابة**: خطأ
**الشرح**: `max` للملفات يُقاس بالكيلوبايت، فـ 2048 تعني 2MB.

---

### السؤال 42
Form Request يقوم تلقائياً بإعادة التوجيه مع الأخطاء إذا فشل Validation.

**الإجابة**: صح
**الشرح**: Laravel تلقائياً يعيد التوجيه مع الأخطاء عند فشل Validation في Form Request.

---

### السؤال 43
`authorize()` في Form Request يجب أن ترجع `true` للسماح بالطلب.

**الإجابة**: صح
**الشرح**: إذا رجعت `false` سيتم رفض الطلب برمز 403.

---

### السؤال 44
يمكن استخدام `prepareForValidation()` لتوليد slug من العنوان قبل Validation.

**الإجابة**: صح
**الشرح**: هذا استخدام شائع وصحيح لـ `prepareForValidation()`.

---

### السؤال 45
Custom Validation Rule يجب أن يحتوي على methods: `passes()` و `message()`.

**الإجابة**: صح
**الشرح**: `passes()` للتحقق و `message()` لرسالة الخطأ.

---

### السؤال 46
`@error('field')` directive متوفر فقط في Laravel 9+.

**الإجابة**: خطأ
**الشرح**: `@error` متوفر منذ Laravel 5.8.

---

### السؤال 47
`$errors` متغير متاح تلقائياً في جميع Blade views.

**الإجابة**: صح
**الشرح**: Laravel تلقائياً يشارك `$errors` مع جميع Views.

---

### السؤال 48
`store('folder')` يحفظ الملف بـ disk الافتراضي (local).

**الإجابة**: صح
**الشرح**: إذا لم تحدد disk، سيستخدم الافتراضي وهو `local`.

---

### السؤال 49
`storeAs('folder', 'name.jpg')` يسمح بتحديد اسم مخصص للملف.

**الإجابة**: صح
**الشرح**: `storeAs()` يسمح بتحديد اسم الملف بدلاً من التوليد التلقائي.

---

### السؤال 50
AJAX requests تحتاج `X-CSRF-TOKEN` header للـ CSRF protection.

**الإجابة**: صح
**الشرح**: يجب إضافة CSRF token في headers لـ AJAX requests.

---

## القسم الثالث: أسئلة مقالية وبرمجة (20 نقطة)

**أجب عن الأسئلة التالية بشكل تفصيلي واكتب الكود المطلوب (4 نقاط لكل سؤال)**

### السؤال 51
اشرح الفرق بين Client-Side Validation و Server-Side Validation، ولماذا يجب دائماً استخدام Server-Side؟

**الإجابة**:

**Client-Side Validation**:
- يحدث في المتصفح (JavaScript/HTML5)
- سريع ولا يحتاج طلب للسيرفر
- يحسن تجربة المستخدم
- **يمكن تجاوزه بسهولة** (تعطيل JavaScript، تعديل HTML)

**Server-Side Validation**:
- يحدث في Laravel (PHP)
- آمن وموثوق
- لا يمكن تجاوزه
- يعالج البيانات قبل الحفظ

**لماذا يجب استخدام Server-Side دائماً؟**
1. **الأمان**: Client-side يمكن تجاوزه بسهولة
2. **الموثوقية**: Server-side هو الحاجز الأخير
3. **حماية قاعدة البيانات**: منع بيانات غير صحيحة أو ضارة
4. **Best Practice**: لا تثق أبداً في Client-side فقط

**الخلاصة**: استخدم Client-side لتحسين التجربة، ولكن **دائماً** استخدم Server-side للأمان.

---

### السؤال 52
اكتب كود Form Request كامل لتسجيل مستخدم جديد يحتوي على: name, email, password, avatar (صورة اختيارية). مع رسائل خطأ مخصصة بالعربية.

**الإجابة**:

```php
// app/Http/Requests/RegisterUserRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    /**
     * التحقق من الصلاحيات
     */
    public function authorize(): bool
    {
        return true; // أي شخص يمكنه التسجيل
    }

    /**
     * قواعد Validation
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers()
            ],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    /**
     * رسائل خطأ مخصصة
     */
    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.min' => 'الاسم يجب أن يكون 3 أحرف على الأقل',
            'name.max' => 'الاسم طويل جداً',

            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً',

            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير متطابقة',

            'avatar.image' => 'الملف يجب أن يكون صورة',
            'avatar.mimes' => 'الصورة يجب أن تكون jpeg, png, أو jpg',
            'avatar.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت',
        ];
    }

    /**
     * أسماء مخصصة للحقول
     */
    public function attributes(): array
    {
        return [
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'avatar' => 'الصورة الشخصية',
        ];
    }

    /**
     * تنظيف البيانات قبل Validation
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'email' => strtolower(trim($this->email)),
        ]);
    }
}
```

**الاستخدام في Controller**:

```php
public function register(RegisterUserRequest $request)
{
    $data = $request->validated();

    // معالجة الصورة
    if ($request->hasFile('avatar')) {
        $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    $user = User::create($data);

    Auth::login($user);

    return redirect()->route('home')->with('success', 'مرحباً بك!');
}
```

---

### السؤال 53
اكتب كود Custom Validation Rule للتحقق من أن رقم الجوال سعودي (يبدأ بـ 05 ويتبعه 8 أرقام). مع مثال استخدام.

**الإجابة**:

```bash
php artisan make:rule SaudiPhoneNumber
```

```php
// app/Rules/SaudiPhoneNumber.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SaudiPhoneNumber implements Rule
{
    /**
     * منطق التحقق
     */
    public function passes($attribute, $value)
    {
        // التحقق من أن الرقم يبدأ بـ 05 ويتبعه 8 أرقام بالضبط
        return preg_match('/^05[0-9]{8}$/', $value);
    }

    /**
     * رسالة الخطأ
     */
    public function message()
    {
        return 'رقم الجوال يجب أن يكون رقم سعودي صحيح (05xxxxxxxx)';
    }
}
```

**مثال الاستخدام**:

```php
// في Controller
use App\Rules\SaudiPhoneNumber;

$request->validate([
    'phone' => ['required', new SaudiPhoneNumber],
]);

// في Form Request
use App\Rules\SaudiPhoneNumber;

public function rules(): array
{
    return [
        'phone' => ['required', new SaudiPhoneNumber],
    ];
}
```

**أمثلة على القيم**:
- ✅ `0512345678` - صحيح
- ✅ `0501234567` - صحيح
- ❌ `512345678` - خطأ (لا يبدأ بـ 05)
- ❌ `05123456` - خطأ (أقل من 10 أرقام)
- ❌ `05123456789` - خطأ (أكثر من 10 أرقام)
- ❌ `+966512345678` - خطأ (صيغة دولية)

---

### السؤال 54
اكتب كود HTML Form لرفع عدة صور (1-5 صور) مع Validation في Controller، ومعاينة الصور قبل الرفع باستخدام JavaScript.

**الإجابة**:

#### HTML Form

```blade
<form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="images" class="form-label">الصور (1-5 صور) *</label>
        <input type="file"
               class="form-control @error('images') is-invalid @enderror"
               id="images"
               name="images[]"
               multiple
               accept="image/*">

        @error('images')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @error('images.*')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- منطقة معاينة الصور -->
    <div id="imagePreview" class="row g-2 mb-3"></div>

    <button type="submit" class="btn btn-primary">رفع الصور</button>
</form>
```

#### JavaScript للمعاينة

```javascript
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = ''; // مسح المعاينة السابقة

    const files = Array.from(e.target.files);

    // التحقق من عدد الصور
    if (files.length > 5) {
        alert('يمكنك رفع 5 صور كحد أقصى');
        e.target.value = ''; // مسح الاختيار
        return;
    }

    files.forEach((file, index) => {
        // التحقق من أن الملف صورة
        if (!file.type.startsWith('image/')) {
            alert(`الملف ${file.name} ليس صورة`);
            return;
        }

        // إنشاء FileReader للمعاينة
        const reader = new FileReader();

        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-md-3';

            col.innerHTML = `
                <div class="position-relative">
                    <img src="${e.target.result}"
                         class="img-fluid rounded"
                         style="width: 100%; height: 200px; object-fit: cover;">
                    <span class="badge bg-primary position-absolute top-0 start-0 m-2">
                        ${index + 1}
                    </span>
                    <small class="text-muted d-block mt-1">${file.name}</small>
                </div>
            `;

            preview.appendChild(col);
        };

        reader.readAsDataURL(file);
    });
});
```

#### Controller Validation

```php
// app/Http/Controllers/GalleryController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'images' => ['required', 'array', 'min:1', 'max:5'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:3072'], // 3MB
        ], [
            'images.required' => 'يجب رفع صورة واحدة على الأقل',
            'images.min' => 'يجب رفع صورة واحدة على الأقل',
            'images.max' => 'لا يمكن رفع أكثر من 5 صور',
            'images.*.image' => 'الملف يجب أن يكون صورة',
            'images.*.mimes' => 'الصورة يجب أن تكون jpeg, png, jpg, أو webp',
            'images.*.max' => 'حجم الصورة يجب أن لا يتجاوز 3 ميجابايت',
        ]);

        $paths = [];

        foreach ($request->file('images') as $image) {
            $path = $image->store('gallery', 'public');
            $paths[] = $path;

            // حفظ في قاعدة البيانات
            auth()->user()->images()->create(['path' => $path]);
        }

        return redirect()->back()
            ->with('success', 'تم رفع ' . count($paths) . ' صورة بنجاح');
    }
}
```

---

### السؤال 55
اكتب كود Form يستخدم AJAX لإرسال التعليق بدون إعادة تحميل الصفحة، مع معالجة الأخطاء وعرض التعليق الجديد تلقائياً.

**الإجابة**:

#### HTML Form

```blade
<div id="comments-section">
    <h4>التعليقات</h4>

    <!-- نموذج إضافة تعليق -->
    <form id="commentForm" class="mb-4">
        <div class="mb-3">
            <textarea class="form-control"
                      id="commentContent"
                      name="content"
                      rows="3"
                      placeholder="اكتب تعليقك هنا..."></textarea>
            <div id="contentError" class="text-danger small mt-1"></div>
        </div>

        <button type="submit" class="btn btn-primary" id="submitBtn">
            <span id="btnText">إضافة تعليق</span>
            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
        </button>
    </form>

    <!-- رسالة النجاح -->
    <div id="successAlert" class="alert alert-success d-none"></div>

    <!-- قائمة التعليقات -->
    <div id="commentsList">
        <!-- التعليقات الموجودة -->
    </div>
</div>
```

#### JavaScript

```javascript
document.getElementById('commentForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    // مسح الأخطاء السابقة
    document.getElementById('contentError').textContent = '';
    document.getElementById('successAlert').classList.add('d-none');

    // تعطيل الزر وعرض Spinner
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');

    submitBtn.disabled = true;
    btnText.classList.add('d-none');
    btnSpinner.classList.remove('d-none');

    const formData = new FormData(this);

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
            const successAlert = document.getElementById('successAlert');
            successAlert.textContent = data.message;
            successAlert.classList.remove('d-none');

            // إضافة التعليق الجديد للقائمة
            const commentsList = document.getElementById('commentsList');
            const newComment = document.createElement('div');
            newComment.className = 'card mb-3 comment-new';
            newComment.innerHTML = `
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <img src="${data.comment.avatar}"
                             class="rounded-circle me-2"
                             style="width: 40px; height: 40px;">
                        <div>
                            <strong>${data.comment.author}</strong>
                            <br>
                            <small class="text-muted">${data.comment.created_at}</small>
                        </div>
                    </div>
                    <p class="mb-0">${data.comment.content}</p>
                </div>
            `;

            // إضافة في بداية القائمة
            commentsList.insertBefore(newComment, commentsList.firstChild);

            // مسح الـ form
            this.reset();

            // إخفاء رسالة النجاح بعد 5 ثواني
            setTimeout(() => {
                successAlert.classList.add('d-none');
            }, 5000);
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
```

#### Controller

```php
// app/Http/Controllers/CommentController.php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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
}
```

---

## الخلاصة

هذا الامتحان يغطي:

✅ HTML Forms و CSRF Protection
✅ Method Spoofing
✅ استقبال البيانات
✅ Inline Validation
✅ جميع Validation Rules
✅ Form Requests
✅ Custom Validation Rules
✅ File Upload
✅ Error Handling
✅ AJAX Forms

**تهانينا على إكمال الامتحان!** 🎉
