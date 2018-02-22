<?php

/**
 * This is the model class for table "push_notificaciones".
 *
 * The followings are the available columns in table 'push_notificaciones':
 * @property integer $idpush_notificaciones
 * @property string $titulo
 * @property string $cuerpo
 * @property string $genero
 * @property string $edad
 * @property integer $id_aplicacion
 * @property integer $id_modulo
 */
class PushNotificaciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'push_notificaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, cuerpo, id_aplicacion', 'required'),
			array('id_aplicacion, id_modulo', 'numerical', 'integerOnly'=>true),
			array('titulo, genero, edad', 'length', 'max'=>45),
			array('cuerpo', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idpush_notificaciones, titulo, cuerpo, genero, edad, id_aplicacion, id_modulo', 'safe', 'on'=>'search'),
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
			'idpush_notificaciones' => 'Id push Notificaciones',
			'titulo' => 'Titulo',
			'cuerpo' => 'Cuerpo',
			'genero' => 'Genero',
			'edad' => 'Edad',
			'id_aplicacion' => 'Id Aplicacion',
			'id_modulo' => 'Id Modulo',
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

		$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
		
		$condicions="";

		if($this->idpush_notificaciones!='' && preg_match('/^([0-9])*$/',$this->idpush_notificaciones)){
			$condicions=$condicions.sprintf(" and a.idpush_notificaciones=%s", (int)$this->idpush_notificaciones);
	
		}
		if($this->titulo!=''){
	     	$condicions.=" and a.titulo LIKE '%". $this->titulo."%'";
		}

		if($this->cuerpo!='' ){
			$condicions.=" and a.cuerpo LIKE '%". $this->cuerpo."%'";
		}
		
		if($this->edad!='' ){
			$condicions.=" and (SELECT MIN(nombre) FROM parametros c WHERE c.codigo=a.edad "
			." AND c.tipo='rango_edad') LIKE '%". $this->edad."%'";
		}

		if($this->genero!=''){
			$condicions.=" and (SELECT MIN(nombre) FROM parametros c WHERE c.codigo=a.genero "
			." AND c.tipo='genero') LIKE '%".$this->genero."%'";
        }



		$sql = "select idpush_notificaciones, titulo, cuerpo, "
		."(SELECT MIN(nombre) FROM parametros c WHERE c.codigo=a.genero "
		." AND c.tipo='genero') as genero,"
		."(SELECT MIN(nombre) FROM parametros c WHERE c.codigo=a.edad "
		." AND c.tipo='rango_edad') as edad	,"
		."(SELECT MIN(nombre_modulo) FROM modulo_app d WHERE d.id_modulo_app=a.id_modulo ) as id_modulo"
	
		." from push_notificaciones a where a.id_aplicacion=".$aplicacionFromDb->idaplicacion
	    .$condicions
		." order by a.idpush_notificaciones desc";
		

		$consulta = Yii::app()->db->createCommand($sql)->queryAll();
		$total = count($consulta);

		$dataProvider = new CSqlDataProvider($sql, array(
				'totalItemCount'=>$total,
				'keyField' => 'id_modulo_app',
				'sort'=>array(
					'attributes'=>array(
						 'idpush_notificaciones','titulo', 'cuerpo', 'genero','edad','id_modulo'
					),
				),
				'pagination'=>array(
					'pageSize'=>10,
				),
		));
		return $dataProvider;





	}





	public function search_filter()
	{
		$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
		
		
		

		$sql = "select idpush_notificaciones, titulo, cuerpo, "
		."(SELECT MIN(nombre) FROM parametros c WHERE c.codigo=a.genero "
		." AND c.tipo='genero') as genero,"
		."(SELECT MIN(nombre) FROM parametros c WHERE c.codigo=a.edad "
		." AND c.tipo='rango_edad') as edad	,"
		."(SELECT MIN(nombre_modulo) FROM modulo_app d WHERE d.id_modulo_app=a.id_modulo ) as id_modulo"
		." from push_notificaciones a where a.id_aplicacion=".$aplicacionFromDb->idaplicacion
		." order by a.idpush_notificaciones desc";


		$consulta = Yii::app()->db->createCommand($sql)->queryAll();
		$total = count($consulta);

		$dataProvider = new CSqlDataProvider($sql, array(
				'totalItemCount'=>$total,
				'keyField' => 'id_modulo_app',
				'sort'=>array(
					'attributes'=>array(
						 'idpush_notificaciones','titulo', 'cuerpo', 'genero','edad','id_modulo'
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
	 * @return PushNotificaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
