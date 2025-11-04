# =€ QUICK START GUIDE
# /DJD 'D(/! 'D31J9 - 'D/13 9

**HB* 'DB1'!):** 5 /B'&B | **HB* 'D*7(JB:** 10 /B'&B

---

## =Ë B(D 'D(/! | Before You Start

*#C/ EF H,H/:
-  PHP 8.2+
-  Composer
-  Laravel E+(*
-  E-11 F5H5 (VS Code, PHPStorm, etc.)

---

## ¡ 'D(/! 'D31J9 | Quick Start (3 Steps)

### <¯ Solution 1: Avatar Upload (E(*/&)

```bash
# 1. 'F*BD DDE41H9
cd lesson-09-file-uploads-storage/exercises/solution1

# 2. 4:QD 'D3J1A1
php artisan serve

# 3. 'A*- 'DE*5A-
# http://localhost:8000/profile
```

** ,'G2! '1A9 5H1*C 'D"F!**

---

### <¯ Solution 2: Image Gallery (E*H37)

```bash
# 1. 'F*BD DDE41H9
cd lesson-09-file-uploads-storage/exercises/solution2

# 2. 4:QD 'D3J1A1
php artisan serve

# 3. 'A*- 'DE*5A-
# http://localhost:8000/gallery
```

** ,'G2! '(/# (1A9 'D5H1!**

---

## =Ö %0' CF* E(*/&'K *E'E'K

### .7H) (.7H):

#### 1. 'B1# 'DF81J) (20 /BJB))
```bash
# 'A*- 'DEDA:
01-theory.md
```
1C2 9DI:
- #3'3J'* Storage Facade
- CJAJ) 1A9 'DEDA'*
- BH'9/ Validation

#### 2. ,1( Solution 1 (30 /BJB))
```bash
cd exercises/solution1
php artisan serve
```

'A*- `http://localhost:8000/profile` H,1(:
-  1A9 5H1) 4.5J)
-  916 'D5H1)
-  -0A 'D5H1)

#### 3. 'A-5 'DCH/ (20 /BJB))
'B1# G0G 'DEDA'* ('D*1*J(:
1. `routes/web.php` - 'DE3'1'*
2. `app/Http/Controllers/ProfileController.php` - 'DEF7B
3. `resources/views/profile/show.blade.php` - 'DH',G)

#### 4. 1',9 'DED.5 (10 /BJB))
```bash
# 'A*-:
LESSON-SUMMARY.md
```

---

## <“ %0' CF* E*H37 'DE3*HI

### .7H) (.7H):

#### 1. 1',9 'DED.5 (10 /BJB))
```bash
LESSON-SUMMARY.md
```

#### 2. ,1( Solution 2 (45 /BJB))
```bash
cd exercises/solution2
php artisan serve
```

'A*- `http://localhost:8000/gallery` H,1(:
-  1A9 9/) 5H1
-  Drag & Drop
-  916 'DE916
-  916 *A'5JD 5H1)
-  -0A 5H1)

#### 3. '/13 Intervention Image (20 /BJB))
'A-5 `app/Http/Controllers/GalleryController.php`:
- CJA J*E %F4'! 3 F3. EF 'D5H1)
- '3*./'E `Image::read()`
- `scale()` H `cover()` methods

#### 4. 'AGE Model Events (15 /BJB))
'A-5 `app/Models/Gallery.php`:
- `booted()` method
- `deleting` event
- 'D-0A 'D*DB'&J DDEDA'*

---

## = '.*('1 31J9 | Quick Test

### Solution 1 Test:
```bash
cd exercises/solution1

# 1. *-BB EF 'DE3*./E
php artisan tinker --execute="App\Models\User::first()"

# 2. *-BB EF 'D@ routes
php artisan route:list | grep profile

# 3. 4:QD
php artisan serve
```

### Solution 2 Test:
```bash
cd exercises/solution2

# 1. *-BB EF 'D,/HD
php artisan tinker --execute="Schema::hasTable('galleries')"

# 2. *-BB EF 'D@ routes
php artisan route:list | grep gallery

# 3. 4:QD
php artisan serve
```

---

## =¡ F5'&- 31J9) | Quick Tips

### 1. 'D5H1 D' *8G1
```bash
php artisan storage:link
```

### 2. .7# AJ 1A9 'DEDA
*-BB EF `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
```

### 3. Intervention Image D' J9ED
```bash
# *-BB EF GD extension
php -m | grep -i gd
```

### 4. E3- 'D5H1 'D*,1J(J):
```bash
rm -rf storage/app/public/avatars/*
rm -rf storage/app/public/gallery/*
```

---

## =Ú 'DE3'1 'DEH5I (G | Recommended Path

