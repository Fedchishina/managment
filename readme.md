<h1 align="center">API for management of users and groups</h1>

## Installation
- clone repository
- composer install
- php artisan migrate
- php db:seed (for generating test data of db)

## How to regenerate DB
- composer dump-autoload
- php artisan migrate:refresh --seed

## API methods:
   - /users/ - fetch(retrieve) list of users (method: get)
   - /users/ - create a user <br>
   method: post<br> 
   params: last_name, first_name, email, is_active (1 - active, 0 - not active), group_id
   - /users/id/ - fetch info of a user (method: get)
   - /users/id/ - modify users info <br>
      method: post<br> 
      params: last_name, first_name, email, is_active (1 - active, 0 - not active), group_id
   - /groups/ - fetch list of groups (method: get)
   - /groups/ - create a group <br>
   method: post <br>
   params: name
   - /groups/id/ - fetch info of a group (method: get)
   - /groups/id/ - modify group info<br>
   method: post <br>
   params: name
