Save data from API and display with Node
========================================

This is a small Test web application developed in PHP (Laravel), Node JS and Twitter Bootstrap 4. 

![Screenshot](https://raw.githubusercontent.com/iloveyii/api/master/screenshot.png)

### Task Description
Develop an application to read data from an open API and save to MySQL. Display the data using Node js.

### Installations

#### PHP Application
  * Clone the repository: `git clone https://github.com/iloveyii/api.git`.
  * Create a database (api_data) in MySQL server and change the database credentials in `api/php/config/database.php` and `api/php/.env` files.
  * CD to directory `cd api/php` and then install composer packages as `composer install` .
  * Run the database migrations `php artisan migrate`.  
  * Run the data import command to get data from API and save to MySQL database as `php artisan api:data`.  
  * To test the end point cd to public/ and run php build server (or any) as `php -S localhost:8080` and browse to http://localhost:8080/links .
  
#### Node Application
  * CD to directory `cd node` and then run npm install `npm install` .
  * Change database credentials at the top of the file `api/node/server.js`.
  * Run the node server as `npm start`. Then browse to `localhost:3000`. 
    
### Requirements

   * You many need to install the following.
     1. node >= 10.16.0
     2. npm >= 6.9.0
     3. PHP 7
     4. Apache 2 or Nginx Web server
     5. MySQL >= 5.7
