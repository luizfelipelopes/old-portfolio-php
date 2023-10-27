$(function (){

	SESSION = $('#session').text();


	PagSeguroDirectPayment.setSessionId(SESSION); // Seta Sessão

	// Recupera Métodos de Pagamentos Disponíveis
	PagSeguroDirectPayment.getPaymentMethods({
		amount: 500.00,
		success: function(response) {
		    // Retorna os meios de pagamento disponíveis.
		    //console.log(response);
		},
		error: function(response) {
		    // Callback para chamadas que falharam.
		    console.log(response);
		},
		complete: function(response) {
		    // Callback para todas chamadas.
		    // console.log(response);
		}
	});

	// Identificador com os dados do comprador


	$('form').on('keyup', '#hash', function(){

		var fieldHash = $(this);

		PagSeguroDirectPayment.onSenderHashReady(function(response){
		    if(response.status == 'error') {
		        console.log(response.message);
		        return false;
		    }
		    var hash = response.senderHash; //Hash estará disponível nesta variável.
		    //console.log(hash);
		    // $('form').find('#hash').val(hash);
		    fieldHash.val(hash);
		});

	});

	

	
	// Recupera bandeira do cartão que está sendo editada
	PagSeguroDirectPayment.getBrand({
	    cardBin: 411111,
	    success: function(response) {
	      //bandeira encontrada
	      //console.log(response);

	    },
	    error: function(response) {
	      //tratamento do erro
	      // console.log(response);
	    },
	    complete: function(response) {
	      //tratamento comum para todas chamadas
	     // console.log(response);
	    }
	});

	// Exibe opções de parcelamentos disponíveis ao comprador

	$('form #installmentQuantity').keyup(function(){

		var installments = $(this).val();
		var totalCart = $('form').find('#totalCart').val();
		var shippingCost = $('form').find('#shippingCost').val();
		var amount = parseFloat(totalCart) + parseFloat(shippingCost);

		PagSeguroDirectPayment.getInstallments({
        amount: amount,
        maxInstallmentNoInterest: 2,
        brand: 'visa',
        success: function(response){
       	    // Retorna as opções de parcelamento disponíveis
       	    var installmentAmount = response.installments.visa[installments-1].installmentAmount;
       	    var totalAmount = response.installments.visa[installments-1].totalAmount;
       	    var quantity = response.installments.visa[installments-1].quantity;
       	    console.log(installmentAmount);
       	    console.log(totalAmount);
       	    console.log(quantity);
       	    //console.log(response);
       	    
       	    //$('form').find('#itemAmout').val(totalAmount);
       	    $('form').find('#installmentValue').val(installmentAmount);


       },
        error: function(response) {
       	    // callback para chamadas que falharam.
       	    console.log(response);
       },
        complete: function(response){
            // Callback para todas chamadas.
            //console.log(response);
       }
	});


	});

	

	// Utiliza o dados do cartão de crédito para gerar um token
	PagSeguroDirectPayment.createCardToken({
	   cardNumber: '4111111111111111', // Número do cartão de crédito
	   brand: 'visa', // Bandeira do cartão
	   cvv: '013', // CVV do cartão
	   expirationMonth: '12', // Mês da expiração do cartão
	   expirationYear: '2026', // Ano da expiração do cartão, é necessário os 4 dígitos.
	   success: function(response) {
	        // Retorna o cartão tokenizado.
	        //console.log(response);
	        $('form').find('#tokenCard').val(response.card.token);
	   },
	   error: function(response) {
			    // Callback para chamadas que falharam.
			    console.log(response);
	   },
	   complete: function(response) {
	        // Callback para todas chamadas.
	        //console.log(response);
	   }
	});


	$('body').on('submit', 'form', function(){

		var data = $(this).serializeArray();

		$.ajax({

			url: 'ajax.php',
			data: data,
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){

			},
			success: function(data){

			}

		});

		return false;

	});



});