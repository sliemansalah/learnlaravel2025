# الدرس 10: التمارين العملية - الإيميلات والإشعارات
# Lesson 10: Practical Exercises - Emails and Notifications

---

## 📋 نظرة عامة | Overview

هذه التمارين مصممة لتطبيق ما تعلمته في الدرس العاشر حول الإيميلات والإشعارات في Laravel.

**المدة المقدرة:** 3-4 ساعات
**الصعوبة:** متوسطة

---

## 🎯 الأهداف التعليمية

بعد إكمال هذه التمارين، ستكون قادراً على:
- ✅ إنشاء أنظمة بريد إلكتروني متكاملة
- ✅ تصميم قوالب إيميل احترافية
- ✅ بناء أنظمة إشعارات متعددة القنوات
- ✅ إدارة الإشعارات في قاعدة البيانات
- ✅ استخدام Queues للأداء الأفضل
- ✅ تطبيق best practices

---

## التمرين 1: نظام إيميلات ترحيبية (30 دقيقة)

### المطلوب:

أنشئ نظام إيميلات ترحيبية يُرسل عند تسجيل مستخدم جديد مع الميزات التالية:
- إيميل ترحيبي فوري
- إيميل تفعيل الحساب
- إيميل تذكيري بعد 3 أيام إذا لم يفعّل الحساب
- قالب HTML جميل

### المتطلبات:

```
1. Mailable Classes:
   - WelcomeEmail
   - AccountVerificationEmail
   - VerificationReminderEmail

2. Views:
   - emails/welcome.blade.php
   - emails/verify-account.blade.php
   - emails/reminder.blade.php

3. Functionality:
   - إرسال فوري عند التسجيل
   - جدولة إيميل التذكير
   - رابط تفعيل آمن
```

### معايير التقييم:

- [x] الإيميلات تُرسل بنجاح
- [x] التصميم جميل وresponsive
- [x] رابط التفعيل يعمل بشكل صحيح
- [x] الجدولة تعمل
- [x] رسائل واضحة بالعربية

### نصائح:

```php
// استخدم Carbon للجدولة
Mail::to($user)->later(now()->addDays(3), new VerificationReminderEmail($user));

// توليد رابط آمن
$verificationUrl = URL::temporarySignedRoute(
    'verification.verify',
    now()->addHours(24),
    ['user' => $user->id]
);
```

---

## التمرين 2: نظام إشعارات الطلبات (45 دقيقة)

### المطلوب:

أنشئ نظام إشعارات لمتجر إلكتروني يُرسل إشعارات عند:
- إنشاء طلب جديد
- تأكيد الطلب
- شحن الطلب
- تسليم الطلب
- إلغاء الطلب

### المتطلبات:

```
1. Notification Classes:
   - OrderCreatedNotification
   - OrderConfirmedNotification
   - OrderShippedNotification
   - OrderDeliveredNotification
   - OrderCancelledNotification

2. Channels:
   - Mail (لجميع الإشعارات)
   - Database (لجميع الإشعارات)

3. Features:
   - تفاصيل الطلب في الإيميل
   - رابط تتبع الشحنة
   - حفظ في قاعدة البيانات
```

### معايير التقييم:

- [x] إشعارات متعددة القنوات
- [x] تفاصيل واضحة لكل مرحلة
- [x] حفظ في قاعدة البيانات
- [x] تصميم مناسب لكل حالة
- [x] روابط فعالة

---

## التمرين 3: لوحة إشعارات تفاعلية (60 دقيقة)

### المطلوب:

أنشئ لوحة إشعارات متقدمة مع:
- عرض الإشعارات غير المقروءة
- تعليم كمقروء
- حذف الإشعارات
- فلترة حسب النوع
- بحث في الإشعارات
- تحديث تلقائي

### المتطلبات:

```
1. Controller: NotificationController
   - index() - عرض الكل
   - unread() - غير المقروء
   - markAsRead() - تعليم كمقروء
   - destroy() - حذف
   - filter() - فلترة
   - search() - بحث

2. Views:
   - notifications/index.blade.php
   - notifications/partials/notification-item.blade.php

3. JavaScript:
   - تحديث تلقائي كل 30 ثانية
   - عداد الإشعارات في الNavbar
   - تنبيهات منبثقة للإشعارات الجديدة
```

