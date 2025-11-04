# الدرس 10: الاختبار النهائي - الإيميلات والإشعارات
# Lesson 10: Final Exam - Emails and Notifications

---

## 📋 معلومات الاختبار | Exam Information

**المدة:** 60 دقيقة
**عدد الأسئلة:** 40 سؤال
**الدرجة الكاملة:** 100 نقطة
**درجة النجاح:** 70%

**تعليمات:**
- اقرأ كل سؤال بعناية قبل الإجابة
- لا تستخدم أي مراجع خارجية أثناء الاختبار
- أجب عن جميع الأسئلة
- تأكد من مراجعة إجاباتك قبل التسليم

---

## القسم الأول: أسئلة الاختيار من متعدد (40 نقطة)

### السؤال 1 (2 نقطة)
ما هو الأمر المستخدم لإنشاء Mailable class؟

- a) `php artisan create:mail WelcomeEmail`
- b) `php artisan make:mailable WelcomeEmail`
- c) `php artisan make:mail WelcomeEmail`
- d) `php artisan new:mail WelcomeEmail`

**الإجابة:** ___________

---

### السؤال 2 (2 نقطة)
أي attribute يجب تكوينه في ملف `.env` لإعداد البريد الإلكتروني؟

- a) `EMAIL_DRIVER`
- b) `MAIL_MAILER`
- c) `SMTP_DRIVER`
- d) `EMAIL_HOST`

**الإجابة:** ___________

---

### السؤال 3 (2 نقطة)
ما هي الخدمة الموصى بها لاختبار الإيميلات أثناء التطوير؟

- a) Gmail
- b) SendGrid
- c) Mailtrap
- d) Mailgun

**الإجابة:** ___________

---

### السؤال 4 (2 نقطة)
كيف تُرسل إيميل باستخدام Mail Facade؟

- a) `Mail::send($user->email, new WelcomeEmail())`
- b) `Mail::to($user->email)->send(new WelcomeEmail())`
- c) `Mail::sendTo($user->email, WelcomeEmail::class)`
- d) `Mail::dispatch($user->email, new WelcomeEmail())`

**الإجابة:** ___________

---

### السؤال 5 (2 نقطة)
ما هو الـ method المستخدم لإرسال إيميل عبر Queue؟

- a) `Mail::to($user)->send()`
- b) `Mail::to($user)->queue()`
- c) `Mail::to($user)->dispatch()`
- d) `Mail::to($user)->async()`

**الإجابة:** ___________

---

### السؤال 6 (2 نقطة)
أي method يُستخدم لتحديد موضوع الإيميل في Envelope؟

- a) `title`
- b) `subject`
- c) `heading`
- d) `topic`

**الإجابة:** ___________

---

### السؤال 7 (2 نقطة)
كيف تُضيف CC (نسخة كربونية) لإيميل؟

- a) `Mail::to($user)->copy($email)->send()`
- b) `Mail::to($user)->cc($email)->send()`
- c) `Mail::to($user)->carbon($email)->send()`
- d) `Mail::to($user)->addCc($email)->send()`

**الإجابة:** ___________

---

### السؤال 8 (2 نقطة)
ما هو الأمر لإنشاء Notification class؟

- a) `php artisan make:notify UserNotification`
- b) `php artisan create:notification UserNotification`
- c) `php artisan make:notification UserNotification`
- d) `php artisan new:notification UserNotification`

**الإجابة:** ___________

---

### السؤال 9 (2 نقطة)
أي trait يجب إضافته للـ User model لاستخدام Notifications؟

- a) `Notifies`
- b) `HasNotifications`
- c) `Notifiable`
- d) `CanNotify`

**الإجابة:** ___________

---

### السؤال 10 (2 نقطة)
ما هو method المستخدم لتحديد قنوات الإشعار؟

- a) `channels()`
- b) `via()`
- c) `through()`
- d) `sendVia()`

**الإجابة:** ___________

---

### السؤال 11 (2 نقطة)
ما هو الأمر لإنشاء جدول الإشعارات في قاعدة البيانات؟

- a) `php artisan make:migration notifications`
- b) `php artisan notifications:table`
- c) `php artisan make:notifications-table`
- d) `php artisan db:notifications`

**الإجابة:** ___________

---

