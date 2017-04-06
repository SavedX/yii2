<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\models\Areas */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areas-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if (!Yii::$app->user->isGuest) :?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ;
        endif; ?>
    </p>
    <div style="float: left; margin-bottom: 100px" class="well">
        <div class="col-md-10 portfolio-item">
            <?= Html::img(Yii::$app->urlManager->createUrl('uploads/' . $model->img), ['style' => 'width: 900px; height: 350px']) ?>
        </div>
        <div class="col-md-2 portfolio-item">
            <div class="view-name"><?= Html::encode($model->name) ?></div>
            <div class="view-description"><?= Html::encode($model->description) ?></div>
        </div>
    </div>
    <h1>Another events for this area:</h1>
    <div class="row">
        <?php foreach ($events as $event): ?>
            <div class="col-md-4 portfolio-item">
                <a href="<?php echo Url::to(['events/view', 'id' => $event->id])?>">
                    <?= Html::img( Yii::$app->urlManager->createUrl('uploads/'. $event->show->img),  ['class'=>'img-responsive', 'style'=>'width: 350px; height:200px']) ?>
                </a>
                <h3>
                    <a href="<?php echo Url::to(['events/view', 'id' => $event->id])?>"><?= Html::encode($event->show->name) ?></a>
                </h3>
                <p><?= Html::encode($event->show->description) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center">
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>