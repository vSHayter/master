<?php

namespace app\models;

use yii\base\Model;

/**
 * SignUpForm is the model behind the sign up form.
 */
class SignUpForm extends Model
{
    public $username;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $phone;

    public function rules()
    {
        return [
            [['username', 'name', 'email', 'password', 'phone'], 'required'],
            [['username', 'name', 'surname'], 'string', 'min' => 3, 'max' => 20],
            [['phone'], 'number'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'email'],
            [['username'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'username']
        ];
    }

    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->setPassword($this->password);

            return $user->create();
        }
        else
        {
            return false;
        }
    }
}