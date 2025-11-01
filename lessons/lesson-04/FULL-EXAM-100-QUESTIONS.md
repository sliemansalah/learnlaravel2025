# Lesson 4: Blade Templates - Full Exam
# الدرس الرابع: قوالب Blade - الاختبار الكامل

**Total Questions:** 100
**Lesson Topic:** Blade Templates & User Interfaces
**Time Limit:** 150 minutes
**Passing Score:** 70/100

---

## Student Information / معلومات الطالب

**Name / الاسم:** ___________________
**Date / التاريخ:** ___________________
**Start Time / وقت البدء:** ___________________
**End Time / وقت الانتهاء:** ___________________

---

## Exam Sections / أقسام الاختبار

| Section | Question Type | Questions | Points |
|---------|--------------|-----------|--------|
| A | Multiple Choice | 35 | 35 |
| B | True/False | 20 | 20 |
| C | Fill in the Blanks | 10 | 10 |
| D | Code Output | 15 | 15 |
| E | Find the Bug | 10 | 10 |
| F | Code Writing | 10 | 10 |
| **Total** | | **100** | **100** |

---

# Section A: Multiple Choice (35 Questions)

---

### Q1. What is Blade?

a) A JavaScript framework
b) Laravel's templating engine
c) A database driver
d) A CSS framework

**Answer:** _____

---

### Q2. What file extension do Blade templates use?

a) `.php`
b) `.html`
c) `.blade.php`
d) `.blade`

**Answer:** _____

---

### Q3. Where are Blade templates stored?

a) `app/views/`
b) `resources/views/`
c) `public/views/`
d) `templates/`

**Answer:** _____

---

### Q4. How do you echo a variable in Blade?

a) `<?php echo $var; ?>`
b) `{{ $var }}`
c) `{{{ $var }}}`
d) `<%= $var %>`

**Answer:** _____

---

### Q5. What does `{{ $name }}` do?

a) Echoes $name without escaping
b) Echoes $name with HTML escaping
c) Defines a variable
d) Creates a route

**Answer:** _____

---

### Q6. How do you echo unescaped data in Blade?

a) `{{ $data }}`
b) `{!! $data !!}`
c) `{{{ $data }}}`
d) `{{ raw($data) }}`

**Answer:** _____

---

### Q7. What's the difference between `{{ }}` and `{!! !!}`?

a) No difference
b) `{{ }}` escapes HTML, `{!! !!}` doesn't
c) `{!! !!}` escapes HTML, `{{ }}` doesn't
d) `{{ }}` is for strings, `{!! !!}` for numbers

**Answer:** _____

---

### Q8. How do you write a comment in Blade?

a) `<!-- comment -->`
b) `{{-- comment --}}`
c) `// comment`
d) `/* comment */`

**Answer:** _____

---

### Q9. What does the `@if` directive do?

a) Creates a loop
b) Conditional statement
c) Defines a variable
d) Includes a file

**Answer:** _____

---

### Q10. How do you write an if statement in Blade?

a) `@if($condition) ... @endif`
b) `{{ if($condition) }} ... {{ endif }}`
c) `{if $condition} ... {/if}`
d) `@if($condition): ... @end`

**Answer:** _____

---

### Q11. What Blade directive checks if a variable is set and not empty?

a) `@if`
b) `@isset`
c) `@empty`
d) `@defined`

**Answer:** _____

---

### Q12. What does `@unless` do?

a) Same as @if
b) Opposite of @if (if NOT)
c) Creates a loop
d) Includes a view

**Answer:** _____

---

### Q13. How do you write a foreach loop in Blade?

a) `@foreach($items as $item) ... @endforeach`
b) `{{ foreach($items as $item) }} ... {{ end }}`
c) `@each($items as $item) ... @end`
d) `@loop($items) ... @endloop`

**Answer:** _____

---

### Q14. How do you access the loop variable in @foreach?

a) `$loop`
b) `$iteration`
c) `$current`
d) `$index`

**Answer:** _____

---

### Q15. What does `$loop->first` return?

a) The first item
b) True if first iteration
c) Loop count
d) Loop index

**Answer:** _____

---

### Q16. How do you include another Blade file?

a) `@include('view.name')`
b) `{{ include('view.name') }}`
c) `@import('view.name')`
d) `@require('view.name')`

**Answer:** _____

---

### Q17. How do you pass data to an included view?

a) `@include('view', ['key' => 'value'])`
b) `@include('view')->with('key', 'value')`
c) `@include('view', $data)`
d) Both a and c

**Answer:** _____

---

### Q18. What does `@extends` do?

