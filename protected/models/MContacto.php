<?php

/**
 * This is the model class for table "m_contacto".
 *
 * The followings are the available columns in table 'm_contacto':
 * @property integer $id_mcontacto
 * @property string $mcontacto_mensaje
 * @property string $asunto
 * @property integer $aplicacion_idaplicacion
 * @property integer $aplicacion_usuario_id_usuario
 * @property string $fecha
 * @property string $respuesta
 */
class MContacto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_contacto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mcontacto_mensaje, asunto, aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'required'),
			array('aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'numerical', 'integerOnly'=>true),
			array('respuesta', 'length', 'max'=>1000),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_mcontacto, mcontacto_mensaje, asunto, aplicacion_idaplicacion, aplicacion_usuario_id_usuario, fecha, respuesta', 'safe', 'on'=>'search'),
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
			'id_mcontacto' => 'Id Mcontacto',
			'mcontacto_mensaje' => 'Mcontacto Mensaje',
			'asunto' => 'Asunto',
			'aplicacion_idaplicacion' => 'Aplicacion Idaplicacion',
			'aplicacion_usuario_id_usuario' => 'Aplicacion Usuario Id Usuario',
			'fecha' => 'Fecha',
			'respuesta' => 'Respuesta',
		);
	}
	public function search_id_app()
	{
	
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_mcontacto',$this->id_mcontacto);
		$criteria->compare('mcontacto_mensaje',$this->mcontacto_mensaje,true);
		$criteria->compare('asunto',$this->asunto,true);
		$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
		
		$criteria->compare('aplicacion_idaplicacion',$aplicacionFromDb->idaplicacion,true);
		$criteria->compare('aplicacion_idaplicacion',$this->aplicacion_idaplicacion);
		$criteria->compare('aplicacion_usuario_id_usuario',$this->aplicacion_usuario_id_usuario);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('respuesta',$this->respuesta,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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

		$criteria->compare('id_mcontacto',$this->id_mcontacto);
		$criteria->compare('mcontacto_mensaje',$this->mcontacto_mensaje,true);
		$criteria->compare('asunto',$this->asunto,true);
		$criteria->compare('aplicacion_idaplicacion',$this->aplicacion_idaplicacion);
		$criteria->compare('aplicacion_usuario_id_usuario',$this->aplicacion_usuario_id_usuario);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('respuesta',$this->respuesta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MContacto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
