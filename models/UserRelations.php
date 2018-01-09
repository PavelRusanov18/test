<?php
namespace app\models;

/**
 * @property User $this
 * @property PartnerLink[] $links
 * @property User[] $referals
 * @property User $parentReferal
 */
trait UserRelations
{

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinks()
    {
        return $this->hasMany(PartnerLink::className(), ['user_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentReferal()
    {
        return $this->hasOne(User::className(), ['id' => 'ref_id']);
    }    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferals()
    {
        return $this->hasMany(User::className(), ['ref_id' => 'id']);
    }    
}
