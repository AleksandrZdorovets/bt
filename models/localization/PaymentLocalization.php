<?php

namespace app\models\localization;

use yii\db\ActiveRecord;

/**
 * Class PaymentLocalization
 * @package app\models\localization
 */
class PaymentLocalization extends ActiveRecord
{
    /** @var string */
    public const DEFAULT_LANGUAGE = 'uk';

    /**
     * @return string.
     */
    public static function tableName(): string
    {
        return '{{payment_localizations}}';
    }
}
