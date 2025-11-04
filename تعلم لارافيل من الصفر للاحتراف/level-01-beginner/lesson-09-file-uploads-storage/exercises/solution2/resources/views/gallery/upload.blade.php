<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع صور - Upload Images</title>
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

        .card-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: 600;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .file-upload-area {
            border: 3px dashed #667eea;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            background: #f8f9ff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-area:hover {
            background: #f0f3ff;
            border-color: #764ba2;
        }

        .file-upload-area.dragover {
            background: #e8ecff;
            border-color: #764ba2;
        }

        .file-upload-icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .file-upload-text {
            font-size: 18px;
            color: #667eea;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .file-upload-hint {
            font-size: 14px;
            color: #999;
        }

        #image-input {
            display: none;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .preview-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .preview-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .preview-remove {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #dc3545;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
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
            width: 100%;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .alert-danger ul {
            margin: 10px 0 0 20px;
            padding: 0;
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

        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
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
                <h1>📤 رفع صور جديدة</h1>
                <p>Upload New Images</p>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>خطأ في الإدخال:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">العنوان | Title *</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               placeholder="أدخل عنوان الصور..."
                               value="{{ old('title') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الوصف | Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  placeholder="أدخل وصف للصور... (اختياري)">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الصور | Images * (يمكنك اختيار حتى 10 صور)</label>
                        <div class="file-upload-area" id="dropZone" onclick="document.getElementById('image-input').click()">
                            <div class="file-upload-icon">📁</div>
                            <div class="file-upload-text">اضغط لاختيار الصور أو اسحبها هنا</div>
                            <div class="file-upload-hint">PNG, JPG, JPEG, GIF (حتى 5MB لكل صورة)</div>
                        </div>
                        <input type="file"
                               id="image-input"
                               name="images[]"
                               accept="image/*"
                               multiple
                               required>

                        <div id="preview-container" class="preview-grid"></div>
                    </div>

                    <div class="info-box">
                        <strong>📌 معلومات مهمة:</strong>
                        <ul>
                            <li>يمكنك رفع 1-10 صور في نفس الوقت</li>
                            <li>الحد الأقصى لحجم كل صورة: 5 ميجابايت</li>
                            <li>سيتم إنشاء 3 نسخ من كل صورة: أصلية، متوسطة، ومصغرة</li>
                            <li>الأنواع المدعومة: JPEG, PNG, JPG, GIF</li>
                        </ul>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            ⬆️ رفع الصور
                        </button>
                        <a href="{{ route('gallery.index') }}" class="btn btn-secondary">
                            ← رجوع للمعرض
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const imageInput = document.getElementById('image-input');
        const previewContainer = document.getElementById('preview-container');
        const dropZone = document.getElementById('dropZone');
        const submitBtn = document.getElementById('submitBtn');
        let selectedFiles = [];

        // Handle file selection
        imageInput.addEventListener('change', function(e) {
            handleFiles(e.target.files);
        });

        // Drag and drop
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        function handleFiles(files) {
            const filesArray = Array.from(files);
            const imageFiles = filesArray.filter(file => file.type.startsWith('image/'));

            if (imageFiles.length > 10) {
                alert('يمكنك رفع 10 صور كحد أقصى في المرة الواحدة');
                return;
            }

            selectedFiles = imageFiles;
            displayPreviews();

            // Update the file input
            const dataTransfer = new DataTransfer();
            imageFiles.forEach(file => dataTransfer.items.add(file));
            imageInput.files = dataTransfer.files;
        }

        function displayPreviews() {
            previewContainer.innerHTML = '';

            if (selectedFiles.length === 0) {
                submitBtn.disabled = true;
                return;
            }

            submitBtn.disabled = false;

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="preview-image">
                        <button type="button" class="preview-remove" onclick="removeFile(${index})">×</button>
                    `;
                    previewContainer.appendChild(previewItem);
                };

                reader.readAsDataURL(file);
            });
        }

        function removeFile(index) {
            selectedFiles.splice(index, 1);
            displayPreviews();

            // Update the file input
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            imageInput.files = dataTransfer.files;
        }

        // Form submission
        document.getElementById('uploadForm').addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.textContent = '⏳ جاري الرفع...';
        });

        // Initial state
        submitBtn.disabled = true;
    </script>
</body>
</html>
