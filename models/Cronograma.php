<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cronograma".
 *
 * @property int $id
 * @property string|null $materia
 * @property string|null $hora_inicial
 * @property string|null $hora_final
 * @property bool|null $feito
 */
class Cronograma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cronograma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hora_inicial', 'hora_final'], 'safe'],
            [['feito'], 'boolean'],
            [['dia'], 'integer'],
            [['materia'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'materia' => 'Materia',
            'hora_inicial' => 'Hora Inicial',
            'hora_final' => 'Hora Final',
            'feito' => 'Feito',
        ];
    }



    
    public function getAllCronograma()
    {
        return $this->find()->all();

    }

    
    /**
     * {@inheritdoc}
     * @return CronogramaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CronogramaQuery(get_called_class());
    }
}
