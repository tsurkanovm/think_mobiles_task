<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'name' => $this->string(20),
            'last_name' => $this->string(50),
            'birth_date' => $this->integer(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%interest}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(30)->notNull()->unique(),
        ], $tableOptions);

//        $user_array = ['email' => 'test@test.com', 'name' => 'Admin',
//            'password_hash' => '96e79218965eb72c92a549dd5a330112',
//            'gender' => 'male', 'role_id' => 3];
//        $this->insert('{{%user}}', $user_array);

        $interest_array = ['id' => 1, 'title' => 'Sport'];
        $this->insert('{{%interest}}', $interest_array);
        $interest_array = ['id' => 2, 'title' => 'Programming'];
        $this->insert('{{%interest}}', $interest_array);
        $interest_array = ['id' => 3, 'title' => 'Sience'];
        $this->insert('{{%interest}}', $interest_array);
        $interest_array = ['id' => 4, 'title' => 'Travels'];
        $this->insert('{{%interest}}', $interest_array);
        $interest_array = ['id' => 5, 'title' => 'Psychology'];
        $this->insert('{{%interest}}', $interest_array);
        $interest_array = ['id' => 6, 'title' => 'TV'];
        $this->insert('{{%interest}}', $interest_array);

    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%interest}}');
    }
}
