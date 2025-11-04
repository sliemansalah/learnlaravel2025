<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $image->title }} - عرض الصورة</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: white;
            border-radius: 10px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .image-viewer {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .image-container {
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 500px;
            max-height: 70vh;
        }

        .main-image {
            max-width: 100%;
            max-height: 70vh;
            object-fit: contain;
        }

        .image-info {
            padding: 30px;
        }

        .image-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .image-description {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .image-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .meta-icon {
            font-size: 24px;
        }

        .meta-content {
            flex: 1;
        }

        .meta-label {
            font-size: 12px;
            color: #999;
            margin-bottom: 3px;
        }

        .meta-value {
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }

        .image-versions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .version-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .version-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .version-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .version-link {
            display: inline-block;
            padding: 8px 16px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .version-link:hover {
            background: #764ba2;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .image-title {
                font-size: 22px;
            }

            .image-meta {
                grid-template-columns: 1fr;
            }

            .image-versions {
                grid-template-columns: 1fr;
            }

            .action-buttons {
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
        <a href="{{ route('gallery.index') }}" class="back-button">
            ← رجوع للمعرض
        </a>

        <div class="image-viewer">
            <div class="image-container">
                <img src="{{ $image->original_url }}" alt="{{ $image->title }}" class="main-image">
            </div>

            <div class="image-info">
                <h1 class="image-title">{{ $image->title }}</h1>

                @if($image->description)
                    <p class="image-description">{{ $image->description }}</p>
                @endif

                <div class="image-meta">
                    <div class="meta-item">
                        <span class="meta-icon">📁</span>
                        <div class="meta-content">
                            <div class="meta-label">اسم الملف</div>
                            <div class="meta-value">{{ $image->filename }}</div>
                        </div>
                    </div>

                    <div class="meta-item">
                        <span class="meta-icon">📏</span>
                        <div class="meta-content">
                            <div class="meta-label">الحجم</div>
                            <div class="meta-value">{{ number_format($image->size / 1024, 2) }} KB</div>
                        </div>
                    </div>

                    <div class="meta-item">
                        <span class="meta-icon">🎨</span>
                        <div class="meta-content">
                            <div class="meta-label">النوع</div>
                            <div class="meta-value">{{ strtoupper(pathinfo($image->filename, PATHINFO_EXTENSION)) }}</div>
                        </div>
                    </div>

                    <div class="meta-item">
                        <span class="meta-icon">📅</span>
                        <div class="meta-content">
                            <div class="meta-label">تاريخ الرفع</div>
                            <div class="meta-value">{{ $image->created_at->format('Y-m-d') }}</div>
                        </div>
                    </div>
                </div>

                <h3 style="margin-bottom: 15px; color: #333;">🖼️ إصدارات الصورة | Image Versions</h3>
                <div class="image-versions">
                    <div class="version-card">
                        <div class="version-title">الأصلية | Original</div>
                        <img src="{{ $image->original_url }}" alt="Original" class="version-image">
                        <a href="{{ $image->original_url }}" target="_blank" class="version-link">
                            عرض الأصلية
                        </a>
                    </div>

                    @if($image->medium_path)
                        <div class="version-card">
                            <div class="version-title">متوسطة 800px | Medium</div>
                            <img src="{{ $image->medium_url }}" alt="Medium" class="version-image">
                            <a href="{{ $image->medium_url }}" target="_blank" class="version-link">
                                عرض المتوسطة
                            </a>
                        </div>
                    @endif

                    @if($image->thumbnail_path)
                        <div class="version-card">
                            <div class="version-title">مصغرة 300px | Thumbnail</div>
                            <img src="{{ $image->thumbnail_url }}" alt="Thumbnail" class="version-image">
                            <a href="{{ $image->thumbnail_url }}" target="_blank" class="version-link">
                                عرض المصغرة
                            </a>
                        </div>
                    @endif
                </div>

                <div class="action-buttons">
                    <form action="{{ route('gallery.destroy', $image->id) }}"
                          method="POST"
                          style="display: inline;"
                          onsubmit="return confirm('هل أنت متأكد من حذف هذه الصورة؟ سيتم حذف جميع الإصدارات.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            🗑️ حذف الصورة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
