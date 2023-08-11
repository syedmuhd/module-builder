## Laravel API Module Builder

##### # What It Does
This package allows you to quickly scaffold API module generation for your Laravel application. The module will have basic CRUD functionality and will be ready to use out of the box.

It will generate the following files:
- API Routes
- Requests
- Controller
- Service
- Repository
- Model
- Migration

This package provides consistency in your codebase across all modules and allows you to focus on the business logic of your application.

##### # Installation
```php
composer require syedmuhd/module-builder
```

Run the following command to publish the base file (mandatory):
```php
php artisan builder:install
```

##### # Usage
Run the following command to generate a module:
```php
php artisan builder:generate {module_name}
```

##### # License
This package is open-sourced software licensed under the MIT license.