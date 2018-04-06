<?php

use yii\db\Migration;

/**
 * Class m180406_114233_add_column_sale_packet
 */
class m180406_114233_add_column_sale_packet extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%package}}', 'sale_price', $this->double()->defaultValue(0));
        $this->addColumn('{{%package}}', 'sale_percent', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%package}}', 'sale_price');
        $this->dropColumn('{{%package}}', 'sale_percent');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180406_114233_add_column_sale_packet cannot be reverted.\n";

        return false;
    }
    */
}
