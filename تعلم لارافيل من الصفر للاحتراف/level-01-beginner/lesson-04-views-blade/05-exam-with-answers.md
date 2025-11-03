# الدرس الرابع - الاختبار مع الإجابات: Views و Blade Templates في Laravel

## 📋 معلومات الاختبار

- **عدد الأسئلة**: 50 سؤال
- **الوقت المقدر**: 60 دقيقة
- **الدرجة الكلية**: 100 درجة
- **درجة النجاح**: 70%

---

## القسم الأول: أسئلة الاختيار من متعدد (30 سؤال × 2 درجة = 60 درجة)

### السؤال 1
ما هو Blade في Laravel?

A) نظام قاعدة بيانات
B) محرك القوالب (Template Engine)
C) نظام Routing
D) ORM Framework

**الإجابة الصحيحة**: B

**الشرح**: Blade هو محرك القوالب الخاص بـ Laravel يوفر Syntax نظيف وسهل لكتابة Views.

---

### السؤال 2
ما امتداد ملفات Blade?

A) .php
B) .html
C) .blade.php
D) .view.php

**الإجابة الصحيحة**: C

**الشرح**: ملفات Blade تنتهي بـ .blade.php للتمييز بينها وبين ملفات PHP العادية.

---

### السؤال 3
أين يتم حفظ Views في Laravel?

A) app/Views/
B) resources/views/
C) public/views/
D) storage/views/

**الإجابة الصحيحة**: B

**الشرح**: جميع Views يتم حفظها في مجلد resources/views/.

---

### السؤال 4
كيف تعرض متغير في Blade مع حماية من XSS?

A) <?php echo $name; ?>
B) {!! $name !!}
C) {{ $name }}
D) @echo($name)

**الإجابة الصحيحة**: C

**الشرح**: {{ }} يقوم تلقائياً بـ escape للمحتوى لحمايته من XSS.

---

### السؤال 5
كيف تعرض HTML بدون Escaping في Blade?

A) {{ $html }}
B) {!! $html !!}
C) {{{ $html }}}
D) @raw($html)

**الإجابة الصحيحة**: B

**الشرح**: {!! !!} يعرض المحتوى بدون escaping، استخدمه فقط مع محتوى موثوق.

---

### السؤال 6
كيف تكتب تعليق في Blade?

A) <!-- تعليق -->
B) // تعليق
C) /* تعليق */
D) {{-- تعليق --}}

**الإجابة الصحيحة**: D

**الشرح**: {{-- --}} هو Syntax التعليقات في Blade ولن يظهر في HTML النهائي.

---

### السؤال 7
ما الطريقة الصحيحة لاستخدام if في Blade?

A) <?php if ($x > 5): ?>
B) @if ($x > 5)
C) {{ if ($x > 5) }}
D) {if $x > 5}

**الإجابة الصحيحة**: B

**الشرح**: @if هو الـ directive الصحيح للشروط في Blade.

---

### السؤال 8
ما هو @unless في Blade?

A) مثل if
B) مثل else
C) عكس if
D) مثل switch

**الإجابة الصحيحة**: C

**الشرح**: @unless يعادل @if (!) - ينفذ الكود إذا كان الشرط false.

---

### السؤال 9
كيف تعرض قائمة باستخدام foreach في Blade?

A) @for($items as $item)
B) @foreach ($items as $item)
C) @each($items as $item)
D) @loop($items as $item)

**الإجابة الصحيحة**: B

**الشرح**: @foreach هو الـ directive الصحيح للـ loops في Blade.

---

### السؤال 10
ما فائدة @forelse?

A) loop مع شرط
B) loop مع else للحالة الفارغة
C) loop معكوس
D) loop متداخل

**الإجابة الصحيحة**: B

**الشرح**: @forelse يسمح بإضافة @empty block ينفذ إذا كان الـ array فارغاً.

---

### السؤال 11
ما هي $loop variable في Blade?

A) متغير لحفظ البيانات
B) متغير يحتوي معلومات عن الـ loop الحالي
C) دالة للتكرار
D) array من العناصر

