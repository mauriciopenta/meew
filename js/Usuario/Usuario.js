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
var Usuario = function(){
    
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
    var Usuario = function() {
        self.div=$("#divUsuario");
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
        dataTableAct=self.div.find("#dataTableUsuarios").DataTable({
            oLanguage: Meew.getDatatableLang(),
            scrollX: true
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
        
//       
    };    
    /**************************************************************************/
    /********************************** METHODS *******************************/
    /**************************************************************************/
    /**
     * Carga datos del Dispositivo seleccionado en el formulario para editar
     */
    self.cambiaEstadoLogin=function(estado,idpersona){
         $.ajax({
            type: "POST",
            dataType:'json',
            url: 'cambiaEstado',
            data:{"estado":estado,"idpersona":idpersona}
            
//            async:false
        }).done(function(response) {
            if(response.status=="nosession"){
                $.notify("La sesión ha caducado, debe hacer login de nuevo", "warn");
                setTimeout(function(){document.location.href="site/login";}, 3000);
                return;
            }
            else{
                if(response.status=="exito"){
                    msg=response.msg;
                    typeMsg="success";
                    self.loadDataUsuario();
                }
                else{
                    if(response.status=="noexito"){
                         msg=response.msg;
                        typeMsg="warn";
                    }
                    
                }
            }
        }).fail(function(error, textStatus, xhr) {
            msg="Error al crear el dispositivo, el código del error es: "+error.status+" "+xhr;
            typeMsg="error";
            self.div.find("#btnRegDevice").show();
        }).always(function(){
            self.div.find("#btnRegDevice").show();
            $.notify(msg, typeMsg);
        });
    }; 
    /**
     * Cancela edición y limpia formulario
     */
    self.cancelEdition=function(){
        self.div.find("#btnRegDevice").css("display","block");
        self.div.find("#btnEditaDevice").css("display","none");
        self.div.find("#btnCancelaEdicion").css("display","none");
        self.div.find("#device-form").trigger("reset");
        self.div.find("#device-form #Device_id_device").attr("readonly",false);
    };
    
    
    /**************************************************************************/
    /******************************* SYNC METHODS *****************************/
    /**************************************************************************/ 
    
   
    /**
     * Consume webservice registerDevice registrar dispositivo
     */
    self.registerDevice=function(){
        var msg="";
        var typeMsg="";
        var dataDevice=self.div.find("#device-form").serialize();
        //User.showLoading();
        $.ajax({
            type: "POST",
            dataType:'json',
            url: 'registerDevice',
            data:dataDevice,
            beforeSend: function() {
                self.div.find("#device-form #device-form_es_").html("");                                                    
		self.div.find("#device-form #device-form_es_").show();
                self.div.find(".errorMessage").html("");                                                    
		self.div.find(".errorMessage").show();
                self.div.find("#btnRegDevice").hide();
            }
//            async:false
        }).done(function(response) {
            if(response.status=="nosession"){
                $.notify("La sesión ha caducado, debe hacer login de nuevo", "warn");
                setTimeout(function(){document.location.href="site/login";}, 3000);
                return;
            }
            else{
                if(response.status=="exito"){
                    msg="Dispositivo registrado satisfactoriamente";
                    typeMsg="success";
                    self.div.find("#device-form").trigger("reset");
                    estadoGuarda=true;
                    self.loadDataDevice(response.data);
                }
                else{
                    if(response.status=="noexito"){
                         msg=response.msg;
                        typeMsg="warn";
                    }
                    else{
                        msg="Revise la validación del formuario";
                        typeMsg="warn";
                        var errores="Revise lo siguiente<br/><ul>";
                        $.each(response, function(key, val) {
                            errores+="<li>"+val+"</li>";
                            $("#device-form #"+key+"_em_").text(val);                                                    
                            $("#device-form #"+key+"_em_").show();                                                
                        });
                        errores+="</ul>";
                        self.div.find("#device-form #device-form_es_").html(errores);                                                    
                        self.div.find("#device-form #device-form_es_").show(); 
                        self.div.find("#btnRegDevice").show();
                    }
                }
            }
        }).fail(function(error, textStatus, xhr) {
            msg="Error al crear el dispositivo, el código del error es: "+error.status+" "+xhr;
            typeMsg="error";
            self.div.find("#btnRegDevice").show();
        }).always(function(){
            self.div.find("#btnRegDevice").show();
            $.notify(msg, typeMsg);
        });
         
    };
    /**
     * Consume webservice registerDevice registrar dispositivo
     */
    self.editDevice=function(){
        var msg="";
        var typeMsg="";
        var dataDevice=self.div.find("#device-form").serialize();
        //User.showLoading();
        $.ajax({
            type: "POST",
            dataType:'json',
            url: 'editDevice',
            data:dataDevice,
            beforeSend: function() {
                self.div.find("#device-form #device-form_es_").html("");                                                    
		self.div.find("#device-form #device-form_es_").show();
                self.div.find(".errorMessage").html("");                                                    
		self.div.find(".errorMessage").show();
            }
//            async:false
        }).done(function(response) {
            if(response.status=="nosession"){
                $.notify("La sesión ha caducado, debe hacer login de nuevo", "warn");
                setTimeout(function(){document.location.href="site/login";}, 3000);
                return;
            }
            else{
                if(response.status=="exito"){
                    msg="Dispositivo editado satisfactoriamente";
                    typeMsg="success";
                    self.cancelEdition();
                    estadoGuarda=true;
                    self.loadDataDevice(response.data);
                }
                else{
                    if(response.status=="noexito"){
                         msg=response.msg;
                        typeMsg="warn";
                    }
                    else{
                        msg="Revise la validación del formuario";
                        typeMsg="warn";
                        var errores="Revise lo siguiente<br/><ul>";
                        $.each(response, function(key, val) {
                            errores+="<li>"+val+"</li>";
                            $("#device-form #"+key+"_em_").text(val);                                                    
                            $("#device-form #"+key+"_em_").show();                                                
                        });
                        errores+="</ul>";
                        self.div.find("#device-form #device-form_es_").html(errores);                                                    
                        self.div.find("#device-form #device-form_es_").show(); 
                    }
                }
            }
        }).fail(function(error, textStatus, xhr) {
            msg="Error al editar el dispositivo, el código del error es: "+error.status+" "+xhr;
            typeMsg="error";
        }).always(function(){
            $.notify(msg, typeMsg);
        });
         
    };

   /*
    * Carga datos de dispositivo seleccionado al datatable
    * @param array data
    * @returns N.A
    */ 
    self.loadDataUsuario=function(){
        var estado;
        var estadoCode;
        var estadoActual;
        $.ajax({
            type: "POST",
            dataType:'json',
            url: 'consultaPersona'
//            async:false
        }).done(function(response) {
//            console.log(JSON.stringify(response));
            dataTableAct.clear();
            $.each(response,function(key,value){
//                console.log(value.usuario_activo);
                if(value.usuario_activo==1){
                    estado=2;
                    estadoCode="Deshabilitar";
                    estadoActual="Habilitado";
                }
                else{
                    estado=1;
                    estadoCode="Habilitar";
                    estadoActual="Inhabilitado";
                }
                dataTableAct.row.add([
                    value.persona_doc,
                    value.persona_nombre,
                    value.persona_apellidos,
                    value.persona_correo,
                    estadoActual,
                    "<a href=javascript:Usuario.cambiaEstadoLogin('"+estado+"','"+value.id_persona+"');>"+estadoCode+"</a>"
                ]).draw();
            });
        }).fail(function(error, textStatus, xhr) {
            msg="Error al crear el dispositivo, el código del error es: "+error.status+" "+xhr;
            typeMsg="error";
            $.notify(msg, typeMsg);
        });
//        self.arrayDevice=data;
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
    window.Usuario=new Usuario();
});