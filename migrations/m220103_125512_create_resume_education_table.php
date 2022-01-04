<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume_education}}`.
 */
class m220103_125512_create_resume_education_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resume_education}}', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'faculty' => $this->string()->notNull(),
            'field' => $this->string()->null(),
            'level' => $this->string()->null(),
            'started' => $this->date()->notNull(),
            'finished' => $this->date()->null(),
            'description' => $this->text()->null()
        ], 'engine = InnoDb, charset = utf8');

        $this->addForeignKey(
            'fk-resume_education-resume_id',
            'resume_education',
            'resume_id',
            'resume',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resume_education}}');
    }
}
