# Lesson 8: Validation and Form Requests - Full Exam
# الدرس الثامن: التحقق من الصحة وطلبات النماذج - الاختبار الكامل

**Student Name:** _________________ | **Date:** _________
**Time Limit:** 150 minutes | **Passing Score:** 70/100

---

## Section A: Multiple Choice (40 Questions)

**Instructions:** Choose the correct answer for each question.

### Q1. What method validates a request in a controller?
a) `$request->validate()`
b) `$request->check()`
c) `validate($request)`
d) `Validator::check()`

**Answer:** _____

### Q2. What happens when validation fails?
a) Exception is thrown
b) User is redirected back with errors
c) 500 error
d) Execution continues

**Answer:** _____

### Q3. Where are validation errors stored after redirect?
a) Database
b) Session (flash data)
c) Cookies
d) Local storage

**Answer:** _____

### Q4. What variable contains validation errors in Blade?
a) `$errors`
b) `$validation`
c) `$messages`
d) `$fails`

**Answer:** _____

### Q5. What does the `required` rule do?
a) Makes field optional
b) Ensures field is present and not empty
c) Checks if field is numeric
d) Validates email format

**Answer:** _____

### Q6. What does the `nullable` rule do?
a) Field must be present
b) Field can be absent or null
c) Field must be empty
d) Field is required

**Answer:** _____

### Q7. What rule validates email format?
a) `email`
b) `mail`
c) `valid_email`
d) `email_format`

**Answer:** _____

### Q8. How do you check if email is unique in users table?
a) `unique:users,email`
b) `email:unique`
c) `check:unique`
d) `exists:users,email`

**Answer:** _____

### Q9. What does `exists:categories,id` validate?
a) Category doesn't exist
b) Category exists in categories table
c) Category is unique
d) Category is required

**Answer:** _____

### Q10. What does `min:3` do for strings?
a) Maximum 3 characters
b) Minimum 3 characters
c) Exactly 3 characters
d) Between 1-3 characters

**Answer:** _____

### Q11. What does `max:255` do for strings?
a) Minimum 255 characters
b) Maximum 255 characters
c) Exactly 255 characters
d) More than 255

**Answer:** _____

### Q12. What does `between:1,10` validate?
a) Value is exactly 1 or 10
b) Value is between 1 and 10 (inclusive)
c) Value is outside range
d) Value is less than 1

**Answer:** _____

### Q13. What does the `confirmed` rule require?
a) Field is true
b) Matching field with `_confirmation` suffix
c) Field is checked
d) Field is unique

**Answer:** _____

### Q14. For `password` with `confirmed` rule, what field is expected?
a) `password_check`
b) `password_confirmation`
c) `password_verify`
d) `confirm_password`

**Answer:** _____

### Q15. What does `same:password` validate?
a) Field is different from password
b) Field matches the password field
c) Field is the same value
d) Field is unique

**Answer:** _____

### Q16. What does `different:username` validate?
a) Field matches username
b) Field is different from username field
c) Field is unique
d) Field is required

**Answer:** _____

### Q17. What does `in:admin,user,guest` validate?
a) Value is not in list
b) Value is one of: admin, user, or guest
c) Value contains all items
d) Value is unique

**Answer:** _____

### Q18. What does `not_in:banned,blocked` validate?
a) Value is in list
b) Value is not in list
c) Value is required
d) Value is unique

**Answer:** _____

### Q19. What rule validates only letters?
a) `alpha`
b) `letters`
c) `string`
d) `text`

**Answer:** _____

### Q20. What rule validates letters and numbers only?
a) `alpha`
b) `numeric`
c) `alpha_num`
d) `alphanumeric`

**Answer:** _____

### Q21. What rule validates letters, numbers, dashes, and underscores?
a) `alpha`
b) `alpha_dash`
c) `string`
d) `alpha_num`

**Answer:** _____

### Q22. What rule validates that field is an array?
a) `array`
b) `is_array`
c) `list`
d) `collection`

**Answer:** _____

### Q23. What rule validates boolean values?
a) `bool`
b) `boolean`
c) `true_false`
d) `binary`

**Answer:** _____

### Q24. What rule validates a date?
a) `date`
b) `datetime`
c) `timestamp`
d) `time`

