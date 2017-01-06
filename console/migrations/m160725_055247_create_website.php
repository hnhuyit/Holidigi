<?php

use yii\db\Migration;

/**
 * Handles the creation for table `website`.
 */
class m160725_055247_create_website extends Migration
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
        
        $this->createTable('website', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string()->notNull(),
            'des'           => $this->text(),
            'create_by'     => $this->integer()->notNull(),
            'status'        => $this->smallInteger()->notNull()->defaultValue(1),
            'site_owner_id' => $this->integer()->notNull()->defaultValue(0),
            
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
            
        ], $tableOptions);
        
        // creates index for column `create_by`
        $this->createIndex(
            'idx-website-create_by',
            'website',
            'create_by'
        );
        
        // add foreign key for table `website`
//        $this->addForeignKey(
//            'fk-website-create_by',
//            'website',
//            'create_by',
//            'user',
//            'id',
//            'CASCADE'
//        );
        
        // creates index for column `site_owner_id`
        $this->createIndex(
            'idx-website-site_owner_id',
            'website',
            'site_owner_id'
        );
        
        // add foreign key for table `website`
//        $this->addForeignKey(
//            'fk-website-site_owner_id',
//            'website',
//            'site_owner_id',
//            'site_owner',
//            'id',
//            'CASCADE'
//        );
//        
//        // creates index for column `agency_id`
//        $this->createIndex(
//            'idx-website-agency_id',
//            'website',
//            'agency_id'
//        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops index for column `create_by`
        $this->dropIndex(
            'idx-website-create_by',
            'website'
        );
        
        // drops index for column `site_owner_id`
        $this->dropIndex(
            'idx-website-site_owner_id',
            'website'
        );
        
//        // drops index for column `agency_id`
//        $this->dropIndex(
//            'idx-website-agency_id',
//            'website'
//        );
        
        $this->dropTable('website');
    }
}
