<?php
 
use yii\helpers\Html;
use yii\grid\GridView;
 
$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-profile">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($parentReferal) : ?>
    <p>Parent referal:</p>
    <div class="row">
        <div class="col-lg-7">
            <p><?= "Вы пришли от: {$parentReferal->email}" ?></p>
        </div>  
    </div>
    <?php endif; ?>
    
    <p>Your referals:</p>
    <div class="row">
        <div class="col-lg-7">
            <?=  GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\DataColumn', 
                        'value' => function ($data) {
                            return $data->email; 
                        },
                    ],
                ],
            ]); ?>
        </div>  
    </div>
</div>