<?php
/**
 * ==============================================
 * الحل: تمرين 3 - SearchController (Single Action)
 * Solution: Exercise 3 - SearchController (Single Action)
 * ==============================================
 *
 * الهدف من التمرين:
 * - إنشاء Single Action Controller
 * - استقبال كلمة بحث من المستخدم
 * - البحث في مصادر متعددة (منتجات، مقالات، مستخدمين)
 * - إرجاع نتائج شاملة من جميع المصادر
 *
 * المكان المناسب لهذا الكود:
 * app/Http/Controllers/SearchController.php
 * ==============================================
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * ==============================================
 * الحل الأساسي: Single Action Controller
 * Basic Solution: Single Action Controller
 * ==============================================
 */

/**
 * لإنشاء هذا الـ Controller:
 * php artisan make:controller SearchController --invokable
 *
 * اسم الملف: app/Http/Controllers/SearchController.php
 *
 * Single Action Controller يحتوي على method واحدة فقط
 * اسمها __invoke
 */
class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     * معالجة طلب البحث
     *
     * GET /search?q=كلمة البحث
     * POST /search
     */
    public function __invoke(Request $request)
    {
        // الحصول على كلمة البحث من الـ request
        $query = $request->input('q');

        // التحقق من وجود كلمة بحث
        if (empty($query)) {
            return view('search.index', [
                'query' => '',
                'results' => [],
                'message' => 'الرجاء إدخال كلمة بحث'
            ]);
        }

        // البحث في مصادر متعددة
        $results = [
            'products' => $this->searchProducts($query),
            'articles' => $this->searchArticles($query),
            'users' => $this->searchUsers($query),
            'categories' => $this->searchCategories($query),
        ];

        // حساب إجمالي النتائج
        $totalResults = count($results['products']) +
                       count($results['articles']) +
                       count($results['users']) +
                       count($results['categories']);

        return view('search.results', [
            'query' => $query,
            'results' => $results,
            'totalResults' => $totalResults
        ]);
    }

    /**
     * البحث في المنتجات
     * Search in products
     */
    private function searchProducts($query)
    {
        // في الواقع، نستخدم:
        // return Product::where('name', 'LIKE', "%{$query}%")
        //     ->orWhere('description', 'LIKE', "%{$query}%")
        //     ->limit(10)
        //     ->get();

        $allProducts = [
            ['id' => 1, 'name' => 'لابتوب Dell XPS 15', 'price' => 5500, 'category' => 'إلكترونيات'],
            ['id' => 2, 'name' => 'هاتف iPhone 15 Pro', 'price' => 4200, 'category' => 'إلكترونيات'],
            ['id' => 3, 'name' => 'سماعات Sony', 'price' => 1200, 'category' => 'إلكترونيات'],
            ['id' => 4, 'name' => 'قميص قطني', 'price' => 150, 'category' => 'ملابس'],
            ['id' => 5, 'name' => 'كتاب تعلم Laravel', 'price' => 85, 'category' => 'كتب'],
            ['id' => 6, 'name' => 'لابتوب HP Pavilion', 'price' => 3500, 'category' => 'إلكترونيات'],
            ['id' => 7, 'name' => 'هاتف Samsung Galaxy', 'price' => 3000, 'category' => 'إلكترونيات'],
        ];

        // فلترة المنتجات التي تحتوي على كلمة البحث
        return array_values(array_filter($allProducts, function($product) use ($query) {
            return stripos($product['name'], $query) !== false ||
                   stripos($product['category'], $query) !== false;
        }));
    }

    /**
     * البحث في المقالات
     * Search in articles
     */
    private function searchArticles($query)
    {
        // في الواقع، نستخدم:
        // return Article::where('title', 'LIKE', "%{$query}%")
        //     ->orWhere('content', 'LIKE', "%{$query}%")
        //     ->limit(10)
        //     ->get();

        $allArticles = [
            ['id' => 1, 'title' => 'تعلم Laravel من الصفر', 'author' => 'أحمد محمد', 'date' => '2025-11-01'],
            ['id' => 2, 'title' => 'أساسيات PHP للمبتدئين', 'author' => 'محمد علي', 'date' => '2025-11-02'],
            ['id' => 3, 'title' => 'دليل شامل لـ MySQL', 'author' => 'سارة أحمد', 'date' => '2025-11-03'],
            ['id' => 4, 'title' => 'تطوير تطبيقات Laravel احترافية', 'author' => 'أحمد محمد', 'date' => '2025-11-04'],
            ['id' => 5, 'title' => 'مقدمة في البرمجة الكائنية', 'author' => 'فاطمة حسن', 'date' => '2025-11-05'],
        ];

        return array_values(array_filter($allArticles, function($article) use ($query) {
            return stripos($article['title'], $query) !== false;
        }));
    }

    /**
     * البحث في المستخدمين
     * Search in users
     */
    private function searchUsers($query)
    {
        // في الواقع، نستخدم:
        // return User::where('name', 'LIKE', "%{$query}%")
        //     ->orWhere('email', 'LIKE', "%{$query}%")
        //     ->limit(10)
        //     ->get();

        $allUsers = [
            ['id' => 1, 'name' => 'أحمد محمد', 'email' => 'ahmed@example.com', 'role' => 'مدير'],
            ['id' => 2, 'name' => 'محمد علي', 'email' => 'mohamed@example.com', 'role' => 'كاتب'],
            ['id' => 3, 'name' => 'سارة أحمد', 'email' => 'sara@example.com', 'role' => 'محرر'],
            ['id' => 4, 'name' => 'فاطمة حسن', 'email' => 'fatima@example.com', 'role' => 'كاتب'],
            ['id' => 5, 'name' => 'أحمد حسين', 'email' => 'ahmed.h@example.com', 'role' => 'مشرف'],
        ];

        return array_values(array_filter($allUsers, function($user) use ($query) {
            return stripos($user['name'], $query) !== false ||
                   stripos($user['email'], $query) !== false;
        }));
    }

    /**
     * البحث في التصنيفات
     * Search in categories
     */
    private function searchCategories($query)
    {
        // في الواقع، نستخدم:
        // return Category::where('name', 'LIKE', "%{$query}%")
        //     ->orWhere('description', 'LIKE', "%{$query}%")
        //     ->limit(10)
        //     ->get();

        $allCategories = [
            ['id' => 1, 'name' => 'إلكترونيات', 'products_count' => 15],
            ['id' => 2, 'name' => 'ملابس', 'products_count' => 42],
            ['id' => 3, 'name' => 'كتب', 'products_count' => 28],
            ['id' => 4, 'name' => 'رياضة', 'products_count' => 19],
        ];

        return array_values(array_filter($allCategories, function($category) use ($query) {
            return stripos($category['name'], $query) !== false;
        }));
    }
}

