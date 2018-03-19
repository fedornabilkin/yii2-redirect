<?php

use yii\db\Migration;

/**
 * Handles the creation of table `redirect`.
 */
class m180316_063454_create_redirect_table extends Migration
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

        $this->createTable('{{%redirect}}', [
            'id' => $this->primaryKey(),
            'from' => $this->char(255)->notNull()->unique(),
            'to' => $this->char(255),
            'visited' => $this->integer(11)->notNull()->defaultValue(1)->unsigned(),
            'status_code' => $this->integer(3)->notNull()->defaultValue(301)->unsigned(),
            'created_at' => $this->integer(11)->unsigned(),
            'updated_at' => $this->integer(11)->unsigned()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%redirect}}');
    }
}
