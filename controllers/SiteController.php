<?php

namespace app\controllers;

use app\models\Payment;
use app\models\search\PaymentSearch;
use yii\rest\ActiveController;
use Yii;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends ActiveController
{
    /** @var string */
    public $modelClass = Payment::class;

    /**
     * @return array[]
     */
    public function actions(): array
    {
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {
                    $searchModel = new PaymentSearch();

                    return $searchModel->search(Yii::$app->request->queryParams);
                },
            ],
        ];
    }
}
