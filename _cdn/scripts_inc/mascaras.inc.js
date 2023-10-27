/* 
 * mascaras.inc.js <b>SCRIPTS MÁSCARAS DO SISTEMA</b>
 * Script para ação referentes a Máscaras Aplicadas No Sistema
 */

//    MASCARA PARA CPF
$("#cpf").mask("999.999.999-99", {autoclear: false});

//    MASCARA PARA CPF
$(".cnpj").mask("99.999.999/9999-99", {autoclear: false});

//    MASCARA PARA HORAÁRIO
$(".js_horario").mask("99:99 Hrs", {autoclear: false});

$(".js_telfixo").mask("(99) 9999-9999", {autoclear: false});

$(".js_cel").mask("(99) 99999-9999", {autoclear: false});

//    MASCARA CARTEIRA PROFISSIONAL
$("#carteira_profissional").mask("99999999999", {autoclear: false});

//    MASCARA PARA SÉRIE
$("#serie").mask("9999", {autoclear: false});

//    MASCARA PARA NUMERO DE REGISTRO
$("#num_registro").mask("99999999999", {autoclear: false});

//    MASCARA PARA VALOR MONETARIO
$(".js_valor").maskMoney({
    thousands: '.',
    decimal: ',',
    symbolStay: true

});
