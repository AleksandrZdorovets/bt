<?php

namespace app\models;

use app\models\localization\{PaymentLocalization, LocalizationModel};
use yii\db\ActiveRecord;

/**
 * Class Payment
 * @package app\models
 */
class Payment extends LocalizationModel
{
    /** @var string */
    protected string $localeModel = PaymentLocalization::class;

    /**
     * @return string.
     */
    public static function tableName(): string
    {
        return '{{payments}}';
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id',
            'commission',
            'payUrl' => 'pay_url',
            'imageUrl' => 'image_url',
            'name' => function ($model) {
                return $model->locale->name ?? '';
            },
        ];
    }
}
