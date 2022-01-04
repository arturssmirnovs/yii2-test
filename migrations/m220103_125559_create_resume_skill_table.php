<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume_skill}}`.
 */
class m220103_125559_create_resume_skill_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resume_skill}}', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ], 'engine = InnoDb, charset = utf8');

        $this->addForeignKey(
            'fk-resume_skill-resume_id',
            'resume_skill',
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
        $this->dropTable('{{%resume_skill}}');
    }
}
