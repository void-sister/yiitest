<?php

namespace app\models;

use app\models\ManyToManyBooksAuthors;
use yii\db\ActiveRecord;
use app\models\Author;
use yii\helpers\ArrayHelper;

class Book extends ActiveRecord
{
    public $authorIds = [];

    public static function tableName()
    {
        return 'book';
    }

    public function rules()
    {
        return [
            [['title', 'isbn'], 'required', 'message'=>'Please fill {attribute}.'],
            [['year', 'pages'], 'integer']
        ];
    }

    public function getAuthors()
    {
        $authors = $this->hasMany(Author::className(), ['id' => 'author_id'])
            ->viaTable('m2m_books_authors', ['book_id' => 'id']);
        return $authors;
    }

    public function getdropAuthor()
    {
        $data = Author::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

    public function getAuthorIds()
    {
        $this->authorIds = ArrayHelper::getColumn(
            $this->getAuthors()->asArray()->all(),
            'id'
        );
        return $this->authorIds;
    }

    public function updateBooksAuthors($book_id, $authorIds = [])
    {
        ManyToManyBooksAuthors::deleteAll('book_id = :bookId', [':bookId' => $book_id]);

        if ( ! is_array($authorIds))
            return ;

        foreach ($authorIds as $authorId)
        {
            $r = new ManyToManyBooksAuthors();
            $r->book_id = $book_id;
            $r->author_id = $authorId;
            $r->save();
        }

    }
}