**الإجابة الصحيحة**: B

**الشرح**: $loop متغير خاص يحتوي على معلومات مثل index, iteration, first, last, etc.

---

### السؤال 12
ماذا يعيد $loop->first?

A) العنصر الأول
B) true إذا كان أول تكرار
C) رقم 1
D) index صفر

**الإجابة الصحيحة**: B

**الشرح**: $loop->first يعيد true إذا كان التكرار الحالي هو الأول.

---

### السؤال 13
ما الفرق بين $loop->index و $loop->iteration?

A) لا فرق
B) index يبدأ من 0، iteration يبدأ من 1
C) index يبدأ من 1، iteration يبدأ من 0
D) index للـ arrays، iteration للـ objects

**الإجابة الصحيحة**: B

**الشرح**: $loop->index يبدأ من 0 (للبرمجة)، $loop->iteration يبدأ من 1 (للعرض).

---

### السؤال 14
كيف تورث layout في Blade?

A) @include('layout')
B) @extends('layout')
C) @layout('layout')
D) @use('layout')

**الإجابة الصحيحة**: B

**الشرح**: @extends يستخدم لوراثة layout في Blade.

---

### السؤال 15
ما الفرق بين @yield و @section?

A) لا فرق
B) @yield للمحتوى البسيط، @section للمعقد
C) @yield في الـ view، @section في الـ layout
D) @yield أسرع من @section

**الإجابة الصحيحة**: B

**الشرح**: @yield يستخدم للمحتوى البسيط وله قيمة افتراضية، @section أكثر مرونة.

---

### السؤال 16
ماذا يفعل @parent في Blade?

A) يحذف محتوى الـ layout
B) يستبدل محتوى الـ layout
C) يضيف للمحتوى بدلاً من استبداله
D) يعرض معلومات الصفحة الأب

**الإجابة الصحيحة**: C

**الشرح**: @parent يحتفظ بمحتوى الـ layout ويضيف عليه.

---

### السؤال 17
ما الطريقة الصحيحة لإنهاء @section في View?

A) @end
B) @close
C) @endsection
D) @stop

**الإجابة الصحيحة**: C

**الشرح**: @endsection أو @stop يستخدمان لإنهاء @section.

---

### السؤال 18
ما فائدة @stack في Blade?

A) تخزين متغيرات
B) تجميع scripts أو styles من views متعددة
C) إنشاء array
D) عرض قائمة

**الإجابة الصحيحة**: B

**الشرح**: @stack يسمح بتجميع محتوى من views مختلفة في مكان واحد.

---

### السؤال 19
كيف تضيف محتوى إلى @stack?

A) @add('name')
B) @push('name')
C) @append('name')
D) @insert('name')

**الإجابة الصحيحة**: B

**الشرح**: @push يستخدم لإضافة محتوى إلى stack معين.

---

### السؤال 20
ما الفرق بين @push و @prepend?

A) لا فرق
B) @push يضيف في النهاية، @prepend في البداية
C) @push للـ scripts، @prepend للـ styles
D) @push أسرع

**الإجابة الصحيحة**: B

**الشرح**: @push يضيف في نهاية الـ stack، @prepend في البداية.

---

### السؤال 21
كيف تُضمّن (include) view آخر في Blade?

A) @import('view')
B) @require('view')
C) @include('view')
D) @use('view')

**الإجابة الصحيحة**: C

**الشرح**: @include يستخدم لتضمين view آخر.

---

### السؤال 22
ما فائدة @includeIf?

A) include مع شرط
B) include فقط إذا كان الملف موجوداً
C) include مع else
D) include عدة ملفات

**الإجابة الصحيحة**: B

**الشرح**: @includeIf يُضمّن الـ view فقط إذا كان موجوداً، ولا يُظهر خطأ إذا لم يكن موجوداً.

---

### السؤال 23
ما هو Component في Blade?

A) class في Laravel
B) قطعة UI قابلة لإعادة الاستخدام
C) نوع من الـ routes
D) ملف JavaScript

**الإجابة الصحيحة**: B

