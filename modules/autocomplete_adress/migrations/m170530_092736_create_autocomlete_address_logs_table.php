<?php

use yii\db\Migration;

/**
 * Handles the creation of table `autocomlete_address_logs`.
 */
class m170530_092736_create_autocomlete_address_logs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('autocomlete_address_logs', [
            'id' => $this->primaryKey(),
            'term' => $this->string(256),
            'request' => $this->text(),
            'response' => $this->text(),
            'created_at' => $this->timestamp(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('autocomlete_address_logs');
    }
}
