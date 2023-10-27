
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Acompanhar Clientes</h1>
            <p class="tagline"> >> Flow State / <b>Clientes</b></p>
        </div>
        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line m-bottom3"></div>

<article class="container main-conteudo modulos m-bottom3 fl-left estatisticas_online table-clientes">

    <?php
    $dateHoje = date('Y-m-d H:i:s');
    $readClientes = new Read();
    $readClientes->ExeRead(CLIENTES, "ORDER BY cliente_registro DESC");
    if (!$readClientes->getResult()):

        WSErro("Nenhum Cliente no Momento", WS_INFOR);
    else:
        ?>

        <header class="bg-green-claro fl-left">
            <div class="content">
                <h1 class="shorticon shorticon-pedidos ds-inblock caps-lock font-bold">Acompanhar Clientes</h1>
                <div class="clear"></div>
            </div>    
        </header>

        <div class="bg-body">

            <div class="container linha bg-gray">
                <div class="content">
                    <div class="col-25 caps-lock font-bold"><span>Nome</span></div>
                    <div class="col-30 caps-lock font-bold"><span>E-mail</span></div>
                    <div class="col-15 caps-lock font-bold"><span>Cpf</span></div>
                    <div class="col-25 caps-lock font-bold"><span>Data de Entrada</span></div>
                    <div class="clear"></div>
                </div>
            </div>


            <?php
            //                    var_dump($read->getResult()[0]);
            foreach ($readClientes->getResult() as $cliente) :


                extract($cliente);
                ?>

                <div class="container linha">
                    <div class="content">
                        <div class="col-25"><span><?= $cliente_name . ' ' . $cliente_lastname; ?></span></div>
                        <div class="col-30"><span><?= $cliente_email; ?></span></div>
                        <div class="col-15"><span><?= $cliente_cpf; ?></span></div>
                        <div class="col-25"><span><?= date('d/m/Y \à\s H\hi', strtotime($cliente_registro)); ?></span></div>
                        <div class="clear"></div>
                    </div>
                </div>

                <?php
            endforeach;
        endif;
        ?>

        <!--                                <div class="container linha">
                                            <div class="content">
                                                <div class="coluna box box-small coluna-codigo"><span>Módulo 2</span></div>
                                                <div class="coluna box box-small coluna-data-liberacao"><span>08/06/2016</span></div>
                                                <div class="coluna box box-small coluna-aulas"><span>03 Aulas</span></div>
                                                <div class="coluna box box-small coluna-botao"><a class="btn btn-blue radius shorticon shorticon-editar" title="Editar Curso" href=""></a></div>
                                                <div class="coluna box box-small coluna-botao last"><a class="btn btn-green radius shorticon shorticon-ver" title="Editar Curso" href=""></a></div>
                        
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                        
                                        <div class="container linha">
                                            <div class="content">
                                                <div class="coluna box box-small coluna-codigo"><span>Módulo 3</span></div>
                                                <div class="coluna box box-small coluna-data-liberacao"><span>08/06/2016</span></div>
                                                <div class="coluna box box-small coluna-aulas"><span>03 Aulas</span></div>
                                                <div class="coluna box box-small coluna-botao"><a class="btn btn-blue radius shorticon shorticon-editar" title="Editar Curso" href=""></a></div>
                                                <div class="coluna box box-small coluna-botao last"><a class="btn btn-green radius shorticon shorticon-ver" title="Editar Curso" href=""></a></div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                        
                                        <div class="container linha">
                                            <div class="content">
                                                <div class="coluna box box-small coluna-codigo"><span>Módulo 4</span></div>
                                                <div class="coluna box box-small coluna-data-liberacao"><span>08/06/2016</span></div>
                                                <div class="coluna box box-small coluna-aulas"><span>03 Aulas</span></div>
                                                <div class="coluna box box-small coluna-botao"><a class="btn btn-blue radius shorticon shorticon-editar" title="Editar Curso" href=""></a></div>
                                                <div class="coluna box box-small coluna-botao last"><a class="btn btn-green radius shorticon shorticon-ver" title="Editar Curso" href=""></a></div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                        
                        
                                        <div class="container linha">
                                            <div class="content">
                                                <div class="coluna box box-small coluna-codigo"><span>Módulo 5</span></div>
                                                <div class="coluna box box-small coluna-data-liberacao"><span>08/06/2016</span></div>
                                                <div class="coluna box box-small coluna-aulas"><span>03 Aulas</span></div>
                                                <div class="coluna box box-small coluna-botao"><a class="btn btn-blue radius shorticon shorticon-editar" title="Editar Curso" href=""></a></div>
                                                <div class="coluna box box-small coluna-botao last"><a class="btn btn-green radius shorticon shorticon-ver" title="Editar Curso" href=""></a></div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>-->


        <div class="clear"></div>
    </div>
</article>