**الشرح**: Component هو قطعة من الـ UI يمكن إعادة استخدامها في أماكن متعددة.

---

### السؤال 24
كيف تستخدم Component في Blade?

A) @component('name')
B) <component name="name">
C) <x-name>
D) {{ component('name') }}

**الإجابة الصحيحة**: C

**الشرح**: <x-name> هو الـ syntax لاستخدام Components في Blade.

---

### السؤال 25
ما هو $slot في Component?

A) متغير للبيانات
B) المحتوى الافتراضي للـ component
C) اسم الـ component
D) نوع الـ component

**الإجابة الصحيحة**: B

**الشرح**: $slot يحتوي على المحتوى الذي يتم تمريره داخل الـ component.

---

### السؤال 26
كيف تمرر prop إلى Component?

A) <x-button $type="primary">
B) <x-button prop:type="primary">
C) <x-button type="primary">
D) <x-button [type]="primary">

**الإجابة الصحيحة**: C

**الشرح**: Props تُمرر كـ attributes عادية في الـ component tag.

---

### السؤال 27
كيف تمرر متغير PHP إلى Component?

A) <x-button type="$var">
B) <x-button :type="$var">
C) <x-button type="{{ $var }}">
D) <x-button {{type=$var}}>

**الإجابة الصحيحة**: B

**الشرح**: : قبل اسم الـ attribute يسمح بتمرير متغير PHP مباشرة.

---

### السؤال 28
ما فائدة @props في Component?

A) عرض الخصائص
B) تعريف الخصائص المقبولة مع قيم افتراضية
C) حذف الخصائص
D) تحويل الخصائص

**الإجابة الصحيحة**: B

**الشرح**: @props يُستخدم لتعريف props مع قيم افتراضية في Anonymous Components.

---

### السؤال 29
ما هو Named Slot?

A) slot بدون اسم
B) slot له اسم محدد
C) slot في الـ header
D) slot في الـ footer

**الإجابة الصحيحة**: B

**الشرح**: Named Slot يسمح بتمرير عدة أقسام مختلفة للـ component.

---

### السؤال 30
ما الطريقة الصحيحة لإنشاء named slot?

A) @slot('name')
B) <slot name="name">
C) <x-slot name="name">
D) {{ slot('name') }}

**الإجابة الصحيحة**: C

**الشرح**: <x-slot name="name"> يُستخدم لإنشاء named slot.

---

## القسم الثاني: أسئلة صح أو خطأ (20 سؤال × 1 درجة = 20 درجة)

### السؤال 31
{{ }} في Blade يقوم تلقائياً بحماية المحتوى من XSS.

**الإجابة**: صح ✓

**الشرح**: {{ }} يستخدم htmlspecialchars تلقائياً لحماية المحتوى.

---

### السؤال 32
{!! !!} آمن للاستخدام مع أي محتوى.

**الإجابة**: خطأ ✗

**الشرح**: {!! !!} لا يقوم بـ escaping، يجب استخدامه فقط مع محتوى موثوق.

---

### السؤال 33
التعليقات في Blade {{-- --}} تظهر في HTML النهائي.

**الإجابة**: خطأ ✗

**الشرح**: تعليقات Blade لا تظهر في HTML النهائي على عكس <!-- -->.

---

### السؤال 34
@forelse يتطلب دائماً @empty block.

**الإجابة**: خطأ ✗

**الشرح**: @empty اختياري، لكن من الأفضل استخدامه لتجنب الصفحة الفارغة.

---

### السؤال 35
$loop variable متاح في جميع أنواع الـ loops في Blade.

**الإجابة**: صح ✓

**الشرح**: $loop متاح في @foreach, @forelse, @for, و @while.

---

### السؤال 36
يمكن استخدام @extends أكثر من مرة في نفس الـ view.

**الإجابة**: خطأ ✗

**الشرح**: @extends يُستخدم مرة واحدة فقط في بداية الـ view.

---

### السؤال 37
@yield يمكن أن يحتوي على قيمة افتراضية.

**الإجابة**: صح ✓

**الشرح**: @yield('title', 'Default Title') - المعامل الثاني هو القيمة الافتراضية.

