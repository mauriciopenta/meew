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
 * @property integer $usuario_activo
 * @property string $token_push
 * @property string $id_cliente_payu
 * @property string $id_suscripcion
 * @property string $codigo_plan
 * @property string $id_tarjeta
 * @property string $codigo_registro
 * @property string $fecha_suscripcion
 * @property string $ultima_transaccion
 * @property string $estado_pago
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
			array('id_persona, usuario_activo', 'required'),
			array('id_tipologin, id_persona, id_rol, id_empresa, usuario_activo', 'numerical', 'integerOnly'=>true),
			array('usuario', 'length', 'max'=>50),
			array('token_push', 'length', 'max'=>300),
			array('id_cliente_payu, id_suscripcion, codigo_plan, id_tarjeta, codigo_registro, ultima_transaccion, estado_pago', 'length', 'max'=>200),
			array('password, fecha_suscripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, id_tipologin, id_persona, id_rol, id_empresa, usuario, password, usuario_activo, token_push, id_cliente_payu, id_suscripcion, codigo_plan, id_tarjeta, codigo_registro, fecha_suscripcion, ultima_transaccion, estado_pago', 'safe', 'on'=>'search'),
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
			'id_usuario' => 'Id Usuario',
			'id_tipologin' => 'Id Tipologin',
			'id_persona' => 'Id Persona',
			'id_rol' => 'Id Rol',
			'id_empresa' => 'Id Empresa',
			'usuario' => 'Usuario',
			'password' => 'Password',
			'usuario_activo' => 'Usuario Activo',
			'token_push' => 'Token Push',
			'id_cliente_payu' => 'Id Cliente Payu',
			'id_suscripcion' => 'Id Suscripcion',
			'codigo_plan' => 'Codigo Plan',
			'id_tarjeta' => 'Id Tarjeta',
			'codigo_registro' => 'Codigo Registro',
			'fecha_suscripcion' => 'Fecha Suscripcion',
			'ultima_transaccion' => 'Ultima Transaccion',
			'estado_pago' => 'Estado Pago',
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
		$criteria->compare('usuario_activo',$this->usuario_activo);
		$criteria->compare('token_push',$this->token_push,true);
		$criteria->compare('id_cliente_payu',$this->id_cliente_payu,true);
		$criteria->compare('id_suscripcion',$this->id_suscripcion,true);
		$criteria->compare('codigo_plan',$this->codigo_plan,true);
		$criteria->compare('id_tarjeta',$this->id_tarjeta,true);
		$criteria->compare('codigo_registro',$this->codigo_registro,true);
		$criteria->compare('fecha_suscripcion',$this->fecha_suscripcion,true);
		$criteria->compare('ultima_transaccion',$this->ultima_transaccion,true);
		$criteria->compare('estado_pago',$this->estado_pago,true);

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
