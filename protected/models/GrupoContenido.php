<?php

/**
 * This is the model class for table "grupo_contenido".
 *
 * The followings are the available columns in table 'grupo_contenido':
 * @property integer $idarticulo
 * @property integer $nombre
 * @property string $texto_html
 * @property string $tipo
 * @property integer $aplicacion_idaplicacion
 * @property integer $aplicacion_usuario_id_usuario
 */
class GrupoContenido extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'grupo_contenido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idarticulo, aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'required'),
			array('idarticulo, nombre, aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'numerical', 'integerOnly'=>true),
			array('texto_html', 'length', 'max'=>3000),
			array('tipo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idarticulo, nombre, texto_html, tipo, aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'safe', 'on'=>'search'),
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
			'idarticulo' => 'Idarticulo',
			'nombre' => 'Nombre',
			'texto_html' => 'Texto Html',
			'tipo' => 'Tipo',
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

		$criteria->compare('idarticulo',$this->idarticulo);
		$criteria->compare('nombre',$this->nombre);
		$criteria->compare('texto_html',$this->texto_html,true);
		$criteria->compare('tipo',$this->tipo,true);
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
	 * @return GrupoContenido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
