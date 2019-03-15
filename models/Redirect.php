<?php

namespace fedornabilkin\redirect\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "redirect".
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property string $status_code
 * @property int $created_at
 * @property int $updated_at
 */
class Redirect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redirect';
    }

    public function behaviors()
    {
        return array_merge_recursive(parent::behaviors(), [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],

        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'to', 'status_code'], 'trim'],
            [['from'], 'required'],
            [['from'], function($attribute){
                $find = self::findOne(['to' => $this->from]);
                if($find){
                    $this->addError($attribute, Yii::t('redirect', "Invalid address."));
                }
            }],
            [['to'], function($attribute){
                $find = self::findOne(['from' => $this->to]);
                if($find or $this->to == $this->from){
                    $this->addError($attribute, Yii::t('redirect', "You can't send to this address."));
                }
            }],
            [['created_at', 'updated_at'], 'integer'],
            [['from', 'to'], 'string', 'max' => 255],
            [['status_code'], 'integer', 'max' => 999],
            [['status_code'], 'default', 'value' => 301],
            [['from'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_code' => Yii::t('redirect', 'Status code'),
            'visited' => Yii::t('redirect', 'Visited'),
            'from' => Yii::t('redirect', 'From'),
            'to' => Yii::t('redirect', 'To'),
            'created_at' => Yii::t('redirect', 'Created At'),
            'updated_at' => Yii::t('redirect', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisits()
    {
        return $this->hasMany(RedirectVisits::class, ['redirect' => 'id']);
    }
}
