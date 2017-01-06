<?php

use yii\db\Migration;

/**
 * Handles the creation for table `site_owner`.
 */
class m160725_055236_create_site_owner extends Migration
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
        
        $this->createTable('site_owner', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string()->notNull(),
            'des'           => $this->text(),
            'avatar'        => $this->string(),
            'create_by'     => $this->integer()->notNull(),
            'status'        => $this->smallInteger()->notNull()->defaultValue(1),
            'website'       => $this->string()->notNull(),
            'agency_id'     => $this->integer()->notNull(),
            'plan_id'       => $this->integer()->notNull(),
            'bill_id'       => $this->integer()->notNull(),
            
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
                
        ], $tableOptions);
        
        // creates index for column `create_by`
        $this->createIndex(
            'idx-site_owner-create_by',
            'site_owner',
            'create_by'
        );
        
        // add foreign key for table `site_owner`
//        $this->addForeignKey(
//            'fk-site_owner-create_by',
//            'site_owner',
//            'create_by',
//            'user',
//            'id',
//            'CASCADE'
//        );
        
        // creates index for column `agency_id`
        $this->createIndex(
            'idx-site_owner-agency_id',
            'site_owner',
            'agency_id'
        );
        
        // add foreign key for table `site_owner`
//        $this->addForeignKey(
//            'fk-site_owner-agency_id',
//            'site_owner',
//            'agency_id',
//            'agency',
//            'id',
//            'CASCADE'
//        );
        
//        // creates index for column `website`
//        $this->createIndex(
//            'idx-site_owner-website',
//            'site_owner',
//            'website'
//        );
        
        // creates index for column `bill_id`
        $this->createIndex(
            'idx-site_owner-bill_id',
            'site_owner',
            'bill_id'
        );
        
        // creates index for column `plan_id`
        $this->createIndex(
            'idx-site_owner-plan_id',
            'site_owner',
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
            'idx-site_owner-create_by',
            'site_owner'
        );
        
        // drops index for column `agency_id`
        $this->dropIndex(
            'idx-site_owner-agency_id',
            'site_owner'
        );
        
//        // drops index for column `website`
//        $this->dropIndex(
//            'idx-site_owner-website',
//            'site_owner'
//        );
        
        // drops index for column `bill_id`
        $this->dropIndex(
            'idx-site_owner-bill_id',
            'site_owner'
        );
        
        // drops index for column `plan_id`
        $this->dropIndex(
            'idx-site_owner-plan_id',
            'site_owner'
        );
        
        $this->dropTable('site_owner');
    }
}
