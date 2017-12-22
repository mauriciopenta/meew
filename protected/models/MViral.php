<?php

/**
 * This is the model class for table "m_viral".
 *
 * The followings are the available columns in table 'm_viral':
 * @property integer $id_mviral
 * @property integer $id_emp
 * @property string $mviral_url_fb
 * @property string $mviral_url_tw
 * @property string $mviral_url_inst
 * @property integer $aplicacion_idaplicacion
 * @property integer $aplicacion_usuario_id_usuario
 */
class MViral extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_viral';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'required'),
			array('id_emp, aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'numerical', 'integerOnly'=>true),
			array('mviral_url_fb, mviral_url_tw, mviral_url_inst', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_mviral, id_emp, mviral_url_fb, mviral_url_tw, mviral_url_inst, aplicacion_idaplicacion, aplicacion_usuario_id_usuario', 'safe', 'on'=>'search'),
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
			'id_mviral' => 'Id Mviral',
			'id_emp' => 'Id Emp',
			'mviral_url_fb' => 'Mviral Url Fb',
			'mviral_url_tw' => 'Mviral Url Tw',
			'mviral_url_inst' => 'Mviral Url Inst',
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

		$criteria->compare('id_mviral',$this->id_mviral);
		$criteria->compare('id_emp',$this->id_emp);
		$criteria->compare('mviral_url_fb',$this->mviral_url_fb,true);
		$criteria->compare('mviral_url_tw',$this->mviral_url_tw,true);
		$criteria->compare('mviral_url_inst',$this->mviral_url_inst,true);
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
	 * @return MViral the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
