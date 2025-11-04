<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي - Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .card-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .card-header p {
            opacity: 0.9;
            font-size: 16px;
        }

        .card-body {
            padding: 40px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .profile-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .avatar-display {
            margin: 30px 0;
        }

        .avatar-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #667eea;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .no-avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: #f0f0f0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            color: #999;
            border: 5px solid #e0e0e0;
        }

        .user-info {
            margin: 20px 0;
        }

        .user-info h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .user-info p {
            color: #666;
            font-size: 16px;
        }

        .upload-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
        }

        .upload-section h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: 22px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            color: #555;
            font-weight: 600;
            font-size: 16px;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: block;
            padding: 15px 25px;
            background: white;
            border: 2px dashed #667eea;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
            color: #667eea;
            font-weight: 600;
        }

        .file-input-label:hover {
            background: #f0f3ff;
            border-color: #764ba2;
        }

        .file-name {
            margin-top: 10px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            color: #555;
            font-size: 14px;
            display: none;
        }

        .file-name.active {
            display: block;
        }

        .btn {
            padding: 15px 40px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(220, 53, 69, 0.4);
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .info-box {
            background: #e8f4f8;
            border-left: 4px solid #17a2b8;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .info-box ul {
            margin: 10px 0 0 20px;
            color: #0c5460;
        }

        .info-box li {
            margin: 5px 0;
        }

        .validation-errors {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .validation-errors ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .validation-errors li {
            color: #721c24;
            padding: 5px 0;
            font-weight: 500;
        }

        .validation-errors li:before {
            content: "✖ ";
            margin-left: 5px;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }

            .avatar-img, .no-avatar {
                width: 150px;
                height: 150px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>الملف الشخصي</h1>
                <p>Profile Page</p>
            </div>

            <div class="card-body">
                {{-- عرض رسائل النجاح --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        ✔ {{ session('success') }}
                    </div>
                @endif

                {{-- عرض رسائل الخطأ --}}
                @if(session('error'))
                    <div class="alert alert-error">
                        ✖ {{ session('error') }}
                    </div>
                @endif

                {{-- عرض أخطاء التحقق --}}
                @if($errors->any())
                    <div class="validation-errors">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- معلومات المستخدم --}}
                <div class="profile-section">
                    <div class="avatar-display">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="avatar-img">
                        @else
                            <div class="no-avatar">👤</div>
                        @endif
                    </div>

                    <div class="user-info">
                        <h2>{{ $user->name }}</h2>
                        <p>{{ $user->email }}</p>
                    </div>

                    {{-- زر حذف الصورة --}}
                    @if($user->avatar)
                        <form action="{{ route('profile.avatar.delete') }}" method="POST" style="display: inline;" onsubmit="return confirm('هل أنت متأكد من حذف الصورة الشخصية؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                🗑️ حذف الصورة
                            </button>
                        </form>
                    @endif
                </div>

                {{-- قسم رفع الصورة --}}
                <div class="upload-section">
                    <h3>
                        @if($user->avatar)
                            تحديث الصورة الشخصية
                        @else
                            رفع صورة شخصية
                        @endif
                    </h3>

                    <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">اختر صورة | Choose Image</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="avatar" id="avatar" accept="image/*" required onchange="displayFileName()">
                                <label for="avatar" class="file-input-label">
                                    📁 اختر ملف من جهازك
                                </label>
                            </div>
                            <div id="fileName" class="file-name"></div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            ⬆️ رفع الصورة
                        </button>
                    </form>

                    {{-- معلومات مهمة --}}
                    <div class="info-box">
                        <strong>📌 متطلبات الصورة | Image Requirements:</strong>
                        <ul>
                            <li>نوع الملف: JPEG, PNG, JPG, GIF</li>
                            <li>الحد الأقصى للحجم: 2 ميجابايت</li>
                            <li>الأبعاد: على الأقل 100x100 بكسل</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function displayFileName() {
            const input = document.getElementById('avatar');
            const fileNameDiv = document.getElementById('fileName');
            const submitBtn = document.getElementById('submitBtn');

            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                const fileSize = (input.files[0].size / (1024 * 1024)).toFixed(2); // Convert to MB

                fileNameDiv.textContent = `📄 ${fileName} (${fileSize} MB)`;
                fileNameDiv.classList.add('active');
                submitBtn.disabled = false;

                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log('Image loaded successfully');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                fileNameDiv.classList.remove('active');
            }
        }

        // Form submission handling
        document.getElementById('uploadForm').addEventListener('submit', function() {
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('submitBtn').textContent = '⏳ جاري الرفع...';
        });
    </script>
</body>
</html>
