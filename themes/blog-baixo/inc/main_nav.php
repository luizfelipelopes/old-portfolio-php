<?php
$titulo = '<span id="titulo"></span>';

//echo 'Titulo: ' . $titulo;
?>

<?php
$sobre = (($titulo !== SITENAME) ? HOME . DIRECTORY_SEPARATOR . 'sobre' : '#sobre');
$posts = (($titulo !== SITENAME) ? HOME . DIRECTORY_SEPARATOR . 'posts' : '#posts');
$videos = (($titulo !== SITENAME) ? HOME . DIRECTORY_SEPARATOR . 'videos' : '#videos');
$fotos = (($titulo !== SITENAME) ? HOME . DIRECTORY_SEPARATOR . 'fotos' : '#fotos');
?>
<ul class="menu_ul">


    <li><a  title="Página Inicial da <?=SITENAME;?>" href="<?= HOME . '/&theme=' . THEME; ?>">Início</a></li>
    <li><a  title="Sobre <?=SITENAME;?>" href="<?= $sobre . '/&theme=' . THEME; ?>">Sobre</a></li>
    <li><a  title="Posts da <?=SITENAME;?>" href="<?= $posts . '/&theme=' . THEME; ?>">Sacadas</a></li>
    <!--<li><a class="link" title="Confira Nossa Programação - Gabadi Online" href="<?= HOME . DIRECTORY_SEPARATOR . 'programacao' ?>">Programação</a></li>-->
    <!--<li><a class="link" title="Equipe da Galera Batista de Diamantina" href="<?= HOME . DIRECTORY_SEPARATOR . 'equipe' ?>">Equipe</a></li>-->
    <!--<li><a <?= ($titulo != SITENAME ? 'class=link' : ''); ?> title="Fotos da Galera Batista de Diamantina" href="<?= $videos; ?>">Vídeos</a></li>-->
    <!--<li><a <?= ($titulo != SITENAME ? 'class=link' : ''); ?> title="Fotos da Galera Batista de Diamantina" href="<?= $fotos; ?>">Fotos</a></li>-->
    <!--<li><a class="link" style="color: #F2A633; font-weight: bold;" title="Compre Aqui O Seu Ingresso Para GabaNight da Virada 2017!" href="<?= HOME . DIRECTORY_SEPARATOR . 'gabanight-da-virada' ?>">Ingresso GabaNight 2017</a></li>-->
    <li><a title="Fale Conosco" href="#contatos">Contato</a></li>
</ul>