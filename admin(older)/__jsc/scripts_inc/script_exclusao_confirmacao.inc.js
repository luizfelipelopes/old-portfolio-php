/**
 * script_exclusao_confirmacao.inc.js - <b>SCRIPT PARA EXCLUSÃO E CONFIRMACAO DE ITENS DO SISTEMA</b>
 * Arquivo de inclusão do scripts.js para armazenar os script de Exclusão e Confirmação de Itens do Sistema
 */

//AÇÔES DOS BOTÔES DE EXCLUSÂO E CONFIRMAÇÂO=======================================================================
$('body').on('click', '.j_confirm', function () {
    $(this).fadeOut();
    $(this).parents('.botoes').children('.bloco-confirm').css("cssText", "display:inline-block;");
    return false;
});

$('body').on('click', '.j_cancelar', function () {
    $(this).parents('.bloco-confirm').fadeOut();
    $(this).parents('.botoes').children('.j_confirm').fadeIn();
    return false;
});

$('body').on('click', '.j_excluir', function () {

    var id = $(this).attr('id');
    var item = "#" + id;
    var acao = $(this).attr('attr-action');

    $.post('ajax/ajax.php', {action: acao, id: id}, function (data) {

        setTimeout(function () {
            $(item).fadeOut('slow');
        }, 100);

        if (data.result) {

            $('.posts').find('.content').fadeOut('slow');

            var total = data.total;

            $('.posts').find('.j_post_conteudo').html('');
            $('.posts').find('.j_post_conteudo').html(data.result[0]);

            for (var i = 1; i < total; i++) {
                $('.posts').find('.j_post_conteudo').append(data.result[i]);
            }

            $('.posts').find('.content').fadeIn();

            data.result = null;

        }

        if (data.show_field) {
            $(item).html('<input type="hidden" name="material_id[]" value="' + id + '" /> <input type="file" multiple title="Material" name="material_aula[]" class="m-bottom1" />');
        }

    }, 'json');


    return false;
});


//AÇÔES DOS BOTÔES DE EXCLUSÂO E CONFIRMAÇÂO=======================================================================


