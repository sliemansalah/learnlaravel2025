<?php
/**
 * ==============================================
 * الحل: تمرين 2 - CategoryController مع Nested Resources
 * Solution: Exercise 2 - CategoryController with Nested Resources
 * ==============================================
 *
 * الهدف من التمرين:
 * - إنشاء CategoryController مع nested resources
 * - عرض جميع المنتجات في تصنيف معين
 * - فهم مفهوم Nested Resources في Laravel
 *
 * المكان المناسب لهذا الكود:
 * app/Http/Controllers/CategoryController.php
 * ==============================================
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * ==============================================
 * الحل الأساسي: CategoryController
 * Basic Solution: CategoryController
 * ==============================================
 */

/**
 * لإنشاء هذا الـ Controller:
 * php artisan make:controller CategoryController
 *
 * اسم الملف: app/Http/Controllers/CategoryController.php
 */
class CategoryController extends Controller
{
    /**
     * عرض قائمة جميع التصنيفات
     * Display all categories
     *
     * GET /categories
     */
    public function index()
    {
        // في الواقع، نجلب التصنيفات من قاعدة البيانات
        // $categories = Category::all();

        $categories = [
            [
                'id' => 1,
                'name' => 'إلكترونيات',
                'slug' => 'electronics',
                'description' => 'أجهزة إلكترونية وأدوات تقنية',
                'products_count' => 15
            ],
            [
                'id' => 2,
                'name' => 'ملابس',
                'slug' => 'clothing',
                'description' => 'ملابس رجالية ونسائية',
                'products_count' => 42
            ],
            [
                'id' => 3,
                'name' => 'كتب',
                'slug' => 'books',
                'description' => 'كتب في مختلف المجالات',
                'products_count' => 28
            ],
            [
                'id' => 4,
                'name' => 'رياضة',
                'slug' => 'sports',
                'description' => 'معدات ولوازم رياضية',
                'products_count' => 19
            ]
        ];

        return view('categories.index', compact('categories'));
    }

    /**
     * عرض تفاصيل تصنيف معين
     * Display a specific category
     *
     * GET /categories/{category}
     */
    public function show($id)
    {
        // في الواقع، نجلب التصنيف من قاعدة البيانات
        // $category = Category::findOrFail($id);

        $category = [
            'id' => $id,
            'name' => 'إلكترونيات',
            'slug' => 'electronics',
            'description' => 'أجهزة إلكترونية وأدوات تقنية حديثة',
            'products_count' => 15,
            'created_at' => '2025-10-01'
        ];

        return view('categories.show', compact('category'));
    }

    /**
     * عرض جميع المنتجات في تصنيف معين
     * Display all products in a specific category (Nested Resource)
     *
     * GET /categories/{category}/products
     *
     * هذا هو المطلوب في التمرين - Nested Resource
     */
    public function products($categoryId)
    {
        // في الواقع، نجلب التصنيف والمنتجات من قاعدة البيانات
        // $category = Category::findOrFail($categoryId);
        // $products = $category->products()->get();

        // معلومات التصنيف
        $category = [
            'id' => $categoryId,
            'name' => 'إلكترونيات',
            'slug' => 'electronics',
            'description' => 'أجهزة إلكترونية وأدوات تقنية'
        ];

        // جميع المنتجات (نقوم بفلترتها حسب التصنيف)
        $allProducts = [
            // منتجات التصنيف 1 (إلكترونيات)
            [
                'id' => 1,
                'category_id' => 1,
                'name' => 'لابتوب Dell XPS 15',
                'price' => 5500,
                'description' => 'لابتوب عالي الأداء للمحترفين',
                'stock' => 12,
                'image' => 'laptop-dell.jpg'
            ],
            [
                'id' => 2,
                'category_id' => 1,
                'name' => 'هاتف iPhone 15 Pro',
                'price' => 4200,
                'description' => 'أحدث هواتف آيفون',
                'stock' => 25,
                'image' => 'iphone-15.jpg'
            ],
            [
                'id' => 3,
                'category_id' => 1,
                'name' => 'سماعات Sony WH-1000XM5',
                'price' => 1200,
                'description' => 'سماعات بخاصية إلغاء الضوضاء',
                'stock' => 30,
                'image' => 'sony-headphones.jpg'
            ],
            [
                'id' => 4,
                'category_id' => 1,
                'name' => 'تابلت iPad Pro',
                'price' => 3800,
                'description' => 'تابلت احترافي من آبل',
                'stock' => 15,
                'image' => 'ipad-pro.jpg'
            ],
            // منتجات تصنيفات أخرى
            [
                'id' => 5,
                'category_id' => 2,
                'name' => 'قميص رجالي',
                'price' => 150,
                'description' => 'قميص قطني عالي الجودة',
                'stock' => 50,
                'image' => 'shirt.jpg'
            ],
            [
                'id' => 6,
                'category_id' => 3,
                'name' => 'كتاب تعلم Laravel',
                'price' => 85,
                'description' => 'دليل شامل لتعلم Laravel',
                'stock' => 100,
                'image' => 'laravel-book.jpg'
            ]
        ];

        // فلترة المنتجات حسب التصنيف
        $products = array_filter($allProducts, function($product) use ($categoryId) {
            return $product['category_id'] == $categoryId;
        });

        // إعادة ترتيب المصفوفة بعد الفلترة
        $products = array_values($products);

        return view('categories.products', [
            'category' => $category,
            'products' => $products
        ]);
    }
}

