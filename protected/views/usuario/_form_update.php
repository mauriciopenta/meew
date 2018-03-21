<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/Registro/Actualizar.js",CClientScript::POS_END);

?>

<div>
  <div id="divActualizar" style="width:80%; margin:0 auto;">
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'update-form',
			'enableClientValidation'=>true,
			'enableAjaxValidation'=>true,
			'clientOptions'=>array(
					'validateOnSubmit'=>false)
			)); ?>
					
				<section class="content" >       
				<div class="box box-primary">  
				<div class="box-header with-border">
					
					<h3>Editar Perfil</h3>

				    </div>
					<div class="form" >
					<div class="row" style="padding:15px;">
								
				
						<div class="col-md-12">

									<div class="row">
											<div class="col-md-6">
													<div class="form-group ">
														<?php echo $form->labelEx($model,'id_doc');?>
														<?php 
														$consulta=Parametros::model()->findAll( array('select'=>'codigo, nombre',
														'condition'=> 'tipo=:tipo_doc','params'=> array(':tipo_doc'=>'tipo_documento')));
														$type_list=CHtml::listData($consulta,'codigo','nombre');
														echo $form->dropDownList($model,'id_doc', $type_list, array('class' => 'form-control','empty'=>'Seleccione','disabled'=>'true') ) ?>
														
														<?php echo $form->error($model,'id_doc'); ?>
													</div> 
													<div class="form-group ">
														<?php echo $form->labelEx($model,'persona_doc'); ?>
													
														<?php echo $form->textField($model,'persona_doc', array ('class' => 'form-control','placeholder'=>'Número de documento','disabled'=>'true')); ?>
														
														<?php echo $form->error($model,'persona_doc'); ?>
													</div> 
													<div class="form-group ">
														<?php echo $form->labelEx($model,'usuario'); ?>
														
														<?php echo $form->textField($model,'usuario', array ('class' => 'form-control','placeholder'=>'Digite el nombre de usuario','disabled'=>'true')); ?>
														
														<?php echo $form->error($model,'usuario'); ?>
													</div>
                                            		<div class="form-group ">
														<?php echo $form->labelEx($model,'persona_nombre'); ?>
														<?php echo $form->textField($model,'persona_nombre', array ('class' => 'form-control','placeholder'=>'nombres','disabled'=>'true')); ?>
														<?php echo $form->error($model,'persona_nombre'); ?>
													</div> 
													<div class="form-group ">
														<?php echo $form->labelEx($model,'persona_apellidos'); ?>
														<?php echo $form->textField($model,'persona_apellidos', array ('class' => 'form-control','placeholder'=>'Apellidos','disabled'=>'true')); ?>
														<?php echo $form->error($model,'persona_apellidos'); ?>
													</div> 
											</div>		
											<div class="col-md-6">		
										        	<div class="form-group ">
														<?php echo $form->labelEx($model,'persona_correo'); ?>
														
														<?php echo $form->textField($model,'persona_correo', array ('class' => 'form-control','placeholder'=>'Correo')); ?>
														
														<?php echo $form->error($model,'persona_correo'); ?>
													</div> 
													<div class="form-group ">

													<?php echo $form->labelEx($model,'ubicacion'); ?>
													<?php 
														$consulta=PaisesNombres::model()->findAll(array('order'=>'pais'));
														$type_list=CHtml::listData($consulta,'Codigo','Pais');
														echo $form->dropDownList($model,'ubicacion', $type_list, array('class' => 'form-control','empty'=>'Seleccione',
															'ajax'=>array(
															'type'=>'POST',
															'url'=>CController::createUrl('usuario/SelectPais'),
															'update'=>'#'.CHtml::activeId($model,'region')
															)
														));   ?>
														<?php echo $form->error($model,'ubicacion'); ?>
													</div>


													<div class="form-group ">

													
														<?php echo $form->labelEx($model,'region'); ?>
													
														<?php 
														
														$region = array();
														if(isset($model->ubicacion)){
															
															$region = CHtml::listData(Ciudades::model()->findAll("Paises_Codigo = '$model->ubicacion'"),'idCiudades','Ciudad');
														}
														
														echo $form->dropDownList($model,'region', $region, array('class' => 'form-control','empty'=>'Seleccione') ) ?>
													
														<?php echo $form->error($model,'region'); ?>
													</div>

													<div class="form-group ">
														<?php echo $form->labelEx($model,'telefono'); ?>
														<?php echo $form->textField($model,'telefono', array ('class' => 'form-control')); ?>
														<?php echo $form->error($model,'telefono'); ?>
													</div>

													


											</div>
								</div>
							</div>
						</div>
						</div>	
						<br>
						</div>		
						<div class="box box-primary">  
							<div class="box-header with-border">
							<div class="box-header with-border">
			
								<h3>Tarjeta de Credito</h3>
							</div>   
								<div class="col-md-12">
									<div class="row">
											<div class="col-md-6">
													<div class="form-group ">
																<?php echo $form->labelEx($model,'tipo_tarjeta');?>
																<?php 
																$consulta=Parametros::model()->findAll( array('select'=>'codigo, nombre',
																'condition'=> 'tipo=:tipo','params'=> array(':tipo'=>'tarjeta_credito')));
																$type_list=CHtml::listData($consulta,'codigo','nombre');
																echo $form->dropDownList($model,'tipo_tarjeta', $type_list, array('class' => 'form-control','empty'=>'Seleccione') ) ?>
																<?php echo $form->error($model,'tipo_tarjeta'); ?>
													</div> 
						

													<div class="form-group ">
														<?php echo $form->labelEx($model,'numero_tarjeta'); ?>
														<?php echo $form->textField($model,'numero_tarjeta', array ('class' => 'form-control', 'id'=>"num_tarjeta")); ?>
														<?php echo $form->error($model,'numero_tarjeta'); ?>
														<div id="type"></div>
												
													</div>

												

													<div class="form-group" >
														<label>Fecha Expiración</label>
														<div class="row">
														<div class="col-sm-4">
															<?php
																$m = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');
																echo $form->dropDownList($model,'fecha_vencimiento_mes', $m , array('class' =>'form-control','style'=>'height:30px;','empty'=>'Mes') );
															?>
														</div>	
														<div class="col-sm-4">
															<?php
															$anio = array();
																$anio_actual=date("Y");
																for ($i=0; $i < 30; $i++) { 
																	$anio[ $anio_actual+$i]=$anio_actual+$i;
																}
																echo $form->dropDownList($model,'fecha_vencimiento_anio', $anio , array('class' =>'form-control','style'=>'height:30px;','empty'=>'Año') );
															?>
														</div>	
														<div class="col-sm-4"></div>
														
															<?php echo $form->error($model,'fecha_vencimiento_mes'); ?>
															<?php echo $form->error($model,'fecha_vencimiento_anio'); ?>
													</div>
												</div> 
											

									</div> 				
										
										<div class="col-md-6">
										        <div class="form-group ">
													<?php echo $form->labelEx($model,'nombre_tarjeta'); ?>
													<?php echo $form->textField($model,'nombre_tarjeta', array ('class' => 'form-control')); ?>
													<?php echo $form->error($model,'nombre_tarjeta'); ?>
												</div>
												<div class="form-group ">
													<?php echo $form->labelEx($model,'codigo_tarjeta'); ?>
													<?php echo $form->textField($model,'codigo_tarjeta', array ('class' => 'form-control')); ?>
													<?php echo $form->error($model,'codigo_tarjeta'); ?>
												</div>
										</div> 
											
									</div> 
								</div> 
							</div> 
							<br>
							</div> 	
							<div class="box box-primary">  
								<div class="box-header with-border">
									<div class="box-header with-border">
										<h3>Plan</h3>
									</div>   
									<div class="row" style="padding:15px;">   

									<?php
									$type_list=Plan::model()->findAll();
									if(!empty($type_list)){
										foreach($type_list as $plan):
										?>
										<div class="col-xs-12 col-sm-6 col-md-4" >

												<div class="form-group center_content" > 
												<label>
													
													<div class="plan">
													<div class="titulo"><?php echo $plan['plan_nombre'];?> </div>
													<div class="valor">
															<?php 
																$sql1 = "select codigo, nombre from parametros b where  b.tipo='periodo_plan' and b.codigo='".$plan['periodo_plan']."'";
																$consulta1 = Yii::app()->db->createCommand($sql1)->queryAll();
																echo  $plan['valor_text']." ".$plan['moneda']."/".$consulta1[0]['nombre'];
															?>
													</div>
													<div class="descripcion"> <?php echo $plan['descripcion'];?></div>
													
													<ul class="listplan">
															<?php
																$sql = "select idparametros ,codigo, nombre, (SELECT count(1) FROM plan_has_parametros a WHERE a.parametros_idparametros=b.idparametros AND a.plan_id_plan=".$plan['id_plan'].") as estado  from parametros b where  b.tipo='modulo'";
																$consulta = Yii::app()->db->createCommand($sql)->queryAll();
																
																foreach($consulta as $modulo):
																	if($modulo['estado']==1){
																		echo '<li>Módulo '.$modulo['nombre']."</li>";
																	}
																endforeach;
															?>
																
															<li><?php echo $plan['mensajes_push'];?> Notificaciones </li>
														<ul>												
														</div>
													<?php	
														echo $form->radioButton($model, 'plan', array(
															'class'=>'minimal',
															'value'=>$plan['plan_code'],
															'uncheckValue'=>null
														));
													?>
												</label>  
												</div>
										</div>
										<?php  endforeach;
									}
								?> 
                             	<?php echo $form->error($model,'plan'); ?>
								</div> 
								<div id="error_plan" class="valida_plan" >  </div>

							

								<div class="form-group ">
									<?php echo CHtml::submitButton('Guardar', array ('class' => 'btn btn-info pull-right')); ?>
								</div>	
							</div> 
						</div> 
				</div> 
			</div>
		</div>
		</div>
		</section>    
		<?php $this->endWidget();?>
	</div><!-- form -->
</div>