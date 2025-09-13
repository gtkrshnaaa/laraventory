Written in Indonesian

---

# Laraventory - Smart Inventory Management System

**Laraventory** adalah sistem manajemen inventori modern berbasis web untuk mengelola stok suku cadang alat rumah tangga seperti AC, kulkas, mesin cuci, TV, dan kompor. Dibangun dengan Laravel 12.x dan pendekatan frontend CDN-first (tanpa build step). Tersedia setup opsional Vite/Tailwind untuk pengembangan lokal, namun tidak wajib untuk menjalankan aplikasi.

## Key Features (MVP)

- **Products Management**
  - CRUD Products with Eloquent (name, SKU, category, supplier, price, cost, stock, min_stock, description, image path)
  - Optional image upload (stored in `storage/app/public/products`), served via `storage:link`
  - Filters: search (name/SKU), category, stock status (in stock / low stock / out of stock)

- **Categories**
  - CRUD Categories using Eloquent

- **Suppliers**
  - CRUD Suppliers using Eloquent

- **Inventory**
  - Stock adjustments (in / out) with transactional updates
  - Records inventory movements in `inventory_movements`
  - Low-stock highlights

- **Reports**
  - Stock report (current stock per product)
  - Transactions report (paginated inventory movements)
  - Export placeholder endpoint prepared (not finalized)

- **Authentication (Admin)**
  - Separate `admin` guard and `admins` provider
  - Login/logout routes and middleware-protected admin area

- **Public Landing Page**
  - Simple landing page (no authentication) using Tailwind CDN

## Tech Stack

- **Backend:** Laravel 12.x (PHP 8.2+)
- **Frontend:** Blade + Tailwind CSS (PlayCDN) + Alpine.js (PlayCDN)
- **Database:** MySQL
- **Build Tools:** Tidak diperlukan untuk menjalankan aplikasi (CDN-first). Opsional untuk dev lokal: Vite + Tailwind CSS 4.

## Installation

1) Clone and enter the project

```bash
git clone https://github.com/gtkrshnaaa/laraventory.git
cd laraventory
```

2) Install PHP dependencies

```bash
composer install
```

3) Environment and app key

```bash
cp .env.example .env
php artisan key:generate
```

4) Configure database in `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laraventory
DB_USERNAME=root
DB_PASSWORD=
```

5) Run migrations and seeders

```bash
php artisan migrate:fresh --seed
```

6) Create storage symlink for product images

```bash
php artisan storage:link
```

7) Start the development server

```bash
php artisan serve
```

8) Open the app

- Public: http://localhost:8000
- Admin: http://localhost:8000/admin/login

### (Opsional) Pengembangan Aset Lokal dengan Vite

> Catatan: Bagian ini tidak wajib. Seluruh UI sudah berjalan via CDN. Gunakan hanya jika Anda ingin kustomisasi Tailwind/JS secara lokal.

```bash
# Pastikan Node.js terpasang
npm install

# Jalankan Vite dev server (opsional)
npm run dev

# Build aset produksi (opsional)
npm run build
```

Konfigurasi terkait tersedia di `package.json` dan `vite.config.js`. Namun, layout Blade saat ini menggunakan PlayCDN sehingga aplikasi tetap berjalan tanpa proses build.

## Default Account

- **Admin**
  - Email: admin@example.com
  - Password: password

## Routes Overview

- **Public**
  - `GET /` → landing page (named `home`)

- **Admin Auth**
  - `GET /admin/login` → login form
  - `POST /admin/login` → login
  - `POST /admin/logout` → logout

- **Admin Dashboard**
  - `GET /admin` and `GET /admin/dashboard` → dashboard (protected by `admin` middleware)

- **Products**
  - Resourceful routes under `/admin/products` (index, create, store, show, edit, update, destroy)
  - Extra: `POST /admin/products/bulk-actions`, `GET /admin/products/export` (placeholder), `POST /admin/products/import` (placeholder)

- **Categories**
  - `GET /admin/categories` (index), `POST /admin/categories` (store), `PUT /admin/categories/{id}` (update), `DELETE /admin/categories/{id}` (destroy)

- **Suppliers**
  - `GET /admin/suppliers`, `GET /admin/suppliers/create`, `POST /admin/suppliers`, `GET /admin/suppliers/{id}/edit`, `PUT /admin/suppliers/{id}`, `DELETE /admin/suppliers/{id}`

- **Inventory**
  - `GET /admin/inventory` (overview)
  - `POST /admin/inventory/adjust` (in/out)

- **Reports**
  - `GET /admin/reports/stock` (stock report)
  - `GET /admin/reports/transactions` (inventory transactions)
  - `POST /admin/reports/export` (placeholder)

- **Profile**
  - `GET /admin/profile` (edit)
  - `PUT /admin/profile` (update)
  - `PUT /admin/profile/password` (update password)

## Database Schema (Migrations)

- `admins` (auth for admin guard)
- `categories` (name, description)
- `suppliers` (name, phone, email, address)
- `products` (name, sku, category_id, supplier_id, price, cost, stock, min_stock, description, image_path, softDeletes)
- `inventory_movements` (product_id, type: in|out, quantity, note, created_by, timestamps)

Seeders populate basic data for admins, categories, suppliers, products, and a few sample movements.

## Development Notes

- CDN-first: aplikasi berjalan tanpa Vite/Node/NPM. Frontend assets menggunakan Tailwind dan Alpine via PlayCDN.
- Opsi dev lokal: Vite + Tailwind 4 tersedia untuk kustomisasi aset (lihat bagian opsional di atas).
- Admin layout dan public layout berbasis CDN, tidak butuh build step untuk runtime.
- Some endpoints such as reports export are placeholders for future enhancement.
- Image upload requires `php artisan storage:link` and writable `storage/`.

## UI/UX Features

- **Modern Design**: Glassmorphism effects dengan tema oranye yang konsisten (selaras dengan komponen di `resources/views/layouts/public.blade.php` dan `resources/views/layouts/admin.blade.php`)
- **Responsive Layout**: Mobile-first design yang optimal di semua device
- **Interactive Elements**: Smooth animations dan hover effects
- **Background Pattern**: Subtle grid pattern untuk visual enhancement
- **Typography**: Hierarki yang jelas dengan Inter font family

## Status

- MVP functional: admin login, products/categories/suppliers CRUD, inventory adjustments, dan basic reports
- Modern UI/UX dengan design system yang konsisten (tema oranye)
- Responsive design untuk mobile dan desktop
- Background pattern dan glassmorphism effects
- Export/import features (placeholder)
- Please open issues atau PRs untuk improvements dan additional features
