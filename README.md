# MailerLite code task

## Instructions

1. clone the repository
2. copy the `.env.example` to `.env` file
3. run `composer install`
4. run `php vendor/bin/homestead make`
5. run `vagrnat up`, to provision the laravel homestead server, where the project will run
6. run `vagrant ssh` and then `cd code`, once you are "sshed" into the server
7. in the server run `php artisan migrate:fresh` and then `php artisan db:seed` in order to get some dummy records in the DB
8. run `php artisan key:generate`
9. run `npm install`

At this point the project should be functioning.

In order to run test, run `composer test`.