/**
 * ==============================================
 * Routes للـ Nested Resources
 * Routes for Nested Resources
 * ==============================================
 */

/**
 * في routes/web.php:
 *
 * use App\Http\Controllers\CategoryController;
 *
 * // عرض جميع التصنيفات
 * Route::get('/categories', [CategoryController::class, 'index'])
 *     ->name('categories.index');
 *
 * // عرض تصنيف معين
 * Route::get('/categories/{category}', [CategoryController::class, 'show'])
 *     ->name('categories.show');
 *
 * // عرض جميع المنتجات في تصنيف معين (Nested Resource)
 * Route::get('/categories/{category}/products', [CategoryController::class, 'products'])
 *     ->name('categories.products');
 */

/**
 * ==============================================
 * حل متقدم: استخدام Route::resource مع Nested Resources
 * Advanced Solution: Using Route::resource with Nested Resources
 * ==============================================
 */

/**
 * طريقة بديلة باستخدام Controller منفصل للمنتجات
 * Alternative approach using a separate Controller for products
 *
 * لإنشاء:
 * php artisan make:controller CategoryProductController
 */
class CategoryProductController extends Controller
{
    /**
     * عرض جميع المنتجات في تصنيف معين
     * Display all products in a category
     */
    public function index($categoryId)
    {
        // $category = Category::findOrFail($categoryId);
        // $products = $category->products;

        $category = [
            'id' => $categoryId,
            'name' => 'إلكترونيات'
        ];

        $products = [
            ['id' => 1, 'name' => 'لابتوب', 'price' => 5500],
            ['id' => 2, 'name' => 'هاتف', 'price' => 4200],
        ];

        return view('categories.products.index', compact('category', 'products'));
    }

    /**
     * عرض منتج معين في تصنيف معين
     * Display a specific product in a category
     */
    public function show($categoryId, $productId)
    {
        // $category = Category::findOrFail($categoryId);
        // $product = $category->products()->findOrFail($productId);

        $category = [
            'id' => $categoryId,
            'name' => 'إلكترونيات'
        ];

        $product = [
            'id' => $productId,
            'category_id' => $categoryId,
            'name' => 'لابتوب Dell XPS 15',
            'price' => 5500,
            'description' => 'لابتوب عالي الأداء'
        ];

        return view('categories.products.show', compact('category', 'product'));
    }
}

/**
 * Routes للحل المتقدم:
 * في routes/web.php:
 *
 * use App\Http\Controllers\CategoryProductController;
 *
 * // Nested Resource Routes
 * Route::get('/categories/{category}/products',
 *     [CategoryProductController::class, 'index'])
 *     ->name('categories.products.index');
 *
 * Route::get('/categories/{category}/products/{product}',
 *     [CategoryProductController::class, 'show'])
 *     ->name('categories.products.show');
 */

/**
 * ==============================================
 * مثال على View للمنتجات في التصنيف
 * Example View for Category Products
 * ==============================================
 */

/**
 * اسم الملف: resources/views/categories/products.blade.php
 *
 * <!DOCTYPE html>
 * <html dir="rtl" lang="ar">
 * <head>
 *     <meta charset="UTF-8">
 *     <meta name="viewport" content="width=device-width, initial-scale=1.0">
 *     <title>منتجات {{ $category['name'] }}</title>
 *     <style>
 *         body {
 *             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
 *             max-width: 1200px;
 *             margin: 0 auto;
 *             padding: 20px;
 *             background: #f5f5f5;
 *         }
 *         .header {
 *             background: white;
 *             padding: 20px;
 *             border-radius: 8px;
 *             margin-bottom: 20px;
 *             box-shadow: 0 2px 4px rgba(0,0,0,0.1);
 *         }
 *         .breadcrumb {
 *             color: #666;
 *             margin-bottom: 10px;
 *         }
 *         .breadcrumb a {
 *             color: #007bff;
 *             text-decoration: none;
 *         }
 *         .products-grid {
 *             display: grid;
 *             grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
 *             gap: 20px;
 *         }
 *         .product-card {
 *             background: white;
 *             border-radius: 8px;
 *             padding: 20px;
 *             box-shadow: 0 2px 4px rgba(0,0,0,0.1);
 *             transition: transform 0.2s;
 *         }
 *         .product-card:hover {
 *             transform: translateY(-5px);
 *             box-shadow: 0 4px 8px rgba(0,0,0,0.15);
 *         }
 *         .product-name {
 *             font-size: 18px;
 *             font-weight: bold;
 *             margin-bottom: 10px;
 *             color: #333;
 *         }
 *         .product-price {
 *             font-size: 24px;
 *             color: #28a745;
 *             font-weight: bold;
 *             margin: 10px 0;
 *         }
 *         .product-description {
 *             color: #666;
 *             margin-bottom: 10px;
 *         }
 *         .product-stock {
 *             color: #007bff;
 *             font-size: 14px;
 *         }
 *         .no-products {
 *             text-align: center;
 *             padding: 40px;
 *             background: white;
 *             border-radius: 8px;
 *             color: #666;
 *         }
 *     </style>
 * </head>
 * <body>
 *     <div class="header">
 *         <div class="breadcrumb">
 *             <a href="/categories">التصنيفات</a> / {{ $category['name'] }}
 *         </div>
 *         <h1>منتجات {{ $category['name'] }}</h1>
 *         <p>{{ $category['description'] }}</p>
 *         <p><strong>عدد المنتجات:</strong> {{ count($products) }}</p>
 *     </div>
 *
 *     @if(count($products) > 0)
 *         <div class="products-grid">
 *             @foreach($products as $product)
 *                 <div class="product-card">
 *                     <div class="product-name">{{ $product['name'] }}</div>
 *                     <div class="product-price">{{ $product['price'] }} ريال</div>
 *                     <div class="product-description">{{ $product['description'] }}</div>
 *                     <div class="product-stock">المتوفر: {{ $product['stock'] }} قطعة</div>
 *                 </div>
 *             @endforeach
 *         </div>
 *     @else
 *         <div class="no-products">
 *             <h2>لا توجد منتجات في هذا التصنيف</h2>
 *             <p>سيتم إضافة منتجات قريباً</p>
 *         </div>
 *     @endif
 * </body>
 * </html>
 */

