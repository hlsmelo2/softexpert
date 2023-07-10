# SoftExpert

This project is my first test for the Soft Expert selection process

The objective of the project is to create some product registration screens and auxiliary data to be read later and compose a sale.

This sale must be saved, and on the sales screen, among other requirements, the values ​​of the products together with the quantities must be multiplied

The system also supports a login mechanism using JWT

The project was developed in vanilla PHP language and Javascript with the help of some libraries. Utilizes a built-in routing system that provides web routes and API routes

The front-end layer is provided through Phug (PugJS for PHP) and Vue which serve as a template in the designer

## Used tecnologies

- [PHP]
- [Javascript]
- [HTML]
- [CSS]
- [PostgreSQL]

## Project execution

First, you must load the database file (softexpert.sql) which is at the root of the repository:

```sh
psql -U user -d dbname < softexpert
```

After that, being in the root directory of the project, run the command:

```sh
php -S localhost:8080
```

## Test routines

The project has test routines on the front and backend

To run them just (being in the root of the project) run the following commands

[Back]

```sh
composer back-test
```

[Front]

```sh
npm run front-test
```
Or

```sh
yarn run front-test
```

** Enjoy **
