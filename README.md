# 🚗 Aplikasi Pemesanan Kendaraan

Aplikasi ini digunakan untuk mengelola pemesanan kendaraan di perusahaan tambang, termasuk persetujuan berjenjang, dashboard monitoring, dan laporan export Excel.

---

## 🧑‍💻 Akun Demo

| Role             | Email              | Password |
| ---------------- | ------------------ | -------- |
| Admin            | admin@mail.com     | password |
| Approver Level 1 | approver1@mail.com | password |
| Approver Level 2 | approver2@mail.com | password |

## 💻 Tech Spec
- Laravel 12
- PHP 8.3
- MySQL 8
- Bootstrap 5
- Export Excel: maatwebsite/excel v3

## 📒 Panduan Penggunaan
1. Login sebagai admin
2. Buat pemesanan kendaraan
3. Pilih driver dan approver level 1 & 2
4. Approver login dan menyetujui
5. Lihat laporan dan dashboard
---

## ⚙️ Instalasi

1. Clone repository:
    ```bash
    git clone <url>
    cd vehicle-booking-app
    ```
2. composer install
3. cp .env.example .env
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed
7. php artisan serve

## 📊 Physical Data Model
users
- id
- name
- email
- password
- role

vehicles
- id
- name
- license_plate
- type (angkutan_barang/orang)
- owned_by (internal/rental)

history_check_vehicles
- id
- vehicle_id
- service_schedule
- last_service
- condition (layak/tidak layak)
- note

drivers
- id
- name
- phone

bookings
- id
- user_id (pemesan)
- vehicle_id
- driver_id
- purpose
- destination
- start_time
- end_time
- status (pending/approved/declined)

booking_approvals
- id
- booking_id
- approver_id
- level (1/2)
- status (pending/approved/rejected)
- approved_at
- note

logs
- id
- booking_id
- user_id
- action (create/approve/reject/update)
- created_at

## 📈 Activity Diagram
[Admin Login] 
  → [Input Booking Kendaraan]
    → [Tentukan Driver & Approver]
      → [Booking Masuk Approval Level 1]
        → [Disetujui?]
            → [Masuk Approval Level 2]
                → [Disetujui?]
                    → [Status Approved]
                    → [Jika Ditolak → Status Rejected]


