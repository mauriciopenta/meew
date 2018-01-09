<?php

/**
 * This is the model class for table "contenido".
 *
 * The followings are the available columns in table 'contenido':
 * @property integer $idcontenido
 * @property integer $id_tipo_contenido
 * @property string $titulo
 * @property string $url
 * @property string $texto
 * @property integer $precio
 * @property string $texto_precio
 * @property string $descripcion
 * @property integer $id_modulo_app
 *
 * The followings are the available model relations:
 * @property ModuloApp $idModuloApp
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
			array('idcontenido, id_tipo_contenido, titulo, id_modulo_app', 'required'),
			array('idcontenido, id_tipo_contenido, precio, id_modulo_app', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>500),
			array('url', 'length', 'max'=>200),
			array('texto', 'length', 'max'=>2000),
			array('texto_precio', 'length', 'max'=>45),
			array('descripcion', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcontenido, id_tipo_contenido, titulo, url, texto, precio, texto_precio, descripcion, id_modulo_app', 'safe', 'on'=>'search'),
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
			'idModuloApp' => array(self::BELONGS_TO, 'ModuloApp', 'id_modulo_app'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcontenido' => 'Idcontenido',
			'id_tipo_contenido' => 'Id Tipo Contenido',
			'titulo' => 'Titulo',
			'url' => 'Url',
			'texto' => 'Texto',
			'precio' => 'Precio',
			'texto_precio' => 'Texto Precio',
			'descripcion' => 'Descripcion',
			'id_modulo_app' => 'Id Modulo App',
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
		$criteria->compare('id_tipo_contenido',$this->id_tipo_contenido);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('texto',$this->texto,true);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('texto_precio',$this->texto_precio,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('id_modulo_app',$this->id_modulo_app);

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



	public function behaviors()
	{
		return array(
			'image' => array(
				'class' => 'ext.AttachmentBehavior.AttachmentBehavior',
				# Should be a DB field to store path/filename
				'attribute' => 'url',
				# Default image to return if no image path is found in the DB
				//'fallback_image' => 'images/sample_image.gif',
				'path' => "uploads/:model/:id.:ext",
				'processors' => array(
					array(
						# Currently GD Image Processor and Imagick Supported
						'class' => 'ImagickProcessor',
						'method' => 'resize',
						'params' => array(
							'width' => 310,
							'height' => 150,
							'keepratio' => true
						)
					)
				),
				'styles' => array(
					# name => size 
					# use ! if you would like 'keepratio' => false
					'thumb' => '!100x60',
				)			
			),
		);
	}
}
