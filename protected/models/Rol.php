<?php

/**
 * This is the model class for table "rol".
 *
 * The followings are the available columns in table 'rol':
 * @property integer $id_rol
 * @property string $rol_nombre
 * @property string $rol_codigo
 * @property integer $acceso_web
 *
 * The followings are the available model relations:
 * @property Permiso[] $permisos
 * @property Usuario[] $usuarios
 */
class Rol extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rol';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rol_nombre, rol_codigo, acceso_web', 'required'),
			array('acceso_web', 'numerical', 'integerOnly'=>true),
			array('rol_nombre, rol_codigo', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_rol, rol_nombre, rol_codigo, acceso_web', 'safe', 'on'=>'search'),
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
			'permisos' => array(self::MANY_MANY, 'Permiso', 'rol_permiso(id_rol, id_permiso)'),
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'id_rol'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_rol' => 'Id Rol',
			'rol_nombre' => 'Rol Nombre',
			'rol_codigo' => 'Rol Codigo',
			'acceso_web' => 'Acceso Web',
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

		$criteria->compare('id_rol',$this->id_rol);
		$criteria->compare('rol_nombre',$this->rol_nombre,true);
		$criteria->compare('rol_codigo',$this->rol_codigo,true);
		$criteria->compare('acceso_web',$this->acceso_web);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rol the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