/**
 * ==============================================
 * Routes للـ SearchController
 * Routes for SearchController
 * ==============================================
 */

/**
 * في routes/web.php:
 *
 * use App\Http\Controllers\SearchController;
 *
 * // عند استخدام Single Action Controller،
 * // نمرر اسم الـ class مباشرة بدون array
 * Route::get('/search', SearchController::class)->name('search');
 *
 * // يمكن أيضاً استقبال POST
 * Route::match(['get', 'post'], '/search', SearchController::class)->name('search');
 */

/**
 * ==============================================
 * حل متقدم: SearchController مع Validation
 * Advanced Solution: SearchController with Validation
 * ==============================================
 */

/**
 * نسخة محسنة مع validation وإدارة أفضل للأخطاء
 */
class AdvancedSearchController extends Controller
{
    /**
     * الحد الأقصى لعدد النتائج من كل مصدر
     */
    private const MAX_RESULTS_PER_SOURCE = 10;

    /**
     * الحد الأدنى لطول كلمة البحث
     */
    private const MIN_SEARCH_LENGTH = 2;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // التحقق من البيانات
        $validated = $request->validate([
            'q' => 'nullable|string|min:' . self::MIN_SEARCH_LENGTH . '|max:100',
            'type' => 'nullable|in:all,products,articles,users,categories'
        ]);

        $query = $validated['q'] ?? '';
        $searchType = $validated['type'] ?? 'all';

