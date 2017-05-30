<?php

namespace app\modules\autocomplete_adress\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\autocomplete_adress\models\AutocomleteAddressLogs]].
 *
 * @see \app\modules\autocomplete_adress\models\AutocomleteAddressLogs
 */
class AutocomleteAddressLogsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\autocomplete_adress\models\AutocomleteAddressLogs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\autocomplete_adress\models\AutocomleteAddressLogs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