**Answer:** _____

### Q25. What does `before:2024-12-31` validate?
a) Date is after 2024-12-31
b) Date is before 2024-12-31
c) Date is exactly 2024-12-31
d) Date is in 2024

**Answer:** _____

### Q26. What does `after:today` validate?
a) Date is before today
b) Date is after today
c) Date is today
d) Date is valid

**Answer:** _____

### Q27. What rule validates uploaded files?
a) `file`
b) `upload`
c) `attachment`
d) `document`

**Answer:** _____

### Q28. What rule validates image files?
a) `file`
b) `image`
c) `picture`
d) `photo`

**Answer:** _____

### Q29. What does `mimes:pdf,doc,docx` validate?
a) File size
b) File type (extension)
c) File name
d) File count

**Answer:** _____

### Q30. What does `max:2048` mean for files?
a) Maximum 2048 bytes
b) Maximum 2048 KB (2 MB)
c) Maximum 2048 MB
d) Maximum 2048 files

**Answer:** _____

### Q31. How do you create a Form Request?
a) `php artisan make:request StorePostRequest`
b) `php artisan create:request StorePost`
c) `php artisan request:make StorePost`
d) `php artisan new:request StorePost`

**Answer:** _____

### Q32. What method in Form Request defines validation rules?
a) `validate()`
b) `rules()`
c) `check()`
d) `validation()`

**Answer:** _____

### Q33. What method in Form Request checks authorization?
a) `auth()`
b) `authorize()`
c) `check()`
d) `permission()`

**Answer:** _____

### Q34. What should `authorize()` return to allow the request?
a) `false`
b) `true`
c) `null`
d) `'authorized'`

**Answer:** _____

### Q35. What method defines custom error messages in Form Request?
a) `errors()`
b) `messages()`
c) `customMessages()`
d) `errorMessages()`

**Answer:** _____

### Q36. How do you display all validation errors in Blade?
a) `$errors->all()`
b) `$errors->get()`
c) `$errors->list()`
d) `$errors->show()`

**Answer:** _____

### Q37. How do you check if a specific field has an error?
a) `$errors->check('email')`
b) `$errors->has('email')`
c) `$errors->exists('email')`
d) `$errors->find('email')`

**Answer:** _____

### Q38. How do you get the first error message for a field?
a) `$errors->get('email')`
b) `$errors->first('email')`
c) `$errors->message('email')`
d) `$errors->show('email')`

**Answer:** _____

### Q39. What Blade directive displays field-specific errors?
a) `@errors('email')`
b) `@error('email')`
c) `@validation('email')`
d) `@fail('email')`

**Answer:** _____

### Q40. What does `old('name')` do?
a) Gets old database value
b) Returns previous input value after validation failure
c) Gets user's name
d) Returns null always

**Answer:** _____

---

## Section B: True/False (20 Questions)

**Instructions:** Write **T** for True or **F** for False.

### Q41. When validation fails, Laravel automatically redirects back.
**Answer:** _____

### Q42. `$errors` variable is automatically available in all Blade views.
**Answer:** _____

### Q43. `old()` helper retrieves previous input after validation failure.
**Answer:** _____

### Q44. `required` and `nullable` can be used together on the same field.
**Answer:** _____

### Q45. `unique:users,email` checks if email is unique in users table.
**Answer:** _____

### Q46. `confirmed` rule requires a matching field with `_confirmation` suffix.
**Answer:** _____

### Q47. `min:5` for strings means minimum 5 characters.
**Answer:** _____

### Q48. `max:2048` for files means maximum 2048 MB.
**Answer:** _____

### Q49. `alpha` rule allows numbers.
**Answer:** _____

### Q50. `alpha_num` rule allows letters and numbers only.
**Answer:** _____

### Q51. Form Requests are created with `php artisan make:request`.
**Answer:** _____

### Q52. `authorize()` method in Form Request controls who can make the request.
**Answer:** _____

### Q53. `rules()` method returns an array of validation rules.
**Answer:** _____

### Q54. `@error` directive displays errors for a specific field.
**Answer:** _____

### Q55. `$errors->has('email')` checks if email field has errors.
**Answer:** _____

### Q56. Validation errors are stored in the database.
**Answer:** _____

