# elmo9ef-app

A service marketplace built with Laravel where customers can find and book service providers ("taskers") by category, and providers can create profiles and showcase their work.

## Features
- Browse services by category and search for services
- Tasker (service provider) profiles with a public detail page
- Become a tasker: create and edit your tasker profile
- Multi-step booking flow (3 steps)
- User registration, login and password reset (Laravel Breeze)
- Profile image update and project upload for taskers
- Country list endpoint and JSON endpoints for categories and services

## Tech stack
- **Back end:** PHP, Laravel 8, Laravel Sanctum
- **Database:** MySQL (Eloquent models and migrations)
- **Front end:** Blade templates, Tailwind CSS, Alpine.js, Laravel Mix
- **Tools:** Git, Composer, npm

## Project structure
- `app/Models`: Category, Service, Tasker, Country, Profile, Project, User
- `app/Http/Controllers`: Main, Service, Tasker, Booking, Auth, Profile, Project, Country
- `routes/web.php`: web routes
- `resources/views`: Blade views (services, taskers, booking, auth, profile)
- `database/migrations`: database schema

## Getting started

### Requirements
- PHP 7.3+ or 8.x, Composer, MySQL, Node.js and npm

### Installation
```bash
git clone https://github.com/Ayoubaitouaddi/elmo9ef-app.git
cd elmo9ef-app/elmo9ef
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Create a MySQL database, set `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` in `.env`, then run:

```bash
php artisan migrate
npm run dev
php artisan serve
```

The app is then available at http://127.0.0.1:8000.

## Screenshots
[Add 1 or 2 screenshots here]

## Author
Ayoub Ait Ouaddi, Junior Full-Stack Developer, Malta
