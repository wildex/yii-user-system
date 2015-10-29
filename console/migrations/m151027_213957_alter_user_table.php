<?php

use yii\db\Migration;
use yii\db\Schema;

class m151027_213957_alter_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'avatar', Schema::TYPE_STRING . '(255) NOT NULL DEFAULT \'\' AFTER email');
        $this->addColumn('{{%user}}', 'phone', Schema::TYPE_STRING . '(32) NOT NULL DEFAULT \'\' AFTER avatar');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'avatar');
        $this->dropColumn('{{%user}}', 'phone');
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