        // إذا لم يكن هناك استعلام، عرض صفحة البحث الفارغة
        if (empty($query)) {
            return view('search.index', [
                'query' => '',
                'searchType' => $searchType
            ]);
        }

        // تنظيف كلمة البحث
        $query = trim($query);

        // البحث حسب النوع المحدد
        $results = $this->performSearch($query, $searchType);

        // حساب إجمالي النتائج
        $totalResults = $this->calculateTotalResults($results);

        // حفظ في سجل البحث (اختياري)
        // $this->logSearch($query, $totalResults);

        return view('search.results', [
            'query' => $query,
            'results' => $results,
            'totalResults' => $totalResults,
            'searchType' => $searchType,
            'executionTime' => $this->getExecutionTime()
        ]);
    }

    /**
     * تنفيذ البحث حسب النوع
     */
    private function performSearch($query, $type)
    {
        $results = [];

        switch ($type) {
            case 'products':
                $results['products'] = $this->searchProducts($query);
                break;
            case 'articles':
                $results['articles'] = $this->searchArticles($query);
                break;
            case 'users':
                $results['users'] = $this->searchUsers($query);
                break;
            case 'categories':
                $results['categories'] = $this->searchCategories($query);
                break;
            case 'all':
            default:
                $results = [
                    'products' => $this->searchProducts($query),
                    'articles' => $this->searchArticles($query),
                    'users' => $this->searchUsers($query),
                    'categories' => $this->searchCategories($query),
                ];
                break;
        }

        return $results;
    }

    /**
     * حساب إجمالي النتائج
     */
    private function calculateTotalResults($results)
    {
        $total = 0;
        foreach ($results as $items) {
            $total += count($items);
        }
        return $total;
    }

    /**
     * حساب وقت التنفيذ
     */
    private function getExecutionTime()
    {
        // في الواقع، نحسب الوقت الفعلي
        return '0.05'; // ثانية
    }

    // نفس methods البحث من الحل الأساسي...
    private function searchProducts($query) { /* ... */ }
    private function searchArticles($query) { /* ... */ }
    private function searchUsers($query) { /* ... */ }
    private function searchCategories($query) { /* ... */ }
}

/**
 * ==============================================
 * حل للـ API: JSON Response
 * API Solution: JSON Response
 * ==============================================
 */

/**
 * نسخة API ترجع JSON بدلاً من View
 *
 * لإنشاء:
 * php artisan make:controller Api/SearchController --invokable
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiSearchController extends Controller
{
    /**
     * Handle the incoming request.
     * POST /api/search
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'q' => 'required|string|min:2|max:100',
            'type' => 'nullable|in:all,products,articles,users,categories',
            'limit' => 'nullable|integer|min:1|max:50'
        ]);

        $query = $validated['q'];
        $type = $validated['type'] ?? 'all';
        $limit = $validated['limit'] ?? 10;

        // البحث في المصادر
        $results = [
            'products' => $this->searchProducts($query, $limit),
            'articles' => $this->searchArticles($query, $limit),
            'users' => $this->searchUsers($query, $limit),
            'categories' => $this->searchCategories($query, $limit),
        ];

        $totalResults = array_sum(array_map('count', $results));

        return response()->json([
            'success' => true,
            'query' => $query,
            'total_results' => $totalResults,
            'results' => $results,
            'execution_time' => '0.05s'
        ]);
    }

    private function searchProducts($query, $limit) { /* ... */ }
    private function searchArticles($query, $limit) { /* ... */ }
    private function searchUsers($query, $limit) { /* ... */ }
    private function searchCategories($query, $limit) { /* ... */ }
}

/**
 * في routes/api.php:
 *
 * use App\Http\Controllers\Api\ApiSearchController;
 *
 * Route::post('/search', ApiSearchController::class);
 */

/**
 * ==============================================
 * مثال على View لنتائج البحث
 * Example Search Results View
 * ==============================================
 */