/**
 * ==============================================
 * أمثلة على الـ URLs الناتجة
 * Example URLs Generated
 * ==============================================
 */

/**
 * قائمة التصنيفات:
 * GET /categories
 * Route: categories.index
 *
 * تصنيف معين:
 * GET /categories/1
 * Route: categories.show
 *
 * منتجات تصنيف معين (المطلوب في التمرين):
 * GET /categories/1/products
 * Route: categories.products
 *
 * أمثلة:
 * - /categories/1/products  (منتجات الإلكترونيات)
 * - /categories/2/products  (منتجات الملابس)
 * - /categories/3/products  (منتجات الكتب)
 */

/**
 * ==============================================
 * استخدام Route Parameters في Blade
 * Using Route Parameters in Blade
 * ==============================================
 */

/**
 * في الـ View، يمكن إنشاء روابط للمنتجات:
 *
 * <a href="{{ route('categories.products', ['category' => $category['id']]) }}">
 *     عرض منتجات {{ $category['name'] }}
 * </a>
 *
 * أو باستخدام helper:
 *
 * <a href="{{ url('/categories/' . $category['id'] . '/products') }}">
 *     عرض المنتجات
 * </a>
 */

/**
 * ==============================================
 * أفضل الممارسات للـ Nested Resources
 * Best Practices for Nested Resources
 * ==============================================
 */

/**
 * ✅ افعل:
 *
 * 1. استخدم nested resources للعلاقات الواضحة
 *    (مثل: /categories/{id}/products)
 *
 * 2. لا تتجاوز مستويين من التداخل
 *    ✓ /categories/{id}/products
 *    ✗ /categories/{id}/products/{id}/reviews/{id}/comments
 *
 * 3. استخدم أسماء واضحة للـ routes
 *    ->name('categories.products')
 *
 * 4. تحقق من وجود الـ parent resource
 *    Category::findOrFail($categoryId)
 *
 * 5. استخدم Eager Loading لتحسين الأداء
 *    Category::with('products')->find($id)
 */

/**
 * ❌ لا تفعل:
 *
 * 1. لا تستخدم nested resources لعلاقات غير مباشرة
 * 2. لا تجعل الـ URLs طويلة جداً
 * 3. لا تنسى التحقق من وجود الـ parent
 * 4. لا تهمل الـ route names
 */

/**
 * ==============================================
 * أمثلة إضافية على Nested Resources
 * Additional Nested Resources Examples
 * ==============================================
 */

/**
 * مثال 1: المستخدمون والمشاركات
 * /users/{user}/posts
 *
 * مثال 2: المشاركات والتعليقات
 * /posts/{post}/comments
 *
 * مثال 3: الدورات والدروس
 * /courses/{course}/lessons
 *
 * مثال 4: الأقسام والموظفين
 * /departments/{department}/employees
 */

/**
 * ==============================================
 * الخلاصة
 * Summary
 * ==============================================
 */

/**
 * في هذا الحل تعلمنا:
 *
 * 1. كيفية إنشاء Nested Resources في Laravel
 * 2. كيفية تعريف routes للموارد المتداخلة
 * 3. كيفية عرض البيانات المفلترة حسب parent resource
 * 4. أفضل الممارسات للـ Nested Resources
 * 5. كيفية إنشاء URLs صديقة للمستخدم
 *
 * الـ Nested Resources مفيدة عندما:
 * - يكون هناك علاقة واضحة بين الموارد
 * - تريد عرض موارد فرعية لمورد رئيسي
 * - تريد URLs منظمة وواضحة
 */
