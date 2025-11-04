#  TESTING CHECKLIST
# B'&E) 'D'.*('1 'D4'ED) - 'D/13 9

**'DG/A:** 'D*#C/ EF #F CD 4J! J9ED (4CD 5-J- B(D (/! 'D*9DE

---

## =Ë B'&E) 'D'.*('1 'D1&J3J)

###  Solution 1: Avatar Upload System

#### 1. 'D*-BB EF 'D(J&) | Environment Check
```bash
cd exercises/solution1

#  Test 1: Check PHP version (J,( #F JCHF 8.2+)
php -v

#  Test 2: Check if database exists
php artisan db:show

#  Test 3: Check if user exists
php artisan tinker --execute="echo App\Models\User::count();"

#  Test 4: Check symbolic link
ls -la public/storage

#  Test 5: Check routes
php artisan route:list | grep profile
```

**'DF*'&, 'DE*HB9):**
- PHP version: 8.2 or higher 
- Database tables: 9 tables 
- Users count: 1 
- Symbolic link: Exists 
- Routes: 3 profile routes 

---

#### 2. '.*('1 'DH8'&A | Functionality Test

```bash
# Start server
php artisan serve
```

**'A*-:** `http://localhost:8000/profile`

| 'D'.*('1 | 'D.7H'* | 'DF*J,) 'DE*HB9) | 'D-'D) |
|----------|---------|-------------------|---------|
| **1. 916 'D5A-)** | 2J'1) `/profile` | 5A-) *8G1 (4CD 5-J- |  |
| **2. 916 E9DHE'* 'DE3*./E** | *-BB EF 'D9FH'F | "#-E/ E-E/" J8G1 |  |
| **3. 1A9 5H1) 5-J-)** | '1A9 5H1) JPEG 500KB | "*E *-/J+ 'D5H1) (F,'-!" |  |
| **4. 916 'D5H1)** | *-BB EF 'D5H1) | 'D5H1) *8G1 AJ 'D5A-) |  |
| **5. -0A 'D5H1)** | '6:7 "-0A 'D5H1)" | "*E -0A 'D5H1) (F,'-!" |  |
| **6. 1A9 5H1) C(J1)** | '1A9 5H1) 3MB | .7#: "-,E 'D5H1)..." |  |
| **7. 1A9 EDA :J1 5H1)** | '1A9 PDF | .7#: "J,( #F JCHF 5H1)" |  |
| **8. 1A9 5H1) 5:J1) ,/'K** | '1A9 5H1) 50x50 | .7#: "'D#(9'/..." |  |

---

#### 3. '.*('1 'DEDA'* | Files Test

```bash
#  Test 6: Check if image is stored
ls -la storage/app/public/avatars/

#  Test 7: Check file permissions
ls -l storage/app/public/avatars/

#  Test 8: Check database record
php artisan tinker --execute="App\Models\User::first()->avatar"
```

---

###  Solution 2: Image Gallery System

#### 1. 'D*-BB EF 'D(J&) | Environment Check
```bash
cd exercises/solution2

#  Test 1: Check if Intervention Image is installed
composer show intervention/image-laravel

#  Test 2: Check if GD extension exists
php -m | grep -i gd

#  Test 3: Check galleries table
php artisan tinker --execute="Schema::hasTable('galleries')"

#  Test 4: Check routes
php artisan route:list | grep gallery
```

**'DF*'&, 'DE*HB9):**
- Intervention Image: v1.5.6 installed 
- GD extension: Loaded 
- Galleries table: true 
- Routes: 5 gallery routes 

---

#### 2. '.*('1 'DH8'&A | Functionality Test

```bash
# Start server
php artisan serve
```

**'A*-:** `http://localhost:8000/gallery`