### معايير التقييم:

- [x] واجهة مستخدم جميلة
- [x] فلترة وبحث فعال
- [x] تحديث تلقائي
- [x] تفاعلية عالية
- [x] responsive design

### Bonus:

- إضافة pagination
- تصنيف الإشعارات
- إحصائيات الإشعارات

---

## التمرين 4: نظام النشرة البريدية (45 دقيقة)

### المطلوب:

أنشئ نظام newsletter يسمح بـ:
- الاشتراك في النشرة البريدية
- إلغاء الاشتراك
- إرسال newsletter لجميع المشتركين
- قوالب قابلة للتخصيص
- إحصائيات الإرسال

### المتطلبات:

```
1. Database:
   - جدول newsletter_subscribers
   - جدول newsletter_campaigns

2. Mailable:
   - NewsletterEmail

3. Features:
   - نموذج اشتراك
   - تأكيد الاشتراك بالإيميل
   - رابط إلغاء الاشتراك
   - لوحة تحكم للإرسال
```

### معايير التقييم:

- [x] نموذج اشتراك يعمل
- [x] تأكيد الاشتراك
- [x] إمكانية إلغاء الاشتراك
- [x] إرسال جماعي فعال
- [x] استخدام Queue

---

## التمرين 5: نظام التنبيهات والتذكيرات (60 دقيقة)

### المطلوب:

أنشئ نظام تذكيرات تلقائي:
- تذكير قبل موعد الاجتماع بـ 30 دقيقة
- تذكير بالمهام المتأخرة
- تنبيه بانتهاء الاشتراك
- تذكير بأعياد الميلاد

### المتطلبات:

```
1. Scheduled Notifications:
   - استخدام Laravel Scheduler
   - إرسال تلقائي في الوقت المحدد

2. Commands:
   - SendMeetingReminders
   - SendOverdueTaskReminders
   - SendBirthdayReminders

3. Notifications:
   - MeetingReminderNotification
   - TaskOverdueNotification
   - BirthdayNotification
```

### Scheduler Setup:

```php
// في app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    // كل 30 دقيقة
    $schedule->command('reminders:meetings')->everyThirtyMinutes();

    // يومياً في الساعة 9 صباحاً
    $schedule->command('reminders:tasks')->dailyAt('09:00');

    // يومياً في الساعة 8 صباحاً
    $schedule->command('reminders:birthdays')->dailyAt('08:00');
}
```

### معايير التقييم:

- [x] Commands تعمل بشكل صحيح
- [x] الجدولة تعمل
- [x] التذكيرات دقيقة
- [x] إشعارات واضحة
- [x] تعامل صحيح مع التوقيت

---

## التمرين 6: إيميلات المعاملات (Transactional Emails) (45 دقيقة)

### المطلوب:

أنشئ نظام إيميلات المعاملات:
- فاتورة الشراء
- إيصال الدفع
- تأكيد الحجز
- كشف الحساب الشهري

### المتطلبات:

```
1. Mailables:
   - InvoiceEmail (مع PDF مرفق)
   - PaymentReceiptEmail
   - BookingConfirmationEmail
   - MonthlyStatementEmail

2. PDF Generation:
   - استخدام DomPDF أو مكتبة مشابهة
   - تصميم احترافي

3. Features:
   - إرفاق PDF
   - تفاصيل كاملة
   - تصميم احترافي
```

### تثبيت DomPDF:

```bash
composer require barryvdh/laravel-dompdf
```

### مثال إرفاق PDF:

```php
use Barryvdh\DomPDF\Facade\Pdf;

public function attachments(): array
{
    $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $this->invoice]);

    return [
        Attachment::fromData(fn () => $pdf->output(), 'invoice.pdf')
            ->withMime('application/pdf'),
    ];
}
```

### معايير التقييم:

- [x] PDF يتم إنشاؤه بنجاح
- [x] الإرفاق يعمل
- [x] التصميم احترافي
- [x] البيانات صحيحة
- [x] الإيميل منظم

---

## التمرين 7: نظام إشعارات متعدد اللغات (45 دقيقة)

### المطلوب:

