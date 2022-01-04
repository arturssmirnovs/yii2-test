<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $location
 *
 * @property ResumeEducation[] $resumeEducations
 * @property ResumeExperience[] $resumeExperiences
 * @property ResumeSkill[] $resumeSkills
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'phone', 'email', 'location'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'phone' => 'Phone',
            'email' => 'Email',
            'location' => 'Location',
        ];
    }

    /**
     * Gets query for [[ResumeEducations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumeEducations()
    {
        return $this->hasMany(ResumeEducation::className(), ['resume_id' => 'id']);
    }

    /**
     * Gets query for [[ResumeExperiences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumeExperiences()
    {
        return $this->hasMany(ResumeExperience::className(), ['resume_id' => 'id']);
    }

    /**
     * Gets query for [[ResumeSkills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumeSkills()
    {
        return $this->hasMany(ResumeSkill::className(), ['resume_id' => 'id']);
    }
}
