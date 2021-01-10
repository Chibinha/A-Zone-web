<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Preencha os campos para criar conta</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                
                <?= $form->field($model, 'firstName')->label('Nome') ?>

                <?= $form->field($model, 'lastName')->label('Apelido') ?>

                <?= $form->field($model, 'phone')->label('Telefone') ?>

                <?= $form->field($model, 'nif')->label('NIF') ?> 

                <?= $form->field($model, 'address')->label('Morada') ?>

                <?= $form->field($model, 'postal_code')->label('Código de Postal') ?>

                <?= $form->field($model, 'city')->label('Cidade') ?>

                <?= $form->field($model, 'country')->label('País') ?>

                <div class="form-group">
                    <?= Html::submitButton('Registar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
