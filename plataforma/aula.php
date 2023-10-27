<?php
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$tutor = filter_input(INPUT_GET, 'tutor', FILTER_VALIDATE_BOOLEAN);
?>

<?php
//var_dump($_SESSION['clientelogin']);

$readAula = new Read;
$readAula->ExeRead("cetrhema_aulas", "WHERE aula_id = :aula", "aula={$id}");

$readModulo = new Read;
$readModulo->ExeRead("cetrhema_modulos", "WHERE modulo_id = :modulo", "modulo={$readAula->getResult()[0]['aula_modulo']}");

$readCurso = new Read;
$readCurso->ExeRead("cetrhema_cursos", "WHERE curso_id = :curso", "curso={$readModulo->getResult()[0]['modulo_curso']}");
?>

<section class="container curso_detalhes" id="j_andamento" attr-action="create_andamento">

    <div class="exibir_janela j_popup" id="<?= $id; ?>">

        <div class="materiais_aluno container bg-body">

            <div class="ajax_close fechar_materiais">X</div>

            <header>
                <h1>Baixe Aqui os seus Materiais</h1>
            </header>


            <div class="content">


                <?php
                $readMateriais = new Read;
                $readMateriais->ExeRead("cetrhema_materiais", "WHERE material_aula = :id", "id={$id}");

                if (!$readMateriais->getResult()):
                    ?>
                    <div class="box box-medium material_item m-bottom1"><p>Não há materiais disponíveis no momento!</p></div>
                    <?php
                else:

                    foreach ($readMateriais->getResult() as $material):
                        ?>

                        <div class="box box-medium material_item m-bottom1">
                            <a class="shorticon shorticon-folder shorticon-botao" title="<?= $material['material_title']; ?>" target="_blank" href="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $material['material_name']; ?>"><?= $material['material_title']; ?> </a>
                        </div>


                        <?php
                    endforeach;
                endif;
                ?>






                <!--                <div class="box box-medium material_item">
                                    Material 2
                                </div>
                
                                <div class="box box-medium material_item last">
                                    Material 3
                                </div>-->


                <div class="clear"></div>

            </div>
        </div>
    </div>



    <?php
    $read = new Read();
    $read->ExeRead("cetrhema_aulas", "WHERE aula_id = :id", "id={$id}");
    if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
        extract($read->getResult()[0]);

        if (isset($_SESSION['clientelogin']['cliente_id']) && $tutor):
            $arrayUltimaAula = ["cliente_ultima_aula" => $aula_title];

            $ultimaAula = new Update;
            $ultimaAula->ExeUpdate("cetrhema_clientes", $arrayUltimaAula, "WHERE cliente_id = :id", "id={$_SESSION['clientelogin']['cliente_id']}");
        endif;

    endif;
    ?>


    <article class="container bg-light cabecalho_aula">

        <div class="content">

            <header>
                <p class="font-bold"> <a class="" href="<?= ($tutor ? HOME . DIRECTORY_SEPARATOR . 'plataforma?exe=home&tutor=true' : HOME . DIRECTORY_SEPARATOR . 'plataforma'); ?>"> Início </a> >> <a href="<?= ($tutor ? HOME . '/plataforma/?exe=curso&name=' . $readCurso->getResult()[0]['curso_name'] . '&tutor=true' : HOME . '/plataforma/?exe=curso&name=' . $readCurso->getResult()[0]['curso_name']); ?>"> <?= $readCurso->getResult()[0]['curso_title']; ?> </a> >> <a href="<?= ($tutor ? HOME . '/plataforma/?exe=curso&name=' . $readCurso->getResult()[0]['curso_name'] . '&tutor=true#' . $readModulo->getResult()[0]['modulo_name'] : HOME . '/plataforma/?exe=curso&name=' . $readCurso->getResult()[0]['curso_name'] . '#' . $readModulo->getResult()[0]['modulo_name']); ?>"> <?= $readModulo->getResult()[0]['modulo_title']; ?></a></p>
            </header>

            <div class="clear"></div>
        </div>
    </article>   

    <article class="container plataforma_aula_conteudo bg-body">

        <div class="content">


            <header class="sectiontitle">
                <h1><?= $aula_title; ?></h1>
                <p class="tagline"></p>
            </header>



            <!--            <h1 class="m-bottom1">1. Testando o Material</h1>-->
                        <!--<p><?= $aula_descricao; ?> </p>-->

        </div>



    </article>


    <div class="bg-gray al-center video_material">
        <div class="content al-center">

            <div class="box video-large ds-none">
                <div class="video no-margin video_chamada_curso">
                    <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/<?= $aula_video; ?>" frameborder="0" allowfullscreen></iframe></div>
                </div>
            </div>      


            <?php
            $readMateriais = new Read;
            $readMateriais->ExeRead("cetrhema_materiais", "WHERE material_aula = :id", "id={$id}");

            if (!$readMateriais->getResult()):
                WSErro("Não há materiais Cadastrados!", WS_INFOR);
            else:
                ?>

                <a id="<?= $id; ?>" class="btn btn-green radius btn_material_aula j_botao_material m-top2" href="#">Baixar Material</a>

            <?php endif; ?>
            <div class="clear"></div>

        </div>
    </div>

    <!--    <article class="container plataforma_aula_conteudo bg-body">
    
            <div class="content">
    
    
                <header class="sectiontitle">
                    <h1><?= $aula_title; ?></h1>
                    <p class="tagline"></p>
                </header>
    
    
    
                <h1 class="m-bottom1">1. Testando o Material</h1>
                <p><?= $aula_descricao; ?> </p>
                
            </div>
    
    
    
        </article>-->
    <article class="container plataforma_aula_conteudo bg-body">
        <div class="content">
            <p><?= $aula_descricao; ?> </p>
        </div>
    </article>

    <article class="curso_plataforma_aulas">

        <!--RECADOS-->
        <section class="container main-conteudo comentarios bg-body">

            <div class="content">

                <header class="container m-bottom3">
                    <h1 class="fl-left">Comentários</h1>
                    <div class="b-bottom fl-left"></div>    
                </header>

                <div class="comentarios-lista j_dinamic_comentario">

                    <div class="content">


                        <?php
                        $readRecado = new Read();
                        $readRecado->ExeRead("cetrhema_comentarios", "WHERE comentario_status = 1 AND (comentario_type = :type OR comentario_type = :resposta) AND comentario_aula = :aula", "type=tickets&resposta=tickets(resposta)&aula={$id}");
                        if (!$readRecado->getResult()):
                            WSErro("Ainda não existem Comentários! Seja o primeiro a nos deixar um recado!", WS_INFOR);

                        else:

                            $View = new View;
                            $tpl_comentario = $View->Load('comentario');

                            foreach ($readRecado->getResult() as $recado):
