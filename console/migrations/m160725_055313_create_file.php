<?php

use yii\db\Migration;

/**
 * Handles the creation for table `file`.
 */
class m160725_055313_create_file extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'file'       => $this->string()->notNull(),
            'user_by'     => $this->integer()->notNull(),
            'comment_id'       => $this->integer()->notNull(),
            
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ], $tableOptions);
        
        // creates index for column `user_by`
        $this->createIndex(
            'idx-file-user_by',
            'file',
            'user_by'
        );
        
        // add foreign key for table `file`
//        $this->addForeignKey(
//            'fk-file-create_by',
//            'file',
//            'create_by',
//            'user',
//            'id',
//            'CASCADE'
//        );
        
        // creates index for column `comment_id`
        $this->createIndex(
            'idx-file-comment_id',
            'file',
            'comment_id'
        );
        
        // add foreign key for table `file`
//        $this->addForeignKey(
//            'fk-file-comment_id',
//            'file',
//            'comment_id',
//            'comment',
//            'id',
//            'CASCADE'
//        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops index for column `user_by`
        $this->dropIndex(
            'idx-file-user_by',
            'file'
        );
        // drops index for column `comment_id`
        $this->dropIndex(
            'idx-file-comment_id',
            'file'
        );
        $this->dropTable('file');
    }
}
