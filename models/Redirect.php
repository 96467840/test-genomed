<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redirects".
 *
 * @property int $id
 * @property string $created_at
 * @property string $remote_addr
 * @property int $url_id
 *
 * @property Url $url
 */
class Redirect extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'redirects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['remote_addr', 'url_id'], 'required'],
            [['url_id'], 'integer'],
            [['remote_addr'], 'string', 'max' => 1024],
            [['url_id'], 'exist', 'skipOnError' => true, 'targetClass' => Url::class, 'targetAttribute' => ['url_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'remote_addr' => 'Remote Addr',
            'url_id' => 'Url ID',
        ];
    }

    /**
     * Gets query for [[Url]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUrl()
    {
        return $this->hasOne(Url::class, ['id' => 'url_id']);
    }
}
