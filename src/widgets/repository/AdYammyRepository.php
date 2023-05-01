<?php

namespace dmitrybukhonov\adyammy\widgets\repository;

use dmitrybukhonov\adyammy\common\models\AdBlock;
use dmitrybukhonov\adyammy\common\models\AdBlockQuery;

class AdYammyRepository
{
    public function getAdByPositionQuery(int $positionId): AdBlockQuery
    {
        $query = AdBlock::find();

        $query->andWhere(['position_id' => $positionId]);
        $query->published();

        return $query;
    }
}
