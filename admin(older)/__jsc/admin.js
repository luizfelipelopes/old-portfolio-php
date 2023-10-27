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
        height: 300,
        relative_urls: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink link lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager example"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | link unlink anchor | imageupload media | responsivefilemanager | forecolor backcolor | print preview code ",
        image_advtab: true,
        // Example content CSS (should be your site CSS)
        content_css: BASE + "/flowstate_admin/css/tiny.css",
        external_filemanager_path: BASE + "/flowstate_admin/__jsc/tiny_mce/filemanager/",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {"filemanager": BASE + "/flowstate_admin/__jsc/tiny_mce/filemanager/plugin.min.js"},
        file_browser_callback: "fileBrowserCallBack",
        setup: function (editor) {

            var inp = $('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
            $(editor.getElement()).parent().append(inp);
            inp.on("change", function () {


                var input = inp.get(0);
                var file = input.files[0];

                // Somente imagens abaixo de 362KB
                if (file.size > 370991) {

                    $('.trigger-box-suspenso').html("<p class=\"trigger error\"><b>Oppss! Arquivo Muito Grande!</b> Favor redimensionar imagem para uma resolução abaixo de <b>360KB!</b><span class=\"ajax_close\">X</span></p>");
                    $('.trigger-box-suspenso').fadeIn(400);
                    setTimeout(function () {
                        $('.trigger-box-suspenso').fadeOut();
                    }, 3000);
                    $('form').find('.trigger-box').html("<p class=\"trigger error\"><b>Oppss! Arquivo Muito Grande!</b> Favor redimensionar imagem para uma resolução abaixo de <b>360KB!</b><span class=\"ajax_close\">X</span></p>");

                    return false;
                }

                var fr = new FileReader();
                fr.onload = function () {
                    var img = new Image();
                    img.src = fr.result;
                    editor.insertContent('<img width="100%" height="400" src="' + img.src + '"/>');
                    inp.val('');
                }
                fr.readAsDataURL(file);
            });
            editor.addButton('imageupload', {
                icon: 'image',
                onclick: function (e) {
                    inp.trigger('click');
                }
            });
        }

    });




});