# *E'1JF 'D/13 9: 1A9 'DEDA'* H'D*.2JF
# Lesson 9 Exercises: File Uploads and Storage

## =Ë F81) 9'E) | Overview

G0' 'DE,D/ J-*HJ 9DI 3 -DHD 9EDJ) *:7J E.*DA ,H'F( 1A9 'DEDA'* H'D*.2JF AJ Laravel.

This folder contains 3 practical solutions covering different aspects of file uploads and storage in Laravel.

---

## <¯ 'D-DHD | Solutions

### Solution 1: F8'E 1A9 'D5H1 'D4.5J) 'D#3'3J
### Basic Avatar Upload System

**'DE3*HI:** E(*/& | Beginner

**'DE/) 'DEB/1):** 30 /BJB) | 30 minutes

**E' 3**9DEG:**
- 1A9 5H1) H'-/)
- 'D*-BB EF 'D5H1 ('DFH9 'D-,E 'D#(9'/)
- *.2JF 'D5H1 AJ storage/app/public
- -0A 'D5H1 'DB/JE)
- 916 'D5H1 'DE-AH8)

**'D*BFJ'*:**
- `$request->file()`
- `store()` method
- Storage Facade
- File Validation Rules
- Symbolic Links

**'D1H'(7:**
```
http://localhost:8000/profile
```

---

### Solution 2: E916 'D5H1 'DE*B/E E9 Thumbnails
### Advanced Image Gallery with Thumbnails

**'DE3*HI:** E*H37 | Intermediate

**'DE/) 'DEB/1):** 60 /BJB) | 60 minutes

**E' 3**9DEG:**
- 1A9 9/) 5H1 AJ FA3 'DHB*
- E9'D,) 'D5H1 (*:JJ1 'D-,E 'DB5)
- %F4'! thumbnails *DB'&J'K
- '3*./'E Intervention Image library
- %F4'! FEH0, EFA5D DD5H1

**'D*BFJ'*:**
- Multiple File Upload
- Intervention Image
- Image Manipulation (resize, crop, fit)
- Polymorphic Relations
- Thumbnails Generation

**'D1H'(7:**
```
http://localhost:8000/gallery
http://localhost:8000/gallery/upload
```

---

### Solution 3: F8'E %/'1) 'DE3*F/'* 'D.'5)
### Private Document Management System

**'DE3*HI:** E*B/E | Advanced

**'DE/) 'DEB/1):** 90 /BJB) | 90 minutes

