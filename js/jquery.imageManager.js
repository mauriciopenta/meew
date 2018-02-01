
(function ($) {

    var aplicacionDefaults = {
        csrfToken: null,
        csrfTokenName: null,
        recurso: {},
        uploadUrl: '',
        deleteUrl: '',
        updateUrl: '',
        updateUrl: '',
        idaplicacion:0
    };
 

    function imageManager(el, options) {
        //Extending options:
        console.log(options);

        var opts = $.extend({}, aplicacionDefaults, options);
        console.log(opts);
       
        //code
        var csrfParams = opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : '';
        var aplicacion = {}; 
        var $recursos = $(el);
    


        $('#splash').append("<form id='dZUpload_splash' class='dropzone borde-dropzone'  style='cursor: pointer;'>"+
        "<div class='dz-default dz-message text-center'>"+
          "<span><h4>Arrastra la imagen aquí</h4></span><br>"+
         
        "<p>(o haga Click para seleccionar)</p>"+
        "</div></form>"+
        "<p style='color:red'   id='splash_error'></p>");
        
        
        $('#icon_app').append("<form id='dZUpload_icon' class='dropzone borde-icon'  style='cursor: pointer;'>"+
        "<div class='dz-default dz-message text-center'>"+
          "<span><h4>Arrastra la imagen aquí</h4></span><br>"+
          
        "<p>(o haga Click para seleccionar)</p></div></form>"+
        "<p style='color:red' id='icon_error'></p>");
    
        $('#icon_header').append("<form id='dZUpload_icon_header' class='dropzone borde-icon-int'  style='cursor: pointer;'>"+
        "<div class='dz-default dz-message text-center'>"+
          "<span><h4>Arrastra la imagen aquí</h4></span><br>"+
         
        "<p>(o haga Click para seleccionar)</p></div></form>"+
           "<p style='color:red' id='iconh_error'></p>");
      

  

          Dropzone.autoDiscover = false;
          $("#dZUpload_splash").dropzone({
              url: "upload_resource?idaplicacion="+opts.idaplicacion+"&type=splash",
                 maxFiles: 2,

                addRemoveLinks: false,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
              
                init: function() {
                    this.hiddenFileInput.removeAttribute('multiple');
                    this.on("maxfilesexceeded", function(file) {
                        console.log("maxfilesexceeded splash ");
                        this.removeAllFiles();
                        this.addFile(file);
                  });
    
                  this.on("addedfile", function(file) {
                    console.log("addedfile splash ");
                    if (this.files.length==2){
                            this.removeAllFiles();
                            this.addFile(file);
                    }
                  });


                  this.on("thumbnail", function(file) {
                    // Do the dimension checks you want to do
                    if (file.width ==2732 && file.height == 2732) {
                        console.log("thumbnail ok");
                        file.acceptDimensions();
                        $('#splash_error').text("");

                    }
                    else {
                        console.log("thumbnail fail");
                        $('#splash_error').text("la dimensión de la imagen no corresponde");

                        file.rejectDimensions();
                        this.removeAllFiles();
                        
                        var filename = opts.recurso.imagen_splash.substring(opts.recurso.imagen_splash.lastIndexOf('/')+1);
                         var mockFile = { name: filename, size: "" };
                      
                         this.emit("addedfile", mockFile);
                         this.options.thumbnail.call(this, mockFile, opts.recurso.imagen_splash);
                        // this.emit("success", mockFile);
                        // this.emit("complete", mockFile);
                         this.files.push(mockFile);
                         this.emit("complete", mockFile);
                    }
                  });
                if(opts.recurso.imagen_splash!=''){
                    var filename = opts.recurso.imagen_splash.substring(opts.recurso.imagen_splash.lastIndexOf('/')+1);
                    var mockFile = { name: filename, size: "" };
                    
                    this.emit("addedfile", mockFile);
                    this.options.thumbnail.call(this, mockFile, opts.recurso.imagen_splash);
                    // this.emit("success", mockFile);
                    // this.emit("complete", mockFile);
                    this.files.push(mockFile);
                    this.emit("complete", mockFile);
                }
           
        
               },accept: function(file, done) {
               
                file.acceptDimensions = done;

                file.rejectDimensions = function() { 
                    
                    done("Dimension Invalida.");
              
                
                };
                // Of course you could also just put the `done` function in the file
                // and call it either with or without error in the `thumbnail` event
                // callback, but I think that this is cleaner.
              },
               success: function (file, response) {
                   var imgName = response;
                 
                  
               },
              error: function (file, response) {
                 // file.previewElement.classList.add("dz-error");
              }
          });
      
          $("#dZUpload_icon").dropzone({
            url: "upload_resource?idaplicacion="+opts.idaplicacion+"&type=icon",
            maxFiles: 2,

            addRemoveLinks: false,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
              init: function() {
                this.on("maxfilesexceeded", function(file) {
                    console.log("maxfilesexceeded icon ");
                    this.removeAllFiles();
                    this.addFile(file);
              });

              this.on("addedfile", function(file) {
                console.log("addedfile icon ");
                if (this.files.length==2){
                        this.removeAllFiles();
                        this.addFile(file);
                }
              });
          
              this.on("thumbnail", function(file) {
                // Do the dimension checks you want to do
                if ((file.width==file.height && file.height>499 && file.height<=1024)  ) {
                    console.log("thumbnail icon ok");
                    file.acceptDimensions();
                    $('#icon_error').text("");

                }
                else {
                  console.log("thumbnail icon fail");
                  $('#icon_error').text("la dimensión de la imagen no corresponde");

                  file.rejectDimensions();
                  this.removeAllFiles();
                  var filename = opts.recurso.imagen_icon.substring(opts.recurso.imagen_icon.lastIndexOf('/')+1);
                  var mockFile = { name: filename, size: "" };
                  this.emit("addedfile", mockFile);
                  this.options.thumbnail.call(this, mockFile, opts.recurso.imagen_icon);
                
                  this.files.push(mockFile);
                  this.emit("complete", mockFile);

                }
              });
              if(opts.recurso.imagen_icon!=''){
                    var filename = opts.recurso.imagen_icon.substring(opts.recurso.imagen_icon.lastIndexOf('/')+1);
                    var mockFile = { name: filename, size: "" };
                    this.emit("addedfile", mockFile);
                    this.options.thumbnail.call(this, mockFile, opts.recurso.imagen_icon);
                    
                    this.files.push(mockFile);
                    this.emit("complete", mockFile);
              }

             },accept: function(file, done) {
               
                file.acceptDimensions = done;

                file.rejectDimensions = function() { 
                    
                    done("Dimension Invalida.");
                
                };
                // Of course you could also just put the `done` function in the file
                // and call it either with or without error in the `thumbnail` event
                // callback, but I think that this is cleaner.
              },
            success: function (file, response) {
                var imgName = response;
               
                console.log("succes splash "+JSON.stringify(response));
               
            },
            error: function (file, response) {
               // file.previewElement.classList.add("dz-error");
            }
        });
        $("#dZUpload_icon_header").dropzone({
            url: "upload_resource?idaplicacion="+opts.idaplicacion+"&type=icon_header",
            maxFiles: 2,

            addRemoveLinks: false,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
              init: function() {
              

             this.hiddenFileInput.removeAttribute('multiple');
             this.on("maxfilesexceeded", function(file) {
                    console.log("maxfilesexceeded splash ");
                    this.removeAllFiles();
                    this.addFile(file);
              });

              this.on("addedfile", function(file) {
                console.log("addedfile splash ");
                if (this.files.length==2){
                        this.removeAllFiles();
                        this.addFile(file);
                }
              });

              this.on("thumbnail", function(file) {
                    // Do the dimension checks you want to do
                    if (((file.width /file.height) >3)) {
                        console.log("thumbnail icon ok");
                        file.acceptDimensions();
                        $('#iconh_error').text("");

                    }
                    else {
                        $('#iconh_error').text("la dimensión de la imagen no corresponde");

                        console.log("thumbnail icon fail");
                       file.rejectDimensions();
                        
                       this.removeAllFiles();
                     
                            var filename = opts.recurso.imagen_icon_int.substring(opts.recurso.imagen_icon_int.lastIndexOf('/')+1);
                            var mockFile = { name: filename, size: "" };
                        
                            this.emit("addedfile", mockFile);
                            this.options.thumbnail.call(this, mockFile, opts.recurso.imagen_icon_int);
                        
                            this.files.push(mockFile);
                            this.emit("complete", mockFile);
                       
                    }
                  

              });

              if(opts.recurso.imagen_icon_int!=''){
                    var filename = opts.recurso.imagen_icon_int.substring(opts.recurso.imagen_icon_int.lastIndexOf('/')+1);
                    var mockFile = { name: filename, size: "" };
                
                    this.emit("addedfile", mockFile);
                    this.options.thumbnail.call(this, mockFile, opts.recurso.imagen_icon_int);
                
                    this.files.push(mockFile);
                    this.emit("complete", mockFile);
              }
              
           
             },accept: function(file, done) {
               
                file.acceptDimensions = done;

                file.rejectDimensions = function() { 
                    
                    done("Dimension Invalida.");
                };
                // Of course you could also just put the `done` function in the file
                // and call it either with or without error in the `thumbnail` event
                // callback, but I think that this is cleaner.
              },
            success: function (file, response) {
                var imgName = response;
              
               
            },
            error: function (file, response) {
               // file.previewElement.classList.add("dz-error");
            }
        });



      /*   var DropzoneSplash = new Dropzone("#dZUpload_splash"); 
            
             DropzoneSplash.on("complete", function(file,response) {


    
            });
*/
        function htmlEscape(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

     

        

    }
     
    // The actual plugin
    $.fn.imageManager = function (options) {
/**
 * 
 ALTER TABLE `meewco_meew`.`aplicacion` 
ADD COLUMN `imagen_splash` VARCHAR(200) NULL AFTER `imagen_splash`,
ADD COLUMN `imagen_icon` VARCHAR(200) NULL AFTER `imagen_icon`,
ADD COLUMN `icon_interno` VARCHAR(200) NULL AFTER `icon_interno`;
 * 
 */
        console.log(JSON.stringify(options));

        if (this.length) {
            this.each(function () {

                imageManager(this, options);
            });
        }
    };
})(jQuery);



