<?php

namespace dmitrybukhonov\adyammy\backend\models;

use yii\data\ActiveDataProvider;
use dmitrybukhonov\adyammy\backend\models\AdBlock;

class AdBlockSearch extends AdBlock
{
    /**
     * @inheritDoc
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'string'],
            [['position_id', 'company_id', 'is_published'], 'integer']
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'name',
                    'position_id',
                    'company_id',
                    'is_published',
                ]
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'position_id' => $this->position_id,
            'company_id' => $this->company_id,
            'is_published' => $this->is_published,
        ]);

        $query->andFilterWhere(['LIKE', 'name', $this->name]);

        return $dataProvider;
    }
}
