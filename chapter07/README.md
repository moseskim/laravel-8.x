# 7장

## For Docker

### setup

```bash
$ docker-compose up -d
$ docker-compose exec php composer install --prefer-dist --no-interaction && composer app-setup
$ docker-compose exec php php artisan migrate
$ docker-compose exec php php artisan db:seed
$ curl -X PUT 'http://localhost:9200/reviews' -H 'Content-Type: application/json' -d @schema/mapping.json
```

#### 컨테이너의 캐시가 남아있는 경우

```bash
$ docker-compose build --no-cache
```

### Queue

```bash
$ docker-compose exec php php artisan queue:work
```

### MySQL 확인 방법

```bash
$ docker-compose exec mysql bash
```

docker의 mysql 컨테이너 안에서 다음을 실행합니다.

```bash
# mysql -u sample -p secret
```
