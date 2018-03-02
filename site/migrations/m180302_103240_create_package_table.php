<?php

use yii\db\Migration;

/**
 * Handles the creation of table `package`.
 */
class m180302_103240_create_package_table extends Migration
{
    const TABLE = '{{%package}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'price' => $this->double()->defaultValue(0),
            'image' => $this->string(),
            'section' => $this->smallInteger()->notNull(),
            'sort_index' => $this->integer()->notNull()->defaultValue(0),
            'start_date' => $this->integer()->unsigned()->defaultValue(0),
            'required_test_lesson' => $this->boolean()->defaultValue(false),
        ]);

        $this->createIndex('section', self::TABLE, 'section');
        $this->createIndex('sort_index', self::TABLE, 'sort_index');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
