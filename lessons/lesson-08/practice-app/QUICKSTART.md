# Quick Start Guide - Lesson 8 Practice App

## Get Started in 3 Steps

### 1. Start the Server
```bash
cd lessons/lesson-08/practice-app
php artisan serve
```

### 2. Open Your Browser
Navigate to: **http://localhost:8000/users/create**

### 3. Test the Validation
Try the user registration form and experiment with validation!

## What's Already Set Up

✅ Database created and migrated
✅ Sample data seeded (categories, tags, products)
✅ Storage link created
✅ Routes configured
✅ Form Requests implemented
✅ Custom validation rules ready

## Quick Test Scenarios

### Test 1: Empty Form Submission
- Click "Register User" without filling anything
- See all validation errors at once

### Test 2: Invalid Email
- Enter name: `John Doe`
- Enter email: `not-an-email`
- See email validation error

### Test 3: Weak Password
- Enter password: `12345`
- See password length validation error

### Test 4: Password Mismatch
- Enter password: `MyPassword123`
- Enter confirmation: `DifferentPassword`
- See password confirmation error

### Test 5: Invalid Phone
- Enter phone: `123` (too short)
- See phone format validation error

### Test 6: Future Birth Date
- Enter birth date: tomorrow's date
- See date validation error

### Test 7: Missing Terms Acceptance
- Fill all fields correctly
- Don't check "agree to terms"
- See terms validation error

### Test 8: Successful Registration
- Fill all required fields correctly
- Check "agree to terms"
- See success message and user in list

## Available Routes

### User Routes (No Authentication Required)
- `GET /users` - List all users
- `GET /users/create` - Registration form
- `POST /users` - Submit registration

### Post Routes (Authentication Required)
- `GET /posts` - List all posts
- `GET /posts/create` - Create post form
- `POST /posts` - Submit post

### Order Routes (Authentication Required)
- `GET /orders` - List all orders
- `GET /orders/create` - Create order form
- `POST /orders` - Submit order

## What You'll Learn

1. **Form Request Validation** - See how `StoreUserRequest` handles validation
2. **Validation Rules** - Multiple rules on single fields
3. **Custom Error Messages** - User-friendly validation messages
4. **Old Input** - Form data persists after validation errors
5. **Error Display** - Using `@error` directive in Blade
6. **Conditional Validation** - Rules that depend on other fields
7. **Array Validation** - Validating arrays and nested data
8. **Custom Rules** - The `StrongPassword` rule implementation

## Files to Explore

**Start Here:**
1. `resources/views/users/create.blade.php` - The registration form
2. `app/Http/Requests/StoreUserRequest.php` - Validation rules
3. `app/Http/Controllers/UserController.php` - Controller logic

**Then Explore:**
4. `app/Http/Requests/StorePostRequest.php` - Advanced validation
5. `app/Http/Requests/StoreOrderRequest.php` - Array validation
6. `app/Rules/StrongPassword.php` - Custom validation rule

## Troubleshooting

**Problem:** "Page not found" error
**Solution:** Make sure the server is running with `php artisan serve`

**Problem:** "Database file not found"
**Solution:** Run `php artisan migrate:fresh --seed`

**Problem:** "Class not found" error
**Solution:** Run `composer dump-autoload`

**Problem:** Avatar upload fails
**Solution:** Make sure storage link exists: `php artisan storage:link`

## Next Steps

1. Try registering multiple users
2. Examine the validation errors for each field
3. Look at the code in `StoreUserRequest.php`
4. Try modifying validation rules
5. Create your own custom validation rule

## Need More Info?

📖 Read the full documentation in `README-PRACTICE.md`
📚 Review Lesson 8 materials in parent directory
🌐 Visit [Laravel Validation Docs](https://laravel.com/docs/validation)

---

**Happy Learning! 🎓**
