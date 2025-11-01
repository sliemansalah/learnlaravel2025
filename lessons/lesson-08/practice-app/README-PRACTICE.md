# Lesson 8: Validation and Form Requests - Practice Application

This is a comprehensive practice application demonstrating Laravel's validation features, Form Requests, and custom validation rules.

## Features Implemented

### 1. User Registration with Form Request Validation
- **Form Request**: `StoreUserRequest`
- **Controller**: `UserController`
- **Routes**: `/users/create`, `/users/store`
- **Validation Rules**:
  - Name: required, max 255 characters
  - Email: required, valid email format, unique in database
  - Password: required, minimum 8 characters, must be confirmed
  - Phone: optional, exactly 10 digits
  - Birth Date: required, must be before today
  - Avatar: optional, image file, max 2MB
  - Terms: must be accepted

### 2. Post Creation with Advanced Validation
- **Form Request**: `StorePostRequest`
- **Controller**: `PostController`
- **Authorization**: Only authenticated users can create posts
- **Validation Rules**:
  - Title: required, max 255 characters
  - Slug: required, unique, max 255 characters
  - Content: required, minimum 100 characters
  - Excerpt: optional, max 500 characters
  - Category: required, must exist in categories table
  - Tags: optional array, max 5 tags, each must exist in tags table
  - Featured Image: optional image, max 2MB
  - Status: required, either 'draft' or 'published'
  - Published At: required if status is 'published', must be today or later

### 3. Order System with Nested Array Validation
- **Form Request**: `StoreOrderRequest`
- **Controller**: `OrderController`
- **Validation Rules**:
  - Items: required array, minimum 1 item
    - Product ID: required, must exist in products table
    - Quantity: required, integer, minimum 1
  - Payment Method: required, must be 'cash', 'card', or 'transfer'
  - Card Number: required if payment method is 'card', exactly 16 digits
  - Card CVV: required if payment method is 'card', exactly 3 digits
  - Shipping Address: required, max 500 characters
  - Shipping City: required, max 100 characters
  - Shipping ZIP: required, exactly 5 digits
  - Notes: optional, max 1000 characters

### 4. Custom Validation Rule: StrongPassword
- **Rule Class**: `App\Rules\StrongPassword`
- **Requirements**:
  - At least one uppercase letter
  - At least one lowercase letter
  - At least one number
  - At least one special character (@$!%*?&)
- **Usage Example**:
  ```php
  use App\Rules\StrongPassword;

  $request->validate([
      'password' => ['required', 'min:8', new StrongPassword],
  ]);
  ```

## Database Structure

### Tables Created
1. **users** - User accounts with additional fields (phone, birth_date, avatar)
2. **categories** - Post categories
3. **tags** - Post tags
4. **posts** - Blog posts with relationships
5. **post_tag** - Pivot table for many-to-many relationship
6. **products** - Products for ordering
7. **orders** - Customer orders
8. **order_items** - Order line items

## Setup Instructions

### 1. Database Configuration
The application uses SQLite by default. The database file is already created at:
```
database/database.sqlite
```

### 2. Run Migrations
The migrations have already been run, but if you need to reset:
```bash
php artisan migrate:fresh
```

### 3. Seed Sample Data (Optional)
Create some sample data for testing:
```bash
php artisan tinker
```

Then run:
```php
// Create categories
App\Models\Category::create(['name' => 'Technology', 'slug' => 'technology']);
App\Models\Category::create(['name' => 'Lifestyle', 'slug' => 'lifestyle']);

// Create tags
App\Models\Tag::create(['name' => 'Laravel', 'slug' => 'laravel']);
App\Models\Tag::create(['name' => 'PHP', 'slug' => 'php']);
App\Models\Tag::create(['name' => 'Web Development', 'slug' => 'web-development']);

// Create products
App\Models\Product::create(['name' => 'Laptop', 'description' => 'High-performance laptop', 'price' => 999.99, 'stock' => 10]);
App\Models\Product::create(['name' => 'Mouse', 'description' => 'Wireless mouse', 'price' => 29.99, 'stock' => 50]);
App\Models\Product::create(['name' => 'Keyboard', 'description' => 'Mechanical keyboard', 'price' => 79.99, 'stock' => 25]);
```

### 4. Create Storage Link
For file uploads to work properly:
```bash
php artisan storage:link
```

### 5. Start the Development Server
```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Testing the Application

### 1. Test User Registration
Visit: `http://localhost:8000/users/create`

