
<?php
$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT); // RECEBE AÇÃO A SER EXECUTADA NO CARRINHO
?>

<?php
$read = new Read();
$read->ExeRead(CURSOS, "WHERE curso_name = :name", "name={$Link->getLocal()[1]}");
if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
    extract($read->getResult()[0]);

endif;
?>

<?php
// CASO ALGUMA AÇÃO FOI PASSADA POR URL
switch ($action):
    case 'salvar':

        if (!isset($_SESSION['clientelogin']['cliente_id'])):

            header('Location: ' . HOME);

        else:
//        VERIFICA SE CLIENTE JÁ COMPROU O CURSO
            $Cursos = null;
            foreach ($_SESSION['carrinho'] as $key => $value) :
                $Curso = $key;
            endforeach;

            $readCurso = new Read;
            $readCurso->ExeRead("cetrhema_vendas", "WHERE venda_cliente = :cliente AND venda_produto = :curso AND venda_transacao IS NOT NULL", "cliente={$_SESSION['clientelogin']['cliente_id']}&curso={$Curso}");
            if ($readCurso->getResult()): // SE COMPROU
//            O CARRINHO SERA ESVAZIADO
                unset($_SESSION['carrinho']);

//            SE NÃO TIVER NENHUM CURSO QUE ESTEJA PAGO ELE VOLTA PRA PÁGINA INICIAL
                if ($readCurso->getResult()[0]['venda_status'] != '3'):
                    header('Location: ' . HOME);
                else: //SE TIVER CURSO PAGO, SERÁ REDIRECIONADO PARA PLATAFORMA
                    header('Location: plataforma');
                endif;

            else:

//        SALVA CARRINHO E CRIA REGISTRO DA VENDA NA BD
                $adminCarrinho = new Carrinho();
                $adminCarrinho->ExeSalvar($_SESSION['carrinho']);

//       BUSCA ESSA VENDA REALIZADA 
                $readVenda = new Read;
                $readVenda->ExeRead("cetrhema_vendas", "WHERE venda_registro = :venda", "venda={$_SESSION['clientelogin']['venda_registro']}");
//        CRIA UM ARRAY COM O ID DO ALUNO QUE COMPROU O CURSO E O ID DO CURSO COMPRADO
                $Progresso = [
                    "progresso_aluno" => $_SESSION['clientelogin']['cliente_id'],
                    "progresso_curso" => $readVenda->getResult()[0]['venda_produto']
                ];

//        OS DADOS DE PROGRESSO DO CURSO COMPRADO É INICIALIZADO NA BD
                $adminProgresso = new adminProgresso;
                $adminProgresso->ExeCreate($Progresso);

//        DADOS DE TRANSAÇÂO SÂO ENVIADOS PARA O CHECKOUT DO PAGSEGURO
                $adminPagSeguro = new CheckoutPagSeguro();
                $adminPagSeguro->ExeTransacao($_SESSION['clientelogin']);
            endif;

        endif;
        break;
endswitch;
?>


<section class="container curso_detalhes">



    <div class="compra j_processo_compra j_popup">

        <div class="credenciamento_opcoes radius j_opcoes">

            <div class="ajax_close">X</div>

            <div class="grupo_opcoes">
                <p class="al-center">Entre ou cadastre-se agora e compre já este curso!</p>
                <a class="btn btn-green radius fl-left j_botao_entrar">Já sou cadastrado</a>
                <div class="div_ou fl-left">
                    <span class="ou">OU</span>
                </div>
                <a class="btn btn-green radius j_botao_cadastrar">Cadastrar</a>
            </div>

            <div class="clear"></div>
        </div>

        <div class="credenciamento_entrar radius j_entrar">

            <div class="ajax_close fl-right">X</div>

            <div class="trigger-box-suspenso"></div>

            <div class="content_entrar">

                <span class="titulo_entrar fontsize1b">Entrar</span>

                <p class="entrar m-top1">Se você já é cadastrado acesse entre com o seu email e senha:</p>


                <form class="form_entrar" action="" method="post">

                    <input type="hidden" name="action" value="entrar"/>

                    <label>	
                        <span>Email:</span>			
                        <input class="input_fale" type="email" name="cliente_email" required />
                    </label>


                    <label>	
                        <span>Senha:</span>			
                        <input class="input_fale" type="password" name="cliente_senha" required />
                    </label>


                    <input class="btn btn-green btn_entrar fl-right radius j_entrar" type="submit" name="cliente_enviar" value="Confirmar" />

                    <div title="Carregando" class="load fl-right"></div>          

                </form>

            </div>	
            <div class="clear"></div>
        </div>


        <div class="credenciamento_cadastrar radius j_cadastrar">


            <div class="ajax_close fl-right">X</div>



            <div class="content_cadastrar">

                <?php
