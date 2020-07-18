<?php

namespace backend\models;

use Yii;


/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $language
 * @property string $created_date
 * @property int|null $user_id
 *
 * @property News[] $news
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'string'],
            [['created_date'], 'safe'],
            [['user_id'], 'integer'],
            [['language'], 'string', 'max' => 10],
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
            'description' => 'Description',
            'language' => 'Language',
            'created_date' => 'Created Date',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\query\NewsQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\query\CategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\CategoriesQuery(get_called_class());
    }
}
