(function ($) {

    var galleryDefaults = {
        csrfToken: null,
        csrfTokenName: null,

        nameLabel: 'Name',
        descriptionLabel: 'Description',
        hasName: true,
        hasDesc: true,
        hasPrecio: true,
        hasPrecioText: true,
        hasUnidades: true,
        hasUrl_video: true,

        precioLabel: 'Precio',
        preciotextLabel: 'Texto precio',
        unidadesLabel: 'Unidades disponibles',
        tipoContenidoLabel: 'Tipo de contenido',
        url_video_label: 'video youtube ',
       

        uploadUrl: '',
        deleteUrl: '',
        updateUrl: '',
        arrangeUrl: '',

        photos: []
    };

    function galleryManager(el, options) {
        //Extending options:
        var opts = $.extend({}, galleryDefaults, options);
         console.log(opts);

        //code
        var csrfParams = opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : '';
        var photos = {}; // photo elements by id
        var $gallery = $(el);
        


       
        if (opts.hasPrecio) 
            $gallery.addClass('tienda');
        else 
            $gallery.addClass('galeria');

       
        var $sorter = $('.sorter', $gallery);
        var $images = $('.images', $sorter);
        var $editorModal = $('#editor-modal', $gallery);
        var $editorModalVideo = $('#editor-modal-video', $gallery);
        var $progressOverlay = $('.progress-overlay', $gallery);
        var $uploadProgress = $('.upload-progress', $progressOverlay);
        var $editorForm = $('.form', $editorModal);
        var $editorVideoForm = $('.form', $editorModal);
        
          
        
        function htmlEscape(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

        function createEditorElement(id, src,preview_video, name, description, tipo_contenido, precio, precio_text,unidades,url_video ) {
            var html = '<div class="box box-info padding_dialog">' +
                            '<div class="row padding_dialog">'+
                                '<div class="div50 padding_dialog">'+
                                   '<div class="preview" ><img src="' + htmlEscape(src) + '" alt=""/> ' +
                                    '</div>'+
                                '</div>' +
                            
                                (opts.hasName
                                ?'<div class="div50 padding_dialog">'+
                                '<label for="photo_tipo_contenido_' + id + '">' + opts.tipoContenidoLabel + ': '+ ((tipo_contenido == 1) ? "imagen" : "video youtube") +'</label>' 
                                +
                              
                                    '<label for="photo_name_' + id + '">' + opts.nameLabel + ':</label>' +
                                    '<input type="text" name="photo[' + id + '][name]" class="input-xlarge" value="' + htmlEscape(name) + '" id="photo_name_' + id + '"/> '
                                     : '') +
                                (opts.hasDesc
                                    ? '<label for="photo_description_' + id + '">' + opts.descriptionLabel + ':</label>' +
                                    '<textarea name="photo[' + id + '][description]" rows="3" cols="40" class="input-xlarge" id="photo_description_' + id + '">' + htmlEscape(description) + '</textarea>'
                                    : '') +

                               (opts.hasPrecio
                                    ? '<label for="photo_precio' + id + '">' + opts.precioLabel + ':</label>' +
                                    '<input type="text" name="photo[' + id + '][precio]" class="input-xlarge" value="' + htmlEscape(precio) + '" id="photo_precio_' + id + '"/>'
                                    : '') +
                                (opts.hasPrecioText
                                    ?'<label for="photo_precio_text_' + id + '">' + opts.preciotextLabel + ':</label>' +
                                    '<input type="text" name="photo[' + id + '][precio_text]" class="input-xlarge" value="' + htmlEscape(precio_text) + '" id="photo_precio_text_' + id + '"/>'
                                    : '') +
                                (opts.hasUnidades
                                    ?'<label for="photo_precio_text_' + id + '">' + opts.unidadesLabel + ':</label>' +
                                    '<input type="text" name="photo[' + id + '][unidades]" class="input-xlarge" value="' + htmlEscape(unidades) + '" id="photo_unidades_' + id + '"/>'
                                    : '') +
                               '</div>'+
                           '</div>'+
                      '</div>';
            return $(html);
        }


        function createVideoElement(id, src,preview_video, name, description, tipo_contenido, precio, precio_text,unidades,url_video ) {
            var html = '<div class="box box-info padding_dialog">' +
                            '<div class="row padding_dialog">'+
                                '<div class="div50 padding_dialog">'+
                                   '<iframe class="preview_video" id="video_frame" src="' + htmlEscape(preview_video) + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> ' +
                                    
                                '</div>' +
                            
                                (opts.hasName
                                ?'<div class="div50 padding_dialog">'+
                                '<label for="photo_tipo_contenido_' + id + '">' + opts.tipoContenidoLabel + ': '+ ((tipo_contenido == 1) ? "imagen" : "video youtube") +'</label>' 
                                +
                                    '<label for="photo_name_' + id + '">' + opts.nameLabel + ':</label>' +
                                    '<input type="text" name="photo[' + id + '][name]" class="input-xlarge" value="' + htmlEscape(name) + '" id="photo_name_' + id + '"/> '
                                     : '') +
                                (opts.hasDesc
                                    ? '<label for="photo_description_' + id + '">' + opts.descriptionLabel + ':</label>' +
                                    '<textarea name="photo[' + id + '][description]" rows="3" cols="40" class="input-xlarge" id="photo_description_' + id + '">' + htmlEscape(description) + '</textarea>'
                                    : '') +

                                
                                
                                '<label for="photo_url_video' + id + '">' + opts.url_video_label + ': ingrese el codigo del video (https://www.youtube.com/embed/{codigo})</label>' +
                                '<input type="text" name="photo[' + id + '][url_video]" class="input-xlarge" value="' + htmlEscape(url_video) + '" id="photo_url_video_' + id + '"/>'
                                + '<span id="validacion"></span>'+
                                '<a  class="btn btn-primary" id="btn_cargar">Cargar Video</a>'

                               '</div>'+
                           '</div>'+
                      '</div>';
            return $(html);
        }

      

        function addPhoto(id, src,preview_video, name, description, precio_text, precio,unidades, url_video, tipo_contenido, rank) {
          
            var photoTemplate ='';
            
            if(tipo_contenido==1){
                photoTemplate += '<div class="photo">' + '<div class="image-preview"><img src=""/></div><div class="caption">';
            }else if(tipo_contenido==2){
                photoTemplate += '<div class="photo">' + '<div class="image-preview"><iframe id="iframe_'+id+'" class="thumb_youtube"   src="" frameborder="0"   allowfullscreen></iframe> ' +
                '</div><div class="caption">';
            }
            



             if (opts.hasName) photoTemplate += '<div id="titulo" ></div>';
             if (opts.hasPrecioText) photoTemplate += '<div id="precio_text"></div>';
             if (opts.hasUnidades) photoTemplate += '<div id="unidades"></div>';
               photoTemplate += '<div id="tipo_contenido"></div>';
               photoTemplate += '</div><div class="actions">';
             if (opts.hasName || opts.hasDesc) photoTemplate+= '<span class="editPhoto btn btn-primary btn-mini"><i class="icon-pencil icon-white"></i></span> ';
             photoTemplate += '<span class="deletePhoto btn btn-danger btn-mini"><i class="icon-remove icon-white"></i></span>' +
                 '</div><input type="checkbox" class="photo-select"/></div>';
            var photo = $(photoTemplate);
            photos[id] = photo;
            photo.data('id', id);
            photo.data('rank', rank);
            if(tipo_contenido==1){
               $('img', photo).attr('src', src);
            }else  if(tipo_contenido==2){
               $('iframe', photo).attr('src', preview_video);
            }
            if (opts.hasName) $('#titulo', photo).text("Titulo: "+name);
            if (opts.hasDesc && !opts.hasPrecioText) $('#desc', photo).text("Descripcion: "+description);
            if (opts.hasPrecioText) $('#precio_text', photo).text("Precio: "+ precio_text);
            if (opts.hasUnidades) $('#unidades', photo).text("unidades: "+unidades);
            tipo_contenido= $('#tipo_contenido', photo).text("Contenido: "+((tipo_contenido==1)?'Imagen':'Video' ));
            $images.append(photo);
            return photo;
        }


       function getPhoto(id){
            for (var i = 0, l = opts.photos.length; i < l; i++) {
                var resp = opts.photos[i];
                if(resp['id']==id){
                return resp;
                }
                
            }
            return null;
       }


        function editPhotos(ids) {
            var l = ids.length;
            var form = $editorForm.empty();
            
            
           console.log(photos);
                
            for (var i = 0; i < l; i++) {
                var id = ids[i];
                var photo = photos[id];
                var resp= getPhoto(id);
                  
                 if(resp!=null)
                  {  
                   var src = resp['preview'];
                   var name =resp['name'];
                   var description = resp['description'];
                   var precio_text = resp['precio_text'];
                   var precio= resp['precio'];
                   var unidades= resp['unidades'];
                   var url_video= resp['url_video'];
                   var preview_video= resp['preview_video'];
                   var tipo_contenido= resp['tipo_contenido'];

                    if(resp['tipo_contenido']==1){
                      form.append(createEditorElement(id, src,preview_video, name, description, tipo_contenido, precio, precio_text ,unidades,url_video));
                    }else{
                      form.append(createVideoElement(id, src,preview_video, name, description, tipo_contenido, precio, precio_text ,unidades,url_video));
                        
                    }
                }     
             }
            if (l > 0)$editorModal.modal('show');
        }

        
        
        function createVideo() {
           
            var form = $editorForm.empty();
                   var src = "";
                   var name ="";
                   var description ="";
                   var precio_text ="";
                   var precio ="";
                   var unidades ="";
                   var url_video ="";
                   var tipo_contenido= 2;
                   form.append(createVideoElement("0", src, name, description, tipo_contenido, precio, precio_text,unidades,url_video ) );
                    
             $editorModal.modal('show');

            
        }


       function cargarVideo(){
         //video_frame
       //  console.log($('#photo_url_video_0').value);
         var video= document.getElementById("photo_url_video_0").value;
         console.log(video);
         $('#video_frame').attr('src','https://www.youtube.com/embed/'+ video);
  
       }
/*
https://www.youtube.com/embed/PtlroS-LJbI
<iframe width="560" height="315" src="https://www.youtube.com/embed/PtlroS-LJbI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
*/

        function removePhotos(ids) {
            $.ajax({
                type: 'POST',
                url: opts.deleteUrl,
                data: 'id[]=' + ids.join('&id[]=') + csrfParams,
                success: function (t) {
                    if (t == 'OK') {
                        for (var i = 0, l = ids.length; i < l; i++) {
                            photos[ids[i]].remove();
                            delete photos[ids[i]];
                        }
                    } else alert(t);
                }});
        }


        function deleteClick(e) {
            e.preventDefault();
            var photo = $(this).closest('.photo');
            var id = photo.data('id');
            // here can be question to confirm delete
            // if (!confirm(deleteConfirmation)) return false;
            removePhotos([id]);
            return false;
        }

        function editClick(e) {
            e.preventDefault();
            var photo = $(this).closest('.photo');
            var id = photo.data('id');
            editPhotos([id]);
            return false;
        }

        function updateButtons(){
            var selectedCount = $('.photo.selected', $sorter).length;
            $('.select_all', $gallery).prop('checked', $('.photo', $sorter).length == selectedCount);
            if (selectedCount == 0) {
                $('.edit_selected, .remove_selected', $gallery).addClass('disabled');
            } else {
                $('.edit_selected, .remove_selected', $gallery).removeClass('disabled');
            }
        }

        function selectChanged() {
            var $this = $(this);
            if ($this.is(':checked'))
                $this.closest('.photo').addClass('selected');
            else
                $this.closest('.photo').removeClass('selected');
            updateButtons();
        }
        var stringConstructor = "test".constructor;
        var arrayConstructor = [].constructor;
        var objectConstructor = {}.constructor;
        
        function whatIsIt(object) {
            if (object === null) {
                return "null";
            }
            else if (object === undefined) {
                return "undefined";
            }
            else if (object.constructor === stringConstructor) {
                return "String";
            }
            else if (object.constructor === arrayConstructor) {
                return "Array";
            }
            else if (object.constructor === objectConstructor) {
                return "Object";
            }
            else {
                return "don't know";
            }
        }
        
        function objectifyForm(formArray) {//serialize data function
            
              var returnArray = {};
              for (var i = 0; i < formArray.length; i++){
                returnArray[formArray[i]['name']] = formArray[i]['value'];
              }
              return returnArray;
            }


        $images
            .on('click', '.photo .deletePhoto', deleteClick)
            .on('click', '.photo .editPhoto', editClick)
            .on('click', '.photo .photo-select', selectChanged);


        $('.images', $sorter).sortable({ tolerance: "pointer" }).disableSelection().bind("sortstop", function () {
            var data = [];
            $('.photo', $sorter).each(function () {
                var t = $(this);
                data.push('order[' + t.data('id') + ']=' + t.data('rank'));
            });
            $.ajax({
                type: 'POST',
                url: opts.arrangeUrl,
                data: data.join('&') + csrfParams,
                dataType: "json"
            }).done(function (data) {
                    for (var id in data[id]) {
                        photos[id].data('rank', data[id]);
                    }
                });
        });

        if (window.FormData !== undefined) { // if XHR2 available
            var uploadFileName = $('.afile', $gallery).attr('name');
            function multiUpload(files) {
                if (files.length == 0) return;
                $progressOverlay.show();
                $uploadProgress.css('width', '5%');
                var filesCount = files.length;
                var uploadedCount = 0;
                var ids = [];
                for (var i = 0; i < filesCount; i++) {
                    var fd = new FormData();

                    fd.append(uploadFileName, files[i]);
                    if (opts.csrfToken) {
                        fd.append(opts.csrfTokenName, opts.csrfToken);
                    }
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', opts.uploadUrl, true);
                    xhr.onload = function () {
                        console.log(this.response);
                        uploadedCount++;
                        if (this.status == 200) {
                            var resp = JSON.parse(this.response);
                            console.log(resp);
                            opts.photos.push(resp);
                            addPhoto(resp['id'], resp['preview'] ,resp['preview_video'] , resp['name'], resp['description'], resp['precio_text'], resp['precio'], resp['unidades'], resp['url_video'], resp['tipo_contenido'], resp['rank'] );
                            ids.push(resp['id']);
                        } else {
                            // exception !!!
                            console.log("exception");
                        }
                        $uploadProgress.css('width', '' + (5 + 95 * uploadedCount / filesCount) + '%');

                        if (uploadedCount === filesCount) {
                            $uploadProgress.css('width', '100%');
                            $progressOverlay.hide();
                            if (opts.hasName || opts.hasDesc) editPhotos(ids);
                        }
                    };
                    xhr.send(fd);
                }

            }

            (function () { // add drag and drop
                var el = $gallery[0];
                var isOver = false;
                var lastIsOver = false;

                setInterval(function () {
                    if (isOver != lastIsOver) {
                        if (isOver) el.classList.add('over');
                        else el.classList.remove('over');
                        lastIsOver = isOver
                    }
                }, 30);

                function handleDragOver(e) {
                    e.preventDefault();
                    isOver = true;
                    return false;
                }

                function handleDragLeave() {
                    isOver = false;
                    return false;
                }

                function handleDrop(e) {
                    e.preventDefault();
                    e.stopPropagation();


                    var files = e.dataTransfer.files;
                    multiUpload(files);

                    isOver = false;
                    return false;
                }

                function handleDragEnd() {
                    isOver = false;
                }


                el.addEventListener('dragover', handleDragOver, false);
                el.addEventListener('dragleave', handleDragLeave, false);
                el.addEventListener('drop', handleDrop, false);
                el.addEventListener('dragend', handleDragEnd, false);
            })();

            $('.afile', $gallery).attr('multiple', 'true').on('change', function (e) {
                e.preventDefault();
                multiUpload(this.files);
            });
        } else {
            $('.afile', $gallery).on('change', function (e) {
                e.preventDefault();
                var ids = [];
                $progressOverlay.show();
                $uploadProgress.css('width', '5%');

                var data = {};
                if (opts.csrfToken)
                    data[opts.csrfTokenName] = opts.csrfToken;
                $.ajax({
                    type: 'POST',
                    url: opts.uploadUrl,
                    data: data,
                    files: $(this),
                    iframe: true,
                    processData: false,
                    dataType: "json"
                }).done(function (resp) {
                       
                     console.log(resp);
                   
                     addPhoto(resp['id'], resp['preview'],resp['preview_video'], resp['name'], resp['description'], resp['precio_text'], resp['precio'], resp['unidades'], resp['url_video'], resp['tipo_contenido'], resp['rank'] );
                    
                       $uploadProgress.css('width', '100%');
                        $progressOverlay.hide();
                        if (opts.hasName || opts.hasDesc) editPhotos(ids);
                    });
            });
        }

        $('.save-changes', $editorModal).click(function (e) {
            e.preventDefault();
            console.log( $('input, textarea', $editorForm).serialize());
            console.log( $editorForm);
            


            $.post(opts.updateUrl, $('input, textarea', $editorForm).serialize() + csrfParams, function (data) {
                console.log("in save "+JSON.stringify(data));
                if(Array.isArray(data)){

                 
                
                var count = data.length;
                
                for (var key = 0; key < count; key++) {


                    var p = data[key];
                    console.log(p);
                    var photo = photos[p.id];
                    if(p['tipo_contenido']==1){
                        $('img', photo).attr('src', p['src']);
                          
                       }else  if(p['tipo_contenido']==2){
                          $('#iframe_'+p['id']).attr('src', p['preview_video']);
                       }
                    if (opts.hasName) $('#titulo', photo).text("Titulo: "+p['name']);
                    if (opts.hasPrecioText) $('#precio_text', photo).text("Precio: "+ p['precio_text']);
                    if (opts.hasUnidades) $('#unidades', photo).text("unidades: "+p['unidades']);

                    for (var i = 0, l = opts.photos.length; i < l; i++) {
                        if(opts.photos[i]['id']==p.id){
                            console.log(opts.photos[i]);
                            console.log(p);
                          
                              
                            opts.photos[i]=p;
                            
                            console.log(opts.photos[i]);
                        }
                        
                    }
                }   
            }else{
                var resp = data;
                opts.photos.push(resp);
                addPhoto(resp['id'], resp['preview'],resp['preview_video'], resp['name'], resp['description'], resp['precio_text'], resp['precio'], resp['unidades'], resp['url_video'], resp['tipo_contenido'], resp['rank'] );
               // ids.push(resp['id']);
               
                
            }


                                  
                $editorModal.modal('hide');
                //deselect all items after editing
                $('.photo.selected', $sorter).each(function () {
                    $('.photo-select', this).prop('checked', false)
                }).removeClass('selected');
                $('.select_all', $gallery).prop('checked', false);
                updateButtons();
            }, 'json');
        
        
     

        });

        

        $('.gform').on('click', '#agregarVideo', function(){
            console.log("agrega video ");
            createVideo();
        });

        $('.form').on('click', '#btn_cargar', function(){
            cargarVideo();
        });



        $('.add_video', $editorModalVideo).click(function (e) {
            e.preventDefault();
            $.post(opts.createVideoUrl, $('input, textarea', $editorForm).serialize() + csrfParams, function (data) {
                var count = data.length;
                for (var key = 0; key < count; key++) {
                    var p = data[key];
                    console.log(p);
                    var photo = photos[p.id];
                    $('img', photo).attr('src', p['src']);

                    if (opts.hasName) $('#titulo', photo).text("Titulo: "+p['name']);

                    if (opts.hasPrecioText) $('#precio_text', photo).text("Precio: "+ p['precio_text']);
                    if (opts.hasUnidades) $('#unidades', photo).text("unidades: "+p['unidades']);
                    for (var i = 0, l = opts.photos.length; i < l; i++) {
                        if(opts.photos[i]['id']==p.id){
                            console.log(opts.photos[i]);
                            console.log(p);
                            
                            opts.photos[i]=p;
                            
                            console.log(opts.photos[i]);
                        }
                        
                    }


                  

                }
                $editorModalVideo.modal('hide');
                //deselect all items after editing
                $('.photo.selected', $sorter).each(function () {
                    $('.photo-select', this).prop('checked', false)
                }).removeClass('selected');
                $('.select_all', $gallery).prop('checked', false);
                updateButtons();
            }, 'json');

        });





        $('.edit_selected', $gallery).click(function (e) {
            e.preventDefault();
            var ids = [];
            $('.photo.selected', $sorter).each(function () {
                ids.push($(this).data('id'));
            });
            editPhotos(ids);
            return false;
        });

        $('.remove_selected', $gallery).click(function (e) {
            e.preventDefault();
            var ids = [];
            $('.photo.selected', $sorter).each(function () {
                ids.push($(this).data('id'));
            });
            removePhotos(ids);

        });

        $('.select_all', $gallery).change(function () {
            if ($(this).prop('checked')) {
                $('.photo', $sorter).each(function () {
                    $('.photo-select', this).prop('checked', true)
                }).addClass('selected');
            } else {
                $('.photo.selected', $sorter).each(function () {
                    $('.photo-select', this).prop('checked', false)
                }).removeClass('selected');
            }
            updateButtons();
        });


       
        for (var i = 0, l = opts.photos.length; i < l; i++) {
            var resp = opts.photos[i];

            console.log(resp);

            addPhoto(resp['id'], resp['preview'],resp['preview_video'], resp['name'], resp['description'], resp['precio_text'], resp['precio'], resp['unidades'], resp['url_video'], resp['tipo_contenido'], resp['rank'] );
            
        }
    }


    // The actual plugin
    $.fn.galleryManager = function (options) {
        if (this.length) {
            this.each(function () {
                galleryManager(this, options);
            });
        }
    };
})(jQuery);