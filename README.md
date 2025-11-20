# 🏋️‍♂️ Exercisory

**Sistem Gamifikasi untuk Pelacakan Kedisiplinan Kesehatan Harian**

Project ini adalah aplikasi web berbasis **Laravel** yang dirancang untuk membantu peserta menjaga rutinitas kesehatan mereka. Bukan sekadar mencatat, tapi kami membuatnya seru dengan sistem **Poin, dan Leaderboard**!

---

## 📖 Tentang Project

**Exercisory** (Exercise + Advisory) bertujuan memecahkan masalah "malas gerak" atau lupa minum obat/vitamin.

Konsepnya sederhana:
1. **Admin** membuat daftar tugas harian (misal: "Minum 2L Air", "Jogging 15 Menit").
2. **Peserta** login, melakukan *check-in* tugas, dan langsung dapat poin.
3. Sistem menampilkan grafik perkembangan dan peringkat antar peserta secara *real-time*.

Yang unik? Tampilannya dibuat sedikit *retro* (ala Windows 95) tapi dengan teknologi modern yang *smooth*! 🖥️

---

## 🛠️ Teknologi yang Dipakai (TALL Stack)

Project ini dibangun "full-stack" menggunakan ekosistem Laravel yang powerful:

* **Backend:** [Laravel 11](https://laravel.com) (PHP)
* **Frontend & Logic:** [Livewire 3](https://livewire.laravel.com) (Tanpa ribet bikin API terpisah!)
* **Styling:** [Tailwind CSS](https://tailwindcss.com)
* **Interactivity:** [Alpine.js](https://alpinejs.dev) & Chart.js
* **Database:** MySQL

---

## ✨ Fitur Unggulan

### 🔓 Akses Publik (Guest)
* **Preview Mode:** Orang yang belum login (Tamu) bisa melihat Dashboard, Leaderboard, dan Checklist.
* **Smart Redirect:** Jika tamu mencoba mencentang tugas, sistem akan otomatis mengarahkan ke halaman Login.

### 🏃 Area Peserta (Participant)
* **Daily Checklist:** Centang tugas harian tanpa refresh halaman (Livewire magic!).
* **Real-time Score:** Poin bertambah saat itu juga.
* **Grafik Tren:** Memantau performa poin selama 7 hari terakhir.
* **Notifikasi:** Mendapat pengingat jika belum absen.
* **History Calendar:** Kalender visual untuk melihat hari mana yang "Bolong".

### 🛠️ Area Admin
* **Task Management:** Tambah, edit, atau hapus tugas harian.
* **User Management:** Mengelola data peserta.
* **Monitoring:** Melihat grafik kepatuhan (Compliance Chart) seluruh peserta.
* **Manual Trigger:** Tombol khusus untuk mengirim notifikasi pengingat massal.

---

## 🚀 Cara Install & Menjalankan

Mau coba jalankan di komputer sendiri? Ikuti langkah simpel ini:

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/username/exercisory.git](https://github.com/username/exercisory.git)
    cd exercisory
    ```

2.  **Install Dependencies**
    Siapkan "bahan-bahan" PHP dan JavaScript-nya:
    ```bash
    composer install
    npm install
    ```

3.  **Setting Environment**
    Duplikat file `.env.example` jadi `.env`, lalu atur nama databasenya.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Siapkan Database**
    Pastikan kamu sudah buat database kosong di MySQL, lalu jalankan migrasi dan data awal (seeding):
    ```bash
    php artisan migrate --seed
    ```
    *(Command ini akan membuat user Admin & Participant default untuk testing)*

5.  **Jalankan Aplikasi**
    Buka dua terminal berbeda untuk menjalankan server dan compiler aset:
    
    *Terminal 1:*
    ```bash
    php artisan serve
    ```
    
    *Terminal 2:*
    ```bash
    npm run dev
    ```

6.  **Selesai!** 🎉
    Buka browser dan akses: `http://127.0.0.1:8000`

---

## 🤖 Tips Tambahan

**Menjalankan Notifikasi Manual**
Ingin mengetes fitur notifikasi pengingat lewat terminal? Gunakan command kustom yang sudah dibuat:

```bash
php artisan app:send-checklist-reminders