# API for converting currencies

**Third Party Api** <br>

https://exchangeratesapi.io/

**Dependency** <br>
- Docker

## Installation
- Run in your terminal
```
$ source aliases.sh
$ docker_build // building docker images and if you ahve problems with the premittions try with "sudo"
$ docker_up // run docker images
$ docker_artisan migrate:refresh --seed // to create user
```
- Run tests 
```
docker_phpunit
```
- test user credentials
```
{
	"email": "najdovskadijana@gmail.com",
	"password": "dijana1234",
}
```

## Technologies
- Docker
- Laravel, MySql, Redis, JWT auth etc.
- Database migration schema
- Creating models (User)
- SOLID principles
- Business Logic folder(DDD)
<img src="https://bosnadev.com/wp-content/uploads/2015/03/repository_pattern.png" alt="">  <br> 
- Tests (Mocking)
- Database Factory pattern seeders (UsersSeeder)
- Third party API 
