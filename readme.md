# イベント情報管理


## システム要件
- WebServer : Apache 2.4.x
- PHP: 7.2.x
- Database: MariaDB 最新バーション
- Laravel 要件: https://laravel.com/docs/5.7#installation

## インストール
- データベース作成
- .env ファイル変更
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event
DB_USERNAME=root
DB_PASSWORD=123456
```
- マイグレーション: `php artisan migrate`

- データシーダー(任意)
```
# create sample user with username and password: admin || 12345678
php artisan db:seed --class=UsersTableSeeder

# create area and provinces
php artisan db:seed --class=AreaAndProvince

# create 2 categories: ホームセンター, その他
php artisan db:seed --class=CategoriesTableSeeder

# create sample events
php artisan db:seed --class=EventsSeeder
```

### デモページ
ホームページ
![Alt text](public/images/home.png?raw=true "Home page")
      
管理ページ
![Alt text](public/images/admin.png?raw=true "Admin page")

イベント編集ページ
![Alt text](public/images/event-edit.png?raw=true "Event edit page")
