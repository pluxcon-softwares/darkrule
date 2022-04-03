# Darkrule - Darknet Ecommerce Shop


Darkrule is used to sell scripts, accounts and darknet tools. This project is for training purposes and can also be used for real deal, with coinbase bitcoin payment gateway

Each section performs a separate function within the App that helps with setting and defining your own type of product or tools to sell:
1. Product(Accounts, Tools, Tutorial)
2. Orders
3. Purchases
4. Users
5. Support
6. Message Board (For frontend users)
7. Rules (For frontend users) 


## Installation

It is preferred to have git setup installed on your local system.

Once downloaded/cloned go to the project directory on terminal/command line and install composer:

    composer install

        or
    
    composer update

Once composer is installed, run migration: 

    php artisan migrate

Note: if migration fails to run, install php7 if you are using php8. This laravel version uses php version 7.2.5+

After migration, run the database seeder: 

    php artisan db:seed
    
Once done migrating and seeding you will have default user:

    Admin Dashboard
    https://localhost:8000/admin
    email: admin@app.com
    password: 123456789

    User Dashboard
    http://localhost:8000
    create your own account
  