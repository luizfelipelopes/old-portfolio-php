$(function(){HOME=$('#j_base').attr('href');THEME=$('#j_theme').attr('href');var path=HOME+'/themes/'+THEME+'/ajax/ajax.php';$('.j_menu_mobile').click(function(event){event.stopPropagation();if(!$(this).hasClass('active')){$(this).addClass('active');$('.main_nav').animate({left:'0px'},300);$('.j_close').fadeIn(200);}else{$(this).removeClass('active');$('.main_nav').animate({left:'-100%'},300);$('.j_close').animate({left:'-200%'},300);}});$('.j_close').click(function(){$('.j_menu_mobile').removeClass('active');$('.main_nav').animate({left:'-100%'},300);$(this).animate({left:'-200%'},300);});$('html').click(function(){$('.j_menu_mobile').removeClass('active');$('.main_nav').animate({left:'-100%'},300);$('.j_close').animate({left:'-200%'},300);});$('.js_menu a').click(function(){var goto=$($(this).attr('href')).position().top;console.log(goto);$('.main_nav').css('cssText',"left: -100%;");$('.j_menu_mobile').removeClass('active');$('html, body').animate({scrollTop:goto},1000);return false;});$('.js_subir_topo').click(function(){$('html, body').animate({scrollTop:0},1000);return false;});$(window).scroll(function(){if($(this).scrollTop()>$('.js_bloco_header').outerHeight()-10){$('.js_subir_topo').fadeIn(300);}else{$('.js_subir_topo').fadeOut(300);}});$('#ingressos').on('click','.js_ingresso_menor',function(){$('input[name=cliente_name_responsavel]').val('');$('input[name=cliente_name]').val('');$('input[name=cliente_lastname]').val('');$('input[name=cliente_telefone]').val('');$('input[name=cliente_cpf]').val('');$('input[name=cliente_endereco]').val('');$('input[name=cliente_numero]').val('');$('input[name=cliente_bairro]').val('');$('select[name=cliente_uf]').val('');$('input[name=cliente_cep]').val('');$('input[name=cliente_email]').val('');$('.js_bloco_ingresso_menor').fadeIn();$('html, body').animate({scrollTop:0},1000);return false;});$('#ingressos').on('click','.js_ingresso_maior',function(){$('input[name=cliente_name_responsavel]').val('');$('input[name=cliente_name]').val('');$('input[name=cliente_lastname]').val('');$('input[name=cliente_telefone]').val('');$('input[name=cliente_cpf]').val('');$('input[name=cliente_endereco]').val('');$('input[name=cliente_numero]').val('');$('input[name=cliente_bairro]').val('');$('select[name=cliente_uf]').val('');$('input[name=cliente_cep]').val('');$('input[name=cliente_email]').val('');$('.js_bloco_ingresso_maior').fadeIn();$('html, body').animate({scrollTop:0},1000);return false;});$('body').on('click','.ajax_close',function(){$('.j_popup').fadeOut();});$(document).bind('keydown',function(e){if(e.which==27){$('.j_popup').fadeOut();}});setInterval(function(){var now=new Date();var eventDate=new Date(2018,08,07,18);var currentTime=now.getTime();var eventTime=eventDate.getTime();var remTime=eventTime-currentTime;var s=Math.floor(remTime/1000);var m=Math.floor(s/60);var h=Math.floor(m/60);var d=Math.floor(h/24);h%=24;m%=60;s%=60;h=(h<10?'0'+h:h);m=(m<10?'0'+m:m);s=(s<10?'0'+s:s);if(remTime==0){$('.js_countdown').html('<h1 class="al-center font-bold" style="margin: 50px auto !important;">É HOJE!</h1>');}else if(remTime<0){$('.js_countdown').html('<h1 class="al-center font-bold" style="margin: 50px auto !important;">EVENTO ENCERRADO!</h1>');}else{$('.js_dias').text(d);$('.js_horas').text(h);$('.js_minutos').text(m);$('.js_segundos').text(s);}},'1000');$('body').on('submit','form',function(){var form=$(this);var dados=$(this).serialize();console.log('Entrou cdn');form.ajaxSubmit({url:path,data:dados,type:'POST',dataType:'json',beforeSubmit:function(){$('.load').fadeIn();},success:function(data){$('.load').fadeOut();if(data.caminho){console.log(data.caminho);window.location.href=data.caminho;}if(data.error){if(!data.id){form.find('input[type!=submit],input[type!=hidden], select, textarea').val('');}$('.trigger-box').html("<p class=\"trigger "+data.error[1]+"\">"+data.error[0]+"<span class=\"ajax_close\">X</span></p>");$('.trigger-box-suspenso').html("<p class=\"trigger "+data.error[1]+"\">"+data.error[0]+"<span class=\"ajax_close\">X</span></p>");$('.trigger-box-suspenso').fadeIn(400);setTimeout(function(){$('.trigger-box-suspenso').fadeOut();},5000);}}});return false;});$("#cpf").mask("999.999.999-99",{autoclear:false});$("#cpf2").mask("999.999.999-99",{autoclear:false});$('.js_bloco_cpf').on('keyup','.js_auto_preencher',function(){var cpf=$(this).val();console.log(cpf);$.post(path,{action:'auto_preencher',cpf:cpf},function(data){if(data.comprador){$('input[name=cliente_name_responsavel]').val(data.comprador['cliente_name_responsavel']);$('input[name=cliente_name]').val(data.comprador['cliente_name']);$('input[name=cliente_lastname]').val(data.comprador['cliente_lastname']);$('input[name=cliente_telefone]').val(data.comprador['cliente_telefone']);$('input[name=cliente_endereco]').val(data.comprador['cliente_endereco']);$('input[name=cliente_numero]').val(data.comprador['cliente_numero']);$('input[name=cliente_bairro]').val(data.comprador['cliente_bairro']);$('select[name=cliente_cidade]').html(data.cidade);$('select[name=cliente_uf]').val(data.comprador['cliente_uf']);$('input[name=cliente_cep]').val(data.comprador['cliente_cep']);$('input[name=cliente_email]').val(data.comprador['cliente_email']);}},'json');});});