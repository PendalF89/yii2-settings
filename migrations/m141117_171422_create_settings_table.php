<?php

use yii\db\Schema;
use yii\db\Migration;

class m141117_171422_create_settings_table extends Migration
{
    public function up()
    {
        $this->createTable('settings', [
            'key' => Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_TEXT . ' NOT NULL',
        ]);

        $this->addPrimaryKey('settings_pk', 'settings', 'key');
    }

    public function down()
    {
        $this->dropTable('settings');
    }
}
