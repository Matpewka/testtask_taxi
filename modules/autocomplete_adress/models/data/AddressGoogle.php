<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 30.05.2017
 * Time: 13:18
 */

namespace app\modules\autocomplete_adress\models\data;


use app\modules\autocomplete_adress\models\AutocomleteAddressLogs;

class AddressGoogle
{
    const STATUS_GOOGLE_OK = 'OK';

    public static function getData($term)
    {
        $params = http_build_query([
            'input' => $term,
            'types' => 'geocode',
            'key' => \Yii::$app->params['apiGoogleKey']
        ]);
        $link = "https://maps.googleapis.com/maps/api/place/autocomplete/json?" . $params;

        // Отправляем запрос и формируем ответ
        // Тут предпочтительнее использовать httpClient от Paul, но он ещё не в стабильтной версии ( по причине не соотвествия с PSR ).
        $data = file_get_contents($link);
        if(json_decode($data)->status != self::STATUS_GOOGLE_OK){
            // Обрабатываем статус
        }

        // Не нашёл как в гугле ограничить максимум возвращаемых значений, поэтому ограничу здесь
        $i=0;
        $arr = [];
        foreach (json_decode($data)->predictions as $item) {
            $arr[] = [
                'value' => $item->description,
                'label' => $item->description
            ];
            // Искусственное ограничение на лимит, правильно было бы детальнее поискать в доках источника средств.
            $i++;
            if($i>=5){
                break;
            }
        }

        // Логируем запрос и ответ
        if(!AutocomleteAddressLogs::log($term, $link, $data)){
            // Действия при ошибки логирования от конкретного источника данных
        }

        return $arr;
    }
}