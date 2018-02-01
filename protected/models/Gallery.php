<?php

/**
 * This is the model class for table "gallery".
 *
 * The followings are the available columns in table 'gallery':
 * @property integer $id
 * @property string $versions_data
 * @property integer $name
 * @property integer $description
 * @property integer $precio
 * @property integer $precio_text
 * @property integer $url_video
 * @property integer $unidades
 *
 * The followings are the available model relations:
 * @property GalleryPhoto[] $galleryPhotos
 *
 * @property array $versions Settings for image auto-generation
 * @example
 *  array(
 *       'small' => array(
 *              'resize' => array(200, null),
 *       ),
 *      'medium' => array(
 *              'resize' => array(800, null),
 *      )
 *  );
 *
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class Gallery extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gallery the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        if ($this->dbConnection->tablePrefix !== null)
            return '{{gallery}}';
        else
            return 'gallery';
    }



	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			array('name, description, precio, precio_text, url_video, unidades', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, versions_data, name, description, precio, precio_text, url_video, unidades', 'safe', 'on' => 'search'),
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
            'galleryPhotos' => array(self::HAS_MANY, 'GalleryPhoto', 'gallery_id', 'order' => '`rank` asc'),
        );
    }




  
   	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'versions_data' => 'Versions Data',
			'name' => 'Name',
			'description' => 'Description',
			'precio' => 'Precio',
			'precio_text' => 'Precio Text',
			'url_video' => 'Url Video',
			'unidades' => 'Unidades',
		);
	}



    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('versions_data',$this->versions_data,true);
		$criteria->compare('name',$this->name);
		$criteria->compare('description',$this->description);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('precio_text',$this->precio_text);
		$criteria->compare('url_video',$this->url_video);
		$criteria->compare('unidades',$this->unidades);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


  




    private $_versions;

    public function getVersions()
    {
        if (empty($this->_versions)) $this->_versions = unserialize($this->versions_data);
        return $this->_versions;
    }

    public function setVersions($value)
    {
        $this->_versions = $value;
    }

    protected function beforeSave()
    {
        if (!empty($this->_versions))
            $this->versions_data = serialize($this->_versions);
        return parent::beforeSave();
    }

    public function delete()
    {
        foreach ($this->galleryPhotos as $photo) {
            $photo->delete();
        }
        return parent::delete();
    }


}