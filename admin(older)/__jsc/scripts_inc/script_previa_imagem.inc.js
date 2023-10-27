/**
 * script_previa_imagem.inc.js - <b>SCRIPT PREVIA DE IMAGENS</b>
 * Arquivo de inclusão do scripts.js para armazenar os script de previa de imagens do sistema
 */

//    PREVIA DE IMAGEM UPADA
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(".j_previa").attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }

}

$(".j_imagem").change(function () {
    readURL(this);
});

$(".js_excluir_cover").click(function(){
   
   $(this).remove();
   $(".j_previa").attr('src', '');
   $("input[name=limpar_cover]").val('1');
    
});



// PREVIA DE VIDEO CADAASTRADO
$(".j_url").keyup(function () {

    $('.j_previa_video').html('<iframe class="media" src="https://www.youtube.com/embed/' + $(this).val() + '" frameborder="0" allowfullscreen></iframe>');

    return false;
});

