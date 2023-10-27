/**
 * script_menu.inc.js - <b>SCRIPT MENUS</b>
 * Arquivo de inclusão do scripts.js para armazenar os script referentes ao menu do sistema
 */

//    SLIDE MENU MOBILE
    $('.j_menu_mobile').click(function () {

        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
            $('.main_nav').animate({left: '0px'}, 300);
            $('.j_close').fadeIn(200);
        } else {
            $(this).removeClass('active');
            $('.main_nav').animate({left: '-100%'}, 300);
            $('.j_close').fadeOut(200);
        }

    });
    
    //FECHAR MENU MOBILE
    $('.j_close').click(function () {
        $('.j_menu_mobile').removeClass('active');
        $(this).css('display', 'none');
        $('.main_nav').animate({left: '-100%'}, 300);
    });


    // SLIDE SUBMENU
    $(".menu li").click(function () {

        var id = $(this).attr('id'); // CAPTURA ID DO li
        var id_tralha = '#' + id; // POE TRALHA NO ID
        var id_tralha_ul = id_tralha + ' ul'; // ACRESENTA ul PARA MANIPULAR O SUBMENU DESSE ID

        if (!$(this).hasClass('ativo')) {
            $(this).addClass('ativo');
            $('.ativo .submenu').slideDown();
        } else {
            $(id_tralha_ul).slideUp();
            $(id_tralha).removeClass('ativo');
        }

        return false;
    });
    
//  REDIRECIONA A PÁGINA PARA O LINK QUE FOI CLICADO
// (ISSO É NECESSÁRIO POIS O SCRIPT DE SLIDE DO MENU RETIRA O COMPORTAMENTO CORRETO DOS LINKS)
    $('.link').click(function () {

        var link = $(this).attr('href');
        location.href = link;
    });
    $(".j_valor").keyup(function () {

        $(".j_desconto").prop("disabled", false);
    });
    //    DESCONTO EM REAL-TIME
    $(".j_desconto").keyup(function () {

        var valor = $(".j_valor").val();
        var desconto = $(this).val();
        var acao = $(this).attr('attr-desconto');
//        console.log(acao);

        $.ajax({
            url: 'ajax/ajax.php',
            data: {action: acao, produto_desconto: desconto, produto_valor: valor},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {

                if (data.error) {
                    $('.trigger-box').fadeIn();
                    $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
//                    $('.posts').find('.content').fadeOut();
//                    $('.cursos').find('.content').fadeOut();
                }

                if (data.produto_valor_descontado) {

                    $(".j_valor_descontado").val(data.produto_valor_descontado);
                }



            }
        });
    });