a) Includes a file
b) Defines a child template
c) Creates a loop
d) Validates data

**Answer:** _____

---

### Q19. What does `@section` do?

a) Creates a section of code
b) Defines a content section
c) Divides the page
d) Creates a component

**Answer:** _____

---

### Q20. How do you output a section's content in a layout?

a) `@section('name')`
b) `@yield('name')`
c) `@show('name')`
d) `@display('name')`

**Answer:** _____

---

### Q21. What's the difference between `@yield` and `@section`?

a) No difference
b) `@yield` displays content, `@section` defines it
c) `@section` displays content, `@yield` defines it
d) `@yield` is for layouts, `@section` for views

**Answer:** _____

---

### Q22. How do you define a section with default content?

a) `@section('name', 'default')`
b) `@yield('name', 'default')`
c) `@section('name') default @show`
d) Both b and c

**Answer:** _____

---

### Q23. What does `@parent` do in a section?

a) Includes parent view
b) Shows parent section content
c) Extends parent layout
d) Deletes section

**Answer:** _____

---

### Q24. How do you add CSRF token to a form?

a) `{{ csrf_token() }}`
b) `@csrf`
c) `<input type="hidden" name="_token" value="{{ csrf_token() }}">`
d) All of the above

**Answer:** _____

---

### Q25. What does `@method('PUT')` do?

a) Sets form method to PUT
b) Spoofs HTTP method
c) Validates method
d) Both a and b

**Answer:** _____

---

### Q26. How do you check for validation errors in Blade?

a) `@error('field')`
b) `{{ $errors->has('field') }}`
c) `@if($errors->has('field'))`
d) All of the above

**Answer:** _____

---

### Q27. What does `old('name')` do?

a) Gets old data from database
b) Retrieves previous input after validation failure
c) Gets user's age
d) Returns null

**Answer:** _____

---

### Q28. How do you display session flash messages?

a) `@if(session('key')) {{ session('key') }} @endif`
b) `{{ session('key') }}`
c) `@session('key') {{ $value }} @endsession`
d) All of the above

**Answer:** _____

---

### Q29. What does `@auth` directive check?

a) If user is authenticated
b) If user is admin
c) If user exists
d) If session exists

**Answer:** _____

---

### Q30. How do you check if user is a guest?

a) `@guest`
b) `@if(!auth()->check())`
c) Both a and b
d) `@notauth`

**Answer:** _____

---

### Q31. What does `@can('update', $post)` do?

a) Checks authorization
b) Updates the post
c) Checks if post exists
d) Validates post

**Answer:** _____

---

### Q32. How do you create a Blade component?

a) `php artisan make:component Name`
b) `php artisan create:component Name`
c) `php artisan new:component Name`
d) `php artisan component:make Name`

**Answer:** _____

---

### Q33. How do you use a Blade component?

a) `<x-component-name />`
b) `@component('component-name')`
c) `{{ component('name') }}`
d) `<component name="name" />`

**Answer:** _____

---

### Q34. What does `@props` do in components?

a) Defines component properties
b) Displays properties
c) Validates properties
d) Deletes properties

**Answer:** _____

---

### Q35. How do you pass data to a component?

a) `<x-alert type="success" />`
b) `<x-alert :message="$msg" />`
c) Both a and b
d) Components can't receive data

**Answer:** _____

---

# Section B: True or False (20 Questions)

---

### Q36. Blade templates have `.blade.php` extension.

**Answer:** _____

---

### Q37. `{{ $var }}` automatically escapes HTML.

**Answer:** _____

---

### Q38. `{!! $var !!}` escapes HTML entities.

**Answer:** _____

---

### Q39. Blade comments `{{-- --}}` appear in rendered HTML.

**Answer:** _____

---

### Q40. You can use PHP code in Blade templates.

**Answer:** _____

---

### Q41. `@if` and `@endif` are required pairs.

**Answer:** _____

---

### Q42. `@foreach` loops must always have `@endforeach`.

**Answer:** _____

---

### Q43. `$loop` variable is available in all @foreach loops.

**Answer:** _____

---

### Q44. `@include` can pass data to the included view.

**Answer:** _____

---

### Q45. `@extends` must be the first line in a child template.

**Answer:** _____

---

### Q46. `@yield` and `@section` serve the same purpose.

**Answer:** _____

---

### Q47. `@parent` includes the parent section's content.

**Answer:** _____

---

### Q48. `@csrf` adds CSRF token to forms.

**Answer:** _____

---

### Q49. `old()` helper retrieves previous input values.

**Answer:** _____

---

### Q50. `@auth` checks if user is authenticated.

