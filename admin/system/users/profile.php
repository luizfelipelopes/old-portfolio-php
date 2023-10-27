<!DOCTYPE html>
<!--
Página: New User (Novo Usuário)
Author: Luiz Felipe C. Lopes
Date: 31/08/2018
-->

<div class="users_options users_options_create">
    <a title="Novo Usuário" href="?exe=users/create" class="btn btn-orange icon-folder radius">Novo Usuário</a>
    <a title="Ver Usuários" href="?exe=users/index" class="btn btn-blue icon-eye-big radius">Ver Usuários</a>
</div>

<form class="form_users" action="" method="post" enctype="multipart/form-data">
    <input readonly type="hidden" name="user_id" value="<?= (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_id'] : null ); ?>"/>
    <input readonly type="hidden" name="action" value="update_user"/>
    <input readonly type="hidden" name="perfil" value="true"/>

    <div class="form_background">

        <span class="form-control">
            <label>Nome:</label>
            <input type="text" name="user_name" placeholder="Digite um nome" value="<?= (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] : null ); ?>">
        </span>
        <span class="form-control">
            <label>Sobrenome:</label>
            <input type="text" name="user_lastname" placeholder="Digite um sobrenome" value="<?= (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_lastname'] : null ); ?>">
        </span>
        <span class="form-control">
            <label>E-mail:</label>
            <input type="text" name="user_email" placeholder="Digite um e-mail" value="<?= (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_email'] : null ); ?>">
        </span>
        <span class="form-control">
            <label>Senha:</label>
            <input type="password" name="user_password" placeholder="Digite uma senha" value="<?= (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_password'] : null ); ?>">
        </span>
        <span class="form-control">
            <label>Nível de Acesso:</label>
            <select name="user_level">
                <option selected value="">Selecione nível</option>
                <option class="<?= (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] != '1' && $_SESSION['userlogin']['user_level'] < '3' ? 'ds-none' : ''); ?>" <?= (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] == '1' ? 'selected' : '' ); ?> value="1">Editor(a)</option>
                <option class="<?= (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] != '2' && $_SESSION['userlogin']['user_level'] < '3' ? 'ds-none' : ''); ?>" <?= (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] == '2' ? 'selected' : '' ); ?> value="2">Autor(a)</option>
                <option class="<?= (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] != '3' && $_SESSION['userlogin']['user_level'] < '3' ? 'ds-none' : ''); ?>" <?= (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] == '3' ? 'selected' : '' ); ?> value="3">Programador(a)</option>
            </select>
        </span>

    </div>

    <div class="form_background">

        <span class="image_preview">
            <img class="js_preview_image" title="<?= ((!empty($_SESSION['userlogin']) && !empty($_SESSION['userlogin']['user_name'])) ? $_SESSION['userlogin']['user_name'] : '' ); ?>" alt="" src="<?= ((!empty($_SESSION['userlogin']) && !empty($_SESSION['userlogin']['user_foto'])) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $_SESSION['userlogin']['user_foto'] : '' ); ?>">
        </span>

        <span class="form-control input_file_user">
            <label>Foto de Usuário (jpeg, jpg ou png):</label>
            <input class="js_change_image_preview" type="file" name="user_foto">
        </span>

        <div class="button_block">
            <button class="btn btn-green radius icon-check-square">Salvar</button>
        </div>

    </div>

</form>
<?php include 'inc/loading_message.inc.php'; ?>