# Web User

### Required Install
- PHP 8.1.17
- Laravel 8.83.27
- MySQL 15.1

### How to Start

- Clone project from https://github.com/windahidayatt/web-user
- Open the folder of the project
- Copy file `.env.example` then paste it as `.env`
- Open terminal inside folder
- Run `composer install` to install all the packages that needed in the project
- Run `php artisan key:generate`.
- Run `php artisan migrate --seed` to migrate and fill the data (though migration) OR Import `db_web_user.sql` from the root of the project.
- Run `php artisan serve` to start the application.
