<?php

/** @var yii\web\View $this */

/** @var app\models\UrlForm $model */
/** @var string|null $save_error */

$this->title = 'My Yii Application';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

Pjax::begin([
    // Опции Pjax
]);

$form = ActiveForm::begin([
    'id' => 'url-form',
    'options' => ['class' => 'form-horizontal', 'data' => ['pjax' => true]],
]);

?>
    <div class="site-index">

        <div class="body-content">
            <?= ($save_error ? '<b>' . $save_error . '</b>' : '') ?>
            <?= $form->field($model, 'url') ?>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

        </div>
    </div>
<?php
ActiveForm::end();
Pjax::end();
