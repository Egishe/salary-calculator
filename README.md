REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.0.


INSTALLATION
------------

### Install framework and plugins
~~~
composer install
~~~

### Configure database connection

Edit the file `common/config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

### Create database structure
~~~
./yii migrate
~~~

### Generate demo data
~~~
./yii demo/generate-data
~~~
