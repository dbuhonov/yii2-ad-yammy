Yii2 AdYammy
====================================================
<img
  src="logo.png"
  alt="Yii2 AdYammy"
  style="display: inline-block; margin: 0 auto; max-width: 300px">
====================================================
AdYammy для Yii2 - это комплексное решение, разработанное для управления рекламными скриптами на вашем веб-сайте. Он помогает повысить доходность сайта путем управления показом рекламных блоков. С помощью AdYammy вы можете создавать, редактировать и обновлять рекламные блоки.

Установка
------------

Для установки расширения, выполните команду:

```
composer require require --prefer-dist dmitrybukhonov/yii2-ad-yammy "*"
```

Использование
------------
Выполнить миграцию
```
php yii migrate --migrationPath=@dmitrybukhonov/adyammy/migrations --interactive=0
```

Зарегистрировать в конфигурации приложения

```
return [
    ...
    'modules' => [
        'adyammy' => [
            'class' => \dmitrybukhonov\adyammy\Module::class,
            'backendAppId' => 'app-backend',
            'imagePath' => '@storage/ad-image',
            'viewPath' => '@dmitrybukhonov/adyammy/backend/views',
            'imageUrl' => '@frontendUrl/images/storage/ad-image',
            'adPositionList' => \dmitrybukhonov\adyammy\helpers\AdPosition::getAll(),
        ],
    ],
    ..
];
```
Чтобы добавить новые позиции для размещения рекламных блоков, нужно унаследоваться от AdPosition и указать новый класс в файле конфигурации.

-----
Отображение

Чтобы отобразить рекламный блок на вашем сайте, добавьте следующий код в ваш шаблон::

```php
use dmitrybukhonov\adyammy\widgets\AdWidget;
use dmitrybukhonov\adyammy\helpers\AdPosition;

<?= AdWidget::widget([
    'id' => AdPosition::DISPLAY_MIDDLE_HOME_PAGE_ID,
]) ?>
```
