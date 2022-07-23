## Make clone to project
```
git clone https://github.com/MahmoudKon/laravel_9.git
```

## Go inside the project
```
cd laravel_9
```

## Create database
* copy .env.example and rename it to .env
* set database config in your inv file

## Create key
```
php artisan key:generate
```

## Install composer
```
composer install --ignore-platform-reqs

```

## Generat data
```
php artisan migrate --seed
```

## Run project
```
php artisan serve
```
