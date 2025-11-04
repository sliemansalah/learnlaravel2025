<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * عرض صفحة الملف الشخصي
     * Display the profile page
     */
    public function show()
    {
        $user = User::first(); // للتبسيط، نستخدم أول مستخدم
        // في تطبيق حقيقي: $user = auth()->user();

        return view('profile.show', compact('user'));
    }

    /**
     * تحديث الصورة الشخصية
     * Update the avatar
     */
    public function updateAvatar(Request $request)
    {
        // التحقق من صحة الملف
        $request->validate([
            'avatar' => [
                'required',
                'image', // يجب أن يكون صورة (jpeg, png, bmp, gif, svg, webp)
                'mimes:jpeg,png,jpg,gif',
                'max:2048', // الحد الأقصى 2MB
                'dimensions:min_width=100,min_height=100', // أبعاد لا تقل عن 100x100
            ],
        ], [
            'avatar.required' => 'الرجاء اختيار صورة',
            'avatar.image' => 'يجب أن يكون الملف صورة',
            'avatar.mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif',
            'avatar.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت',
            'avatar.dimensions' => 'أبعاد الصورة يجب أن تكون على الأقل 100x100 بكسل',
        ]);

        $user = User::first(); // للتبسيط
        // في تطبيق حقيقي: $user = auth()->user();

        // حذف الصورة القديمة إن وجدت
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // تخزين الصورة الجديدة
        // سيتم حفظها في: storage/app/public/avatars/random-name.jpg
        $path = $request->file('avatar')->store('avatars', 'public');

        // تحديث مسار الصورة في قاعدة البيانات
        $user->update(['avatar' => $path]);

        return redirect()
            ->route('profile.show')
            ->with('success', 'تم تحديث الصورة الشخصية بنجاح!');
    }

    /**
     * حذف الصورة الشخصية
     * Delete the avatar
     */
    public function deleteAvatar()
    {
        $user = User::first(); // للتبسيط
        // في تطبيق حقيقي: $user = auth()->user();

        if ($user->avatar) {
            // حذف الملف من التخزين
            Storage::disk('public')->delete($user->avatar);

            // حذف المسار من قاعدة البيانات
            $user->update(['avatar' => null]);

            return redirect()
                ->route('profile.show')
                ->with('success', 'تم حذف الصورة الشخصية بنجاح!');
        }

        return redirect()
            ->route('profile.show')
            ->with('error', 'لا توجد صورة شخصية لحذفها!');
    }
}
