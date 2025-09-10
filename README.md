Mantap 🚀, kalau project kamu sudah jalan di Docker, dev baru yang join tinggal **clone repo + jalankan Docker**. Supaya rapi, biasanya disiapkan `README.md` dengan step instalasi.

Berikut contoh **step by step** untuk dev baru:

---

## 🔧 Setup CRM Mini App (PHP 8.1 + MySQL + Docker)

### 1. Prasyarat

Pastikan di komputer sudah terpasang:

* **Git**
* **Docker Engine** + **Docker Compose** (kalau di Windows bisa pakai Docker Desktop atau WSL2 + Docker)

Cek dengan:

```bash
docker --version
docker compose version
```

---

### 2. Clone Repo

Clone project ke folder lokal:

```bash
git clone https://github.com/username/crm-mini.git
cd crm-mini
```

---

### 3. Konfigurasi Environment

Buat file `.env` (kalau belum ada) dengan isi misalnya:

```env
DB_HOST=db
DB_NAME=crm_mini
DB_USER=crm_user
DB_PASS=crm_pass
```

> Bisa juga langsung pakai setting default dari `docker-compose.yml`.

---

### 4. Jalankan Aplikasi dengan Docker

Build & jalankan container:

```bash
docker compose up -d --build
```

---

### 5. Cek Container

Pastikan semua service jalan:

```bash
docker compose ps
```

Harus muncul:

* `crm_app` → PHP + Apache
* `crm_db` → MySQL
* `crm_phpmyadmin` → phpMyAdmin

---

### 6. Akses Aplikasi

* **Web App:** [http://localhost:8888](http://localhost:8888)
* **phpMyAdmin:** [http://localhost:8081](http://localhost:8081)

Login phpMyAdmin:

* Server: `db`
* Username: `crm_user`
* Password: `crm_pass`

---

### 7. Database (Opsional)

Kalau sudah ada file `crm_mini.sql`, import ke database:

```bash
docker exec -i crm_db mysql -u crm_user -pcrm_pass crm_mini < database/crm_mini.sql
```

---

### 8. Hentikan Aplikasi

Kalau sudah selesai coding:

```bash
docker compose down
```

---

📌 Catatan tambahan:

* Kalau kamu pakai **ORM (Eloquent/Doctrine)**, instruksi install vendor juga bisa ditulis di sini, misalnya:

  ```bash
  composer install
  ```

  (atau kalau tanpa Composer, tinggal pastikan folder `vendor/` sudah ada di repo).

---

👉 Jadi nanti dev baru tinggal **clone → docker compose up → buka di browser**, tanpa ribet install PHP/XAMPP/MySQL di lokal.

Mau saya bikinkan draft **README.md** langsung dengan format Markdown yang rapi untuk repo kamu?
