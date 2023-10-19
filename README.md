# Marketplace Demo project

## Prerequisites

 - installed PHP 8.2
 - MySQL / MariaDB Database server
 
## Setup

First of all you need create the `.env` file. You can copy the `.env.example` file then edit the following values:

 - `DB_HOST`: the host of the DB server
 - `DB_PORT`: the port of the DB server, 3306 by default
 - `DB_DATABASE`: the name of the databse
 - `DB_USERNAME`: the name of the user accessing the database
 - `DB_PASSWORD`: the password of the user accessing the database
 
then run the
```
 artisan key:generate
 ```
command to generate an Application key.

After that you can run the migrations to create and populate the database scheme with the following command:
```
php artisan migrate:fresh --seed
```
This command will populate the database with some random data.

Now run a local webserver with
```
php artisan serve
```

command. Now you should access the swagger documentation via http://127.0.0.1:8000/api/docs

## Project structure

 - `/routes` : `api.php` is containing all of the routes for the Orders API, the `web.php` serve the Swagger documentation
 
 - `/database/migrations` : You can find here the neccessary database migration files. 
 - `/database/factories` : You can find here the neccessary factories which used by the seeders 
 - `/database/seeders` : You can find the database seeder logic here. 
 
 - `/database/seeders` : You can find the database seeder logic here. 

 - `app/Enums`:
 - `app/Models`: Database models. They are following the "Active record patrtern" (see more: [Eloquent ORM](https://laravel.com/docs/10.x/eloquent)
 - `app/Services`: The controllers are processing the request, validating it and use the services to produce some output.
 - `app/Providers`: ServiceProviders are registering the corresponding services in the Applicaiton's DI container.
 
 - `app/Http/Controllers`: You can find all of the controllers here.
 - `app/Http/Request`: Request validation logic. (see more: [Laravel Validation](https://laravel.com/docs/10.x/validation#introduction))
 - `app/Http/DTO`: 

 
### Application

#### OrderController
The incoming requests are validated by [Laravel Validation](https://laravel.com/docs/10.x/validation#introduction) You can find the rules in the `app/Http/Request` package.

#### OrderService
The `OrderCOntroller` does not do any business logic, just passing the validated request to the Service. The Service manipulates the database and maps the entites to different DTO which are passed back to the Controller.

## Testing
### Swagger-UI
You can test the API with the Swagger-UI on http://127.0.0.1:8000/api/docs .
### cURL

#### List orders

```
curl -X 'POST' \
  'http://marketplace.test/api/orders/search' \
  -H 'accept: application/json' \
  -H 'Content-Type: application/json' \
  -d '{
  "id": 0,
  "status": "new",
  "from": "2023-10-19T01:00:31.815Z",
  "to": "2023-10-19T01:00:31.815Z"
}'
```

#### Update orders

```
curl -X 'POST' \
  'http://marketplace.test/api/orders/update' \
  -H 'accept: */*' \
  -H 'Content-Type: application/json' \
  -d '{
  "id": 3,
  "status": "completed"
}'
```

#### Create order

```
curl -X 'POST' \
  'http://marketplace.test/api/orders/create' \
  -H 'accept: application/json' \
  -H 'Content-Type: application/json' \
  -d '{
  "customerName": "Példa Márton",
  "customerEmail": "name2@domain.tld",
  "shippingMethod": "delivery",
  "shippingAddress": {
    "name": "string",
    "postcode": 1222,
    "city": "Budapest",
    "street": "Pelda utca 27/A 1/12"
  },
  "billingAddress": {
    "name": "string",
    "postcode": 1222,
    "city": "Budapest",
    "street": "Pelda utca 27/A 1/12"
  },
  "products": [
    {
      "name": "Test product",
      "quantity": 12,
      "unitPrice": 123.45
    }
  ]
}'
```
