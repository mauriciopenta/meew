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
    var lat = null;
    var lng = null;
    var map = null;
    var geocoder = null;
    var marker = null;

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
        start: function(event, ui) {

        },
        update: function(event, ui) {
            var postdata=  $( "#sortable" ).sortable('toArray');

            for (i = 0; i < postdata.length; i++) { 
                 console.log("#slide_"+postdata[i]  ); 
                 $("#slide_"+postdata[i]).text((i+1));
            }
        },
        change: function(event, ui) {

           
        
        }
    });



        $( "#sortable" ).disableSelection();
        $( "#sortable2" ).sortable();
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
          $('input').iCheck('update');
        
            if($("#viral").is(':checked')){
                $("#facebook").css("display","block");
                $("#instagram").css("display","block");
                $("#twitter").css("display","block");
            }else {
                $("#facebook").css("display","none");
                $("#instagram").css("display","none");
                $("#twitter").css("display","none");
            }
       


            $('input').on('ifUnchecked', function(event){
               if(this.id=="viral"){
               
                    console.log("no  checked");
                        $("#facebook").css("display","none");
                        $("#instagram").css("display","none");
                        $("#twitter").css("display","none");
               }
           });

           $('input').on('ifChecked', function(event){
            if(this.id=="viral"){
            
                 console.log("checked");
                     $("#facebook").css("display","block");
                     $("#instagram").css("display","block");
                     $("#twitter").css("display","block");
            }
        });

        lat = jQuery('#lat').val();
        lng = jQuery('#long').val();
        //Asignamos al evento click del boton la funcion codeAddress
        jQuery('#pasar').click(function(){
           codeAddress();
           return false;
        });


        var pais = document.getElementById('pais');
        var telf = document.getElementById('telf');

        pais.onchange = function(e) {
                telf.value = escape("+")+this.value;
                if((this.value).trim() != '') {
                    telf.disabled = false;
            } else {
                    telf.disabled = true
            }
        }

        telf.onkeyup = function(e) {
                var nums_v = this.value.match(/\d+/g);
            if (nums_v != null) {
                this.value = escape("+")+((nums_v).toString().replace(/\,/, ''));
            } else { 
                    this.value = escape("+")+pais.value;
                }
        }


        initialize();
            
    };    
   

    



    /**************************************************************************/
    /******************************* DOM METHODS ******************************/
    /**************************************************************************/
    
    /**************************************************************************/
    /****************************** OTHER METHODS *****************************/
    /**************************************************************************/
    function initialize() {
        
         geocoder = new google.maps.Geocoder();
           
          //Si hay valores creamos un objeto Latlng
          if(lat !='' && lng != '')
         {
            var latLng = new google.maps.LatLng(lat,lng);
         }
         else
         {
           //Si no creamos el objeto con una latitud cualquiera como la de Mar del Plata, Argentina por ej
            var latLng = new google.maps.LatLng(37.0625,-95.677068);
         }
         //Definimos algunas opciones del mapa a crear
          var myOptions = {
             center: latLng,//centro del mapa
             zoom: 15,//zoom del mapa
             mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
           };
           //creamos el mapa con las opciones anteriores y le pasamos el elemento div
           map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            
           //creamos el marcador en el mapa
           marker = new google.maps.Marker({
               map: map,//el mapa creado en el paso anterior
               raiseOnDrag: true,
               title: "Mueva el marcador a la posición.",
            
               position: latLng,//objeto con latitud y longitud
               draggable: true //que el marcador se pueda arrastrar
           });
           google.maps.event.addListener(marker, 'dragend', function(){
            
            updatePosition(marker.getPosition(),true);
          });
          //función que actualiza los input del formulario con las nuevas latitudes
          //Estos campos suelen ser hidden
           updatePosition(latLng);
            
            
       }
        
       //funcion que traduce la direccion en coordenadas
       function codeAddress() {
            
           //obtengo la direccion del formulario
           var address = document.getElementById("direccion").value;
           //hago la llamada al geodecoder
           geocoder.geocode( { 'address': address}, function(results, status) {
            
           //si el estado de la llamado es OK
           if (status == google.maps.GeocoderStatus.OK) {
               //centro el mapa en las coordenadas obtenidas
               map.setCenter(results[0].geometry.location);
               //coloco el marcador en dichas coordenadas
             
              
               marker.setPosition(results[0].geometry.location);

               //actualizo el formulario      
               updatePosition(results[0].geometry.location,false);
                
               //Añado un listener para cuando el markador se termine de arrastrar
               //actualize el formulario con las nuevas coordenadas


               google.maps.event.addListener(marker, 'dragend', function(){
                 
                   updatePosition(marker.getPosition(),true);
               });



         } else {
             //si no es OK devuelvo error
             alert("No podemos encontrar la direcci&oacute;n, error: " + status);
         }
       });
     }
      
     //funcion que simplemente actualiza los campos del formulario
     function updatePosition(latLng,update_addres)
     {
       
        document.getElementById("lat").value=latLng.lat();
        document.getElementById("long").value=latLng.lng();
          $('#lat').val(latLng.lat());
          $('#long').val(latLng.lng());
       if(update_addres){
          geocoder.geocode({'latLng': latLng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
            var address=results[0]['formatted_address'];
            $('#direccion').val(address);
            document.getElementById("direccion").value=address;
           
            }
            });
        }
      
     }

};
$(document).ready(function() {
    window.Aplicacion=new Aplicacion();
});