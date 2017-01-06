<?php

use yii\db\Migration;

/**
 * Handles the creation for table `agency`.
 */
class m160725_053154_create_agency extends Migration
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
        $this->createTable('agency', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string()->notNull(),
            'des'           => $this->text(),
            'create_by'     => $this->integer()->notNull(),
            'status'        => $this->smallInteger()->defaultValue(1),
            'avatar'        => $this->string(),
            'token'         => $this->string()->notNull(),
            'website_id'    => $this->integer()->notNull(),
            'plan_id'       => $this->integer()->notNull(),
//            'bill_id'       => $this->integer()->notNull(),
            
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
            
        ], $tableOptions);
        
        // creates index for column `create_by`
        $this->createIndex(
            'idx-agency-create_by',
            'agency',
            'create_by'
        );
        
//        // add foreign key for table `agency`
//        $this->addForeignKey(
//            'fk-agency-create_by',
//            'agency',
//            'create_by',
//            'user',
//            'id',
//            'CASCADE'
//        );
//        
//        // creates index for column `website_id`
//        $this->createIndex(
//            'idx-agency-website_id',
//            'agency',
//            'website_id'
//        );
        
       // creates index for column `bill_id`
       $this->createIndex(
           'idx-agency-bill_id',
           'agency',
           'bill_id'
       );
       
       // creates index for column `plan_id`
       $this->createIndex(
           'idx-agency-plan_id',
           'agency',
           'plan_id'
       );
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops index for column `create_by`
        $this->dropIndex(
            'idx-agency-create_by',
            'agency'
        );
        
//        // drops index for column `website_id`
//        $this->dropIndex(
//            'idx-agency-website_id',
//            'agency'
//        );
//        
       // drops index for column `bill_id`
       $this->dropIndex(
           'idx-agency-bill_id',
           'agency'
       );
       
       // drops index for column `plan_id`
       $this->dropIndex(
           'idx-agency-plan_id',
           'agency'
       );
        $this->dropTable('agency');
    }
}