---

### السؤال 38
@parent يعمل فقط مع @yield.

**الإجابة**: خطأ ✗

**الشرح**: @parent يعمل مع @section فقط، وليس مع @yield.

---

### السؤال 39
@stack يجب تعريفه في الـ layout قبل استخدام @push.

**الإجابة**: صح ✓

**الشرح**: @stack يُعرّف في الـ layout، ثم يمكن استخدام @push في الـ views.

---

### السؤال 40
@include يمرر تلقائياً جميع المتغيرات المتاحة للـ view المُضمّن.

**الإجابة**: صح ✓

**الشرح**: @include يمرر تلقائياً جميع المتغيرات، لكن يمكن تمرير متغيرات إضافية.

---

### السؤال 41
Components تتطلب دائماً Class-based implementation.

**الإجابة**: خطأ ✗

**الشرح**: يمكن إنشاء Anonymous Components بدون class.

---

### السؤال 42
$slot متاح في جميع الـ Components.

**الإجابة**: صح ✓

**الشرح**: $slot هو الـ slot الافتراضي المتاح في كل component.

---

### السؤال 43
يمكن استخدام Named Slots بدون default slot.

**الإجابة**: صح ✓

**الشرح**: يمكن استخدام named slots فقط أو مع default slot.

---

### السؤال 44
@props يعمل فقط في Class-based Components.

**الإجابة**: خطأ ✗

**الشرح**: @props يُستخدم في Anonymous Components، Class-based تستخدم constructor.

---

### السؤال 45
: قبل اسم الـ attribute في Component يسمح بتمرير PHP expression.

**الإجابة**: صح ✓

**الشرح**: : تسمح بتقييم PHP expression بدلاً من التعامل معه كـ string.

---

### السؤال 46
@once يضمن تنفيذ الكود مرة واحدة فقط في الصفحة.

**الإجابة**: صح ✓

**الشرح**: @once مفيد لتجنب تكرار تحميل scripts أو styles.

---

### السؤال 47
@verbatim يمنع Blade من معالجة المحتوى.

**الإجابة**: صح ✓

**الشرح**: @verbatim مفيد عند استخدام Vue.js أو Angular مع Blade.

---

### السؤال 48
يمكن إنشاء Custom Blade Directives.

**الإجابة**: صح ✓

**الشرح**: يمكن إنشاء directives مخصصة باستخدام Blade::directive() في Service Provider.

---

### السؤال 49
View Composer يتم تنفيذه في كل مرة يتم فيها render الـ view.

**الإجابة**: صح ✓

**الشرح**: View Composer يربط بيانات مع view ويتم تنفيذه عند كل render.

---

### السؤال 50
Blade يتم compile إلى PHP عادي ويُخزن في cache.

**الإجابة**: صح ✓

**الشرح**: Blade يُحوّل إلى PHP ويُخزن في storage/framework/views للأداء الأفضل.

---

## القسم الثالث: أسئلة مقالية وبرمجية (5 أسئلة × 4 درجات = 20 درجة)

### السؤال 51
اكتب Layout كامل لموقع يحتوي على:
- Header مع Navigation
- Main Content Area
- Footer
- Support لـ @stack للـ styles و scripts

**الإجابة:**

```blade
{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'الموقع الافتراضي')">
    <title>@yield('title', 'الصفحة الرئيسية') - موقعي</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Stack Styles -->
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header>
        @include('partials.header')
    </header>

    <!-- Navigation -->
    <nav>
        @include('partials.navigation')
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        @include('partials.footer')
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Stack Scripts -->
    @stack('scripts')
</body>
</html>
```

**النقاط المهمة:**
- استخدام @yield للـ title و content
- استخدام @include للأجزاء المتكررة
- استخدام @stack للـ styles و scripts
- عرض flash messages
- دعم SEO مع meta description

---

### السؤال 52
أنشئ Component قابل لإعادة الاستخدام لـ Card يحتوي على:
- Header مع title
- Body للمحتوى الرئيسي
- Footer اختياري
- Support لـ Named Slots

