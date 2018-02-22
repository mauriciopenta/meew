<?php
/**
 * @var $this GalleryManager
 * @var $model GalleryPhoto
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
?>
<?php echo CHtml::openTag('div', $this->htmlOptions); ?>
  
	<div class="box box-primary"  >
		<div class="box-header with-border">
			<h3 class="box-title"> Recursos</h3>
		</div>
		<div class="box-body">
		<div id="mdlArchivos" class="modal fade">
							
	   </div>	

			<div class="row">
					<div class="col-md-4">
					      <label>Splash (2732 x2732)</label>
						 
						  <div id="splash" ></div>
						  <p> (Ten en cuenta que la imagen se adaptará a cada dispositivo, por lo tanto, intente dejar lo que quiere que se visualice en el centro.)</p>
				
					</div>
				
					<div class="col-md-4">
				        <label>Icono Aplicación (1024x1024 o 512x512)</label>
						<div id="icon_app" ></div>
						<p>Este será el ícono que verá el usuario al instalar tu aplicación.</p>
					</div>
                
                    <div class="col-md-4">
                         <label>Icono Login y Header (4:1)</label>
						<div id="icon_header" ></div>
		           </div>
				
					

			  </div> 
			  <br>
        
		</div><!-- form -->
	   </div>
	   </div>
	 </div>
<?php echo CHtml::closeTag('div'); ?>