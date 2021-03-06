<?php

/**
 * This is the model class for table "tema_soporte".
 *
 * The followings are the available columns in table 'tema_soporte':
 * @property integer $idtema_soporte
 * @property string $titulo
 * @property string $descripcion
 * @property string $fecha
 * @property integer $id_aplicacion
 * @property integer $id_padre
 * @property integer $hijo
 *
 * The followings are the available model relations:
 * @property SoporteApp[] $soporteApps
 * @property Aplicacion $idAplicacion
 */
class TemaSoporte extends CActiveRecord
{

  public $titulo_agregar="";
  public $descripcion_agregar="";
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tema_soporte';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, descripcion', 'required'),
			array('id_aplicacion, id_padre, hijo', 'numerical', 'integerOnly'=>true),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idtema_soporte, titulo, descripcion, fecha, id_aplicacion, id_padre, hijo', 'safe', 'on'=>'search'),
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
			'soporteApps' => array(self::HAS_MANY, 'SoporteApp', 'id_tema'),
			'idAplicacion' => array(self::BELONGS_TO, 'Aplicacion', 'id_aplicacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idtema_soporte' => 'Idtema Soporte',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripcion',
			'fecha' => 'Fecha',
			'id_aplicacion' => 'Id Aplicacion',
			'id_padre' => 'Id Padre',
			'hijo' => 'Hijo',
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
	public function search_app()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idtema_soporte',$this->idtema_soporte);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('id_aplicacion',$this->id_aplicacion);
		$criteria->compare('hijo',0);
		$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
		
		$criteria->compare('id_aplicacion',$aplicacionFromDb->idaplicacion,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function search_subtema($id)
	{
		$sql = "select * from tema_soporte where id_padre=".$id;
		$consulta = Yii::app()->db->createCommand($sql)->queryAll();
		$total = count($consulta);
		$dataProvider = new CSqlDataProvider($sql, array(
			'totalItemCount'=>$total,
			'keyField' => 'idtema_soporte',
			'sort'=>array(
				'attributes'=>array(
					'idtema_soporte', 'titulo', 'descripcion'
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		return $dataProvider;
	}






	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TemaSoporte the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
