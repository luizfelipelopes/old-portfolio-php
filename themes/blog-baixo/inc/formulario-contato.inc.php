<div class="divisao_form al-center">
    <span class="title">Mande um Recado Para Nós e Fique Sabendo das Novidades!</span>
    <span class="subtitle no-margin">(Não se preocupe, também odiamos Spam)</span>

    <?php
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($data)):

        $data['comentario_status'] = '0';
        $data['comentario_type'] = 'recados';
        $data['comentario_date'] = date('Y-m-d H:i:s');

        $adminComentario = new adminComentario;
        $adminComentario->ExeCreate($data);
        if ($adminComentario->getResult() && !empty($data)):
            header('Location: ' . HOME . '/sucesso/');
        else:
            WSErro("Erro ao cadastrar comentário! =)", WS_ERROR);
        endif;

    endif;
    ?>





    <form id="captura_lead" method="post" action="" class="contatos m-top1">




        <div class="trigger-box-suspenso"></div>

        <!--<input type="hidden" name="action" value="recados_nutrilowcarb" />-->

        <!--                    <label class="m-bottom1 medium">
                                <span class="m-bottom1">Foto(Opcional):</span>
                                <input type="file" name="comentario_cover" />
                            </label>-->

        <label class="m-bottom1 medium">
            <span class="m-bottom1">Nome:</span>
            <input type="text" name="comentario_author" title="Seu Nome:" placeholder="Seu Nome:" />
        </label>

        <label class="m-bottom1 medium">
            <span class="m-bottom1">Email (Deixe seu melhor E-mail):</span>
            <input type="email" name="comentario_email" title="Seu Email:" placeholder="Seu Melhor Email:" />
        </label>

        <!--                    <label class="m-bottom1 medium">
                                <span class="m-bottom1">Cidade:</span>
                                <input type="text" name="comentario_cidade" title="Sua Cidade:" placeholder="Sua Cidade: Ex. Diamantina-MG" />
                            </label>-->

        <label class="m-bottom1">
            <span class="m-bottom1">Mensagem:</span>
            <textarea rows="3" name="comentario_content" title="Sua Mensagem:" placeholder="Sua Mensagem:" ></textarea>
        </label>

        <button class="m-bottom1 btn btn-green radius fl-right">Enviar</button>
        <div title="Carregando" class="load fl-right"></div>

        <div class="clear"></div>
    </form>


    <div class="clear"></div>
</div>
