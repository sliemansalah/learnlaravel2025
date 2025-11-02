<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;

class PdfController
{
    /**
     * Generate a simple PDF and display in browser
     */
    public function generatePdf()
    {
        $data = [
            'title' => 'Welcome to PDF Generation',
            'date' => date('m/d/Y'),
            'content' => 'This is a sample PDF generated from a Laravel view using DomPDF.'
        ];

        $pdf = Pdf::loadView('pdf.sample', $data);

        // Display PDF in browser
        return $pdf->stream('sample.pdf');
    }

    /**
     * Download PDF file
     */
    public function downloadPdf()
    {
        $data = [
            'title' => 'Invoice',
            'date' => date('m/d/Y'),
            'items' => [
                ['name' => 'Product 1', 'price' => 100],
                ['name' => 'Product 2', 'price' => 200],
                ['name' => 'Product 3', 'price' => 150],
            ],
            'total' => 450
        ];

        $pdf = Pdf::loadView('pdf.invoice', $data);

        // Force download
        return $pdf->download('invoice.pdf');
    }

    /**
     * Generate PDF with custom paper size and orientation
     */
    public function customPdf()
    {
        $data = [
            'title' => 'Landscape Report',
            'content' => 'This PDF is generated in landscape orientation.'
        ];

        $pdf = Pdf::loadView('pdf.sample', $data)
                  ->setPaper('a4', 'landscape');

        return $pdf->stream('landscape.pdf');
    }

    /**
     * Generate complete Lesson 10 documentation PDF
     */
    public function lesson10Complete()
    {
        $data = $this->getLesson10Data();

        $pdf = Pdf::loadView('pdf.lesson10-complete', $data)
                  ->setPaper('a4', 'portrait');

        return $pdf->download('lesson-10-complete-documentation.pdf');
    }

    /**
     * Generate Middleware documentation PDF
     */
    public function middlewareDocumentation()
    {
        $data = $this->getMiddlewareData();

        $pdf = Pdf::loadView('pdf.middleware-docs', $data)
                  ->setPaper('a4', 'portrait');

        return $pdf->stream('lesson-10-middleware-documentation.pdf');
    }

    /**
     * Generate code examples PDF
     */
    public function codeExamples()
    {
        $data = $this->getCodeExamplesData();

        $pdf = Pdf::loadView('pdf.code-examples', $data)
                  ->setPaper('a4', 'portrait');

        return $pdf->download('lesson-10-code-examples.pdf');
    }

    /**
     * Generate routes documentation PDF
     */
    public function routesDocumentation()
    {
        $data = $this->getRoutesData();

        $pdf = Pdf::loadView('pdf.routes-docs', $data)
                  ->setPaper('a4', 'landscape');

        return $pdf->stream('lesson-10-routes-documentation.pdf');
    }

    /**
     * Get all Lesson 10 data
     */
    private function getLesson10Data()
    {
        return [
            'title' => 'Lesson 10: Laravel Middleware Complete Documentation',
            'date' => date('F d, Y'),
            'lesson' => 'Lesson 10',
            'topic' => 'Middleware (Request Filtering)',
            'middlewares' => $this->getMiddlewareData()['middlewares'],
            'routes' => $this->getRoutesData()['routes'],
            'concepts' => [
                'What is Middleware?' => 'Middleware provides a mechanism for filtering HTTP requests entering your application.',
                'Before Middleware' => 'Executes logic before the request reaches the controller.',
                'After Middleware' => 'Executes logic after the controller processes the request.',
                'Terminable Middleware' => 'Performs tasks after the response has been sent to the browser.',
                'Global Middleware' => 'Runs on every HTTP request to your application.',
                'Route Middleware' => 'Assigned to specific routes or route groups.',
                'Middleware Parameters' => 'Pass additional data to middleware for dynamic behavior.',
            ],
        ];
    }

