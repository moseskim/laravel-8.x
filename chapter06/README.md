# 2부. 6장. 인증 및 인가

## 대응표

- [캐시를 함께 사용하는 인증 드라이버 구현](app/Foundation/Auth/CacheUserProvider.php)
- [커스텀 인증 드라이버 등록](app/Providers/AuthServiceProvider.php)
- [커스텀 인증 드라이버 지정](config/auth.php)
- [비밀번호 리셋 확장](app/Auth/Passwords/PasswordManager.php)
- [커스텀 비밀번호 리셋 클래스 등록](app/Providers/PasswordServiceProvider.php)

- [user_tokens 테이블 작성](database/migrations/2021_04_07_103058_create_user_tokens_table.php)
- [UserSeeder 클래스 작성](database/seeders/UserSeeder.php)
- [token에서 사용자 정보 검색 처리](app/DataProvider/UserToken.php)
- [Authenticatable 인터페이스 구현 클래스](app/Entity/User.php)
- [UserProvider 인터페이스 구현](app/Foundation/Auth/UserTokenProvider.php)
- [구현한 인증 프로바이더 등록](app/Providers/AuthServiceProvider.php)
- [config/auth.php 추가](config/auth.php)
- [컨트롤러에서 토큰 인증을 이용한 사용자 정보 얻기](app/Http/Controllers/UserAction.php)
- [routes/api.php에 루트 추가](routes/api.php)

- [Tymon\JWTAuth\Contracts\JWTSubject 인터페이스 구현](app/Models/User.php)
- [jwt 드라이버 추가](config/auth.php)
- [TokenResponder 클래스 구현](app/Http/Responder/TokenResponder.php)
- [로그인 컨트롤러 클래스 구현](app/Http/Controllers/User/LoginAction.php)
- [jwt 드러아비를 경유한 사용자 정보 접근](app/Http/Controllers/User/RetrieveAction.php)

- [Amazon OAuth 인증 드라이버 구현](app/Foundation/Socialite/AmazonProvider.php)
- [Socialite 확장 드라이버 추가](app/Providers/SocialiteServiceProvider.php)
- [amazon 드라이버 이용](app/Http/Controllers/Register/RegisterAction.php)
- [통신 내용 로그 출력 + amazon 드라이버](app/Http/Controllers/Register/CallbackAction.php)

- [하나의 인가 처리를 하나의 클래스로 표현](app/Gate/UserAccess.php)
- [before 메서드를 이용한 인가 처리 로깅](app/Providers/AuthServiceProvider.php)
- [PHP의 빌트인 클래스를 이용한 정책 클래스 구현](app/Policies/ContentPolicy.php)
- [정책 클래스 이용](app/Http/Controllers/User/RetrieveAction.php)

- [인가를 수반하는 프레젠테이션 로직 구현](app/Foundation/ViewComposer/PolicyComposer.php)
- [View Composer 등록](app/Providers/AppServiceProvider.php)

## Docker

```bash
$ docker-compose build
$ docker-compose up -d
$ docker-compose exec -w /var/www/html php composer install
```
