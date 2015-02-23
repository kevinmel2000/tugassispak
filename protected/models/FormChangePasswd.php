<?php

class FormChangePasswd extends CFormModel
{
    public $oldPasswd;
    
    public $newPasswd;
    public $reTypeNewPasswd;
    
    private $_user;
    
    public function rules()
    {
        return array(
            array('oldPasswd, newPasswd, reTypeNewPasswd', 'required'),
            array('newPasswd', 'length', 'min'=> 7, 'max' => 100),
            array('reTypeNewPasswd', 'compare', 'compareAttribute' => 'newPasswd'),
            array('oldPasswd', 'validateOldPasswd')
        );
    }
    
    public function validateOldPasswd()
    {
        if($this->oldPasswd != "")
        {
            if($this->_user == null)
            {
                $this->_user = User::model()->findByPk(Yii::app()->user->userId);
            }

            if(!$this->_user == null)
            {
                if($this->_user->user_passwd != md5($this->oldPasswd))
                {
                    $this->addError('oldPasswd', 'Wrong Old password!');
                }
            }
        }
    }

    public function attributeLabels()
    {
        return array(
            'newPasswd' => 'New password',
            'reTypeNewPasswd' => 'Retype new password',
            'oldPasswd' => 'Old password'
        );
    }
}
