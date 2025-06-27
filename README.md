<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Project Task Reminder

A modern Laravel-based project management system with dark mode, role-based dashboards, and smart reminders for tasks and projects.

## Features
- User authentication (login/register)
- Role-based dashboard (Admin, Member)
- Project and Task management
- Task comments and reminders
- Modern UI/UX (TailwindCSS)
- Email notifications

---

## Entity Relationship Diagram (ERD)
<p align="center">
  <img src="https://drive.google.com/file/d/1tk3w2I49WEPPZOs8M7lJtATLHxTPIjWP/view" alt="ERD Task Reminder" width="600">
</p>
- **User**: id, name, email, password, role
- **Project**: id, name, description, owner_id
- **Project_User**: user_id, project_id (pivot)
- **Task**: id, project_id, user_id, title, description, status, priority, due_date
- **TaskComment**: id, task_id, user_id, comment, created_at

---

## Main Flowchart

```
[User Login/Register]
        ↓
[Dashboard]
   ↓           ↓
[Projects]   [Tasks]
   ↓           ↓
[View/Add/Edit/Delete]
   ↓
[Task Reminders & Comments]
```

---

## Installation

1. **Clone the repository**
   ```sh
   git clone <repo-url>
   cd <project-folder>
   ```
2. **Install dependencies**
   ```sh
   composer install
   npm install && npm run build
   ```
3. **Copy .env and set up environment**
   ```sh
   cp .env.example .env
   # Edit .env for your DB and mail settings
   php artisan key:generate
   ```

---

## Database Migration & Seeding

1. **Run migrations**
   ```sh
   php artisan migrate
   ```
2. **(Optional) Seed database**
   ```sh
   php artisan db:seed
   ```

---

## Running the Application

1. **Start the local server**
   ```sh
   php artisan serve
   ```
2. **Access the app**
   - Open http://localhost:8000

---

## Scheduler & Reminders

1. **Start the Laravel scheduler**
   ```sh
   php artisan schedule:work
   ```
   At production, add this to your server's cron:
   ```sh
   * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
   ```

---

## Credits
Developed by Noor Akhnafal Aban

---

## License
MIT
