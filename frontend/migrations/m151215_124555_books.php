<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_124555_books extends Migration
{
    public function up()
    {
        $this->execute("
            CREATE TABLE `session` (
                `id` CHAR(40) NOT NULL,
                `expire` INT(11) NULL DEFAULT NULL,
                `data` BLOB NULL,
                PRIMARY KEY (`id`)
            )
        ");


        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(100)->notNull(),
            'lastname' => $this->string(100)->notNull(),
        ]);

        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'date_create' => $this->dateTime()->notNull(),
            'date_update' => $this->dateTime()->notNull(),
            'preview' => $this->string(300),
            'date' => $this->dateTime(),
            'author_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_books_authors', 'books', 'author_id', 'authors', 'id', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        $this->dropTable('books');
        $this->dropTable('authors');
        $this->dropTable('session');
    }
}
