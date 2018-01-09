<?php

use yii\db\Migration;

/**
 * Handles the creation of table `partner_link`.
 */
class m180109_154741_create_partner_link_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $table = "partner_link";

        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'link' => $this->string()->notNull()->unique(),
        ]);
        $this->addForeignKey("user_id", "{{%{$table}}}", "user_id", "{{%user}}", "id", 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('partner_link');
    }
}