| 'D'.*('1 | 'D.7H'* | 'DF*J,) 'DE*HB9) | 'D-'D) |
|----------|---------|-------------------|---------|
| **1. 916 'DE916 'DA'1:** | 2J'1) `/gallery` | "'DE916 A'1:" J8G1 |  |
| **2. 'D0G'( D5A-) 'D1A9** | '6:7 "1A9 5H1" | 5A-) 1A9 *8G1 |  |
| **3. 1A9 5H1) H'-/)** | '1A9 5H1) H'-/) | "*E 1A9 1 5H1) (F,'-!" |  |
| **4. 916 'D5H1) AJ Grid** | '1,9 DDE916 | 'D5H1) *8G1 E9 thumbnail |  |
| **5. 916 *A'5JD 'D5H1)** | '6:7 "916" | 5A-) *A'5JD C'ED) |  |
| **6. 916 3 F3.** | AJ 5A-) 'D*A'5JD | Original, Medium, Thumbnail |  |
| **7. 1A9 9/) 5H1** | '1A9 5 5H1 E9'K | "*E 1A9 5 5H1) (F,'-!" |  |
| **8. Drag & Drop** | '3-( 5H1 DDEF7B) | 'D5H1 *8G1 DDE9'JF) |  |
| **9. E9'JF) B(D 'D1A9** | '.*1 5H1 | E9'JF) *8G1 AH1'K |  |
| **10. %2'D) EF 'DB'&E)** | '6:7 × 9DI 5H1) | 'D5H1) *O-0A EF 'DB'&E) |  |
| **11. -0A 5H1)** | '6:7 "-0A" | 'D5H1) *O-0A EF 'DCD |  |
| **12. 1A9 11 5H1)** | -'HD 1A9 11 | 13'D) .7# *8G1 |  |

---

#### 3. '.*('1 E9'D,) 'D5H1 | Image Processing Test

```bash
# (9/ 1A9 5H1) *-BB EF 'DEDA'*:

#  Test 5: Check original image
ls -la storage/app/public/gallery/original/

#  Test 6: Check medium image
ls -la storage/app/public/gallery/medium/

#  Test 7: Check thumbnail
ls -la storage/app/public/gallery/thumbnails/

#  Test 8: Verify image sizes
php artisan tinker --execute="
\$image = App\Models\Gallery::first();
echo 'Original: ' . \$image->original_path . PHP_EOL;
echo 'Medium: ' . \$image->medium_path . PHP_EOL;
echo 'Thumbnail: ' . \$image->thumbnail_path . PHP_EOL;
"
```

---

#### 4. '.*('1 'D-0A 'D*DB'&J | Auto-Delete Test

```bash
#  Test 9: Test Model Event (automatic file deletion)

# 1. Count files before delete
ls storage/app/public/gallery/original/ | wc -l

# 2. Delete from database
php artisan tinker --execute="App\Models\Gallery::first()->delete();"

# 3. Count files after delete (J,( #F JBD)
ls storage/app/public/gallery/original/ | wc -l

# 'DF*J,): ,EJ9 'DF3. 'D@ 3 J,( #F *O-0A *DB'&J'K 
```

---

## = '.*('1'* E*B/E) | Advanced Tests

### '.*('1 'D#/'! | Performance Test

```bash
# Solution 2: 1A9 10 5H1 AJ FA3 'DHB*
# 'DHB* 'DE*HB9: #BD EF 10 +H'FJ
```

### '.*('1 'D#E'F | Security Test

```bash
# 1. E-'HD) 1A9 EDA PHP
# 'DF*J,): J,( #F J1A6 L

# 2. E-'HD) 1A9 EDA C(J1 ,/'K
# 'DF*J,): J,( #F J1A6 L

# 3. E-'HD) 1A9 EDA ('E*/'/ E2JA
# 'DF*J,): J,( #F J1A6 L
```

### '.*('1 'D*H'AB | Compatibility Test

```bash
# 1. '.*(1 9DI E*5A-'* E.*DA):
# - Chrome 
# - Firefox 
# - Safari 
# - Edge 

# 2. '.*(1 9DI #,G2) E.*DA):
# - Desktop 
# - Tablet 
# - Mobile 
```

---

## =Ê ED.5 'DF*'&, | Results Summary

### Solution 1: Avatar Upload

```
'D'.*('1'* 'D#3'3J):    8/8
'.*('1 'DEDA'*:         3/3
'D'.*('1'* 'DE*B/E):    3/3
-----------------------------------
'D%,E'DJ:                14/14
```

