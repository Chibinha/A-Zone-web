<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
$this->title = 'Alterar Dados';
?>

    <h1>Alterar Dados</h1>
    <div class="user-update">
        <?php $form = ActiveForm::begin([]) ?>

            <h2>Informação Pessoal</h2>
            <?= $form->field($user, 'username')->label('Nome de Utilizador')->textInput(['readOnly' => true])?>
            <?= $form->field($user, 'email')->label('E-mail')->textInput(['readOnly' => true]) ?>
            <?= $form->field($profile, 'firstName')->label('Nome') ?>
            <?= $form->field($profile, 'lastName')->label('Apelido') ?>
            <?= $form->field($profile, 'phone')->label('Telefone') ?>   
            <?= $form->field($profile, 'nif')->label('NIF') ?>
            <hr>
            <h2>Morada</h2>
            <?= $form->field($profile, 'country')->label('Cidade') ?>   
            <?= $form->field($profile, 'city')->label('Cidade') ?>
            <?= $form->field($profile, 'postal_code')->label('Código Postal') ?>
            <?= $form->field($profile, 'address')->label('Rua') ?>
            

            <?= Html::submitButton('Alterar dados', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Apagar Conta', ['delete', 'id' => $user->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar a sua conta?',
                'method' => 'post',
            ],
        ]) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