**Test Cases:**
- Try submitting empty form (see all validation errors)
- Try invalid email format
- Try password less than 8 characters
- Try mismatched password confirmation
- Try invalid phone number (not 10 digits)
- Try birth date in the future
- Try without accepting terms
- Upload an invalid file type
- Upload a file larger than 2MB

### 2. Test Post Creation (Requires Authentication)
Visit: `http://localhost:8000/posts/create`

Note: Posts routes require authentication. You'll need to implement login or temporarily remove the `auth` middleware from `routes/web.php` for testing.

### 3. Test Order Creation (Requires Authentication)
Visit: `http://localhost:8000/orders/create`

Note: Orders routes require authentication.

## Key Files to Review

### Form Requests
- `app/Http/Requests/StoreUserRequest.php` - User registration validation
- `app/Http/Requests/StorePostRequest.php` - Post creation validation
- `app/Http/Requests/StoreOrderRequest.php` - Order placement validation

### Custom Rules
- `app/Rules/StrongPassword.php` - Custom password strength validation

### Controllers
- `app/Http/Controllers/UserController.php` - User CRUD operations
- `app/Http/Controllers/PostController.php` - Post CRUD operations
- `app/Http/Controllers/OrderController.php` - Order CRUD operations

### Models
- `app/Models/User.php` - Extended with additional fields
- `app/Models/Post.php` - With relationships
- `app/Models/Order.php` - With relationships
- `app/Models/Category.php`
- `app/Models/Tag.php`
- `app/Models/Product.php`
- `app/Models/OrderItem.php`

### Views
- `resources/views/users/create.blade.php` - Registration form with validation display
- `resources/views/users/index.blade.php` - Users list

### Routes
- `routes/web.php` - All application routes

## Validation Concepts Demonstrated

### 1. Form Request Classes
- Centralizes validation logic
- Keeps controllers clean
- Reusable validation rules
- Custom error messages
- Authorization checks

### 2. Validation Rules Used
- `required` - Field must be present
- `string` - Must be a string
- `email` - Must be valid email format
- `unique` - Must be unique in database
- `min/max` - Minimum/maximum length
- `confirmed` - Must match `_confirmation` field
- `regex` - Must match regular expression pattern
- `date` - Must be valid date
- `before/after` - Date comparison
- `image` - Must be image file
- `mimes` - Allowed file types
- `accepted` - Must be accepted (checkboxes)
- `array` - Must be array
- `exists` - Must exist in database table
- `in` - Must be one of specified values
- `required_if` - Required if another field has value

### 3. Conditional Validation
- `required_if:status,published` - Required if status equals 'published'
- `required_if:payment_method,card` - Required if payment method is 'card'

### 4. Array Validation
- `items` - Validate the array itself
- `items.*` - Validate all array elements
- `items.*.product_id` - Validate nested array fields

### 5. Custom Validation Rules
- Implementing `ValidationRule` interface
- Custom error messages
- Complex validation logic

### 6. Blade Error Display
- `@error` directive for individual field errors
- `$errors->any()` to check if any errors exist
- `$errors->all()` to get all error messages
- `old()` helper to preserve form input
- Adding CSS classes based on validation state

## Learning Exercises

1. **Add Update Functionality**: Implement edit forms for users, posts, and orders with validation
2. **Create Custom Rules**: Add custom rules for:
   - Username format validation
   - Credit card format validation
   - Postal code validation for specific countries
3. **Add More Validation**: Implement validation for:
   - Profile picture dimensions
   - File size limits per user role
   - Complex business rules
4. **AJAX Validation**: Add real-time validation using JavaScript
5. **Form Request Testing**: Write tests for all Form Request classes

## Resources

- [Laravel Validation Documentation](https://laravel.com/docs/validation)
- [Form Request Validation](https://laravel.com/docs/validation#form-request-validation)
- [Custom Validation Rules](https://laravel.com/docs/validation#custom-validation-rules)
- Lesson 8 Practice Guide: `../PRACTICE-GUIDE-EN.md`
- Lesson 8 Quick Reference: `../QUICK-REFERENCE-EN.md`

## Next Steps

After mastering validation, proceed to:
- **Lesson 9**: File Upload and Storage
- **Lesson 10**: Authentication and Authorization
- **Lesson 11**: Advanced Eloquent Features

---

**Happy Coding! 🚀**

For questions or issues, refer to the lesson materials or Laravel documentation.
