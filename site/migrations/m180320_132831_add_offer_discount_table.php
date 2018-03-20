<?php

use yii\db\Migration;

/**
 * Class m180320_132831_add_offer_discount_table
 */
class m180320_132831_add_offer_discount_table extends Migration
{
    const TABLE = '{{%offer_discount}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'phone' => $this->string()->notNull(),
            'created_at' => $this->integer()->unsigned(),
            'updated_at' => $this->integer()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