### Q57. `exists:categories,id` checks if the value exists in categories table.
**Answer:** _____

### Q58. You can define custom error messages in Form Requests.
**Answer:** _____

### Q59. `in:admin,user` validates that value is one of the listed options.
**Answer:** _____

### Q60. CSRF protection is separate from validation.
**Answer:** _____

---

## Section C: Fill in the Blanks (10 Questions)

**Instructions:** Fill in the missing parts.

### Q61. To validate a request: `$request->______([ 'email' => 'required|email' ]);`
**Answer:** _____________________

### Q62. To make a field optional: `'field' => '______'`
**Answer:** _____________________

### Q63. To check if email is unique: `'email' => 'unique:______,email'`
**Answer:** _____________________

### Q64. To require minimum 8 characters: `'password' => 'required|______:8'`
**Answer:** _____________________

### Q65. To require password confirmation: `'password' => 'required|______'`
**Answer:** _____________________

### Q66. To check if field has errors: `$errors->______('email')`
**Answer:** _____________________

### Q67. To get first error message: `$errors->______('email')`
**Answer:** _____________________

### Q68. To display old input: `<input value="{{ ______('name') }}">`
**Answer:** _____________________

### Q69. To create Form Request: `php artisan ______:request StorePostRequest`
**Answer:** _____________________

### Q70. In Form Request, validation rules are defined in `______()` method.
**Answer:** _____________________

---

## Section D: Code Analysis (10 Questions)

**Instructions:** Analyze the code and answer the questions.

### Q71. What happens when this validation fails?

```php
$request->validate([
    'email' => 'required|email',
    'password' => 'required|min:8',
]);
```

a) Exception thrown
b) User redirected back with errors in session
c) Page refreshes
d) Error 500

**Answer:** _____

### Q72. What does this validate?

```php
'password' => 'required|confirmed|min:8'
```

a) Password must be unique
b) Password must be at least 8 chars with matching password_confirmation field
c) Password must be exactly 8 characters
d) Password must be confirmed by admin

**Answer:** _____

### Q73. What is the problem with this code?

```php
$validated = $request->validate([...]);
// Validation passed but data not used
return redirect('/dashboard');
```

a) Syntax error
b) Not using validated data (but no error occurs)
c) Missing return statement
d) Wrong redirect

**Answer:** _____

### Q74. What does this return?

```php
$errors->first('email')
```

a) All errors for email
b) First error message for email field
c) True or false
d) Error count

**Answer:** _____

### Q75. What will this display if name has an error?

```blade
@error('name')
    <span>{{ $message }}</span>
@enderror
```

a) Nothing
b) The error message for name field
c) "Error"
d) All errors

**Answer:** _____

### Q76. What does this Form Request do?

```php
public function authorize()
{
    return false;
}
```

a) Allows all requests
b) Denies all requests (403 error)
c) Skips authorization
d) Requires login

**Answer:** _____

### Q77. What does this validate?

```php
'avatar' => 'required|image|mimes:jpg,png|max:2048'
```

a) Avatar is required string
b) Avatar is required image (jpg/png), max 2MB
c) Avatar is optional
d) Avatar must be exactly 2048 KB

**Answer:** _____

### Q78. How many fields are required?

```php
$request->validate([
    'name' => 'required',
    'email' => 'required|email',
    'phone' => 'nullable',
    'age' => 'nullable|numeric',
]);
```

a) 1
b) 2
c) 3
d) 4

**Answer:** _____

### Q79. What does this validate?

```php
'role' => 'required|in:admin,user,guest'
```

a) Role is optional
b) Role must be exactly one of: admin, user, or guest
c) Role can be any value
d) Role must contain all three values

**Answer:** _____

### Q80. What will happen?

```php
// Form Request with authorize() returning false
public function authorize()
{
    return false;
}
```

a) Validation runs normally
b) 403 Forbidden error before validation
c) 404 error
d) Validation skipped but continues

**Answer:** _____

---

## Section E: Find the Bug (10 Questions)

**Instructions:** Find and explain the bug in each code snippet.

### Q81. Find the bug:

