<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cronograma $model */

$this->title = 'Update Cronograma: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cronogramas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cronograma-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
