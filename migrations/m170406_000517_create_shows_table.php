<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shows`.
 */
class m170406_000517_create_shows_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('shows', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            'img' => $this->string(256),
            'description' => $this->text()->notNull(),
        ]);

        for ($i=1;$i<=10;$i++) {
            $this->insert('shows', [
                'name' => 'Show ' . $i,
                'img' => 'shows/' . $i . '.jpg',
                'description' => 'Description of Show ' . $i
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('shows');
    }
}
