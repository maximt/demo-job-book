<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee_jobs}}`.
 */
class m240608_101417_create_employee_jobs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee_jobs}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer(11)->notNull(),
            'begin_at' => $this->date()->notNull(),
            'end_at' => $this->date(),
            'company' => $this->string(256)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employee_jobs}}');
    }
}
