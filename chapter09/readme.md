# 9장. 샘플 코드

## 대응

### 9-1 단위 테스트

- [app/Services/CalculatePointService.php](app/Services/CalculatePointService.php)
- [app/Exceptions/PreconditionException.php](app/Services/CalculatePointService.php)
- [tests/Unit/CalculatePointServiceTest.php](tests/Unit/CalculatePointServiceTest.php)
- [phpunit.xml](phpunit.xml)

### 9-2 데이터베이스 테스트

- [app/Services/AddPointService.php](app/Services/AddPointService.php)
- [app/Models/PointEvent.php](app/Models/PointEvent.php)
- [app/Models/EloquentCustomerPointEvent.php](app/Models/EloquentCustomerPointEvent.php)
- [app/Models/EloquentCustomerPoint.php](app/Models/EloquentCustomerPoint.php)
- [app/Models/EloquentCustomer.php](app/Models/EloquentCustomer.php)
- [phpunit.xml](phpunit.xml)
- [database/factories/EloquentCustomerFactory.php](database/factories/EloquentCustomerFactory.php)
- [tests/Unit/EloquentCustomerPointEventTest.php](tests/Unit/EloquentCustomerPointEventTest.php)
- [tests/Unit/EloquentCustomerPointTest.php](tests/Unit/EloquentCustomerPointTest.php)
- [tests/Unit/AddPointServiceTest.php](tests/Unit/AddPointServiceTest.php)
- [tests/Unit/AddPointServiceWithMockTest.php](tests/Unit/AddPointServiceWithMockTest.php)

### 9-3 WebAPI 테스트

- [routes/api.php](routes/api.php)
- [tests/Feature/Api/PingTest.php](tests/Feature/Api/PingTest.php)
- [app/Http/Actions/AddPointAction.php](app/Http/Actions/AddPointAction.php)
- [app/Http/Requests/AddPointRequest.php](app/Http/Requests/AddPointRequest.php)
- [app/UseCases/AddPointUseCase.php](app/UseCases/AddPointUseCase.php)
- [app/Exceptions/PreconditionException.php](app/Exceptions/PreconditionException.php)
- [app/Exceptions/Handler.php](app/Exceptions/Handler.php)
- [tests/Feature/Api/AddPointTest.php](tests/Feature/Api/AddPointTest.php)
- [tests/Feature/Api/AuthTest.php](tests/Feature/Api/AuthTest.php)
- [tests/Feature/Api/WithoutMiddlewareTest.php](tests/Feature/Api/WithoutMiddlewareTest.php)
- [tests/Feature/Api/MailTest.php](tests/Feature/Api/MailTest.php)
- [tests/Feature/Api/MiddlewareTest.php](tests/Feature/Api/MiddlewareTest.php)
- [phpunit.xml](phpunit.xml)

## Usage

이번 장의 샘플 코드는 `docker-compose`에서 동작합니다.

Docker, docker-compose 설치 후 다음 순서로 실행합합니다.

```sh
$ git clone https://github.com/laravel-socym2021/chapter09.git
$ cd chapter09
$ make
```

실행 환경을 삭제할 때는 다음과 같이 `make clean` 명령어를 실행합니다.

```sh
$ make clean
```
