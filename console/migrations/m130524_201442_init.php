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

        if ( Yii::$app->db->schema->getTableSchema( '{{%user}}',true ) === null ) {
            $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'name' => $this->string(20),
            'last_name' => $this->string(50),
            'birth_date' => $this->date(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);
        }


        if ( Yii::$app->db->schema->getTableSchema( '{{%interest}}',true ) === null ) {
            $this->createTable('{{%interest}}', [
                'id' => 'tinyint UNSIGNED NOT NULL',
                'title' => $this->string(30)->notNull()->unique(),
            ], $tableOptions);
            $this->addPrimaryKey('pk-id', '{{%interest}}','id');
        }


        if ( Yii::$app->db->schema->getTableSchema( '{{%user_interest}}',true ) === null ) {
            $this->createTable('{{%user_interest}}', [
                'id_user' => $this->integer(11)->notNull(),
                'id_interest' => 'tinyint UNSIGNED NOT NULL',
            ], $tableOptions);
            $this->addPrimaryKey('pk-id', '{{%user_interest}}','id_user, id_interest');
            $this->addForeignKey('fk_id_user', '{{%user_interest}}', 'id_user', '{{%user}}', 'id', 'CASCADE','CASCADE');
            $this->addForeignKey('fk_id_interest', '{{%user_interest}}', 'id_interest', '{{%interest}}', 'id', 'CASCADE','CASCADE');

            // fill the table by default data
            $interest_array = ['id' => 1, 'title' => 'Спорт'];
            $this->insert('{{%interest}}', $interest_array);
            $interest_array = ['id' => 2, 'title' => 'Программирование'];
            $this->insert('{{%interest}}', $interest_array);
            $interest_array = ['id' => 3, 'title' => 'Наука'];
            $this->insert('{{%interest}}', $interest_array);
            $interest_array = ['id' => 4, 'title' => 'Путешествия'];
            $this->insert('{{%interest}}', $interest_array);
            $interest_array = ['id' => 5, 'title' => 'Психология'];
            $this->insert('{{%interest}}', $interest_array);
            $interest_array = ['id' => 6, 'title' => 'Телевидение'];
            $this->insert('{{%interest}}', $interest_array);
        }

    }

    public function safeDown()
    {
        if ( Yii::$app->db->schema->getTableSchema( '{{%user_interest}}',true ) !== null ) {
            $this->dropTable('{{%user_interest}}');
        }
        if ( Yii::$app->db->schema->getTableSchema( '{{%user}}',true ) !== null ) {
            $this->dropTable('{{%user}}');
        }
        if ( Yii::$app->db->schema->getTableSchema( '{{%interest}}',true ) !== null ) {
            $this->dropTable('{{%interest}}');
        }
    }
}
