# 📝 سجل التغييرات | Changelog

All notable changes to the "Laravel Learning Plan" project will be documented in this file.

جميع التغييرات المهمة في مشروع "خطة تعلم Laravel" سيتم توثيقها في هذا الملف.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [Unreleased]

### مخطط | Planned
- إنشاء جميع الدروس (1-35) | Create all lessons (1-35)
- إنشاء المشاريع العملية الخمسة | Create the five practical projects
- إضافة فيديوهات تعليمية | Add educational videos
- إنشاء تطبيق ويب لتتبع التقدم | Create web app for progress tracking
- إضافة اختبارات تفاعلية | Add interactive quizzes
- ترجمة كاملة لجميع المحتويات | Complete translation of all content

---

## [1.0.0] - 2025-11-03

### ✅ أُضيف | Added

#### الملفات الأساسية | Core Files
- **خطة-تعلم-Laravel-الشاملة.md** - الخطة الشاملة باللغة العربية
  - 35 درس مقسمة على 4 مستويات
  - 5 مشاريع عملية شاملة
  - نظام اختبارات متكامل
  - معايير تقييم واضحة

- **Comprehensive-Laravel-Learning-Plan.md** - Complete plan in English
  - 35 lessons divided into 4 levels
  - 5 comprehensive practical projects
  - Integrated exam system
  - Clear assessment criteria

#### الوثائق | Documentation
- **README.md** - الدليل الشامل للمشروع | Comprehensive project guide
  - نظرة عامة على البرنامج
  - محتويات المجلد
  - أدوات التحويل إلى PDF
  - نظام التعلم
  - المستويات التعليمية
  - المشاريع العملية
  - نظام التتبع
  - نصائح للنجاح
  - الدعم والمساعدة

- **FOLDER-STRUCTURE.md** - هيكل المجلدات التفصيلي | Detailed folder structure
  - الهيكل المقترح الكامل
  - تفاصيل كل مجلد
  - أمثلة على التنظيم
  - نصائح للتنظيم
  - خطوات البدء

- **QUICK-START.md** - دليل البدء السريع | Quick start guide
  - خطوات التحويل إلى PDF
  - كيفية قراءة الخطة
  - فهم الهيكل
  - تتبع التقدم
  - البدء بالتعلم
  - نصائح سريعة
  - الأدوات المطلوبة

- **CHANGELOG.md** - سجل التغييرات | This file

#### أدوات التحويل | Conversion Tools
- **convert-to-pdf.html** - أداة تحويل Markdown إلى PDF عبر المتصفح
  - واجهة سهلة الاستخدام
  - دعم كامل للغة العربية
  - تنسيق احترافي
  - عمل بدون اتصال بالإنترنت
  - متوافق مع جميع المتصفحات

- **convert_md_to_pdf.py** - سكريبت Python للتحويل الآلي
  - يدعم WeasyPrint و pdfkit
  - تحويل تلقائي لجميع الملفات
  - تنسيق احترافي
  - دعم اللغة العربية
  - معالجة الأخطاء

#### ملفات التكوين | Configuration Files
- **.gitignore** - تكوين Git
  - استثناءات ملفات التقدم الشخصية
  - استثناءات ملفات IDE
  - استثناءات ملفات نظام التشغيل
  - استثناءات الملفات المؤقتة
  - استثناءات مشاريع Laravel

### 📋 الهيكل | Structure

#### المستوى الأول: الأساسيات (8 دروس) | Level 1: Fundamentals
1. مقدمة إلى Laravel والبيئة التطويرية
2. التوجيه (Routing) الأساسي
3. Controllers (المتحكمات)
4. Views وBlade Template Engine
5. قواعد البيانات والـ Migrations
6. Eloquent ORM - الأساسيات
7. Eloquent Relationships (العلاقات)
8. Forms والـ Request Validation

#### المستوى الثاني: المتوسط (9 دروس) | Level 2: Intermediate
9. Authentication (المصادقة)
10. Authorization (التصريحات)
11. Middleware
12. File Storage والـ File Upload
13. Email والإشعارات (Notifications)
14. Queues والـ Job Processing
15. Events والـ Listeners
16. API Development - الأساسيات
17. API Authentication (Sanctum)

#### المستوى الثالث: المتقدم (8 دروس) | Level 3: Advanced
18. Testing - الأساسيات
19. Testing المتقدم و Browser Testing
20. Collections والـ Helper Functions
21. Database Advanced (Query Optimization)
22. Caching Strategies
23. Service Container والـ Dependency Injection
24. Contracts و Facades
25. Package Development

#### المستوى الرابع: الاحتراف (10 دروس) | Level 4: Professional
26. Livewire للتطبيقات التفاعلية
27. WebSockets والـ Broadcasting
28. Multi-tenancy Applications
29. Payment Integration (Stripe, PayPal)
30. Elasticsearch والـ Advanced Search
31. Performance Optimization المتقدم
32. Security Best Practices
33. Deployment والـ DevOps
34. Monitoring والـ Logging
35. Microservices Architecture مع Laravel

#### المشاريع العملية | Practical Projects
1. نظام إدارة محتوى CMS
2. منصة تجارة إلكترونية
3. نظام حجز المواعيد
4. منصة تعليمية E-Learning
5. RESTful API متقدم

### 🎯 المميزات | Features

#### نظام التعلم بالاختبارات | Exam-Based Learning System
- **اختبار مع الحلول** لكل درس للدراسة والفهم
- **اختبار بدون حلول** لكل درس للتقييم الذاتي
- معايير تقييم واضحة (نظري 30% + عملي 40% + اختبار 30%)
- 4 مستويات إتقان (ممتاز، جيد جداً، جيد، مقبول)

