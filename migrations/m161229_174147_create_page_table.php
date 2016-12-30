<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m161229_174147_create_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'metakey' => $this->string(100)->null(),
            'metadesc' => $this->string(255)->null(),
            'category' => $this->string('10')->comment('full|partial|event')->defaultValue('full'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->datetime()->null(),
            'updated_at' => $this->datetime()->null(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('page');
    }
}
