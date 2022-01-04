<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume_education".
 *
 * @property int $id
 * @property int|null $resume_id
 * @property string|null $name
 * @property string|null $faculty
 * @property string|null $field
 * @property string|null $level
 * @property string|null $started
 * @property string|null $finished
 * @property string|null $description
 *
 * @property Resume $resume
 */
class ResumeEducation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume_education';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id'], 'integer'],
            [['name', 'faculty', 'started'], 'required'],
            [['started', 'finished'], 'safe'],
            [['description'], 'string'],
            [['name', 'faculty', 'field', 'level'], 'string', 'max' => 255],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['started', 'finished'], 'date', 'format' => 'php:Y-m-d'],
            [['started', 'finished'], 'validateDates'],
        ];
    }

    /**
     * Validate start & finish dates
     */
    public function validateDates()
    {
        if($this->finished && $this->started && strtotime($this->finished) <= strtotime($this->started))
        {
            $this->addError('started','Please provide correct start date');
            $this->addError('finished','Please provide correct finish date');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resume_id' => 'Resume ID',
            'name' => 'Name',
            'faculty' => 'Faculty',
            'field' => 'Field',
            'level' => 'Level',
            'started' => 'Started',
            'finished' => 'Finished',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Resume]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResume()
    {
        return $this->hasOne(Resume::className(), ['id' => 'resume_id']);
    }
}
