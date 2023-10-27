
<!-- SIDEBAR -->

<!-- CONTENT_CONTEUDO -->
<section id="fale" class="container content_conteudo talk_us">

    <h1 class="caminho">Início &raquo; Fale Conosco</h1>

    <div class="content">

        <article class="content_fale_conosco">

            <h1 class="titulo_fale_conosco">Fale Conosco</h1>

            <p class="fale_conosco">Dúvidas, críticas ou sugetões? Entre em contato conosco! 
                Ficaremos gratos em atendê-los</p>

            <p class="fale_conosco">Email: cooperativaartesanal@yahoo.com.br</p>

            <p class="fale_conosco">Telefones: (38)3531-5249 / (38)98839-6754</p>

            <p class="fale_conosco">Endereço: Rua das Bicas, 115 - Bairro Serrano Diamantina-MG</p>

        </article>	

        <div class="divisao_forms">

            <img alt="" title="" src="<?= REQUIRE_PATH; ?>/images/divisao_forms.png" />

        </div>

        <div class="secao_form_fale">

            <?php
            $contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if ($contato && $contato['SendFormContato']):
                unset($contato['SendFormContato']);

                $contato['Assunto'] = "CARDI TAPETES - Seção Fale Conosco";
                $contato['DestinoNome'] = "Cooperativa Artesanal Regional de Diamantina";
                $contato['DestinoEmail'] = "feleplopes_16@yahoo.com.br";

                $email = new Email();
                $email->Enviar($contato);
                if ($email->getError()):
                    WSErro($email->getError()[0], $email->getError()[1]);
                endif;


//                    var_dump($email);


            endif;
            ?>        

            <article class="content_formulario content_form_fale">


                <form name="FormContato" class="form_fale formulario" action="#contato" method="post">

                    <label>	
                        <span>Nome:</span>			
                        <input class="input_fale" type="text" name="cliente_name" required/>
                    </label>

                    <label>	
                        <span>Email:</span>			
                        <input class="input_fale" type="email" name="cliente_email" required/>
                    </label>

                    <label>	
                        <span>Mensagem:</span>			
                        <textarea class="fale_area" type="password" name="Mensagem" rows="8" cols="30" required></textarea>
                    </label>


                    <input class="btn_form btn_fale" type="submit"  name="SendFormContato" value="Enviar" />

                </form>


            </article>
            <div class="clear"></div>
        </div>



        <div class="clear"></div><!-- CLEAR -->

    </div>
</section><!-- CONTENT_CONTEUDO -->



