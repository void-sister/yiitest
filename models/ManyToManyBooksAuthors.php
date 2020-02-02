<?php

namespace app\models;

use yii\db\ActiveRecord;

class ManyToManyBooksAuthors extends ActiveRecord
{
    public static function tableName()
    {
        return 'm2m_books_authors';
    }



}