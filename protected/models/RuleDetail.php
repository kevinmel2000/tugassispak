<?php

/**
 * This is the model class for table "rule_detail".
 *
 * The followings are the available columns in table 'rule_detail':
 * @property integer $id
 * @property integer $id_rule
 * @property integer $type_rule
 * @property integer $order
 * @property integer $id_variable
 * @property integer $id_mf
 * @property integer $value
 *
 * The followings are the available model relations:
 * @property Variable $idVariable
 * @property Mf $idMf
 * @property Rule $idRule
 */
class RuleDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RuleDetail the static model class
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
		return 'rule_detail';
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
			array('id, id_rule, type_rule, order, id_variable, id_mf, value', 'safe', 'on'=>'search'),
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
			'variable' => array(self::BELONGS_TO, 'Variable', 'id_variable'),
			'mf' => array(self::BELONGS_TO, 'Mf', 'id_mf'),
			'rule' => array(self::BELONGS_TO, 'Rule', 'id_rule'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_rule' => 'Id Rule',
			'type_rule' => 'Type Rule',
			'order' => 'Order',
			'id_variable' => 'Id Variable',
			'id_mf' => 'Id Mf',
			'value' => 'Value',
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
		$criteria->compare('id_rule',$this->id_rule);
		$criteria->compare('type_rule',$this->type_rule);
		$criteria->compare('order',$this->order);
		$criteria->compare('id_variable',$this->id_variable);
		$criteria->compare('id_mf',$this->id_mf);
		$criteria->compare('value',$this->value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}