/**
 * اسم الملف: resources/views/search/results.blade.php
 *
 * <!DOCTYPE html>
 * <html dir="rtl" lang="ar">
 * <head>
 *     <meta charset="UTF-8">
 *     <meta name="viewport" content="width=device-width, initial-scale=1.0">
 *     <title>نتائج البحث: {{ $query }}</title>
 *     <style>
 *         body {
 *             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
 *             max-width: 1200px;
 *             margin: 0 auto;
 *             padding: 20px;
 *             background: #f5f5f5;
 *         }
 *         .search-header {
 *             background: white;
 *             padding: 30px;
 *             border-radius: 8px;
 *             margin-bottom: 20px;
 *             box-shadow: 0 2px 4px rgba(0,0,0,0.1);
 *         }
 *         .search-box {
 *             display: flex;
 *             gap: 10px;
 *         }
 *         .search-box input {
 *             flex: 1;
 *             padding: 12px;
 *             font-size: 16px;
 *             border: 2px solid #ddd;
 *             border-radius: 4px;
 *         }
 *         .search-box button {
 *             padding: 12px 30px;
 *             background: #007bff;
 *             color: white;
 *             border: none;
 *             border-radius: 4px;
 *             cursor: pointer;
 *         }
 *         .search-stats {
 *             margin-top: 15px;
 *             color: #666;
 *         }
 *         .results-section {
 *             background: white;
 *             padding: 20px;
 *             border-radius: 8px;
 *             margin-bottom: 20px;
 *             box-shadow: 0 2px 4px rgba(0,0,0,0.1);
 *         }
 *         .section-title {
 *             font-size: 20px;
 *             font-weight: bold;
 *             margin-bottom: 15px;
 *             color: #333;
 *             border-bottom: 2px solid #007bff;
 *             padding-bottom: 10px;
 *         }
 *         .result-item {
 *             padding: 15px;
 *             border-bottom: 1px solid #eee;
 *         }
 *         .result-item:last-child {
 *             border-bottom: none;
 *         }
 *         .result-title {
 *             font-size: 18px;
 *             color: #007bff;
 *             margin-bottom: 5px;
 *         }
 *         .result-meta {
 *             color: #666;
 *             font-size: 14px;
 *         }
 *         .no-results {
 *             text-align: center;
 *             padding: 40px;
 *             color: #999;
 *         }
 *         .highlight {
 *             background: #ffeb3b;
 *             padding: 2px 4px;
 *             border-radius: 2px;
 *         }
 *     </style>
 * </head>
 * <body>
 *     <div class="search-header">
 *         <form action="{{ route('search') }}" method="GET">
 *             <div class="search-box">
 *                 <input type="text" name="q" value="{{ $query }}"
 *                        placeholder="ابحث عن منتجات، مقالات، مستخدمين..." required>
 *                 <button type="submit">بحث</button>
 *             </div>
 *         </form>
 *         <div class="search-stats">
 *             وجدنا <strong>{{ $totalResults }}</strong> نتيجة لـ "{{ $query }}"
 *         </div>
 *     </div>
 *
 *     @if($totalResults > 0)
 *         <!-- المنتجات -->
 *         @if(isset($results['products']) && count($results['products']) > 0)
 *             <div class="results-section">
 *                 <h2 class="section-title">المنتجات ({{ count($results['products']) }})</h2>
 *                 @foreach($results['products'] as $product)
 *                     <div class="result-item">
 *                         <div class="result-title">{{ $product['name'] }}</div>
 *                         <div class="result-meta">
 *                             السعر: {{ $product['price'] }} ريال | التصنيف: {{ $product['category'] }}
 *                         </div>
 *                     </div>
 *                 @endforeach
 *             </div>
 *         @endif
 *
 *         <!-- المقالات -->
 *         @if(isset($results['articles']) && count($results['articles']) > 0)
 *             <div class="results-section">
 *                 <h2 class="section-title">المقالات ({{ count($results['articles']) }})</h2>
 *                 @foreach($results['articles'] as $article)
 *                     <div class="result-item">
 *                         <div class="result-title">{{ $article['title'] }}</div>
 *                         <div class="result-meta">
 *                             بواسطة: {{ $article['author'] }} | {{ $article['date'] }}
 *                         </div>
 *                     </div>
 *                 @endforeach
 *             </div>
 *         @endif
 *
 *         <!-- المستخدمون -->
 *         @if(isset($results['users']) && count($results['users']) > 0)
 *             <div class="results-section">
 *                 <h2 class="section-title">المستخدمون ({{ count($results['users']) }})</h2>
 *                 @foreach($results['users'] as $user)
 *                     <div class="result-item">
 *                         <div class="result-title">{{ $user['name'] }}</div>
 *                         <div class="result-meta">
 *                             {{ $user['email'] }} | {{ $user['role'] }}
 *                         </div>
 *                     </div>
 *                 @endforeach
 *             </div>
 *         @endif
 *
 *         <!-- التصنيفات -->
 *         @if(isset($results['categories']) && count($results['categories']) > 0)
 *             <div class="results-section">
 *                 <h2 class="section-title">التصنيفات ({{ count($results['categories']) }})</h2>
 *                 @foreach($results['categories'] as $category)
 *                     <div class="result-item">
 *                         <div class="result-title">{{ $category['name'] }}</div>
 *                         <div class="result-meta">
 *                             {{ $category['products_count'] }} منتج
 *                         </div>
 *                     </div>
 *                 @endforeach
 *             </div>
 *         @endif
 *     @else
 *         <div class="results-section">
 *             <div class="no-results">
 *                 <h2>لا توجد نتائج</h2>
 *                 <p>لم نجد أي نتائج مطابقة لكلمة البحث "{{ $query }}"</p>
 *                 <p>جرب استخدام كلمات مختلفة أو أقل تحديداً</p>
 *             </div>
 *         </div>
 *     @endif
 * </body>
 * </html>
 */

