<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user', [
            'id'                    => $this->primaryKey(),
            'is_supper'             => $this->smallInteger()->notNull()->defaultValue(0),
            'first_name'            => $this->string()->notNull(),
            'last_name'             => $this->string()->notNull(),
            'username'              => $this->string()->notNull()->unique(),
            'phone'                 => $this->string(15)->notNull(),
            'email'                 => $this->string()->notNull()->unique(),
            'auth_key'              => $this->string(32)->notNull(),
            'password_hash'         => $this->string()->notNull(),
            'password_reset_token'  => $this->string()->unique(),
            'create_by'             => $this->integer(), // User duoc tao boi
            'status'                => $this->smallInteger()->notNull()->defaultValue(1),
            'last_login'            => $this->integer()->defaultValue(0), // Lan dang nhap cuoi cung
            'site_owner_id'         => $this->integer(), // La khach hang cua sys: SiteOwner
            'agency_id'             => $this->integer(), // La khach hang cua sys: Agency
            'is_owner'              => $this->integer()->defaultValue(0), // La khach hang cua sys: SiteOwner
            'role'                  => $this->string(), // Vai tro cua user trong sys: Seo, Tester, Pm, Dev, Des
            
            'created_at'            => $this->integer(),
            'updated_at'            => $this->integer(),
            
        ], $tableOptions);
        
        // creates index for column `create_by`
        $this->createIndex(
            'idx-user-create_by',
            'user',
            'create_by'
        );
        
        // creates index for column `site_owner_id`
        $this->createIndex(
            'idx-user-site_owner_id',
            'user',
            'site_owner_id'
        );
        
        // creates index for column `agency_id`
        $this->createIndex(
            'idx-user-agency_id',
            'user',
            'agency_id'
        );
    }

    public function down()
    {
        // drops index for column `create_by`
        $this->dropIndex(
            'idx-user-create_by',
            'user'
        );
        
        // drops index for column `site_owner_id`
        $this->dropIndex(
            'idx-user-site_owner_id',
            'user'
        );
        
        // drops index for column `agency_id`
        $this->dropIndex(
            'idx-user-agency_id',
            'user'
        );
        $this->dropTable('user');
    }
}
