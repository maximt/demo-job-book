<?php

use yii\db\Migration;

/**
 * Class m240606_144810_create_admin_user
 */
class m240606_144810_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new \app\models\User();
        $user->username = 'admin';
        $user->email = 'admin@localhost';
        $user->status = \app\models\User::STATUS_ACTIVE;
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['username' => 'admin']);
    }

}
