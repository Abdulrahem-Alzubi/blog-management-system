# Blog Management System 
## Introduction
blog management system with 2 types of article:
- First type is a text containing title, details and date of creation.
- Second one is a video blog containing  title, video and the date of creation.

Laravel 10, PHP 8.1, MySQL Database, Redis

## [Postman Collection](https://documenter.getpostman.com/view/20750849/2s93JqS58C) 
<hr> 

### Here is a list of the packages installed:
- [laravel passport](https://laravel.com/docs/10.x/passport).
- [laravel predis](https://laravel.com/docs/10.x/redis).

# Getting started
### Installation
<hr> 


- Clone this repository.
```
git clone https://gitlab.com/Abdulrahem_/blog-management-system.git
```

- copy this command to terminal for install the composer.
```
composer install
```
- copy this command for generate <code>.env</code> file .
```
cp .env.example .env 
```
- run this commands .
``` 
php artisan migrate

php artisan passport:install

php artisan key:generate

php artisan storage:link
```

- Start the local server.
```
php artisan serve 
```
- If you want to run the queue, should execute this command on another terminal tab
```
php artisan queue:work
```
##Notes: 
- to show files from database must add <code>http:/your domain/storage/</code> before the url 
- please add mail configuration in the .env file
## Now You Can Use This App 


