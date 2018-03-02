<?php

use yii\db\Migration;

/**
 * Handles the creation of table `package_detail`.
 */
class m180302_150402_create_package_detail_table extends Migration
{
    const TABLE = '{{%package_detail}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'pack_id' => $this->integer()->notNull(),
            'discount_code' => $this->string(),
            'created_at' => $this->integer()->unsigned(),
            'updated_at' => $this->integer()->unsigned(),
        ]);

        $this->createIndex('pack_id', self::TABLE, 'pack_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
