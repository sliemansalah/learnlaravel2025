<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * ProductController - Resource Controller Example
 * مثال على Resource Controller
 *
 * This demonstrates a full CRUD controller with all 7 RESTful methods
 * هذا يوضح controller كامل مع جميع العمليات السبعة
 *
 * Note: Using session storage for practice. In real apps, use database.
 * ملاحظة: نستخدم تخزين الجلسة للتدريب. في التطبيقات الحقيقية، استخدم قاعدة البيانات.
 */
class ProductController extends Controller
{
    /**
     * Initialize session with sample products if empty
     * تهيئة الجلسة بمنتجات تجريبية إذا كانت فارغة
     */
    private function initializeProducts()
    {
        if (!session()->has('products')) {
            session([
                'products' => [
                    ['id' => 1, 'name' => 'Laptop', 'price' => 1200, 'description' => 'High-performance laptop'],
                    ['id' => 2, 'name' => 'Phone', 'price' => 800, 'description' => 'Latest smartphone'],
                    ['id' => 3, 'name' => 'Tablet', 'price' => 500, 'description' => 'Portable tablet'],
                ],
                'product_next_id' => 4
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     * عرض قائمة بجميع المنتجات
     */
    public function index()
    {
        $this->initializeProducts();
        $products = session('products', []);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * عرض نموذج إنشاء منتج جديد
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     * حفظ المنتج الجديد
     */
    public function store(Request $request)
    {
        // Validate input / التحقق من المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        $this->initializeProducts();

        // Get current products and next ID
        $products = session('products', []);
        $nextId = session('product_next_id', 1);

        // Create new product / إنشاء منتج جديد
        $newProduct = [
            'id' => $nextId,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description ?? ''
        ];

        // Add to products array / إضافة للمصفوفة
        $products[] = $newProduct;

        // Save to session / الحفظ في الجلسة
        session([
            'products' => $products,
            'product_next_id' => $nextId + 1
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully! / تم إنشاء المنتج بنجاح!');
    }

    /**
     * Display the specified resource.
     * عرض منتج محدد
     */
    public function show(string $id)
    {
        $this->initializeProducts();
        $products = session('products', []);

        // Find product by ID / البحث عن المنتج بالمعرّف
        $product = collect($products)->firstWhere('id', (int)$id);

        if (!$product) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Product not found! / المنتج غير موجود!');
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * عرض نموذج تعديل المنتج
     */
    public function edit(string $id)
    {
        $this->initializeProducts();
        $products = session('products', []);

        // Find product by ID / البحث عن المنتج بالمعرّف
        $product = collect($products)->firstWhere('id', (int)$id);

        if (!$product) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Product not found! / المنتج غير موجود!');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * تحديث المنتج
     */
    public function update(Request $request, string $id)
    {
        // Validate input / التحقق من المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        $this->initializeProducts();
        $products = session('products', []);

        // Find and update product / البحث والتحديث
        $updated = false;
        foreach ($products as $key => $product) {
            if ($product['id'] == $id) {
                $products[$key]['name'] = $request->name;
                $products[$key]['price'] = $request->price;
                $products[$key]['description'] = $request->description ?? '';
                $updated = true;
                break;
            }
        }

        if (!$updated) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Product not found! / المنتج غير موجود!');
        }

        // Save to session / الحفظ في الجلسة
        session(['products' => $products]);

        return redirect()
            ->route('products.index')
            ->with('success', "Product updated successfully! / تم تحديث المنتج بنجاح!");
    }

    /**
     * Remove the specified resource from storage.
     * حذف المنتج
     */
    public function destroy(string $id)
    {
        $this->initializeProducts();
        $products = session('products', []);

        // Filter out the product to delete / تصفية المنتج للحذف
        $filteredProducts = array_values(
            array_filter($products, function($product) use ($id) {
                return $product['id'] != $id;
            })
        );

        if (count($filteredProducts) === count($products)) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Product not found! / المنتج غير موجود!');
        }

        // Save to session / الحفظ في الجلسة
        session(['products' => $filteredProducts]);

        return redirect()
            ->route('products.index')
            ->with('success', "Product deleted successfully! / تم حذف المنتج بنجاح!");
    }
}
