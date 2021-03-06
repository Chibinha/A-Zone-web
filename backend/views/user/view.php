<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = "User: " . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($role ) { ?> 
    <h3 style="color:red"> This user is an employee </h3>
    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            'profile.phone',
            'profile.nif',
            'profile.address',
            'profile.postal_code',
            'profile.city',
            'profile.country',
            'status' => 'Status',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

    <?php if ($model->status != 0) { ?> 
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);?>
        <?php if ($model->status != '0')
        {?>
            <?=Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);} }?>
    </p>
</div>