/**
 * ==============================================
 * مثال على صفحة البحث الرئيسية
 * Example Main Search Page
 * ==============================================
 */

/**
 * اسم الملف: resources/views/search/index.blade.php
 *
 * <!DOCTYPE html>
 * <html dir="rtl" lang="ar">
 * <head>
 *     <meta charset="UTF-8">
 *     <meta name="viewport" content="width=device-width, initial-scale=1.0">
 *     <title>البحث</title>
 *     <style>
 *         body {
 *             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
 *             display: flex;
 *             justify-content: center;
 *             align-items: center;
 *             min-height: 100vh;
 *             background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
 *             margin: 0;
 *             padding: 20px;
 *         }
 *         .search-container {
 *             background: white;
 *             padding: 50px;
 *             border-radius: 10px;
 *             box-shadow: 0 10px 40px rgba(0,0,0,0.2);
 *             max-width: 600px;
 *             width: 100%;
 *         }
 *         h1 {
 *             text-align: center;
 *             color: #333;
 *             margin-bottom: 30px;
 *         }
 *         .search-form {
 *             display: flex;
 *             gap: 10px;
 *         }
 *         input[type="text"] {
 *             flex: 1;
 *             padding: 15px;
 *             font-size: 18px;
 *             border: 2px solid #ddd;
 *             border-radius: 5px;
 *         }
 *         button {
 *             padding: 15px 40px;
 *             font-size: 18px;
 *             background: #667eea;
 *             color: white;
 *             border: none;
 *             border-radius: 5px;
 *             cursor: pointer;
 *         }
 *         .suggestions {
 *             margin-top: 30px;
 *             text-align: center;
 *             color: #666;
 *         }
 *         .suggestion-tags {
 *             display: flex;
 *             flex-wrap: wrap;
 *             gap: 10px;
 *             justify-content: center;
 *             margin-top: 10px;
 *         }
 *         .tag {
 *             background: #f0f0f0;
 *             padding: 8px 15px;
 *             border-radius: 20px;
 *             color: #666;
 *             cursor: pointer;
 *         }
 *     </style>
 * </head>
 * <body>
 *     <div class="search-container">
 *         <h1>ابحث في موقعنا</h1>
 *         <form action="{{ route('search') }}" method="GET" class="search-form">
 *             <input type="text" name="q" placeholder="ابحث عن أي شيء..." required>
 *             <button type="submit">بحث</button>
 *         </form>
 *         <div class="suggestions">
 *             <p>اقتراحات البحث:</p>
 *             <div class="suggestion-tags">
 *                 <span class="tag">لابتوب</span>
 *                 <span class="tag">Laravel</span>
 *                 <span class="tag">أحمد</span>
 *                 <span class="tag">إلكترونيات</span>
 *             </div>
 *         </div>
 *     </div>
 * </body>
 * </html>
 */