### Solution 2: Image Gallery

```
'D'.*('1'* 'D#3'3J):    12/12
'.*('1 'DE9'D,):        4/4
'.*('1 'D-0A:           1/1
'D'.*('1'* 'DE*B/E):    3/3
-----------------------------------
'D%,E'DJ:                20/20
```

---

## = '3*C4'A 'DE4'CD | Troubleshooting

### 'DE4CD): 'D5H1 D' *8G1

**'D-DHD:**
```bash
# 1. *-BB EF Symbolic Link
php artisan storage:link

# 2. *-BB EF 'D#0HF'*
chmod -R 775 storage
chmod -R 775 public/storage

# 3. 'E3- 'DC'4
php artisan cache:clear
php artisan view:clear
```

### 'DE4CD): .7# AJ 1A9 'DEDA

**'D-DHD:**
```bash
# 1. *-BB EF php.ini
php -i | grep upload_max_filesize
php -i | grep post_max_size

# 2. 2/ 'DBJE) %0' D2E 'D#E1
# AJ php.ini:
# upload_max_filesize = 10M
# post_max_size = 10M
```

### 'DE4CD): Intervention Image D' J9ED

**'D-DHD:**
```bash
# 1. *#C/ EF 'D*+(J*
composer require intervention/image-laravel

# 2. *-BB EF GD
php -m | grep -i gd

# 3. %0' DE JH,/ +(Q* GD:
# Ubuntu/Debian:
sudo apt-get install php8.2-gd

# macOS:
brew install php@8.2

# Windows:
# A9QD extension=gd AJ php.ini
```

---

##  B'&E) 'D*-BB 'DFG'&J) | Final Checklist

B(D '9*('1 'D/13 ,'G2'K:

### Documentation
- [ ] ,EJ9 README files EH,H/)
- [ ] QUICK-START.md EH,H/
- [ ] LESSON-SUMMARY.md EH,H/
- [ ] COMPLETION-SUMMARY.md EH,H/

### Solution 1
- [ ] J9ED (/HF #.7'!
- [ ] ,EJ9 'D'.*('1'* *E1
- [ ] 'DH',G) *8G1 (4CD 5-J-
- [ ] README C'ED

### Solution 2
- [ ] J9ED (/HF #.7'!
- [ ] ,EJ9 'D'.*('1'* *E1
- [ ] E9'D,) 'D5H1 *9ED
- [ ] ,EJ9 'D@ 3 F3. *OF4#
- [ ] 'D-0A 'D*DB'&J J9ED
- [ ] README C'ED

### Code Quality
- [ ] 'DCH/ F8JA HEF8E
- [ ] 'D*9DJB'* ('D91(J) H'D%F,DJ2J)
- [ ] D' *H,/ #.7'! syntax
- [ ] Validation 4'ED

### User Experience
- [ ] 'DH',G) ,EJD)
- [ ] E*,'H() 9DI ,EJ9 'D#,G2)
- [ ] 13'&D H'6-)
- [ ] Loading states EH,H/)

---

## =Ý *3,JD 'DF*'&, | Log Results

### *'1J. 'D'.*('1:
```
'D*'1J.: _______________
'DE.*(1: _______________
'D%5/'1: 1.0
Laravel: 11.x
PHP: 8.2+
```

### 'DED'-8'*:
```
_______________________________________
_______________________________________
_______________________________________
```

### 'D*BJJE 'DFG'&J:
```
[ ] EE*'2 - CD 4J! J9ED (4CD E+'DJ
[ ] ,J/ - (96 'D*-3JF'* 'D7AJA) E7DH()
[ ] J-*', E1',9) - 9/) E4'CD J,( -DG'
```

---

## <¯ 'D.7H) 'D*'DJ) | Next Step

(9/ F,'- ,EJ9 'D'.*('1'*:

```bash
#  All tests passed!
#  Solutions are working perfectly!
#  Ready for students!

# Next: Lesson 10 - Emails & Notifications
```

---

***'1J. 'D%F4'!:** 2025-11-04
**".1 *-/J+:** 2025-11-04
**'D-'D):**  Ready for Testing
