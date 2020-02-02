<?php

use yii\db\Migration;
use \yii\db\Schema;

/**
 * Handles the creation of table `{{%m2m_books_authors}}`.
 */
class m200201_232026_create_m2m_books_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('m2m_books_authors', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('books_book_id',    'm2m_books_authors',  'book_id',   'book',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('authors_author_id',    'm2m_books_authors',  'author_id',   'author',  'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('m2m_books_authors');
    }
}
