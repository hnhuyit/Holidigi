<?php

use yii\db\Migration;

/**
 * Handles the creation for table `comment`.
 */
class m160725_055329_create_comment extends Migration
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
        $this->createTable('comment', [
            'id'            => $this->primaryKey(),
            'content'       => $this->string()->notNull(),
            'user_by'       => $this->integer()->notNull(),
            'task_id'       => $this->integer()->notNull(),
            
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ], $tableOptions);
        
        // creates index for column `user_by`
        $this->createIndex(
            'idx-comment-user_by',
            'comment',
            'user_by'
        );
        
        // add foreign key for table `comment`
//        $this->addForeignKey(
//            'fk-comment-create_by',
//            'comment',
//            'create_by',
//            'user',
//            'id',
//            'CASCADE'
//        );
        
        // creates index for column `task_id`
        $this->createIndex(
            'idx-comment-task_id',
            'comment',
            'task_id'
        );
        
        // add foreign key for table `comment`
//        $this->addForeignKey(
//            'fk-comment-task_id',
//            'comment',
//            'task_id',
//            'task',
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
            'idx-comment-user_by',
            'comment'
        );
        // drops index for column `website_id`
        $this->dropIndex(
            'idx-comment-task_id',
            'comment'
        );
        $this->dropTable('comment');
    }
}
