# 8장 샘플코드

## 대응

### 8-1 Command 기초

#### 8-1-1 클로저를 이용한 Command 작성

- [routes/console.php](routes/console.php)

#### 8-1-2 클래스를 이용한 Command 작성

- [app/Console/Commands/HelloCommand.php](app/Console/Commands/HelloCommand.php)

#### 8-1-3 Command 입력

- [app/Console/Commands/HelloCommand.php](app/Console/Commands/HelloCommand.php)

#### 8-1-4 Command 출력

- [app/Console/Commands/OutputCommand.php](app/Console/Commands/OutputCommand.php)

#### 8-1-5 Command 실행

- [routes/web.php](routes/web.php)
- [app/Console/Commands/WithArgsCommand.php](app/Console/Commands/WithArgsCommand.php)
- [app/Console/Commands/NoArgsCommand.php](app/Console/Commands/NoArgsCommand.php)
- [app/Console/Commands/OtherCommand.php](app/Console/Commands/OtherCommand.php)

#### 칼럼: 명령어 에러 시 스택 트레이스 출력

- [app/Console/Commands/ErrorCommand.php](app/Console/Commands/ErrorCommand.php)

### 8-2 Command 구현

- [app/Console/Commands/ExportOrdersCommand.php](app/Console/Commands/ExportOrdersCommand.php)
- [app/UseCases/ExportOrdersUseCase.php](app/UseCases/ExportOrdersUseCase.php)
- [app/Services/ExportOrdersService.php](app/Services/ExportOrdersService.php)

### 8-3 배치 처리 구현

- [app/Console/Commands/SendOrdersCommand.php](app/Console/Commands/SendOrdersCommand.php)
- [app/UseCases/SendOrdersUseCase.php](app/UseCases/SendOrdersUseCase.php)
- [app/Services/ExportOrdersService.php](app/Services/ExportOrdersService.php)
- Guzzle
- [config/batch.php](config/batch.php)
- [routes/api.php](routes/api.php)
- [.env](.env)
- [app/Providers/BatchServiceProvider.php](app/Providers/BatchServiceProvider.php)
- [config/app.php](config/app.php)
- [app/Services/ChatWorkService.php](app/Services/ChatWorkService.php)

## Usage

이 장의 샘플 코드는 `docker-compose`에서 동작합니다.

Docker, docker-compose를 설치한 뒤 다음 순서로 실행합니다.

```
$ git clone https://github.com/laravel-socym2021/chapter08.git
$ cd chapter08
$ make

$ docker-compose exec php bash
root@f5ab4e483701:/var/www/html# php artisan
```

실행 환경을 삭제할 때는 다음과 같이 `make clean` 명령어를 실행합니다.
  
```sh
$ make clean
```
