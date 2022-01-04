<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Based test</h1>
    <br/>
</p>

This is basic [Yii 2](http://www.yiiframework.com/) test application that allow's you to create simple CV & print PDF.

### Installation

1) Copy config-dist/ to config/
2) Create mysql database
3) Change config/db.php to your created database name on step 2.
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=[YOUR_DATABASE_NAME]',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
4) Install composer dependecies
~~~
composer install
~~~
5) Install migrations
~~~
yii migrate
~~~
6) Access web app using `yii serve` or using http://localhost/[PROJECT_PATH]/web/index.php
