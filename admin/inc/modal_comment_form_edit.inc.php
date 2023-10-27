<?php
/*
  Módulo: Comment Form Edit (Formulário de Edição de Comentário)
  Author: Luiz Felipe C. Lopes
  Date: 06/09/2018
 */
?>
<div class = "modal_background js_modal js_modal_form_edit_comment">
    <div class="modal_container_form form_background">
        <form class="js_form_modal" action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="action" value="update_comment">
            <input type="hidden" name="comentario_id">


            <span class="form-control capa_featured">
                <label>Nome:</label>
                <input type="text" name="comentario_author">
            </span>
            <span class="form-control capa_featured">
                <label>Comentário:</label>
                <textarea rows="7" name="comentario_content"></textarea>
            </span>

            <div class="button_block">
                <button class="btn btn-green radius icon-check-square">Salvar</button>
            </div>
        </form>
        <button class="btn btn-red btn_cancel_edit radius icon-exit js_close_modal">Cancelar</button>
    </div>
</div>