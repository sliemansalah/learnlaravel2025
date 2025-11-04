# الدرس 10: التطبيق العملي - الإيميلات والإشعارات
# Lesson 10: Practical Application - Emails and Notifications

**المدة المقدرة:** 3-4 ساعات | Estimated Duration: 3-4 hours
**المستوى:** مبتدئ | Level: Beginner

---

## 📋 جدول المحتويات | Table of Contents

1. [إعداد المشروع](#إعداد-المشروع)
2. [إعداد البريد الإلكتروني](#إعداد-البريد-الإلكتروني)
3. [إنشاء أول Mailable](#إنشاء-أول-mailable)
4. [إرسال إيميل ترحيبي](#إرسال-إيميل-ترحيبي)
5. [إنشاء Notification](#إنشاء-notification)
6. [إشعارات قاعدة البيانات](#إشعارات-قاعدة-البيانات)
7. [لوحة الإشعارات](#لوحة-الإشعارات)

---

## 🎯 أهداف الدرس العملي

بنهاية هذا الدرس، ستكون قد:

- ✅ أعددت نظام البريد الإلكتروني
- ✅ أنشأت Mailable classes
- ✅ أرسلت إيميلات HTML
- ✅ أنشأت نظام إشعارات
- ✅ خزّنت الإشعارات في قاعدة البيانات
- ✅ بنيت لوحة إشعارات
- ✅ استخدمت Queues

---

## 📥 إعداد المشروع

### الخطوة 1: إنشاء مشروع جديد

```bash
# إنشاء مشروع Laravel جديد
composer create-project laravel/laravel email-notification-demo
cd email-notification-demo

# تشغيل السيرفر
php artisan serve
```

### الخطوة 2: إعداد قاعدة البيانات

**ملف `.env`:**

```env
DB_CONNECTION=sqlite
```

**إنشاء ملف قاعدة البيانات:**

```bash
# Windows
type nul > database\database.sqlite

# macOS/Linux
touch database/database.sqlite

# تشغيل migrations
php artisan migrate
```

---

## ⚙️ إعداد البريد الإلكتروني

### الخطوة 1: إعداد Mailtrap

1. اذهب إلى [mailtrap.io](https://mailtrap.io)
2. أنشئ حساب مجاني
3. احصل على بيانات SMTP من قسم "Inboxes"

### الخطوة 2: تحديث ملف `.env`

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### الخطوة 3: اختبار الإعداد

```bash
php artisan tinker
```

```php
Mail::raw('اختبار البريد الإلكتروني', function ($message) {
    $message->to('test@example.com')->subject('اختبار');
});
```

**تحقق من Mailtrap inbox - يجب أن ترى الرسالة!**

---

## 📧 إنشاء أول Mailable

### الخطوة 1: إنشاء Mailable Class

```bash
php artisan make:mail WelcomeEmail
```

### الخطوة 2: تعديل WelcomeEmail

**ملف `app/Mail/WelcomeEmail.php`:**

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
            subject: 'مرحباً بك في ' . config('app.name'),
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

### الخطوة 3: إنشاء View

**أنشئ ملف `resources/views/emails/welcome.blade.php`:**

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
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
        }
        .content {
            padding: 40px 30px;
        }
        .content p {
            line-height: 1.8;
            color: #333;
            font-size: 16px;
        }
        .button {
            display: inline-block;
            padding: 15px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            background: #f7f7f7;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🎉 مرحباً بك!</h1>
        </div>

        <div class="content">
            <p>مرحباً <strong>{{ $user->name }}</strong>،</p>

            <p>نحن سعداء جداً بانضمامك إلى {{ config('app.name') }}!</p>

            <p>يمكنك الآن الاستمتاع بجميع الميزات المتاحة على منصتنا.</p>

            <center>
                <a href="{{ url('/dashboard') }}" class="button">
                    الذهاب إلى لوحة التحكم
                </a>
            </center>

            <p>إذا كان لديك أي أسئلة، لا تتردد في التواصل معنا.</p>

            <p>مع أطيب التحيات،<br>فريق {{ config('app.name') }}</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.</p>
            <p style="font-size: 12px; margin-top: 10px;">
                تلقيت هذا البريد لأنك قمت بالتسجيل في موقعنا
            </p>
        </div>
    </div>
</body>
</html>
```

### الخطوة 4: إنشاء Route للاختبار

**ملف `routes/web.php`:**

```php
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

Route::get('/send-welcome-email', function () {
    $user = (object) [
        'name' => 'أحمد محمد',
        'email' => 'ahmed@example.com'
    ];

    Mail::to($user->email)->send(new WelcomeEmail($user));

    return 'تم إرسال الإيميل! تحقق من Mailtrap';
});
```

### الخطوة 5: الاختبار

```
افتح المتصفح: http://localhost:8000/send-welcome-email
تحقق من Mailtrap inbox
```

---

## 🎨 إنشاء Markdown Mailable

### الخطوة 1: إنشاء Mailable

```bash
php artisan make:mail OrderShipped --markdown=emails.orders.shipped
```

### الخطوة 2: تعديل OrderShipped

**ملف `app/Mail/OrderShipped.php`:**

```php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'تم شحن طلبك رقم #' . $this->order->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.shipped',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
```

### الخطوة 3: تعديل Markdown View

**ملف `resources/views/emails/orders/shipped.blade.php`:**

```blade
@component('mail::message')
# تم شحن طلبك! 📦

مرحباً **{{ $order->customer_name }}**،

نود إعلامك بأن طلبك رقم **#{{ $order->id }}** قد تم شحنه وهو في طريقه إليك!

## تفاصيل الطلب

- **رقم الطلب:** {{ $order->id }}
- **تاريخ الطلب:** {{ $order->created_at->format('Y-m-d') }}
- **المبلغ الإجمالي:** {{ $order->total }} ريال
- **رقم التتبع:** {{ $order->tracking_number }}

@component('mail::button', ['url' => url('/orders/' . $order->id)])
تتبع الطلب
@endcomponent

## العناصر المشحونة

@component('mail::table')
| المنتج | الكمية | السعر |
|:------|:------:|------:|
@foreach($order->items as $item)
| {{ $item->name }} | {{ $item->quantity }} | {{ $item->price }} ريال |
@endforeach
@endcomponent

شكراً لاختيارك {{ config('app.name') }}!

مع أطيب التحيات،<br>
{{ config('app.name') }}

@component('mail::subcopy')
إذا واجهت مشكلة في النقر على زر "تتبع الطلب"، انسخ والصق الرابط التالي في متصفحك:
[{{ url('/orders/' . $order->id) }}]({{ url('/orders/' . $order->id) }})
@endcomponent
@endcomponent
```

---

## 🔔 إنشاء Notification System

### الخطوة 1: إنشاء جدول الإشعارات

```bash
php artisan notifications:table
php artisan migrate
```

### الخطوة 2: إضافة Notifiable Trait للـ User

**ملف `app/Models/User.php`:**

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // باقي الكود...
}
```

### الخطوة 3: إنشاء Notification

```bash
php artisan make:notification NewMessageNotification
```

### الخطوة 4: تعديل Notification

**ملف `app/Notifications/NewMessageNotification.php`:**

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessageNotification extends Notification
{
    use Queueable;

    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * القنوات التي سيتم إرسال الإشعار عبرها
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * تمثيل البريد الإلكتروني
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('رسالة جديدة من ' . $this->message->sender_name)
            ->greeting('مرحباً ' . $notifiable->name . '!')
            ->line('لديك رسالة جديدة من ' . $this->message->sender_name)
            ->line('**الموضوع:** ' . $this->message->subject)
            ->line('**الرسالة:** ' . $this->message->body)
            ->action('عرض الرسالة', url('/messages/' . $this->message->id))
            ->line('شكراً لاستخدامك ' . config('app.name'));
    }

    /**
     * تمثيل قاعدة البيانات
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => 'رسالة جديدة',
            'message' => 'رسالة جديدة من ' . $this->message->sender_name,
            'sender_name' => $this->message->sender_name,
            'subject' => $this->message->subject,
            'url' => '/messages/' . $this->message->id,
        ];
    }
}
```

### الخطوة 5: إرسال الإشعار

```php
// في Controller
public function sendMessage(Request $request)
{
    $message = (object) [
        'id' => 1,
        'sender_name' => $request->sender_name,
        'subject' => $request->subject,
        'body' => $request->body,
    ];

    $recipient = User::find($request->recipient_id);

    $recipient->notify(new NewMessageNotification($message));

    return back()->with('success', 'تم إرسال الرسالة والإشعار!');
}
```

---

## 📋 لوحة الإشعارات

### الخطوة 1: إنشاء Controller

```bash
php artisan make:controller NotificationController
```

**ملف `app/Http/Controllers/NotificationController.php`:**

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * عرض جميع الإشعارات
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * عرض الإشعارات غير المقروءة
     */
    public function unread()
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('notifications.index', compact('notifications'));
    }

    /**
     * تعليم الإشعار كمقروء
     */
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return back()->with('success', 'تم تعليم الإشعار كمقروء');
    }

    /**
     * تعليم جميع الإشعارات كمقروءة
     */
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back()->with('success', 'تم تعليم جميع الإشعارات كمقروءة');
    }

    /**
     * حذف إشعار
     */
    public function destroy($id)
    {
        auth()->user()->notifications()->find($id)?->delete();

        return back()->with('success', 'تم حذف الإشعار');
    }
}
```

### الخطوة 2: Routes

**ملف `routes/web.php`:**

```php
use App\Http\Controllers\NotificationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::get('/notifications/unread', [NotificationController::class, 'unread'])
        ->name('notifications.unread');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-read');

    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');
});
```

### الخطوة 3: View

**أنشئ ملف `resources/views/notifications/index.blade.php`:**

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الإشعارات</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .notification {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            border-right: 4px solid #667eea;
        }
        .notification.unread {
            background: #f0f4ff;
            border-right-color: #fbbf24;
        }
        .notification-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .notification-time {
            color: #666;
            font-size: 14px;
            margin-top: 10px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #667eea;
            color: white;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📬 الإشعارات</h1>
            <div>
                <span>غير المقروء: {{ auth()->user()->unreadNotifications()->count() }}</span>
                <form action="{{ route('notifications.mark-all-read') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        تعليم الكل كمقروء
                    </button>
                </form>
            </div>
        </div>

        @forelse($notifications as $notification)
            <div class="notification {{ $notification->read_at ? '' : 'unread' }}">
                <div class="notification-title">
                    {{ $notification->data['title'] ?? 'إشعار' }}
                </div>
                <p>{{ $notification->data['message'] }}</p>

                <div class="notification-time">
                    {{ $notification->created_at->diffForHumans() }}
                </div>

                <div style="margin-top: 15px;">
                    @if(!$notification->read_at)
                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                تعليم كمقروء
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="notification">
                <p style="text-align: center; color: #999;">لا توجد إشعارات</p>
            </div>
        @endforelse
    </div>
</body>
</html>
```

---

## ✅ التحقق من الإنجاز

تأكد من إكمال جميع الخطوات:

- [x] إعداد Mailtrap
- [x] إنشاء Mailable classes
- [x] إرسال إيميلات
- [x] إنشاء Notification classes
- [x] حفظ الإشعارات في قاعدة البيانات
- [x] بناء لوحة الإشعارات
- [x] تعليم الإشعارات كمقروءة

---

## 📝 ملخص الدرس العملي

### ما أنجزته اليوم:

```
✅ إعداد نظام البريد الإلكتروني
✅ إنشاء Mailable classes جميلة
✅ إرسال إيميلات HTML و Markdown
✅ بناء نظام إشعارات شامل
✅ لوحة إشعارات تفاعلية
✅ إدارة الإشعارات المقروءة وغير المقروءة
```

---

**تاريخ آخر تحديث:** 2025-11-04
**الإصدار:** 1.0
**متوافق مع:** Laravel 11.x
