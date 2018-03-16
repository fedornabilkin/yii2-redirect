Yii2 redirect finder
====================
Find page not found and save new path/

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist fedornabilkin/yii2-redirect "*"
```

or add

```
"fedornabilkin/yii2-redirect": "*"
```

to the require section of your `composer.json` file.

Migrations
-----

`php yii migrate --migrationPath=@fedornabilkin/redirect/migrations`

Usage
-----

```php
'modules' => [
    'redirect' => [
        'class' => \fedornabilkin\redirect\models\Redirect::class,
    ],
],
```