**E' 3**9DEG:**
- 1A9 E3*F/'* (PDF, Word, Excel)
- -E'J) 'DEDA'* 'D.'5)
- F8'E 5D'-J'* DDH5HD
- *-EJD 'DEDA'* (4CD "EF
- **(9 *F2JD'* 'DEDA'*

**'D*BFJ'*:**
- Private Storage (local disk)
- File Download with Authorization
- Streaming Files
- File Access Control
- Download Tracking
- Different File Types

**'D1H'(7:**
```
http://localhost:8000/documents
http://localhost:8000/documents/upload
http://localhost:8000/documents/{id}/download
```

---

## =Ê EB'1F) 'D-DHD | Solutions Comparison

| 'DEJ2) | Solution 1 | Solution 2 | Solution 3 |
|--------|-----------|-----------|-----------|
| E3*HI 'D59H() | P | PP | PPP |
| FH9 'DEDA'* | 5H1 AB7 | 5H1 AB7 | CD #FH'9 'DE3*F/'* |
| 9// 'DEDA'* | EDA H'-/ | 9/) EDA'* | 9/) EDA'* |
| E9'D,) 'D5H1 | L |  | L |
| Thumbnails | L |  | L |
| 'D.5H5J) | 9'E (public) | 9'E (public) | .'5 (private) |
| 'D5D'-J'* | L | L |  |
| 'D**(9 | L | L |  (**(9 'D*F2JD'*) |

---

## =€ CJAJ) 'D(/! | Getting Started

### 1. '.*1 'D-D 'DEF'3(
```bash
cd solution1  # DDE(*/&JF
cd solution2  # DDE*H37JF
cd solution3  # DDE*B/EJF
```

### 2. 'B1# README
CD -D J-*HJ 9DI EDA README.md .'5 (G J41- 'D*A'5JD H'D.7H'*.

### 3. *4:JD 'DE41H9
```bash
php artisan serve
```

### 4. 2J'1) 'D*7(JB
'A*- 'DE*5A- H'F*BD %DI 'D1'(7 'DE-// AJ README CD -D.

---

## =Ý ED'-8'* EGE) | Important Notes

### Storage Link
,EJ9 'D-DHD **7D( %F4'! symbolic link:
```bash
php artisan storage:link
```

### B'9/) 'D(J'F'*
CD -D J3*./E SQLite H*E %9/'/G E3(B'K.

### 'DEC*('* 'D.'1,J)
Solution 2 J*7D( Intervention Image:
```bash
cd solution2
composer require intervention/image
```

### 'D#0HF'*
*#C/ EF #F E,D/ storage B'(D DDC*'():
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## <“ E3'1 'D*9DE 'DEH5I (G | Recommended Learning Path

### DDE(*/&JF:
1. '(/# E9 Solution 1
2. 'AGE 'D#3'3J'* ,J/'K
3. 'F*BD %DI Solution 2

### DDE*H37JF:
1. 1',9 Solution 1 31J9'K
2. 1C2 9DI Solution 2
3. *-/I FA3C E9 Solution 3

### DDE*B/EJF:
1. 1',9 'D+D'+) -DHD
2. -'HD /E, 'DEA'GJE E9'K
3. #F4& E41H9C 'D.'5

---

## =¡ #AC'1 DD*7HJ1 | Ideas for Enhancement

### *-3JF'* EECF):
1. **Solution 1:**
   - %6'A) image cropper
   - E9'JF) 'D5H1) B(D 'D1A9
   - *-/J/ #(9'/ 'D5H1)

2. **Solution 2:**
   - %6'A) watermark DD5H1
   - *1*J( 'D5H1 ('D3-( H'D%AD'*
   - *-1J1 'D5H1 (filters, effects)

3. **Solution 3:**
   - %6'A) E,D/'* DD*F8JE
   - E4'1C) 'DEDA'* E9 E3*./EJF ".1JF
   - F8'E %5/'1'* DDEDA'* (versioning)

---

## =' '3*C4'A 'D#.7'! | Troubleshooting

### 'D5H1 D' *8G1
```bash
# *#C/ EF H,H/ symbolic link
php artisan storage:link

# *-BB EF 'D#0HF'*
chmod -R 775 storage
```

### .7# AJ 1A9 'DEDA
```php
// *-BB EF -,E 'DEDA AJ php.ini
upload_max_filesize = 10M
post_max_size = 10M
```

### Intervention Image D' J9ED
```bash
# *#C/ EF *+(J* 'DEC*()
composer require intervention/image

# *#C/ EF *A9JD GD extension AJ PHP
php -m | grep -i gd
```

---

## =Ú E5'/1 %6'AJ) | Additional Resources

### 'DH+'&B 'D13EJ):
- [Laravel File Storage](https://laravel.com/docs/11.x/filesystem)
- [Laravel File Uploads](https://laravel.com/docs/11.x/requests#files)
- [Laravel Validation - Files](https://laravel.com/docs/11.x/validation#rule-file)
- [Intervention Image](http://image.intervention.io/)

### /1H3 AJ/JH:
- [Laracasts - File Uploads](https://laracasts.com/series/laravel-from-scratch)
- [Laravel Daily - Image Upload Tutorial](https://www.youtube.com/c/LaravelDaily)

### EB'D'*:
- [Best Practices for File Uploads](https://laravel-news.com)
- [Securing File Uploads](https://owasp.org/www-community/vulnerabilities/Unrestricted_File_Upload)

---

##  B'&E) 'DE1',9) | Checklist

B(D 'D'F*B'D DD/13 'D*'DJ *#C/ EF:

- [ ] AGE CJAJ) 1A9 'DEDA'* ('3*./'E Laravel
- [ ] 'DB/1) 9DI 'D*-BB EF #FH'9 H#-,'E 'DEDA'*
- [ ] E91A) CJAJ) *.2JF 'DEDA'* AJ #E'CF E.*DA)
- [ ] AGE 'DA1B (JF public H private storage
- [ ] 'DB/1) 9DI E9'D,) 'D5H1 (*:JJ1 'D-,E 'DB5)
- [ ] E91A) CJAJ) -E'J) 'DEDA'* 'D-3'3)
- [ ] AGE best practices DD*9'ED E9 'DEDA'*

---

## <¯ 'D*'DJ | What's Next

(9/ %*E'E G0' 'D/13 3*CHF ,'G2'K DD/13 10:

**'D/13 10: 'D(1J/ 'D%DC*1HFJ H'D%49'1'***
- %13'D 'D(1J/ 'D%DC*1HFJ
- Notifications System
- Queues DDEG'E 'D+BJD)
- Events & Listeners

---

***'1J. 'D%F4'!:** 2025-11-04
**'D%5/'1:** 1.0
**E*H'AB E9:** Laravel 11.x
**'DE$DA:** Laravel Learning Series
