# NexaDesk - Modern Ticketing Helpdesk System

NexaDesk is a modern web-based ticketing and helpdesk management system built using Laravel 12, Livewire Volt, TailwindCSS, Chart.js, and Laravel Reverb.

This project helps users manage support tickets efficiently with a modern responsive interface, realtime notifications, analytics dashboard, activity logs, and admin management features.

---

# ✨ Features

* Authentication Login & Register
* User Dashboard
* Admin Dashboard
* Ticket Management System
* Ticket Status Management
* Ticket Priority System
* Realtime Notification
* Realtime Ticket Update
* Activity Logs
* Export Ticket PDF
* Dark Mode
* Responsive Modern UI
* SweetAlert Notification
* Chart Analytics
* User Profile Management

---

# 🛠 Tech Stack

## Backend

* Laravel 12
* Livewire Volt
* Laravel Reverb
* Barryvdh DomPDF

## Frontend

* TailwindCSS
* Chart.js
* SweetAlert2
* Alpine.js
* Vite

---

# 📦 Installation Guide

## 1. Clone Repository

```bash
git clone https://github.com/GemparPriadi/NexaDesk.git
```

---

## 2. Open Project Folder

```bash
cd NexaDesk
```

---

## 3. Install Composer Dependency

```bash
composer install
```

---

## 4. Install NPM Dependency

```bash
npm install
```

---

## 5. Setup Environment File

```bash
cp .env.example .env
```

---

## 6. Generate Laravel Key

```bash
php artisan key:generate
```

---

## 7. Setup Database

Create database first then configure `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nexadesk
DB_USERNAME=root
DB_PASSWORD=
```

---

## 8. Run Migration

```bash
php artisan migrate
```

---

## 9. Storage Link

```bash
php artisan storage:link
```

---

# ⚡ Realtime Configuration

This project uses Laravel Reverb for realtime notifications and live ticket updates.

Run Reverb server:

```bash
php artisan reverb:start
```

---

# 🚀 Run Full Project

Open multiple terminals:

## Terminal 1 - Laravel Server

```bash
php artisan serve
```

---

## Terminal 2 - Vite

```bash
npm run dev
```

---

## Terminal 3 - Laravel Reverb

```bash
php artisan reverb:start
```

---

# 📚 Required Libraries

## Composer Packages

```bash
composer install
```

Packages used:

* Laravel Framework
* Livewire Volt
* Laravel Reverb
* Barryvdh DomPDF

---

## NPM Packages

```bash
npm install
```

Frontend libraries:

* TailwindCSS
* Chart.js
* SweetAlert2
* Alpine.js
* Vite

---

# 🔔 Realtime Features

* Live Notification
* Realtime Ticket Update
* Live Admin Dashboard
* Realtime Event Broadcasting

---

# 🔐 Admin Features

* Manage All Tickets
* Change Ticket Status
* View Analytics Dashboard
* Export PDF Report
* Activity Monitoring
* Realtime Ticket Monitoring

---

# 📸 Preview

## Ticket Management

![Ticket](public/images/ticket.png)

---

# 👨‍💻 Author

Developed by Gempar Priadi

GitHub:
https://github.com/GemparPriadi
