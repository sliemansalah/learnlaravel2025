#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
تحويل ملفات Markdown إلى PDF
Convert Markdown files to PDF

المتطلبات (Requirements):
pip install markdown pdfkit
أو (or):
pip install markdown weasyprint

ملاحظة: قد تحتاج أيضاً لتثبيت wkhtmltopdf من:
https://wkhtmltopdf.org/downloads.html
"""

import os
import sys

def convert_with_weasyprint(md_file, pdf_file):
    """استخدام WeasyPrint للتحويل"""
    try:
        import markdown
        from weasyprint import HTML, CSS
        from weasyprint.text.fonts import FontConfiguration

        # قراءة ملف Markdown
        with open(md_file, 'r', encoding='utf-8') as f:
            md_content = f.read()

        # تحويل Markdown إلى HTML
        html_content = markdown.markdown(md_content, extensions=['extra', 'codehilite'])

        # تحديد اتجاه النص
        direction = 'rtl' if 'خطة' in md_file else 'ltr'
        lang = 'ar' if 'خطة' in md_file else 'en'

        # إنشاء HTML كامل مع التنسيق
        full_html = f"""
        <!DOCTYPE html>
        <html dir="{direction}" lang="{lang}">
        <head>
            <meta charset="UTF-8">
            <style>
                @page {{
                    size: A4;
                    margin: 2cm;
                }}
                body {{
                    font-family: 'Arial', 'Tahoma', sans-serif;
                    line-height: 1.6;
                    color: #333;
                }}
                h1 {{
                    color: #2c3e50;
                    border-bottom: 3px solid #3498db;
                    padding-bottom: 10px;
                }}
                h2 {{
                    color: #34495e;
                    border-bottom: 2px solid #95a5a6;
                    padding-bottom: 8px;
                }}
                h3 {{
                    color: #7f8c8d;
                }}
                code {{
                    background: #f4f4f4;
                    padding: 2px 6px;
                    border-radius: 3px;
                    color: #e74c3c;
                }}
                pre {{
                    background: #2c3e50;
                    color: #ecf0f1;
                    padding: 15px;
                    border-radius: 5px;
                    overflow-x: auto;
                }}
                pre code {{
                    background: none;
                    color: #ecf0f1;
                }}
                table {{
                    border-collapse: collapse;
                    width: 100%;
                    margin: 20px 0;
                }}
                table th, table td {{
                    border: 1px solid #ddd;
                    padding: 8px;
                }}
                table th {{
                    background: #3498db;
                    color: white;
                }}
            </style>
        </head>
        <body>
            {html_content}
        </body>
        </html>
        """

        # تحويل HTML إلى PDF
        font_config = FontConfiguration()
        HTML(string=full_html).write_pdf(
            pdf_file,
            font_config=font_config
        )

        print(f"✅ تم التحويل بنجاح: {pdf_file}")
        return True

    except ImportError as e:
        print(f"❌ خطأ: المكتبة غير متوفرة. قم بتثبيتها باستخدام:")
        print("   pip install markdown weasyprint")
        return False
    except Exception as e:
        print(f"❌ خطأ في التحويل: {str(e)}")
        return False

def convert_with_pdfkit(md_file, pdf_file):
    """استخدام pdfkit للتحويل"""
    try:
        import markdown
        import pdfkit

        # قراءة ملف Markdown
        with open(md_file, 'r', encoding='utf-8') as f:
            md_content = f.read()

        # تحويل Markdown إلى HTML
        html_content = markdown.markdown(md_content, extensions=['extra', 'codehilite'])

        # تحديد اتجاه النص
        direction = 'rtl' if 'خطة' in md_file else 'ltr'
        lang = 'ar' if 'خطة' in md_file else 'en'

        # إنشاء HTML كامل
        full_html = f"""
        <!DOCTYPE html>
        <html dir="{direction}" lang="{lang}">
        <head>
            <meta charset="UTF-8">
            <style>
                body {{
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    padding: 20px;
                    direction: {direction};
                }}
                h1 {{ color: #2c3e50; border-bottom: 3px solid #3498db; }}
                h2 {{ color: #34495e; border-bottom: 2px solid #95a5a6; }}
                code {{ background: #f4f4f4; padding: 2px 6px; border-radius: 3px; }}
                pre {{ background: #2c3e50; color: white; padding: 15px; border-radius: 5px; }}
            </style>
        </head>
        <body>{html_content}</body>
        </html>
        """

        # خيارات PDF
        options = {
            'page-size': 'A4',
            'margin-top': '2cm',
            'margin-right': '2cm',
            'margin-bottom': '2cm',
            'margin-left': '2cm',
            'encoding': "UTF-8",
            'no-outline': None,
            'enable-local-file-access': None
        }

        # تحويل إلى PDF
        pdfkit.from_string(full_html, pdf_file, options=options)

        print(f"✅ تم التحويل بنجاح: {pdf_file}")
        return True

    except ImportError:
        print(f"❌ خطأ: المكتبة غير متوفرة. قم بتثبيتها باستخدام:")
        print("   pip install markdown pdfkit")
        print("\nوقم بتثبيت wkhtmltopdf من:")
        print("   https://wkhtmltopdf.org/downloads.html")
        return False
    except Exception as e:
        print(f"❌ خطأ في التحويل: {str(e)}")
        return False

def main():
    """الدالة الرئيسية"""
    print("=" * 60)
    print("🔄 أداة تحويل Markdown إلى PDF")
    print("   Markdown to PDF Converter Tool")
    print("=" * 60)
    print()

    # الملفات المراد تحويلها
    files_to_convert = [
        ("خطة-تعلم-Laravel-الشاملة.md", "خطة-تعلم-Laravel-الشاملة.pdf"),
        ("Comprehensive-Laravel-Learning-Plan.md", "Comprehensive-Laravel-Learning-Plan.pdf")
    ]

    # التحقق من وجود الملفات
    for md_file, pdf_file in files_to_convert:
        if not os.path.exists(md_file):
            print(f"⚠️  الملف غير موجود: {md_file}")
            continue

        print(f"\n📄 جاري تحويل: {md_file}")
        print(f"📤 إلى: {pdf_file}")
        print("-" * 60)

        # محاولة التحويل بـ WeasyPrint أولاً
        success = convert_with_weasyprint(md_file, pdf_file)

        # إذا فشل، حاول pdfkit
        if not success:
            print("\n⏳ محاولة الطريقة البديلة...")
            success = convert_with_pdfkit(md_file, pdf_file)

        if not success:
            print("\n💡 حل بديل:")
            print(f"   1. افتح الملف: convert-to-pdf.html")
            print(f"   2. اختر الملف: {md_file}")
            print(f"   3. اضغط 'تحميل الملف'")
            print(f"   4. اضغط 'طباعة/حفظ كـ PDF'")
            print(f"   5. اختر 'حفظ كـ PDF' من نافذة الطباعة")

    print("\n" + "=" * 60)
    print("✅ انتهى!")
    print("=" * 60)

if __name__ == "__main__":
    main()
