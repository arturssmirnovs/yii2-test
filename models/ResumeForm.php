<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ResumeForm is the model behind the resume form.
 */
class ResumeForm extends Model
{
    public $id;

    public $name;

    public $surname;

    public $phone;

    public $email;

    public $location;

    public $educations;

    public $experiences;

    public $skills;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'phone', 'email', 'location'], 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Save resume form
     *
     * @param Resume $resume
     * @return bool
     */
    public function saveForm(Resume $resume)
    {
        if ($this->validate()
            && Model::validateMultiple($this->educations)
            && Model::validateMultiple($this->skills)
            && Model::validateMultiple($this->experiences)) {

            $resume->setAttributes([
                'name' => $this->name,
                'surname' => $this->surname,
                'phone' => $this->phone,
                'email' => $this->email,
                'location' => $this->location,
            ]);

            $resume->save();

            ResumeEducation::deleteAll(['resume_id' => $resume->id]);
            ResumeExperience::deleteAll(['resume_id' => $resume->id]);
            ResumeSkill::deleteAll(['resume_id' => $resume->id]);

            foreach ($this->educations as $education) {
                $education->resume_id = $resume->id;
                $education->save();
            }

            foreach ($this->experiences as $experience) {
                $experience->resume_id = $resume->id;
                $experience->save();
            }

            foreach ($this->skills as $skill) {
                $skill->resume_id = $resume->id;
                $skill->save();
            }

            $this->id = $resume->id;

            return true;
        }

        return false;
    }
}
