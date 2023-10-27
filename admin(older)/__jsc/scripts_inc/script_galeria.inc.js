/**
 * script_galeria.inc.js - <b>SCRIPT PARA GALERIA DE IMAGENS</b>
 * Arquivo de inclusão do scripts.js para armazenar os script de previa e gerenciamento de galeria de imagens do sistema
 */


    
    //    PREVIA DE GALERIA UPADA

    function readGalleryURL(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;
            var number = 1 + Math.floor(Math.random() * 100);
            var number2 = 100 + Math.floor(Math.random() * 1000);
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                var number = 1 + Math.floor(Math.random() * 100);
                var number2 = 100 + Math.floor(Math.random() * 1000);
                var x = 1;
                reader.onload = function (e) {
                    $(placeToInsertImagePreview).append('<div class="gallery gallery_real_time" id="gb-' + x + '-' + (number + number2) + '"></div>');
                    $($.parseHTML('<img>')).attr('src', e.target.result).appendTo('#gb-' + x + '-' + (number + number2));
                    $('<div id="' + 'gb-' + x + '-' + (number + number2) + '" class = "delete_galeria">x</div>').appendTo('#gb-' + x + '-' + (number + number2));
                    x++;
                };
                reader.readAsDataURL(input.files[i]);
            }

        }

    };
    
    $("body").on('change', '.j_gallery', function () {

        readGalleryURL(this, '.gallery_itens');
        if (!this.files) {
            $('.gallery_itens').html('');
        }

    });
//    DELETAR GALERIA
    $("body").on('click', '.delete_galeria', function () {

        var id = "#" + $(this).attr('id');
        console.log(id);
        $(id).fadeOut();
//        var id = "#" + $(this).attr('id');
//        var item = "#" + id;
        var acao = $(this).attr('attr-action');
        console.log(acao);
        if (acao) {

            $.ajax({
                url: 'ajax/ajax.php',
                data: {action: acao, id: id},
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {

                }
                , success: function (data) {


                }
            });
        }

    });
