<?php
$carrinho = filter_input(INPUT_GET, 'carrinho', FILTER_DEFAULT);
//    var_dump($carrinho);
?>


<!-- CONTENT_CONTEUDO -->
<section id="entrar" class="content_conteudo entrar_cadastrar">


    <h1 class="caminho caminho_entrar">Início &raquo; Acesso</h1>     

    <div class="content">

        <div class="bloco_entrar_cadastrar">

            <?php
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            require '_models/LoginCliente.class.php';
            $login = new LoginCliente();


            if ($login->CheckLogin()):
                header("Location: " . HOME);
            endif;


            if (isset($data['cliente_enviar'])):


                if (isset($data) && $data['cliente_enviar'] == 'Enviar'):
                    unset($data['cliente_enviar']);


                    $login->ExeLogin($data);
//                    var_dump($login);


                    if (!$login->getResult()):
                        WSErro($login->getError()[0], $login->getError()[1]);
                    else:

                        if (isset($carrinho) && $carrinho == 'true#entrar'):
                            header("Location: " . HOME . 'Carrinho#carrinho');
                        else:
                            header("Location: " . HOME);
                        endif;


                    endif;


                endif;

            endif;
            ?>


            <div class="trigger-box"></div>

            <div class="trigger-box-suspenso"></div>

            <article class="content_entrar">

                <h1 class="titulo_entrar">Entrar</h1>

                <p class="entrar">Se você já é cadastrado acesse entre com o seu email e senha:</p>


                <form class="form_entrar" action="" method="post">



                    <input type="hidden" name="action" value="entrar"/>
                    <input type="hidden" name="carrinho" value="<?=$carrinho;?>"/>

                    <label>	
                        <span>Email:</span>			
                        <input class="input_fale" type="email" name="cliente_email" required />
                    </label>


                    <label>	
                        <span>Senha:</span>			
                        <input class="input_fale" type="password" name="cliente_senha" required />
                    </label>


                    <input class="btn btn-green fl-right radius j_entrar" type="submit" name="cliente_enviar" value="Enviar" />
                    <div title="Carregando" class="load fl-right m-top1"></div>
                </form>

                

            </article>	

            <div class="div_ou">
                <span class="ou">OU</span>
            </div>

            <article class="content_cadastrar">

                <?php
//                $contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//
//                if ($contato && $contato['enviarCliente']):
//                    unset($contato['enviarCliente']);
//
//
//
//
//                endif;
//                
                ?>        


                <h1 class="titulo_cadastrar">Cadastrar</h1>

                <p class="cadastrar">Cadastre-se e compre os melhores tapetes da região:</p>


                <?php
                $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                if (isset($ClienteData['enviarCliente'])):



                    if ($ClienteData && $ClienteData['enviarCliente'] == 'Cadastrar'):
                        unset($ClienteData['enviarCliente']);

                        require '_models/AdminCliente.php';
                        $adminCliente = new AdminCliente;
                        $adminCliente->ExeCreate($ClienteData);
                        WSErro($adminCliente->getError()[0], $adminCliente->getError()[1]);
                        if ($adminCliente->getResult()):


                            $ClienteData['Assunto'] = "CARDI TAPETES - Suas Credenciais de Acesso";
                            $ClienteData['DestinoNome'] = "{$ClienteData['cliente_name']}";
                            $ClienteData['DestinoEmail'] = "{$ClienteData['cliente_email']}";
                            $ClienteData['Mensagem'] = "Olá {$ClienteData['cliente_name']}! <br> Seu cadastro foi relizado com sucesso!  <br> Agora é só clicar neste <a href='http://localhost/work/ProjetoCardi/Entrar#entrar' target='_blank'>link</a> e digitar as credenciais abaixo:<br><br> e-mail: {$ClienteData['cliente_email']} <br> senha: {$ClienteData['cliente_senha']}<br><br>Grande abraço,<br> Coopertiva Artesanal Regional de Diamanina";

                            $email = new Email();
                            $email->Enviar($ClienteData);
//                            if ($email->getError()):
//                                WSErro($email->getError()[0], $email->getError()[1]);
//                            endif;
                            $ClienteData = null;
                        endif;

