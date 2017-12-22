<?php

/**
 * This is the model class for table "item_menu".
 *
 * The followings are the available columns in table 'item_menu':
 * @property integer $iditem_menu
 * @property integer $orden
 * @property string $nombre
 * @property string $icono
 * @property integer $tipo_contenido
 * @property integer $id_contenido
 * @property integer $tipo_menu
 * @property integer $aplicacion_idaplicacion
 * @property integer $aplicacion_usuario_id_usuario
 */
class ItemMenu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iditem_menu, nombre, icono, tipo_contenido, aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'required'),
			array('iditem_menu, orden, tipo_contenido, id_contenido, tipo_menu, aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'numerical', 'integerOnly'=>true),
			array('nombre, icono', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iditem_menu, orden, nombre, icono, tipo_contenido, id_contenido, tipo_menu, aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'safe', 'on'=>'search'),
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
			'iditem_menu' => 'Iditem Menu',
			'orden' => 'Orden',
			'nombre' => 'Nombre',
			'icono' => 'Icono',
			'tipo_contenido' => 'Tipo Contenido',
			'id_contenido' => 'Id Contenido',
			'tipo_menu' => 'Tipo Menu',
			'aplicacion_idaplicacion' => 'Aplicacion Idaplicacion',
			'aplicacion_usuario_id_usuario' => 'Aplicacion Usuario Id Usuario',
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

		$criteria->compare('iditem_menu',$this->iditem_menu);
		$criteria->compare('orden',$this->orden);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('icono',$this->icono,true);
		$criteria->compare('tipo_contenido',$this->tipo_contenido);
		$criteria->compare('id_contenido',$this->id_contenido);
		$criteria->compare('tipo_menu',$this->tipo_menu);
		$criteria->compare('aplicacion_idaplicacion',$this->aplicacion_idaplicacion);
		$criteria->compare('aplicacion_usuario_id_usuario',$this->aplicacion_usuario_id_usuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemMenu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
