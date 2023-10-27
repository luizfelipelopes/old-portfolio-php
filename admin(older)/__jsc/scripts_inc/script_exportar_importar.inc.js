/**
 * script_exportar_importar.inc.js - <b>SCRIPT EXPORTAR E IMPORTAR DOCUMENTOS</b>
 * Arquivo de exportação e importação do scripts.js para armazenar os script de exportação e importação do sistema
 */

$('body').on("click", ".js_export", function () {

    var acao = $(this).attr("attr-action");
    var url = $(this).attr("attr-url");
    console.log(acao);

    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: acao},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (data) {

            if (data.error) {
                $('.trigger-box').fadeIn();
                $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
            } else {
                $('.trigger-box').fadeOut('fast');
            }

            if (data.result) {
                console.log(data.result[0]);
                var dados = [];
                $.each(data.result[0], function (idx2, val2) {
                    var str = idx2 + ":" + val2;
                    dados.push(str);
                });
                console.log(dados);
//                document.location.href = url + '&download_file=' + data.result[0];

            }

        }

    });
});