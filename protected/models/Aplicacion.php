<?php

/**
 * This is the model class for table "aplicacion".
 *
 * The followings are the available columns in table 'aplicacion':
 * @property integer $idaplicacion
 * @property string $nombre
 * @property string $color
 * @property string $url_fondo
 * @property integer $login_activo
 * @property integer $login_facebook
 * @property integer $facebook
 * @property integer $twitter
 * @property integer $instagram
 * @property integer $usuario_id_usuario
 * @property integer $id_plantilla
 * @property integer $estado_app
 * @property integer $nombre_activo
 * @property integer $apellido_activo
 * @property integer $celular_activo
 * @property integer $politicas_privacidad_activo
 * @property integer $nombre_usuario_activo
 * @property string $color_icon
 * @property integer $modulo_viral
 * @property integer $genero
 * @property integer $rango_edad
 * @property string $imagen_splash
 * @property string $imagen_icon
 * @property string $icon_interno
 *
 * The followings are the available model relations:
 * @property TemaSoporte[] $temaSoportes
 */
class Aplicacion extends CActiveRecord
{
const STATUS_DRAFT=1;
const STATUS_PUBLISHED=2;
const STATUS_ARCHIVED=3;
public $paquete;

private $_oldTags;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aplicacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('usuario_id_usuario, estado_app, color_icon', 'required'),
			array('login_activo, login_facebook, facebook, twitter, instagram, usuario_id_usuario, id_plantilla, estado_app, nombre_activo, apellido_activo, celular_activo, politicas_privacidad_activo, nombre_usuario_activo, modulo_viral, genero, rango_edad', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>100),
			array('color, color_icon', 'length', 'max'=>30),
			array('url_fondo, imagen_splash, imagen_icon, icon_interno', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idaplicacion, nombre, color, url_fondo, login_activo, login_facebook, facebook, twitter, instagram, usuario_id_usuario, id_plantilla, estado_app, nombre_activo, apellido_activo, celular_activo, politicas_privacidad_activo, nombre_usuario_activo, color_icon, modulo_viral, genero, rango_edad, imagen_splash, imagen_icon, icon_interno', 'safe', 'on'=>'search'),
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
			'temaSoportes' => array(self::HAS_MANY, 'TemaSoporte', 'id_aplicacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idaplicacion' => 'Idaplicacion',
			'nombre' => 'Nombre',
			'color' => 'Color',
			'url_fondo' => 'Url Fondo',
			'login_activo' => 'Login Activo',
			'login_facebook' => 'Login Facebook',
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'instagram' => 'Instagram',
			'usuario_id_usuario' => 'Usuario Id Usuario',
			'id_plantilla' => 'Id Plantilla',
			'estado_app' => 'Estado App',
			'nombre_activo' => 'Nombre Activo',
			'apellido_activo' => 'Apellido Activo',
			'celular_activo' => 'Celular Activo',
			'politicas_privacidad_activo' => 'Politicas Privacidad Activo',
			'nombre_usuario_activo' => 'Nombre Usuario Activo',
			'color_icon' => 'Color Icon',
			'modulo_viral' => 'Modulo Viral',
			'genero' => 'Genero',
			'rango_edad' => 'Rango Edad',
			'imagen_splash' => 'Imagen Splash',
			'imagen_icon' => 'Imagen Icon',
			'icon_interno' => 'Icon Interno',
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

		$criteria->compare('idaplicacion',$this->idaplicacion);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('url_fondo',$this->url_fondo,true);
		$criteria->compare('login_activo',$this->login_activo);
		$criteria->compare('login_facebook',$this->login_facebook);
		$criteria->compare('facebook',$this->facebook);
		$criteria->compare('twitter',$this->twitter);
		$criteria->compare('instagram',$this->instagram);
		$criteria->compare('usuario_id_usuario',$this->usuario_id_usuario);
		$criteria->compare('id_plantilla',$this->id_plantilla);
		$criteria->compare('estado_app',$this->estado_app);
		$criteria->compare('nombre_activo',$this->nombre_activo);
		$criteria->compare('apellido_activo',$this->apellido_activo);
		$criteria->compare('celular_activo',$this->celular_activo);
		$criteria->compare('politicas_privacidad_activo',$this->politicas_privacidad_activo);
		$criteria->compare('nombre_usuario_activo',$this->nombre_usuario_activo);
		$criteria->compare('color_icon',$this->color_icon,true);
		$criteria->compare('modulo_viral',$this->modulo_viral);
		$criteria->compare('genero',$this->genero);
		$criteria->compare('rango_edad',$this->rango_edad);
		$criteria->compare('imagen_splash',$this->imagen_splash,true);
		$criteria->compare('imagen_icon',$this->imagen_icon,true);
		$criteria->compare('icon_interno',$this->icon_interno,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function search_app()
	{
       
		$sql = "select a.idaplicacion as idaplicacion, a.nombre as nombre, a.id_plantilla as id_plantilla,  b.restricted_package_name as paquete from aplicacion a, push_parametros b where b.id_aplicacion = a.idaplicacion";
	    if($this->idaplicacion!='' && preg_match('/^([0-9])*$/',$this->idaplicacion)){
			$sql=$sql.sprintf(" and a.idaplicacion=%s", (int)$this->idaplicacion);
	
		}
		if($this->nombre!=''){
		$sql.=" and a.nombre LIKE '%". $this->nombre."%'";
		}
		if($this->id_plantilla!='' && preg_match('/^([0-9])*$/',$this->id_plantilla)){
			$sql=$sql.sprintf(" and a.id_plantilla=%s", $this->id_plantilla);
		}
		
		if($this->paquete!=''){
			$sql.=" and b.restricted_package_name LIKE '%".$this->paquete."%'";
        }


    	$sql.="	order by a.idaplicacion asc";
	//	var_dump($sql);die;
		$consulta = Yii::app()->db->createCommand($sql)->queryAll();
		$total = count($consulta);
		$dataProvider = new CSqlDataProvider($sql, array(
				'totalItemCount'=>$total,
				'keyField' => 'idaplicacion',
				'sort'=>array(
					'attributes'=>array(
						 'idaplicacion','nombre')
				),
				'pagination'=>array(
					'pageSize'=>10,
				)
		));
		return $dataProvider;
	}


	public function behaviors()
	{


		return array(
			'preview' => array(
				'class' => 'vendor.z_bodya.yii-image-attachment.ImageAttachmentBehavior',
				// size for image preview in widget
				'previewHeight' => 200,
				'previewWidth' => 300,
				// extension for image saving, can be also tiff, png or gif
				'extension' => 'jpg',
				// folder to store images
				'directory' => Yii::getPathOfAlias('webroot') . '/uploads/',
				// url for images folder
				'url' => Yii::getPathOfAlias('webroot') . '/uploads/',
				// image versions
				'versions' => array(
					'small' => array(
						'resize' => array(200, null),
					),
					'medium' => array(
						'resize' => array(800, null),
					)
				)
			)
		);

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Aplicacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
