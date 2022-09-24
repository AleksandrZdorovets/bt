<?php

use yii\db\Migration;

/**
 * Class m220919_075915_create_payments
 */
class m220919_075915_create_payments extends Migration
{
    /** @var string */
    private const TABLE_NAME = 'payments';

    /** @var string */
    private const TABLE_NAME_LOCALIZATION = 'payment_localizations';

    /** @var array */
    private const DATA_SEEDS = array(
        [
            'name' => [
                'uk' => 'Гаманець Litnet',
                'ru' => 'Кошелек Litnet'
            ],
            'commission' => 0,
            'image_url' => 'litnet_wallet.jpg',
            'pay_url' => '/pay/wallet'
        ],
        [
            'name' => [
                'uk' => 'Карта Visa / MasterCard',
                'ru' => 'Карты Visa / MasterCard'
            ],
            'commission' => 2.5,
            'image_url' => 'connectum_cards.jpg',
            'pay_url' => '/pay/123'
        ],
        [
            'name' => [
                'uk' => 'Карта Приват Банку',
                'ru' => 'Карты Приватбанк'
            ],
            'commission' => 2.5,
            'image_url' => 'connectum_cards.jpg',
            'pay_url' => '/pay/123'
        ],
        [
            'name' => [
                'uk' => 'Термінал IBOX',
                'ru' => 'Терминалы IBOX'
            ],
            'commission' => 5,
            'image_url' => 'wayforpay_terminal.jpg',
            'pay_url' => '/pay/456'
        ]
    );

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'commission' => $this->decimal(5, 2)->defaultValue(0),
            'image_url' => $this->string(),
            'pay_url' => $this->string(),
        ]);

        $this->createTable(self::TABLE_NAME_LOCALIZATION, [
            'id' => $this->primaryKey(),
            'payment_id' => $this->integer()->notNull(),
            'locale' => $this->char(2),
            'name' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-paymentId',
            self::TABLE_NAME_LOCALIZATION,
            'payment_id',
            self::TABLE_NAME,
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        foreach (self::DATA_SEEDS as $data)
        {
            $this->insert(self::TABLE_NAME, [
                'commission' => $data['commission'],
                'image_url' => $data['image_url'],
                'pay_url' => $data['pay_url']
            ]);

            $id = Yii::$app->db->getLastInsertID();

            foreach ($data['name'] as $key => $val) {
                $this->insert(self::TABLE_NAME_LOCALIZATION, [
                    'payment_id' => $id,
                    'locale' => $key,
                    'name' => $val
                ]);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME_LOCALIZATION);
        $this->dropTable(self::TABLE_NAME);
    }
}
