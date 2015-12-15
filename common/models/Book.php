<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression as DbExpression;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 *
 * @property Authors $author
 */
class Book extends \yii\db\ActiveRecord
{
    const PREVIEW_PATH = '@webroot/images/preview';
    const PREVIEW_URL = '@web/images/preview';


    /** @var \yii\web\UploadedFile */
    public $preview_file;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['author_id'], 'integer'],
            [['date'], 'safe'],
            [['preview'], 'string', 'max' => 300],
            [['preview_file'], 'file',
                'maxSize' => 10 * 1024 * 1024,
                'extensions' => ['png', 'jpg', 'gif'],
                'mimeTypes' => ['image/png', 'image/jpeg', 'image/gif'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'value' => new DbExpression('NOW()'),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
            'preview' => Yii::t('app', 'Preview'),
            'date' => Yii::t('app', 'Book release date'),
            'author_id' => Yii::t('app', 'Author'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    public function getPreviewPath()
    {
        return Yii::getAlias(self::PREVIEW_PATH) . '/' . $this->preview;
    }

    public function getPreviewUrl()
    {
        return Yii::getAlias(self::PREVIEW_URL) . '/' .$this->preview;
    }

    /**
     * Tries to save preview file before save
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if (!$this->preview_file) {
            return true;
        }

        if ($this->preview) {
            unlink($this->getPreviewPath());
        }

        $randomName = uniqid();
        $dir = substr($randomName, strlen($randomName) - 1, 1);
        $this->preview = $dir . '/' . $randomName . '.' . $this->preview_file->extension;

        $previewPath = $this->getPreviewPath();
        FileHelper::createDirectory(dirname($previewPath));
        $res = $this->preview_file->saveAs($previewPath);

        if (!$res) {
            $this->addError('preview_file', Yii::t('app', 'Cannot save file'));
            return false;
        }

        return true;
    }

    public function afterDelete()
    {
        if ($this->preview) {
            unlink($this->getPreviewPath());
        }
    }
}

