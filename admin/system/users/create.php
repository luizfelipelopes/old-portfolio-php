<!DOCTYPE html>
<!--
Página: New User (Novo Usuário)
Author: Luiz Felipe C. Lopes
Date: 31/08/2018
-->

<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>

<div class="users_options users_options_create">
    <?php if (!empty($id)): ?>
        <a title="Novo Usuário" href="?exe=users/create" class="btn btn-orange icon-folder radius">Novo Usuário</a>
    <?php endif; ?>
    <a title="Ver Usuários" href="?exe=users/index" class="btn btn-blue icon-eye-big radius">Ver Usuários</a>
</div>

<?php
if ($id):
    $readUser = new Read();
    $readUser->FullRead("SELECT user_id, user_name, user_lastname, user_foto, user_email, user_password, user_level FROM " . USUARIOS . " WHERE user_id = :id", "id={$id}");
    if ($readUser->getResult()):
        extract($readUser->getResult()[0]);
    endif;
endif;
?>


<?php if ((!empty($id) && $readUser->getResult()) || !isset($id)): ?>
    <form class="form_users" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="action" value="<?= (!empty($id) ? 'update_user' : 'create_user'); ?>">
        <input type="hidden" name="user_id" value="<?= (!empty($id) ? $id : ''); ?>">

        <div class="form_background">

            <span class="form-control">
                <label>Nome:</label>
                <input type="text" name="user_name" placeholder="Digite um nome" value="<?= (!empty($id) ? $user_name : ''); ?>" required>
            </span>
            <span class="form-control">
                <label>Sobrenome:</label>
                <input type="text" name="user_lastname" placeholder="Digite um sobrenome" value="<?= (!empty($id) ? $user_lastname : ''); ?>" required>
            </span>
            <span class="form-control">
                <label>E-mail:</label>
                <input type="text" name="user_email" placeholder="Digite um e-mail" value="<?= (!empty($id) ? $user_email : ''); ?>" required>
            </span>
            <span class="form-control">
                <label>Senha:</label>
                <input type="password" name="user_password" placeholder="Digite uma senha" value="<?= (!empty($id) ? $user_password : ''); ?>" required>
            </span>
            <span class="form-control">
                <label>Nível de Acesso:</label>
                <select name="user_level">
                    <option selected value="">Selecione nível</option>
                    <option <?= (!empty($id) && $user_level == '1' ? ' selected ' : ''); ?> value="1">Editor(a)</option>
                    <option <?= (!empty($id) && $user_level == '2' ? ' selected ' : ''); ?> value="2">Administrador(a)</option>
                    <option class="<?= (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] < '3' ? 'ds-none' : ''); ?>" <?= (!empty($id) && $user_level == '3' ? ' selected ' : ''); ?> value="3">Programador(a)</option>
                </select>
            </span>

        </div>


        <div class="form_background">

            <span class="image_preview">
                <img class="js_preview_image" title="<?= (!empty($id) ? $user_name : ''); ?>" alt="" src="<?= (!empty($id) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $user_foto : ''); ?>">
            </span>

            <span class="form-control input_file_user">
                <label>Foto de Usuário (jpeg, jpg ou png): <?= (!empty($id) ? '<small>' . $user_foto . '</small>' : ''); ?></label>
                <input class="js_change_image_preview" type="file" name="user_foto">
            </span>

            <div class="button_block">
                <button class="btn btn-green radius icon-check-square">Salvar</button>
            </div>

        </div>

    </form>
<?php endif; ?>
<?php include 'inc/loading_message.inc.php'; ?>