### 'DJHE 'D#HD (2 3'9)):
-  'B1# `01-theory.md` ('D#3'3J'* AB7)
-  ,1( Solution 1
-  'AGE 'DCH/ 'D#3'3J

### 'DJHE 'D+'FJ (2 3'9)):
-  1',9 `LESSON-SUMMARY.md`
-  ,1( Solution 2
-  '/13 E9'D,) 'D5H1

### 'DJHE 'D+'D+ (1 3'9)):
-  7(QB E41H9C 'D.'5
-  #6A EJ2'* ,/J/)
-  '3*9/ DD/13 'D*'DJ

---

## <¯ #G/'A 31J9) | Quick Goals

### (9/ Solution 1 J,( #F *3*7J9:
-  1A9 EDA AJ Laravel
-  'D*-BB EF 'DEDA
-  *.2JF 'DEDA
-  916 'DEDA
-  -0A 'DEDA

### (9/ Solution 2 J,( #F *3*7J9:
-  1A9 9/) EDA'*
-  E9'D,) 'D5H1
-  %F4'! thumbnails
-  '3*./'E Intervention Image
-  (F'! E916 5H1

---

## = 1H'(7 31J9) | Quick Links

### 'DH+'&B:
- =Ö [Theory](01-theory.md) - 'DF81J) 'DC'ED)
- =Ý [Summary](LESSON-SUMMARY.md) - 'DED.5 E9 'D#E+D)
- =Ë [Exercises](exercises/README.md) - /DJD 'D*E'1JF
-  [Completion](COMPLETION-SUMMARY.md) - *B1J1 'D%*E'E

### 'D-DHD:
- =d [Solution 1](exercises/solution1/README.md) - Avatar Upload
- =¼ [Solution 2](exercises/solution2/README.md) - Image Gallery

### 'DE3'9/):
- S [Laravel Docs](https://laravel.com/docs/11.x/filesystem)
- =¼ [Intervention Image](https://image.intervention.io/v3)

---

## = -D 'DE4'CD 'D31J9 | Quick Troubleshooting

### 'DE4CD): 'D5H1 D' *8G1
**'D-D:**
```bash
php artisan storage:link
chmod -R 775 storage
```

### 'DE4CD): .7# AJ 'D1A9
**'D-D:**
*-BB EF -,E 'DEDA AJ `php.ini`

### 'DE4CD): Intervention D' J9ED
**'D-D:**
```bash
composer require intervention/image-laravel
php -m | grep -i gd
```

### 'DE4CD): .7# AJ 'D#0HF'*
**'D-D:**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## ( #HD 5 /B'&B | First 5 Minutes

### 'D.J'1 'D31J9 (DDE*9,DJF):
```bash
# 'A*- terminal H'C*(:
cd lesson-09-file-uploads-storage/exercises/solution1
php artisan serve

# 'A*- 'DE*5A-:
http://localhost:8000/profile

# '1A9 5H1) H4HA 'DF*J,)!
```

### 'D.J'1 'D*A5JDJ (DDE*#FJJF):
```bash
# 1. 'B1# README
cat README.md

# 2. 1',9 'DED.5
cat LESSON-SUMMARY.md

# 3. ,1( Solution 1
cd exercises/solution1
php artisan serve
```

---

## =Ê .7) 'D@ 60 /BJB) | 60-Minute Plan

```
0-10 /B'&B:   'B1# README.md
10-25 /BJB):  ,1( Solution 1
25-35 /B'&B:  1',9 'DCH/
35-50 /BJB):  ,1( Solution 2
50-60 /BJB):  'B1# LESSON-SUMMARY.md
```

**(9/ 60 /BJB) 3*CHF B'/1'K 9DI 1A9 'DEDA'* AJ Laravel!**

---

## <‰ #F* ,'G2 DD(/!!

### '(/# 'D"F:
```bash
# '.*1 Solution:
cd exercises/solution1   # DDE(*/&JF
# #H
cd exercises/solution2   # DDE*H37JF

# 4:QD:
php artisan serve

# 'A*- 'DE*5A- H'3*E*9!
```

---

## =¬ ".1 CDE)

**D' *BDB %0' DE *AGE CD 4J! EF 'DE1) 'D#HDI!**

- = ,1( #C+1 EF E1)
- =Ö '1,9 DDF81J) 9F/ 'D-',)
- =» 'C*( 'DCH/ (FA3C
- <¯ 1C2 9DI 'D#3'3J'* #HD'K
- =€ *B/E */1J,J'K

**('D*HAJB! <**

---

***'1J. 'D%F4'!:** 2025-11-04
**".1 *-/J+:** 2025-11-04
**'D%5/'1:** 1.0
**'D-'D):**  Ready to Use
