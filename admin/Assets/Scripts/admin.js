$(function () {
    BASE = $("#j_base_home").attr("href");
    //SHADOWBOX
    //Shadowbox.init();

    //MASCARAS
//    $(".formDate").mask("99/99/9999 99:99:99", {placeholder: " "});


    //TinyMCE
    //EXTENSÂO DE YOUTUBE EM \tiny_mce\plugins\media\js MEDIA.js
    tinymce.init({
        selector: "textarea.js_editor",
        theme: "modern",
        language: "pt_BR",
        height: 400,
        relative_urls: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink link lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime image media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager example"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | link unlink anchor | image imageupload media | responsivefilemanager | forecolor backcolor | print preview code ",
//        image_advtab: true,
        image_caption: true,
        image_dimensions: false,
        image_title: true,
        image_description: false,
        // Example content CSS (should be your site CSS)
        content_css: BASE + "/admin/css/tiny.css",
        script_url: BASE + "/admin/__jsc/tiny_mce/filemanager/jquery.tinymce.min.js",
        external_filemanager_path: BASE + "/admin/__jsc/tiny_mce/filemanager/",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {"filemanager": BASE + "/Assets/Scripts/tinymce/filemanager/plugin.min.js"},
        images_upload_url: BASE + '/Assets/Scripts/upload.php',
//        file_browser_callback: "fileBrowserCallBack",
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', BASE + '/Assets/Scripts/upload.php');

            console.log('Entrou');

            xhr.onload = function () {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                var str = json.location;
                var caminho = str.substring(1);
                console.log(str, caminho);
                success(caminho);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
//            formData.append('text', $('input[type=text]').val());
            console.log(formData.entries());
            xhr.send(formData);
        },

//        setup: function (editor) {
//
//            ImageResize = null;
//            var inp = $('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none;">');
//            $(editor.getElement()).parent().append(inp);
//            inp.on("change", function () {

//                        $('.js_modal_upload').on('change', '#tinymce-uploader', function(){
//
//                var foto = $(this).val();
//                        console.log(foto);
//                        $.post('ajax/ajax.php', {action: 'redimensionar_foto_post', foto: foto}, function(data){
//                        if (data.result){
//                        ImageResize = data.result;
//                        }
//                        }, 'json');
//                });
//            $('.js_modal_upload').on("submit", "form", function () {
//
//                var inp = $('#tinymce-uploader');
//                var legenda = $('.js_legenda').val();
//                var form = $(this);
//                var dados = $(this).serialize();
//                console.log(inp, legenda, dados);
//                form.ajaxSubmit({
//                    url: 'ajax/ajax.php',
//                    data: dados,
//                    type: 'POST',
//                    dataType: 'json',
//                    beforeSend: function () {
//                        $('.load').fadeIn(500);
//                    },
//                    success: function (data) {
//
//
//                        if (data.result) {
//                            ImageResize = data.result;

////
//                            var input = inp.get(0);
//                            var file = input.files[0];
//
//                // Somente imagens abaixo de 360kb
//                if (file.size > 360000) {
//
//                    $('.trigger-box-suspenso').html("<p class=\"trigger error\"><b>Oppss! Arquivo Muito Grande!</b> Favor redimensionar imagem para uma resolução abaixo de <b>360KB!</b><span class=\"ajax_close\">X</span></p>");
//                    $('.trigger-box-suspenso').fadeIn(400);
//                    setTimeout(function () {
//                        $('.trigger-box-suspenso').fadeOut();
//                    }, 3000);
//                    $('form').find('.trigger-box').html("<p class=\"trigger error\"><b>Oppss! Arquivo Muito Grande!</b> Favor redimensionar imagem para uma resolução abaixo de <b>360KB!</b><span class=\"ajax_close\">X</span></p>");
//
//                    return false;
//                }
//
//                            var fr = new FileReader();
//                            fr.onload = function () {
//                                var img = new Image();
//                                img.src = fr.result;
//                            editor.insertContent('<img class="editor_img" title="' + legenda + '" alt="[' + legenda + ']" src="' + BASE + '/uploads' + data.result + '"/> <input readonly type="text" class="container alt_image_post" style="width:99%; margin: 0 0 0 0.5%; padding: 5px 10px; background: #ccc; border:none;" value="' + legenda + '" />');
//                            editor.insertContent('<p></p>');
//                            inp.val('');
//                            $('.js_legenda').val('');
//                            $('.js_modal_upload').fadeOut();
////                            }

//                            fr.readAsDataURL(file);
//                        }
//                    }
//
//                });
//                return false;
//            });
//            editor.addButton('imageupload', {
//                icon: 'image',
//                onclick: function (e) {
////                    inp.trigger('click');
//                    $('.js_modal_upload').fadeIn();
//                }
//            });
//        }

    });
});