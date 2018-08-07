<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test_drive`.
 */
class m180807_145332_create_test_drive_table extends Migration
{
    const TABLE = '{{%test_drive}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'mobile' => $this->string()->notNull(),
            'month' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
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