**الإجابة:**

```bash
php artisan make:component Card
```

**app/View/Components/Card.php:**
```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct($title = '', $type = 'default')
    {
        $this->title = $title;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.card');
    }

    /**
     * Get card classes based on type
     */
    public function cardClasses()
    {
        $base = 'card rounded-lg shadow-md overflow-hidden';

        $typeClasses = [
            'primary' => 'border-blue-500',
            'success' => 'border-green-500',
            'danger' => 'border-red-500',
            'default' => 'border-gray-300',
        ][$this->type] ?? 'border-gray-300';

        return "$base border-l-4 $typeClasses";
    }
}
```

**resources/views/components/card.blade.php:**
```blade
<div {{ $attributes->merge(['class' => $cardClasses()]) }}>
    {{-- Card Header --}}
    @if ($title || isset($header))
        <div class="card-header bg-gray-50 px-6 py-4 border-b">
            @isset($header)
                {{ $header }}
            @else
                <h3 class="text-lg font-bold">{{ $title }}</h3>
            @endisset
        </div>
    @endif

    {{-- Card Body --}}
    <div class="card-body p-6">
        {{ $slot }}
    </div>

    {{-- Card Footer (Optional) --}}
    @isset($footer)
        <div class="card-footer bg-gray-50 px-6 py-4 border-t">
            {{ $footer }}
        </div>
    @endisset
</div>
```

**استخدام Component:**
```blade
{{-- Simple Card --}}
<x-card title="بطاقة بسيطة">
    <p>محتوى البطاقة هنا</p>
</x-card>

{{-- Card with Named Slots --}}
<x-card type="primary">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h3 class="font-bold">عنوان مخصص</h3>
            <span class="badge">جديد</span>
        </div>
    </x-slot>

    <p>محتوى البطاقة الرئيسي</p>

    <x-slot name="footer">
        <button class="btn btn-primary">إجراء</button>
    </x-slot>
</x-card>

{{-- Card with Additional Classes --}}
<x-card title="بطاقة خاصة" type="success" class="mb-4 hover:shadow-lg">
    <p>بطاقة مع classes إضافية</p>
</x-card>
```

---

### السؤال 53
اشرح الفرق بين @include و @component مع أمثلة عملية.

**الإجابة:**

**الفروقات الرئيسية:**

| الميزة | @include | @component / <x-> |
|--------|----------|------------------|
| **الغرض** | تضمين view بسيط | قطعة UI قابلة لإعادة الاستخدام |
| **البيانات** | يرث جميع المتغيرات | يحتاج تمرير صريح للبيانات |
| **المنطق** | لا يحتوي منطق | يمكن أن يحتوي منطق (في Class) |
| **Slots** | لا يدعم | يدعم slots متعددة |
| **Attributes** | لا يدعم | يدعم $attributes |

**مثال @include:**
```blade
{{-- resources/views/partials/alert.blade.php --}}
<div class="alert alert-{{ $type }}">
    {{ $message }}
</div>

{{-- استخدام --}}
@include('partials.alert', [
    'type' => 'success',
    'message' => 'تم الحفظ بنجاح'
])
```

**مميزات @include:**
- بسيط ومباشر
- يرث المتغيرات تلقائياً
- جيد للأجزاء الصغيرة البسيطة

**مثال Component:**
```blade
{{-- resources/views/components/alert.blade.php --}}
@props(['type' => 'info', 'dismissible' => false])

<div class="alert alert-{{ $type }}" role="alert">
    {{ $slot }}

    @if ($dismissible)
        <button class="close" onclick="this.parentElement.remove()">
            &times;
        </button>
    @endif
</div>

{{-- استخدام --}}
<x-alert type="success" :dismissible="true">
    تم الحفظ بنجاح!
</x-alert>
```

**مميزات Components:**
- أكثر تنظيماً
- يدعم props مع قيم افتراضية
- يمكن إضافة منطق في Class
- يدعم Named Slots
- يدعم Attributes Merging
- أفضل لقطع UI المعقدة

**متى تستخدم كل واحد؟**

