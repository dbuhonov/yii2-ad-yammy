<?php

namespace dmitrybukhonov\adyammy\common\models;

use yii\db\ActiveQuery;

final class AdBlockQuery extends ActiveQuery
{
    public function published(): AdBlockQuery
    {
        $this->andWhere(['is_published' => true]);

        return $this;
    }
}