**Answer:** _____

---

### Q51. Blade compiles to plain PHP and caches it.

**Answer:** _____

---

### Q52. You can create custom Blade directives.

**Answer:** _____

---

### Q53. Components are reusable Blade elements.

**Answer:** _____

---

### Q54. `@props` is used only in Blade components.

**Answer:** _____

---

### Q55. Blade automatically re-compiles when templates change.

**Answer:** _____

---

# Section C: Fill in the Blanks (10 Questions)

---

### Q56. To echo a variable with HTML escaping, use `__________ $var __________`.

**Answer:** __________________

---

### Q57. To echo unescaped HTML, use `__________ $html __________`.

**Answer:** __________________

---

### Q58. Blade comments are written as `__________  comment __________`.

**Answer:** __________________

---

### Q59. A foreach loop starts with `__________($items as $item)` and ends with `__________`.

**Answer:** __________________

---

### Q60. To include a view, use `__________('view.name')`.

**Answer:** __________________

---

### Q61. Child templates use `__________('layout')` to extend a layout.

**Answer:** __________________

---

### Q62. In layouts, use `__________('section-name')` to display section content.

**Answer:** __________________

---

### Q63. The CSRF directive is `__________`.

**Answer:** __________________

---

### Q64. To check if user is authenticated, use `__________`.

**Answer:** __________________

---

### Q65. Blade components are used with `<x-__________ />` syntax.

**Answer:** __________________

---

# Section D: Code Output (15 Questions)

**Instructions:** What will be displayed?

---

### Q66. What's the output?

```blade
@php
    $name = "Laravel";
@endphp
{{ $name }}
```

**Output:** __________________

---

### Q67. What's the output?

```blade
@php
    $count = 5;
@endphp
@if($count > 3)
    Many
@else
    Few
@endif
```

**Output:** __________________

---

### Q68. What's the output?

```blade
@php
    $items = ['A', 'B', 'C'];
@endphp
@foreach($items as $item)
    {{ $item }}
@endforeach
```

**Output:** __________________

---

### Q69. What's the output?

```blade
@php
    $user = null;
@endphp
@isset($user)
    User exists
@else
    No user
@endisset
```

**Output:** __________________

---

### Q70. What's the output?

```blade
@php
    $value = "<script>alert('XSS')</script>";
@endphp
{{ $value }}
```

a) Executes the script
b) Displays escaped HTML tags
c) Error
d) Nothing

**Answer:** _____

---

### Q71. What's the output?

```blade
@php
    $html = "<b>Bold</b>";
@endphp
{!! $html !!}
```

**Output (rendered):** __________________

---

### Q72. What's the output?

```blade
@foreach(['a', 'b', 'c'] as $letter)
    @if($loop->first)
        First: {{ $letter }}
    @endif
@endforeach
```

**Output:** __________________

---

### Q73. What's the output?

```blade
@php
    $age = 15;
@endphp
@unless($age >= 18)
    Minor
@endunless
```

**Output:** __________________

---

### Q74. What's the output for the 3rd iteration?

```blade
@foreach(range(1, 5) as $num)
    {{ $loop->iteration }}: {{ $num }}
@endforeach
```

**3rd iteration output:** __________________

---

### Q75. What's the output?

```blade
@php
    $items = [];
@endphp
@forelse($items as $item)
    {{ $item }}
@empty
    No items
@endforelse
```

**Output:** __________________

---

### Q76. What's the output?

```blade
{{-- This is a comment --}}
Hello World
```

**Output:** __________________

---

### Q77. What displays in browser?

```blade
<!-- HTML comment -->
{{ "Hello" }}
```

**Browser output:** __________________
**View source shows:** __________________

---

### Q78. What's the output?

```blade
@auth
    Logged In
@else
    Guest
@endauth
{{-- Assume user is authenticated --}}
```

**Output:** __________________

---

### Q79. What's the output?

```blade
@php
    $user = (object)['name' => 'John'];
@endphp
{{ $user->name ?? 'Guest' }}
```

**Output:** __________________

---

### Q80. What's the output?

```blade
@for($i = 1; $i <= 3; $i++)
    {{ $i }}
@endfor
```

**Output:** __________________

---

# Section E: Find the Bug (10 Questions)

---

### Q81. Find the bug:

```blade
@if($user->isAdmin)
    Admin Panel
// Missing @endif
```

a) Missing `@endif`
b) Should use parentheses
c) Wrong syntax
d) No bug

**Answer:** _____

---

### Q82. Find the bug:

```blade
@foreach($users as $user)
    {{ $user->name }}
@end
```

