<?php

/**
 * This is the model class for table "modulo_app".
 *
 * The followings are the available columns in table 'modulo_app':
 * @property integer $id_modulo_app
 * @property string $nombre_modulo
 * @property string $texto_html
 * @property integer $tipo_modulo
 * @property string $texto_descripcion
 * @property string $texto_button
 * @property integer $aplicacion_idaplicacion
 * @property integer $aplicacion_usuario_id_usuario
 * @property integer $id_contenido
 * @property integer $tipo_menu
 * @property integer $orden
 * @property string $icon
 *
 * The followings are the available model relations:
 * @property Contenido[] $contenidos
 */
class ModuloApp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'modulo_app';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aplicacion_idaplicacion, aplicacion_usuario_id_usuario, tipo_menu', 'required'),
			array('tipo_modulo, aplicacion_idaplicacion, aplicacion_usuario_id_usuario, id_contenido, tipo_menu, orden', 'numerical', 'integerOnly'=>true),
			array('texto_descripcion', 'length', 'max'=>100),
			array('nombre_modulo, texto_html, texto_button, icon', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_modulo_app, nombre_modulo, texto_html, tipo_modulo, texto_descripcion, texto_button, aplicacion_idaplicacion, aplicacion_usuario_id_usuario, id_contenido, tipo_menu, orden, icon', 'safe', 'on'=>'search'),
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
			'contenidos' => array(self::HAS_MANY, 'Contenido', 'id_modulo_app'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_modulo_app' => 'Id Modulo App',
			'nombre_modulo' => 'Nombre Modulo',
			'texto_html' => 'Texto Html',
			'tipo_modulo' => 'Tipo Modulo',
			'texto_descripcion' => 'Texto Descripcion',
			'texto_button' => 'Texto Button',
			'aplicacion_idaplicacion' => 'Aplicacion Idaplicacion',
			'aplicacion_usuario_id_usuario' => 'Aplicacion Usuario Id Usuario',
			'id_contenido' => 'Id Contenido',
			'tipo_menu' => 'Tipo Menu',
			'orden' => 'Orden',
			'icon' => 'Icon',
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

		$criteria->compare('id_modulo_app',$this->id_modulo_app);
		$criteria->compare('nombre_modulo',$this->nombre_modulo,true);
		$criteria->compare('texto_html',$this->texto_html,true);
		$criteria->compare('tipo_modulo',$this->tipo_modulo);
		$criteria->compare('texto_descripcion',$this->texto_descripcion,true);
		$criteria->compare('texto_button',$this->texto_button,true);
		$criteria->compare('aplicacion_idaplicacion',$this->aplicacion_idaplicacion);
		$criteria->compare('aplicacion_usuario_id_usuario',$this->aplicacion_usuario_id_usuario);
		$criteria->compare('id_contenido',$this->id_contenido);
		$criteria->compare('tipo_menu',$this->tipo_menu);
		$criteria->compare('orden',$this->orden);
		$criteria->compare('icon',$this->icon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function search_app()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$sql = "select a.orden as orden, (SELECT MIN(nombre) FROM parametros c WHERE c.codigo=a.tipo_menu AND c.tipo='tipo_menu') as tipo_menu, a.id_modulo_app as id_modulo_app , a.icon as icon , a.nombre_modulo as Nombre, b.nombre as Tipo  from modulo_app a, parametros b where a.tipo_modulo=b.codigo AND b.tipo='modulo' AND a.aplicacion_usuario_id_usuario=".Yii::app()->user->getState('id_usuario')." order by tipo_menu, a.orden asc";
		$consulta = Yii::app()->db->createCommand($sql)->queryAll();
		$total = count($consulta);

		$dataProvider = new CSqlDataProvider($sql, array(
				'totalItemCount'=>$total,
				'keyField' => 'id_modulo_app',
				'sort'=>array(
					'attributes'=>array(
						 'id_modulo_app', 'Nombre', 'Tipo',
					),
				),
				'pagination'=>array(
					'pageSize'=>10,
				),
		));
		return $dataProvider;
	}


	public function behaviors()
    {
        return array(
			'coverBehavior' => array(
                'class' => 'ImageAttachmentBehavior',
                'previewHeight' => 200,
                'previewWidth' => 150,
                'extension' => 'png',
                'directory' => Yii::getPathOfAlias('webroot') . '/images/post-cover/',
                'url' => Yii::app()->request->baseUrl . '/images/post-cover/',
                'versions' => array(
                    'small' => array(
                        'fit' => array(200, 150),
                    )
                )
            ),
			'galleryBehavior' => array(
                'class' => 'GalleryBehavior',
                'idAttribute' => 'id_contenido',
                'versions' => array(
                    'small' => array(
                        'centeredpreview' => array(200, 150),
                    ),
                    'medium' => array(
                        'cresize' => array(800, null),
                    )
                ),
                'name' => true,
				'description' => true,
				'precio_text'=>false,
				'precio'=>false,
				'unidades'=>false,
				'url_video'=>true,
			),
     		'tiendaBehavior' => array(
                'class' => 'GalleryBehavior',
                'idAttribute' => 'id_contenido',
                'versions' => array(
                    'small' => array(
                        'centeredpreview' => array(200, 150),
                    ),
                    'medium' => array(
                        'cresize' => array(800, null),
                    )
                ),
                'name' => true,
				'description' => true,
				'precio_text'=>true,
				'precio'=>true,
				'unidades'=>true,
				'url_video'=>true,
				
			),
        );
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ModuloApp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
