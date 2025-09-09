## 🚀 Project Overview

Laravel Inventory Management System is a web-based application to manage stock of household appliance parts and products (e.g., AC, fridge, washing machine, TV, stove). The app is built with Laravel 12.x and a CDN-only frontend (no Node/NPM, no Vite).

## ✨ Key Features (MVP)

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

## 🛠️ Tech Stack

- **Backend:** Laravel 12.x (PHP 8.1+)
- **Frontend:** Blade + Tailwind CSS (PlayCDN) + (optional) Alpine.js (PlayCDN)
- **Database:** MySQL
- **Build Tools:** None. No Vite, no Node/NPM. Fully CDN-based frontend.

## 📦 Installation

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
DB_DATABASE=laravel_inventory
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

## 🔐 Default Account

- **Admin**
  - Email: admin@example.com
  - Password: password

## 🔎 Routes Overview

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

## 📁 Database Schema (Migrations)

- `admins` (auth for admin guard)
- `categories` (name, description)
- `suppliers` (name, phone, email, address)
- `products` (name, sku, category_id, supplier_id, price, cost, stock, min_stock, description, image_path, softDeletes)
- `inventory_movements` (product_id, type: in|out, quantity, note, created_by, timestamps)

Seeders populate basic data for admins, categories, suppliers, products, and a few sample movements.

## 🧭 Development Notes

- No Vite / Node / NPM. Frontend assets use Tailwind and (optional) Alpine via PlayCDN only.
- Admin layout and public layout are CDN-based, no build step required.
- Some endpoints such as reports export are placeholders for future enhancement.
- Image upload requires `php artisan storage:link` and writable `storage/`.

## ✅ Status

- MVP is functional: admin login, products/categories/suppliers CRUD, inventory adjustments, and basic reports.
- Please open issues or PRs for improvements and additional features.
