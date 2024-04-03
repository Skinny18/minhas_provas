<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cronograma]].
 *
 * @see Cronograma
 */
class CronogramaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cronograma[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cronograma|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
