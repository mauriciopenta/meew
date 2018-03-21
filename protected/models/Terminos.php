<?php

/**
 * This is the model class for table "terminos".
 *
 * The followings are the available columns in table 'terminos':
 * @property integer $idterminos
 * @property string $terminos
 * @property integer $id_aplicacion
 * @property string $tipo
 */
class Terminos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'terminos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('terminos', 'required'),
			array('id_aplicacion', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idterminos, terminos, id_aplicacion, tipo', 'safe', 'on'=>'search'),
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
			'idterminos' => 'Idterminos',
			'terminos' => 'Terminos',
			'id_aplicacion' => 'Id Aplicacion',
			'tipo' => 'Tipo',
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

		$criteria->compare('idterminos',$this->idterminos);
		$criteria->compare('terminos',$this->terminos,true);
		$criteria->compare('id_aplicacion',$this->id_aplicacion);
		$criteria->compare('tipo',$this->tipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Terminos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
