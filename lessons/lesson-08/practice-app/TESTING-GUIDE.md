# Comprehensive Testing Guide - Lesson 8 Validation

This guide provides detailed test scenarios to explore all validation features implemented in this practice application.

## Setup

1. **Start the server:**
   ```bash
   cd lessons/lesson-08/practice-app
   php artisan serve
   ```

2. **Access the application:**
   - Main page: http://localhost:8000
   - Users: http://localhost:8000/users
   - Posts: http://localhost:8000/posts
   - Orders: http://localhost:8000/orders

---

## Test Suite 1: User Registration Validation

**URL:** http://localhost:8000/users/create

### Test 1.1: Empty Form Submission
**Purpose:** Test all required field validations

**Steps:**
1. Visit the registration form
2. Click "Register User" without filling anything
3. Observe all validation errors displayed

**Expected Results:**
- ❌ Name is required
- ❌ Email is required
- ❌ Password is required
- ❌ Birth date is required
- ❌ You must agree to terms

---

### Test 1.2: Invalid Email Format
**Purpose:** Test email validation

**Test Data:**
- Name: `John Doe`
- Email: `not-an-email`
- Password: `password123`
- Password Confirmation: `password123`
- Birth Date: `1990-01-01`
- Terms: ✓ Checked

**Expected Results:**
- ❌ The email field must be a valid email address

**Try these invalid emails:**
- `test` (no @ symbol)
- `test@` (incomplete domain)
- `@example.com` (no username)
- `test @example.com` (space in email)

---

### Test 1.3: Password Too Short
**Purpose:** Test minimum password length

**Test Data:**
- Name: `John Doe`
- Email: `john@example.com`
- Password: `12345` (only 5 characters)
- Password Confirmation: `12345`
- Other fields: Valid

**Expected Results:**
- ❌ Password must be at least 8 characters

---

### Test 1.4: Password Mismatch
**Purpose:** Test password confirmation

**Test Data:**
- Name: `John Doe`
- Email: `john@example.com`
- Password: `MyPassword123`
- Password Confirmation: `DifferentPassword`
- Other fields: Valid

**Expected Results:**
- ❌ Password confirmation does not match

---

### Test 1.5: Invalid Phone Number
**Purpose:** Test phone number format (exactly 10 digits)

**Test Data:**
- Phone: `123` (too short)

**Expected Results:**
- ❌ The phone field format is invalid

**Also try:**
- `12345678901` (11 digits - too long)
- `abcdefghij` (letters instead of numbers)
- `123-456-7890` (contains dashes)

**Valid format:** `1234567890` (exactly 10 digits)

---

### Test 1.6: Future Birth Date
**Purpose:** Test date validation (must be before today)

**Test Data:**
- Birth Date: Select tomorrow's date or any future date

**Expected Results:**
- ❌ The birth date field must be a date before today

---

### Test 1.7: Duplicate Email
**Purpose:** Test unique validation

**Steps:**
1. Register a user with email `test@example.com`
2. Try to register another user with the same email

**Expected Results:**
- ❌ Email already exists

---

### Test 1.8: Invalid File Upload
**Purpose:** Test file validation

**Test invalid files:**
1. Upload a .txt file
2. Upload a file larger than 2MB
3. Upload a .pdf file

**Expected Results:**
- ❌ The avatar field must be a file of type: jpeg, png, jpg
- ❌ The avatar field must not be greater than 2048 kilobytes

**Valid:** Upload a JPEG/PNG/JPG file under 2MB

---

### Test 1.9: Missing Terms Acceptance
**Purpose:** Test checkbox validation

**Steps:**
1. Fill all fields correctly
2. Leave "I agree to terms" unchecked
3. Submit form

**Expected Results:**
- ❌ You must agree to terms

---

### Test 1.10: Successful Registration
**Purpose:** Test complete valid submission

**Test Data:**
- Name: `Jane Smith`
- Email: `jane.smith@example.com`
- Password: `SecurePass123`
- Password Confirmation: `SecurePass123`
- Phone: `5551234567`
- Birth Date: `1995-05-15`
- Avatar: Upload a valid image (optional)
- Terms: ✓ Checked

**Expected Results:**
- ✅ Success message displayed
- ✅ Redirected to users list
- ✅ New user appears in the list

---

## Test Suite 2: Post Creation Validation

**URL:** http://localhost:8000/posts/create

