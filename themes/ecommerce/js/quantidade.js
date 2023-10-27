//// SCRIPTS RESPONSÁVEL PELA MANIPULAÇÂO DE PRODUTOS NO CARRINHO
//$(document).ready(function () {
//    
//    // RECEBE A QUANTIDADE ADICIONADA EM CADA PRODUTO
//    var qtd = $("#qtd");
//
//    // SEQUÊNCIA DE AÇÔES A SEREM REALIZADAS AO 
//    // DIGITAR A QUANTIDADE DE PRODUTOS NO CARRINHO
//    $("tbody #qtd").on('keyup', qtd, function (event) {
//        
//        var numItens = $(this).val(); // QUANTIDADE DE ITENS EM CADA PRODUTO
//        var id = $(this).attr('data_id'); // ID DO PRODUTO
//        var preco = $(this).attr('data_preco'); // VALOR UNITÀRIO DO PRODUTO
//        
//        // SE HOUVER O NÙMERO DIGITADO NO CAMPO DE QUANTIDADE FOR ZERO OU 
//        // ESPAÇO VAZIO, O NÚMERO DE ITENS SERÀ, POIS NÂO DEVE ACEITAR SOMAR ZERO QUANTIDDADES
//        // OU ESPAÇO VAZIO (DARIA ERRO)
//        if (numItens == '' || numItens == 0) {
//            numItens = 1;
//        }
//
//        // INICIALIZA A VARIÀVEL QUE RECEBERÀ O VALOR TOTAL DO CARRINHO
//        var st = 0;
//        
//        // LOOP (EQUIVALENTE FOREACH EM PHP) PARA CALCULAR O VALOR TOTAL DO CARRINHO
//        $('.cart-row').each(function () {
//            // RECUPERA SELETOR QUE POSSUEM A CLASS '.quantidade_carrinho'
//            var i = $('.quantidade_carrinho', this);
//            var up = $(i).attr('data_preco'); //RECUPERA O VALOR DO ATRIBUTO 'data_preco' DENTRO DO SELETOR COM A CLASSSE '.quantidade_carrinho'
//            var q = $(i).val(); // RECUPERA O VALOR DO SELETOR DA CLASSE '.quantidade_carrinho' QUE POSSUI O A QUANTIDADE DE ITENS DE CADA PRODUTO
//            st = st + (up * q); // O TOTAL DE TODOS OS ITENS É INSERIDO NA VARIÁVEL 'st'
//
//        });
//        
//        // VALOR SUBTOTAL È FORMATADO PARA SER EXIBIDO PARA O USUÀRIO
//        var tot = numeral(st.toFixed(2)).format('0,0.00');
//
//        tot = tot.replace('.', ',', 0); // MILHAR PASSA A SER SEPARADO POR PONTO AO INVÈS DE VIRGULA
//        tot = tot.replace(',', '.', 1); // DEZENA PASSA A SER SEPARADO POR VÌRGULA AO INVÈS DE PONTO
//
//        // VALOR TOTAL FORMATADO È MOSTRADO AO USUÀRIO
//        $('.j_subtotal').text('R$ ' + tot);
//        
//        // PEGA O CUSTO DE FRETE FIXO ATUAL
//        var custoFrete = parseInt($('#frete').html());
//        console.log(custoFrete);
//        st = st + custoFrete;
//        console.log(st);
//
//        // VALOR TOTAL È FORMATADO PARA SER EXIBIDO PARA O USUÀRIO
//        var tot = numeral(st.toFixed(2)).format('0,0.00');
//        tot = tot.replace('.', ',', 0); // MILHAR PASSA A SER SEPARADO POR PONTO AO INVÈS DE VIRGULA
//        tot = tot.replace(',', '.', 1); // DEZENA PASSA A SER SEPARADO POR VÌRGULA AO INVÈS DE PONTO
//
//        // VALOR TOTAL FORMATADO È MOSTRADO AO USUÀRIO
//        $('.j_total').text('R$ ' + tot);
//
//        // VALORES SÂO PASSADOS VIA AJAX PARA QUE OS DADOS SEJA ALTERADOS EM REAL-TIME
//        $.ajax({
//            
//            url: 'ajax/quantidade.php', // ARQUIVO ONDE OS DADOS RECEBIDOS SERÂO MANIPULADOS
//            type: 'POST', // SERÂO MANIPULADOS EM MÈTODO POST
//            data: 'item_total=' + (st - custoFrete) + '&item_quantidade=' + numItens + "&item_id=" + id + "&item_preco=" + preco, // DADOS A SEREM PASSADOS PARA O ARQUIVO
//            success: function (data) { // CASO TENHA SIDO BEM SUCEDIDO
//                // AS INFORMAÇÔES SERÂO PASSADAS PARA O SELETOR COM ID '#subtotal'
//                $(event.currentTarget).closest('tr').children('tbody #subtotal').html(data);
//
//            }
//        });
//
//    });
//
//    // SEQUÊNCIA DE AÇÔES A SEREM REALIZADAS AO 
//    // DIGITAR A QUANTIDADE DE PRODUTOS NO CARRINHO
//    $("tbody #qtd").on('change', qtd, function (event) {
//
//        var numItens = $(this).val(); // QUANTIDADE DE ITENS EM CADA PRODUTO
//        var id = $(this).attr('data_id'); // ID DO PRODUTO
//        var preco = $(this).attr('data_preco'); // VALOR UNITÀRIO DO PRODUTO
//
//        // SE HOUVER O NÙMERO DIGITADO NO CAMPO DE QUANTIDADE FOR ZERO OU 
//        // ESPAÇO VAZIO, O NÚMERO DE ITENS SERÀ, POIS NÂO DEVE ACEITAR SOMAR ZERO QUANTIDDADES
//        // OU ESPAÇO VAZIO (DARIA ERRO)
//        if (numItens == '' || numItens == 0) {
//            numItens = 1;
//        }
//
//        // INICIALIZA A VARIÀVEL QUE RECEBERÀ O VALOR TOTAL DO CARRINHO
//        var st = 0;
//        
//        // LOOP (EQUIVALENTE FOREACH EM PHP) PARA CALCULAR O VALOR TOTAL DO CARRINHO
//        $('.cart-row').each(function () {
//            // RECUPERA SELETOR QUE POSSUEM A CLASS '.quantidade_carrinho'
//            var i = $('.quantidade_carrinho', this); //RECUPERA O VALOR DO ATRIBUTO 'data_preco' DENTRO DO SELETOR COM A CLASSSE '.quantidade_carrinho'
//            var up = $(i).attr('data_preco'); //RECUPERA O VALOR DO ATRIBUTO 'data_preco' DENTRO DO SELETOR COM A CLASSSE '.quantidade_carrinho'
//            var q = $(i).val(); // RECUPERA O VALOR DO SELETOR DA CLASSE '.quantidade_carrinho' QUE POSSUI O A QUANTIDADE DE ITENS DE CADA PRODUTO
//            st = st + (up * q); // O TOTAL DE TODOS OS ITENS É INSERIDO NA VARIÁVEL 'st'
//
//
//        });
//        
//        // VALOR SUBTOTAL È FORMATADO PARA SER EXIBIDO PARA O USUÀRIO
//        var tot = numeral(st.toFixed(2)).format('0,0.00');
//
//        tot = tot.replace('.', ',', 0); // MILHAR PASSA A SER SEPARADO POR PONTO AO INVÈS DE VIRGULA
//        tot = tot.replace(',', '.', 1); // DEZENA PASSA A SER SEPARADO POR VÌRGULA AO INVÈS DE PONTO
//
//        // VALOR TOTAL FORMATADO È MOSTRADO AO USUÀRIO
//        $('.j_subtotal').text('R$ ' + tot);
//        
//        var custoFrete = parseInt($('#frete').html());
//        console.log(custoFrete);
//        st = st + custoFrete;
//        console.log(st);
//        
//        // VALOR TOTAL È FORMATADO PARA SER EXIBIDO PARA O USUÀRIO
//        var tot = numeral(st.toFixed(2)).format('0,0.00');
//
//        tot = tot.replace('.', ',', 0); // MILHAR PASSA A SER SEPARADO POR PONTO AO INVÈS DE VIRGULA
//        tot = tot.replace(',', '.', 1); // DEZENA PASSA A SER SEPARADO POR VÌRGULA AO INVÈS DE PONTO
//
//        // VALOR TOTAL FORMATADO È MOSTRADO AO USUÀRIO
//        $('.j_total').text('R$ ' + tot);
//
//        // VALORES SÂO PASSADOS VIA AJAX PARA QUE OS DADOS SEJA ALTERADOS EM REAL-TIME
//        $.ajax({
//            url: 'ajax/quantidade.php', // ARQUIVO ONDE OS DADOS RECEBIDOS SERÂO MANIPULADOS
//            type: 'POST', // SERÂO MANIPULADOS EM MÈTODO POST
//            data: 'item_total=' + (st - custoFrete) + '&item_quantidade=' + numItens + "&item_id=" + id + "&item_preco=" + preco, // DADOS A SEREM PASSADOS PARA O ARQUIVO
//            success: function (data) { // CASO TENHA SIDO BEM SUCEDIDO
//                // AS INFORMAÇÔES SERÂO PASSADAS PARA O SELETOR COM ID '#subtotal'
//                $(event.currentTarget).closest('tr').children('tbody #subtotal').html(data);
//            }
//        });
//
//    });
//
//});