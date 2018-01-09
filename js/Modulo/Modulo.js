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
var Modulo = function(){
    
    /**************************************************************************/
    /******************************* ATTRIBUTES *******************************/
    /**************************************************************************/
    var self = this;
    var estadoGuarda;
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
    var Modulo = function() {
        self.div=$("#divModulo");
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
        var modulo = $("#tipo_modulo").val();
        var modulo = $("#tipo_modulo").val();



        if(modulo !=3 )
        {  
            $("#articulo").css("display","none");
        }
        if( modulo !=1){
            $("#multimedia").css("display","none");
        }
        if( modulo !=2){
            $("#tienda").css("display","none");
        }
        $('#default_input').asIconPicker(
            {'source': [{"value":"add","text":"add"},{"value":"add_round","text":"add_round"},{"value":"add_round_fill","text":"add_round_fill"},{"value":"alarm","text":"alarm"},{"value":"alarm_fill","text":"alarm_fill"},{"value":"albums","text":"albums"},{"value":"albums_fill","text":"albums_fill"},{"value":"arrow_down","text":"arrow_down"},{"value":"arrow_down_fill","text":"arrow_down_fill"},{"value":"arrow_left","text":"arrow_left"},{"value":"arrow_left_fill","text":"arrow_left_fill"},{"value":"arrow_right","text":"arrow_right"},{"value":"arrow_right_fill","text":"arrow_right_fill"},{"value":"arrow_up","text":"arrow_up"},{"value":"arrow_up_fill","text":"arrow_up_fill"},{"value":"at","text":"at"},{"value":"at_fill","text":"at_fill"},{"value":"bag","text":"bag"},{"value":"bag_fill","text":"bag_fill"},{"value":"bars","text":"bars"},{"value":"bell","text":"bell"},{"value":"bell_fill","text":"bell_fill"},{"value":"bolt","text":"bolt"},{"value":"bolt_fill","text":"bolt_fill"},{"value":"bolt_round","text":"bolt_round"},{"value":"bolt_round_fill","text":"bolt_round_fill"},{"value":"book","text":"book"},{"value":"book_fill","text":"book_fill"},{"value":"bookmark","text":"bookmark"},{"value":"bookmark_fill","text":"bookmark_fill"},{"value":"box","text":"box"},{"value":"box_fill","text":"box_fill"},{"value":"briefcase","text":"briefcase"},{"value":"briefcase_fill","text":"briefcase_fill"},{"value":"calendar","text":"calendar"},{"value":"calendar_fill","text":"calendar_fill"},{"value":"camera","text":"camera"},{"value":"camera_fill","text":"camera_fill"},{"value":"card","text":"card"},{"value":"card_fill","text":"card_fill"},{"value":"chat","text":"chat"},{"value":"chat_fill","text":"chat_fill"},{"value":"chats","text":"chats"},{"value":"chats_fill","text":"chats_fill"},{"value":"check","text":"check"},{"value":"check_round","text":"check_round"},{"value":"check_round_fill","text":"check_round_fill"},{"value":"chevron_down","text":"chevron_down"},{"value":"chevron_left","text":"chevron_left"},{"value":"chevron_right","text":"chevron_right"},{"value":"chevron_up","text":"chevron_up"},{"value":"circle","text":"circle"},{"value":"circle_fill","text":"circle_fill"},{"value":"circle_half","text":"circle_half"},{"value":"close","text":"close"},{"value":"close_round","text":"close_round"},{"value":"close_round_fill","text":"close_round_fill"},{"value":"cloud","text":"cloud"},{"value":"cloud_download","text":"cloud_download"},{"value":"cloud_download_fill","text":"cloud_download_fill"},{"value":"cloud_fill","text":"cloud_fill"},{"value":"cloud_upload","text":"cloud_upload"},{"value":"cloud_upload_fill","text":"cloud_upload_fill"},{"value":"collection","text":"collection"},{"value":"collection_fill","text":"collection_fill"},{"value":"compass","text":"compass"},{"value":"compass_fill","text":"compass_fill"},{"value":"compose","text":"compose"},{"value":"compose_fill","text":"compose_fill"},{"value":"data","text":"data"},{"value":"data_fill","text":"data_fill"},{"value":"delete","text":"delete"},{"value":"delete_round","text":"delete_round"},{"value":"delete_round_fill","text":"delete_round_fill"},{"value":"document","text":"document"},{"value":"document_fill","text":"document_fill"},{"value":"document_text","text":"document_text"},{"value":"document_text_fill","text":"document_text_fill"},{"value":"down","text":"down"},{"value":"download","text":"download"},{"value":"download_fill","text":"download_fill"},{"value":"download_round","text":"download_round"},{"value":"download_round_fill","text":"download_round_fill"},{"value":"drawer","text":"drawer"},{"value":"drawer_fill","text":"drawer_fill"},{"value":"drawers","text":"drawers"},{"value":"drawers_fill","text":"drawers_fill"},{"value":"email","text":"email"},{"value":"email_fill","text":"email_fill"},{"value":"eye","text":"eye"},{"value":"eye_fill","text":"eye_fill"},{"value":"fastforward","text":"fastforward"},{"value":"fastforward_fill","text":"fastforward_fill"},{"value":"fastforward_round","text":"fastforward_round"},{"value":"fastforward_round_fill","text":"fastforward_round_fill"},{"value":"favorites","text":"favorites"},{"value":"favorites_fill","text":"favorites_fill"},{"value":"film","text":"film"},{"value":"film_fill","text":"film_fill"},{"value":"filter","text":"filter"},{"value":"filter-fill","text":"filter-fill"},{"value":"flag","text":"flag"},{"value":"flag_fill","text":"flag_fill"},{"value":"folder","text":"folder"},{"value":"folder_fill","text":"folder_fill"},{"value":"forward","text":"forward"},{"value":"forward_fill","text":"forward_fill"},{"value":"gear","text":"gear"},{"value":"gear_fill","text":"gear_fill"},{"value":"graph_round","text":"graph_round"},{"value":"graph_round_fill","text":"graph_round_fill"},{"value":"graph_square","text":"graph_square"},{"value":"graph_square_fill","text":"graph_square_fill"},{"value":"heart","text":"heart"},{"value":"heart_fill","text":"heart_fill"},{"value":"help","text":"help"},{"value":"help_fill","text":"help_fill"},{"value":"home","text":"home"},{"value":"home_fill","text":"home_fill"},{"value":"images","text":"images"},{"value":"images_fill","text":"images_fill"},{"value":"info","text":"info"},{"value":"info_fill","text":"info_fill"},{"value":"keyboard","text":"keyboard"},{"value":"keyboard_fill","text":"keyboard_fill"},{"value":"layers","text":"layers"},{"value":"layers_fill","text":"layers_fill"},{"value":"left","text":"left"},{"value":"list","text":"list"},{"value":"list_fill","text":"list_fill"},{"value":"lock","text":"lock"},{"value":"lock_fill","text":"lock_fill"},{"value":"login","text":"login"},{"value":"login_fill","text":"login_fill"},{"value":"logout","text":"logout"},{"value":"logout_fill","text":"logout_fill"},{"value":"menu","text":"menu"},{"value":"mic","text":"mic"},{"value":"mic_fill","text":"mic_fill"},{"value":"money_dollar","text":"money_dollar"},{"value":"money_dollar_fill","text":"money_dollar_fill"},{"value":"money_euro","text":"money_euro"},{"value":"money_euro_fill","text":"money_euro_fill"},{"value":"money_pound","text":"money_pound"},{"value":"money_pound_fill","text":"money_pound_fill"},{"value":"money_rubl","text":"money_rubl"},{"value":"money_rubl_fill","text":"money_rubl_fill"},{"value":"money_yen","text":"money_yen"},{"value":"money_yen_fill","text":"money_yen_fill"},{"value":"more","text":"more"},{"value":"more_fill","text":"more_fill"},{"value":"more_round","text":"more_round"},{"value":"more_round_fill","text":"more_round_fill"},{"value":"more_vertical","text":"more_vertical"},{"value":"more_vertical_fill","text":"more_vertical_fill"},{"value":"more_vertical_round","text":"more_vertical_round"},{"value":"more_vertical_round_fill","text":"more_vertical_round_fill"},{"value":"navigation","text":"navigation"},{"value":"navigation_fill","text":"navigation_fill"},{"value":"paper_plane","text":"paper_plane"},{"value":"paper_plane_fill","text":"paper_plane_fill"},{"value":"pause","text":"pause"},{"value":"pause_fill","text":"pause_fill"},{"value":"pause_round","text":"pause_round"},{"value":"pause_round_fill","text":"pause_round_fill"},{"value":"person","text":"person"},{"value":"person_fill","text":"person_fill"},{"value":"persons","text":"persons"},{"value":"persons_fill","text":"persons_fill"},{"value":"phone","text":"phone"},{"value":"phone_fill","text":"phone_fill"},{"value":"phone_round","text":"phone_round"},{"value":"phone_round_fill","text":"phone_round_fill"},{"value":"photos","text":"photos"},{"value":"photos_fill","text":"photos_fill"},{"value":"pie","text":"pie"},{"value":"pie_fill","text":"pie_fill"},{"value":"play","text":"play"},{"value":"play_fill","text":"play_fill"},{"value":"play_round","text":"play_round"},{"value":"play_round_fill","text":"play_round_fill"},{"value":"radio","text":"radio"},{"value":"redo","text":"redo"},{"value":"refresh","text":"refresh"},{"value":"refresh_round","text":"refresh_round"},{"value":"refresh_round_fill","text":"refresh_round_fill"},{"value":"reload","text":"reload"},{"value":"reload_round","text":"reload_round"},{"value":"reload_round_fill","text":"reload_round_fill"},{"value":"reply","text":"reply"},{"value":"reply_fill","text":"reply_fill"},{"value":"rewind","text":"rewind"},{"value":"rewind_fill","text":"rewind_fill"},{"value":"rewind_round","text":"rewind_round"},{"value":"rewind_round_fill","text":"rewind_round_fill"},{"value":"right","text":"right"},{"value":"search","text":"search"},{"value":"search_strong","text":"search_strong"},{"value":"settings","text":"settings"},{"value":"settings_fill","text":"settings_fill"},{"value":"share","text":"share"},{"value":"share_fill","text":"share_fill"},{"value":"social_facebook","text":"social_facebook"},{"value":"social_facebook_fill","text":"social_facebook_fill"},{"value":"social_github","text":"social_github"},{"value":"social_github_fill","text":"social_github_fill"},{"value":"social_googleplus","text":"social_googleplus"},{"value":"social_instagram","text":"social_instagram"},{"value":"social_instagram_fill","text":"social_instagram_fill"},{"value":"social_linkedin","text":"social_linkedin"},{"value":"social_linkedin_fill","text":"social_linkedin_fill"},{"value":"social_rss","text":"social_rss"},{"value":"social_rss_fill","text":"social_rss_fill"},{"value":"social_twitter","text":"social_twitter"},{"value":"social_twitter_fill","text":"social_twitter_fill"},{"value":"sort","text":"sort"},{"value":"sort_fill","text":"sort_fill"},{"value":"star","text":"star"},{"value":"star_fill","text":"star_fill"},{"value":"star_half","text":"star_half"},{"value":"stopwatch","text":"stopwatch"},{"value":"stopwatch_fill","text":"stopwatch_fill"},{"value":"tabs","text":"tabs"},{"value":"tabs_fill","text":"tabs_fill"},{"value":"tags","text":"tags"},{"value":"tags_fill","text":"tags_fill"},{"value":"tape","text":"tape"},{"value":"tape_fill","text":"tape_fill"},{"value":"ticket","text":"ticket"},{"value":"ticket_fill","text":"ticket_fill"},{"value":"time","text":"time"},{"value":"time_fill","text":"time_fill"},{"value":"timer","text":"timer"},{"value":"timer_fill","text":"timer_fill"},{"value":"today","text":"today"},{"value":"today_fill","text":"today_fill"},{"value":"trash","text":"trash"},{"value":"trash_fill","text":"trash_fill"},{"value":"tune","text":"tune"},{"value":"tune_fill","text":"tune_fill"},{"value":"undo","text":"undo"},{"value":"unlock","text":"unlock"},{"value":"unlock_fill","text":"unlock_fill"},{"value":"up","text":"up"},{"value":"videocam","text":"videocam"},{"value":"videocam_fill","text":"videocam_fill"},{"value":"videocam_round","text":"videocam_round"},{"value":"videocam_round_fill","text":"videocam_round_fill"},{"value":"volume","text":"volume"},{"value":"volume_fill","text":"volume_fill"},{"value":"volume_low","text":"volume_low"},{"value":"volume_low_fill","text":"volume_low_fill"},{"value":"volume_mute","text":"volume_mute"},{"value":"volume_mute_fill","text":"volume_mute_fill"},{"value":"world","text":"world"},{"value":"world_fill","text":"world_fill"},{"value":"zoom_in","text":"zoom_in"},{"value":"zoom_out","text":"zoom_out"}]
         });
  
  

        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
      //  CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
      //  $('.textarea').wysihtml5();


        $("#tipo_modulo").change(function() {
            $("#articulo").css("display","none");
            $("#multimedia").css("display","none");
            $("#tienda").css("display","none");
            var modulo = $("#tipo_modulo").val();
                console.log(modulo);
                if(modulo ==3){
                    $("#articulo").css("display","block");
                    $("#multimedia").css("display","none");
                    $("#tienda").css("display","none");
                    console.log("ingresa");
             
                }else if(modulo ==1){
                    $("#multimedia").css("display","block");
                    $("#articulo").css("display","none");
                    $("#tienda").css("display","none");
                }else if( modulo ==2){
                    $("#tienda").css("display","block");
                    $("#articulo").css("display","none");
                    $("#multimedia").css("display","none");
                }
                
                else{
                    $("#tienda").css("display","none");
                    $("#articulo").css("display","none");
                    $("#multimedia").css("display","none");
                }
        });
    

       
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
    window.Modulo=new Modulo();
});