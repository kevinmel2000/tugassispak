<?php

class UserIdentity extends CUserIdentity
{
    private $_id;
    
    /* @var $user User */
	public function authenticate()
	{
        $criteria = new CDbCriteria();
        $criteria->compare('user_name', $this->username);
                
        $user = User::model()->find($criteria);
        
        if($user == null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if($user->user_passwd != md5($this->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->_id = $user->id;
            $this->setState('userId', $user->id);
            $this->setState('name', $user->name);
            $this->setState('userLevelName', $user->userLevel->name);
            $this->setState('userLevelId', $user->user_level_id);
            
            //update data user
            $user->last_login_date = new CDbExpression('NOW()');
            $user->last_ip_address = Yii::app()->request->userHostAddress;
            
            $user->save();
            
            $this->errorCode = self::ERROR_NONE;
        }
        
        return !$this->errorCode;
	}
}