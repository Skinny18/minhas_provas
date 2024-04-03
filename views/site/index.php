<?php

/** @var yii\web\View $this */

use app\models\ProvasFeitas;
use app\models\ProvasFeitasStrategy;
use miloschuman\highcharts\Highcharts;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'Minhas Provas :)';
?>

<!-- <div>
    <?= $model->generateQrCode(); ?>
</div> -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Adicionar Prova
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

                <?= $form->field($model, 'assunto')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'data')->widget(
                    DatePicker::className(),
                    [
                        'dateFormat' => 'php:m/d/Y',
                        'clientOptions' => [
                            'dateFormat' => 'php:d/m/Y',
                            'changeYear' => true,
                            'changeMonth' => true,
                            'yearRange' => '-100:+0',
                        ]
                    ],
                    ['placeholder' => 'mm/dd/yyyy']
                )
                    ->textInput(['placeholder' => \Yii::t('app', 'mm/dd/yyyy')]); ?>
                <?= $form->field($model, 'acertos')->textInput() ?>

                <?= $form->field($model, 'questoes')->textInput() ?>


                <div class="form-group">
                </div>

            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'assunto',
                'data',
                'acertos',
                'questoes',
                [
                    'attribute' => 'porcentagem',
                    'format' => 'html',
                    'value' => function ($model) {
                        $color = new ProvasFeitasStrategy();
                        $porcentagem = $model->getPorcentForQuestions($model->acertos, $model->questoes);
                        return $color->color($porcentagem);
                    }
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, ProvasFeitas $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h2>Total de Questões</h2>
            </div>
            <div class="card-body">
                <span><?= $model->getAllQuestions() ?> </span>
            </div>
        </div>

        <?php
        $dados =  $model->getSumForQuestionsMonth();
        $categorias = [];
        $amanda_data = [];

        foreach ($dados as $item) {
            $mes_nome = date("F", mktime(0, 0, 0, $item['mes'], 1));
            $categorias[] = $mes_nome;

            $amanda_data[] = $item['total_questoes'];
        }

        echo Highcharts::widget([
            'options' => [
                'chart' => ['type' => 'column'],
                'title' => ['text' => 'Questões por Mês'],
                'xAxis' => [
                    'categories' => $categorias
                ],

                'series' => [
                    ['name' => 'Amanda', 'data' => $amanda_data],
                ]
            ]
        ]); ?>

        <div class="card mt-2">
            <div class="card-header">Questões feitas Hoje</div>
            <div class="card-body">
                <span><?= $model->getSumQuestionToday(); ?></span>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">Questões feitas essa semana</div>
            <div class="card-body">
                <span><?= $model->getSumQuestionThisWeek() ?></span>
            </div>
        </div>
    </div>
</div>