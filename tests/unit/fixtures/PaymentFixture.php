<?php

namespace app\tests\unit\fixtures;

use app\models\Payment;
use yii\test\ActiveFixture;

/**
 * Class PaymentFixture
 * @package app\tests\unit\fixtures
 */
class PaymentFixture extends ActiveFixture
{
    public $modelClass = Payment::class;
}