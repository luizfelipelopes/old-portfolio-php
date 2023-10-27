<div id="optin">
    <form action='//<?= $OPTIIN['ac_host']; ?>.activehosted.com/proc.php' method='post' id='_form_<?= $OPTIIN['ac_form']; ?>' accept-charset='utf-8' enctype='multipart/form-data'>
        <input type="hidden" name="u" value="<?= $OPTIIN['ac_form']; ?>" />
        <input type="hidden" name="f" value="<?= $OPTIIN['ac_form']; ?>" />
        <input type="hidden" name="s" />
        <input type="hidden" name="c" value="0" />
        <input type="hidden" name="m" value="0" />
        <input type="hidden" name="act" value="sub" />
        <input type="hidden" name="v" value="2" />
        <?php
        foreach ($OPTIIN['ac_inputs'] as $acInputs):
            echo $acInputs;
        endforeach;
        ?>
        <button class="btn_<?= $OPTIIN['ac_button_color']; ?>"><?= $OPTIIN['ac_register']; ?></button>
    </form>
    <p class="termos">Também Odiamos Spam!</p>
</div>