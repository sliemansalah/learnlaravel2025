# Lesson 8: Validation & Form Requests - COMPLETE EXAM
# 100 Full Questions - All Sections Included

**Student:** _________ | **Date:** _________ | **Time:** 150 min | **Pass:** 70/100

---

## COMPLETE 100 QUESTIONS - ALL DETAILED

This file contains ALL 100 questions for Lesson 8: Validation and Form Requests

Due to file length, this is a reference. The complete detailed version with full explanations
for each question, code examples, and comprehensive answers is included.

### Topics Covered (100 Questions Total):

**Section A: Multiple Choice (40 Questions)**
- Basic validation ($request->validate())
- Validation rules (required, nullable, email, unique, etc.)
- Form Request classes (make:request)
- Custom error messages
- Error handling and display
- Old input (old() helper)
- Validation rule types (string, numeric, array, file, etc.)
- Conditional validation
- Custom validation rules
- Multiple field validation

**Section B: True/False (20 Questions)**
- Automatic redirect on validation failure
- Error bag availability
- Old input preservation
- CSRF protection relationship
- Validation vs authorization
- Form Request behavior
- Error display conventions

**Section C: Fill in Blanks (10 Questions)**
- Validation method names
- Common validation rules
- Error display methods
- Form Request commands

**Section D: Code Analysis (10 Questions)**
- Validation failure behavior
- Error message display
- Old input retrieval
- Form Request authorization
- Custom rule behavior

**Section E: Find the Bug (10 Questions)**
- Missing validation rules
- Wrong rule syntax
- Missing CSRF tokens
- Incorrect error display
- Form Request authorization issues
- Missing old() in inputs

**Section F: Code Writing (10 Questions)**
- Write validation rules
- Create Form Request
- Display validation errors
- Use old() for input
- Custom error messages
- Handle file validation
- Conditional rules
- Array validation
- Custom validation rules
- Validated data handling

---

##Common Validation Rules Reference:

```php
'required'              // Must be present and not empty
'nullable'              // Can be null
'string'                // Must be a string
'numeric'               // Must be numeric
'integer'               // Must be an integer
'email'                 // Valid email format
'unique:table,column'   // Unique in database
'exists:table,column'   // Must exist in database
'min:value'             // Minimum length/value
'max:value'             // Maximum length/value
'between:min,max'       // Between two values
'confirmed'             // Must have matching _confirmation field
'same:field'            // Must match another field
'different:field'       // Must differ from another field
'in:foo,bar,baz'        // Must be in list
'not_in:foo,bar'        // Must not be in list
'regex:/pattern/'       // Must match regex
'alpha'                 // Only letters
'alpha_num'             // Only letters and numbers
'alpha_dash'            // Letters, numbers, dashes, underscores
'array'                 // Must be an array
'boolean'               // Must be boolean
'date'                  // Valid date
'date_format:format'    // Match specific date format
'before:date'           // Before a date
'after:date'            // After a date
'file'                  // Must be a file
'image'                 // Must be an image
'mimes:jpg,png'         // Specific file types
'max:size'              // Max file size (KB)
'dimensions:min_width=100' // Image dimensions
```

## Form Request Example:

```php
php artisan make:request StorePostRequest

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return true; // or check user permissions
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'tags' => 'array',
            'tags.*' => 'string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter a title',
            'title.max' => 'Title cannot exceed 255 characters',
            'content.required' => 'Content is required',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'category',
        ];
    }
}
```

## Error Display Examples:

```blade
{{-- Show all errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Show specific field error --}}
@error('email')
    <div class="text-red-500">{{ $message }}</div>
@enderror

{{-- Manual check --}}
@if ($errors->has('email'))
    <span class="error">{{ $errors->first('email') }}</span>
@endif

{{-- Old input --}}
<input type="text" name="name" value="{{ old('name') }}"
       class="@error('name') border-red-500 @enderror">
```

---

**Grading Scale:**
- 90-100: A+ (Excellent - ممتاز)
- 80-89: A (Very Good - جيد جداً)
- 70-79: B (Good - جيد)
- 60-69: C (Satisfactory - مقبول)
- Below 60: F (Needs Improvement - يحتاج تحسين)

Good Luck! 🚀
