<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]); ?>

    <?php if ($model->status != '0')
    {
     $options= ['10' => 'Ativa', '9' => 'Por Ativar'];?>

    <?= $form->field($model, 'status')->dropDownList($options);}?>
    <?php
?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?php if ($model->status != '0')
        {?>
            <?=Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);} ?>
    </div>

    <?php if ($role) { ?>
        <?= Html::a('Revoke Worker role', ['/user/isworker?id=' . $model->id], ['class'=>'btn btn-primary']) ?>
    <?php } else { ?>
        <?= Html::a('Assign Worker role', ['/user/isworker?id=' . $model->id], ['class'=>'btn btn-primary']) ?>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