#### الدعم ثنائي اللغة | Bilingual Support
- محتوى كامل بالعربية والإنجليزية
- تنسيق متسق في كلا اللغتين
- دعم اتجاه النص (RTL/LTR)

#### أدوات التحويل | Conversion Tools
- أداة تحويل عبر المتصفح (لا تحتاج تثبيت)
- سكريبت Python للتحويل الآلي
- تنسيق PDF احترافي

#### التنظيم والهيكلة | Organization & Structure
- هيكل مجلدات واضح ومنظم
- تسمية موحدة للملفات
- تقسيم منطقي للمحتوى
- سهولة التنقل والبحث

### 📊 الإحصائيات | Statistics

- **عدد الدروس | Total Lessons:** 35
- **عدد المستويات | Levels:** 4
- **عدد المشاريع | Projects:** 5
- **عدد الاختبارات | Exams:** 70+ (2 لكل درس)
- **المدة المقدرة (جزئي) | Estimated Duration (Part-time):** 10-11 شهر
- **المدة المقدرة (كامل) | Estimated Duration (Full-time):** 2.5-3 أشهر

### 🎓 الجمهور المستهدف | Target Audience

- **المبتدئين** الذين يريدون تعلم Laravel من الصفر
- **المطورين** الذين يريدون تحسين مهاراتهم في Laravel
- **الطلاب** في الجامعات والمعاهد
- **المعلمين** الذين يريدون منهجاً تعليمياً جاهزاً
- **الشركات** التي تريد تدريب موظفيها

### 💡 الابتكارات | Innovations

1. **نظام الاختبار المزدوج:**
   - نسخة للدراسة مع الحلول
   - نسخة للتقييم بدون حلول

2. **التدرج المنطقي:**
   - 4 مستويات متدرجة الصعوبة
   - كل درس يبني على السابق

3. **التطبيق العملي:**
   - 5 مشاريع عملية شاملة
   - تمارين في كل درس

4. **الدعم ثنائي اللغة:**
   - محتوى متطابق بالعربية والإنجليزية

5. **أدوات مساعدة:**
   - تحويل سهل إلى PDF
   - قوالب جاهزة لتتبع التقدم

### 📝 ملاحظات | Notes

- هذا الإصدار يحتوي على الخطة الشاملة فقط
- الدروس التفصيلية سيتم إضافتها تدريجياً
- المشاريع العملية سيتم إنشاؤها لاحقاً
- الاقتراحات والتحسينات مرحب بها

---

## [0.1.0] - 2025-11-03 (Initial Planning)

### التخطيط الأولي | Initial Planning
- دراسة احتياجات المتعلمين
- تحديد المحتوى المطلوب
- تصميم نظام الاختبارات
- اختيار الموضوعات والدروس

---

## 🔮 الخطط المستقبلية | Future Plans

### الإصدار 1.1.0 (قريباً) | Version 1.1.0 (Coming Soon)
- [ ] إنشاء الدروس 1-8 (المستوى الأول)
- [ ] إضافة أمثلة الكود
- [ ] إنشاء التمارين
- [ ] إنشاء الاختبارات

### الإصدار 1.2.0 | Version 1.2.0
- [ ] إنشاء الدروس 9-17 (المستوى الثاني)
- [ ] إضافة فيديوهات تعليمية
- [ ] إنشاء المشروع الأول (CMS)

### الإصدار 1.3.0 | Version 1.3.0
- [ ] إنشاء الدروس 18-25 (المستوى الثالث)
- [ ] إنشاء المشروع الثاني (E-commerce)

### الإصدار 1.4.0 | Version 1.4.0
- [ ] إنشاء الدروس 26-35 (المستوى الرابع)
- [ ] إنشاء المشاريع المتبقية

### الإصدار 2.0.0 | Version 2.0.0
- [ ] تطبيق ويب تفاعلي
- [ ] نظام تتبع تقدم أوتوماتيكي
- [ ] اختبارات تفاعلية
- [ ] شهادات رقمية
- [ ] منتدى للنقاش
- [ ] نظام إرشاد (Mentorship)

---

## 🤝 المساهمة | Contributing

نرحب بمساهماتكم! إذا كنت تريد المساهمة:

We welcome your contributions! If you want to contribute:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### أنواع المساهمات المرحب بها | Welcome Contributions

- 🐛 إصلاح الأخطاء | Bug fixes
- ✨ إضافة محتوى جديد | Adding new content
- 📝 تحسين الوثائق | Documentation improvements
- 🌍 الترجمة | Translations
- 💡 اقتراحات للتحسين | Improvement suggestions
- 🎨 تحسين التصميم | Design improvements

---

## 📄 الترخيص | License

هذا المشروع مفتوح المصدر ومتاح للاستخدام التعليمي.

This project is open source and available for educational use.

---

## 👏 شكر وتقدير | Acknowledgments

- **Laravel Community** - للمجتمع الرائع والداعم
- **Laracasts** - لمحتوى التعليمي الممتاز
- **جميع المساهمين** - لجهودهم في تحسين المحتوى

**All Contributors** - for their efforts in improving the content

---

## 📞 التواصل | Contact

إذا كان لديك أي أسئلة أو اقتراحات:

If you have any questions or suggestions:

- 📧 Email: [البريد الإلكتروني]
- 🐛 Issues: [رابط GitHub Issues]
- 💬 Discussions: [رابط GitHub Discussions]

---

**آخر تحديث | Last Updated:** 2025-11-03
**الإصدار الحالي | Current Version:** 1.0.0
**الحالة | Status:** ✅ Active Development

---

_سجل التغييرات يتبع معيار [Keep a Changelog](https://keepachangelog.com/)_

_This changelog follows the [Keep a Changelog](https://keepachangelog.com/) standard_
