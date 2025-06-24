# Đồ án: Cộng đồng chia sẻ kinh nghiệm du lịch - Travel Gamification

## 1. Mục tiêu dự án

- Xây dựng một nền tảng web cho phép người dùng chia sẻ, đánh giá, bình luận về các địa điểm du lịch và tiện ích tại Việt Nam.
- Tích hợp hệ thống gamification: nhiệm vụ, điểm thưởng, huy hiệu, bảng xếp hạng để tăng tương tác và động lực cho người dùng.
- Hỗ trợ quản trị viên quản lý nội dung, người dùng, nhiệm vụ, phần thưởng.

## 2. Kiến trúc hệ thống

- **Backend:** Laravel (PHP)
- **Frontend:** Blade Template (Laravel), HTML/CSS/JS, Bootstrap, CKEditor
- **Cơ sở dữ liệu:** MySQL
- **Thư viện/Package:** 
  - Laravel UI/Auth
  - Font Awesome
  - jQuery (một số trang quản trị)
  - CKEditor (soạn thảo nội dung bài viết)
- **Thư mục chính:**
  - `app/`: Code backend Laravel (Controllers, Models, Services, ...)
  - `resources/views/`: Giao diện người dùng (Blade templates)
  - `public/`: Tài nguyên tĩnh (ảnh, css, js, html demo)
  - `routes/`: Định nghĩa route cho web/app
  - `database/`: Migration

## 3. Phần mềm cần thiết để triển khai

- **PHP >= 8.0**
- **Composer** (https://getcomposer.org/)
- **Node.js & npm** (https://nodejs.org/)
- **MySQL** (hoặc hệ quản trị cơ sở dữ liệu tương thích)
- **Laravel** (cài qua Composer, 9.x trở lên)
- **Web server:** (Khuyến nghị) Laragon/XAMPP/WAMP hoặc môi trường server tương đương

## 4. Hướng dẫn cài đặt & chạy chương trình

### Bước 1: Clone source code

```sh
git clone <link-repo>
cd travel_gamification
```

### Bước 2: Cài đặt các package PHP

```sh
composer install
```

### Bước 3: Cài đặt các package frontend (nếu cần)

```sh
npm install
npm run build
```

### Bước 4: Tạo file cấu hình môi trường

```sh
cp .env.example .env
```
- Cập nhật thông tin database, mail, ... trong file `.env` cho phù hợp.

### Bước 5: Tạo database và migrate dữ liệu

```sh
php artisan migrate --seed
```

### Bước 6: Khởi động server

```sh
php artisan serve
```
- Truy cập: http://localhost:8000

### Bước 7: Đăng nhập trang quản trị

- Đăng ký tài khoản, sau đó cập nhật quyền admin trong database (hoặc seed tài khoản admin mẫu).

---

## 5. Sử dụng file cơ sở dữ liệu có sẵn

Nếu trong thư mục dự án có file SQL (ví dụ: `database/travel_gamification.sql`), bạn có thể sử dụng như sau:

1. **Tạo database mới:**
   ```sql
   CREATE DATABASE travel_gamification CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
2. **Import file SQL:**
   - Dùng phpMyAdmin: Chọn database vừa tạo → Import → Chọn file SQL → Thực hiện.
   - Hoặc dùng dòng lệnh:
     ```sh
     mysql -u root -p travel_gamification < database/travel_gamification.sql
     ```
3. **Cập nhật thông tin kết nối trong `.env`:**
   ```
   DB_DATABASE=travel_gamification
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
4. **Nếu đã import SQL, có thể bỏ qua bước migrate.**

---

## 6. Cấu trúc thư mục dự án

```
travel_gamification/
├── app/                # Code backend Laravel (Controllers, Models, ...)
├── public/             # Tài nguyên tĩnh, file HTML mẫu
│   └── html/           # Các file giao diện tĩnh mẫu (.html)
├── resources/
│   └── views/          # Giao diện động (Blade)
├── routes/             # Định nghĩa route
├── database/           # Migration, seed, file SQL (nếu có)
├── .env                # Cấu hình môi trường
├── composer.json       # Quản lý package PHP
├── package.json        # Quản lý package JS
├── README.md           # File hướng dẫn này
└── ...
```

---

## 7. Một số lưu ý

- Nếu sử dụng Laragon/XAMPP, hãy đảm bảo đã bật MySQL và PHP phù hợp.
- Để gửi mail (quên mật khẩu, xác thực), cần cấu hình SMTP trong `.env`.
- Các file HTML trong `public/html/` chỉ là demo giao diện, hệ thống chính sử dụng Blade template.
- File `README.md` chỉ là tài liệu hướng dẫn, không phải file chạy ra giao diện web.

---

**Người thực hiện:** 

- Họ tên: Diệp Tú Như
- MSSV: 110121074
- Lớp: DA21TTB (Đại học Công nghệ thông tin B)
- Email: dieptunhu2003@gmail.com
- SĐT: 0345154491

**Giảng viên hướng dẫn:** 

- ThS. Nguyễn Ngọc Đan Thanh