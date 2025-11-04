# أمثلة الكود - الإيميلات والإشعارات
# Code Examples - Emails and Notifications

---

## 📋 نظرة عامة | Overview

هذا المجلد يحتوي على أمثلة عملية لإرسال الإيميلات والإشعارات في Laravel.

---

## 📁 الملفات | Files

### 1. `example-01-basic-email.php`
**الوصف:** إرسال إيميل بسيط
- Mailable class أساسي
- HTML email template
- إرسال فوري

**المفاهيم:**
- Creating Mailables
- Email views
- Mail Facade
- SMTP configuration

---

### 2. `example-02-notification-system.php`
**الوصف:** نظام إشعارات متكامل
- Notification classes
- Multiple channels (mail, database)
- Notification management

**المفاهيم:**
- Notifications
- Via channels
- Database storage
- Notifiable trait

---

### 3. `example-03-queued-emails.php`
**الوصف:** إرسال إيميلات عبر Queue
- Queue configuration
- Delayed sending
- Performance optimization

**المفاهيم:**
- ShouldQueue interface
- Queue workers
- Job delays
- Background processing

---

### 4. `example-04-email-attachments.php`
**الوصف:** إرفاق ملفات مع الإيميلات
- ملفات من المسار
- ملفات من Storage
- PDF generation

**المفاهيم:**
- Attachments
- Storage integration
- File handling
- Dynamic attachments

---

### 5. `email-templates/`
**الوصف:** قوالب إيميل جاهزة
- Welcome email
- Order confirmation
- Password reset
- Invoice email

---

## 🚀 كيفية الاستخدام | How to Use

### الخطوة 1: إعداد البريد
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

### الخطوة 2: نسخ الكود
انسخ المثال المطلوب

### الخطوة 3: إنشاء الملفات
- أنشئ Mailable/Notification class
- أنشئ View template
- أضف Routes للاختبار

### الخطوة 4: التجربة
افتح المتصفح وجرّب الكود

---

## 📝 ملاحظات | Notes

- استخدم Mailtrap للتطوير
- جميع الأمثلة جاهزة للاستخدام
- راجع comments للشرح التفصيلي

---

**تاريخ آخر تحديث:** 2025-11-04
**متوافق مع:** Laravel 11.x
