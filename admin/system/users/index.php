<!DOCTYPE html>
<!--
Página: See Text Testimonials (Ver Depoimentos em Texto)
Author: Luiz Felipe C. Lopes
Date: 29/08/2018
-->

<?php
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$Own = (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_id'] : '1');
$Pager = new Pager("?exe=users/index&pag=");
$Pager->ExePager($getPage, 12);
$readUsers = new Read();
$readUsers->FullRead('SELECT user_id, user_foto, user_name, user_lastname, user_level, user_email, user_registration FROM ' . USUARIOS . ' WHERE user_id != :own AND user_level < 3 ORDER BY user_registration DESC LIMIT :limit OFFSET :offset', "own={$Own}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
if (!$readUsers->getResult()):
    echo 'Nenhum usuário ainda!';
    echo '<a style="margin-left: 10px;" title="Novo Usuário" href="?exe=users/create" class="btn btn-blue icon-file radius">Novo Usuário</a>';
else:
    ?>


    <div class="users_options">
        <form action="" method="post">
            <input type="hidden" name="action" value="filter_users">
            <input id="js_filter_search" type="text" name="search_user" placeholder="Pesquisar usuário" class="js_search_user">
            <span class="icon_search icon-search"></span>
        </form>

        <div class="btn_container">
            <a title="Novo Usuário" href="?exe=users/create" class="btn btn-blue icon-file radius">Novo Usuário</a>
        </div>
    </div>

    <section class="users js_users js_itens">
        <h2>Usuários</h2>

        <?php
        foreach ($readUsers->getResult() as $user):
            extract($user);
            ?>

            <article id="<?= $user_id; ?>" class="users_item js_item">

                <!--<div class="image_preview">-->
                <img title="<?= $user_name . ' ' . $user_lastname; ?>" alt="" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $user_foto; ?>">
                <!--</div>-->

                <div class="users_item_info">
                    <h3><?= $user_name . ' ' . $user_lastname; ?></h3>
                    <span class="users_item_info_level"><?= ($user_level == '3' ? 'Programador(a)' : ($user_level == '2' ? 'Administrador(a)' : 'Editor(a)')) ?> </span>
                    <span class="users_item_info_mail icon-mail dont-break-out"><?= $user_email; ?></span>
                    <span class="users_item_info_date icon-clock">Desde <?= date('d/m/Y \à\s H:i \h', strtotime($user_registration)); ?></span>

                    <div class="users_item_info_buttons">
                        <a title="Editar Usuário" href="?exe=users/create&id=<?= $user_id; ?>" class="icon-edit btn btn-small btn-blue radius">Editar</a>
                        <a id="<?= $user_id; ?>" attr-action="delete_user" title="Excluir Usuário" href="#" class="icon-delete-circle btn-small btn btn-red radius js_btn_delete">Excluir</a>
                    </div>
                </div>
            </article>

        <?php endforeach; ?>

        <div class="js_paginator" attr-action="paginator_users">
            <?php
            $Pager->ExeFullPaginator('SELECT user_id, user_foto, user_name, user_lastname, user_level, user_email, user_registration FROM ' . USUARIOS . ' WHERE user_id != :own ORDER BY user_registration DESC', "own={$Own}");
            $Paginator = $Pager->getPaginator();
            if (!empty($Paginator)):
                ?>
                <div class="paginator_container">
                    <?php echo $Paginator; ?>
                </div>
            <?php endif; ?>
        </div>



    </section>
    <?php include 'inc/confirmation_delete_message.inc.php'; ?>
<?php endif; ?>
