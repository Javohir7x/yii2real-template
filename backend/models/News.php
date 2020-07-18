<?php

namespace backend\models;

use Yii;
/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $language
 * @property string $created_date
 * @property string|null $image
 * @property int|null $tags
 * @property int $user_id
 * @property int $views
 * @property int $status
 * @property int|null $category_id
 * @property int|null $priority
 * @property Categories $category
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'language', 'user_id'], 'required'],
            [['title', 'content'], 'string'],
            [['created_date','tags'], 'safe'],
            [['user_id', 'views', 'status', 'category_id', 'priority'], 'integer'],
            [['language'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['image'], 'file',  'extensions' => ['png', 'jpg','jpeg','bmp'], 'checkExtensionByMimeType'=>true,'maxSize'=>1024*1024*8],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'language' => 'Language',
            'created_date' => 'Created Date',
            'image' => 'Image',
            'tags' => 'Tags',
            'user_id' => 'User ID',
            'views' => 'Views',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'priority' => 'Priority',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoriesQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }



    /**
     * {@inheritdoc}
     * @return \backend\models\query\NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\NewsQuery(get_called_class());
    }


    public function upload()
    {
        if ($this->validate(false)) {
            $this->image->saveAs('../../frontend/web/uploads/' . md5($this->image->baseName) . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}
