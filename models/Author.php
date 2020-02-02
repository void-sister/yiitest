<?php

namespace app\models;

use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    public static function tableName()
    {
        return 'author';
    }

    public function rules()
    {
        return [
            [['name'], 'required', 'message'=>'Please fill {attribute}.']
        ];
    }

    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])
            ->viaTable('m2m_books_authors', ['author_id' => 'id']);
    }
}