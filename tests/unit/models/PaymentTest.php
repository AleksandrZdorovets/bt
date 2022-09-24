<?php

namespace tests\unit\models;

use app\models\Payment;

/**
 * Class PaymentTest
 * @package app\tests\unit\models
 */
class PaymentTest extends \Codeception\Test\Unit
{
    /**
     * @return void
     */
    public function testFindPaymentById()
    {
        verify($payment = Payment::findOne(1))->notEmpty();
        verify($payment->commission)->equals(0);
        verify(Payment::findOne(10))->empty();
    }
}