**Note:** Post creation requires authentication. To test without auth, temporarily remove the `auth` middleware from `routes/web.php`.

### Test 2.1: Authorization Check
**Purpose:** Test authorization requirement

**Steps:**
1. Visit /posts/create without being logged in
2. Observe the authorization behavior

**Expected Results:**
- ❌ Either redirected to login or see authorization error

---

### Test 2.2: Empty Post Form
**Purpose:** Test required fields

**Expected Errors:**
- ❌ Title is required
- ❌ Slug is required
- ❌ Content is required
- ❌ Category is required
- ❌ Status is required

---

### Test 2.3: Content Too Short
**Purpose:** Test minimum content length (100 characters)

**Test Data:**
- Title: `My First Post`
- Slug: `my-first-post`
- Content: `Short content` (less than 100 characters)
- Category: Select any
- Status: Draft

**Expected Results:**
- ❌ The content field must be at least 100 characters

---

### Test 2.4: Duplicate Slug
**Purpose:** Test unique slug validation

**Steps:**
1. Create a post with slug `test-post`
2. Try to create another post with the same slug

**Expected Results:**
- ❌ The slug has already been taken

---

### Test 2.5: Excerpt Too Long
**Purpose:** Test maximum length

**Test Data:**
- Excerpt: Enter more than 500 characters

**Expected Results:**
- ❌ The excerpt field must not be greater than 500 characters

---

### Test 2.6: Too Many Tags
**Purpose:** Test array max validation

**Steps:**
1. Fill the form correctly
2. Select more than 5 tags
3. Submit

**Expected Results:**
- ❌ The tags field must not have more than 5 items

---

### Test 2.7: Invalid Category
**Purpose:** Test exists validation

**Steps:**
1. Use browser dev tools to modify the category dropdown
2. Add an option with value `999` (non-existent ID)
3. Select it and submit

**Expected Results:**
- ❌ The selected category id is invalid

---

### Test 2.8: Conditional Validation - Published Status
**Purpose:** Test required_if validation

**Test Data:**
- Fill all fields correctly
- Status: Select "Published"
- Published At: Leave empty
- Submit

**Expected Results:**
- ❌ The published at field is required when status is published

**Then test:**
- Status: "Published"
- Published At: Yesterday's date

**Expected Results:**
- ❌ The published at field must be a date after or equal to today

---

### Test 2.9: Successful Post Creation
**Purpose:** Test complete valid submission

**Test Data:**
- Title: `Laravel Validation Best Practices`
- Slug: `laravel-validation-best-practices`
- Content: Write at least 100 characters
- Excerpt: `Learn about Laravel validation...`
- Category: Select any
- Tags: Select 1-5 tags
- Featured Image: Upload valid image (optional)
- Status: Draft or Published
- Published At: Today or later (if Published)

**Expected Results:**
- ✅ Success message
- ✅ Post appears in list

---

## Test Suite 3: Order Placement Validation

**URL:** http://localhost:8000/orders/create

**Note:** Orders require authentication.

### Test 3.1: Empty Order Form
**Purpose:** Test required fields

**Expected Errors:**
- ❌ Items are required
- ❌ Payment method is required
- ❌ Shipping address is required
- ❌ Shipping city is required
- ❌ Shipping ZIP is required

---

### Test 3.2: Invalid Product Selection
**Purpose:** Test nested array validation

**Steps:**
1. Leave the first product dropdown as "-- Select Product --"
2. Enter quantity: 2
3. Fill other required fields
4. Submit

**Expected Results:**
- ❌ The items.0.product_id field is required

---

### Test 3.3: Invalid Quantity
**Purpose:** Test integer and minimum validation

**Test Data:**
- Product: Select any
- Quantity: `0` or `-1`

**Expected Results:**
- ❌ The items.0.quantity field must be at least 1

**Also try:**
- Quantity: `abc` (letters)
- Quantity: `2.5` (decimal)

---

### Test 3.4: Multiple Items Validation
**Purpose:** Test array of items

**Steps:**
1. Click "Add Another Item" button
2. Add 3 items
3. Leave the second item's product unselected
4. Submit

**Expected Results:**
- ❌ The items.1.product_id field is required
- ✅ Items 0 and 2 should be valid (if filled correctly)

---

### Test 3.5: Conditional Payment Validation - Card Selected
**Purpose:** Test required_if for card fields

