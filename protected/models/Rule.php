<?php

/**
 * This is the model class for table "rule".
 *
 * The followings are the available columns in table 'rule':
 * @property integer $id
 * @property integer $id_fis
 * @property integer $connection
 * @property integer $order
 *
 * The followings are the available model relations:
 * @property Fis $idFis
 * @property RuleDetail[] $ruleDetails
 */
class Rule extends CActiveRecord
{
    public static $TYPE_INPUT = 0;
    public static $TYPE_CONCLUSION = 1;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rule the static model class
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
		return 'rule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_fis, connection, order', 'safe', 'on'=>'search'),
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
			'idFis' => array(self::BELONGS_TO, 'Fis', 'id_fis'),
			'ruleDetails' => array(self::HAS_MANY, 'RuleDetail', 'id_rule'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_fis' => 'Id Fis',
			'connection' => 'Connection',
			'order' => 'Order',
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
		$criteria->compare('id_fis',$this->id_fis);
		$criteria->compare('connection',$this->connection);
		$criteria->compare('order',$this->order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}