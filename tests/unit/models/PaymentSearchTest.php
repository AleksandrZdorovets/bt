<?php

namespace tests\unit\models;

use app\models\PaymentSearch;

/**
 * Class PaymentTest
 * @package app\tests\unit\models
 */
class PaymentSearchTest extends \Codeception\Test\Unit
{
    /**
     * @return void
     */
    public function testSearch(): void
    {
        $payments = $this->getMockBuilder(\app\models\search\PaymentSearch::class)
            ->setMethods(['search'])
            ->getMock();
        verify(is_array($payments->search([])->getModels()));
        verify($payments->search([])->getModels())->empty();
    }
}