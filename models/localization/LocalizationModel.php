<?php

namespace app\models\localization;

use yii\db\ActiveRecord;

/**
 * Class LocalizationModel
 * @package app\models\localization
 */
class LocalizationModel extends ActiveRecord
{
    /** @var string */
    protected string $localeModel = ActiveRecord::class;

    /**
     * @return mixed
     */
    public function getLocales()
    {
        return $this->hasMany($this->localeModel, ['payment_id' => 'id']);
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->hasOne($this->localeModel, ['payment_id' => 'id']);
    }
}
