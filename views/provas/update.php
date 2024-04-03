<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProvasFeitas $model */

$this->title = 'Update Provas Feitas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Provas Feitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="provas-feitas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
