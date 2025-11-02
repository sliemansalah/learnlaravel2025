<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson 10 - PDF Documentation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }
        .header h1 {
            font-size: 3em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .header p {
            font-size: 1.2em;
            opacity: 0.9;
        }
        .section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .section h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 1.8em;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }
        .pdf-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }
        .pdf-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 8px;
            padding: 25px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            display: block;
        }
        .pdf-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            border-color: #667eea;
        }
        .pdf-card h3 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 1.3em;
        }
        .pdf-card p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .pdf-icon {
            display: inline-block;
            padding: 8px 15px;
            background: #667eea;
            color: white;
            border-radius: 5px;
            font-size: 0.9em;
            font-weight: bold;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            background: #e74c3c;
            color: white;
            border-radius: 12px;
            font-size: 0.8em;
            margin-left: 10px;
        }
        .badge.download {
            background: #27ae60;
        }
        .badge.view {
            background: #3498db;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            padding: 20px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 8px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #667eea;
        }
        .stat-label {
            color: #666;
            margin-top: 5px;
        }
        .info-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .info-box strong {
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 Lesson 10: Middleware</h1>
            <p>Complete PDF Documentation Collection</p>
        </div>

        <div class="section">
            <h2>📖 Complete Documentation</h2>
            <div class="info-box">
                <strong>Start here!</strong> Download the complete documentation to get everything in one comprehensive PDF.
            </div>
            <div class="pdf-grid">
                <a href="<?php echo e(route('pdf.lesson10.complete')); ?>" class="pdf-card">
                    <h3>Complete Lesson Documentation</h3>
                    <p>All-in-one PDF containing concepts, middleware implementations, routes, and best practices.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                    <span class="badge download">Recommended</span>
                </a>
            </div>
        </div>

        <div class="section">
            <h2>🎯 Specific Topics</h2>
            <p style="margin-bottom: 20px; color: #666;">Choose individual PDFs for focused learning on specific topics.</p>
            <div class="pdf-grid">
                <a href="<?php echo e(route('pdf.lesson10.middleware')); ?>" class="pdf-card">
                    <h3>Middleware Documentation</h3>
                    <p>Detailed documentation of all 8 custom middleware implementations with usage examples.</p>
                    <span class="pdf-icon">👁️ View PDF</span>
                    <span class="badge view">View</span>
                </a>

                <a href="<?php echo e(route('pdf.lesson10.code')); ?>" class="pdf-card">
                    <h3>Code Examples</h3>
                    <p>Practical code examples showing how to create, register, and use middleware in Laravel.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                    <span class="badge download">Download</span>
                </a>

                <a href="<?php echo e(route('pdf.lesson10.routes')); ?>" class="pdf-card">
                    <h3>Routes Documentation</h3>
                    <p>Complete routes overview with middleware configuration in landscape format.</p>
                    <span class="pdf-icon">👁️ View PDF</span>
                    <span class="badge view">Landscape</span>
                </a>
            </div>
        </div>

        <div class="section">
            <h2>📄 Markdown Documentation PDFs</h2>
            <div class="info-box">
                <strong>All Lesson 10 markdown files!</strong> Download individual MD files as PDFs or get them all in one package.
            </div>
            <div class="pdf-grid">
                <a href="<?php echo e(route('pdf.md.all')); ?>" class="pdf-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <h3 style="color: white;">📦 All Markdown Files (Combined)</h3>
                    <p style="color: white;">Complete package with all 7 markdown files in one comprehensive PDF.</p>
                    <span class="pdf-icon" style="background: #c92a2a;">📥 Download All</span>
                    <span class="badge download">Super Pack</span>
                </a>
            </div>

            <h3 style="margin-top: 30px; color: #555;">Arabic Documentation</h3>
            <div class="pdf-grid">
                <a href="<?php echo e(route('pdf.md.readme')); ?>" class="pdf-card">
                    <h3>README (Arabic)</h3>
                    <p>Complete middleware guide in Arabic with detailed explanations and examples.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                    <span class="badge" style="background: #16a085;">29 KB</span>
                </a>

                <a href="<?php echo e(route('pdf.md.quick-ref')); ?>" class="pdf-card">
                    <h3>Quick Reference (Arabic)</h3>
                    <p>Quick reference guide in Arabic for middleware concepts and syntax.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                    <span class="badge" style="background: #16a085;">9 KB</span>
                </a>

                <a href="<?php echo e(route('pdf.md.practice-ar')); ?>" class="pdf-card">
                    <h3>Practice Guide (Arabic)</h3>
                    <p>Hands-on practice exercises and solutions in Arabic.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                    <span class="badge" style="background: #16a085;">25 KB</span>
                </a>
            </div>

            <h3 style="margin-top: 30px; color: #555;">English Documentation</h3>
            <div class="pdf-grid">
                <a href="<?php echo e(route('pdf.md.readme-en')); ?>" class="pdf-card">
                    <h3>README (English)</h3>
                    <p>Complete middleware guide in English with detailed explanations and examples.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                    <span class="badge" style="background: #2980b9;">26 KB</span>
                </a>

                <a href="<?php echo e(route('pdf.md.quick-ref-en')); ?>" class="pdf-card">
                    <h3>Quick Reference (English)</h3>
                    <p>Quick reference guide in English for middleware concepts and syntax.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                    <span class="badge" style="background: #2980b9;">8 KB</span>
                </a>

                <a href="<?php echo e(route('pdf.md.practice-en')); ?>" class="pdf-card">
                    <h3>Practice Guide (English)</h3>
                    <p>Hands-on practice exercises and solutions in English.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                    <span class="badge" style="background: #2980b9;">22 KB</span>
                </a>
            </div>

            <h3 style="margin-top: 30px; color: #555;">Exam Materials</h3>
            <div class="pdf-grid">
                <a href="<?php echo e(route('pdf.md.exam')); ?>" class="pdf-card">
                    <h3>Full Exam - 100 Questions</h3>
                    <p>Comprehensive exam with 100 questions covering all middleware concepts.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                    <span class="badge" style="background: #e74c3c;">22 KB</span>
                </a>
            </div>
        </div>

        <div class="section">
            <h2>🔥 Basic Examples</h2>
            <p style="margin-bottom: 20px; color: #666;">Simple PDF generation examples for testing and learning.</p>
            <div class="pdf-grid">
                <a href="<?php echo e(route('pdf.sample')); ?>" class="pdf-card">
                    <h3>Sample PDF</h3>
                    <p>Basic PDF example demonstrating simple content generation.</p>
                    <span class="pdf-icon">👁️ View PDF</span>
                </a>

                <a href="<?php echo e(route('pdf.invoice')); ?>" class="pdf-card">
                    <h3>Invoice PDF</h3>
                    <p>Professional invoice template with tables and styling.</p>
                    <span class="pdf-icon">📥 Download PDF</span>
                </a>

                <a href="<?php echo e(route('pdf.landscape')); ?>" class="pdf-card">
                    <h3>Landscape PDF</h3>
                    <p>Example of landscape orientation PDF generation.</p>
                    <span class="pdf-icon">👁️ View PDF</span>
                </a>
            </div>
        </div>

        <div class="section">
            <h2>📊 Documentation Statistics</h2>
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">7</div>
                    <div class="stat-label">MD Files</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Middleware</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">14+</div>
                    <div class="stat-label">Routes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Total PDFs</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>ℹ️ About This Collection</h2>
            <p style="line-height: 1.8; color: #555;">
                This documentation collection covers Laravel Middleware in comprehensive detail. It includes:
            </p>
            <ul style="margin: 20px 0 20px 30px; line-height: 2; color: #555;">
                <li>Complete middleware implementations with source code</li>
                <li>Practical examples for real-world applications</li>
                <li>Route configurations and middleware assignments</li>
                <li>Best practices and common use cases</li>
                <li>Step-by-step code examples</li>
            </ul>
            <div style="margin-top: 20px; padding: 15px; background: #d4edda; border-left: 4px solid #28a745; border-radius: 4px;">
                <strong style="color: #155724;">💡 Tip:</strong>
                <span style="color: #155724;">Start with the "Complete Lesson Documentation" for a comprehensive overview, then dive into specific topics as needed.</span>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\learnlaravel2025\lessons\lesson-10\practice-app\resources\views/pdf-index.blade.php ENDPATH**/ ?>