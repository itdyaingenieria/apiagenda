## likeu Laravel CRUD API with Auth
Technical test Basic Laravel CRUD API application included with Authentication Module for LIKEU, Client Module and Appointment Module. It's included with JWT authentication and Swagger API format.

----

### Language & Framework Used:
1. PHP-8.1.4
1. Laravel-9

### Architecture Used:
1. Laravel 9.x
1. Interface-Repository Pattern
1. Model Based Eloquent Query
1. Swagger API Documentation - https://github.com/DarkaOnLine/L5-Swagger
1. JWT Auth - https://github.com/tymondesigns/jwt-auth
1. PHP Unit Testing - Some basic unit testing added.

### API List:
##### Authentication Module
1. [x] Register User API with Token
1. [x] Login API with Token
1. [x] Authenticated User Profile
1. [x] Refresh Data
1. [x] Logout

##### Client Module
1. [x] Client List
1. [x] Client List [Public]
1. [x] Create Client
1. [x] Edit Client
1. [x] View Client
1. [x] Delete Client

##### Appointments Module
1. [x] Appointments List
1. [x] Create Appointments
1. [x] Edit Appointments


### How to Run:
1. Clone Project - 

```bash
git clone https://github.com/itdyaingenieria/apiagenda.git
```
1. Go to the project drectory by `cd apiagenda` & Run the composer install.
2. Create `.env` file & Copy `.env.example` file to `.env` file
3. Create a database called - `laravel_api_likeu`.
4. Now migrate and seed database to complete whole project setup by running this-
``` bash
php artisan migrate:refresh --seed
```
It will create `31` Users and `52` Dummy Clients and `4`  States.
5. Generate Swagger API
``` bash
php artisan l5-swagger:generate
```
6. Run the server -
``` bash
php artisan serve
```
7. Open Browser -
http://localhost:8000 & go to API Documentation -
http://localhost:8000/api/documentation
8. You'll see a Swagger Panel.


### Procedure
1. First Login with the given credential or any other user credential
1. Set bearer token to Swagger Header or Post Header as Authentication
1. Hit Any API, You can also hit any API, before authorization header data set to see the effects.


### Demo 

###### API List Views:
<a href="https://ibb.co/XpqWByf"><img src="https://i.ibb.co/sQZgS5p/1-view-principal.png" alt="1-view-principal" border="0"></a>

###### Login in Swagger with Given Data:
<a href="https://ibb.co/L9H6FMp"><img src="https://i.ibb.co/dkx6TSK/2-login.png" alt="2-login" border="0"></a>


###### Get token After Successfull Login:
<a href="https://ibb.co/FBHFSqC"><img src="https://i.ibb.co/p3hStr5/3-token.png" alt="3-token" border="0"></a>

###### Set token in Swagger Header:
<a href="https://ibb.co/f2p40rc"><img src="https://i.ibb.co/0cMhJYw/4-setbearer.png" alt="4-setbearer" border="0"></a>

###### Diagram Database Model
<a href="https://ibb.co/ypc7rkL"><img src="https://i.ibb.co/MfxQm1q/Database-Model.png" alt="Database-Model" border="0"></a>


### Test
1. Test with Postman - Download colletion LikeU-Api DFYA.postman_collection.json
1. Test with Swagger.



### Ing Diego Fernando Yamá Andrade
### 3013407265
