<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "areas".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $description
 */
class Areas extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'img', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['img'], 'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'img' => 'Image',
            'description' => 'Description',
        ];
    }

    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['id' => 'area_id']);
    }

    public function upload()
    {
        if ($this->validate(['image'])) {

            $fileName = $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs('uploads/areas/' . $fileName);

            return true;
        } else {
            return false;
        }
    }

}
