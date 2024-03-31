## Laravel 9 task management ##

### Installation ###

Go to task-manager folder on your powershell
```bash
cd task-manager
```

Update Composer
```bash
composer update
```

Next Copy .env
```bash
cp .env.example .env
```

Generate application key
```bash
php artisan key:generate
```

Create database
```bash
touch databse/database.sqlite
```

Migrate database
```bash
php artisan migrate
```

Start server
```bash
php artisan serve
```
