<?php

use yii\db\Migration;

/**
 * Handles the creation of table `redirect_visits`.
 */
class m180404_202038_create_redirect_visits_table extends Migration
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
        $this->createTable('{{%redirect_visits}}', [
            'id' => $this->primaryKey()->unsigned(),
            'redirect' => $this->integer(11),
            'ip' => $this->char(15)->notNull(),
            'agent' => $this->text(),
            'country_code' => $this->char(15),
            'referrer' => $this->text(),
            'created_at' => $this->integer(11)->unsigned()
        ], $tableOptions);

        $this->createIndex('{{%idx-redirect_visits-redirect}}','{{%redirect_visits}}', 'redirect');

        $this->addForeignKey('{{%fki-redirect_visits-redirect-redirect-id}}',
            '{{%redirect_visits}}',
            'redirect',
            '{{%redirect}}',
            'id',
            'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fki-redirect_visits-redirect-redirect-id}}', '{{%redirect_visits}}');

        $this->dropIndex('{{%idx-redirect_visits-redirect}}','{{%redirect_visits}}');

        $this->dropTable('{{%redirect_visits}}');
    }
}
