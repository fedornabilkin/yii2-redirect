<?php

namespace fedornabilkin\redirect\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "redirect_visits".
 *
 * @property int $id
 * @property int $redirect
 * @property string $ip
 * @property string $agent
 * @property string $country_code
 * @property string $referer
 * @property int $created_at
 *
 * @property Redirect $redirect0
 */
class RedirectVisits extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redirect_visits';
    }

    public function behaviors()
    {
        return array_merge_recursive(parent::behaviors(), [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],

        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['redirect', 'created_at'], 'integer'],
            [['agent', 'referrer'], 'string'],
            [['ip', 'country_code'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('redirect', 'ID'),
            'redirect' => Yii::t('redirect', 'Redirect'),
            'ip' => Yii::t('redirect', 'Ip'),
            'agent' => Yii::t('redirect', 'Agent'),
            'country_code' => Yii::t('redirect', 'Country Code'),
            'referrer' => Yii::t('redirect', 'Referrer'),
            'created_at' => Yii::t('redirect', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRedirect()
    {
        return $this->hasOne(Redirect::class, ['id' => 'redirect']);
    }
}
