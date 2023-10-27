<?php

$readPagina = new Read;
$readArtigo = new Read;

$readPagina->ExeRead(PAGINAS, "WHERE pagina_name = :page", "page={$Url[0]}");

if (isset($_SESSION['userlogin']['user_id'])):
    $readArtigo->ExeRead(POSTS, "WHERE post_name = :name", "name={$Url[0]}");
else:
    $readArtigo->ExeRead(POSTS, "WHERE post_status = 1 and post_name = :name", "name={$Url[0]}");
endif;

if ($readPagina->getResult()):
    require 'page.php';
elseif ($readArtigo->getResult()):
    require 'post.php';
else:
    require '404.php';
endif;