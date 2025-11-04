# ED.5 'D/13 9: 1A9 'DEDA'* H'D*.2JF
# Lesson 9 Summary: File Uploads and Storage

---

##  E' *E %F,'2G | What's Completed

### 1. 'DEDA'* 'DF81J) | Theory Files
-  `01-theory.md` - /DJD 4'ED D1A9 'DEDA'* H'D*.2JF (Complete guide)

### 2. 'D#E+D) 'D9EDJ) | Practical Solutions
-  **Solution 1:** F8'E 1A9 'D5H1 'D4.5J) (Avatar Upload) - **EC*ED 100%**
- ™ **Solution 2:** E916 'D5H1 E9 Thumbnails - **GJCD #3'3J ,'G2**
- =Ë **Solution 3:** %/'1) 'DE3*F/'* 'D.'5) - **E.77 ,'G2**

---

## <¯ 'D#G/'A 'DE-BB) | Learning Objectives Achieved

###  'DE3*HI 'D#3'3J (Solution 1)
1. **1A9 'DEDA'*:**
   - '3*./'E `$request->file()` DD-5HD 9DI 'DEDA'*
   - 71JB) `store()` D-A8 'DEDA'*
   - `enctype="multipart/form-data"` AJ 'DFE'0,

2. **'D*-BB EF 'DEDA'*:**
   - BH'9/ Validation DD5H1: `image`, `mimes`, `max`, `dimensions`
   - 13'&D .7# E.55) ('D91(J)
   - 'D*-BB EF 'DFH9 H'D-,E H'D#(9'/

3. **Storage Facade:**
   - `Storage::disk('public')` DDEDA'* 'D9'E)
   - `delete()` D-0A 'DEDA'*
   - Symbolic links: `php artisan storage:link`

