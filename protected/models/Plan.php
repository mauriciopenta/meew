<?php

/**
 * This is the model class for table "plan".
 *
 * The followings are the available columns in table 'plan':
 * @property integer $id_plan
 * @property string $plan_nombre
 * @property string $plan_codigo
 * @property string $valor_text
 * @property integer $valor
 * @property string $descripcion
 * @property integer $mensajes_push
 */
class Plan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('plan_nombre, valor_text, valor, descripcion, mensajes_push', 'required'),
			array('valor, mensajes_push', 'numerical', 'integerOnly'=>true),
			array('plan_nombre, plan_codigo', 'length', 'max'=>50),
			array('valor_text', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_plan, plan_nombre, plan_codigo, valor_text, valor, descripcion, mensajes_push', 'safe', 'on'=>'search'),
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
			'id_plan' => 'Id Plan',
			'plan_nombre' => 'Plan Nombre',
			'plan_codigo' => 'Plan Codigo',
			'valor_text' => 'Valor Text',
			'valor' => 'Valor',
			'descripcion' => 'Descripcion',
			'mensajes_push' => 'Mensajes Push',
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

		$criteria->compare('id_plan',$this->id_plan);
		$criteria->compare('plan_nombre',$this->plan_nombre,true);
		$criteria->compare('plan_codigo',$this->plan_codigo,true);
		$criteria->compare('valor_text',$this->valor_text,true);
		$criteria->compare('valor',$this->valor);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('mensajes_push',$this->mensajes_push);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>5,
		     ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Plan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
