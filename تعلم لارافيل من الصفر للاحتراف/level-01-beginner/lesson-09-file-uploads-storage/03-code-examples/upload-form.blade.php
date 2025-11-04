{{--
============================================================================
نموذج رفع الملفات - Blade Template
File Upload Form - Blade Template
============================================================================

هذا النموذج يوضح:
- كيفية إنشاء form لرفع الملفات
- استخدام enctype الصحيح
- CSRF protection
- عرض الأخطاء والرسائل
- رفع ملف واحد أو متعدد
- معاينة الملفات قبل الرفع (JavaScript)
- تصميم responsive وجميل

This form demonstrates:
- How to create a file upload form
- Using correct enctype
- CSRF protection
- Displaying errors and messages
- Single or multiple file upload
- File preview before upload (JavaScript)
- Responsive and beautiful design
--}}

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>رفع الملفات | File Upload</title>

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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        h1 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 2.5em;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }

        /* رسائل التنبيه | Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert ul {
            margin: 0;
            padding-right: 20px;
        }

        /* منطقة الرفع | Upload Area */
        .upload-area {
            border: 3px dashed #667eea;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .upload-area:hover {
            border-color: #764ba2;
            background: #f8f9fa;
        }

        .upload-area.dragover {
            background: #e3e8ff;
            border-color: #764ba2;
        }

        .upload-icon {
            font-size: 4em;
            color: #667eea;
            margin-bottom: 20px;
        }

        .upload-text {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 10px;
        }

        .upload-hint {
            color: #666;
            font-size: 0.9em;
        }

        input[type="file"] {
            display: none;
        }

        /* معاينة الملفات | File Preview */
        .preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .preview-item {
            position: relative;
            border: 2px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .preview-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .preview-item .file-icon {
            width: 100%;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3em;
            background: #e9ecef;
        }

        .preview-info {
            padding: 10px;
            font-size: 0.85em;
        }

        .preview-name {
            font-weight: bold;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .preview-size {
            color: #666;
        }

        .remove-file {
            position: absolute;
            top: 5px;
            left: 5px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
        }

        /* أزرار | Buttons */
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        /* شريط التقدم | Progress Bar */
        .progress {
            height: 25px;
            background: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            margin: 20px 0;
            display: none;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            width: 0%;
            transition: width 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* خيارات إضافية | Additional Options */
        .options {
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .option-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .option-row:last-child {
            margin-bottom: 0;
        }

        label {
            cursor: pointer;
        }

        /* إحصائيات | Statistics */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-icon {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 2em;
            font-weight: bold;
            color: #667eea;
        }

        .stat-label {
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- العنوان | Header --}}
        <div class="card">
            <h1>📁 نظام رفع الملفات</h1>
            <p class="subtitle">قم برفع ملفاتك بسهولة وأمان</p>
        </div>

        {{-- رسائل النجاح والأخطاء | Success and Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <span>❌</span>
                <div>
                    <strong>حدثت الأخطاء التالية:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- نموذج الرفع | Upload Form --}}
        <div class="card">
            <form id="uploadForm" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- منطقة الرفع | Upload Area --}}
                <div class="upload-area" id="uploadArea">
                    <div class="upload-icon">📤</div>
                    <div class="upload-text">اسحب وأفلت الملفات هنا</div>
                    <div class="upload-hint">أو انقر لاختيار الملفات من جهازك</div>
                    <input
                        type="file"
                        name="files[]"
                        id="fileInput"
                        multiple
                        accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx"
                    >
                </div>

                {{-- خيارات إضافية | Additional Options --}}
                <div class="options">
                    <div class="option-row">
                        <input type="checkbox" id="multipleFiles" checked>
                        <label for="multipleFiles">السماح برفع ملفات متعددة</label>
                    </div>
                    <div class="option-row">
                        <input type="checkbox" id="compressImages">
                        <label for="compressImages">ضغط الصور تلقائياً</label>
                    </div>
                </div>

                {{-- معاينة الملفات | File Preview --}}
                <div id="previewContainer" class="preview-container"></div>

                {{-- شريط التقدم | Progress Bar --}}
                <div class="progress" id="progressBar">
                    <div class="progress-bar" id="progressBarFill">0%</div>
                </div>

                {{-- زر الرفع | Upload Button --}}
                <div style="text-align: center; margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="uploadButton" disabled>
                        📤 رفع الملفات
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // العناصر | Elements
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('previewContainer');
        const uploadButton = document.getElementById('uploadButton');
        const uploadForm = document.getElementById('uploadForm');
        const progressBar = document.getElementById('progressBar');
        const progressBarFill = document.getElementById('progressBarFill');
        const multipleFilesCheckbox = document.getElementById('multipleFiles');

        let selectedFiles = [];

        // فتح مربع اختيار الملفات عند النقر
        // Open file selector on click
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // منع السلوك الافتراضي للسحب والإفلات
        // Prevent default drag & drop behavior
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // تأثير بصري عند السحب
        // Visual feedback when dragging
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.classList.remove('dragover');
            });
        });

        // معالجة الإفلات
        // Handle drop
        uploadArea.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        // معالجة الملفات المختارة
        // Handle selected files
        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        // خيار الملفات المتعددة
        // Multiple files option
        multipleFilesCheckbox.addEventListener('change', (e) => {
            fileInput.multiple = e.target.checked;
            if (!e.target.checked) {
                selectedFiles = selectedFiles.slice(0, 1);
                updatePreview();
            }
        });

        // معالجة الملفات
        // Process files
        function handleFiles(files) {
            if (!multipleFilesCheckbox.checked && files.length > 1) {
                alert('يمكنك اختيار ملف واحد فقط');
                return;
            }

            selectedFiles = Array.from(files);
            updatePreview();
        }

        // تحديث المعاينة
        // Update preview
        function updatePreview() {
            previewContainer.innerHTML = '';

            if (selectedFiles.length === 0) {
                uploadButton.disabled = true;
                return;
            }

            uploadButton.disabled = false;

            selectedFiles.forEach((file, index) => {
                const previewItem = createPreviewItem(file, index);
                previewContainer.appendChild(previewItem);
            });
        }

        // إنشاء عنصر معاينة
        // Create preview item
        function createPreviewItem(file, index) {
            const div = document.createElement('div');
            div.className = 'preview-item';

            // صورة المعاينة أو أيقونة
            // Preview image or icon
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                div.appendChild(img);
            } else {
                const icon = document.createElement('div');
                icon.className = 'file-icon';
                icon.textContent = getFileIcon(file.type);
                div.appendChild(icon);
            }

            // معلومات الملف
            // File info
            const info = document.createElement('div');
            info.className = 'preview-info';
            info.innerHTML = `
                <div class="preview-name" title="${file.name}">${file.name}</div>
                <div class="preview-size">${formatFileSize(file.size)}</div>
            `;
            div.appendChild(info);

            // زر الحذف
            // Remove button
            const removeBtn = document.createElement('button');
            removeBtn.className = 'remove-file';
            removeBtn.innerHTML = '×';
            removeBtn.type = 'button';
            removeBtn.onclick = () => removeFile(index);
            div.appendChild(removeBtn);

            return div;
        }

        // حذف ملف من القائمة
        // Remove file from list
        function removeFile(index) {
            selectedFiles.splice(index, 1);
            updatePreview();

            // تحديث input
            // Update input
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
        }

        // تنسيق حجم الملف
        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 بايت';
            const k = 1024;
            const sizes = ['بايت', 'كيلوبايت', 'ميجابايت', 'جيجابايت'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // الحصول على أيقونة حسب نوع الملف
        // Get icon by file type
        function getFileIcon(mimeType) {
            if (mimeType.includes('pdf')) return '📄';
            if (mimeType.includes('word')) return '📝';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return '📊';
            if (mimeType.includes('video')) return '🎥';
            if (mimeType.includes('audio')) return '🎵';
            return '📎';
        }

        // معالجة إرسال النموذج
        // Handle form submission
        uploadForm.addEventListener('submit', (e) => {
            if (selectedFiles.length === 0) {
                e.preventDefault();
                alert('يرجى اختيار ملف واحد على الأقل');
                return;
            }

            // إظهار شريط التقدم
            // Show progress bar
            progressBar.style.display = 'block';
            uploadButton.disabled = true;

            // محاكاة التقدم (في الواقع يمكن استخدام XMLHttpRequest أو Fetch API)
            // Simulate progress (in reality can use XMLHttpRequest or Fetch API)
            let progress = 0;
            const interval = setInterval(() => {
                progress += 10;
                progressBarFill.style.width = progress + '%';
                progressBarFill.textContent = progress + '%';

                if (progress >= 100) {
                    clearInterval(interval);
                }
            }, 200);
        });
    </script>
</body>
</html>

{{--
============================================================================
ملاحظات الاستخدام | Usage Notes
============================================================================

1. Route المطلوب:
   Route::post('/upload', [YourController::class, 'upload'])->name('upload');

2. في Controller:
   $request->validate([
       'files' => 'required',
       'files.*' => 'file|max:10240', // 10MB
   ]);

   foreach ($request->file('files') as $file) {
       $file->store('uploads', 'public');
   }

3. التخصيص:
   - غيّر accept attribute لتحديد أنواع الملفات المسموح بها
   - عدّل validation rules حسب احتياجاتك
   - أضف المزيد من الخيارات في قسم options

4. التحسينات الممكنة:
   - استخدام Ajax لرفع الملفات بدون إعادة تحميل الصفحة
   - إضافة شريط تقدم حقيقي
   - معالجة الأخطاء بشكل أفضل
   - إضافة معاينة للصور قبل الرفع
   - ضغط الصور قبل الرفع
--}}
