
## Prerequisite

The following are the minimum prerequisite needed to run the application

- A minimum version of php v8.1
- Mysql Database v8.0.28 or up
- composer
- Access to terminal, command prompt, powershell etc.

## Installation Guide

- Clone the repository
- open the project in your terminal or cd into the project folder eg. cd phone_book_app (if the project is opened in the same location as the terminal else add the fully qualified path)
- run the command **composer update** or **composer install** which ever works for you
- run the command **cp .env.example .env** (to create the env file from existing template or physically copy and rename the .env.example to .env)
- run the command ** php artisan key:generate** to generate the application key
- open the **.env** to edit the following keys
- change **APP_NAME=Laravel** key to **APP_NAME="Phone Book App"** or leave it if you prefer
- update the below credentials to suit your database creadentials (**Note create the database if not available**) <br>
    DB_CONNECTION=mysql <br>
    DB_HOST=127.0.0.1 <br>
    DB_PORT=3306 <br>
    DB_DATABASE=phonebook <br>
    DB_USERNAME=root <br>
    DB_PASSWORD= <br>
- run the command **php artisan migrate --seed** to run the migration files along with the initial data.
- if you do not want the initial data just run the command **php artisan migrate**
- run the command **php artisan serve** to run the development server
- open **http://127.0.0.1:8000 in your browser to access the project.

