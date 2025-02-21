
## testBlog_symfony

```
git clone git@github.com:Jagepard/testBlog.symfony.git
```
```
cd testBlog.symfony
```
```
composer install
```

Create a database, for example: ```testBlog_symfony```
Specify connection parameters in the configuration file: ```.env```
```yml
DATABASE_URL="mysql://jagepard:password@127.0.0.1:3306/testBlog_symfony?serverVersion=8.0.36&charset=utf8mb4"
```

Run migrations:
```
php bin/console doctrine:migrations:migrate
```
Seeding user data:
```
php bin/console doctrine:fixtures:load
```
Generate application key
```
php bin/console secrets:generate-keys
```
Launch the built-in server:
```
symfony serve
```

Admin panel:
```
http://127.0.0.1:8000/admin
```
User identity:
```
Login: admin@admin.com
Password: password
```