**Steps:**
1. Select Payment Method: "Credit/Debit Card"
2. Leave Card Number and CVV empty
3. Fill other required fields
4. Submit

**Expected Results:**
- ❌ The card number field is required when payment method is card
- ❌ The card cvv field is required when payment method is card

---

### Test 3.6: Invalid Card Number
**Purpose:** Test exact length validation (16 digits)

**Test Data:**
- Payment Method: Card
- Card Number: `123456` (too short)
- CVV: `123`

**Expected Results:**
- ❌ The card number field must be 16 digits

**Also try:**
- `12345678901234567` (17 digits - too long)
- `abcd1234efgh5678` (contains letters)

**Valid:** `1234567890123456` (exactly 16 digits)

---

### Test 3.7: Invalid CVV
**Purpose:** Test exact length validation (3 digits)

**Test Data:**
- Card Number: Valid 16 digits
- CVV: `12` (too short)

**Expected Results:**
- ❌ The card cvv field must be 3 digits

**Also try:**
- `1234` (4 digits)
- `abc` (letters)

**Valid:** `123` (exactly 3 digits)

---

### Test 3.8: Cash Payment (No Card Required)
**Purpose:** Test conditional validation doesn't trigger

**Steps:**
1. Select Payment Method: "Cash"
2. Leave card fields empty (they should be hidden)
3. Fill all other required fields
4. Submit

**Expected Results:**
- ✅ Form submits successfully without card validation errors

---

### Test 3.9: Invalid ZIP Code
**Purpose:** Test exact length validation (5 digits)

**Test Data:**
- Shipping ZIP: `123` (too short)

**Expected Results:**
- ❌ The shipping zip field must be 5 digits

**Also try:**
- `123456` (6 digits)
- `abcde` (letters)

**Valid:** `12345` (exactly 5 digits)

---

### Test 3.10: Successful Order Placement
**Purpose:** Test complete valid submission

**Test Data:**
- Items:
  - Item 1: Laptop Pro, Quantity: 1
  - Item 2: Wireless Mouse, Quantity: 2
- Payment Method: Cash
- Shipping Address: `123 Main Street, Apt 4B`
- Shipping City: `Springfield`
- Shipping ZIP: `12345`
- Notes: `Please deliver after 6 PM` (optional)

**Expected Results:**
- ✅ Success message
- ✅ Order appears in list
- ✅ Total amount calculated correctly

---

## Test Suite 4: Custom Validation Rule Testing

### Test 4.1: StrongPassword Rule
**Purpose:** Test custom password validation

The `StrongPassword` rule is not currently applied to the forms, but you can test it by creating a simple test controller or modifying `StoreUserRequest.php`.

**To Test:**
Add `new StrongPassword` to the password rules in `StoreUserRequest.php`:

```php
'password' => ['required', 'string', 'min:8', 'confirmed', new StrongPassword],
```

**Test weak passwords:**
1. `lowercase` - Missing uppercase, number, special char
2. `UPPERCASE` - Missing lowercase, number, special char
3. `NoNumbers!` - Missing numbers
4. `NoSpecial123` - Missing special characters
5. `weak` - Too short and missing requirements

**Valid password:** `Strong@Pass123`

**Expected Errors:**
- ❌ Password must contain at least one uppercase letter
- ❌ Password must contain at least one lowercase letter
- ❌ Password must contain at least one number
- ❌ Password must contain at least one special character (@$!%*?&)

---

## Test Suite 5: Edge Cases and Special Scenarios

### Test 5.1: XSS Attempt
**Purpose:** Ensure inputs are properly escaped

**Test Data:**
- Name: `<script>alert('XSS')</script>`
- Submit form

**Expected Results:**
- ✅ Script tags should be escaped and not executed
- ✅ Displayed as plain text in the users list

---

### Test 5.2: SQL Injection Attempt
**Purpose:** Test protection against SQL injection

**Test Data:**
- Email: `test' OR '1'='1`
- Submit form

**Expected Results:**
- ❌ Should fail email format validation
- ✅ No SQL errors

---

### Test 5.3: Very Long Input
**Purpose:** Test max length validations

**Test Data:**
- Name: Enter 500 characters

**Expected Results:**
- ❌ The name field must not be greater than 255 characters

---

### Test 5.4: Special Characters
**Purpose:** Test handling of special characters

**Test Data:**
- Name: `José María O'Brien`
- Phone: `1234567890`
- Other fields: Valid

