# حل التمرين 3: إنشاء Controller
# Exercise 3 Solution

---

## 💻 الحل الكامل

### 1. ProductController

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $products = [
        ['id' => 1, 'name' => 'لابتوب HP', 'price' => 3000, 'description' => 'لابتوب قوي للعمل'],
        ['id' => 2, 'name' => 'هاتف Samsung', 'price' => 2000, 'description' => 'هاتف ذكي حديث'],
        ['id' => 3, 'name' => 'سماعات Sony', 'price' => 500, 'description' => 'سماعات عالية الجودة'],
    ];

    public function index()
    {
        $products = $this->products;
        return view('products', compact('products'));
    }

    public function show($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);

        if (!$product) {
            abort(404, 'المنتج غير موجود');
        }

        return view('product-details', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $results = collect($this->products)->filter(function ($product) use ($query) {
            return str_contains($product['name'], $query);
        });

        return view('products', ['products' => $results]);
    }
}
```

### 2. CartController

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // في الحقيقة، نجلب من Session
        $cartItems = [
            ['name' => 'لابتوب HP', 'price' => 3000, 'quantity' => 1],
            ['name' => 'سماعات Sony', 'price' => 500, 'quantity' => 2],
        ];

        return view('cart', compact('cartItems'));
    }

    public function add($productId)
    {
        // في الحقيقة، نضيف للـ Session
        return redirect()->back()->with('success', 'تم إضافة المنتج للسلة');
    }

    public function remove($productId)
    {
        // في الحقيقة، نحذف من الـ Session
        return redirect()->back()->with('success', 'تم حذف المنتج من السلة');
    }
}
```

### 3. Routes

```php
<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
```

---

## 📖 النقاط المهمة

### 1. استخدام Property للبيانات

```php
private $products = [ /* ... */ ];
```

في التطبيق الحقيقي، نجلب من Database.

### 2. استخدام collect()

```php
$product = collect($this->products)->firstWhere('id', $id);
```

Laravel Collections توفر methods مفيدة.

### 3. Named Routes

```php
->name('products.index')
```

تسهل الإشارة للـ routes.

---

**أحسنت! أنهيت جميع التمارين! 🎉**
