<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProvasFeitas $model */

$this->title = 'Create Provas Feitas';
$this->params['breadcrumbs'][] = ['label' => 'Provas Feitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provas-feitas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
