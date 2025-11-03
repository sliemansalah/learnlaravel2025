# التمرين 3: إنشاء Controller
# Exercise 3: Creating Controller

---

## 📋 وصف التمرين

في هذا التمرين، ستحول الـ Routes من التمرين السابق إلى استخدام Controllers.

**المستوى:** ⭐⭐⭐ (متقدم)
**الوقت المقترح:** 30-40 دقيقة

---

## 📝 المطلوب

### المهمة 1: إنشاء ProductController

```bash
php artisan make:controller ProductController
```

#### Methods المطلوبة:

1. **index()** - عرض قائمة المنتجات
2. **show($id)** - عرض منتج واحد
3. **search(Request $request)** - البحث عن منتج

### المهمة 2: إنشاء CartController

```bash
php artisan make:controller CartController
```

#### Methods المطلوبة:

1. **index()** - عرض سلة المشتريات
2. **add($productId)** - إضافة منتج للسلة
3. **remove($productId)** - حذف منتج من السلة

### المهمة 3: تحديث Routes

حوّل جميع الـ Routes لتستخدم Controllers بدلاً من Closures.

---

## ✅ معايير التقييم

| المعيار | النقاط |
|---------|--------|
| ProductController | 40 |
| CartController | 40 |
| Routes صحيحة | 20 |
| **المجموع** | **100** |

---

**بالتوفيق! 🚀**