    /**
     * Get middleware data
     */
    private function getMiddlewareData()
    {
        return [
            'title' => 'Middleware Documentation',
            'date' => date('F d, Y'),
            'middlewares' => [
                [
                    'name' => 'CheckAge',
                    'alias' => 'check.age',
                    'file' => 'app/Http/Middleware/CheckAge.php',
                    'purpose' => 'Age verification - checks if user is 18 or older',
                    'usage' => "Route::get('/adults-only', ...)->middleware('check.age');",
                    'type' => 'Before Middleware',
                ],
                [
                    'name' => 'CheckRole',
                    'alias' => 'role',
                    'file' => 'app/Http/Middleware/CheckRole.php',
                    'purpose' => 'Role-based access control (RBAC)',
                    'usage' => "Route::middleware('role:admin')->get(...);",
                    'type' => 'Before Middleware with Parameters',
                ],
                [
                    'name' => 'LogRequests',
                    'alias' => 'N/A (Global)',
                    'file' => 'app/Http/Middleware/LogRequests.php',
                    'purpose' => 'Logs all HTTP requests with timing information',
                    'usage' => 'Applied globally in bootstrap/app.php',
                    'type' => 'Before & After Middleware',
                ],
                [
                    'name' => 'TrackPageViews',
                    'alias' => 'N/A (Global)',
                    'file' => 'app/Http/Middleware/TrackPageViews.php',
                    'purpose' => 'Tracks page views for analytics',
                    'usage' => 'Applied globally in bootstrap/app.php',
                    'type' => 'Before & After Middleware',
                ],
                [
                    'name' => 'RateLimitRequests',
                    'alias' => 'rate.limit',
                    'file' => 'app/Http/Middleware/RateLimitRequests.php',
                    'purpose' => 'Limits request rate to prevent abuse',
                    'usage' => "Route::middleware('rate.limit:10,1')->get(...);",
                    'type' => 'Before Middleware with Parameters',
                ],
                [
                    'name' => 'ValidateApiKey',
                    'alias' => 'api.key',
                    'file' => 'app/Http/Middleware/ValidateApiKey.php',
                    'purpose' => 'Validates API key for API authentication',
                    'usage' => "Route::middleware('api.key')->get(...);",
                    'type' => 'Before Middleware',
                ],
                [
                    'name' => 'SetLocale',
                    'alias' => 'locale',
                    'file' => 'app/Http/Middleware/SetLocale.php',
                    'purpose' => 'Sets application locale for internationalization',
                    'usage' => "Route::middleware('locale')->get(...);",
                    'type' => 'Before Middleware',
                ],
                [
                    'name' => 'CheckMaintenanceMode',
                    'alias' => 'maintenance',
                    'file' => 'app/Http/Middleware/CheckMaintenanceMode.php',
                    'purpose' => 'Blocks access during maintenance mode',
                    'usage' => "Route::middleware('maintenance')->get(...);",
                    'type' => 'Before Middleware',
                ],
            ],
        ];
    }

    /**
     * Get routes data
     */
    private function getRoutesData()
    {
        return [
            'title' => 'Routes Documentation',
            'date' => date('F d, Y'),
            'routes' => [
                ['method' => 'GET', 'path' => '/', 'middleware' => 'None', 'description' => 'Welcome page'],
                ['method' => 'GET', 'path' => '/adults-only', 'middleware' => 'check.age', 'description' => 'Age-restricted content'],
                ['method' => 'GET', 'path' => '/dashboard', 'middleware' => 'auth', 'description' => 'User dashboard'],
                ['method' => 'GET', 'path' => '/profile', 'middleware' => 'auth', 'description' => 'User profile'],
                ['method' => 'GET', 'path' => '/admin/dashboard', 'middleware' => 'auth, role:admin', 'description' => 'Admin dashboard'],
                ['method' => 'GET', 'path' => '/admin/users', 'middleware' => 'auth, role:admin', 'description' => 'User management'],
                ['method' => 'GET', 'path' => '/moderate', 'middleware' => 'auth, role:admin,moderator', 'description' => 'Moderation panel'],
                ['method' => 'GET', 'path' => '/analytics', 'middleware' => 'None', 'description' => 'Analytics dashboard'],
                ['method' => 'GET', 'path' => '/test-rate-limit', 'middleware' => 'rate.limit:10,1', 'description' => 'Rate limiting test'],
                ['method' => 'GET', 'path' => '/api/status', 'middleware' => 'None', 'description' => 'API status check'],
                ['method' => 'GET', 'path' => '/api/users', 'middleware' => 'api.key', 'description' => 'Get users (API key required)'],
                ['method' => 'POST', 'path' => '/api/users', 'middleware' => 'api.key', 'description' => 'Create user (API key required)'],
                ['method' => 'GET', 'path' => '/api/limited/*', 'middleware' => 'rate.limit:10,1', 'description' => 'Rate-limited API endpoints'],
                ['method' => 'GET', 'path' => '/api/premium/*', 'middleware' => 'api.key, rate.limit:30,1', 'description' => 'Premium API endpoints'],
            ],
        ];
    }

