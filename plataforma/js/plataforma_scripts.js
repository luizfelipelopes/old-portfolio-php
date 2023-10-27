$(function () {


    $('#j_andamento').mouseenter(function(){
       
       var action = $(this).attr('attr-action');
       
        $.ajax({
          
            url:'ajax/ajax.php',
            data:{action: action},
            type:'POST',
            dataType: 'json',
            beforeSend: function () {
                
            },
            success: function (data) {
                
            }
            
            
        });
        
    });



//FORMULÁRIO QUE IRÀ SUBMETER TODOS OS FORMES DA PLATAFORMA
    $('form').submit(function () {

//        tinyMCE.triggerSave(true, true);

        var form = $(this);
        var dados = $(this).serializeArray();

        form.ajaxSubmit({
            url: 'ajax/ajax.php',
            data: dados,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.load').fadeIn(500);
            },
            success: function (data) {

                $('.load').fadeOut();
                form.find('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");

//                console.log("sucesso");

                if (data.result) {

                    $('.comentarios').find('.j_dinamic_comentario').fadeOut();
                    var total = data.total;
                    $('.comentarios').find('.j_dinamic_comentario').append(data.result[total-1]);

//                    for (var i = 1; i < total; i++) {
//                        $('.comentarios').find('.j_dinamic').append(data.result[i]);
//                    }

                    $('.comentarios').find('.j_dinamic_comentario').fadeIn();
                    data.result = null;


                }
                
                if(data.result_comentarios){
                    
                    var id = '#resposta' + data.comentario_pai; 
                    console.log(id);
                    
                    $(id).find('.j_dinamic').fadeOut();
                    var total = data.total_resposta;
                    $(id).html(data.result_comentarios[0]);

                    for (var i = 1; i < total; i++) {
                        $(id).append(data.result_comentarios[i]);
                    }

                    $(id).find('.j_dinamic').fadeIn();
                    $(id).children('.j_responder').fadeIn();
                    data.result_comentarios = null;
                }
                

                if (!data.id) {
                    $('input[type=text], select, input[type=date], input[type=tel], textarea').val('');
                    $('textarea').val('');
                    $('select').val('');
                }



            }

        });

        return false;
    });


//    PREVIA DE IMAGEM UPADA=====================================================================
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
//    PREVIA DE IMAGEM UPADA=====================================================================






    
//    AÇÔES PARA O MENU DO ALUNO=====================================================
    $('body').on('click', '.j_menu_cursos', function () {

        $('.j_meus_cursos').fadeIn();
        $('.j_minhas_notas').fadeOut();
        $('.j_meus_pedidos').fadeOut();
        $('.j_meus_dados').fadeOut();
        $('.j_meu_endereco').fadeOut();
        $('.j_minha_senha').fadeOut();

    });

    $('body').on('click', '.j_menu_notas', function () {

        $('.j_meus_cursos').fadeOut();
        $('.j_minhas_notas').fadeIn();
        $('.j_meus_pedidos').fadeOut();
        $('.j_meus_dados').fadeOut();
        $('.j_meu_endereco').fadeOut();
        $('.j_minha_senha').fadeOut();

    });
    
    
    $('body').on('click', '.j_menu_pedidos', function () {

        $('.j_meus_cursos').fadeOut();
        $('.j_minhas_notas').fadeOut();
        $('.j_meus_pedidos').fadeIn();
        $('.j_meus_dados').fadeOut();
        $('.j_meu_endereco').fadeOut();
        $('.j_minha_senha').fadeOut();

    });

    $('body').on('click', '.j_menu_dados', function () {

        $('.j_meus_cursos').fadeOut();
        $('.j_minhas_notas').fadeOut();
        $('.j_meus_pedidos').fadeOut();
        $('.j_meus_dados').fadeIn();
        $('.j_meu_endereco').fadeOut();
        $('.j_minha_senha').fadeOut();

    });

    $('body').on('click', '.j_menu_endereco', function () {

        $('.j_meus_cursos').fadeOut();
        $('.j_minhas_notas').fadeOut();
        $('.j_meus_pedidos').fadeOut();
        $('.j_meus_dados').fadeOut();
        $('.j_meu_endereco').fadeIn();
        $('.j_minha_senha').fadeOut();

    });


    $('body').on('click', '.j_menu_senha', function () {

        $('.j_meus_cursos').fadeOut();
        $('.j_minhas_notas').fadeOut();
        $('.j_meus_pedidos').fadeOut();
        $('.j_meus_dados').fadeOut();
        $('.j_meu_endereco').fadeOut();
        $('.j_minha_senha').fadeIn();

    });
//    AÇÔES PARA O MENU DO ALUNO=====================================================


//    FECHA MENSAGENS DE ERRO
    $('.trigger-box').on('click', '.ajax_close', function () {

        $('.trigger').fadeOut();

    });


    $('body').on('click', '.j_botao_material', function () {

        var id = "#" + $(this).attr('id');

        console.log('clicou');
//        $(this).parents('.modulos-site').find('.j_popup').fadeIn();
        $(id).fadeIn();

        return false;
    });
    
    
      //AÇÔES DOS BOTÔES DE RESPOSTA=======================================================================
    $('.j_responder').click(function () {
        
        var idTextArea = "#" + $(this).parents('.comentarios').find(".j_resposta").attr('id');
        $(idTextArea).fadeToggle();
        
        if($(this).text() === 'Responder'){
            $(this).text('Cancelar');
            
        }else{
            $(this).text('Responder');
        }
        
        return false;
    });

    

//    PARA FECHAR JANELA COM BOTAO ESC
    $(document).bind('keydown', function (e) {

        if (e.which == 27) {
            $('.j_popup').fadeOut();
        }
    });


});