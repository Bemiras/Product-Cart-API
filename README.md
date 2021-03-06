# Laravel Products and Cart API

<p align="left">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
<a href="https:github.com/bemiras"><img src="https://img.shields.io/badge/author-Bemiras-blue" alt="Author"></a>
<a href="https://product-cart-api.herokuapp.com/api/products"><img src="https://img.shields.io/badge/website-CHECK-green" alt="Website" ></a>

</p>


This project was built as a simple backend task, in PHP as a recruitment job.

Check: 
https://product-cart-api.herokuapp.com/api/products

## Task Requiremnts:
### 1. Product catalog API:
#### Catalog contains following products:
<div>
    <table>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Price</th>
        </tr>
        <tr>
          <td>1</td>
          <td>Chocolate</td>
          <td>1.99</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Chips</td>
          <td>2.99</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Beer</td>
          <td>3.99</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Pineapple</td>
          <td>4.99</td>
        </tr>
        <tr>
          <td>5</td>
          <td>Car</td>
          <td>5675.99</td>
        </tr>
    </table>
    </div>
    
#### The API should expose methods to:
- Add a new product
- Update a product title and/or price
- List all of the products
   

### 2. Cart API
#### This API allow adding products to the cart and  should expose methods to:</p>
- Add a product to the cart
- List all the products in the cart



## Assumptions 
- The Users Can signUp Or login using his email addresses and passwords, users will be given an access_token upon signin in.
- The logged  user can create, update product.
- The Product and Cart data is persisted to the database.
- The logged  user can add and view his cart



## Language, Framework, and Datastore.
- This System is implemented using php laravel framework
- Mysql is ised as a Database for this application (DB_NAME = "Shop")
- The Cart and Products data is persisted in the Database to be in-compliance with the RESTfulness Guidelines and best practices and avoid using the sessions to save the state of the user



## Documentation API:

#### 0) Registry
- POST /api/register
- POST /api/login
- POST /api/logout

#### 1) Products
- POST /api/products
- PUT /api/products/{id}
- GET /api/products

#### 2) Cart
- POST /api/cart
- GET /api/cart/{id}



## Installation
````
$ php artisan migrate
$ php artisan db:seed
$ php artisan serve
````

## License
[MIT license](https://opensource.org/licenses/MIT)
