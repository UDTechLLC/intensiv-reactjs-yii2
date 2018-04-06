<?php

use yii\db\Migration;

/**
 * Class m180406_130555_add_contact_header_form
 */
class m180406_130555_add_contact_header_form extends Migration
{

    const TABLE = '{{%header_form}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'place' => $this->string(),
            'packet' => $this->string(),
            'license' => $this->string(),
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180406_130555_add_contact_header_form cannot be reverted.\n";

        return false;
    }
    */
}
