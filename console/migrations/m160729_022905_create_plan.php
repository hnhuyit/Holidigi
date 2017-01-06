<?php

use yii\db\Migration;

/**
 * Handles the creation for table `plan`.
 */
class m160729_022905_create_plan extends Migration
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
        $this->createTable('plan', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'cost' => $this->string(),
            'hour' => $this->string(),
            'agency_id'     => $this->integer(),
            'create_by'     => $this->integer()->notNull(),
            
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
            
        ], $tableOptions);
        
        // creates index for column `create_by`
        $this->createIndex(
            'idx-plan-create_by',
            'plan',
            'create_by'
        );
        
        // add foreign key for table `user`
//        $this->addForeignKey(
//            'fk-plan-create_by',
//            'plan',
//            'create_by',
//            'user',
//            'id',
//            'CASCADE'
//        );
//        
        // creates index for column `agency_id`
        $this->createIndex(
            'idx-plan-agency_id',
            'plan',
            'agency_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops index for column `create_by`
        $this->dropIndex(
            'idx-plan-create_by',
            'plan'
        );
        $this->dropTable('plan');
    }
}
