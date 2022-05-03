
# API promotion-entrant Coding Exam.

This repository is a coding exam for Promo Veritas that can use API with lumen framework. This test can send email using mailtrap.

## Installation

Clone the repository 

```bash
git clone https://github.com/Damnval/promo-veritas.git
```

## Install dependencies

Go to project folder and run 

```bash
composer install
```

## Development Setup

```bash
cp .env.example .env
```

## Create DataBase 

Go to your sql and create a DB named 'veritas'

## Run migration

```bash
php artisan migrate --seed
```

## Run and test Coding Exam

```bash
php -S localhost:8000 -t public
```
Go to browser and type http://localhost:8000/

### Coding Style

PSR-2/ SOLID
