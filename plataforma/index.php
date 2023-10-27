<?php
ob_start();
//session_start();

require '../_app/Config.inc.php';
spl_autoload_register('carregarClasses');
$sessao = new Session(1);
//var_dump($_SESSION['useronline']);

date_default_timezone_set("America/Sao_Paulo");
?>
<?php $exe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT); ?>

<?php
//$login = new LoginCliente(2);
if ((!isset($_SESSION['clientelogin']['cliente_id']) || $_SESSION['clientelogin']['cliente_level'] < 2) && !isset($_SESSION['userlogin']['user_id'])):
    header('Location: ../login&exe=restrito');
//    var_dump('invasao');
else:
    if (isset($_SESSION['clientelogin']['cliente_id'])):

        $readVenda = new Read;
        $readVenda->ExeRead("cetrhema_vendas", "WHERE venda_cliente = :cliente", "cliente={$_SESSION['clientelogin']['cliente_id']}");
        if ($readVenda->getResult()):

            foreach ($readVenda->getResult() as $venda):

                extract($venda);

                if ($venda_status == 3):

                    // SE É A 1ª VEZ Q O ALUNO ENTRA COM O CURSO PAGO, OS CAMPOS DE NOTAS DELE SERÂO CRIADOS NA BASE DE DADOS
                    $readNotas = new Read;
                    $readNotas->ExeRead("cetrhema_notas", "WHERE nota_aluno = :aluno", "aluno={$_SESSION['clientelogin']['cliente_id']}");
                    if (!$readNotas->getResult()):
                        $readModulo = new Read;
                        $readModulo->ExeRead("cetrhema_modulos", "WHERE modulo_curso = :curso", "curso={$venda_produto}");
                        if ($readModulo->getResult()):
                            foreach ($readModulo->getResult() as $modulo):

                                extract($modulo);
                                $readAula = new Read;
                                $readAula->ExeRead("cetrhema_aulas", "WHERE aula_modulo = :modulo", "modulo={$modulo_id}");
                                if ($readAula->getResult()):

                                    foreach ($readAula->getResult() as $aula):
                                        extract($aula);

                                        $adminNota = new adminNota;
                                        $adminNota->ExeCreate($_SESSION['clientelogin']['cliente_id'], $aula_id);

                                    endforeach;
                                endif;
                            endforeach;
                        endif;

                    endif;

                endif;

            endforeach;

        endif;


        $_SESSION['clientelogin']['cliente_entrada'] = date('Y-m-d H:i:s');
    endif;
endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard | Painel Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?= INCLUDE_PATH ?>/img/favicon.ico" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH ?>/css/boot.css"/>
        <link rel="stylesheet" href="<?= INCLUDE_PATH ?>/css/style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700" rel="stylesheet">


    </head>
    <body class="bg-green-light">
        <div class="j_back backtop">Topo</div>
        <header class="container main_header">


            <!--            <div class="content">
            
                            <div class="logo_slogan">
                                <h1 class="fontzero main_logo fl-left"><a title="Cet-Rhema - Centro de Estudos Teológicos Rhema" href="index.php">Cet-Rhema - Centro de Estudos Teológicos Rhema</a></h1>
                                <p class="slogan">"Procura Apresentar-te Diante de Deus Aprovado..."</p>
                            </div>
            
                            <div class="titulo_subtitulo fl-right al-center m-top3">
                                <p class="titulo textshadow">Centro de Estudos Teológicos - Rhema</p>
                                <p class="subtitulo tagline">"Um Seminário a Serviço do Reino"</p>
                            </div>
            
                         <div class="j_menu_mobile main_menu_mobile fl-right radius bg-green-blue">
                                <div class="listras">
                                    <div class="linha"></div>
                                    <div class="linha"></div>
                                    <div class="linha"></div>
                                </div> 
                            </div>
            
                            <div class="clear"></div>
                        </div>-->


            <?php require './inc/menu.inc.php'; ?>

        </header>

        <main>

            <section class="container">



                <?php
                if (!empty($exe)):
                    $includepath = __DIR__ . DIRECTORY_SEPARATOR . trim($exe) . '.php';
                else:
                    $includepath = __DIR__ . DIRECTORY_SEPARATOR . trim($exe) . 'home.php';
                endif;

                if (file_exists($includepath)):
                    require $includepath;
                else:
                    echo 'Erro ao Incluir tela!';
                endif;
                ?>




                <!--        <div class="clear"></div>
                    </div>-->
            </section>    
        </main>

        <footer>


            <section class="container main_footer bg-green-blue">

                <div class="content">
                    <h1 class="fontzero">Sobre o Cet-Rhema</h1>

                    <article>
                        <h1 class="title shorticon shorticon-forma-pagamento shorticon-minimo">Formas de Pagamento</h1>
                        <img title="" alt="" src="<?= INCLUDE_PATH ?>/img/banner_pagseguro.gif" />
                    </article>

                    <article class="igrejas">
                        <h1 class="title">Igrejas Apoiadoras</h1>
                        <p>1ª Igreja Batista em Carbonita-MG</p>
                        <p>1ª Igreja Batista em Turmalina-MG</p>
                        <p>1ª Igreja Batista em Diamantina-MG</p>
                        <p>Igreja Casa de Oração - Curvelo-MG</p>
                    </article>


                    <article class="contatos">
                        <h1 class="title">Contatos</h1>
                        <p class="shorticon shorticon-correio shorticon-zero email">cet-rhema@hotmail.com</p>
                        <div class="telefones shorticon shorticon-celular shorticon-sectiontitle fl-left">
                            <p class="al-left fl-left">(38) 98804-0812 (Oi)</p>
                            <p class="al-left fl-left">(38) 99917-8901 (Vivo - WhatsApp)</p>
                            <p class="al-left fl-left">(31) 99141-9242 (Tim)</p>
                        </div>
                    </article>


                    <div class="clear"></div>
                </div>

                <div class="copy bg-green-light container">
                    <p class="al-center">Centro de Estudos Teológicos Rhema. Copyryght © 2016</p>
                    <p class="al-center">Praça Brasília, 52-A - Cep.39100-000 Diamantina - MG</p>
                </div>   

            </section>
        </footer>


        <script src="<?= HOME ?>/_cdn/jquery.js"></script>
        <script src="<?= INCLUDE_PATH ?>/js/scripts.js"></script>
        <script src="<?= HOME ?>/_cdn/jquery.form.js"></script>
        <script src="js/plataforma_scripts.js"></script>
        <script src="<?= HOME ?>/_cdn/combo.js"></script>
        <script src="<?= HOME ?>/admin/__jsc/tinymce/tinymce.min.js"></script>
        <script src="<?= HOME ?>/admin/__jsc/tinymce/jquery.tinymce.min.js"></script>
        <script src="<?= HOME ?>/admin/__jsc/admin.js"></script>


    </body>
</html>
<?php ob_end_flush(); ?>