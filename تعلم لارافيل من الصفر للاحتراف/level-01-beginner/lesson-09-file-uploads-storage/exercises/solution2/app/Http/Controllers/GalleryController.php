<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class GalleryController extends Controller
{
    /**
     * عرض جميع الصور في المعرض
     * Display all gallery images
     */
    public function index()
    {
        $images = Gallery::latest()->paginate(12);

        return view('gallery.index', compact('images'));
    }

    /**
     * عرض صفحة رفع الصور
     * Show upload form
     */
    public function create()
    {
        return view('gallery.upload');
    }

    /**
     * رفع الصور مع إنشاء thumbnails
     * Upload images with thumbnail generation
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'images' => 'required|array|min:1|max:10',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
        ], [
            'title.required' => 'العنوان مطلوب',
            'images.required' => 'يجب اختيار صورة واحدة على الأقل',
            'images.*.image' => 'يجب أن تكون جميع الملفات صوراً',
            'images.*.max' => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت',
        ]);

        $uploadedCount = 0;

        foreach ($request->file('images') as $index => $file) {
            $filename = time() . '_' . $index . '.' . $file->extension();

            // الصورة الأصلية | Original image
            $originalPath = 'gallery/original/' . $filename;
            $image = Image::read($file);
            Storage::disk('public')->put($originalPath, (string) $image->encode());

            // صورة متوسطة 800px | Medium image
            $mediumPath = 'gallery/medium/' . $filename;
            $mediumImage = Image::read($file)->scale(width: 800);
            Storage::disk('public')->put($mediumPath, (string) $mediumImage->encode());

            // صورة مصغرة 300x300 | Thumbnail
            $thumbnailPath = 'gallery/thumbnails/' . $filename;
            $thumbnail = Image::read($file)->cover(300, 300);
            Storage::disk('public')->put($thumbnailPath, (string) $thumbnail->encode());

            // حفظ في قاعدة البيانات | Save to database
            Gallery::create([
                'title' => $request->title . ($index > 0 ? ' - ' . ($index + 1) : ''),
                'description' => $request->description,
                'original_path' => $originalPath,
                'medium_path' => $mediumPath,
                'thumbnail_path' => $thumbnailPath,
                'filename' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);

            $uploadedCount++;
        }

        return redirect()
            ->route('gallery.index')
            ->with('success', "تم رفع {$uploadedCount} صورة بنجاح!");
    }

    /**
     * عرض صورة واحدة
     * Show single image
     */
    public function show($id)
    {
        $image = Gallery::findOrFail($id);

        return view('gallery.show', compact('image'));
    }

    /**
     * حذف صورة
     * Delete image
     */
    public function destroy($id)
    {
        $image = Gallery::findOrFail($id);

        // الحذف سيتم تلقائياً من خلال Model event
        // Deletion will happen automatically through Model event
        $image->delete();

        return redirect()
            ->route('gallery.index')
            ->with('success', 'تم حذف الصورة بنجاح!');
    }
}
