<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * ProductController - Resource Controller Example
 * مثال على Resource Controller
 *
 * This demonstrates a full CRUD controller with all 7 RESTful methods
 * هذا يوضح controller كامل مع جميع العمليات السبعة
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * عرض قائمة بجميع المنتجات
     */
    public function index()
    {
        // في التطبيق الحقيقي، سنجلب البيانات من قاعدة البيانات
        // In a real app, we would fetch data from database
        $products = [
            ['id' => 1, 'name' => 'Laptop', 'price' => 1200],
            ['id' => 2, 'name' => 'Phone', 'price' => 800],
            ['id' => 3, 'name' => 'Tablet', 'price' => 500],
        ];

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
        // في التطبيق الحقيقي، سنحفظ في قاعدة البيانات
        // In a real app, we would save to database

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
        // في التطبيق الحقيقي، سنجلب من قاعدة البيانات
        // In a real app, we would fetch from database
        $product = [
            'id' => $id,
            'name' => 'Sample Product',
            'price' => 999,
            'description' => 'This is a sample product description'
        ];

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * عرض نموذج تعديل المنتج
     */
    public function edit(string $id)
    {
        $product = [
            'id' => $id,
            'name' => 'Sample Product',
            'price' => 999
        ];

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * تحديث المنتج
     */
    public function update(Request $request, string $id)
    {
        // في التطبيق الحقيقي، سنحدث في قاعدة البيانات
        // In a real app, we would update in database

        return redirect()
            ->route('products.index')
            ->with('success', "Product #$id updated! / تم تحديث المنتج!");
    }

    /**
     * Remove the specified resource from storage.
     * حذف المنتج
     */
    public function destroy(string $id)
    {
        // في التطبيق الحقيقي، سنحذف من قاعدة البيانات
        // In a real app, we would delete from database

        return redirect()
            ->route('products.index')
            ->with('success', "Product #$id deleted! / تم حذف المنتج!");
    }
}
