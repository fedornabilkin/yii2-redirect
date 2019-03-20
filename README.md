[![Latest Stable Version](https://img.shields.io/packagist/v/fedornabilkin/yii2-redirect.svg)](https://packagist.org/packages/fedornabilkin/yii2-redirect)
[![Downloads](https://img.shields.io/packagist/dt/fedornabilkin/yii2-redirect.svg)](https://packagist.org/packages/fedornabilkin/yii2-redirect)  


Redirect manager, not found finder
==================================
Find and save page not found, add new path.

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

Settings
-----
add backend config
```php
'modules' => [
    'redirect' => [
        'class' => fedornabilkin\redirect\Module::class,
        'frontendHost' => 'http://site.ru', // Go to page from admin panel
    ],
],
```

Usage
-----

Add controller actions
```php
public function actions()
{
    return [
        'error' => [
            'class' => \fedornabilkin\redirect\actions\ErrorAction::class,
        ],
    ];
}
```

Manager path
-----
You must restrict access to the controller!

`/redirect/manager`
