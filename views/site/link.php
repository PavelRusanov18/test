<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\grid\GridView;
 
$this->title = 'Generate Link';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-link">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to generate link:</p>
    <div class="row">
        <div class="col-lg-7">
 
            <?php $form = ActiveForm::begin(['id' => 'form-link']); ?>
                <?= $form->field($linkForm, 'link')->textInput() ?>
            
                <div class="form-group">
                    <?= Html::submitButton('Generate', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
 
        </div>
        
        <div class="col-lg-7">
            <?=  GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\DataColumn', 
                        'value' => function ($data) {
                            return Url::to(['site/signup', "partnerLink" => $data->link], true); 
                        },
                    ],
                ],
            ]); ?>
 
        </div>        
    </div>
</div>