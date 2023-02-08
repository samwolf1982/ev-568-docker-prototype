<?php

use Phinx\Migration\AbstractMigration;

class Post extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
//    public function change()
//    {
//        // create the table
//        $this->table('posts')
//            ->addColumn('date', 'datetime')
//            ->addColumn('title', 'string')
//            ->addColumn('content', 'text')
//            ->create();
//    }

    public function up(){
        $this->table('posts')
            ->addColumn('date', 'datetime')
            ->addColumn('title', 'string')
            ->addColumn('content', 'text')
            ->create();
    }

    public function down(){
        $this->dropTable('posts');

    }



}
