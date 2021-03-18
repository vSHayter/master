<?php

namespace app\models;

use yii\base\Model;

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
            [['username', 'name', 'surname', 'email', 'password', 'phone'], 'required'],
            [['username', 'name', 'surname', 'phone'], 'string', 'min' => 3, 'max' => 20],
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