أنشئ نظام إشعارات يدعم لغات متعددة:
- العربية
- الإنجليزية
- إرسال حسب لغة المستخدم
- قوالب منفصلة لكل لغة

### المتطلبات:

```
1. Notification Structure:
   - دعم locale
   - قوالب متعددة

2. Views:
   - emails/ar/welcome.blade.php
   - emails/en/welcome.blade.php

3. User Model:
   - حقل locale
```

### مثال:

```php
public function toMail($notifiable): MailMessage
{
    app()->setLocale($notifiable->locale ?? 'ar');

    return (new MailMessage)
        ->subject(__('notifications.welcome.subject'))
        ->line(__('notifications.welcome.greeting', ['name' => $notifiable->name]))
        ->action(__('notifications.welcome.action'), url('/'))
        ->line(__('notifications.welcome.thanks'));
}
```

### معايير التقييم:

- [x] دعم لغات متعددة
- [x] الترجمة صحيحة
- [x] اختيار اللغة تلقائي
- [x] قوالب منفصلة
- [x] سهولة الإضافة للغات جديدة

---

## التمرين 8: تحليلات الإيميلات (Email Analytics) (60 دقيقة)

### المطلوب:

أنشئ نظام لتتبع وتحليل الإيميلات:
- تتبع الإيميلات المرسلة
- تتبع الإيميلات المفتوحة
- تتبع النقرات على الروابط
- تقارير وإحصائيات

### المتطلبات:

```
1. Database Tables:
   - email_logs (سجل الإيميلات)
   - email_opens (فتح الإيميل)
   - email_clicks (النقرات)

2. Features:
   - Tracking pixel لتتبع الفتح
   - Tracking links للنقرات
   - Dashboard للإحصائيات

3. Reports:
   - معدل الفتح
   - معدل النقر
   - أكثر الإيميلات نجاحاً
```

### مثال Tracking Pixel:

```blade
<!-- في نهاية الإيميل -->
<img src="{{ route('email.track', ['id' => $emailId]) }}"
     width="1" height="1" alt="" />
```

### معايير التقييم:

- [x] التتبع يعمل بدقة
- [x] الإحصائيات صحيحة
- [x] Dashboard جميل
- [x] تقارير مفيدة
- [x] Privacy compliant

---

## 🎁 تمرين تحدي (اختياري): نظام إيميلات وإشعارات متكامل

### المطلوب:

اجمع كل ما تعلمته وأنشئ نظام متكامل يحتوي على:

1. **إدارة القوالب:**
   - إنشاء قوالب قابلة للتخصيص
   - محرر WYSIWYG
   - معاينة القوالب
   - متغيرات ديناميكية

2. **إدارة الإرسال:**
   - جدولة الإيميلات
   - إرسال جماعي
   - تقسيم المستقبلين
   - A/B Testing

3. **التحليلات:**
   - تتبع شامل
   - تقارير مفصلة
   - تصدير البيانات
   - Insights ذكية

4. **الإشعارات:**
   - قنوات متعددة
   - تفضيلات المستخدم
   - إدارة متقدمة
   - تكامل مع Real-time

5. **الأمان:**
   - Rate limiting
   - Spam prevention
   - Unsubscribe handling
   - GDPR compliance

### التقييم:

سيتم تقييم:
- جودة الكود
- UX/UI
- الأداء
- الأمان
- الميزات
- التوثيق

---

## ✅ معايير التسليم

- كود نظيف ومنظم
- Comments بالعربية أو الإنجليزية
- اتباع PSR standards
- معالجة الأخطاء
- رسائل واضحة للمستخدم
- استخدام Queue حيث مناسب

---

## 📚 مصادر إضافية

- [Laravel Mail Documentation](https://laravel.com/docs/11.x/mail)
- [Laravel Notifications](https://laravel.com/docs/11.x/notifications)
- [Laravel Queues](https://laravel.com/docs/11.x/queues)
- [Mailtrap Documentation](https://mailtrap.io/blog/)

---

## 🎯 نقاط إضافية (Bonus)

- استخدام TypeScript للـ frontend
- إضافة unit tests
- Real-time notifications
- PWA notifications
- SMS integration
- Push notifications

---

**حظاً موفقاً! 🚀**

**تاريخ آخر تحديث:** 2025-11-04
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
