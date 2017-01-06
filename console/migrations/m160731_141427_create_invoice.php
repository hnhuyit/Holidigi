<?php

use yii\db\Migration;

/**
 * Handles the creation for table `invoice`.
 */
class m160731_141427_create_invoice extends Migration
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
        $this->createTable('invoice', [
            'id'        => $this->primaryKey(),
            'name'      => $this->string()->notNull(),
            'type'      => $this->string()->notNull(),
            'start'     => $this->date(),
            'end'       => $this->date(),
            'object_id' => $this->integer(),
            'object_type' => $this->string()->notNull(),
            'cost'      => $this->integer(),
            'status'        => $this->smallInteger()->notNull()->defaultValue(1),
            'sent'      => $this->integer(),
            'agency_id' => $this->integer(),
            
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ], $tableOptions);
        
        // creates index for column `agency_id`
        $this->createIndex(
            'idx-invoice-agency_id',
            'invoice',
            'agency_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops index for column `agency_id`
        $this->dropIndex(
            'idx-invoice-agency_id',
            'invoice'
        );
        $this->dropTable('invoice');
    }
}
