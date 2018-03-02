<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180302_093214_create_user_table extends Migration
{
    const TABLE = '{{%user}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string(),
            'auth_key' => $this->string(32),
            'password_reset_token' => $this->string(),
        ]);

        $this->createIndex('password_reset_token',self::TABLE, 'password_reset_token');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
