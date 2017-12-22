<?php

/**
 * This is the model class for table "contenido".
 *
 * The followings are the available columns in table 'contenido':
 * @property integer $idcontenido
 * @property integer $tipo
 * @property string $url_imagen
 * @property string $texto
 * @property integer $grupo_contenido_idarticulo
 * @property integer $grupo_contenido_aplicacion_idaplicacion
 * @property integer $grupo_contenido_aplicacion_usuario_id_usuario
 */
class Contenido extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contenido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcontenido, tipo, grupo_contenido_idarticulo, grupo_contenido_aplicacion_idaplicacion, grupo_contenido_aplicacion_usuario_id_usuario', 'required'),
			array('idcontenido, tipo, grupo_contenido_idarticulo, grupo_contenido_aplicacion_idaplicacion, grupo_contenido_aplicacion_usuario_id_usuario', 'numerical', 'integerOnly'=>true),
			array('url_imagen', 'length', 'max'=>200),
			array('texto', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcontenido, tipo, url_imagen, texto, grupo_contenido_idarticulo, grupo_contenido_aplicacion_idaplicacion, grupo_contenido_aplicacion_usuario_id_usuario', 'safe', 'on'=>'search'),
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
			'idcontenido' => 'Idcontenido',
			'tipo' => 'Tipo',
			'url_imagen' => 'Url Imagen',
			'texto' => 'Texto',
			'grupo_contenido_idarticulo' => 'Grupo Contenido Idarticulo',
			'grupo_contenido_aplicacion_idaplicacion' => 'Grupo Contenido Aplicacion Idaplicacion',
			'grupo_contenido_aplicacion_usuario_id_usuario' => 'Grupo Contenido Aplicacion Usuario Id Usuario',
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

		$criteria->compare('idcontenido',$this->idcontenido);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('url_imagen',$this->url_imagen,true);
		$criteria->compare('texto',$this->texto,true);
		$criteria->compare('grupo_contenido_idarticulo',$this->grupo_contenido_idarticulo);
		$criteria->compare('grupo_contenido_aplicacion_idaplicacion',$this->grupo_contenido_aplicacion_idaplicacion);
		$criteria->compare('grupo_contenido_aplicacion_usuario_id_usuario',$this->grupo_contenido_aplicacion_usuario_id_usuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contenido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