//                var_dump($adminCliente);
                    endif;

                endif;
                ?>



                <form name="PostForm"  class="form_cadastrar" action="" method="post">


                    <input type="hidden" name="action" value="cadastrar"/>
                    <input type="hidden" name="carrinho" value="<?=$carrinho;?>"/>

                    <label>	
                        <span>Nome:</span>			
                        <input class="input_fale" type="text" name="cliente_name" value="<?php
                        if (isset($ClienteData['cliente_name'])): echo $ClienteData['cliente_name'];
                        endif;
                        ?>" />
                    </label>


                    <label>	
                        <span>Sobrenome:</span>			
                        <input class="input_fale" type="text" name="cliente_lastname" value="<?php
                        if (isset($ClienteData['cliente_lastname'])): echo $ClienteData['cliente_lastname'];
                        endif;
                        ?>" />
                    </label>

                    <label>	
                        <span>CPF:</span>			
                        <input id="cpf" class="input_fale" type="text" name="cliente_cpf" value="<?php
                        if (isset($ClienteData['cliente_cpf'])): echo $ClienteData['cliente_cpf'];
                        endif;
                        ?>"/>
                    </label>


                    <label class="ddd">	
                        <span>DDD:</span>			
                        <input class="input_fale" type="text" name="cliente_ddd" value="<?php
                        if (isset($ClienteData['cliente_ddd'])): echo $ClienteData['cliente_ddd'];
                        endif;
                        ?>"/>
                    </label>


                    <label class="tel">	
                        <span>Telefone ou Celular:</span>			
                        <input id="tel" class="input_fale" type="tel" name="cliente_telefone" value="<?php
                        if (isset($ClienteData['cliente_telefone'])): echo $ClienteData['cliente_telefone'];
                        endif;
                        ?>"/>
                    </label>

                    <label>	
                        <span>Endereco:</span>			
                        <input class="input_fale" type="text" name="cliente_endereco" value="<?php
                        if (isset($ClienteData['cliente_endereco'])): echo $ClienteData['cliente_endereco'];
                        endif;
                        ?>" />
                    </label>

                    <label>	
                        <span>Número:</span>			
                        <input class="input_fale" type="text" name="cliente_numero" value="<?php
                        if (isset($ClienteData['cliente_numero'])): echo $ClienteData['cliente_numero'];
                        endif;
                        ?>"/>
                    </label>

                    <label>	
                        <span>Complemento:</span>			
                        <input class="input_fale" type="text" name="cliente_complemento" value="<?php
                        if (isset($ClienteData['cliente_complememto'])): echo $ClienteData['cliente_complemento'];
                        endif;
                        ?>"/>
                    </label>

                    <label>	
                        <span>Bairro:</span>			
                        <input class="input_fale" type="text" name="cliente_bairro" value="<?php
                        if (isset($ClienteData['cliente_bairro'])): echo $ClienteData['cliente_bairro'];
                        endif;
                        ?>" />
                    </label>


                    <label>	
                        <span>Estado:</span>			
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

                    <label>	
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



                    <label>	
                        <span>CEP:</span>			
                        <input class="input_fale" type="text" name="cliente_cep" value="<?php
                        if (isset($ClienteData['cliente_cep'])): echo $ClienteData['cliente_cep'];
                        endif;
                        ?>"/>
                    </label>

                    <label>	
                        <span>Email:</span>			
                        <input class="input_fale" type="email" name="cliente_email" value="<?php
                        if (isset($ClienteData['cliente_email'])): echo $ClienteData['cliente_email'];
                        endif;
                        ?>"/>
                    </label>


                    <label>	
                        <span>Senha:</span>			
                        <input class="input_fale" type="password" name="cliente_senha" value="<?php
                        if (isset($ClienteData['cliente_senha'])): echo $ClienteData['cliente_senha'];
                        endif;
                        ?>" />
                    </label>

                    <input class="btn btn-green fl-right radius" type="submit"  name="enviarCliente" value="Cadastrar" />
                    <div title="Carregando" class="load fl-right m-top1"></div>

                </form>

                <div id="j_ajaxident" class="<?= HOME . "/_cdn/ajax" ?>"></div>           
            </article>

        </div>


        <div class="clear"></div>
    </div>
</section><!-- CONTENT_CONTEUDO -->
<script src="<?= HOME ?>/_cdn/jquery.js"></script>
<!--<script src="<?= HOME ?>/_cdn/jmask.js"></script>-->
<script src="<?= HOME ?>/_cdn/combo.js"></script>