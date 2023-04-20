# Laravel Vue Rest API CRUD application  

### Requirements

    1. PHP version upto 8.2.*    
    2. Composer version 2.2.*   
    3. MySQL version 5.7.* 
    4. NodeJS v16.13.* 
    5. Laravel v9.5

### Installation

    1.  Clone this project using git clone. 
        Clone este projeto usando git clone.

    2.  Copy a fresh .env file
        Copie um novo arquivo .env

    3.  Update .env file by adding database information as db. 
        Atualize o arquivo .env adicionando informações do banco de dados, como db. 

            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=db
            DB_USERNAME=root
            DB_PASSWORD=
            
    4. run/rode composer install 

    5. run/rode php artisan migrate:fresh --seed
    
    6. run/rode php artisan key:generate

    7. run/rode npm install 
       
    8. run/rode npm run watch 