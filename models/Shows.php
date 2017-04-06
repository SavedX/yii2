<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "shows".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $description
 */
class Shows extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shows';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'img', 'description'], 'required'],
            [['description'], 'string'],
            [['name', 'img'], 'string', 'max' => 255],
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
        return $this->hasOne(Events::className(), ['id' => 'show_id']);
    }

    public function upload()
    {

        if ($this->validate()) {

            $fileName = $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs('uploads/shows/' . $fileName);

            return true;
        } else {
            return false;
        }
    }

}