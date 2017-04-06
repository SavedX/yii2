<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property integer $id
 * @property string $date
 * @property integer $show_id
 * @property integer $area_id
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'show_id', 'area_id'], 'required'],
            [['date'], 'safe'],
            [['show_id', 'area_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'show_id' => 'Show ID',
            'area_id' => 'Area ID',
        ];
    }

    public function getArea()
    {
        return $this->hasOne(Areas::className(), ['area_id' => 'id']);
    }

    public function getShow()
    {
        return $this->hasOne(Shows::className(), ['id' => 'show_id']);
    }
}