### السؤال 12 (2 نقطة)
كيف تُرسل إشعار لمستخدم؟

- a) `$user->send(new OrderShipped())`
- b) `$user->notify(new OrderShipped())`
- c) `$user->notification(new OrderShipped())`
- d) `$user->alert(new OrderShipped())`

**الإجابة:** ___________

---

### السؤال 13 (2 نقطة)
ما هو method للحصول على الإشعارات غير المقروءة؟

- a) `$user->notifications()->unread()`
- b) `$user->unreadNotifications`
- c) `$user->notifications()->whereNull('read_at')`
- d) `$user->getUnreadNotifications()`

**الإجابة:** ___________

---

### السؤال 14 (2 نقطة)
كيف تُعلّم إشعار واحد كمقروء؟

- a) `$notification->read()`
- b) `$notification->markRead()`
- c) `$notification->markAsRead()`
- d) `$notification->setRead()`

**الإجابة:** ___________

---

### السؤال 15 (2 نقطة)
أي interface يجب تطبيقه لجعل Notification يعمل في Queue؟

- a) `ShouldBeQueued`
- b) `ShouldQueue`
- c) `Queueable`
- d) `CanQueue`

**الإجابة:** ___________

---

### السؤال 16 (2 نقطة)
كيف تُرفق ملف في Mailable؟

- a) في method `files()`
- b) في method `attach()`
- c) في method `attachments()`
- d) في method `addAttachment()`

**الإجابة:** ___________

---

### السؤال 17 (2 نقطة)
ما هي القنوات المتاحة للإشعارات في Laravel؟

- a) mail, sms, push
- b) mail, database, broadcast
- c) email, db, realtime
- d) smtp, sql, websocket

**الإجابة:** ___________

---

### السؤال 18 (2 نقطة)
كيف تُؤخر إرسال إيميل؟

- a) `Mail::to($user)->delay(10)->send()`
- b) `Mail::to($user)->later(now()->addMinutes(10))`
- c) `Mail::to($user)->schedule(10)->send()`
- d) `Mail::to($user)->wait(10)->send()`

**الإجابة:** ___________

---

### السؤال 19 (2 نقطة)
ما هو method لإنشاء Markdown mailable؟

- a) `php artisan make:mail Email`
- b) `php artisan make:mail Email --md`
- c) `php artisan make:mail Email --markdown=emails.welcome`
- d) `php artisan make:mail Email --template`

**الإجابة:** ___________

---

### السؤال 20 (2 نقطة)
كيف تحصل على عدد الإشعارات غير المقروءة؟

- a) `$user->unreadNotifications->count()`
- b) `$user->notifications()->unread()->count()`
- c) `$user->countUnread()`
- d) `$user->getUnreadCount()`

**الإجابة:** ___________

---

## القسم الثاني: أسئلة صح أو خطأ (20 نقطة)

### السؤال 21 (2 نقطة)
يمكن إرسال إيميل لعدة مستقبلين باستخدام method `to()` مرة واحدة.

**الإجابة:** ___________

---

### السؤال 22 (2 نقطة)
Mailtrap يُرسل إيميلات حقيقية للمستخدمين.

**الإجابة:** ___________

---

### السؤال 23 (2 نقطة)
يجب استخدام Queue عند إرسال إيميلات كثيرة.

**الإجابة:** ___________

---

### السؤال 24 (2 نقطة)
يمكن للـ Notification إرسال رسالة واحدة فقط عبر قناة واحدة.

**الإجابة:** ___________

---

### السؤال 25 (2 نقطة)
يتم حفظ الإشعارات في جدول `notifications` تلقائياً عند استخدام قناة database.

**الإجابة:** ___________

---

### السؤال 26 (2 نقطة)
method `markAsRead()` تحذف الإشعار من قاعدة البيانات.

**الإجابة:** ___________

---

### السؤال 27 (2 نقطة)
يمكن إرفاق ملفات PDF مع الإيميلات في Laravel.

**الإجابة:** ___________

---

### السؤال 28 (2 نقطة)
Markdown mailables تتطلب تثبيت حزمة خارجية.

**الإجابة:** ___________

---

### السؤال 29 (2 نقطة)
يمكن جدولة إرسال إشعار في وقت معين.

**الإجابة:** ___________

---

