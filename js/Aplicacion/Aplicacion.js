/**
 * Actividad v.1.6.2
 * Pseudo-Class to manage all the Actividad process
 * @changelog
 *      - 1.6.2: Se reduce la cantidad de consultas para el barrio
 *      - 1.6.1: Función lambda para retornar la dirección
 *      - 1.6.0: Se agrega notificaciones y búsqueda de barrios
 *      - 1.5.1: Se agrega la verificación de si un elemento existe
 * @param {object} params Object with the class parameters
 * @param {function} callback Function to return the results
 */
var Aplicacion = function(){
    
    /**************************************************************************/
    /******************************* ATTRIBUTES *******************************/
    /**************************************************************************/
    var self = this;
    var estadoGuarda;
    self.arrayUsuario=[];
    //DOM attributes
    /**************************************************************************/
    /********************* CONFIGURATION AND CONSTRUCTOR **********************/
    /**************************************************************************/
    //Mix the user parameters with the default parameters
    var def = {
        ajaxUrl:'../'
    };
   
    /**
     * Constructor Method 
     */
    var Aplicacion = function() {
        self.div=$("#divAplicacion");
        setDefaults();
    }();
     
    /**************************************************************************/
    /****************************** SETUP METHODS *****************************/
    /**************************************************************************/
    /**
     * Set defaults for Actividad
     * @returns {undefined}
     */
    function setDefaults(){
        var estadoGuarda ;
        //Inicializa datatable
      
        $( "#sortable" ).sortable({
            update: function( event, ui ) {
               /*
                var postdata=  $(this).sortable('serialize');
               
                $.ajax({
                    'url': 'save',
                    'type': 'post',
                    'data': postdata,
                    'success': function(data){
                        
                    },
                    'error': function(request, status, error){
                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
               
               */
            }
        });
   
        $( "#sortable" ).disableSelection();
       
        $( "#sortable2" ).sortable({
            update: function( event, ui ) {
            /*
                var postdata=  $(this).sortable('serialize');
                
                 $.ajax({
                     'url': 'save',
                     'type': 'post',
                     'data': postdata,
                     'success': function(data){
                         
                     },
                     'error': function(request, status, error){
                         alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                     }
                 });
                 */

            }
        });
        $( "#sortable2" ).disableSelection();
        

        $(document).on('click','#save-reorder',function(){
            var postdata=  $( "#sortable" ).sortable('toArray');
            var postdata2=  $( "#sortable2" ).sortable('toArray');
            
            var list = new Array();
           
            for (i = 0; i < postdata.length; i++) { 
                list.push({ 'orden':''+(i+1),'id': postdata[i] });
            }
            for (j = 0; j < postdata2.length; j++) { 

                list.push({ 'orden':''+(j+1),'id': postdata2[j] });
            }
          
           
            var dataorden=JSON.stringify(list);
            
             $.ajax({
                 'url': 'save',
                 'type': 'post',
                 'data': {data:dataorden},
                 'success': function(data){
                     
                 },
                 'error': function(request, status, error){
                 }
             });
          
        
        });






        
        self.div.find("#usuario-form").change(function (){
            estadoGuarda=false;
        });
        self.div.find("#btnRegUsuario").click(function(){
            self.registerDevice();
        });
        self.div.find("#btnEditaUsuario").hide();
        self.div.find("#btnCancelaEdicion").hide();
        
        self.div.find("#btnEditaUsuario").click(function(){
            self.editDevice();
        });
        self.div.find("#btnCancelaEdicion").click(function (){
            self.cancelEdition();
        });

        self.div.find(".my-colorpicker1").colorpicker();
        self.div.find(".my-colorpicker2").colorpicker();
       
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
          })
          //Red color scheme for iCheck
          $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
          })
          //Flat red color scheme for iCheck
          $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
          })
//       
    };    
    
   
 
    /**************************************************************************/
    /******************************* DOM METHODS ******************************/
    /**************************************************************************/
    
    /**************************************************************************/
    /****************************** OTHER METHODS *****************************/
    /**************************************************************************/
    
};
$(document).ready(function() {
    window.Aplicacion=new Aplicacion();
});