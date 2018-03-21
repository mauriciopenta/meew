<?php

/**
 * This is the model class for table "transaccion".
 *
 * The followings are the available columns in table 'transaccion':
 * @property integer $idtransaccion
 * @property string $transactionIdPayu
 * @property string $concepto
 * @property string $valor
 * @property string $estado
 * @property string $responseCode
 * @property string $code
 * @property string $json
 * @property string $id_usuario
 * @property string $id_pador_payu
 */
class Transaccion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transaccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transactionIdPayu', 'required'),
			array('transactionIdPayu', 'length', 'max'=>205),
			array('concepto, responseCode, code, id_usuario, id_pador_payu', 'length', 'max'=>200),
			array('valor', 'length', 'max'=>10),
			array('estado', 'length', 'max'=>50),
			array('json', 'length', 'max'=>800),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idtransaccion, transactionIdPayu, concepto, valor, estado, responseCode, code, json, id_usuario, id_pador_payu', 'safe', 'on'=>'search'),
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
			'idtransaccion' => 'Idtransaccion',
			'transactionIdPayu' => 'Transaction Id Payu',
			'concepto' => 'Concepto',
			'valor' => 'Valor',
			'estado' => 'Estado',
			'responseCode' => 'Response Code',
			'code' => 'Code',
			'json' => 'Json',
			'id_usuario' => 'Id Usuario',
			'id_pador_payu' => 'Id Pador Payu',
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

		$criteria->compare('idtransaccion',$this->idtransaccion);
		$criteria->compare('transactionIdPayu',$this->transactionIdPayu,true);
		$criteria->compare('concepto',$this->concepto,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('responseCode',$this->responseCode,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('json',$this->json,true);
		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('id_pador_payu',$this->id_pador_payu,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transaccion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
