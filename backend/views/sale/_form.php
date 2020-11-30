<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sale_date')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-m-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'total')->textInput(['readOnly' => true]) ?>

    <?= $form->field($user, 'username')->textInput(['readOnly' => true]) ?>

    <?= $form->field($model, 'sale_finished')->checkbox() ?>

    <div class="form-group">
        <br>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

        <?php if ($model->sale_finished == '0')
        {?>
            <?=Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);} ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
