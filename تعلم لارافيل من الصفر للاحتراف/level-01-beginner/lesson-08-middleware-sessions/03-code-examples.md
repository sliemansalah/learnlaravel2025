# الدرس 8: أمثلة برمجية - Middleware والجلسات
# Lesson 8: Code Examples - Middleware and Sessions

**المستوى:** مبتدئ | Beginner

---

## 📑 جدول المحتويات | Table of Contents

1. [Middleware Examples](#middleware-examples)
2. [Session Examples](#session-examples)
3. [Flash Messages Examples](#flash-messages-examples)
4. [Real-World Scenarios](#real-world-scenarios)
5. [Advanced Patterns](#advanced-patterns)

---

## 🛡️ Middleware Examples

### مثال 1: Maintenance Mode Middleware

```php
<?php
// app/Http/Middleware/CheckMaintenanceMode.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق من وضع الصيانة
        if (config('app.maintenance_mode', false)) {
            // السماح لـ IPs معينة بالدخول
            $allowedIps = config('app.maintenance_allowed_ips', []);

            if (!in_array($request->ip(), $allowedIps)) {
                return response()->view('maintenance', [], 503);
            }
        }

        return $next($request);
    }
}
```

```php
// config/app.php

'maintenance_mode' => env('MAINTENANCE_MODE', false),
'maintenance_allowed_ips' => [
    '127.0.0.1',
    '192.168.1.100',
],
```

```blade
{{-- resources/views/maintenance.blade.php --}}

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الموقع قيد الصيانة</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            padding: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        h1 { font-size: 3rem; margin-bottom: 1rem; }
        p { font-size: 1.2rem; }
    </style>
</head>
<body>
    <h1>🔧 الموقع قيد الصيانة</h1>
    <p>نعمل حالياً على تحسين الموقع. سنعود قريباً!</p>
    <p>نعتذر عن الإزعاج.</p>
</body>
</html>
```

### مثال 2: API Rate Limiting Middleware

```php
<?php
// app/Http/Middleware/ApiRateLimit.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ApiRateLimit
{
    /**
     * الحد الأقصى للطلبات في الدقيقة
     */
    protected int $maxAttempts = 60;

    /**
     * فترة الانتظار بالدقائق
     */
    protected int $decayMinutes = 1;

    public function handle(Request $request, Closure $next): Response
    {
        $key = $this->resolveRequestSignature($request);

        // الحصول على عدد المحاولات الحالية
        $attempts = Cache::get($key, 0);

        if ($attempts >= $this->maxAttempts) {
            $retryAfter = Cache::get($key . ':timer', 60);

            return response()->json([
                'message' => 'لقد تجاوزت الحد الأقصى للطلبات',
                'retry_after' => $retryAfter
            ], 429);
        }

        // زيادة عدد المحاولات
        Cache::put($key, $attempts + 1, now()->addMinutes($this->decayMinutes));

        if ($attempts === 0) {
            Cache::put($key . ':timer', $this->decayMinutes * 60, now()->addMinutes($this->decayMinutes));
        }

        $response = $next($request);

        // إضافة headers للاستجابة
        return $this->addHeaders(
            $response,
            $this->maxAttempts,
            $this->calculateRemainingAttempts($key, $this->maxAttempts)
        );
    }

    /**
     * إنشاء مفتاح فريد للطلب
     */
    protected function resolveRequestSignature(Request $request): string
    {
        if ($user = $request->user()) {
            return 'rate_limit:' . $user->id;
        }

        return 'rate_limit:' . $request->ip();
    }

    /**
     * حساب المحاولات المتبقية
     */
    protected function calculateRemainingAttempts(string $key, int $maxAttempts): int
    {
        return max(0, $maxAttempts - Cache::get($key, 0));
    }

    /**
     * إضافة headers للاستجابة
     */
    protected function addHeaders(Response $response, int $maxAttempts, int $remainingAttempts): Response
    {
        $response->headers->add([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $remainingAttempts,
        ]);

        return $response;
    }
}
```

### مثال 3: Content Security Policy Middleware

```php
<?php
// app/Http/Middleware/AddSecurityHeaders.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddSecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Content Security Policy
        $response->headers->set('Content-Security-Policy',
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " .
            "font-src 'self' https://fonts.gstatic.com; " .
            "img-src 'self' data: https:;"
        );

        // منع XSS
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // منع MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // منع Clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // HTTPS فقط
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

        // منع Referrer leakage
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        return $response;
    }
}
```

### مثال 4: Trailing Slash Middleware

```php
<?php
// app/Http/Middleware/RemoveTrailingSlash.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveTrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        // إزالة / من نهاية الـ URL
        if ($path !== '/' && str_ends_with($path, '/')) {
            $newPath = rtrim($path, '/');

            return redirect($newPath, 301);
        }

        return $next($request);
    }
}
```

### مثال 5: Check User Status Middleware

```php
<?php
// app/Http/Middleware/CheckUserStatus.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // التحقق من حالة المستخدم
        if ($user->status === 'banned') {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'تم حظر حسابك. يرجى التواصل مع الإدارة.');
        }

        if ($user->status === 'suspended') {
            return redirect()->route('suspended')
                ->with('warning', 'حسابك معلق مؤقتاً.');
        }

        if ($user->status === 'pending_verification') {
            return redirect()->route('verify.email')
                ->with('info', 'يرجى تأكيد بريدك الإلكتروني أولاً.');
        }

        return $next($request);
    }
}
```

---

## 💾 Session Examples

### مثال 1: User Preferences System

```php
<?php
// app/Services/UserPreferencesService.php

namespace App\Services;

class UserPreferencesService
{
    /**
     * حفظ التفضيلات
     */
    public function save(array $preferences): void
    {
        session(['user_preferences' => array_merge(
            $this->get(),
            $preferences
        )]);
    }

    /**
     * الحصول على جميع التفضيلات
     */
    public function get(): array
    {
        return session('user_preferences', $this->defaults());
    }

    /**
     * الحصول على تفضيل معين
     */
    public function getPreference(string $key, $default = null)
    {
        return data_get($this->get(), $key, $default);
    }

    /**
     * التفضيلات الافتراضية
     */
    protected function defaults(): array
    {
        return [
            'theme' => 'light',
            'language' => 'ar',
            'notifications' => [
                'email' => true,
                'sms' => false,
                'push' => true,
            ],
            'display' => [
                'items_per_page' => 15,
                'date_format' => 'Y-m-d',
                'time_format' => 'H:i',
            ],
        ];
    }

    /**
     * إعادة تعيين التفضيلات
     */
    public function reset(): void
    {
        session(['user_preferences' => $this->defaults()]);
    }
}
```

```php
<?php
// app/Http/Controllers/PreferencesController.php

namespace App\Http\Controllers;

use App\Services\UserPreferencesService;
use Illuminate\Http\Request;

class PreferencesController extends Controller
{
    protected $preferences;

    public function __construct(UserPreferencesService $preferences)
    {
        $this->preferences = $preferences;
    }

    public function show()
    {
        $preferences = $this->preferences->get();
        return view('preferences.show', compact('preferences'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'theme' => 'required|in:light,dark',
            'language' => 'required|in:ar,en',
            'notifications.email' => 'boolean',
            'notifications.sms' => 'boolean',
            'notifications.push' => 'boolean',
            'display.items_per_page' => 'required|integer|min:10|max:100',
        ]);

        $this->preferences->save($validated);

        return redirect()->back()
            ->with('success', 'تم حفظ التفضيلات بنجاح');
    }

    public function reset()
    {
        $this->preferences->reset();

        return redirect()->back()
            ->with('success', 'تم إعادة تعيين التفضيلات للقيم الافتراضية');
    }
}
```

### مثال 2: Multi-Step Form with Session

```php
<?php
// app/Http/Controllers/RegistrationWizardController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationWizardController extends Controller
{
    /**
     * Step 1: المعلومات الأساسية
     */
    public function step1()
    {
        return view('registration.step1', [
            'data' => session('registration.step1', [])
        ]);
    }

    public function postStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // حفظ في Session
        session(['registration.step1' => $validated]);

        return redirect()->route('registration.step2');
    }

    /**
     * Step 2: المعلومات الشخصية
     */
    public function step2()
    {
        // التحقق من إكمال Step 1
        if (!session()->has('registration.step1')) {
            return redirect()->route('registration.step1')
                ->with('error', 'يجب إكمال الخطوة الأولى أولاً');
        }

        return view('registration.step2', [
            'data' => session('registration.step2', [])
        ]);
    }

    public function postStep2(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
        ]);

        session(['registration.step2' => $validated]);

        return redirect()->route('registration.step3');
    }

    /**
     * Step 3: المراجعة والتأكيد
     */
    public function step3()
    {
        if (!session()->has('registration.step1') || !session()->has('registration.step2')) {
            return redirect()->route('registration.step1');
        }

        $step1 = session('registration.step1');
        $step2 = session('registration.step2');

        return view('registration.step3', compact('step1', 'step2'));
    }

    public function complete(Request $request)
    {
        $step1 = session('registration.step1');
        $step2 = session('registration.step2');

        if (!$step1 || !$step2) {
            return redirect()->route('registration.step1');
        }

        // إنشاء المستخدم
        $user = User::create([
            'name' => $step1['name'],
            'email' => $step1['email'],
            'password' => Hash::make($step1['password']),
            'phone' => $step2['phone'],
            'address' => $step2['address'],
            'city' => $step2['city'],
            'country' => $step2['country'],
        ]);

        // مسح بيانات التسجيل من Session
        session()->forget(['registration.step1', 'registration.step2']);

        // تسجيل الدخول
        auth()->login($user);

        return redirect()->route('dashboard')
            ->with('success', 'تم إنشاء حسابك بنجاح!');
    }
}
```

### مثال 3: Recently Viewed Products

```php
<?php
// app/Services/RecentlyViewedService.php

namespace App\Services;

use App\Models\Product;

class RecentlyViewedService
{
    protected int $maxItems = 10;

    /**
     * إضافة منتج للمشاهدات الأخيرة
     */
    public function add(int $productId): void
    {
        $viewed = $this->getIds();

        // إزالة المنتج إذا كان موجوداً (لتجنب التكرار)
        $viewed = array_filter($viewed, fn($id) => $id !== $productId);

        // إضافة المنتج في البداية
        array_unshift($viewed, $productId);

        // الاحتفاظ بآخر X منتج فقط
        $viewed = array_slice($viewed, 0, $this->maxItems);

        session(['recently_viewed' => $viewed]);
    }

    /**
     * الحصول على IDs المنتجات
     */
    public function getIds(): array
    {
        return session('recently_viewed', []);
    }

    /**
     * الحصول على المنتجات
     */
    public function getProducts(): \Illuminate\Database\Eloquent\Collection
    {
        $ids = $this->getIds();

        if (empty($ids)) {
            return collect([]);
        }

        // جلب المنتجات بنفس الترتيب
        return Product::whereIn('id', $ids)
            ->get()
            ->sortBy(function($product) use ($ids) {
                return array_search($product->id, $ids);
            });
    }

    /**
     * مسح المشاهدات
     */
    public function clear(): void
    {
        session()->forget('recently_viewed');
    }
}
```

```php
<?php
// app/Http/Controllers/ProductController.php

public function show(Product $product, RecentlyViewedService $recentlyViewed)
{
    // إضافة للمشاهدات الأخيرة
    $recentlyViewed->add($product->id);

    return view('products.show', compact('product'));
}
```

### مثال 4: Wishlist System

```php
<?php
// app/Services/WishlistService.php

namespace App\Services;

use App\Models\Product;

class WishlistService
{
    /**
     * إضافة منتج للمفضلة
     */
    public function add(int $productId): bool
    {
        $wishlist = $this->getIds();

        if (in_array($productId, $wishlist)) {
            return false; // موجود مسبقاً
        }

        $wishlist[] = $productId;
        session(['wishlist' => $wishlist]);

        return true;
    }

    /**
     * حذف منتج من المفضلة
     */
    public function remove(int $productId): bool
    {
        $wishlist = $this->getIds();

        if (!in_array($productId, $wishlist)) {
            return false;
        }

        $wishlist = array_filter($wishlist, fn($id) => $id !== $productId);
        session(['wishlist' => array_values($wishlist)]);

        return true;
    }

    /**
     * تبديل حالة المنتج
     */
    public function toggle(int $productId): bool
    {
        if ($this->has($productId)) {
            $this->remove($productId);
            return false;
        }

        $this->add($productId);
        return true;
    }

    /**
     * التحقق من وجود منتج
     */
    public function has(int $productId): bool
    {
        return in_array($productId, $this->getIds());
    }

    /**
     * الحصول على IDs
     */
    public function getIds(): array
    {
        return session('wishlist', []);
    }

    /**
     * الحصول على المنتجات
     */
    public function getProducts(): \Illuminate\Database\Eloquent\Collection
    {
        $ids = $this->getIds();

        if (empty($ids)) {
            return collect([]);
        }

        return Product::whereIn('id', $ids)->get();
    }

    /**
     * عدد المنتجات
     */
    public function count(): int
    {
        return count($this->getIds());
    }

    /**
     * مسح المفضلة
     */
    public function clear(): void
    {
        session()->forget('wishlist');
    }
}
```

---

## ⚡ Flash Messages Examples

### مثال 1: Advanced Flash Messages with Types

```php
<?php
// app/Helpers/FlashMessage.php

namespace App\Helpers;

class FlashMessage
{
    /**
     * رسالة نجاح
     */
    public static function success(string $message, string $title = null): void
    {
        session()->flash('flash_message', [
            'type' => 'success',
            'title' => $title ?? 'نجح!',
            'message' => $message,
            'icon' => '✓',
        ]);
    }

    /**
     * رسالة خطأ
     */
    public static function error(string $message, string $title = null): void
    {
        session()->flash('flash_message', [
            'type' => 'error',
            'title' => $title ?? 'خطأ!',
            'message' => $message,
            'icon' => '✕',
        ]);
    }

    /**
     * رسالة تحذير
     */
    public static function warning(string $message, string $title = null): void
    {
        session()->flash('flash_message', [
            'type' => 'warning',
            'title' => $title ?? 'تحذير!',
            'message' => $message,
            'icon' => '⚠',
        ]);
    }

    /**
     * رسالة معلومة
     */
    public static function info(string $message, string $title = null): void
    {
        session()->flash('flash_message', [
            'type' => 'info',
            'title' => $title ?? 'معلومة',
            'message' => $message,
            'icon' => 'ℹ',
        ]);
    }

    /**
     * رسالة مخصصة
     */
    public static function custom(string $type, string $message, string $title, string $icon): void
    {
        session()->flash('flash_message', [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'icon' => $icon,
        ]);
    }

    /**
     * رسالة مع أكشن
     */
    public static function withAction(string $type, string $message, string $actionText, string $actionUrl): void
    {
        session()->flash('flash_message', [
            'type' => $type,
            'message' => $message,
            'action' => [
                'text' => $actionText,
                'url' => $actionUrl,
            ],
        ]);
    }
}
```

### مثال 2: Toast Notifications

```blade
{{-- resources/views/components/toast.blade.php --}}

@if(session('flash_message'))
    @php
        $flash = session('flash_message');
    @endphp

    <div class="toast toast-{{ $flash['type'] }}" role="alert">
        <div class="toast-header">
            <span class="toast-icon">{{ $flash['icon'] ?? '' }}</span>
            <strong>{{ $flash['title'] ?? '' }}</strong>
            <button type="button" class="toast-close" onclick="this.parentElement.parentElement.remove()">
                ×
            </button>
        </div>
        <div class="toast-body">
            {{ $flash['message'] }}

            @if(isset($flash['action']))
                <a href="{{ $flash['action']['url'] }}" class="toast-action">
                    {{ $flash['action']['text'] }}
                </a>
            @endif
        </div>
    </div>

    <script>
        // Auto-hide after 5 seconds
        setTimeout(() => {
            document.querySelector('.toast')?.remove();
        }, 5000);
    </script>

    <style>
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 300px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .toast-header {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .toast-icon {
            font-size: 20px;
        }
        .toast-success .toast-icon { color: #10b981; }
        .toast-error .toast-icon { color: #ef4444; }
        .toast-warning .toast-icon { color: #f59e0b; }
        .toast-info .toast-icon { color: #3b82f6; }
        .toast-close {
            margin-left: auto;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #6b7280;
        }
        .toast-body {
            padding: 12px 16px;
            color: #374151;
        }
        .toast-action {
            display: inline-block;
            margin-top: 8px;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
@endif
```

---

## 🌍 Real-World Scenarios

### سيناريو 1: نظام الإشعارات الكامل

```php
<?php
// app/Services/NotificationService.php

namespace App\Services;

class NotificationService
{
    /**
     * إضافة إشعار
     */
    public function add(string $type, string $message, array $data = []): void
    {
        $notifications = session('notifications', []);

        $notifications[] = [
            'id' => uniqid(),
            'type' => $type,
            'message' => $message,
            'data' => $data,
            'read' => false,
            'created_at' => now()->toDateTimeString(),
        ];

        session(['notifications' => $notifications]);
    }

    /**
     * الحصول على الإشعارات
     */
    public function getAll(): array
    {
        return session('notifications', []);
    }

    /**
     * الإشعارات غير المقروءة
     */
    public function getUnread(): array
    {
        return array_filter($this->getAll(), fn($n) => !$n['read']);
    }

    /**
     * عدد غير المقروءة
     */
    public function getUnreadCount(): int
    {
        return count($this->getUnread());
    }

    /**
     * تعليم كمقروء
     */
    public function markAsRead(string $id): void
    {
        $notifications = $this->getAll();

        foreach ($notifications as &$notification) {
            if ($notification['id'] === $id) {
                $notification['read'] = true;
                break;
            }
        }

        session(['notifications' => $notifications]);
    }

    /**
     * تعليم الكل كمقروء
     */
    public function markAllAsRead(): void
    {
        $notifications = $this->getAll();

        foreach ($notifications as &$notification) {
            $notification['read'] = true;
        }

        session(['notifications' => $notifications]);
    }

    /**
     * حذف إشعار
     */
    public function delete(string $id): void
    {
        $notifications = array_filter(
            $this->getAll(),
            fn($n) => $n['id'] !== $id
        );

        session(['notifications' => array_values($notifications)]);
    }

    /**
     * مسح الكل
     */
    public function clear(): void
    {
        session()->forget('notifications');
    }
}
```

### سيناريو 2: Session-based Search History

```php
<?php
// app/Services/SearchHistoryService.php

namespace App\Services;

class SearchHistoryService
{
    protected int $maxHistory = 20;

    /**
     * إضافة بحث للتاريخ
     */
    public function add(string $query): void
    {
        if (empty(trim($query))) {
            return;
        }

        $history = $this->getAll();

        // إزالة إذا كان موجوداً
        $history = array_filter($history, function($item) use ($query) {
            return $item['query'] !== $query;
        });

        // إضافة في البداية
        array_unshift($history, [
            'query' => $query,
            'timestamp' => now()->toDateTimeString(),
        ]);

        // الاحتفاظ بآخر X فقط
        $history = array_slice($history, 0, $this->maxHistory);

        session(['search_history' => $history]);
    }

    /**
     * الحصول على التاريخ
     */
    public function getAll(): array
    {
        return session('search_history', []);
    }

    /**
     * الحصول على آخر X بحث
     */
    public function getRecent(int $limit = 5): array
    {
        return array_slice($this->getAll(), 0, $limit);
    }

    /**
     * البحث في التاريخ
     */
    public function search(string $query): array
    {
        return array_filter($this->getAll(), function($item) use ($query) {
            return str_contains(strtolower($item['query']), strtolower($query));
        });
    }

    /**
     * حذف بحث
     */
    public function remove(string $query): void
    {
        $history = array_filter($this->getAll(), function($item) use ($query) {
            return $item['query'] !== $query;
        });

        session(['search_history' => array_values($history)]);
    }

    /**
     * مسح التاريخ
     */
    public function clear(): void
    {
        session()->forget('search_history');
    }
}
```

---

## 🔥 Advanced Patterns

### Pattern 1: Middleware Pipeline

```php
<?php
// app/Http/Middleware/MiddlewarePipeline.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Symfony\Component\HttpFoundation\Response;

class MiddlewarePipeline
{
    protected array $pipes = [];

    public function handle(Request $request, Closure $next): Response
    {
        return Pipeline::send($request)
            ->through($this->pipes)
            ->then(function ($request) use ($next) {
                return $next($request);
            });
    }

    public function add(string $middleware): self
    {
        $this->pipes[] = $middleware;
        return $this;
    }
}
```

### Pattern 2: Conditional Middleware

```php
<?php
// app/Http/Middleware/ConditionalMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConditionalMiddleware
{
    public function handle(Request $request, Closure $next, string $condition): Response
    {
        $shouldApply = match($condition) {
            'weekday' => now()->isWeekday(),
            'weekend' => now()->isWeekend(),
            'business_hours' => $this->isBusinessHours(),
            'authenticated' => auth()->check(),
            'guest' => auth()->guest(),
            default => true,
        };

        if (!$shouldApply) {
            return $next($request);
        }

        // Apply middleware logic here
        return $next($request);
    }

    protected function isBusinessHours(): bool
    {
        $hour = now()->hour;
        return $hour >= 9 && $hour < 17;
    }
}
```

### Pattern 3: Session Encryption Service

```php
<?php
// app/Services/SecureSessionService.php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;

class SecureSessionService
{
    /**
     * حفظ بيانات مشفرة
     */
    public function putEncrypted(string $key, $value): void
    {
        $encrypted = Crypt::encryptString(serialize($value));
        session([$key => $encrypted]);
    }

    /**
     * استرجاع بيانات مشفرة
     */
    public function getEncrypted(string $key, $default = null)
    {
        if (!session()->has($key)) {
            return $default;
        }

        try {
            $decrypted = Crypt::decryptString(session($key));
            return unserialize($decrypted);
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * حذف بيانات مشفرة
     */
    public function forgetEncrypted(string $key): void
    {
        session()->forget($key);
    }
}
```

---

## 📝 ملخص | Summary

هذه الأمثلة تغطي:

1. ✅ **Middleware المتقدمة**
   - Maintenance Mode
   - Rate Limiting
   - Security Headers
   - URL Normalization

2. ✅ **Session Patterns**
   - User Preferences
   - Multi-Step Forms
   - Recently Viewed
   - Wishlist

3. ✅ **Flash Messages**
   - Advanced Flash System
   - Toast Notifications
   - Custom Alerts

4. ✅ **Real-World Scenarios**
   - Notification System
   - Search History
   - Session Encryption

5. ✅ **Advanced Patterns**
   - Middleware Pipeline
   - Conditional Logic
   - Secure Sessions

---

**📌 ملاحظة:** جميع الأمثلة جاهزة للاستخدام ويمكن تخصيصها حسب احتياجاتك!

**تاريخ آخر تحديث:** 2025-11-03
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
