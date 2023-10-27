

<nav class="main_nav">
    <div class="content">        
<!--<img class="foto_usuario" title="Usuário Cet-Rhema" alt="[Usuário Cet-Rhema]" src="img/icone-usuario.png" />-->
        <div class="j_close close_nav fl-right font-bold">X</div>   

        <ul class="menu">
            <li><a title="" href="<?= ($Url[0] == 'index' ? '#main_header' : HOME . '/&theme=' . THEME); ?>">Inicio</a></li>
            <li><a class="link" title="" href="">Quem Somos</a>
                <ul class="submenu">
                    <li><a class="link" title="" href="<?=HOME . '/uma-palavra/&theme=' . THEME;?>">Uma Palavra</a></li>
                    <li><a title="" href="<?= ($Url[0] == 'index' ? '#nossa_fe' : HOME . '/&theme=' . THEME . '#nossa_fe'); ?>">Nossa Fé</a></li>
                    <li><a title="" href="<?= ($Url[0] == 'index' ? '#publico_alvo' : HOME . '/&theme=' . THEME . '#publico_alvo'); ?>">Público Alvo</a></li>
                    <li><a title="" href="<?= ($Url[0] == 'index' ? '#corpo_docente' : HOME . '/&theme=' . THEME . '#corpo_docente'); ?>">Corpo Docente</a></li>
                    <li><a title="" href="<?= ($Url[0] == 'index' ? '#main_comentarios' : HOME . '/&theme=' . THEME . '#main_comentarios'); ?>">Depoimentos</a></li>
                </ul>
            </li>
            <li><a title="" href="<?= ($Url[0] == 'index' ? '#superior' : HOME . '/&theme=' . THEME); ?>">Cursos</a>
                <ul class="submenu">
                    
                    <?php 
                        $readCurso = new Read;
                        $readCurso->ExeRead(CURSOS, "WHERE curso_status = 1 ORDER BY curso_id ASC");
                        if($readCurso->getResult()):
                            foreach($readCurso->getResult() as $curso):
                                extract($curso);
                            ?>
                            <li><a class="link" title="" href="<?=HOME . '/curso/' . $curso_name. '/&theme=' . THEME;?>"><?=$curso_title;?></a></li>
                    <?php
                            endforeach;
                        endif;
                    ?>
                    
                    
<!--                    <li><a class="link" title="" href="<?=HOME;?>/curso/medio-em-teologia">Médio Em Teologia</a></li>
                    <li><a class="link" title="" href="<?=HOME;?>/curso/basico-em-teologia">Básico Em Teologia</a></li>
                    <li><a class="link" title="" href="<?=HOME;?>/curso/escola-preparatoria-de-obreiros-leigos-(epol)">EPOL</a></li>-->
                </ul>
            </li>
            <li><a class="link" title="" href="<?=HOME . '/login/&theme=' . THEME;?>">Área do Aluno</a></li>
            <li><a class="link" title="" href="">Fale Conosco</a></li>
            <li><a class="link" title="" href="<?=HOME . '/&theme=' . THEME;?>#cursos">Adquirir Curso</a></li>
        </ul>


        <div class="clear"></div>
    </div>
</nav>