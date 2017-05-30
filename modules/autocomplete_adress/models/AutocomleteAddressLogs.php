<?php

namespace app\modules\autocomplete_adress\models;

use app\modules\autocomplete_adress\models\query\AutocomleteAddressLogsQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "autocomlete_address_logs".
 *
 * @property integer $id
 * @property string $term
 * @property string $request
 * @property string $response
 * @property integer $created_at
 */
class AutocomleteAddressLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autocomlete_address_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request', 'response'], 'string'],
            [['created_at'], 'integer'],
            [['term'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'term' => 'Term',
            'request' => 'Request',
            'response' => 'Response',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\autocomplete_adress\models\query\AutocomleteAddressLogsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AutocomleteAddressLogsQuery(get_called_class());
    }

    /**
     * Логирует запрос и ответ от источника данных
     * @param $term
     * @param $request
     * @param $response
     */
    public static function log($term, $request, $response)
    {
        $log = new AutocomleteAddressLogs();
        $log->term = $term;
        $log->request = var_export($request, true);
        $log->response = var_export($response, true);

        if(!$log->save()){
            // Действия при ошибке создания логирующей записи. Ошибки можно получить $log->errors;
            return false;
        }
        return true;
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
