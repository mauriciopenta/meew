<?php

/**
 * This is the model class for table "plan_has_parametros".
 *
 * The followings are the available columns in table 'plan_has_parametros':
 * @property integer $id_plan_has_parametroscol
 * @property integer $plan_id_plan
 * @property integer $parametros_idparametros
 */
class PlanHasParametros extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plan_has_parametros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('plan_id_plan, parametros_idparametros', 'required'),
			array('plan_id_plan, parametros_idparametros', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_plan_has_parametroscol, plan_id_plan, parametros_idparametros', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_plan_has_parametroscol' => 'Id Plan Has Parametroscol',
			'plan_id_plan' => 'Plan Id Plan',
			'parametros_idparametros' => 'Parametros Idparametros',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_plan_has_parametroscol',$this->id_plan_has_parametroscol);
		$criteria->compare('plan_id_plan',$this->plan_id_plan);
		$criteria->compare('parametros_idparametros',$this->parametros_idparametros);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PlanHasParametros the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
