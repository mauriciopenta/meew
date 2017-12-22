<?php

/**
 * This is the model class for table "plantilla".
 *
 * The followings are the available columns in table 'plantilla':
 * @property integer $idplantilla
 * @property string $nombre
 * @property integer $max_campos_menu
 * @property integer $min_campos_menu
 * @property integer $min_tabs
 * @property integer $max_tabs
 * @property string $url_imagen
 */
class Plantilla extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plantilla';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idplantilla', 'required'),
			array('idplantilla, max_campos_menu, min_campos_menu, min_tabs, max_tabs', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			array('url_imagen', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idplantilla, nombre, max_campos_menu, min_campos_menu, min_tabs, max_tabs, url_imagen', 'safe', 'on'=>'search'),
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
			'idplantilla' => 'Idplantilla',
			'nombre' => 'Nombre',
			'max_campos_menu' => 'Max Campos Menu',
			'min_campos_menu' => 'Min Campos Menu',
			'min_tabs' => 'Min Tabs',
			'max_tabs' => 'Max Tabs',
			'url_imagen' => 'Url Imagen',
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

		$criteria->compare('idplantilla',$this->idplantilla);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('max_campos_menu',$this->max_campos_menu);
		$criteria->compare('min_campos_menu',$this->min_campos_menu);
		$criteria->compare('min_tabs',$this->min_tabs);
		$criteria->compare('max_tabs',$this->max_tabs);
		$criteria->compare('url_imagen',$this->url_imagen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Plantilla the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
