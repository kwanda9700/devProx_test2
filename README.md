# form_blog

## Installation

* Needs composer to be installed, for windows
 https://getcomposer.org/Composer-Setup.exe

1) Clone the repo:
```
git clone https://github.com/kwanda9700/form_blog.git Form
```

2) Create `.env` file from the `.env.example` file by running this in the terminal:
```
composer run-script post-root-package-install
```

3) Setup database credentials on the `.env` and create a database on phpMyAdmin

4) Update Composer
``` 
composer update
```

5) Run the post create project script to generate application key
```
composer run-script post-create-project-cmd
```

6) Migrate the tables to the database
```
php artisan migrate
```

7) Serve the project
```
php artisan serve
```

8) then visit http://127.0.0.1:8000/

Done.