a) Should be `@endforeach` not `@end`
b) Missing parentheses
c) Wrong variable
d) No bug

**Answer:** _____

---

### Q83. Find the bug:

```blade
@extends('layout')

<h1>Page Title</h1>

@section('content')
    Page content here
@endsection
```

a) Content outside @section will be lost
b) @extends must be first
c) Both a and b
d) No bug

**Answer:** _____

---

### Q84. Find the bug:

```blade
{{-- Show user name --}}
{{ $username }}
{{-- Variable is actually $user->name --}}
```

a) Variable name mismatch
b) Comment syntax wrong
c) Missing @php
d) No bug

**Answer:** _____

---

### Q85. Find the bug:

```blade
@include('partials.header', ['title' => 'Home'])

{{-- In partials/header.blade.php --}}
<h1>{{ $title }}</h1>
{{-- But $title is not defined in parent view --}}
```

a) Actually no bug - include receives $title from array
b) $title not defined
c) Wrong syntax
d) Missing @section

**Answer:** _____

---

### Q86. Find the bug:

```blade
<form method="POST">
    {{-- Missing CSRF token! --}}
    <input type="text" name="email">
    <button>Submit</button>
</form>
```

a) Missing `@csrf`
b) Missing action
c) Wrong method
d) No bug

**Answer:** _____

---

### Q87. Find the bug:

```blade
{!! $userInput !!}
{{-- $userInput comes from user submission --}}
```

a) XSS vulnerability - should escape user input
b) Wrong syntax
c) Missing validation
d) No bug

**Answer:** _____

---

### Q88. Find the bug:

```blade
<input type="text" name="name" value="{{ old(name) }}">
{{-- Missing quotes around 'name' --}}
```

a) Should be `old('name')` with quotes
b) old() doesn't exist
c) Wrong attribute
d) No bug

**Answer:** _____

---

### Q89. Find the bug:

```blade
@if($errors->has('email'))
    {{ $errors->first('email')) }}
    {{-- Extra closing parenthesis --}}
@endif
```

a) Extra `)` - should be `$errors->first('email')`
b) Wrong method
c) Missing @error
d) No bug

**Answer:** _____

---

### Q90. Find the bug:

```blade
@yield('title', 'Default Title')

{{-- In child view: --}}
@section('title', 'Page Title')
{{-- This won't work as expected! --}}
```

a) `@section` with inline value needs `@endsection` not comma
b) Can't override @yield
c) Wrong syntax
d) No bug

**Answer:** _____

---

# Section F: Code Writing (10 Questions)

**Instructions:** Write the complete Blade code.

---

### Q91. Write Blade code to display "Welcome, {name}" where {name} comes from $user->name variable. If user is null, show "Welcome, Guest".

```blade






```

---

### Q92. Write a foreach loop that displays all $posts. Each post should show its title and author.

```blade









```

---

### Q93. Create a master layout with:
- Title section
- Content section
- Sidebar section with default text "Default Sidebar"

```blade












```

---

### Q94. Create a child view that extends the above layout and:
- Sets title to "Home Page"
- Adds content "Welcome to our site"
- Keeps default sidebar

```blade










```

---

### Q95. Write Blade code to display validation error for 'email' field in red color.

```blade






```

---

### Q96. Create a form that:
- Posts to '/users'
- Includes CSRF token
- Has input for 'name' with old value
- Has submit button

```blade










```

---

### Q97. Write Blade code that shows:
- "Admin Dashboard" if user is authenticated AND is admin
- "User Dashboard" if user is authenticated but not admin
- "Please Login" if not authenticated

```blade











```

---

### Q98. Create a Blade component usage that:
- Uses component called 'alert'
- Passes type as 'success'
- Passes message "Data saved successfully"

```blade




```

---

### Q99. Write code to loop through $products and show:
- "First Product" for first item
- "Last Product" for last item
- Product name for other items

```blade











```

---

### Q100. Create an include statement that:
- Includes 'partials.user-card'
- Passes $user and $showEmail = true

```blade



```

---

## End of Exam / نهاية الاختبار

**Total Questions:** 100
**Your Score:** ____ / 100

---

## Grading Scale / سلم التقييم

- **90-100:** A+ (ممتاز)
- **80-89:** A (ممتاز -)
- **70-79:** B (جيد جداً)
- **60-69:** C (جيد)
- **50-59:** D (مقبول)
- **Below 50:** F (راسب)

---

**Good Luck! / بالتوفيق!** 🚀

**Instructor Signature:** ___________________
**Date Graded:** ___________________
**Final Score:** ___________________
