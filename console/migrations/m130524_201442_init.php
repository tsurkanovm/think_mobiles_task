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
            'birth_date' => $this->timestamp(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%interest}}', [
            'id' => 'tinyint UNSIGNED NOT NULL',
            'title' => $this->string(30)->notNull()->unique(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-id', '{{%interest}}','id');

        $table = <<< MySQL
            CREATE TABLE `think_mobilies_db`.`user_interest` (
            `id_user` INT(11) NOT NULL,
            `id_interest` TINYINT(3) UNSIGNED NOT NULL,
            PRIMARY KEY (`id_user`, `id_interest`),
            INDEX `idx_id_user` (`id_user` ASC),
            INDEX `fk_id_interest_idx` (`id_interest` ASC),
            CONSTRAINT `fk_id_user`
              FOREIGN KEY (`id_user`)
              REFERENCES `think_mobilies_db`.`user` (`id`)
              ON DELETE CASCADE
              ON UPDATE CASCADE,
            CONSTRAINT `fk_id_interest`
              FOREIGN KEY (`id_interest`)
              REFERENCES `think_mobilies_db`.`interest` (`id`)
              ON DELETE CASCADE
              ON UPDATE CASCADE)
MySQL;

        $this->execute($table);

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
        $this->dropTable('{{%user_interest}}');
    }
}