    /**
     * Get code examples data
     */
    private function getCodeExamplesData()
    {
        return [
            'title' => 'Middleware Code Examples',
            'date' => date('F d, Y'),
            'examples' => [
                [
                    'title' => 'Creating a Simple Before Middleware',
                    'description' => 'Basic middleware that runs before the request reaches the controller',
                    'code' => "<?php\n\nnamespace App\Http\Middleware;\n\nuse Closure;\nuse Illuminate\Http\Request;\n\nclass CheckAge\n{\n    public function handle(Request \$request, Closure \$next)\n    {\n        if (\$request->age < 18) {\n            return redirect('home');\n        }\n        return \$next(\$request);\n    }\n}",
                ],
                [
                    'title' => 'Middleware with Parameters',
                    'description' => 'Middleware that accepts dynamic parameters',
                    'code' => "public function handle(Request \$request, Closure \$next, string ...\$roles)\n{\n    if (!in_array(auth()->user()->role, \$roles)) {\n        abort(403, 'Unauthorized');\n    }\n    return \$next(\$request);\n}",
                ],
                [
                    'title' => 'After Middleware',
                    'description' => 'Middleware that runs after the controller processes the request',
                    'code' => "public function handle(Request \$request, Closure \$next)\n{\n    \$response = \$next(\$request);\n    \n    // Add custom header\n    \$response->headers->set('X-Custom-Header', 'Value');\n    \n    return \$response;\n}",
                ],
                [
                    'title' => 'Registering Middleware',
                    'description' => 'Register middleware in bootstrap/app.php',
                    'code' => "->withMiddleware(function (Middleware \$middleware) {\n    // Global middleware\n    \$middleware->append(LogRequests::class);\n    \n    // Route middleware\n    \$middleware->alias([\n        'check.age' => CheckAge::class,\n        'role' => CheckRole::class,\n    ]);\n})",
                ],
                [
                    'title' => 'Using Middleware in Routes',
                    'description' => 'Apply middleware to routes',
                    'code' => "// Single middleware\nRoute::get('/admin', ...)->middleware('auth');\n\n// Multiple middleware\nRoute::get('/admin', ...)->middleware(['auth', 'role:admin']);\n\n// Middleware group\nRoute::middleware(['auth'])->group(function () {\n    Route::get('/dashboard', ...);\n    Route::get('/profile', ...);\n});",
                ],
            ],
        ];
    }

    /**
     * Convert markdown file to PDF
     */
    public function markdownToPdf($filename)
    {
        $mdPath = base_path("../../{$filename}.md");

        if (!File::exists($mdPath)) {
            abort(404, "Markdown file not found: {$filename}.md");
        }

        $markdown = File::get($mdPath);
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $html = $converter->convert($markdown);

        // Determine title and language
        $titles = [
            'README' => 'Lesson 10: Middleware - Complete Guide (Arabic)',
            'README-EN' => 'Lesson 10: Middleware - Complete Guide (English)',
            'QUICK-REFERENCE' => 'Middleware Quick Reference (Arabic)',
            'QUICK-REFERENCE-EN' => 'Middleware Quick Reference (English)',
            'PRACTICE-GUIDE-AR' => 'Practice Guide (Arabic)',
            'PRACTICE-GUIDE-EN' => 'Practice Guide (English)',
            'FULL-EXAM-100-QUESTIONS' => 'Full Exam - 100 Questions',
        ];

        $data = [
            'title' => $titles[$filename] ?? $filename,
            'content' => $html,
            'filename' => $filename,
            'date' => date('F d, Y'),
        ];

        $pdf = Pdf::loadView('pdf.markdown', $data)
                  ->setPaper('a4', 'portrait');

        return $pdf->download("lesson-10-{$filename}.pdf");
    }

    /**
     * Generate all markdown files as PDFs (combined)
     */
    public function allMarkdownPdfs()
    {
        $mdFiles = [
            'README' => 'README.md',
            'README-EN' => 'README-EN.md',
            'QUICK-REFERENCE' => 'QUICK-REFERENCE.md',
            'QUICK-REFERENCE-EN' => 'QUICK-REFERENCE-EN.md',
            'PRACTICE-GUIDE-AR' => 'PRACTICE-GUIDE-AR.md',
            'PRACTICE-GUIDE-EN' => 'PRACTICE-GUIDE-EN.md',
            'FULL-EXAM-100-QUESTIONS' => 'FULL-EXAM-100-QUESTIONS.md',
        ];

        $documents = [];
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        foreach ($mdFiles as $key => $file) {
            $mdPath = base_path("../../{$file}");
            if (File::exists($mdPath)) {
                $markdown = File::get($mdPath);
                $html = $converter->convert($markdown);

                $documents[] = [
                    'title' => str_replace('-', ' ', $key),
                    'content' => $html,
                ];
            }
        }

        $data = [
            'title' => 'Lesson 10: Complete Documentation Package',
            'documents' => $documents,
            'date' => date('F d, Y'),
            'total' => count($documents),
        ];

        $pdf = Pdf::loadView('pdf.all-markdown', $data)
                  ->setPaper('a4', 'portrait');

        return $pdf->download('lesson-10-all-documentation.pdf');
    }
}
