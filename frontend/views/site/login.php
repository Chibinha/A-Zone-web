<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor preencha os seguintes campos para efetuar o login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Nome de Utilizador') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Palavra-Passe') ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Lembrar de mim') ?>

                <div style="color:#999;margin:1em 0">
                     <?= Html::a('Esqueceu a sua passoword?', ['site/request-password-reset']) ?>.
                    <br>
                     <?= Html::a('Reenviar verificação de email', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('LOGIN', ['class' => 'btn btn-primary', 'name' => 'login-button', 'id' => 'btn-submit']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