**استخدم @include عندما:**
- تريد تقسيم view كبير لأجزاء صغيرة
- الجزء بسيط ولا يحتاج إعادة استخدام كثيرة
- تريد مشاركة المتغيرات تلقائياً

**استخدم Component عندما:**
- تريد قطعة UI قابلة لإعادة الاستخدام
- تحتاج props واضحة ومحددة
- تحتاج منطق معقد
- تريد slots متعددة
- تريد attribute merging

---

### السؤال 54
اكتب مثال على استخدام @forelse مع $loop variable لعرض قائمة منتجات. أضف:
- رقم تسلسلي
- تمييز العنصر الأول والأخير
- تلوين الصفوف بالتناوب (zebra striping)
- عرض رسالة إذا كانت القائمة فارغة

**الإجابة:**

```blade
<div class="products-table">
    <h2>قائمة المنتجات</h2>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>المنتج</th>
                <th>السعر</th>
                <th>المخزون</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr class="
                    {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}
                    {{ $loop->first ? 'border-t-4 border-green-500' : '' }}
                    {{ $loop->last ? 'border-b-4 border-blue-500' : '' }}
                    hover:bg-blue-50
                ">
                    {{-- رقم تسلسلي --}}
                    <td class="font-bold">
                        {{ $loop->iteration }}
                        @if ($loop->first)
                            <span class="badge badge-success">جديد</span>
                        @endif
                    </td>

                    {{-- اسم المنتج --}}
                    <td>
                        {{ $product->name }}
                        @if ($loop->last)
                            <span class="text-xs text-gray-500">(آخر منتج)</span>
                        @endif
                    </td>

                    {{-- السعر --}}
                    <td>{{ number_format($product->price, 2) }} ريال</td>

                    {{-- المخزون --}}
                    <td>
                        <span class="{{ $product->stock > 10 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock }}
                        </span>
                    </td>

                    {{-- الحالة --}}
                    <td>
                        @if ($product->stock > 0)
                            <span class="badge badge-success">متوفر</span>
                        @else
                            <span class="badge badge-danger">نفذ</span>
                        @endif
                    </td>
                </tr>

                {{-- فاصل بعد كل 5 منتجات --}}
                @if ($loop->iteration % 5 === 0 && !$loop->last)
                    <tr class="bg-gray-200">
                        <td colspan="5" class="text-center py-2 text-sm text-gray-600">
                            --- عرض {{ $loop->iteration }} من {{ $loop->count }} ---
                        </td>
                    </tr>
                @endif

            @empty
                {{-- عرض رسالة إذا لم توجد منتجات --}}
                <tr>
                    <td colspan="5" class="text-center py-12">
                        <div class="text-gray-400 text-5xl mb-4">📦</div>
                        <h3 class="text-xl font-bold text-gray-600 mb-2">
                            لا توجد منتجات
                        </h3>
                        <p class="text-gray-500 mb-4">
                            لم يتم العثور على أي منتجات لعرضها
                        </p>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            أضف منتج جديد
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>

        {{-- Footer مع معلومات إحصائية --}}
        @if ($products->count() > 0)
            <tfoot>
                <tr class="bg-gray-100 font-bold">
                    <td colspan="5" class="text-center py-3">
                        إجمالي المنتجات: {{ $products->count() }}
                    </td>
                </tr>
            </tfoot>
        @endif
    </table>

    {{-- Pagination --}}
    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
```

**الشرح:**
- `$loop->iteration` للرقم التسلسلي (يبدأ من 1)
- `$loop->even` و `$loop->odd` للتلوين بالتناوب
- `$loop->first` لتمييز العنصر الأول
- `$loop->last` لتمييز العنصر الأخير
- `@empty` لعرض رسالة عند عدم وجود منتجات
- `$loop->count` لإجمالي عدد العناصر
- استخدام modulo `%` لإضافة فاصل كل 5 منتجات

---

### السؤال 55
أنشئ View Composer يشارك البيانات التالية مع جميع Views:
- Site Name
- Categories للـ navigation
- Unread Notifications Count

**الإجابة:**