//                $idProduto = 0;
//                $valorProduto = 0;
//                $read = new Read;
//                $read->ExeRead("gabadi_produtos");
//                if ($read->getResult()):
//                    $idProduto = $read->getResult()[0]['produto_id'];
//                    $valorProduto = $read->getResult()[0]['produto_valor'];
//                endif;
//                
                ?>


                <span class="titulo_cadastrar fontsize1">>> Cadastrar</span>

                <form name="PostForm"  class="form_cadastrar m-top1" action="" method="post">

                    <div class="trigger-box-suspenso"></div>

                    <input type="hidden" name="action" value="cadastrar"/>


                    <p>Dados Pessoais</p>


                    <label class="label-50 fl-left">	
                        <span>Nome:</span>			
                        <input class="input_fale" type="text" name="cliente_name" />
                    </label>


                    <label class="label-50 fl-left">	
                        <span>Sobrenome:</span>			
                        <input class="input_fale" type="text" name="cliente_lastname" />
                    </label>

                    <label class="label-50 fl-left">	
                        <span>Estado Civil:</span>			
                        <select name="cliente_estado_civil">
                            <option value="solteiro(a)">Solteiro(a)</option>
                            <option value="casado(a)">Casado(a)</option>
                            <option value="divorciado(a)">Divorciado(a)</option>
                        </select>
                    </label>

                    <label class="label-50 fl-left">	
                        <span>RG:</span>			
                        <input class="input_fale" type="text" name="cliente_rg"/>
                    </label>

                    <label class="label-50 fl-left">	
                        <span>CPF:</span>			
                        <input id="cpf" class="input_fale" type="text" name="cliente_cpf"/>
                    </label>

                    <label class="label-50 fl-left">	
                        <span>Telefone ou Celular:</span>			
                        <input class="input_fale" type="tel" name="cliente_telefone"/>
                    </label>