### السؤال 30 (2 نقطة)
trait `Notifiable` متوفر فقط في User model.

**الإجابة:** ___________

---

## القسم الثالث: أسئلة إكمال الكود (30 نقطة)

### السؤال 31 (5 نقاط)
أكمل الكود لإنشاء وإرسال إيميل ترحيبي:

```php
// إنشاء Mailable
class WelcomeEmail extends ____________
{
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '_______________',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: '_______________',
        );
    }
}

// إرسال
Mail::____($user->email)->______(new WelcomeEmail($user));
```

---

### السؤال 32 (5 نقاط)
أكمل الكود لإنشاء وإرسال إشعار:

```php
class OrderShippedNotification extends ____________
{
    public function via($notifiable): array
    {
        return ['_____', '_________'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->______('تم شحن طلبك')
            ->line('طلبك في الطريق')
            ->______('تتبع الطلب', url('/orders'));
    }

    public function toArray($notifiable): array
    {
        return ['message' => 'تم شحن طلبك'];
    }
}

// إرسال
$user->________(new OrderShippedNotification());
```

---

### السؤال 33 (5 نقاط)
أكمل الكود لإدارة الإشعارات:

```php
// الحصول على جميع الإشعارات
$notifications = auth()->user()->_______________;

// الإشعارات غير المقروءة
$unread = auth()->user()->__________________;

// عدد الإشعارات غير المقروءة
$count = auth()->user()->__________________->______();

// تعليم الكل كمقروء
auth()->user()->_________________->markAsRead();
```

---

### السؤال 34 (5 نقاط)
أكمل الكود لإرفاق ملف:

```php
use Illuminate\Mail\Mailables\Attachment;

public function attachments(): array
{
    return [
        Attachment::________('/path/to/file.pdf')
            ->__('invoice.pdf')
            ->______('application/pdf'),
    ];
}
```

---

### السؤال 35 (5 نقاط)
أكمل الكود لإرسال إيميل عبر Queue:

```php
// إرسال عبر Queue
Mail::to($user->email)->_______(new WelcomeEmail($user));

// تأخير الإرسال 10 دقائق
Mail::to($user->email)
    ->______(now()->addMinutes(10), new WelcomeEmail($user));

// جعل Mailable يعمل في Queue
class WelcomeEmail extends Mailable implements ____________
{
    use _________;
}
```

---

### السؤال 36 (5 نقاط)
أكمل الكود لإعداد البريد في .env:

```env
MAIL_MAILER=_______
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=_______
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=_______
MAIL_FROM_ADDRESS="_________________"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## القسم الرابع: أسئلة مقالية (10 نقاط)

### السؤال 37 (3 نقاط)
اشرح الفرق بين Mailable و Notification.

**الإجابة:**
_______________________________________________________________________________
_______________________________________________________________________________
_______________________________________________________________________________
_______________________________________________________________________________

---

### السؤال 38 (3 نقاط)
ما هي فوائد استخدام Queue للإيميلات والإشعارات؟

**الإجابة:**
_______________________________________________________________________________
_______________________________________________________________________________
_______________________________________________________________________________
_______________________________________________________________________________

---

### السؤال 39 (2 نقطة)
اذكر ثلاث قنوات إشعارات متاحة في Laravel.

**الإجابة:**

1. _______________________________________________________________________________
2. _______________________________________________________________________________
3. _______________________________________________________________________________

---

### السؤال 40 (2 نقطة)
كيف تحمي تطبيقك من spam emails؟

**الإجابة:**
_______________________________________________________________________________
_______________________________________________________________________________
_______________________________________________________________________________
_______________________________________________________________________________

---

## 📊 ملخص الدرجات

| القسم | عدد الأسئلة | الدرجة |
|-------|-------------|--------|
| اختيار من متعدد | 20 | 40 |
| صح وخطأ | 10 | 20 |
| إكمال الكود | 6 | 30 |
| مقالية | 4 | 10 |
| **المجموع** | **40** | **100** |

---

## 🎯 تقييم الأداء

- **90-100**: ممتاز 🏆
- **80-89**: جيد جداً ⭐
- **70-79**: جيد ✓
- **أقل من 70**: يحتاج مراجعة 📚

---

**حظاً موفقاً! 🚀**

**تاريخ آخر تحديث:** 2025-11-04
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
