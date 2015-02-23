<?php

/**
 * This is the model class for table "fis".
 *
 * The followings are the available columns in table 'fis':
 * @property integer $id
 * @property string $project_name
 * @property integer $id_fis
 * @property integer $and_method
 * @property integer $or_method
 * @property integer $implication
 * @property integer $aggregation
 * @property integer $defuzzification
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Rule[] $rules
 * @property Variable[] $variables
 */
class Fis extends CActiveRecord
{    
    public static $STATUS_DEACTIVE = 0;
    public static $STATUS_ACTIVE = 1;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fis the static model class
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
		return 'fis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_name', 'required'),
            array('project_name', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, project_name, id_fis, and_method, or_method, implication, aggregation, defuzzification, status', 'safe', 'on'=>'search'),
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
			'rules' => array(self::HAS_MANY, 'Rule', 'id_fis'),
			'variables' => array(self::HAS_MANY, 'Variable', 'id_fis'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'project_name' => 'Project Name',
			'id_fis' => 'Id Fis',
			'and_method' => 'And Method',
			'or_method' => 'Or Method',
			'implication' => 'Implication',
			'aggregation' => 'Aggregation',
			'defuzzification' => 'Defuzzification',
			'status' => 'Status',
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
		$criteria->compare('project_name',$this->project_name,true);
		$criteria->compare('id_fis',$this->id_fis);
		$criteria->compare('and_method',$this->and_method);
		$criteria->compare('or_method',$this->or_method);
		$criteria->compare('implication',$this->implication);
		$criteria->compare('aggregation',$this->aggregation);
		$criteria->compare('defuzzification',$this->defuzzification);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave()
    {
        $this->id_fis = ARFisType::$FIS_TSUKAMOTO;
        return true;
    }
}