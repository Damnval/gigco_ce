
# API promotion-entrant Coding Exam.

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
php artisan generate:key
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

## Serve project

```bash
php artisan serve
```
Go to browser and type http://localhost:8000/

### Coding Style

PSR-2 / SOLID / KISS


