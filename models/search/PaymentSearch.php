<?php

namespace app\models\search;

use app\models\localization\PaymentLocalization;
use yii\base\Model;
use app\models\Payment;
use yii\data\ActiveDataProvider;

/**
 * Class PaymentSearch
 * @package app\models\search
 */
class PaymentSearch extends Model
{
    /** @var int */
    public $id;

    /** @var double */
    public $commission;

    /** @var string */
    public string $lang = PaymentLocalization::DEFAULT_LANGUAGE;

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            ['id', 'integer'],
            ['commission', 'double'],
            ['lang', 'string'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = array()): ActiveDataProvider
    {
        $this->attributes = $params;

        $query = Payment::find()->with([
            'locale' => function ($query) {
                $query->andWhere(['locale' => $this->lang]);
            },
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'commission' => $this->commission,
        ]);

        return $dataProvider;
    }
}