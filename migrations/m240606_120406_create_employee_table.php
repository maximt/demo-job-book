<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m240606_120406_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(255)->notNull(),
            'surname' => $this->string(255),
            'lastname' => $this->string(255)->notNull(),
            'birthday' => $this->date(),
            'gender' => $this->smallInteger(1),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-employee-created_by}}',
            '{{%employee}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-employee-created_by}}',
            '{{%employee}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-employee-updated_by}}',
            '{{%employee}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-employee-updated_by}}',
            '{{%employee}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-employee-created_by}}',
            '{{%employee}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-employee-created_by}}',
            '{{%employee}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-employee-updated_by}}',
            '{{%employee}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-employee-updated_by}}',
            '{{%employee}}'
        );

        $this->dropTable('{{%employee}}');
    }
}
