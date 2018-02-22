<?php

/**
 * This is the model class for table "soporte_app".
 *
 * The followings are the available columns in table 'soporte_app':
 * @property integer $idsoporte_app
 * @property string $mensaje
 * @property string $respuesta
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 * @property integer $id_tema
 * @property integer $id_subtema
 * @property integer $id_aplicacion
 * @property integer $id_usuario
 *
 * The followings are the available model relations:
 * @property TemaSoporte $idTema
 */
class SoporteApp extends CActiveRecord
{

	public $usuario="";
	public $tema="";
	public $subtema="";
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'soporte_app';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mensaje, fecha_creacion, id_tema, id_aplicacion', 'required'),
			array('id_tema, id_subtema, id_aplicacion, id_usuario', 'numerical', 'integerOnly'=>true),
			array('respuesta, fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idsoporte_app, mensaje, respuesta, fecha_creacion, fecha_modificacion, id_tema, id_subtema, id_aplicacion, id_usuario', 'safe', 'on'=>'search'),
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
			'idTema' => array(self::BELONGS_TO, 'TemaSoporte', 'id_tema'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idsoporte_app' => 'Idsoporte App',
			'mensaje' => 'Mensaje',
			'respuesta' => 'Respuesta',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_modificacion' => 'Fecha Modificacion',
			'id_tema' => 'Id Tema',
			'id_subtema' => 'Id Subtema',
			'id_aplicacion' => 'Id Aplicacion',
			'id_usuario' => 'Id Usuario',
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
		$criteria->alias = 'a';
		//var_dump(json_encode($_GET));die;
		
		$this->usuario = $_GET['SoporteApp']['usuario'];
		$this->tema = $_GET['SoporteApp']['tema'];
		$this->subtema = $_GET['SoporteApp']['subtema'];
		
		$join="";
        if($this->usuario==""){		
	    	 $join='JOIN Usuario c ON (c.id_usuario=a.id_usuario)';
		}else{
			 $join=" JOIN Usuario c ON (c.id_usuario=a.id_usuario and c.usuario like '%".$this->usuario."%' )";
    		
		}


		if($this->tema==""){
			$join.=' JOIN tema_soporte b ON b.idtema_soporte=a.id_tema';
		}else{
			$join.=" JOIN tema_soporte b ON b.idtema_soporte=a.id_tema and b.titulo like '%".$this->tema."%'";
		}




		if($this->subtema!=""){
			$where=" (SELECT MIN(titulo) FROM tema_soporte f WHERE f.idtema_soporte=a.id_subtema) like '%".$this->subtema."%'";
			$criteria->condition =$where;
		}
		$criteria->join=$join;
		$criteria->select='a.idsoporte_app, a.mensaje, a.respuesta, a.fecha_creacion, a.fecha_modificacion, a.id_tema,a.id_subtema , a.id_aplicacion, c.usuario as usuario, b.titulo as tema, (SELECT MIN(titulo) FROM tema_soporte e WHERE e.idtema_soporte=a.id_subtema) as subtema'; //, d.titulo as subtema ';


		$criteria->compare('a.idsoporte_app',$this->idsoporte_app);
		$criteria->compare('a.mensaje',$this->mensaje,true);
		$criteria->compare('a.respuesta',$this->respuesta,true);
		$criteria->compare('a.fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('a.fecha_modificacion',$this->fecha_modificacion,true);
		$criteria->compare('b.id_tema',$this->id_tema);
		$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
		$criteria->compare('a.id_aplicacion',$aplicacionFromDb->idaplicacion,true);
		
		


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function search_Soporte()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->alias = 'a';

		$this->usuario = $_GET['MContacto']['usuario'];
        if($this->usuario==""){		
		  $criteria->join='INNER JOIN Usuario c ON (c.id_usuario=a.aplicacion_usuario_id_usuario)';
	//	  var_dump("1");die;
		}else{
		 $criteria->join="INNER JOIN Usuario c ON (c.id_usuario=a.aplicacion_usuario_id_usuario and c.usuario like '%".$this->usuario."%' )";
	//	 var_dump("2");die;
		}

		$criteria->select='a.idsoporte_app, a.mensaje, a.respuesta, a.fecha_creacion, a.fecha_modificacion, a.id_tema, c.usuario as usuario ';


		$criteria->compare('idsoporte_app',$this->idsoporte_app);
		$criteria->compare('mensaje',$this->mensaje,true);
		$criteria->compare('respuesta',$this->respuesta,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion,true);
		$criteria->compare('id_tema',$this->id_tema);
		$aplicacionFromDb= Aplicacion::model()->findByAttributes(array('usuario_id_usuario'=>Yii::app()->user->getState('id_usuario')));
		
		$criteria->compare('id_aplicacion',$aplicacionFromDb->idaplicacion,true);
	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SoporteApp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
