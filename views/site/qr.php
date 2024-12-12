<?php


/** @var yii\web\View $this */

/** @var string $short_url */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$url = Url::to(['redirect/index', 'short' => $short_url], true);

Pjax::begin([
    // Опции Pjax
]);

?>

    URL: <?= Html::a($url, $url, ['target' => '_blank', 'data-pjax' => 0]) ?><br/>

    QR code <img src="<?= Url::to(['site/qr', 'url' => $url]) ?>" alt="qr code"/>

<?php
Pjax::end();
