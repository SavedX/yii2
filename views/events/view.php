<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Events */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-view">
    <h1><?= Html::encode($show['name']) ?></h1>
    <div style="float: left; margin-bottom: 100px" class="well">
        <div class="col-md-10 portfolio-item">
            <?= Html::img(Yii::$app->urlManager->createUrl('uploads/' . $show['image']), ['style' => 'width: 900px; height: 350px']) ?>
        </div>
        <div class="col-md-2 portfolio-item">
            <div class="view-name"><?= Html::encode($show['name']) ?></div>
            <div class="view-description"><?= Html::encode($show['description']) ?></div>
        </div>
    </div>
</div>