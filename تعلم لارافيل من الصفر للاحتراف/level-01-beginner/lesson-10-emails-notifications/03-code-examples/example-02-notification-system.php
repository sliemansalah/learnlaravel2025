<?php

/**
 * ============================================================================
 * مثال 2: نظام إشعارات متكامل
 * Example 2: Complete Notification System
 * ============================================================================
 *
 * هذا المثال يوضح:
 * - إنشاء Notification classes
 * - إرسال إشعارات متعددة القنوات
 * - حفظ الإشعارات في قاعدة البيانات
 * - إدارة الإشعارات (قراءة، حذف)
 * - واجهة عرض الإشعارات
 *
 * This example demonstrates:
 * - Creating Notification classes
 * - Multi-channel notifications
 * - Database storage
 * - Notification management
 * - Notification interface
 */

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * ============================================================================
 * Notification Class
 * ============================================================================
 */
class UserActionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $action;
    private $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($action, $data = [])
    {
        $this->action = $action;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        // يمكن التحكم بالقنوات ديناميكياً
        $channels = ['database'];

        // إرسال إيميل للأحداث المهمة فقط
        if (in_array($this->action, ['order_shipped', 'payment_received'])) {
            $channels[] = 'mail';
        }

        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject($this->getSubject())
            ->greeting('مرحباً ' . $notifiable->name . '!');

        // محتوى ديناميكي حسب نوع الإجراء
        switch ($this->action) {
            case 'order_shipped':
                $message->line('تم شحن طلبك رقم #' . $this->data['order_id'])
                        ->line('رقم التتبع: ' . $this->data['tracking_number'])
                        ->action('تتبع الطلب', url('/orders/' . $this->data['order_id']))
                        ->line('شكراً لتسوقك معنا!');
                break;

            case 'payment_received':
                $message->line('تم استلام دفعتك بنجاح')
                        ->line('المبلغ: ' . $this->data['amount'] . ' ريال')
                        ->line('رقم المعاملة: ' . $this->data['transaction_id'])
                        ->action('عرض الفاتورة', url('/invoices/' . $this->data['invoice_id']));
                break;

            case 'new_message':
                $message->line('لديك رسالة جديدة من ' . $this->data['sender'])
                        ->line('الموضوع: ' . $this->data['subject'])
                        ->action('قراءة الرسالة', url('/messages/' . $this->data['message_id']));
                break;
        }

        return $message;
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'action' => $this->action,
            'title' => $this->getTitle(),
            'message' => $this->getMessage(),
            'icon' => $this->getIcon(),
            'url' => $this->getUrl(),
            'data' => $this->data,
        ];
    }

    /**
     * Get notification title
     */
    private function getTitle(): string
    {
        $titles = [
            'order_shipped' => 'تم شحن الطلب',
            'payment_received' => 'تم استلام الدفعة',
            'new_message' => 'رسالة جديدة',
            'account_verified' => 'تم تفعيل الحساب',
            'password_changed' => 'تم تغيير كلمة المرور',
        ];

        return $titles[$this->action] ?? 'إشعار جديد';
    }

    /**
     * Get notification message
     */
    private function getMessage(): string
    {
        switch ($this->action) {
            case 'order_shipped':
                return 'تم شحن طلبك رقم #' . ($this->data['order_id'] ?? '');
            case 'payment_received':
                return 'تم استلام دفعة بمبلغ ' . ($this->data['amount'] ?? 0) . ' ريال';
            case 'new_message':
                return 'رسالة جديدة من ' . ($this->data['sender'] ?? 'مستخدم');
            default:
                return 'لديك إشعار جديد';
        }
    }

    /**
     * Get notification icon
     */
    private function getIcon(): string
    {
        $icons = [
            'order_shipped' => '📦',
            'payment_received' => '💰',
            'new_message' => '✉️',
            'account_verified' => '✅',
            'password_changed' => '🔐',
        ];

        return $icons[$this->action] ?? '🔔';
    }

    /**
     * Get notification URL
     */
    private function getUrl(): string
    {
        switch ($this->action) {
            case 'order_shipped':
                return '/orders/' . ($this->data['order_id'] ?? '');
            case 'payment_received':
                return '/invoices/' . ($this->data['invoice_id'] ?? '');
            case 'new_message':
                return '/messages/' . ($this->data['message_id'] ?? '');
            default:
                return '/notifications';
        }
    }

    /**
     * Get email subject
     */
    private function getSubject(): string
    {
        return $this->getIcon() . ' ' . $this->getTitle();
    }
}

/**
 * ============================================================================
 * Notification Controller
 * ============================================================================
 */

namespace App\Http\Controllers;

use App\Notifications\UserActionNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * عرض جميع الإشعارات
     */
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->paginate(15);

        $unreadCount = auth()->user()->unreadNotifications()->count();

        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * عرض الإشعارات غير المقروءة فقط
     */
    public function unread()
    {
        $notifications = auth()->user()
            ->unreadNotifications()
            ->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * تعليم إشعار واحد كمقروء
     */
    public function markAsRead($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        // إعادة التوجيه إلى URL الإشعار
        $url = $notification->data['url'] ?? '/';

        return redirect($url);
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
        auth()->user()
            ->notifications()
            ->findOrFail($id)
            ->delete();

        return back()->with('success', 'تم حذف الإشعار');
    }

    /**
     * حذف جميع الإشعارات المقروءة
     */
    public function deleteRead()
    {
        auth()->user()
            ->readNotifications()
            ->delete();

        return back()->with('success', 'تم حذف جميع الإشعارات المقروءة');
    }

    /**
     * الحصول على الإشعارات عبر API (للتحديث التلقائي)
     */
    public function getUnreadNotifications()
    {
        $notifications = auth()->user()
            ->unreadNotifications()
            ->take(5)
            ->get();

        return response()->json([
            'count' => $notifications->count(),
            'notifications' => $notifications,
        ]);
    }
}

