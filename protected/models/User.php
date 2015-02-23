<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $user_name
 * @property string $user_passwd
 * @property string $email
 * @property string $register_date
 * @property integer $register_by
 * @property integer $user_level_id
 * @property string $last_login_date
 * @property string $last_ip_address
 *
 * The followings are the available model relations:
 * @property UserLevel $userLevel
 */
class User extends CActiveRecord
{
	public $onDeleteMessage;
    public $reTypePasswd;
	
    public $newPasswd;
    public $reTypeNewPasswd;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'email'),
            array('user_name', 'unique', 'message' => 'Choose another name! This username ({value}) already taken.'),
			array('name, user_name, user_level_id', 'required'),
            array('user_name', 'length', 'min' => 5, 'max' => 30),
            
            array('user_passwd', 'length', 'min'=> 7, 'max' => 100, 'on' => 'new'),
            array('user_passwd, reTypePasswd', 'required', 'on'=> 'new'),
			array('reTypePasswd', 'compare', 'compareAttribute' => 'user_passwd', 'on'=> 'new'),
            
            array('newPasswd', 'length', 'min'=> 7, 'max' => 100, 'on' => 'update'),
			array('reTypeNewPasswd', 'compare', 'compareAttribute' => 'newPasswd', 'on'=> 'update'),
            
			array('id, name, user_name, user_passwd, email, register_date, register_by, user_level_id, last_login_date, last_ip_address', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'userLevel' => array(self::BELONGS_TO, 'UserLevel', 'user_level_id'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'register_by'),
			'pegawai' => array(self::HAS_ONE, 'Pegawai', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'user_name' => 'Username',
			'user_passwd' => 'Password',
            'reTypePasswd' => 'Retype Password',
            'newPasswd' => 'New Password',
            'reTypeNewPasswd' => 'Retype New Password',
			'email' => 'Email',
			'register_date' => 'Register Date',
			'register_by' => 'Register By',
			'user_level_id' => 'User Level',
			'last_login_date' => 'Last Login Date',
			'last_ip_address' => 'Last Used Ip Address',
			'createdBy.name' => 'Register By',
			'userLevel.name' => 'Level'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_passwd',$this->user_passwd,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('register_date',$this->register_date,true);
		$criteria->compare('register_by',$this->register_by);
		$criteria->compare('user_level_id',$this->user_level_id);
		$criteria->compare('last_login_date',$this->last_login_date,true);
		$criteria->compare('last_ip_address',$this->last_ip_address,true);
		
		//$criteria->order = 'user_name asc';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
    {
        if($this->isNewRecord)
        {
            $this->register_date = new CDbExpression('NOW()');
            $this->user_passwd = md5($this->user_passwd);
        }
        
        if($this->newPasswd != "" || $this->newPasswd != null)
        {
            $this->user_passwd = md5($this->newPasswd);
        }
        
        return true;
    }
	
	public function validatePassword()
    {
        if ($this->re_user_passwd != $this->user_passwd)
		{
            $this->addError('user_passwd', '');
			$this->addError('re_user_passwd', 'Password and retype password do not match!');
		}
    }
	
	public function validateChangePassword()
    {
        if ($this->new_passwd == "" && $this->re_new_passwd == "")
		{
			return true;
		}
		else if($this->new_passwd != $this->re_new_passwd)
		{
			$this->addError('new_passwd', '');
			$this->addError('re_new_passwd', 'Password and retype password do not match!');
		}
    }
	
	public function validationBeforeDelete()
    {
        return true;
    }
}