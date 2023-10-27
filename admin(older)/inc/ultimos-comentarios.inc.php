<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!--COMENTÁRIOS/AVALIçÕES-->
<article class="container comentarios widgets-abaixo">

    <header class="bg-blue">
        <div class="content">
            <h1 class="caps-lock font-bold">Últimos Comentários/Avaliações:</h1>
            <div class="clear"></div>
        </div>
    </header>

    <div class="bg-body comentarios-lista">

        <div class="content">

            <div class="trigger-box m-bottom1 m-top1"></div>    

            <?php
            $readComentarios = new Read;
            $readComentarios->FullRead("SELECT comentario_id, comentario_author, comentario_content, comentario_post, comentario_produto, comentario_aula, comentario_cover, comentario_date, comentario_type, comentario_avaluation, comentario_status, comentario_resposta FROM " . COMENTARIOS . " ORDER BY comentario_date DESC LIMIT 3");
            if (!$readComentarios->getResult()):

                WSErro("Nenhum comentário ainda", WS_INFOR);
            else:

                foreach ($readComentarios->getResult() as $comentario):
                    extract($comentario);

                    $comentario['comentario_estrelas'] = HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . ($comentario['comentario_avaluation'] < 2 ? 'img/1-estrela.png' : ($comentario['comentario_avaluation'] >= 2 && $comentario['comentario_avaluation'] < 3 ? 'img/2-estrelas.png' : ($comentario['comentario_avaluation'] >= 3 && $comentario['comentario_avaluation'] < 4 ? 'img/3-estrelas.png' : ($comentario['comentario_avaluation'] >= 4 && $comentario['comentario_avaluation'] < 5 ? 'img/4-estrelas.png' : ($comentario['comentario_avaluation'] >= 5 ? 'img/5-estrelas.png' : '')))));
                    ?>

                    <div class="comentarios-linha" id="<?= $comentario_id; ?>">
                        <a href="?exe=comentarios&segment=<?= $comentario_type; ?>&id=<?= ($comentario_type == 'post' ? $comentario_post : ($comentario_type == 'review-produto' ? $comentario_produto : ($comentario_type == 'tickets' ? $comentario_aula : ''))); ?>"><img height="80" class="round" title="<?= $comentario_author ?>" alt="[<?= $comentario_author ?>]" src="<?= (!empty($comentario_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $comentario_cover : HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perfil-avatar.png'); ?>" /></a>
                        <div class="comentarios-info">
                            <!--<a class="js_get_author" href="?exe=comentarios&segment=<?= $comentario_type; ?>&id=<?= ($comentario_type == 'post' ? $comentario_post : ($comentario_type == 'review-produto' ? $comentario_produto : ($comentario_type == 'tickets' ? $comentario_aula : ''))); ?>">-->
                            <h1 class="container js_get_author"><?= $comentario_author ?></h1>
                            <!--</a>-->

                            <a href="?exe=comentarios&segment=<?= $comentario_type; ?>&id=<?= ($comentario_type == 'post' ? $comentario_post : ($comentario_type == 'review-produto' ? $comentario_produto : ($comentario_type == 'tickets' ? $comentario_aula : ''))); ?>">
                                <span class="comentarios-data">Em <?= date('d/m/Y H\hi', strtotime($comentario_date)); ?></span>
                                <span class="comentarios-categoria font-bold">Segmento: <?= $comentario_type; ?></span>


                            </a>
                            <?php
                            switch ($comentario_type):

                                case 'post':

                                    $readPost = new Read;
                                    $readPost->FullRead("SELECT post_title FROM " . POSTS, "WHERE post_id = :id", "id={$comentario_post}");
                                    if ($readPost->getResult()):
                                        ?>

                                        <a class="m-top1 container font-bold" href="?exe=comentarios&segment=<?= $comentario_type; ?>&id=<?= ($comentario_type == 'post' ? $comentario_post : ($comentario_type == 'review-produto' ? $comentario_produto : ($comentario_type == 'tickets' ? $comentario_aula : ''))); ?>">
                                            <span class="comentarios-categoria font-bold">Post: <?= $readPost->getResult()[0]['post_title']; ?></span>
                                        </a>

                                        <?php
                                    endif;


                                    break;
                                case 'review-produto':
                                    $readProduto = new Read;
                                    $readProduto->FullRead("SELECT produto_title FROM " . PRODUTOS, "WHERE produto_id = :id", "id={$comentario_produto}");
                                    if ($readProduto->getResult()):
                                        ?>

                                        <a class="m-top1 container font-bold" href="?exe=comentarios&segment=<?= $comentario_type; ?>&id=<?= ($comentario_type == 'post' ? $comentario_post : ($comentario_type == 'review-produto' ? $comentario_produto : ($comentario_type == 'tickets' ? $comentario_aula : ''))); ?>">
                                            <span class="comentarios-categoria font-bold">Produto: <?= $readProduto->getResult()[0]['produto_title']; ?></span>
                                        </a>

                                        <?php
                                    endif;

                                    break;
                                case 'tickets':
                                    $readAula = new Read;
                                    $readAula->FullRead("SELECT aula_title FROM " . POSTS, "WHERE aula_id = :id", "id={$comentario_aula}");
                                    if ($readAula->getResult()):
                                        ?>

                                        <a class="m-top1 container font-bold" href="?exe=comentarios&segment=<?= $comentario_type; ?>&id=<?= ($comentario_type == 'post' ? $comentario_post : ($comentario_type == 'review-produto' ? $comentario_produto : ($comentario_type == 'tickets' ? $comentario_aula : ''))); ?>">
                                            <span class="comentarios-categoria font-bold">Aula: <?= $readAula->getResult()[0]['aula_title']; ?></span>
                                        </a>

                                        <?php
                                    endif;
                                    break;
                                default :
                                    break;

                            endswitch;
                            ?>

                            <?php if(empty($comentario_resposta) && $comentario_resposta != '0'): ?>
                            
                            <a class="container" href="?exe=comentarios&segment=<?= $comentario_type; ?>&id=<?= ($comentario_type == 'post' ? $comentario_post : ($comentario_type == 'review-produto' ? $comentario_produto : ($comentario_type == 'tickets' ? $comentario_aula : ''))); ?>">
                                <img title="<?= $comentario_author ?>" alt="[<?= $comentario_author ?>]" src="<?= $comentario['comentario_estrelas']; ?>" />
                            </a>
                            
                            <?php endif; ?>
                            
                            <?php if (Check::countWords($comentario_content) > 10):
                                ?>
                                <div class="js_get_content">
                                    <span id="<?= $comentario_id; ?>" class="comentarios-conteudo m-top1 j_parcial"><span class="texto"><?= Check::Words($comentario_content, 10); ?></span><a href="#" class="j_mais">mais</a></span>
                                </div>

                                <div class="js_get_content">
                                    <span id="<?= $comentario_id; ?>" class="comentarios-conteudo m-top1 j_completo"><span class="texto"><?= $comentario_content; ?></span><a href="#" class="j_menos">ocultar</a></span>
                                </div>
                                <?php
                            else:
                                ?>
                                <div class="js_get_content">
                                    <span id="<?= $comentario_id; ?>" class="comentarios-conteudo m-top1"><span class="texto"><?= $comentario_content; ?></span></span>
                                </div>
                            <?php
                            endif;
                            ?>

                            <div class="comentarios-botoes ds-inblock m-top1 container" id="<?= $comentario_id; ?>">

                                <div class="botoes ds-inblock">

                                    <div class="comentarios-botoes-status ds-inblock">
                                        <?php
                                        if ($comentario_status == '1'):
                                            ?>
                                            <a title="Aprovado" class="btn btn-green radius shorticon shorticon-publicado j_aprovado"></a>
                                            <?php
                                        else:
                                            ?>

                                            <a title="Pendente" class="btn btn-yellow radius shorticon shorticon-pendente m-top1 j_espera"></a>

                                        <?php endif; ?>
                                    </div>         

                                    <a id="<?= $comentario_id; ?>" title="Editar Comentário" class="btn btn-orange radius shorticon shorticon-editar m-top1 js_editar_comentario"></a>
                                    <a title="Excluir" class="btn btn-red radius shorticon shorticon-excluir m-top1 j_confirm"></a>
                                    <div class="bloco-confirm" id="<?= $comentario_id; ?>">
                                        <small class="msg-confirm">Deseja excluir?</small>
                                        <a class="btn btn-orange btn-confirm btn-confirm-sim radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_comentario" id="<?= $comentario_id; ?>">Sim</a>
                                        <a class="btn btn-pink btn-confirm btn-confirm-nao radius j_cancelar" title="Cancelar Exclusão" href="#" id="<?= $comentario_id; ?>">Não</a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    </a>


                    <?php
                endforeach;

                $readFullComentarios = new Read;
                $readFullComentarios->FullRead("SELECT comentario_id, comentario_author, comentario_content, comentario_post, comentario_produto, comentario_aula, comentario_cover, comentario_date, comentario_type, comentario_avaluation, comentario_status FROM " . COMENTARIOS);
                if ($readFullComentarios->getRowCount() > 3):
                    ?>
                    <a href="?exe=comentarios-segmentos&segment=post" class="m-bottom1 fl-left ver-mais-comentarios"><p>Ver todos...</p></a>            
                    <?php
                endif;
            endif;
            ?>    

            <div class="clear"></div>
        </div>

    </div>
</article>
<!--COMENTÁRIOS/AVALIÇÕES-->
