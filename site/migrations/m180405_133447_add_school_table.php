<?php

use yii\db\Migration;

/**
 * Class m180405_133447_add_school_table
 */
class m180405_133447_add_school_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //user
        $this->createTable('{{%school}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'info' => $this->string(),
            'address' => $this->string(),
            'lat' => $this->float(6)->defaultValue(0),
            'lng' => $this->float(6)->defaultValue(0)
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%school}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180405_133447_add_school_table cannot be reverted.\n";

        return false;
    }
    */
}
