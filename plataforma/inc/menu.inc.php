

<nav class="main_nav">
    <div class="content">        
<!--<img class="foto_usuario" title="Usuário Cet-Rhema" alt="[Usuário Cet-Rhema]" src="img/icone-usuario.png" />-->
        <div class="j_close close_nav fl-right font-bold">X</div>   

        <ul class="menu">
            <li><a title="" href="<?= ($Url[0] == 'index' ? '#main_header' : HOME); ?>">Inicio</a></li>
            <li><a class="link" title="" href="">Quem Somos</a>
                <ul class="submenu">
                    <li><a class="link" title="" href="<?=HOME;?>/uma-palavra">Uma Palavra</a></li>
                    <li><a title="" href="<?= ($Url[0] == 'index' ? '#nossa_fe' : HOME); ?>">Nossa Fé</a></li>
                    <li><a title="" href="<?= ($Url[0] == 'index' ? '#publico_alvo' : HOME); ?>">Público Alvo</a></li>
                    <li><a title="" href="<?= ($Url[0] == 'index' ? '#corpo_docente' : HOME); ?>">Corpo Docente</a></li>
                    <li><a title="" href="<?= ($Url[0] == 'index' ? '#main_comentarios' : HOME); ?>">Depoimentos</a></li>
                </ul>
            </li>
            <li><a title="" href="<?= ($Url[0] == 'index' ? '#superior' : HOME); ?>">Cursos</a>
                <ul class="submenu">
                    <li><a class="link" title="" href="<?=HOME;?>/curso/superior-em-teologia">Superior Em Teologia</a></li>
                    <li><a class="link" title="" href="<?=HOME;?>/curso/medio-em-teologia">Médio Em Teologia</a></li>
                    <li><a class="link" title="" href="<?=HOME;?>/curso/basico-em-teologia">Básico Em Teologia</a></li>
                    <li><a class="link" title="" href="<?=HOME;?>/curso/escola-preparatoria-de-obreiros-leigos-(epol)">EPOL</a></li>
                </ul>
            </li>
            <li><a class="link" title="" href="<?=HOME;?>/login">Área do Aluno</a></li>
            <li><a class="link" title="" href="">Fale Conosco</a></li>
            <li><a class="link" title="" href="">Adquirir Curso</a></li>
        </ul>


        <div class="clear"></div>
    </div>
</nav>