4. **%/'1) 'DEDA'*:**
   - -0A 'DEDA'* 'DB/JE) *DB'&J'K
   - *.2JF 'DE3'1 AJ B'9/) 'D(J'F'*
   - 916 'D5H1 ('3*./'E `asset()`

### =Ú 'DE3*HI 'DE*H37 (Solution 2 - Code Examples)
E9'D,) 'D5H1 ('3*./'E Intervention Image

### = 'DE3*HI 'DE*B/E (Solution 3 - Code Examples)
-E'J) 'DEDA'* 'D.'5) H%/'1) 'D5D'-J'*

---

## =» 'DCH/ 'D#3'3J | Core Code Examples

### 1. 1A9 5H1) (3J7) | Basic Image Upload

```php
// Controller
public function upload(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // *.2JF 'D5H1)
    $path = $request->file('image')->store('images', 'public');

    return back()->with('success', '*E 1A9 'D5H1) (F,'-!');
}
```

```html
<!-- Form -->
<form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" accept="image/*">
    <button type="submit">1A9</button>
</form>
```

### 2. 1A9 E9 -0A 'DB/JE | Upload with Delete Old

```php
public function updateAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|max:2048',
    ]);

    $user = auth()->user();

    // -0A 'D5H1) 'DB/JE)
    if ($user->avatar) {
        Storage::disk('public')->delete($user->avatar);
    }

    // 1A9 'D,/J/)
    $path = $request->file('avatar')->store('avatars', 'public');
    $user->update(['avatar' => $path]);

    return back()->with('success', '*E *-/J+ 'D5H1)!');
}
```

### 3. E9'D,) 'D5H1 E9 Intervention Image

```php
use Intervention\Image\Laravel\Facades\Image;

public function uploadWithThumbnail(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:5120',
    ]);

    $file = $request->file('image');
    $filename = time() . '.jpg';

    // 'D5H1) 'D#5DJ)
    $original = Image::read($file);
    Storage::disk('public')->put(
        'images/original/' . $filename,
        (string) $original->encode()
    );

    // 5H1) E*H37) 800px
    $medium = Image::read($file)->scale(width: 800);
    Storage::disk('public')->put(
        'images/medium/' . $filename,
        (string) $medium->encode()
    );

    // 5H1) E5:1) 200x200
    $thumbnail = Image::read($file)->cover(200, 200);
    Storage::disk('public')->put(
        'images/thumbnails/' . $filename,
        (string) $thumbnail->encode()
    );

    return [
        'original' => 'images/original/' . $filename,
        'medium' => 'images/medium/' . $filename,
        'thumbnail' => 'images/thumbnails/' . $filename,
    ];
}
```

### 4. 1A9 9/) EDA'* | Multiple File Upload

```php
public function uploadMultiple(Request $request)
{
    $request->validate([
        'images' => 'required|array|min:1|max:10',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $paths = [];

    foreach ($request->file('images') as $image) {
        $paths[] = $image->store('gallery', 'public');
    }

    return back()->with('success', '*E 1A9 ' . count($paths) . ' 5H1)!');
}
```

```html
<!-- Multiple File Input -->
<input type="file" name="images[]" multiple accept="image/*">
```

### 5. EDA'* .'5) (Private Files)

```php
// 1A9 EDA .'5
public function uploadPrivate(Request $request)
{
    $request->validate([
        'document' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ]);

    // *.2JF AJ disk local (DJ3 public)
    $path = $request->file('document')->store('documents', 'local');

    Document::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'path' => $path,
    ]);

    return back()->with('success', '*E 1A9 'DE3*F/!');
}

// *-EJD EDA .'5 (E9 'D*-BB EF 'D5D'-J'*)
public function download($id)
{
    $document = Document::findOrFail($id);

    // *-BB EF 'D5D'-J'*
    if ($document->user_id !== auth()->id()) {
        abort(403, ':J1 E51- DC ('DH5HD');
    }

    $path = storage_path('app/' . $document->path);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path, $document->title);
}
```

### 6. 916 'DEDA AJ 'DE*5A- | Display in Browser

```php
public function show($filename)
{
    $path = 'documents/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return response($file, 200)->header('Content-Type', $type);
}
```

---

## =Ê #E+D) Migration | Migration Examples

### Gallery Table
```php
Schema::create('galleries', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('original_path');
    $table->string('medium_path')->nullable();
    $table->string('thumbnail_path')->nullable();
    $table->string('filename');
    $table->unsignedBigInteger('size');
    $table->string('mime_type');
    $table->timestamps();
});
```

### Documents Table
```php
Schema::create('documents', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->string('path');
    $table->string('filename');
    $table->unsignedBigInteger('size');
    $table->string('mime_type');
    $table->boolean('is_public')->default(false);
    $table->unsignedInteger('downloads_count')->default(0);
    $table->timestamps();
});
```

---

## =' BH'9/ Validation 'D4'ED) | Comprehensive Validation Rules

```php
$rules = [
    // 5H1) 9'E)
    'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

    // 5H1) E9 #(9'/
    'banner' => 'required|image|dimensions:min_width=1200,min_height=400',

    // E3*F/ PDF
    'document' => 'required|file|mimes:pdf|max:10240',

    // EDA'* E*9//)
    'images' => 'required|array|min:1|max:10',
    'images.*' => 'image|max:5120',

    // Excel/CSV
    'spreadsheet' => 'required|file|mimes:xlsx,xls,csv|max:5120',

    // AJ/JH
    'video' => 'required|file|mimes:mp4,mov,avi|max:51200', // 50MB

    // #J EDA
    'attachment' => 'required|file|max:10240',
];
```

---

## =á #A6D 'DEE'13'* | Best Practices

### 1. 'D#E'F | Security
```php
//  '3*./E #3E'! 94H'&J)
$filename = Str::random(40) . '.' . $file->extension();

//  #H '3*./E hash
$filename = $file->hashName();

// L D' *3*./E 'D'3E 'D#5DJ E('41)
$filename = $file->getClientOriginalName(); // .7J1!
```

### 2. *F8JE 'DEDA'* | Organization
```php
//  F8E AJ E,D/'*
'avatars/' . auth()->id() . '/' . $filename
'products/' . $product->id . '/images/' . $filename
'documents/' . date('Y/m') . '/' . $filename
```

### 3. -0A 'DEDA'* | File Deletion
```php
// AJ Model Event
protected static function booted()
{
    static::deleting(function ($model) {
        if ($model->image) {
            Storage::disk('public')->delete($model->image);
        }
    });
}
```

### 4. E9DHE'* 'DEDA AJ Database
```php
Document::create([
    'title' => $request->title,
    'path' => $path,
    'filename' => $file->getClientOriginalName(),
    'size' => $file->getSize(),
    'mime_type' => $file->getMimeType(),
]);
```

---

## =Á GJCD 'DE41H9 | Project Structure

```
project/
   app/
      Http/Controllers/
         ProfileController.php      (Solution 1)
         GalleryController.php      (Solution 2)
         DocumentController.php     (Solution 3)
      Models/
          User.php
          Gallery.php
          Document.php
   database/migrations/
      *_add_avatar_to_users_table.php
      *_create_galleries_table.php
      *_create_documents_table.php
   resources/views/
      profile/
         show.blade.php
      gallery/
         index.blade.php
         upload.blade.php
      documents/
          index.blade.php
          upload.blade.php
   storage/
      app/
          public/                    (DDEDA'* 'D9'E))
             avatars/
             gallery/
             images/
          documents/                 (DDEDA'* 'D.'5))
   public/
       storage/ ’ ../storage/app/public  (Symbolic Link)
```

---

## =€ 'D#H'E1 'DEGE) | Important Commands

```bash
# %F4'! symbolic link
php artisan storage:link

# %F4'! controller
php artisan make:controller GalleryController

# %F4'! model E9 migration
php artisan make:model Gallery -m

# *4:JD migrations
php artisan migrate

# *+(J* Intervention Image
composer require intervention/image-laravel

# E3- 'D*.2JF (DD*7HJ1 AB7!)
php artisan storage:clear
```

---

## =Ý '.*('1 'DE91A) | Knowledge Check

### #3&D) DDE1',9):
1. E' GH `enctype` 'DE7DH( D1A9 'DEDA'*
2. E' 'DA1B (JF `disk('public')` H `disk('local')`
3. CJA *-0A EDA B/JE B(D 1A9 ,/J/
4. CJA *F4& thumbnail D5H1)
5. CJA *-EJ EDA EF 'DH5HD 'DE('41

### *E1JF 9EDJ:
#F4& F8'E 1A9 JBHE (@:
- 1A9 5H1) 'DEF*,
- %F4'! 3 #-,'E (original, medium, thumbnail)
- -A8 'DE9DHE'* AJ database
- 916 'D5H1 AJ E916
- -0A ,EJ9 'D#-,'E 9F/ -0A 'DEF*,

---

## =Ú 'DE5'/1 | Resources

### 'DH+'&B 'D13EJ):
- [Laravel File Storage](https://laravel.com/docs/11.x/filesystem)
- [Laravel File Uploads](https://laravel.com/docs/11.x/requests#files)
- [Laravel Validation](https://laravel.com/docs/11.x/validation#rule-file)
- [Intervention Image](https://image.intervention.io/v3)

### #E+D) %6'AJ):
- Solution 1 (C'ED): `/exercises/solution1/`
- Solution 2 (GJCD): `/exercises/solution2/`
- Theory: `/01-theory.md`

---

## <“ E'0' (9/ | What's Next?

### 'D/13 'D*'DJ:
**Lesson 10: 'D(1J/ 'D%DC*1HFJ H'D%49'1'***
- %13'D 'D(1J/
- Notifications System
- Queues
- Events & Listeners

### *-/J'* %6'AJ):
1. #6A watermark DD5H1
2. #F4& F8'E E,D/'* DD*F8JE
3. #6A progress bar DD1A9
4. 7(B image cropper
5. #6A **(9 *F2JD'* 'DEDA'*

---

##  B'&E) 'DE1',9) 'DFG'&J) | Final Checklist

- [ ] AGE* CJAJ) 1A9 'DEDA'* AJ Laravel
- [ ] #3*7J9 'D*-BB EF 'DEDA'* (4CD 5-J-
- [ ] #91A 'DA1B (JF Public H Private storage
- [ ] #3*7J9 E9'D,) 'D5H1 (resize, crop)
- [ ] #AGE CJA #-EJ 'DEDA'* 'D-3'3)
- [ ] 7(B* Solution 1 (F,'-
- [ ] 1',9* ,EJ9 #E+D) 'DCH/
- [ ] ,'G2 DD/13 'D*'DJ!

---

**<‰ *G'FJF' 9DI %*E'E 'D/13 9!**

***'1J. 'D%F4'!:** 2025-11-04
**'D%5/'1:** 1.0
**E*H'AB E9:** Laravel 11.x
**'D-'D):** EC*ED 
