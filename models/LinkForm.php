<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Link form
 */
class LinkForm extends Model
{

    public $link;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['link', 'trim'],
            ['link', 'required'],
            ['link', 'unique', 'targetClass' => '\app\models\PartnerLink', 'message' => 'This link has already been taken.'],
            ['link', 'string', 'min' => 2, 'max' => 255],
        ];
    }

    /**
     * generateLink
     *
     * @return PartnerLink|null the saved model or null if saving fails
     */
    public function generateLink()
    {

        if (!$this->validate()) {
            return null;
        }

        $partnerLink = new PartnerLink();
        $partnerLink->link = $this->link;
        $partnerLink->user_id = \Yii::$app->user->id;
        return $partnerLink->save() ? $partnerLink : null;
    }

}
