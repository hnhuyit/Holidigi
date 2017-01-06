<?php

use yii\db\Migration;

/**
 * Handles the creation for table `bill`.
 */
class m160731_141401_create_bill extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('bill', [
            'id' => $this->primaryKey(),
            'card_type'         => $this->string(),
            'card_name'         => $this->string(),
            'card_number'       => $this->string(),
            'expiration_date'   => $this->string(),
            'security_code'     => $this->string(),
            'phone_number'      => $this->string(),
            'address'           => $this->string(),
            'city'              => $this->string(),
            'state'             => $this->string(),
            'country'           => $this->string(),
            'postal_code'       => $this->string(),
            
            'created_at'        => $this->integer(),
            'updated_at'        => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('bill');
    }
}
