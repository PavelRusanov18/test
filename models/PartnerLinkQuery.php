<?php
namespace app\models;

/**
 * This is the ActiveQuery class for [[PartnerLink]].
 *
 * @see PartnerLink
 */
class PartnerLinkQuery extends \yii\db\ActiveQuery
{

    public function byUserId($user_id)
    {
        return $this->andWhere(['user_id' => $user_id]);
    }

    /**
     * @inheritdoc
     * @return PartnerLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PartnerLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
