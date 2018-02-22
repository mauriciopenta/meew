<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PlanForm extends CFormModel
{

	public $id_plan;
	public $plan_nombre;
	public $plan_codigo;
	public $valor_text;
	public $valor;
	public $descripcion;
	public $mensajes_push;
	public $periodo_plan;
	public $plan_code;
	public $moneda;
	public $modulos=[];
	public $isNewRecord=true;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('plan_nombre, periodo_plan, moneda, valor_text, valor, descripcion, mensajes_push',  'required', 'message' => 'Campo requerido'),
			array('valor, mensajes_push', 'numerical', 'integerOnly'=>true),
			array('plan_nombre, plan_codigo', 'length', 'max'=>50),
			array('valor_text, moneda,periodo_plan', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_plan, plan_nombre, periodo_plan, plan_code , moneda, plan_codigo, valor_text, valor, descripcion, mensajes_push', 'safe', 'on'=>'search'),

	    );
	}



	public function save()
	{



	}



}
