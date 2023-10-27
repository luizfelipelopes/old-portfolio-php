/**
 * script_login_logout.inc.js - <b>SCRIPT DE CREDENCIAIS</b>
 * Arquivo de inclusão do scripts.js para Login e Logout no Sistema
 */

//SAIR DO SISTEMA
$('.j_logout').click(function () {

    $.ajax({
        url: 'ajax/ajax.php',
        data: {action: 'logoff'},
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (data) {

            if (data.caminho) {
                window.location.href = data.caminho;
            }

        }


    });
});



