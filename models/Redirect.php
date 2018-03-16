<?php

namespace fedornabilkin\redirect\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "redirect".
 *
 * @property int $id
 * @property string $from
 * @property string $to
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
            [['from'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['from', 'to'], 'string', 'max' => 255],
            [['from'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
