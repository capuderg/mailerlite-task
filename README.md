# MailerLite code task

## Task instructions

https://gist.github.com/tadaspaplauskas/28f80efd2324faac05b6503d427cc471

## Instructions

1. clone the repository
2. copy the `.env.example` to `.env` file
3. run `vagrnat up`, to provision the laravel homestead server, where the project will run
4. run `vagrant ssh` and then `cd code`, once you are "sshed" into the server
5. in the server run `php artisan migrate:fresh` and then `php artisan db:seed` in order to get some dummy records in the DB
6. run `php artisan key:generate`
7. run `composer install`
8. run `npm install`

At this point the project should be functioning.

In order to run test, run `composer test`.
