<?php

use yii\db\Migration;

/**
 * Handles the creation for table `time`.
 */
class m160725_055339_create_time extends Migration
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
        
        $this->createTable('time', [
            'id' => $this->primaryKey(),
            'hour'       => $this->float()->notNull(),
            'reason'       => $this->string()->notNull(),
            'user_by'     => $this->integer()->notNull(),
            'task_id'       => $this->integer()->notNull(),
            
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ], $tableOptions);
        
        // creates index for column `user_by`
        $this->createIndex(
            'idx-time-user_by',
            'time',
            'user_by'
        );
        
        // add foreign key for table `time`
//        $this->addForeignKey(
//            'fk-time-create_by',
//            'time',
//            'create_by',
//            'user',
//            'id',
//            'CASCADE'
//        );
        
        // creates index for column `task_id`
        $this->createIndex(
            'idx-time-task_id',
            'time',
            'task_id'
        );
        
        // add foreign key for table `time`
//        $this->addForeignKey(
//            'fk-time-task_id',
//            'time',
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
            'idx-time-user_by',
            'time'
        );
        // drops index for column `task_id`
        $this->dropIndex(
            'idx-time-task_id',
            'time'
        );
        $this->dropTable('time');
    }
}
