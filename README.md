# Wine App - Backend (Laravel API)

Backend sourcecode: https://gitlab.com/w1149/wine-app-backend

Mobile application: https://gitlab.com/w1149/wine-app

## Authentication - Laravel Sanctum
<p>
<a href="https://laravel.com/docs/9.x/sanctum">Sanctum</a>
</p>

# Laravel - instructions
## Start local server
```
php artisan serve
```

## Laravel API architecture

### Creating files

#### Create Model
```
php artisan make:model TODO
```

#### Create Model, Migration, Factory, Seeder, Controller
```
php artisan make:model TODO -mfsc
```

#### Create all important files
- Model
- Factory
- Migration
- Seeder
- Requests
- Controller
- Policy

```
php artisan make:model TODO --all
```

#### Create Route
```
```

### Migration

#### Migrate database tables
```
php artisan migrate
```

#### Drop all tables & Migrate & Seed data
```
php artisan migrate:fresh --seed
```


## Creating API release
1) Create **Migration** and **Seeder**, migrate a table and seed data
2) Create **Model**
3) Add API **Routes**
4) Create **Controller** with methods


## Testing API
Test are written in folder ``tests/Api``

For all tests run command:
```
php artisan test
```

## IDE Helper
https://github.com/barryvdh/laravel-ide-helper

- ```php artisan ide-helper:generate``` - PHPDoc generation for Laravel Facades

- ```php artisan ide-helper:models``` - PHPDocs for models

- ```php artisan ide-helper:meta``` - PhpStorm Meta file
