yii2-settings
=============

Yii2 settings component

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist pendalf89/yii2-settings "*"
```

or add

```
"pendalf89/yii2-settings": "*"
```

to the require section of your `composer.json` file.

Apply migration
```sh
yii migrate --migrationPath=vendor/pendalf89/yii2-settings/migrations
```

Configuration:

```php
'components' => [
    'settings' => [
        'class' => 'pendalf89\settings\Settings',
    ],
],
```

Usage
------------
```php
$settings = Yii::$app->settings;
$settings->set('sitemap.update_cache_freq', 21600);
echo $settings->get('sitemap.update_cache_freq');  // 21600

// Sample with default value:
echo $settings->get('sitemap.update_cache_freq', 21600);  // 21600
```