# 1부. 3장. 애플리케이션 아키텍처

## 대응표

- [트랜잭션 스크립트](app/Service/BookService.php)
- [의존 관계가 증가하는 컨트롤러](app/Http/Controllers/UserController.php)
- [액션으로 독립](app/Http/Actions/UserIndexAction.php)
- [리스펀더 구현](app/Http/Responder/UserResponder.php)
- [컨트롤러 클래스로부터 데이터베이스 조작 분리](app/Http/Controllers/Layered/UserController.php)
- [저장소 인터페이스 정의](app/Repository/UserRepositoryInterface.php)
- [저장소 구현](app/Repository/UserRepository.php)
- [서비스 스크립트와 저장소 이용 | 데이터베이스 조작을 포함한 구현을 서비스 클래스로 분리](app/Service/UserPurchaseService.php)

## Docker 

```bash
$ docker-compose build
$ docker-compose up -d
$ docker-compose exec -w /var/www/html php composer install
```