```php
$request->validate([
    'email' => 'required|email|unique',
]);
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q82. Find the bug:

```php
$request->validate([
    'password' => 'required|min:8|confirmed',
]);
// Form only has 'password' field, missing confirmation
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q83. Find the bug:

```blade
<form method="POST" action="/store">
    <input type="email" name="email">
    <button>Submit</button>
</form>
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q84. Find the bug:

```blade
@if ($errors->any())
    <div>{{ $errors->first() }}</div>
@endif
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q85. Find the bug:

```php
// Form Request
public function authorize()
{
    return true;
}

public function validate()
{
    return [
        'name' => 'required',
    ];
}
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q86. Find the bug:

```blade
<input type="text" name="name" value="{{ old() }}">
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q87. Find the bug:

```php
$request->validate([
    'age' => 'required|integer|min:18',
]);
// User enters "17" and validation passes
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q88. Find the bug:

```php
$request->validate([
    'tags' => 'required|array',
    'tags' => 'string|max:50',
]);
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q89. Find the bug:

```blade
@error('email')
    <span>Error: {{ $error }}</span>
@enderror
```

**Bug:** _____________________________________

**Fix:** _____________________________________

### Q90. Find the bug:

```php
$request->validate([
    'status' => 'required|in:active, inactive, pending',
]);
// Validation fails for "active"
```

**Bug:** _____________________________________

**Fix:** _____________________________________

---

## Section F: Code Writing (10 Questions)

**Instructions:** Write the required code.

### Q91. Write validation rules for a registration form:
- name: required, string, max 255 characters
- email: required, valid email, unique in users table
- password: required, minimum 8 characters, confirmed
- age: optional, numeric, minimum 18

```php
$request->validate([
    // Write your code here
]);
```

**Your Answer:**
```php

```

---

### Q92. Create a Form Request named `StorePostRequest` with rules:
- title: required, string, max 255
- content: required, string
- category_id: required, exists in categories table

```php
// Command to create:


// StorePostRequest class:
class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        // Your code
    }

    public function rules()
    {
        // Your code
    }
}
```

**Your Answer:**
```php
// Command:


// Class:


```

---

### Q93. Display all validation errors in a Blade template

```blade
{{-- Your code here --}}
```

**Your Answer:**
```blade

```

---

### Q94. Display error for specific field (email) in Blade

```blade
{{-- Your code here --}}
```

**Your Answer:**
```blade

```

---

### Q95. Create an input field with old value and error styling

```blade
{{-- Name input with old value and red border if error --}}
```

**Your Answer:**
```blade

```

---

### Q96. Write validation for file upload:
- avatar: optional, must be image, types: jpg/png, max 2MB

```php
$request->validate([
    // Your code here
]);
```

**Your Answer:**
```php

```

---

### Q97. Write custom error messages in Form Request

```php
class StorePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        // Write custom messages here
    }
}
```

**Your Answer:**
```php

```

---

### Q98. Write validation for array of tags:
- tags: optional, must be array
- each tag: string, max 50 characters

```php
$request->validate([
    // Your code here
]);
```

**Your Answer:**
```php

```

---

### Q99. Write authorization logic in Form Request:
- Only post owner can update

```php
class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        // Write your code here
        // Hint: $this->route('post') gets route parameter
    }
}
```

**Your Answer:**
```php

```

---

### Q100. Write conditional validation:
- If role is "admin", require "department" field

```php
$request->validate([
    'role' => 'required|in:admin,user',
    // Write conditional validation here
]);
```

**Your Answer:**
```php

```

---

## Grading Scale / سلم التقييم

- **90-100:** A+ (Excellent - ممتاز)
- **80-89:** A (Very Good - جيد جداً)
- **70-79:** B (Good - جيد)
- **60-69:** C (Satisfactory - مقبول)
- **Below 60:** F (Needs Improvement - يحتاج تحسين)

---

## Answer Key Summary (For Instructor)

**Section A:** 40 questions × 1 point = 40 points
**Section B:** 20 questions × 1 point = 20 points
**Section C:** 10 questions × 1 point = 10 points
**Section D:** 10 questions × 1 point = 10 points
**Section E:** 10 questions × 1 point = 10 points
**Section F:** 10 questions × 1 point = 10 points

**Total:** 100 points

---

**Good Luck! / بالتوفيق!** 🚀
