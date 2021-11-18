# Quizzy

## Description

Welcome in the biggest quiz of the world !

## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PASSWORD', 'your_db_password');
```
4. Create a database named "quizzy".
5. Import *database.sql* in your SQL server, you can do it manually or use the *migration.php* script which will import a *database.sql* file.
6. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
7. Go to `localhost:8000` with your favorite browser.

## Panel admin
We have a panel admin where you can manage the question submitted but not integrated in the database.
You can go to your localhost url and add "login" at the end;
You will need a password for that, don't hesitate to ask us to test this feature.
(We will change the login feature soon to avoid this inconvenience)
Then, if the password matches the one in your database, you will be redirected to the panel.
