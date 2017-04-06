<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<div class="site-index">
    <h1>Events</h1>
    <div class="body-content">
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
    </div>
</div>
<div class="text-center">
<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>