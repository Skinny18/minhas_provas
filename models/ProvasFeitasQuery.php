<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProvasFeitas]].
 *
 * @see ProvasFeitas
 */
class ProvasFeitasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProvasFeitas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProvasFeitas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
