<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use app\models\Areas;

/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <? echo $form->field($model, 'date')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Date...'],
        'removeButton' => false,
        //'convertFormat' => true,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss'
        ]
    ]);
    ?>

    <?= $form->field($modelShow, 'name')->textInput() ?>

    <?= $form->field($modelShow, 'description')->textarea() ?>

    <?= $form->field($model, 'area_id')->dropdownList(
    Areas::find()->select(['name', 'id'])->indexBy('id')->column(),
    ['prompt'=>'Select Area']
    ); ?>

    <?= $form->field($modelShow, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>