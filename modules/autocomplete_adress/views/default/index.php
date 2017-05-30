<?php
use yii\jui\AutoComplete;
use yii\helpers\Url;
?>

<div class="autocomplete_adress-default-index">
    <?=AutoComplete::widget([
        'name'=>'address_field',
        'clientOptions' => [
            'source' => Url::to(['/autocomplete_adress/geo/google']),
            'minLength'=>'3',
        ],
        'options'=>[
            'class' => 'form-control'
        ]
    ]);?>
</div>
