<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $id_usuario
 * @property integer $id_tipologin
 * @property integer $id_persona
 * @property integer $id_rol
 * @property integer $id_empresa
 * @property string $usuario
 * @property string $password
 *
 * The followings are the available model relations:
 * @property MContacto[] $mContactos
 * @property MSoporte[] $mSoportes
 * @property TipoLogin $idTipologin
 * @property Empresa $idEmpresa
 * @property Persona $idPersona
 * @property Rol $idRol
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tipologin, id_persona, id_rol, id_empresa', 'numerical', 'integerOnly'=>true),
			array('usuario', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, id_tipologin, id_persona, id_rol, id_empresa, usuario, password', 'safe', 'on'=>'search'),
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
			'mContactos' => array(self::HAS_MANY, 'MContacto', 'id_usuario'),
			'mSoportes' => array(self::HAS_MANY, 'MSoporte', 'id_usuario'),
			'idTipologin' => array(self::BELONGS_TO, 'TipoLogin', 'id_tipologin'),
			'idEmpresa' => array(self::BELONGS_TO, 'Empresa', 'id_empresa'),
			'idPersona' => array(self::BELONGS_TO, 'Persona', 'id_persona'),
			'idRol' => array(self::BELONGS_TO, 'Rol', 'id_rol'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			'id_tipologin' => 'Id Tipologin',
			'id_persona' => 'Id Persona',
			'id_rol' => 'Id Rol',
			'id_empresa' => 'Id Empresa',
			'usuario' => 'Usuario',
			'password' => 'Password',
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

		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('id_tipologin',$this->id_tipologin);
		$criteria->compare('id_persona',$this->id_persona);
		$criteria->compare('id_rol',$this->id_rol);
		$criteria->compare('id_empresa',$this->id_empresa);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
