<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;

/**
 * BookSearch represents the model behind the search form about `common\models\Book`.
 */
class BookSearch extends Book
{
    public $date_from;
    public $date_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [['name', 'date_from', 'date_to', 'author_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Book::find();
        $query->joinWith(['author']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['date_create' => SORT_DESC],
            ],
        ]);

        unset($dataProvider->sort->attributes['preview']);
        $dataProvider->sort->attributes['author.name'] = [
            'asc' => ['authors.firstname' => SORT_ASC, 'authors.lastname' => SORT_ASC],
            'desc' => ['authors.firstname' => SORT_DESC, 'authors.lastname' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['author_id' => $this->author_id]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['between', 'date', $this->date_from, $this->date_to]);


        return $dataProvider;
    }

    public function isOpen()
    {
        return ($this->author_id || $this->name || $this->date_from || $this->date_to);
    }
}