/**
 * ==============================================
 * أمثلة على استخدام الـ API
 * API Usage Examples
 * ==============================================
 */

/**
 * JavaScript Example (Fetch API):
 *
 * fetch('/api/search', {
 *     method: 'POST',
 *     headers: {
 *         'Content-Type': 'application/json',
 *         'Accept': 'application/json'
 *     },
 *     body: JSON.stringify({
 *         q: 'لابتوب',
 *         type: 'all',
 *         limit: 10
 *     })
 * })
 * .then(response => response.json())
 * .then(data => {
 *     console.log('Total Results:', data.total_results);
 *     console.log('Products:', data.results.products);
 *     console.log('Articles:', data.results.articles);
 * });
 */

/**
 * cURL Example:
 *
 * curl -X POST http://localhost:8000/api/search \
 *   -H "Content-Type: application/json" \
 *   -H "Accept: application/json" \
 *   -d '{"q":"لابتوب","type":"all","limit":10}'
 */

/**
 * ==============================================
 * أفضل الممارسات للـ Search
 * Best Practices for Search
 * ==============================================
 */

/**
 * ✅ افعل:
 *
 * 1. استخدم Full-Text Search للبحث في النصوص الكبيرة
 *    - في MySQL: FULLTEXT index
 *    - أو استخدم Laravel Scout مع Algolia/Meilisearch
 *
 * 2. قم بعمل Index للأعمدة التي تبحث فيها
 *    - يحسن الأداء بشكل كبير
 *
 * 3. ضع حد أقصى لعدد النتائج
 *    - لا تحمل آلاف النتائج مرة واحدة
 *
 * 4. استخدم Pagination للنتائج الكثيرة
 *    - $results->paginate(20)
 *
 * 5. احفظ سجل البحث للتحليل
 *    - معرفة ما يبحث عنه المستخدمون
 *
 * 6. استخدم Cache للاستعلامات الشائعة
 *    - Cache::remember("search:{$query}", 3600, function() { ... })
 *
 * 7. نظف input المستخدم
 *    - منع SQL Injection
 *    - trim(), strip_tags()
 */

/**
 * ❌ لا تفعل:
 *
 * 1. لا تستخدم LIKE '%term%' على جداول كبيرة بدون index
 * 2. لا تبحث في جميع الأعمدة بدون داعي
 * 3. لا تنسى validation لـ input المستخدم
 * 4. لا ترجع بيانات حساسة في نتائج البحث
 * 5. لا تنفذ استعلامات متعددة بدون optimization
 */

/**
 * ==============================================
 * تحسينات متقدمة
 * Advanced Optimizations
 * ==============================================
 */

/**
 * 1. استخدام Laravel Scout:
 *
 * composer require laravel/scout
 *
 * في Model:
 * use Laravel\Scout\Searchable;
 *
 * class Product extends Model
 * {
 *     use Searchable;
 * }
 *
 * في Controller:
 * $products = Product::search($query)->get();
 */

/**
 * 2. استخدام Elasticsearch:
 *
 * - أداء عالي جداً
 * - بحث معقد
 * - تحليل النصوص
 * - اقتراحات ذكية
 */

/**
 * 3. استخدام MySQL Full-Text Search:
 *
 * في Migration:
 * $table->fullText(['name', 'description']);
 *
 * في Query:
 * DB::table('products')
 *     ->whereRaw('MATCH(name, description) AGAINST(? IN BOOLEAN MODE)', [$query])
 *     ->get();
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
 * 1. كيفية إنشاء Single Action Controller باستخدام __invoke
 * 2. كيفية البحث في مصادر متعددة
 * 3. كيفية إرجاع نتائج شاملة للمستخدم
 * 4. أفضل الممارسات للبحث في Laravel
 * 5. كيفية إنشاء API endpoint للبحث
 * 6. تحسينات وoptimizations للأداء
 *
 * Single Action Controller مناسب عندما:
 * - Controller يقوم بوظيفة واحدة فقط
 * - لا تحتاج لـ CRUD operations
 * - الوظيفة محددة وواضحة (مثل البحث، التصدير، إلخ)
 */
