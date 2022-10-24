
## About Project
> **Requires:**
- **[PHP 8.0+](https://php.net/releases/)**
- **[Laravel 9.0+](https://github.com/laravel/laravel)**


> **File to copy and replace:**
###Copy .env.example and rename as the new .env file

> **Things to run!!:**
>

#### Build Setup

``` bash
# install composer
composer install

# install node modules
npm install

# run migrations
php artisan migrate:fresh

# Create Default User Admin
php artisan db:seed

# Run npm 
npm run dev

# Run Queue worker
php artisan queue:work --tries=1

# Run Schedular
php artisan schedule:work

# Run Application
php artisan serve

```

> **Testing:**
>

#### Run Test

```bash
# Test Command
php artisan test

```
