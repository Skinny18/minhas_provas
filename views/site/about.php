<?php

/** @var yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use yii\grid\ActionColumn;
use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
  <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Adicionar Matéria
  </button>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Prova</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php $form = ActiveForm::begin(); ?>

          <?= $form->field($model, 'materia')->textInput(['maxlength' => true]) ?>

          <?= $form->field($model, 'dia')->dropDownList([
            1 => 'Segunda',
            2 => 'Terça',
            3 => 'Quarta',
            4 => 'Quinta',
            5 => 'Sexta',
            6 => 'Sabado',
            7 => 'Domingo'
          ]) ?>

          <?= $form->field($model, 'hora_inicial')->textInput() ?>

          <?= $form->field($model, 'hora_final')->textInput() ?>

          <?= $form->field($model, 'feito')->checkbox() ?>



        </div>
        <div class="modal-footer">
          <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>

      </div>
    </div>
  </div>
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Segunda </th>
        <th scope="col">Terça</th>
        <th scope="col">Quarta</th>
        <th scope="col">Quinta</th>
        <th scope="col">Sexta</th>
        <th scope="col">Sabado</th>
        <th scope="col">Domingo</th>
      </tr>
    </thead>
    <tbody>
      <tr class="table-secondary">
        <?php $dados =  $model->getAllCronograma() ?>
        <?php for ($diaSemana = 1; $diaSemana <= 7; $diaSemana++) : ?>
          <td class="td-registro">
            <?php foreach ($dados as $registro) : ?>
              <?php if ($registro->dia == $diaSemana) : ?>
                <div class="registro mt-2 <?= $registro->feito ? 'bg-success' : 'bg-warning' ?>">
                  <p class="mt-2"><span>Matéria: </span><?= $registro['materia'] ?></p>
                  <p><span>Hora de inicio: </span> <?= $registro['hora_inicial'] ?>hrs</p>
                  <p><span>Hora de termino: </span><?= $registro['hora_final'] ?>hrs</p>
                  <div class="row ">
                    <div class="col-md-6">
                      <?= Html::beginForm(['feito', 'id' => $registro->id], 'post', ['class' => '']) ?>
                      <input class="form-check-input" type="checkbox" name="feito" value="true" <?= $registro->feito ? 'checked' : '' ?> onchange="this.form.submit()" />
                      <?= Html::endForm() ?>
                    </div>
                    <div class="col-md-6">
                      <?= Html::beginForm(['deletar', 'id' => $registro->id], 'post', ['class' => '']) ?>
                      <button type="submit" class="form form-control" name="deletar">
                        Deletar
                      </button>
                      <?= Html::endForm() ?>
                    </div>
                  </div>

                </div>


              <?php endif; ?>
            <?php endforeach; ?>
          </td>
        <?php endfor; ?>
      </tr>


    </tbody>
  </table>
</div>





<style>
  .registro {
    border-radius: 5px;
    text-align: center;
    padding: 2px;
  }

  .td-registro {
    border-right: 1px solid #212529;
  }
</style>