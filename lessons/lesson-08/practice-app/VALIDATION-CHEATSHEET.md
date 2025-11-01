# Laravel Validation Cheat Sheet

Quick reference for all validation rules demonstrated in this practice application.

## Table of Contents
1. [Basic Validation Rules](#basic-validation-rules)
2. [String Validation](#string-validation)
3. [Numeric Validation](#numeric-validation)
4. [Date & Time Validation](#date--time-validation)
5. [File Upload Validation](#file-upload-validation)
6. [Array Validation](#array-validation)
7. [Database Validation](#database-validation)
8. [Conditional Validation](#conditional-validation)
9. [Custom Rules](#custom-rules)
10. [Displaying Errors in Blade](#displaying-errors-in-blade)

---

## Basic Validation Rules

### `required`
Field must be present and not empty
```php
'name' => 'required'
```

### `nullable`
Field can be null (opposite of required)
```php
'middle_name' => 'nullable|string'
```

### `sometimes`
Only validate if field is present
```php
'nickname' => 'sometimes|string|max:50'
```

---

## String Validation

### `string`
Must be a string
```php
'title' => 'string'
```

### `min:value`
Minimum length
```php
'content' => 'min:100'  // At least 100 characters
```

### `max:value`
Maximum length
```php
'name' => 'max:255'  // No more than 255 characters
```

### `size:value`
Exact length
```php
'code' => 'size:6'  // Exactly 6 characters
```

### `alpha`
Only letters (a-z, A-Z)
```php
'letters_only' => 'alpha'
```

### `alpha_dash`
Letters, numbers, dashes, underscores
```php
'username' => 'alpha_dash'
```

### `alpha_num`
Only letters and numbers
```php
'code' => 'alpha_num'
```

### `regex:pattern`
Must match regular expression
```php
'phone' => 'regex:/^[0-9]{10}$/'  // Exactly 10 digits
```

---

## Numeric Validation

### `numeric` or `integer`
Must be a number
```php
'age' => 'numeric'
'quantity' => 'integer'
```

### `min:value`
Minimum value for numbers
```php
'quantity' => 'integer|min:1'  // At least 1
```

### `max:value`
Maximum value for numbers
```php
'age' => 'integer|max:120'
```

### `between:min,max`
Value between min and max
```php
'price' => 'numeric|between:0,9999.99'
```

### `digits:value`
Exact number of digits
```php
'pin' => 'digits:4'  // Exactly 4 digits
'card_number' => 'digits:16'  // Exactly 16 digits
```

### `digits_between:min,max`
Number of digits between min and max
```php
'code' => 'digits_between:4,8'
```

---

## Date & Time Validation

### `date`
Must be a valid date
```php
'birth_date' => 'date'
```

### `before:date`
Must be before specified date
```php
'birth_date' => 'before:today'
'start_date' => 'before:2025-12-31'
```

### `after:date`
Must be after specified date
```php
'end_date' => 'after:start_date'
'event_date' => 'after:today'
```

### `before_or_equal:date`
Must be before or equal to date
```php
'deadline' => 'before_or_equal:2025-12-31'
```

### `after_or_equal:date`
Must be after or equal to date
```php
'published_at' => 'after_or_equal:today'
```

### `date_format:format`
Must match specific date format
```php
'custom_date' => 'date_format:Y-m-d H:i:s'
```

---

## File Upload Validation

### `file`
Must be an uploaded file
```php
'document' => 'file'
```

### `image`
Must be an image (jpeg, png, bmp, gif, svg, webp)
```php
'avatar' => 'image'
```

### `mimes:types`
Must have specific MIME types
```php
'avatar' => 'mimes:jpeg,png,jpg'
'document' => 'mimes:pdf,doc,docx'
```

### `mimetypes:types`
Exact MIME type validation
```php
'video' => 'mimetypes:video/avi,video/mpeg'
```

### `max:value` (file size)
Maximum file size in kilobytes
```php
'avatar' => 'max:2048'  // Max 2MB (2048 KB)
'video' => 'max:10240'  // Max 10MB
```

### `dimensions`
Image dimension constraints
```php
'avatar' => 'dimensions:min_width=100,min_height=100'
'banner' => 'dimensions:max_width=1920,max_height=1080'
'photo' => 'dimensions:ratio=3/2'
```

---

## Array Validation

### `array`
Must be an array
```php
'tags' => 'array'
```

### `array:key1,key2`
Array must have specific keys
```php
'user' => 'array:name,email'
```

### `min:value` (array size)
Minimum number of items
```php
'items' => 'array|min:1'  // At least 1 item
```

### `max:value` (array size)
Maximum number of items
```php
'tags' => 'array|max:5'  // No more than 5 items
```

### `*` wildcard
Validate all array elements
```php
'tags.*' => 'string|max:50'
'items.*.product_id' => 'required|exists:products,id'
'items.*.quantity' => 'required|integer|min:1'
```

---

## Database Validation

### `exists:table,column`
Value must exist in database table
```php
'category_id' => 'exists:categories,id'
'email' => 'exists:users,email'
```

With additional constraints:
```php
'email' => 'exists:users,email,deleted_at,NULL'
```

### `unique:table,column`
Value must be unique in database table
```php
'email' => 'unique:users,email'
'slug' => 'unique:posts,slug'
```

Ignore specific ID (for updates):
```php
'email' => 'unique:users,email,' . $user->id
```

With additional constraints:
```php
'email' => 'unique:users,email,NULL,id,role,admin'
```

---

## Conditional Validation

### `required_if:field,value`
Required if another field has specific value
```php
'card_number' => 'required_if:payment_method,card'
'published_at' => 'required_if:status,published'
```

### `required_unless:field,value`
Required unless another field has specific value
```php
'reason' => 'required_unless:approved,true'
```

### `required_with:field1,field2`
Required if any other fields are present
```php
'last_name' => 'required_with:first_name'
```

### `required_with_all:field1,field2`
Required if all other fields are present
```php
'password_confirmation' => 'required_with_all:password'
```

### `required_without:field1,field2`
Required if any other fields are not present
```php
'email' => 'required_without:phone'
```

### `required_without_all:field1,field2`
Required if all other fields are not present
```php
'phone' => 'required_without_all:email,username'
```

### `prohibited_if:field,value`
Must not be present if condition is true
```php
'discount' => 'prohibited_if:type,gift'
```

### `prohibited_unless:field,value`
Must not be present unless condition is true
```php
'notes' => 'prohibited_unless:status,pending'
```

---

## Custom Rules

### Using Rule Objects

**Create a custom rule:**
```bash
php artisan make:rule StrongPassword
```

**Implement the rule:**
```php
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/[A-Z]/', $value)) {
            $fail('Password must contain at least one uppercase letter');
            return;
        }

        if (!preg_match('/[a-z]/', $value)) {
            $fail('Password must contain at least one lowercase letter');
            return;
        }

        if (!preg_match('/[0-9]/', $value)) {
            $fail('Password must contain at least one number');
            return;
        }

        if (!preg_match('/[@$!%*?&]/', $value)) {
            $fail('Password must contain at least one special character');
        }
    }
}
```

**Use the custom rule:**
```php
use App\Rules\StrongPassword;

$request->validate([
    'password' => ['required', 'min:8', new StrongPassword],
]);
```

---

## Displaying Errors in Blade

### Check if any errors exist
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

### Display specific field error
```blade
@error('email')
    <span class="error">{{ $message }}</span>
@enderror
```

### Add CSS class if error exists
```blade
<input
    type="text"
    name="email"
    class="@error('email') is-invalid @enderror"
>
```

### Preserve old input
```blade
<input type="text" name="name" value="{{ old('name') }}">

<textarea name="content">{{ old('content') }}</textarea>

<select name="category">
    <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Category 1</option>
</select>

<input
    type="checkbox"
    name="agree"
    {{ old('agree') ? 'checked' : '' }}
>
```

---

## Form Request Classes

### Create a Form Request
```bash
php artisan make:request StoreUserRequest
```

### Form Request Structure
```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;  // or auth()->check()
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
        ];
    }

    /**
     * Get custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'email' => 'email address',
        ];
    }
}
```

### Use in Controller
```php
public function store(StoreUserRequest $request)
{
    $validated = $request->validated();

    User::create($validated);

    return redirect()->route('users.index');
}
```

---

## Common Validation Combinations

### Email Field
```php
'email' => 'required|email|unique:users,email'
```

### Password Field
```php
'password' => 'required|string|min:8|confirmed'
```

### Phone Number (10 digits)
```php
'phone' => 'nullable|regex:/^[0-9]{10}$/'
```

### ZIP Code (5 digits)
```php
'zip' => 'required|digits:5'
```

### URL Field
```php
'website' => 'nullable|url'
```

### Boolean Field
```php
'agree_terms' => 'required|accepted'
'is_active' => 'boolean'
```

### Checkbox
```php
'agree_terms' => 'required|accepted'  // Must be yes, on, 1, or true
```

### File Upload
```php
'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
```

---

## Quick Tips

1. **Combine multiple rules with pipe (|)**
   ```php
   'name' => 'required|string|max:255'
   ```

2. **Or use array syntax**
   ```php
   'name' => ['required', 'string', 'max:255']
   ```

3. **Chain rules for arrays**
   ```php
   'items' => 'required|array|min:1',
   'items.*.id' => 'required|exists:products,id',
   ```

4. **Use `sometimes` for optional validation**
   ```php
   'nickname' => 'sometimes|required|string'
   ```

5. **Validated data only includes validated fields**
   ```php
   $validated = $request->validated();  // Only validated fields
   $all = $request->all();  // All request data
   ```

6. **Testing validation in PHPUnit**
   ```php
   $response = $this->post('/users', $data);
   $response->assertSessionHasErrors('email');
   ```

---

## Resources

- [Laravel Validation Documentation](https://laravel.com/docs/validation)
- [Available Validation Rules](https://laravel.com/docs/validation#available-validation-rules)
- [Custom Validation Rules](https://laravel.com/docs/validation#custom-validation-rules)
- Practice App: `lessons/lesson-08/practice-app`

---

**Print this cheat sheet for quick reference while coding!** 📄
