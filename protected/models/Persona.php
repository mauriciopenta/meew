<?php

/**
 * This is the model class for table "persona".
 *
 * The followings are the available columns in table 'persona':
 * @property integer $id_persona
 * @property integer $id_doc
 * @property string $persona_doc
 * @property string $persona_nombre
 * @property string $persona_apellidos
 * @property string $persona_correo
 * @property integer $id_genero
 * @property integer $id_rango_edad
 * @property integer $id_aplicacion
 */
class Persona extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'persona';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_doc, persona_nombre, persona_apellidos, persona_correo', 'required'),
            array('id_doc, id_genero, id_rango_edad, id_aplicacion', 'numerical', 'integerOnly'=>true),
            array('persona_doc, persona_nombre, persona_apellidos, persona_correo', 'length', 'max'=>50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_persona, id_doc, persona_doc, persona_nombre, persona_apellidos, persona_correo, id_genero, id_rango_edad, id_aplicacion', 'safe', 'on'=>'search'),
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
            'id_persona' => 'Id Persona',
            'id_doc' => 'Id Doc',
            'persona_doc' => 'Persona Doc',
            'persona_nombre' => 'Persona Nombre',
            'persona_apellidos' => 'Persona Apellidos',
            'persona_correo' => 'Persona Correo',
            'id_genero' => 'Id Genero',
            'id_rango_edad' => 'Id Rango Edad',
            'id_aplicacion' => 'Id Aplicacion',
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

        $criteria->compare('id_persona',$this->id_persona);
        $criteria->compare('id_doc',$this->id_doc);
        $criteria->compare('persona_doc',$this->persona_doc,true);
        $criteria->compare('persona_nombre',$this->persona_nombre,true);
        $criteria->compare('persona_apellidos',$this->persona_apellidos,true);
        $criteria->compare('persona_correo',$this->persona_correo,true);
        $criteria->compare('id_genero',$this->id_genero);
        $criteria->compare('id_rango_edad',$this->id_rango_edad);
        $criteria->compare('id_aplicacion',$this->id_aplicacion);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Persona the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}