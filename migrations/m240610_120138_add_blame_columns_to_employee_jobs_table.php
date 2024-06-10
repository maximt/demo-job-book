<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employee_jobs}}`.
 */
class m240610_120138_add_blame_columns_to_employee_jobs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employee_jobs}}', 'created_by', $this->integer(11));
        $this->addColumn('{{%employee_jobs}}', 'updated_by', $this->integer(11));
        $this->addColumn('{{%employee_jobs}}', 'created_at', $this->integer(11));
        $this->addColumn('{{%employee_jobs}}', 'updated_at', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employee_jobs}}', 'created_by');
        $this->dropColumn('{{%employee_jobs}}', 'updated_by');
        $this->dropColumn('{{%employee_jobs}}', 'created_at');
        $this->dropColumn('{{%employee_jobs}}', 'updated_at');
    }
}
