<div id="optin">
    <!--<form action="//<?= $OPTIIN['ac_host']; ?>.us18.list-manage.com/subscribe/post?u=22aea4a2323aecbaac26f2978&amp;id=<?= $OPTIIN['ac_form']; ?>" method="post" accept-charset='utf-8' enctype='multipart/form-data'>-->
    <form action="" method="post" accept-charset='utf-8' enctype='multipart/form-data'>
        <input type="hidden" name="action" value="create_lead">
        <input type="hidden" name="lead_type" value="pagina-venda">
        <?php
        foreach ($OPTIIN['ac_inputs'] as $acInputs):
            echo $acInputs;
        endforeach;
        ?>
        <button class="btn_<?= $OPTIIN['ac_button_color']; ?>"><?= $OPTIIN['ac_register']; ?></button>
    </form>
    <p class="termos">Também Odiamos Spam!</p>
</div>