**Expected Results:**
- ✅ Should accept names with accents and apostrophes

---

### Test 5.5: Form Resubmission
**Purpose:** Test browser form resubmission

**Steps:**
1. Submit a valid form
2. Click browser's back button
3. Try to resubmit

**Expected Results:**
- ✅ Should handle gracefully (might show unique constraint error for email)

---

## Test Suite 6: JavaScript Functionality

### Test 6.1: Content Length Counter
**Purpose:** Test real-time character counting (Posts)

**Steps:**
1. Visit post creation form
2. Type in the content field
3. Observe the character counter

**Expected Results:**
- ✅ Counter updates in real-time
- ✅ Shows current character count

---

### Test 6.2: Conditional Field Display (Posts)
**Purpose:** Test status-based field visibility

**Steps:**
1. Visit post creation form
2. Select Status: "Draft"
3. Observe Published At field is hidden
4. Select Status: "Published"
5. Observe Published At field appears

**Expected Results:**
- ✅ Field visibility toggles correctly

---

### Test 6.3: Dynamic Order Items
**Purpose:** Test add/remove items functionality

**Steps:**
1. Visit order creation form
2. Click "Add Another Item"
3. Verify new item fields appear
4. Click "Remove" on an item
5. Try to remove the last remaining item

**Expected Results:**
- ✅ Items can be added
- ✅ Items can be removed
- ✅ Cannot remove the last item (alert shown)

---

### Test 6.4: Payment Method Toggle (Orders)
**Purpose:** Test conditional field display

**Steps:**
1. Select "Cash" - card fields hidden
2. Select "Credit/Debit Card" - card fields shown
3. Select "Bank Transfer" - card fields hidden again

**Expected Results:**
- ✅ Card details section toggles correctly

---

## Test Suite 7: Old Input Persistence

### Test 7.1: Form Data Preservation
**Purpose:** Test that form data persists after validation errors

**Steps:**
1. Fill out the registration form with mixed valid/invalid data:
   - Name: `John Doe` (valid)
   - Email: `invalid-email` (invalid)
   - Phone: `1234567890` (valid)
2. Submit form
3. Observe form after error

**Expected Results:**
- ✅ Name field still contains "John Doe"
- ✅ Email field still contains "invalid-email"
- ✅ Phone field still contains "1234567890"
- ✅ Password fields are empty (security)

---

## Summary Checklist

Use this checklist to track your testing progress:

### User Registration
- [ ] Empty form validation
- [ ] Invalid email format
- [ ] Password too short
- [ ] Password mismatch
- [ ] Invalid phone number
- [ ] Future birth date
- [ ] Duplicate email
- [ ] Invalid file upload
- [ ] Missing terms acceptance
- [ ] Successful registration

### Post Creation
- [ ] Authorization check
- [ ] Empty form validation
- [ ] Content too short
- [ ] Duplicate slug
- [ ] Excerpt too long
- [ ] Too many tags
- [ ] Invalid category
- [ ] Conditional published date
- [ ] Successful post creation

### Order Placement
- [ ] Empty form validation
- [ ] Invalid product selection
- [ ] Invalid quantity
- [ ] Multiple items validation
- [ ] Card fields when card selected
- [ ] Invalid card number
- [ ] Invalid CVV
- [ ] Cash payment (no card required)
- [ ] Invalid ZIP code
- [ ] Successful order placement

### Additional Tests
- [ ] XSS protection
- [ ] SQL injection protection
- [ ] Max length validation
- [ ] Special characters handling
- [ ] Form resubmission handling
- [ ] JavaScript counters and toggles
- [ ] Old input persistence

---

## Tips for Testing

1. **Use Browser Developer Tools:** Open the console to see any JavaScript errors
2. **Check Network Tab:** Monitor form submissions and responses
3. **Test Mobile View:** Resize browser to test responsive behavior
4. **Clear Browser Cache:** If forms behave strangely
5. **Check Database:** Use `php artisan tinker` to verify data
6. **Read Error Messages:** Laravel's validation messages are descriptive

---

## Reporting Issues

If you find validation not working as expected:

1. Check the Form Request file for the validation rules
2. Review the controller for proper usage
3. Ensure the route is correctly defined
4. Check for JavaScript console errors
5. Verify database constraints match validation rules

---

**Happy Testing! 🧪**

This comprehensive testing will help you understand all aspects of Laravel validation!