<!--                    <label class="label-50 fl-left">	
                        <span>Celular:</span>			
                        <input class="input_fale" type="tel" name="cliente_telefone"/>
                    </label>-->

                    <div class="clear"></div>

                    <p class="container">Endereço</p>

                    <label class="label-50 fl-left">	
                        <span>Rua, av, etc:</span>			
                        <input class="input_fale" type="text" name="cliente_endereco"/>
                    </label>

                    <label class="label-50 fl-left">	
                        <span>Número:</span>			
                        <input class="input_fale" type="text" name="cliente_numero"/>
                    </label>

                    <label class="label-50 fl-left">	
                        <span>Bairro:</span>			
                        <input class="input_fale" type="text" name="cliente_bairro"/>
                    </label>

                    <label class="label-50 fl-left">	
                        <span>CEP:</span>			
                        <input class="input_fale" type="text" name="cliente_cep"/>
                    </label>

                    <label class="label-50 fl-left">	
                        <span>UF:</span>			
                        <select class="j_loadstate" name="cliente_uf" required="required">
                            <option value="" disabled selected> Selecione o estado </option>
                            <?php
                            $readState = new Read;
                            $readState->ExeRead("app_estados", "ORDER BY estado_nome ASC");
                            foreach ($readState->getResult() as $estado):
                                extract($estado);
                                echo "<option value=\"{$estado_id}\" ";

                                if (isset($ClienteData['cliente_uf']) && $estado_id == $ClienteData['cliente_uf']):
                                    echo "selected=\"selected\" ";
                                endif;

                                echo "> {$estado_uf} / {$estado_nome} </option>";
                            endforeach;
                            ?>                        
                        </select>

                    </label>


                    <label class="label-50 fl-left">	
                        <span>Cidade:</span>			
                        <select class="j_loadcity" name="cliente_cidade" required="required">

                            <?php
                            if (!isset($ClienteData['cliente_cidade'])):
                                echo "<option value=\"\" disabled selected> Selecione antes um estado </option>";
                            else:

                                $read = new Read();
                                $read->ExeRead("app_cidades", "WHERE estado_id = :id ORDER BY cidade_nome ASC", "id={$ClienteData['cliente_uf']}");
                                if ($read->getResult()):
                                    foreach ($read->getResult() as $city):

                                        echo "<option value=\"{$city['cidade_id']}\" ";

                                        if (isset($ClienteData['cliente_cidade']) && $ClienteData['cliente_cidade'] == $city['cidade_id']):

                                            echo "selected ";
                                        endif;

                                        echo "> {$city['cidade_nome']} </option>";
                                        ?>



                                        <?php
                                    endforeach;

                                endif;

                            endif;
                            ?>   
                        </select>
                    </label>


                    <p class="container">Dados de Acesso</p>

                    <label class="label-50 fl-left">	
                        <span>Email:</span>			
                        <input class="input_fale" type="email" name="cliente_email"/>
                    </label>

                    <label class="label-50 fl-left">	
                        <span>Senha:</span>			
                        <input class="input_fale" type="password" name="cliente_senha" />
                    </label>

                    <div class="box-line no-margin"></div>
                    <input class="btn btn-green btn_cadastrar fl-right radius" type="submit"  name="enviarCliente" value="Cadastrar" />
                    <div title="Carregando" class="load fl-right"></div>     
                </form>

                <div id="j_ajaxident" class="<?= HOME . "/_cdn/ajax" ?>"></div>           
            </div>

            <div class="clear"></div>
        </div>
    </div>


    <div class="bg-body">
        <div class="content al-center">
            <header class="sectiontitle">
                <h1><?= $curso_title; ?></h1>
                <p class="tagline"><?= $curso_subtitle; ?></p>
            </header>    

            <div class="al-center m-bottom2">
                <img class="capa_curso" height="200" title="<?= $curso_title; ?>" alt="[<?= $curso_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $curso_cover ?>" />
            </div>
            <div class="clear"></div>
        </div>    
    </div>

    <section class="curso_video_chamada bg-green-blue">

        <div class="content">

            <div class="box video-medium">

                <!--                <div class="video no-margin video_chamada_curso">
                                    <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/<?= $curso_video; ?>" frameborder="0" allowfullscreen></iframe></div>
                                </div>-->

                <div class="fl-left m-top1">
                    <h1>Apenas R$ <?= number_format($curso_valor, 2, ',', '.'); ?></h1>
                    <p class="tagline">Em até 12x no cartão!</p>
                </div>

                <a attr-curso="<?= $Link->getLocal()[1]; ?>" id="<?= $curso_id; ?>" attr-valor="<?= $curso_valor; ?>" class="shorticon shorticon-cesta btn btn-green btn-big radius fl-right j_comprar">Comprar Agora</a>

            </div>      


            <div class="clear"></div>
        </div>
    </section>    


    <aside class="curso_resumo fl-left bg-green-light">

        <div class="curso_resumo_icone">
            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/cloud.png" >
        </div>

        <div class="posts-lateral fl-left">

            <article class="curso curso_pre_requisitos fl-left b-bottom">
                <h1>Pré-Requisitos</h1>
                <p>Ter conhecimento básico em Teologia</p>
            </article>

            <article class="curso curso_lancamento fl-left b-right b-bottom">
                <div class="curso_lancamento_icone">
                    <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/calendar.png" >
                </div>
                <h1>Lançamento</h1>
                <span><?= date('d/m/Y', strtotime($curso_date)); ?></span>
            </article>

            <article class="curso curso_atualizacao fl-right b-bottom">
                <div class="curso_lancamento_icone">
                    <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/calendar.png" >
                </div>
                <h1>Atualização</h1>
                <span><?= (!empty($curso_last_views) ? date('d/m/Y', strtotime($curso_last_views)) : '-'); ?></span>
            </article>

            <article class="curso curso_modelo b-bottom b-top">
                <header class="shorticon shorticon-curso shorticon-sectiontitle">
                    <h1>Modelo do Curso</h1>
                    <p>Curso Livre</p>
                </header>
            </article>

            <!--         
                  <article class="curso curso_info b-bottom">
                    <h1>Certificado de Conclusão do Curso</h1>
                  </article>-->

            <article class="curso curso_info b-bottom">
                <header class="shorticon shorticon-whatsapp shorticon-sectiontitle">
                    <h1>Acesso e Suporte pelo Grupo do Curso no WhatsApp</h1>
                </header>
            </article>

            <!--            <article class="curso curso_info">
                            <h1>Acesso Ilimitado</h1>
                        </article>-->

        </div>

    </aside>



    <article class="curso_descricao bg-body fl-right">

        <header class="title_descricao_site m-bottom2 al-center">
            <h1>Descrição do Curso</h1>
            <p class="tagline">Veja o que você irá aprender!</p>
            <p><?= (!empty($curso_descricao) ? $curso_descricao : $curso_subtitle); ?></p>
        </header>

        <article class="container modulos modulos-site m-bottom3">







            <?php
            $readModulos = new Read;
            $readModulos->ExeRead(MODULOS, "WHERE modulo_curso = :curso ORDER BY modulo_name ASC", "curso={$curso_id}");
            if ($readModulos->getResult()):
                $porcentagemModulo = 100 / $readModulos->getRowCount();
                $i = 1;
                foreach ($readModulos->getResult() as $modulo):
                    extract($modulo);

                    $liberacao = ($modulo_liberacao > date('Y-m-d H:i:s') ? 'Libera em ' . date('d/m/Y', strtotime($modulo_liberacao)) : 'Liberado');
                    ?>

                    <header class="bg-green-claro fl-left" id="<?= $modulo_name; ?>">
                        <h1 class="shorticon shorticon-modulo shorticon-sectiontitle caps-lock font-bold"><?= $modulo_title; ?></h1>
                        <div class="b-bottom"></div>
                    </header>


                    <div class="bg-body">
                        <?php
                        $readAulas = new Read;
                        $readAulas->ExeRead(AULAS, "WHERE aula_modulo = :modulo ORDER BY aula_date", "modulo={$modulo_id}");
                        if ($readAulas->getResult()):

                            $porcentagemAula = $porcentagemModulo / $readAulas->getRowCount();
                            foreach ($readAulas->getResult() as $aula):
                                extract($aula);
                                ?>

                                <div class="container linha b-bottom">
                                    <div class="content">
                                        <div class="coluna box box-small coluna-codigo coluna-curso-site caps-lock"><span><?= $aula_title; ?></span></div>
                                        <div class="coluna box box-small coluna-data-liberacao"><span>D<?= ($i < 10 ? '00' : '0') . $i++; ?></span></div>
                                        <div class="clear"></div>
                                    </div>
                                </div>



                                <?php
                            endforeach;
                        endif;
                        ?>

                        <div class="box-line m-bottom3"></div>

                        <?php
                    endforeach;
                endif;
                ?>
        </article>

    </article>

    <div class="box-line"></div>
    <section class="curso_video_chamada bg-gray fl-left">

        <div class="content">

            <div class="box video-medium">

                <div class="video no-margin video_chamada_curso ds-none">
                    <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/<?= $curso_video; ?>" frameborder="0" allowfullscreen></iframe></div>
                </div>

                <div class="fl-left m-top1">
                    <h1>Apenas R$ <?= number_format($curso_valor, 2, ',', '.'); ?></h1>
                    <p class="tagline">Em até 12x no cartão!</p>
                </div>

                <a attr-curso="<?= $Link->getLocal()[1]; ?>" id="<?= $curso_id; ?>" attr-valor="<?= $curso_valor; ?>" class="shorticon shorticon-cesta btn btn-green btn-big radius fl-right j_comprar">Comprar Agora</a>

            </div>      


            <div class="clear"></div>
        </div>
    </section>


    <section class="container outros_cursos main_chamada">

        <header class="sectiontitle m-top2">
            <h1>Veja também outros Cursos</h1>
            <p class="tagline">Veja outros cursos que posssam ser do seu interesse!</p>
        </header>

        <div class="curso_content m-top3">

            <?php
            $readCursos = new Read;
            $readCursos->ExeRead(CURSOS, "WHERE curso_name != :name ORDER BY curso_date", "name={$Link->getLocal()[1]}");
            if ($readCursos->getResult()):
                foreach ($readCursos->getResult() as $curso):
                    ?>

                    <article class="curso_item box superior">
                        <img title="<?= $curso['curso_title']; ?>" alt="[<?= $curso['curso_title']; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $curso['curso_cover']; ?>" />
                        <h1><?= $curso['curso_title']; ?></h1>
                        <div class="divisao_preco_parcela">
                            <span>R$ <?= number_format($curso['curso_valor'], 2, ',', '.'); ?></span>
                            <p>Em até 12x no Cartão</p>
                        </div>
                        <a class="btn btn-blue radius shorticon shorticon-botao shorticon-entrar" title="" href="<?= HOME ?>/curso/<?= $curso['curso_name'] . '/&theme=' . THEME; ?>">Conheça o Curso</a> 

                    </article>

                    <?php
                endforeach;
            endif;
            ?>  

            <div class="clear"></div>
        </div>

    </section>


</section>