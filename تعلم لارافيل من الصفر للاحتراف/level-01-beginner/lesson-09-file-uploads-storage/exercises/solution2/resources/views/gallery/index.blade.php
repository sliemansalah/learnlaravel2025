<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معرض الصور - Image Gallery</title>
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header h1 {
            color: #333;
            font-size: 32px;
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

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
            background: white;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .gallery-item {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .gallery-item-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            cursor: pointer;
        }

        .gallery-item-content {
            padding: 20px;
        }

        .gallery-item-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .gallery-item-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .gallery-item-actions {
            display: flex;
            gap: 10px;
        }

        .btn-sm {
            padding: 8px 15px;
            font-size: 14px;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background: #138496;
        }

        .empty-state {
            background: white;
            border-radius: 15px;
            padding: 60px 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .empty-state-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .empty-state h2 {
            color: #333;
            margin-bottom: 15px;
        }

        .empty-state p {
            color: #666;
            margin-bottom: 25px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            background: white;
            border-radius: 8px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .pagination span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }

            .header {
                text-align: center;
                flex-direction: column;
            }

            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>📸 معرض الصور</h1>
                <p style="color: #666; margin-top: 5px;">Image Gallery with Thumbnails</p>
            </div>
            <a href="{{ route('gallery.create') }}" class="btn btn-primary">
                ➕ رفع صور جديدة
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✔ {{ session('success') }}
            </div>
        @endif

        @if($images->count() > 0)
            <div class="gallery-grid">
                @foreach($images as $image)
                    <div class="gallery-item">
                        <img src="{{ $image->thumbnail_url }}"
                             alt="{{ $image->title }}"
                             class="gallery-item-image"
                             onclick="window.location.href='{{ route('gallery.show', $image->id) }}'">

                        <div class="gallery-item-content">
                            <h3 class="gallery-item-title">{{ $image->title }}</h3>

                            @if($image->description)
                                <p class="gallery-item-description">{{ Str::limit($image->description, 100) }}</p>
                            @endif

                            <div style="font-size: 12px; color: #999; margin-bottom: 15px;">
                                📁 {{ number_format($image->size / 1024, 2) }} KB
                                | 📅 {{ $image->created_at->diffForHumans() }}
                            </div>

                            <div class="gallery-item-actions">
                                <a href="{{ route('gallery.show', $image->id) }}" class="btn btn-info btn-sm">
                                    👁️ عرض
                                </a>

                                <form action="{{ route('gallery.destroy', $image->id) }}"
                                      method="POST"
                                      style="display: inline;"
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذه الصورة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        🗑️ حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $images->links() }}
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📷</div>
                <h2>المعرض فارغ</h2>
                <p>لم يتم رفع أي صور بعد. ابدأ برفع صورك الأولى!</p>
                <a href="{{ route('gallery.create') }}" class="btn btn-primary">
                    ➕ رفع صور الآن
                </a>
            </div>
        @endif
    </div>
</body>
</html>
