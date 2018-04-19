<?php

use yii\db\Migration;

/**
 * Class m180419_112334_add_button_package
 */
class m180419_112334_add_button_package extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%package}}', 'hide_button', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%package}}', 'hide_button');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180419_112334_add_button_package cannot be reverted.\n";

        return false;
    }
    */
}
