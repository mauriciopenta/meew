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
var Registro = function(){
    
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
    var Registro = function() {
        self.div=$("#divRegistro");
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
        


        

        $("#num_tarjeta").keyup(function(e){
            var num = $(this).val().toString();
            var charCount = num.length;
         
            /* VALIDACION DE TIPO */

           
            if(charCount == 1) { 
                if(num == "4" ){
                  //  $("#type").html("VISA");
                }
            }
            if(charCount == 2){
                if(num == "34" || num == "37"){
                   // $("#type").html("AMEX");
                } else if( num == "51" || num == "55" || num == "53" ){
                   // $("#type").html("MASTER CARD");
                } else if( num == "55" ){
                   // $("#type").html("DISCOVER");
                }
            }
            if(charCount == 3){
                if(num == "644"){
                    // $("#type").html("DISCOVER")
                }
            }
            if(charCount == 4){
                if(num == "6011"){
                  //  $("#type").html("DISCOVER");
                }
            }
            /* !VALIDACION DE TIPO */
         
            /* ALGORITMO */
            if(charCount == 13 || charCount == 14 || charCount == 15 || charCount == 16){
                var valid = isValid(num, charCount);
                if(valid){
                    $("#type").html("valida");
                   // $("input").attr("name", "checkout.cardNumber").attr("class", "valid-card");
                } else {
                    $("#type").html("invalida");
                   // $("input").attr("name", "checkout.cardNumber").attr("class", "invalid-card");
                }
            }
            /* !ALGORITMO */    
        });
         
        function isValid(ccNum, charCount){
            var double = true;
            var numArr = [];
            var sumTotal = 0;
            for(i=0; i<charCount; i++){
                var digit = parseInt(ccNum.charAt(i));
         
                if(double){
                    digit = digit * 2;
                    digit = toSingle(digit);
                    double = false;
                } else {
                    double = true;
                }
                numArr.push(digit);
            }
         
            for(i=0; i<numArr.length; i++){
                sumTotal += numArr[i];
            }
            var diff = eval(sumTotal % 10);
            console.log(diff);
            console.log(diff == "0");
            return (diff == "0");
        }
         
        function toSingle(digit){
            if(digit > 9){
                var tmp = digit.toString();
                var d1 = parseInt(tmp.charAt(0));
                var d2 = parseInt(tmp.charAt(1));
                return (d1 + d2); 
            } else {
                return digit;
            }
        }

      
     
    }
       
     
   


};
$(document).ready(function() {
    window.Registro=new Registro();
});