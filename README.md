## Unpacking instructions

###install docker and docker-compose
```
docker-compose build
docker-compose up -d

docker-compose exec app-link bash
 - cp .env.example .env
 - composer install
 - php artisan key:generate
 - php artisan migrate
```
