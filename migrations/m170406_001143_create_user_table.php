<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170406_001143_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(256)->notNull(),
            'password' => $this->string(256)->notNull(),
            'auth_key' => $this->string(256)->notNull(),
            'access_token' => $this->string(256)->notNull(),
        ]);

        $this->insert('user', [
            'username' => 'admin ',
            'password' => '21232f297a57a5a743894a0e4a801fc3',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
