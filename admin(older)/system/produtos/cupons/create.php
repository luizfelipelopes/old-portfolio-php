<main>
<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Novo Cupom</h1>
                    <p class="tagline"> >> Flow State / Produtos / <b>Novo Cupom</b></p>
                </div>

                <a class="btn btn-blue m-bottom1 radius" title="Novo Cupom" href="<?= HOME; ?>flowstate_admin/dashboard.php?exe=produtos/cupons/index">Meus Cupons</a>    
                <?php
                if ($id):
                    ?>
                    <a style="margin-right: 1%;" class="btn btn-green radius" title="Novo Cupom" href="<?= HOME; ?>flowstate_admin/dashboard.php?exe=produtos/cupons/create">Novo Cupom</a>    
                    <?php
                endif;
                ?>

                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="main-conteudo posts posts-create">    

            <?php
            
            if ($id):

//                PRODUTO
                $readCupom = new Read();
                $readCupom->ExeRead(CUPONS, "WHERE cupom_id = :id", "id={$id}");
                if ($readCupom->getResult()):
//                    var_dump($read->getResult()[0]);
                    extract($readCupom->getResult()[0]);

                endif;

            endif;
            ?>



            <form action="" method="post" enctype="multipart/form-data">



                <div class="container bg-body">

                    <div class="content">


                        <div class="trigger-box-suspenso"></div>
                        <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                        <input readonly type="hidden" name="cupom_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_cupom' : 'create_cupom'); ?>"/>


                        
                        <label class="form-field col-49">
                            <span class="form-legend">Código:</span>
                            <input type="text" title="Código" name="cupom_codigo" placeholder="Digite um Código" value="<?= (!empty($cupom_codigo) ? $cupom_codigo : null ); ?>" />
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Desconto (%):</span>
                            <input class="j_valor" type="text" name="cupom_desconto" title="Desconto" placeholder="Digite uma porcentagem" value="<?= (!empty($cupom_desconto) ? number_format($cupom_desconto * 100, 2, ',', '.') : null ); ?>"/>
                        </label>

                        
                        <label class = "form-field col-49">
                                    <span class = "form-legend">Válido até:</span>
                                    <input type = "date" title = "Nome" name = "cupom_validade" placeholder = "Digite uma data" value = "<?= (!empty($cupom_validade) ? date('Y-m-d', strtotime($cupom_validade)) : date('Y-m-d')); ?>" />
                                </label>

                                <label class = "form-field col-49">
                                    <span class = "form-legend">Autor:</span>
                                    <select name = "cupom_author">
                                        <option disabled selected value = "">Selecione um usuário</option>
                                        <?php
                                        $readUser = new Read;
                                        $readUser->ExeRead(USUARIOS, "ORDER BY user_name ASC");
                                        if ($readUser->getResult()) :
                                            foreach ($readUser->getResult() as $user) :
                                                echo "<option " . (!empty($id) && $user['user_id'] == $cupom_author ? 'selected' : (($user['user_id'] == $_SESSION['userlogin']['user_id']) ? 'selected' : '')) . " value='" . $user['user_id'] . "'>" . $user['user_name'] . " " . $user['user_lastname'] . "</option>";
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </label>


                                <div class="form-check">
                                    <label><input type="checkbox" name="cupom_status" <?= (!empty($id) && $cupom_status == '1' ? 'checked' : '' ); ?> value="1">Ativar Agora</label>
                                </div>

                                <button class="btn btn-green radius j_btn fl-right">Atualizar!</button>
                                <div title="Carregando" class="load fl-right"></div>
                        
                        <div class="clear"></div>  
                    </div>
                </div>

            </form>

            <div class="clear"></div>
        </div>




