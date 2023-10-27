<section class="container curso_detalhes">

    
    
    
    <div class="login_aluno radius">

        
        
            <?php
            
            if(isset($_SESSION['userlogin']['user_id'])):
                
                header('Location: plataforma?exe=home&tutor=true');
            
            else:
//            $senha = '07101985';
//            $cripto = substr(md5($senha), 0, 16);
//            var_dump($cripto);
            
            $exe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
//            $login = new LoginCliente(2);

            if ($exe == 'restrito'):
                WSErro("Acesso restrito! Faça Login", WS_ERROR);
            endif;

            if ($exe == 'logoff'):
                WSErro("Deslogado com sucesso!", WS_ACCEPT);
            endif;

            if ($exe == 'recover'):
                WSErro("Sua senha foi enviada para o seu E-mail!", WS_INFOR);
            endif;


            if (isset($_SESSION['clientelogin']) && !empty($_SESSION['clientelogin']) && isset($_SESSION['clientelogin']['cliente_level']) && $_SESSION['clientelogin']['cliente_level'] >= 2):
                header('Location: plataforma');
            endif;
            
            endif;
            
            ?>

        <div class="trigger-box fl-left m-bottom1 m-top1"></div>
        
        
        <div class="content_entrar">


            <span class="titulo_entrar fontsize1b">Entrar</span>

            <p class="entrar m-top1">Entre com o seu email e senha:</p>


            <form id="form_login" class="form_entrar" action="" method="post">



                <input type="hidden" name="action" value="entrar_plataforma"/>

                <label>	
                    <span>Email:</span>			
                    <input class="input_fale" type="email" name="cliente_email" required />
                </label>


                <label>	
                    <span>Senha:</span>			
                    <input class="input_fale" type="password" name="cliente_senha" required />
                </label>


                <input class="btn btn-green btn_entrar fl-right radius" type="submit" name="cliente_enviar" value="Confirmar" />

                <div title="Carregando" class="load fl-right"></div>     

            </form>



            <a class="fl-left" title="Perdeu sua Senha?" href="recuperar">Perdeu Sua Senha?</a>
        </div>	
        <div class="clear"></div>

    </div>



</section>