**الخطوة 1: إنشاء Service Provider**

```bash
php artisan make:provider ViewServiceProvider
```

**الخطوة 2: تعريف View Composers**

**app/Providers/ViewServiceProvider.php:**
```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // مشاركة site name مع جميع Views
        View::share('siteName', config('app.name', 'موقعي'));

        // View Composer للـ Categories في Navigation
        View::composer('partials.navigation', function ($view) {
            $view->with('categories', Category::orderBy('name')->get());
        });

        // View Composer للإشعارات (مع جميع Views)
        View::composer('*', function ($view) {
            $unreadCount = 0;

            if (Auth::check()) {
                $unreadCount = Auth::user()->unreadNotifications()->count();
            }

            $view->with('unreadNotificationsCount', $unreadCount);
        });

        // مثال على View Composer بـ Class
        View::composer(
            ['posts.index', 'posts.show'],
            \App\Http\View\Composers\PostComposer::class
        );
    }
}
```

**الخطوة 3: تسجيل Service Provider**

**config/app.php:**
```php
'providers' => [
    // ...
    App\Providers\ViewServiceProvider::class,
],
```

**الخطوة 4: إنشاء Composer Class (اختياري)**

**app/Http/View/Composers/PostComposer.php:**
```php
<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Post;

class PostComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with([
            'popularPosts' => Post::orderBy('views', 'desc')->take(5)->get(),
            'recentPosts' => Post::latest()->take(5)->get(),
        ]);
    }
}
```

**الخطوة 5: استخدام في Views**

**resources/views/partials/navigation.blade.php:**
```blade
<nav class="navbar">
    <div class="container">
        {{-- Site Name (متاح في جميع Views) --}}
        <a href="/" class="navbar-brand">
            {{ $siteName }}
        </a>

        {{-- Categories (متاح عبر View Composer) --}}
        <ul class="navbar-nav">
            @foreach ($categories as $category)
                <li class="nav-item">
                    <a href="{{ route('category', $category->slug) }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Notifications (متاح في جميع Views) --}}
        <div class="notifications">
            <a href="{{ route('notifications') }}">
                🔔
                @if ($unreadNotificationsCount > 0)
                    <span class="badge">{{ $unreadNotificationsCount }}</span>
                @endif
            </a>
        </div>
    </div>
</nav>
```

**في أي view آخر:**
```blade
<h1>مرحباً بك في {{ $siteName }}</h1>

@if ($unreadNotificationsCount > 0)
    <div class="alert alert-info">
        لديك {{ $unreadNotificationsCount }} إشعار جديد
    </div>
@endif
```

**الفوائد:**
- **DRY Principle**: لا تكرار للكود
- **Centralized**: البيانات المشتركة في مكان واحد
- **Performance**: يمكن إضافة caching بسهولة
- **Maintainability**: سهولة التعديل والصيانة

---

## 📊 حساب الدرجات

- **القسم الأول (1-30)**: _____ / 60
- **القسم الثاني (31-50)**: _____ / 20
- **القسم الثالث (51-55)**: _____ / 20
- **المجموع الكلي**: _____ / 100

---

## معايير التقييم

| النسبة المئوية | التقدير |
|----------------|---------|
| 90% - 100% | ممتاز |
| 80% - 89% | جيد جداً |
| 70% - 79% | جيد |
| 60% - 69% | مقبول |
| أقل من 60% | راسب |

---

## نصائح للمراجعة

إذا حصلت على درجة أقل من 70%، راجع:

1. **Blade Basics**: {{ }}, {!! !!}, التعليقات
2. **Control Structures**: @if, @unless, @isset
3. **Loops**: @foreach, @forelse, $loop variable
4. **Layouts**: @extends, @yield, @section, @parent
5. **Stacks**: @stack, @push, @prepend
6. **Including**: @include وأنواعه
7. **Components**: Anonymous و Class-based
8. **Slots**: Default و Named Slots
9. **Props & Attributes**: تمرير البيانات للـ Components
10. **View Composers**: مشاركة البيانات

---

**تهانينا على إكمال الاختبار! 🎉**
