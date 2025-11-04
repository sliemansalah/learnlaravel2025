# الدرس 10: الإيميلات والإشعارات
# Lesson 10: Emails and Notifications

**المدة المقدرة:** 4-5 ساعات | Estimated Duration: 4-5 hours
**المستوى:** مبتدئ | Level: Beginner
**المتطلبات:** الدروس 1-9 | Prerequisites: Lessons 1-9

---

## 📋 جدول المحتويات | Table of Contents

1. [مقدمة](#مقدمة)
2. [إعداد البريد الإلكتروني](#إعداد-البريد-الإلكتروني)
3. [Mailables](#mailables)
4. [إرسال الإيميلات](#إرسال-الإيميلات)
5. [قوالب البريد الإلكتروني](#قوالب-البريد-الإلكتروني)
6. [المرفقات](#المرفقات)
7. [Notifications](#notifications)
8. [قنوات الإشعارات](#قنوات-الإشعارات)
9. [قاعدة البيانات للإشعارات](#قاعدة-البيانات-للإشعارات)
10. [Queued Notifications](#queued-notifications)

---

## 🎯 أهداف الدرس | Learning Objectives

بنهاية هذا الدرس، ستكون قادراً على:

- ✅ إعداد وتكوين البريد الإلكتروني في Laravel
- ✅ إنشاء Mailable classes
- ✅ إرسال إيميلات HTML جميلة
- ✅ إضافة مرفقات للإيميلات
- ✅ استخدام نظام Notifications
- ✅ إرسال إشعارات متعددة القنوات
- ✅ حفظ الإشعارات في قاعدة البيانات
- ✅ استخدام Queues للإيميلات والإشعارات

---

## 📚 مقدمة

### ما هي Mailables؟

**Mailables** هي classes في Laravel تمثل رسائل البريد الإلكتروني. كل Mailable يحتوي على:
- محتوى الرسالة
- المستقبلين
- المرفقات (إن وجدت)
- التنسيق والتصميم

### ما هي Notifications؟

**Notifications** هي طريقة Laravel لإرسال إشعارات عبر قنوات متعددة:
- البريد الإلكتروني
- قاعدة البيانات
- SMS (Nexmo, Twilio)
- Slack
- Broadcasting

---

## ⚙️ إعداد البريد الإلكتروني

### الخطوة 1: تكوين ملف `.env`

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### الخطوة 2: Mail Drivers المتاحة

Laravel يدعم عدة mail drivers:

#### 1. SMTP (الأكثر شيوعاً)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

#### 2. Mailgun
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.com
MAILGUN_SECRET=your-secret-key
```

#### 3. Mailtrap (للتطوير)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
```

#### 4. Log (للاختبار)
```env
MAIL_MAILER=log
```

### الخطوة 3: تثبيت Mailtrap (للتطوير)

**Mailtrap** هي خدمة مجانية لاختبار الإيميلات:

1. اذهب إلى [mailtrap.io](https://mailtrap.io)
2. أنشئ حساب مجاني
3. احصل على بيانات SMTP
4. ضعها في ملف `.env`

**فائدة Mailtrap:**
- لا ترسل إيميلات حقيقية
- تستقبل جميع الإيميلات في صندوق وارد وهمي
- مثالية للتطوير والاختبار

---

## 📧 Mailables

### إنشاء Mailable

```bash
php artisan make:mail WelcomeEmail
```

سيُنشئ الملف: `app/Mail/WelcomeEmail.php`

### بنية Mailable Class

```php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'مرحباً بك في موقعنا!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
```

### المكونات الأساسية

#### 1. Envelope (المظروف)
يحدد:
- الموضوع (Subject)
- المرسل (From)
- الرد على (Reply To)

```php
public function envelope(): Envelope
{
    return new Envelope(
        from: new Address('admin@example.com', 'Admin'),
        replyTo: [
            new Address('support@example.com', 'Support'),
        ],
        subject: 'عنوان الرسالة',
    );
}
```

#### 2. Content (المحتوى)
يحدد:
- View الذي سيتم استخدامه
- البيانات المرسلة
- النص البديل

```php
public function content(): Content
{
    return new Content(
        view: 'emails.welcome',
        with: [
            'userName' => $this->user->name,
        ],
    );
}
```

#### 3. Attachments (المرفقات)
```php
public function attachments(): array
{
    return [
        Attachment::fromPath('/path/to/file.pdf'),
    ];
}
```

---

## 📤 إرسال الإيميلات

### الطريقة 1: باستخدام Mail Facade

```php
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

// إرسال فوري
Mail::to($user->email)->send(new WelcomeEmail($user));

// إرسال لعدة مستقبلين
Mail::to($user->email)
    ->cc('manager@example.com')
    ->bcc('admin@example.com')
    ->send(new WelcomeEmail($user));
```

### الطريقة 2: باستخدام Queue (موصى بها)

```php
// إرسال عبر Queue
Mail::to($user->email)->queue(new WelcomeEmail($user));

// تأخير الإرسال
Mail::to($user->email)
    ->later(now()->addMinutes(10), new WelcomeEmail($user));
```

### الطريقة 3: من Controller

```php
<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function sendWelcomeEmail($userId)
    {
        $user = User::findOrFail($userId);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        return back()->with('success', 'تم إرسال الإيميل!');
    }
}
```

---

## 🎨 قوالب البريد الإلكتروني

### إنشاء View للإيميل

**ملف: `resources/views/emails/welcome.blade.php`**

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مرحباً بك</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }
        h1 {
            color: #333;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>مرحباً {{ $user->name }}! 👋</h1>

        <p>نحن سعداء بانضمامك إلى موقعنا.</p>

        <p>
            <a href="{{ url('/dashboard') }}" class="button">
                الذهاب إلى لوحة التحكم
            </a>
        </p>

        <p>شكراً لك!</p>
        <p>فريق {{ config('app.name') }}</p>
    </div>
</body>
</html>
```

### استخدام Markdown Mailables

Laravel يوفر قوالب جاهزة باستخدام Markdown:

```bash
php artisan make:mail WelcomeEmail --markdown=emails.welcome
```

**ملف: `resources/views/emails/welcome.blade.php`**

```blade
@component('mail::message')
# مرحباً {{ $user->name }}!

نحن سعداء بانضمامك إلى موقعنا.

@component('mail::button', ['url' => url('/dashboard')])
الذهاب إلى لوحة التحكم
@endcomponent

شكراً لك!<br>
{{ config('app.name') }}
@endcomponent
```

---

## 📎 المرفقات

### إرفاق ملف من المسار

```php
use Illuminate\Mail\Mailables\Attachment;

public function attachments(): array
{
    return [
        Attachment::fromPath('/path/to/file.pdf')
            ->as('الفاتورة.pdf')
            ->withMime('application/pdf'),
    ];
}
```

### إرفاق ملف من Storage

```php
public function attachments(): array
{
    return [
        Attachment::fromStorage('/invoices/invoice-123.pdf')
            ->as('الفاتورة.pdf'),
    ];
}
```

### إرفاق من البيانات المباشرة

```php
public function attachments(): array
{
    return [
        Attachment::fromData(fn () => $this->pdf, 'Report.pdf')
            ->withMime('application/pdf'),
    ];
}
```

---

## 🔔 Notifications

### إنشاء Notification

```bash
php artisan make:notification OrderShipped
```

سيُنشئ: `app/Notifications/OrderShipped.php`

### بنية Notification Class

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderShipped extends Notification
{
    use Queueable;

    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('تم شحن طلبك!')
            ->greeting('مرحباً ' . $notifiable->name)
            ->line('تم شحن طلبك رقم: ' . $this->order->id)
            ->action('عرض الطلب', url('/orders/' . $this->order->id))
            ->line('شكراً لاستخدامك موقعنا!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'amount' => $this->order->amount,
        ];
    }
}
```

### إرسال Notification

#### من Model (مع Notifiable Trait)

```php
// في User Model
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;
}

// إرسال
$user->notify(new OrderShipped($order));
```

#### باستخدام Notification Facade

```php
use Illuminate\Support\Facades\Notification;

// إرسال لمستخدم واحد
Notification::send($user, new OrderShipped($order));

// إرسال لعدة مستخدمين
Notification::send($users, new OrderShipped($order));
```

---

## 📡 قنوات الإشعارات

### القنوات المتاحة

#### 1. Mail Channel
```php
public function via($notifiable): array
{
    return ['mail'];
}

public function toMail($notifiable): MailMessage
{
    return (new MailMessage)
        ->subject('الموضوع')
        ->line('النص')
        ->action('زر', url('/'));
}
```

#### 2. Database Channel
```php
public function via($notifiable): array
{
    return ['database'];
}

public function toArray($notifiable): array
{
    return [
        'message' => 'رسالة الإشعار',
        'data' => 'بيانات إضافية',
    ];
}
```

#### 3. Broadcast Channel
```php
public function via($notifiable): array
{
    return ['broadcast'];
}

public function toBroadcast($notifiable): BroadcastMessage
{
    return new BroadcastMessage([
        'message' => 'إشعار جديد',
    ]);
}
```

#### 4. SMS Channel (Nexmo/Twilio)
```php
public function via($notifiable): array
{
    return ['nexmo'];
}

public function toNexmo($notifiable)
{
    return (new NexmoMessage)
        ->content('رسالة SMS');
}
```

---

## 💾 قاعدة البيانات للإشعارات

### إنشاء جدول الإشعارات

```bash
php artisan notifications:table
php artisan migrate
```

سيُنشئ جدول `notifications` بالحقول:
- `id`
- `type`
- `notifiable_type`
- `notifiable_id`
- `data`
- `read_at`
- `created_at`
- `updated_at`

### حفظ الإشعار في قاعدة البيانات

```php
// في Notification class
public function via($notifiable): array
{
    return ['database'];
}

public function toDatabase($notifiable): array
{
    return [
        'title' => 'عنوان الإشعار',
        'message' => 'نص الإشعار',
        'url' => '/some-url',
    ];
}
```

### قراءة الإشعارات

```php
// جميع الإشعارات
$notifications = auth()->user()->notifications;

// الإشعارات غير المقروءة
$unread = auth()->user()->unreadNotifications;

// عدد الإشعارات غير المقروءة
$count = auth()->user()->unreadNotifications()->count();
```

### تعليم الإشعار كمقروء

```php
// تعليم إشعار واحد
$notification = auth()->user()->notifications()->find($id);
$notification->markAsRead();

// تعليم جميع الإشعارات
auth()->user()->unreadNotifications->markAsRead();
```

---

## ⏱️ Queued Notifications

### استخدام ShouldQueue

```php
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Notification implements ShouldQueue
{
    use Queueable;

    // باقي الكود...
}
```

### تأخير الإشعار

```php
$user->notify((new OrderShipped($order))->delay(now()->addMinutes(10)));
```

---

## ✅ الخلاصة

### ما تعلمناه:

✅ إعداد البريد الإلكتروني في Laravel
✅ إنشاء واستخدام Mailables
✅ تصميم قوالب البريد الجميلة
✅ إرفاق الملفات
✅ نظام Notifications الشامل
✅ قنوات الإشعارات المتعددة
✅ حفظ الإشعارات في قاعدة البيانات
✅ استخدام Queues للأداء الأفضل

---

**تاريخ آخر تحديث:** 2025-11-04
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
