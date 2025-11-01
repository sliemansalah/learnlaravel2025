<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration - Validation Example</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 20px; }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 4px; }
        .alert-danger { background: #fee; border: 1px solid #fcc; color: #c33; }
        .alert ul { margin-left: 20px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], input[type="file"] {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;
        }
        input.is-invalid { border-color: #c33; }
        .invalid-feedback { color: #c33; font-size: 13px; margin-top: 5px; }
        .checkbox-group { display: flex; align-items: center; }
        .checkbox-group input[type="checkbox"] { width: auto; margin-right: 8px; }
        button { background: #4CAF50; color: white; padding: 12px 24px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #45a049; }
        .back-link { display: inline-block; margin-top: 15px; color: #666; text-decoration: none; }
        .back-link:hover { color: #333; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Registration Form</h1>
        <p style="color: #666; margin-bottom: 20px;">This form demonstrates Laravel validation with Form Requests</p>

        {{-- Display all validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Name Field --}}
            <div class="form-group">
                <label for="name">Name *</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="@error('name') is-invalid @enderror"
                    placeholder="Enter your full name"
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email Field --}}
            <div class="form-group">
                <label for="email">Email *</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="@error('email') is-invalid @enderror"
                    placeholder="your.email@example.com"
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password Field --}}
            <div class="form-group">
                <label for="password">Password *</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="@error('password') is-invalid @enderror"
                    placeholder="Minimum 8 characters"
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password Confirmation Field --}}
            <div class="form-group">
                <label for="password_confirmation">Confirm Password *</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Re-enter your password"
                >
            </div>

            {{-- Phone Field --}}
            <div class="form-group">
                <label for="phone">Phone (Optional)</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="{{ old('phone') }}"
                    class="@error('phone') is-invalid @enderror"
                    placeholder="10 digits (e.g., 1234567890)"
                >
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Birth Date Field --}}
            <div class="form-group">
                <label for="birth_date">Birth Date *</label>
                <input
                    type="date"
                    name="birth_date"
                    id="birth_date"
                    value="{{ old('birth_date') }}"
                    class="@error('birth_date') is-invalid @enderror"
                >
                @error('birth_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Avatar Field --}}
            <div class="form-group">
                <label for="avatar">Avatar (Optional)</label>
                <input
                    type="file"
                    name="avatar"
                    id="avatar"
                    class="@error('avatar') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/jpg"
                >
                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small style="color: #666; font-size: 12px;">Max 2MB, JPEG/PNG/JPG only</small>
            </div>

            {{-- Terms and Conditions --}}
            <div class="form-group checkbox-group">
                <input
                    type="checkbox"
                    name="agree_terms"
                    id="agree_terms"
                    value="1"
                    {{ old('agree_terms') ? 'checked' : '' }}
                >
                <label for="agree_terms" style="margin-bottom: 0; font-weight: normal;">
                    I agree to the terms and conditions *
                </label>
            </div>
            @error('agree_terms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit">Register User</button>

            <a href="{{ route('users.index') }}" class="back-link">← Back to Users List</a>
        </form>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            <h3 style="color: #555; margin-bottom: 10px;">Validation Rules Applied:</h3>
            <ul style="color: #666; font-size: 14px; line-height: 1.8;">
                <li><strong>Name:</strong> Required, max 255 characters</li>
                <li><strong>Email:</strong> Required, valid email, unique</li>
                <li><strong>Password:</strong> Required, min 8 characters, must match confirmation</li>
                <li><strong>Phone:</strong> Optional, must be 10 digits</li>
                <li><strong>Birth Date:</strong> Required, must be before today</li>
                <li><strong>Avatar:</strong> Optional, image file, max 2MB</li>
                <li><strong>Terms:</strong> Must be accepted</li>
            </ul>
        </div>
    </div>
</body>
</html>
