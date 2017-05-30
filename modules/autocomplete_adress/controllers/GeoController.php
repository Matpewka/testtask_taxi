<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 30.05.2017
 * Time: 12:53
 */

namespace app\modules\autocomplete_adress\controllers;

use app\modules\autocomplete_adress\models\data\AddressGoogle;
use yii\rest\Controller;
use yii\web\Response;
use Yii;
use Exception;

/**
 * Запросы на получение геоданных из различных истоничков
 * Class GeoController
 * @package app\modules\autocomplete_adress\controllers
 */
class GeoController extends Controller
{
    const STATUS_GOOGLE_OK = 'OK';

    /**
     * Источник данных Google
     * @param bool $term
     * @return array
     */
    public function actionGoogle($term = false, $format = 'json')
    {
        // Проверка параметров и формирование ссылки
        if (!$term) {
            // Проверки на длину и корректность ввода в данном ТЗ опускаем для простоты
            throw new Exception('Query string is empty or not set');
        }

        $data = AddressGoogle::getData($term);

        // Возвращаем ответ
        return $this->returnResponse($data, $format);
    }

    /**
     * Подготавливаем ответ.
     * @param $data
     * @param $format
     * @return mixed
     */
    private function returnResponse($data, $format)
    {
        // Проверяем в каком формате возвращать данные. По умолчанию JSON
        Yii::$app->response->format = ($format === Response::FORMAT_XML) ? Response::FORMAT_XML : Response::FORMAT_JSON;

        // Если понадобится дополнительное форматирование или обработка данных перед возвратом, то помещаем её сюда
        return $data;
    }
}