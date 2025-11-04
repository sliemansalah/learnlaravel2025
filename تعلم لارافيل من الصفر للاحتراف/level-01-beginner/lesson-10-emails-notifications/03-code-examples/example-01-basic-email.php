<?php

/**
 * ============================================================================
 * مثال 1: إرسال إيميل بسيط
 * Example 1: Sending a Basic Email
 * ============================================================================
 *
 * هذا المثال يوضح:
 * - إنشاء Mailable class
 * - إنشاء email template
 * - إرسال إيميل
 * - تخصيص المحتوى
 *
 * This example demonstrates:
 * - Creating a Mailable class
 * - Creating email template
 * - Sending an email
 * - Customizing content
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $verificationUrl = null)
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl ?? url('/verify-email');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@example.com', config('app.name')),
            replyTo: [
                new Address('support@example.com', 'Support Team'),
            ],
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
            text: 'emails.welcome-text', // نسخة نصية بديلة
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

/**
 * ============================================================================
 * Controller Example
 * ============================================================================
 */

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * إرسال إيميل ترحيبي
     * Send welcome email
     */
    public function sendWelcomeEmail($userId)
    {
        // جلب المستخدم
        $user = User::findOrFail($userId);

        // إنشاء رابط التحقق
        $verificationUrl = url('/verify-email/' . $user->id);

        // إرسال الإيميل
        Mail::to($user->email)->send(new WelcomeEmail($user, $verificationUrl));

        return back()->with('success', 'تم إرسال إيميل الترحيب!');
    }

    /**
     * إرسال لعدة مستقبلين
     * Send to multiple recipients
     */
    public function sendToMultiple()
    {
        $users = User::where('is_active', true)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new WelcomeEmail($user));
        }

        return back()->with('success', 'تم إرسال الإيميلات لجميع المستخدمين!');
    }

    /**
     * إرسال مع CC و BCC
     * Send with CC and BCC
     */
    public function sendWithCopies()
    {
        $user = User::first();

        Mail::to($user->email)
            ->cc('manager@example.com')
            ->bcc('admin@example.com')
            ->send(new WelcomeEmail($user));

        return back()->with('success', 'تم الإرسال مع نسخة للمدير!');
    }

    /**
     * اختبار الإرسال
     * Test sending
     */
    public function testEmail()
    {
        $testUser = (object) [
            'name' => 'أحمد محمد',
            'email' => 'test@example.com',
        ];

        Mail::to($testUser->email)->send(new WelcomeEmail($testUser));

        return 'تم إرسال الإيميل التجريبي! تحقق من Mailtrap';
    }
}

/**
 * ============================================================================
 * Routes
 * ============================================================================
 */

/*
use App\Http\Controllers\EmailController;

// إرسال إيميل ترحيبي
Route::get('/send-welcome/{user}', [EmailController::class, 'sendWelcomeEmail'])
    ->name('email.welcome');

// إرسال لعدة مستخدمين
Route::get('/send-to-all', [EmailController::class, 'sendToMultiple'])
    ->name('email.multiple');

// اختبار
Route::get('/test-email', [EmailController::class, 'testEmail'])
    ->name('email.test');
*/

/**
 * ============================================================================
 * Email View: resources/views/emails/welcome.blade.php
 * ============================================================================
 */

/*
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
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
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
            font-size: 28px;
        }
        .content {
            padding: 40px 30px;
        }
        .content p {
            line-height: 1.8;
            color: #333;
            margin-bottom: 15px;
        }
        .button {
            display: inline-block;
            padding: 15px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            background: #f7f7f7;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <h1>🎉 مرحباً بك!</h1>
        </div>

        <div class="content">
            <p>عزيزي/عزيزتي <strong>{{ $user->name }}</strong>،</p>

            <p>نحن سعداء جداً بانضمامك إلى <strong>{{ config('app.name') }}</strong>!</p>

            <p>الآن يمكنك الاستمتاع بجميع المزايا التي نوفرها:</p>

            <ul>
                <li>وصول كامل إلى جميع الميزات</li>
                <li>دعم فني على مدار الساعة</li>
                <li>تحديثات مجانية</li>
                <li>مجتمع نشط ومفيد</li>
            </ul>

            <div class="divider"></div>

            <p><strong>الخطوة التالية:</strong></p>
            <p>تحقق من بريدك الإلكتروني لتفعيل حسابك</p>

            <center>
                <a href="{{ $verificationUrl }}" class="button">
                    تفعيل الحساب
                </a>
            </center>

            <div class="divider"></div>

            <p>إذا كانت لديك أي أسئلة، لا تتردد في التواصل معنا على:</p>
            <p>📧 <a href="mailto:support@example.com">support@example.com</a></p>

            <p>مع أطيب التحيات،<br><strong>فريق {{ config('app.name') }}</strong></p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.</p>
            <p style="font-size: 12px; margin-top: 10px; color: #999;">
                تلقيت هذا البريد لأنك قمت بالتسجيل في موقعنا.<br>
                إذا لم تقم بالتسجيل، يمكنك تجاهل هذا البريد.
            </p>
        </div>
    </div>
</body>
</html>
*/

/**
 * ============================================================================
 * Plain Text View: resources/views/emails/welcome-text.blade.php
 * ============================================================================
 */

/*
مرحباً {{ $user->name }}!

نحن سعداء بانضمامك إلى {{ config('app.name') }}!

الخطوة التالية:
قم بتفعيل حسابك من خلال الرابط التالي:
{{ $verificationUrl }}

إذا كانت لديك أي أسئلة، تواصل معنا على:
support@example.com

مع أطيب التحيات،
فريق {{ config('app.name') }}

© {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.
*/

/**
 * ============================================================================
 * ملاحظات مهمة | Important Notes
 * ============================================================================
 *
 * 1. إعداد البريد الإلكتروني:
 *    - تأكد من تكوين .env بشكل صحيح
 *    - استخدم Mailtrap للتطوير
 *    - لا ترسل إيميلات حقيقية في التطوير
 *
 * 2. أمان الإيميل:
 *    - لا تضع معلومات حساسة
 *    - استخدم HTTPS في الروابط
 *    - أضف توقيع رقمي للروابط المهمة
 *
 * 3. تحسين الأداء:
 *    - استخدم Queue للإيميلات
 *    - لا ترسل إيميلات كثيرة مرة واحدة
 *    - استخدم delay للإرسال المجدول
 *
 * 4. التصميم:
 *    - استخدم inline CSS
 *    - اجعل التصميم responsive
 *    - اختبر على email clients مختلفة
 *
 * 5. المحتوى:
 *    - اجعل الرسالة واضحة ومختصرة
 *    - أضف CTA واضح (Call To Action)
 *    - وفر نسخة نصية بديلة
 */

/**
 * ============================================================================
 * تحسينات متقدمة | Advanced Improvements
 * ============================================================================
 *
 * 1. Email Localization:
 *    - دعم لغات متعددة
 *    - محتوى ديناميكي حسب لغة المستخدم
 *
 * 2. Email Tracking:
 *    - تتبع فتح الإيميل
 *    - تتبع النقرات على الروابط
 *    - إحصائيات الإيميلات
 *
 * 3. Email Templates:
 *    - قوالب قابلة لإعادة الاستخدام
 *    - تخصيص سهل
 *    - Brand consistency
 *
 * 4. Testing:
 *    - كتابة tests للإيميلات
 *    - Mock sending في الاختبارات
 *    - Preview emails قبل الإرسال
 */
