<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<div class="site-index">
    <h1>Areas</h1>
    <div class="body-content">
        <div class="row text-center">
            <?php foreach ($areas as $area): ?>
                <div class="col-md-3 col-sm-6 hero-feature">
                    <div class="thumbnail">
                        <?= Html::img( Yii::$app->urlManager->createUrl('uploads/'. $area->img), ['style'=>'width: 350px; height:200px']) ?>
                        <div class="caption">
                            <h3><?= Html::encode("$area->name") ?></h3>
                            <p><?= Html::encode("$area->description") ?></p>
                            <p>
                                <a href="<?php echo Url::to(['areas/view', 'id' => $area->id])?>" class="btn btn-default">More Info</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>