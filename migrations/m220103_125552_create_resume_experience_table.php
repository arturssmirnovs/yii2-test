<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume_experience}}`.
 */
class m220103_125552_create_resume_experience_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resume_experience}}', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'position' => $this->string()->notNull(),
            'started' => $this->date()->notNull(),
            'finished' => $this->date()->null(),
            'description' => $this->text()->null()
        ], 'engine = InnoDb, charset = utf8');

        $this->addForeignKey(
            'fk-resume_experience-resume_id',
            'resume_experience',
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
        $this->dropTable('{{%resume_experience}}');
    }
}
