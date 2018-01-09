<?php
namespace app\models;

/**
 * @property User $user
 */
trait PartnerLinkRelations
{

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

?>