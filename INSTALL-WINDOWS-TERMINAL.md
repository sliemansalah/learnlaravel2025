# تثبيت Windows Terminal لدعم RTL

## الطريقة الأولى: Microsoft Store (الأسهل)

1. افتح Microsoft Store
2. ابحث عن "Windows Terminal"
3. اضغط "تثبيت" / "Install"
4. انتظر التثبيت (حجم صغير، حوالي 30MB)

## الطريقة الثانية: winget (إذا كان لديك)

```cmd
winget install Microsoft.WindowsTerminal
```

## الطريقة الثالثة: تحميل مباشر

قم بتحميل من GitHub:
https://github.com/microsoft/terminal/releases/latest

---

## بعد التثبيت:

1. افتح Windows Terminal
2. اضغط `Ctrl+,` لفتح الإعدادات
3. في قسم "Defaults" تحت "Profiles":
   - Font face: اختر "Courier New" أو "Segoe UI" أو "Traditional Arabic"
   - Font size: 12

4. حفظ الإعدادات

5. اختبر بالأمر:
```bash
echo "سليمان"
```

يجب أن يظهر بشكل صحيح من اليمين لليسار: سليمان (وليس ناميلس)

---

## إعدادات إضافية للأداء الأفضل:

في settings.json أضف:

```json
{
    "profiles": {
        "defaults": {
            "font": {
                "face": "Courier New"
            },
            "useAtlasEngine": true
        }
    }
}
```

---

## ملاحظة مهمة:

- Git Bash **لا يدعم RTL مطلقاً**
- CMD التقليدي **لا يدعم RTL بشكل صحيح**
- PowerShell التقليدي **له مشاكل مع RTL**
- **Windows Terminal فقط** يدعم RTL بشكل صحيح في Windows

---

## بديل آخر: Tabby Terminal

إذا لم يعمل Windows Terminal بشكل جيد، جرب Tabby:
https://tabby.sh

Tabby يدعم RTL بشكل ممتاز أيضاً.