//                                extract($recado);

                                $recado['comentario_date'] = date('d/m/Y H\hi', strtotime($recado['comentario_date']));
                                $recado['comentario_menor'] = Check::Words($recado['comentario_content'], 10);
                                $recado['comentario_condicional'] = (Check::countWords($recado['comentario_content']) > 10 ? "<span class=\"container comentarios-conteudo m-top1 j_parcial ds-none\">" . Check::Words($recado['comentario_content'], 10) . "<a href=\"#\" class=\"j_mais\">mais</a> </span><span class=\"container comentarios-conteudo m-top1 j_completo\">" . $recado['comentario_content'] . " <a href=\"#\" class=\"j_menos ds-none\">ocultar</a></span>" : "<span class=\"container comentarios-conteudo m-top1\">" . $recado['comentario_content'] . "</span>");

                                $View->Show($recado, $tpl_comentario);
                                ?>

                                <div class="comentarios-resposta" id="resposta<?= $recado['comentario_id']; ?>">

                                    <?php
                                    $comentarioResposta = new Read;
                                    $comentarioResposta->ExeRead(COMENTARIOS, "WHERE comentario_resposta = :comentario_id ORDER BY comentario_date ASC", "comentario_id={$recado['comentario_id']}");
                                    $View = new View;
                                    $tpl_resposta = $View->Load('comentario-resposta-plataforma');

                                    if (!$comentarioResposta->getResult()):
                                        WSErro("Nenhum Comentário!", WS_INFOR);
                                    else:
                                        foreach ($comentarioResposta->getResult() as $resposta):

                                            $resposta['comentario_pai'] = $resposta['comentario_id'];


                                            if (isset($resposta['comentario_user'])):
                                                $readUser = new Read;
                                                $readUser->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$resposta['comentario_user']}");
                                                if ($readUser->getResult()):
                                                    $resposta['comentario_cover'] = $readUser->getResult()[0]['user_foto'];
                                                endif;
                                            elseif (isset($resposta['comentario_cliente'])):
                                                $readCliente = new Read;
                                                $readCliente->ExeRead(CLIENTES, "WHERE cliente_id = :id", "id={$resposta['comentario_cliente']}");
                                                if ($readCliente->getResult()):
                                                    $resposta['comentario_cover'] = $readCliente->getResult()[0]['cliente_cover'];
                                                endif;
                                            else:
                                                $resposta['comentario_cover'] = '/usuarios/perfil-user.png';
                                            endif;

                                            $resposta['comentario_cover'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . $resposta['comentario_cover'];
                                            $resposta['comentario_date'] = date('d/m/Y H\hi', strtotime($resposta['comentario_date']));

                                            if (Check::countWords($resposta['comentario_content']) > 10):
                                                $resposta['comentario_content'] = '<span class="comentarios-conteudo m-top1 j_parcial_resposta">' . Check::Words($resposta['comentario_content'], 10) . '<a href="#" class="j_mais_resposta">mais</a> </span> <span class="comentarios-conteudo m-top1 j_completo_resposta">' . $resposta['comentario_content'] . '<a href="#" class="j_menos_resposta">ocultar</a></span>';
                                            else:
                                                $resposta['comentario_content'] = '<span class="comentarios-conteudo m-top1">' . $resposta['comentario_content'] . '</span>';
                                            endif;

                                            if ($resposta['comentario_status'] == '1'):
                                                $resposta['botao_status'] = '<a title="Aprovado" class="btn btn-green radius shorticon shorticon-publicado j_aprovado"></a>';
                                            else:
                                                $resposta['botao_status'] = '<a title="Pendente" class="btn btn-yellow radius shorticon shorticon-pendente m-top1 j_espera"></a>';
                                            endif;

                                            $View->Show($resposta, $tpl_resposta);


                                        endforeach;
                                    endif;
                                    ?>


                                    
                                    

                                </div>


                                    <form action="" method="post" class="j_resposta" id="j_resposta<?= $recado['comentario_id']; ?>">
                                        <div class="trigger-box-suspenso"></div>
                                        <input type="hidden" name="action" value="create_resposta">
                                        <input type="hidden" name="comentario_resposta" value="<?= $recado['comentario_id']; ?>">
                                        <textarea id="resposta" name="comentario_content" rows="5" class="m-top3 m-bottom1"></textarea>
                                        <button class="btn btn-blue fl-right radius j_enviar_resposta">Enviar</button>
                                        <div title="Carregando" class="load fl-right"></div>
                                        <!--<button class="btn btn-blue fl-right radius j_cancelar_resposta">Cancelar</button>-->
                                    </form>
                                    <a title="Ver Respostas" class="btn btn-blue radius m-top1 j_responder fl-right">Responder</a>


                                <?php
                            endforeach;

                        endif;
                        ?>





                        <div class="clear"></div>
                    </div>






                    </section>


                    </article>



                    <section class="container bg-body b-top">

                        <div class="content">

                            <header class="m-bottom2">
                                <h1>Deixe aqui a sua Dúvida</h1>
                                <p class="tagline">Escreve abaixo o seu comentário</p>
                            </header>

                            <form action="" method="post">
                                <label>
                                    <span>Comentário</span>

                                    <input type="hidden" name="comentario_aula" value="<?= $id; ?>" />
                                    <input type="hidden" name="action" value="create_comentario" />
                                    <input type="hidden" name="comentario_cover" value="<?= (isset($_SESSION['clientelogin']['cliente_cover']) ? $_SESSION['clientelogin']['cliente_cover'] : $_SESSION['userlogin']['user_foto']); ?>" />
                                    <input type="hidden" name="comentario_author" value="<?= (isset($_SESSION['clientelogin']['cliente_name']) ? $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname'] : $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname'] . ' - (Tutor)'); ?>" />
                                    <input type="hidden" name="comentario_email" value="<?= (isset($_SESSION['clientelogin']['cliente_email']) ? $_SESSION['clientelogin']['cliente_email'] : $_SESSION['userlogin']['user_email']); ?>" />
                                    <?php
                                    if (isset($_SESSION['clientelogin']['cliente_id']) && $tutor):

                                        $readCidade = new Read;
                                        $readCidade->ExeRead("app_cidades", "WHERE cidade_id = :id", "id={$_SESSION['clientelogin']['cliente_cidade']}");
                                        if ($readCidade->getResult()):
                                            ?>
                                            <input type="hidden" name="comentario_cidade" value="<?= $readCidade->getResult()[0]['cidade_nome'] . '-' . $readCidade->getResult()[0]['cidade_uf']; ?>" />
                                            <?php
                                        endif;

                                    else:
                                        ?>
                                        <input type="hidden" name="comentario_cidade" value="<?= 'Diamantina - MG' ?>" />
                                    <?php
                                    endif;
                                    ?>
                                    <input type="hidden" name="comentario_status" value="1" />    
                                    <input type="hidden" name="comentario_aula" value="<?= $id; ?>" />    
                                    <input type="hidden" name="comentario_type" value="<?= (isset($_SESSION['clientelogin']['cliente_id']) ? 'tickets' : 'tickets(resposta)'); ?>" />    
                                    <input type="hidden" name="comentario_date" value="<?= date("Y-m-d H:i:s"); ?>" />    
                                    <textarea title="" rows="5" name="comentario_content" class="input_fale m-top1"></textarea>
                                </label>

                                <button class="btn btn-green radius fl-right">Enviar</button>
                                <div title="Carregando" class="load fl-right"></div>
                            </form>


                            <div class="clear"></div>
                        </div>

                    </section>



                    </section>