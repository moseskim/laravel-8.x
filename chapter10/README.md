# 2부. 10장 에러 핸들링과 로그 활용

## 대응표

- [Fluent\Logger\FluentLogger 클래스 등록](app/Providers/AppServiceProvider.php)
- [커스텀 헤더를 이용한 에러 응답 구현](app/Exceptions/Handler.php)
- [Blade 템플릿과 예외 처리 조합 패턴](app/Exceptions/AppException.php)
- [JSON 응답과 예외 처리 조합 패턴](app/Exceptions/UserResourceException.php)
- [Monolog\Handler\ElasticSearchHandler 클래스 등록](app/Providers/AppServiceProvider.php)
- [elasticsearch 드라이버 설정](config/logging.php)   
- [액세스 로그를 elasticsearch로 전송](app/Http/Controllers/IndexAction.php)

## Docker 

```bash
$ docker-compose build
$ docker-compose up -d
$ docker-compose exec -w /var/www/html php composer install
```
