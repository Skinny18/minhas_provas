<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cronograma $model */

$this->title = 'Create Cronograma';
$this->params['breadcrumbs'][] = ['label' => 'Cronogramas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cronograma-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
