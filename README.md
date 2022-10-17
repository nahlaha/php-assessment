### This project uses Laravel, if you want to read about it visit [Laravel](https://laravel.com/)

# Setup

-   To install dependencies run `composer install`
-   To run the app run `php artisan serve`

# Exercise

-   Create a restful API for merchants where we can add new merchants or update/delete existing ones
-   Merchants can also add their own products with the required price and update them in the future as well
-   Merchants can also create multiple stores

# Technical guidelines

## 1. Relations between Models

-   There should be an endpoints for CRUD operations for Merchants
-   There should be endpoints for CRUD operations for Stores
-   There should be endpoints for CRUD operations for Products
-   A merchants can create one/many stores and one/many products
-   A product only belongs to one Merchant
-   A product belonging to a merchant can only belong to that merchant stores
-   A product can belong to one/many stores with different prices

## 2. Requirements

-   Each Model should have it's own controller (see App/Models/Example.php)
-   All restrictions are handled on the controller side (See App/Http/Controllers/ExampleController.php)
-   Any database variables should be included in the .env (It's already there)
-   Migrations should work out of the box (See 2022_10_10_111721_example_migration)

# Bonus Objectives

-   Add a simple frontend forms/tables to view the models
-   Add a documentation on how to use the APIs (can be simple markdown doc)
-   Create unit tests for controllers
-   Create a collection (if you will write a documentation) that have all APIs


- admin user password = admin@123
