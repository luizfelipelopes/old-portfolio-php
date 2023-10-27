<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$Action = (LEADS_AC == '1' ? ACTION_AC : (LEADS_MC == '1' ? ACTION_MC : ''));
$Id = (LEADS_AC == '1' ? ID_AC : (LEADS_MC == '1' ? ID_MC : 'captura_lead'));
$InputHidden = (LEADS_AC == '1' ? HIDDEN_INPUT_AC : (LEADS_MC == '1' ? HIDDEN_INPUT_MC : '<input type="hidden" name="action" value="create_lead"/><input type="hidden" name="lead_type" value="horizontal-topo"/>'));
?>



<article class="container bg-yellow bloco_lead">
    <div class="content<?= (!empty($Action) ? '' : ' js_content_form'); ?>">
        <header>
            <h1 class="cl-gray">Baixe Agora o Seu E-book Gratuito Com Deliciosas Receitas Low Carb!</h1>
        </header>

        <form id="<?= $Id; ?>" action="<?= $Action; ?>" method="post" class="bg-yellow lead_front al-center" enctype="multipart/form-data">

            <?php
            
            echo $InputHidden;
            
            if (LEADS_AC == '1' || LEADS_MC == '1'):
                foreach ($OPTIIN['ac_inputs'] as $acInputs):
                    echo $acInputs;
                endforeach;
            else:
                ?>
                <input class="form-field box box-medium" type="text" title="Seu Nome" name="lead_name" placeholder="Seu Nome:" required/>
                <input class="form-field box box-medium" type="email" title="Seu Melhor E-mail" name="lead_email" placeholder="Seu Melhor E-mail:" required/>
            <?php
            endif;
            ?>

            <button class="btn btn-green radius">Baixar Meu E-book!</button>
        </form>
        <div class="clear"></div>
    </div>  
</article>