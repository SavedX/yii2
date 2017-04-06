<?php

use yii\db\Migration;

/**
 * Handles the creation of table `areas`.
 */
class m170406_000504_create_areas_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('areas', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            'img' => $this->string(256),
            'description' => $this->text()->notNull(),
        ]);

        for ($i=1;$i<=10;$i++) {
            $this->insert('areas', [
                'name' => 'Area ' . $i,
                'img' => 'areas/' .$i .'.jpg',
                'description' => 'Description of Area ' .$i
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('areas');
    }
}
