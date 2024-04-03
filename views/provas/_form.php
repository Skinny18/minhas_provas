<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProvasFeitas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="provas-feitas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'assunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'acertos')->textInput() ?>

    <?= $form->field($model, 'questoes')->textInput() ?>

    <?= $form->field($model, 'porcentagem')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
