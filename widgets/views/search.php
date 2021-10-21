<?php

/**
 * @var $model \app\models\SearchForm
 */

use app\widgets\ParametersWidget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>

<?php $form = ActiveForm::begin([
    'action' => ['hotel/index'],
    'id' => 'search-form',
    'fieldConfig' => [
        'template' => '{input}',
    ]
]); ?>
<div class="form-row" >
    <div class="col-lg">
        <?= $form->field($model, 'cityName', ['options' => ['class' => 'from-group mb-0']])->textInput(['id' => 'cityName','placeholder' => 'Going to']) ?>
        <?= $form->field($model, 'cityId', ['options' => ['class' => 'from-group invisible']])->hiddenInput(['id' => 'cityId']); ?>
        <div class="list-city" id="display">
            <ul class="list-group">
        </div>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'checkIn')->input('date') ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'checkOut')->input('date') ?>
    </div>
    <div class="col-lg">
        <label type="text" class="form-control" id="parameters">
            <span class="count" id="travelersSpan"><?=$model['travelers']?> travelers</span>
            <span class="count" id="roomSpan"><?=$model['room']?> room</span>
            <?= $form->field($model, 'travelers')->hiddenInput(['id' => 'travelers']); ?>
            <?= $form->field($model, 'room')->hiddenInput(['id' => 'room']);  ?>
        </label>
        <?= ParametersWidget::widget(['travelers' => $model['travelers'], 'room' => $model['room']]) ?>
    </div>

    <?php if($type == 'index'):?>
    <div class="col-md-2">
        <?= Html::submitButton('Search', ['class' => 'btn btn-outline-secondary btn-block'])?>
    </div>
    <?php endif;?>
</div>

<?php if($type == 'main'):?>
    <div class="col text-center">
        <?= Html::submitButton('Search', ['class' => 'mt-3 btn btn-outline-secondary'])?>
    </div>
<?php endif;?>
<?php ActiveForm::end()?>

