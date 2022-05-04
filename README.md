# API GIGCO Coding Exam.

This repository is a coding exam for gigco. This repository will show the skill level and general knowledge about PHP and RESTful APIs using the Laravel framework. 

## Installation

Clone the repository 

```bash
git clone https://github.com/Damnval/gigco_ce.git
```

## Install dependencies

Go to project folder and run 

```bash
composer install
```

## Development Setup

Create an .env file

```bash
cp .env.example .env
```

Create a key for laravel project

```bash
php artisan key:generate
```

## Create DataBase 

Go to your sql and create a DB named 'gigco_ce'

## Setup DB credentials

DB_USERNAME={YOUR_DB_USERNAME}
DB_PASSWORD={YOUR_PASSWORD}

## Migrate database

```bash
php artisan migrate
```

## symbolic link

link your storage folder to public folder

```bash
php artisan storage:link
```

## Serve project

```bash
php artisan serve
```

Go to browser and type http://localhost:8000/

## To Test project

```bash
php artisan test
```

## To Generate Swagger/OpenAPI Documentation 

```bash
php artisan l5-swagger:generate
```

Go to browser and open http://localhost:8000/api/documentation

### Coding Style

PSR-2 / SOLID / KISS
