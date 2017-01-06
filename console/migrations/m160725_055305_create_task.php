<?php

use yii\db\Migration;

/**
 * Handles the creation for table `task`.
 */
class m160725_055305_create_task extends Migration
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
        $this->createTable('task', [
            'id'            => $this->primaryKey(),
            'title'          => $this->string()->notNull(),
            'des'           => $this->text(),
            'create_by'     => $this->integer()->notNull(),
            'status'        => $this->smallInteger()->notNull()->defaultValue(1),
            'website_id'    => $this->integer()->notNull(),
//            'site_owner_id' => $this->integer()->notNull(),
            'user_id'       => $this->integer()->notNull(),
            'comment'       => $this->integer()->notNull()->defaultValue(0),
            
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ], $tableOptions);
        
        // creates index for column `create_by`
        $this->createIndex(
            'idx-task-create_by',
            'task',
            'create_by'
        );
        
        // add foreign key for table `task`
//        $this->addForeignKey(
//            'fk-task-create_by',
//            'task',
//            'create_by',
//            'user',
//            'id',
//            'CASCADE'
//        );
        
        // creates index for column `website_id`
        $this->createIndex(
            'idx-task-website_id',
            'task',
            'website_id'
        );
        
        // add foreign key for table `task`
//        $this->addForeignKey(
//            'fk-task-website_id',
//            'task',
//            'website_id',
//            'website',
//            'id',
//            'CASCADE'
//        );
        
//        // creates index for column `site_owner_id`
//        $this->createIndex(
//            'idx-task-site_owner_id',
//            'task',
//            'site_owner_id'
//        );
//        
//        // add foreign key for table `task`
//        $this->addForeignKey(
//            'fk-task-site_owner_id',
//            'task',
//            'site_owner_id',
//            'site_owner',
//            'id',
//            'CASCADE'
//        );
        
         // creates index for column `user_id`
        $this->createIndex(
            'idx-task-user_id',
            'task',
            'user_id'
        );
        
        // add foreign key for table `task`
//        $this->addForeignKey(
//            'fk-task-user_id',
//            'task',
//            'user_id',
//            'user',
//            'id',
//            'CASCADE'
//        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops index for column `create_by`
        $this->dropIndex(
            'idx-task-create_by',
            'task'
        );
        // drops index for column `website_id`
        $this->dropIndex(
            'idx-task-website_id',
            'task'
        );
//        // drops index for column `site_owner_id`
//        $this->dropIndex(
//            'idx-task-site_owner_id',
//            'task'
//        );
        
        $this->dropIndex(
            'idx-task-user_id',
            'task'
        );
        $this->dropTable('task');
    }
}
