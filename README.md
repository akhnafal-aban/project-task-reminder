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

ERD Img: https://drive.google.com/uc?export=view&id=1tk3w2I49WEPPZOs8M7lJtATLHxTPIjWP

- **User**: id, name, email, password, role  
- **Project**: id, name, description, owner_id  
- **Project_User**: user_id, project_id (pivot)  
- **Task**: id, project_id, user_id, title, description, status, priority, due_date  
- **TaskComment**: id, task_id, user_id, comment, created_at

.DBML code: https://docs.google.com/document/d/1xZgSFPB7IQCeKTW6BnYVYvh39Wq2BGLoP0QBgStbD_A/edit?usp=sharing

---

## Main Flowchart

Flowchart: https://drive.google.com/file/d/14LvHWcCAP8Rtk6bl9ED6HXG_fA_MOQcL/view?usp=drive_link

---

## Admin account

- 22523179@students.uii.ac.id
- password -> password

## Member Account

- akhnafal03@gmail.com
- password -> password

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
   php artisan migrate:fresh --seed
   ```

---

## Running the Application

1. **Start the local server**
   ```sh
   php artisan serve
   ```
   in another terminal
   
   ```sh
   npm run dev
   ```
3. **Access the app**
   - Open http://localhost:8000

---

## Scheduler & Reminders

1. **Start the Laravel scheduler**
   ```sh
   php artisan schedule:work
   ```
   or
   
   ```sh
   php artisan tasks:send-reminders
   ```
---

---

## Running with Docker

This project includes a complete Docker setup for local development and testing. The Docker configuration uses multi-stage builds for optimized images and runs the app as a non-root user for security.

### Requirements
- Docker (latest)
- Docker Compose (v2 recommended)

### Services & Ports
- **php-app**: Laravel application (PHP 8.2, Node 20, Composer 2.7)
  - Exposes: `http://localhost:8000`
- **mysql-db**: MySQL database
  - Exposes: `localhost:3306`

### Environment Variables
- The application uses the `.env` file for configuration. The `docker-compose.yml` automatically loads `.env`.
- MySQL service uses these defaults (override in `.env` if needed):
  - `MYSQL_DATABASE=laravel`
  - `MYSQL_USER=laravel`
  - `MYSQL_PASSWORD=secret`
  - `MYSQL_ROOT_PASSWORD=rootsecret`

### Build & Run
1. **Copy and configure environment**
   ```sh
   cp .env.example .env
   # Edit .env as needed for your local setup
   ```
2. **Build and start the containers**
   ```sh
   docker compose up --build
   ```
   This will build the PHP app (with Composer and Node assets) and start both the app and MySQL services.

3. **Access the application**
   - Open [http://localhost:8000](http://localhost:8000) in your browser.

### Database & Storage
- MySQL data is persisted in a Docker volume (`mysql-data`).
- Laravel's `storage` and `bootstrap/cache` directories are writable by the app user in the container.

### Additional Notes
- The app runs as a non-root user inside the container for security.
- The default command starts Laravel's built-in server on port 8000.
- For artisan commands, you can use:
  ```sh
  docker compose exec php-app php artisan <command>
  ```
- For npm scripts (e.g., asset rebuilds), use:
  ```sh
  docker compose exec php-app npm run <script>
  ```

---


## Credits
Developed by Noor Akhnafal Aban

---

## License
MIT
