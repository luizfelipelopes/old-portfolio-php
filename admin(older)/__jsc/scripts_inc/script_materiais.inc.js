/**
 * script_materiais.inc.js - <b>SCRIPT MATERIAIS</b>
 * Arquivo de inclusão do scripts.js para Gerenciamento de Materiais das Disciplinas do Curso do Sistema
 */

//BOTOES DE GESÂO DE MATERIAIS======================================================================================
$('body').on('click', '.j_mais_materiais', function () {

    $('.j_up_material').find('.j_inputs').append('<input type="file" multiple title="Material" name="material_aula[]" class="m-bottom1" />');
    return false;
});

$('body').on('click', '.j_editar_material', function () {
    var idPuro = $(this).parent('.j_material_listado').attr('id');
    var id = '#' + idPuro;
    $(id).fadeOut();
    $(id).html('<input type="hidden" name="material_id[]" value="' + idPuro + '" /> <input type="file" multiple title="Material" name="material_aula[]" class="m-bottom1" />');
    $(id).fadeIn();
    return false;
});
//BOTOES DE GESÂO DE MATERIAIS======================================================================================



