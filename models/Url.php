<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "urls".
 *
 * @property int $id
 * @property string $url
 * @property string $short_url
 * @property int $redirect_count количество переходов
 *
 * @property Redirects[] $redirects
 */
class Url extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'urls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'short_url'], 'required'],
            [['redirect_count'], 'integer'],
            [['url'], 'string', 'max' => 1024],
            [['short_url'], 'string', 'max' => 255],
            [['short_url'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'short_url' => 'Short Url',
            'redirect_count' => 'количество переходов',
        ];
    }

    /**
     * Gets query for [[Redirects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRedirects()
    {
        return $this->hasMany(Redirects::class, ['url_id' => 'id']);
    }
}
