<?php

use yii\db\Migration;

/**
 * Handles the creation of table `events`.
 */
class m170406_000702_create_events_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('events', [
            'id' => $this->primaryKey(),
            'date' => $this->dateTime()->notNull(),
            'show_id' => $this->integer(10),
            'area_id' => $this->integer(10),
        ]);

        for ($i=1;$i<=10;$i++) {
            $this->insert('events', [
                'date' => '2017-04-07 00:00:0' . $i,
                'show_id' => $i,
                'area_id' => $i
            ]);
        };
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('events');
    }
}