/**
 * ============================================================================
 * Usage Examples
 * ============================================================================
 */

class ExampleUsageController extends Controller
{
    /**
     * مثال: إرسال إشعار شحن الطلب
     */
    public function orderShipped($orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = $order->user;

        $user->notify(new UserActionNotification('order_shipped', [
            'order_id' => $order->id,
            'tracking_number' => $order->tracking_number,
        ]));

        return back()->with('success', 'تم إرسال إشعار الشحن للعميل');
    }

    /**
     * مثال: إرسال إشعار استلام الدفعة
     */
    public function paymentReceived($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $user = $payment->user;

        $user->notify(new UserActionNotification('payment_received', [
            'amount' => $payment->amount,
            'transaction_id' => $payment->transaction_id,
            'invoice_id' => $payment->invoice_id,
        ]));

        return back()->with('success', 'تم إرسال إشعار الدفع');
    }

    /**
     * مثال: إرسال إشعار لعدة مستخدمين
     */
    public function notifyAllUsers()
    {
        $users = User::where('is_active', true)->get();

        Notification::send($users, new UserActionNotification('announcement', [
            'title' => 'إعلان مهم',
            'message' => 'لدينا ميزات جديدة!',
        ]));

        return back()->with('success', 'تم إرسال الإشعار لجميع المستخدمين');
    }
}

/**
 * ============================================================================
 * Routes
 * ============================================================================
 */

/*
use App\Http\Controllers\NotificationController;

Route::middleware(['auth'])->group(function () {
    // عرض الإشعارات
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::get('/notifications/unread', [NotificationController::class, 'unread'])
        ->name('notifications.unread');

    // إدارة الإشعارات
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-read');

    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');

    Route::delete('/notifications/delete-read', [NotificationController::class, 'deleteRead'])
        ->name('notifications.delete-read');

    // API للإشعارات
    Route::get('/api/notifications/unread', [NotificationController::class, 'getUnreadNotifications'])
        ->name('api.notifications.unread');
});
*/

/**
 * ============================================================================
 * View: resources/views/notifications/index.blade.php
 * ============================================================================
 */

/*
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>الإشعارات</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f5f7fa;
            padding: 20px;
        }
        .container { max-width: 900px; margin: 0 auto; }
        .header {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .notification {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            border-right: 4px solid #e5e7eb;
            transition: all 0.3s;
            cursor: pointer;
        }
        .notification:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .notification.unread {
            background: #f0f9ff;
            border-right-color: #3b82f6;
        }
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .notification-icon {
            font-size: 24px;
            margin-left: 10px;
        }
        .notification-title {
            font-weight: bold;
            font-size: 16px;
        }
        .notification-time {
            color: #6b7280;
            font-size: 13px;
        }
        .notification-message {
            color: #4b5563;
            line-height: 1.6;
            margin: 10px 0;
        }
        .notification-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }
        .badge {
            background: #ef4444;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>🔔 الإشعارات</h1>
                @if($unreadCount > 0)
                    <span class="badge">{{ $unreadCount }} جديد</span>
                @endif
            </div>
            <div>
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
                <div class="notification-header">
                    <div style="display: flex; align-items: center;">
                        <span class="notification-icon">
                            {{ $notification->data['icon'] ?? '🔔' }}
                        </span>
                        <span class="notification-title">
                            {{ $notification->data['title'] ?? 'إشعار' }}
                        </span>
                    </div>
                    <span class="notification-time">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </div>

                <div class="notification-message">
                    {{ $notification->data['message'] }}
                </div>

                <div class="notification-actions">
                    @if(!$notification->read_at)
                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                تعليم كمقروء
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('هل تريد حذف هذا الإشعار؟')">
                            حذف
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="notification">
                <p style="text-align: center; color: #9ca3af; padding: 40px 0;">
                    لا توجد إشعارات
                </p>
            </div>
        @endforelse

        {{ $notifications->links() }}
    </div>

    <script>
        // تحديث تلقائي للإشعارات كل 30 ثانية
        setInterval(() => {
            fetch('/api/notifications/unread')
                .then(response => response.json())
                .then(data => {
                    if (data.count > 0) {
                        // يمكن إظهار badge أو تنبيه
                        console.log('لديك ' + data.count + ' إشعارات جديدة');
                    }
                });
        }, 30000);
    </script>
</body>
</html>
*/

/**
 * ============================================================================
 * ملاحظات مهمة | Important Notes
 * ============================================================================
 *
 * 1. قاعدة البيانات:
 *    - أنشئ جدول notifications: php artisan notifications:table
 *    - شغل migration: php artisan migrate
 *
 * 2. الأداء:
 *    - استخدم ShouldQueue للإشعارات
 *    - استخدم Pagination للعرض
 *    - أضف index على notifiable_type و read_at
 *
 * 3. التخصيص:
 *    - يمكن تخصيص القنوات حسب نوع الإشعار
 *    - يمكن إضافة preferences للمستخدم
 *    - يمكن جدولة الإشعارات
 *
 * 4. الأمان:
 *    - تحقق من الصلاحيات قبل الإرسال
 *    - لا ترسل معلومات حساسة في الإشعارات
 *    - استخدم middleware للحماية
 */
