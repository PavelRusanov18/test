<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partner_link".
 *
 * @property int $id
 * @property int $user_id
 * @property string $link
 *
 */
class PartnerLink extends \yii\db\ActiveRecord
{
    use PartnerLinkRelations;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'link'], 'required'],
            [['user_id'], 'integer'],
            [['link'], 'string', 'max' => 255],
            [['link'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'link' => 'Link',
        ];
    }

    /**
     * @inheritdoc
     * @return PartnerLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PartnerLinkQuery(get_called_class());
    }
}
