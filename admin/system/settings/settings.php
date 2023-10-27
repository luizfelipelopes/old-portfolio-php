<!DOCTYPE html>
<!--
Página: Settings (Configurações)
Author: Luiz Felipe C. Lopes
Date: 31/08/2018
-->

<?php
$Settings = [
    "SITE_NAME" => BuscaRapida::buscarSetting('SITE_NAME'),
    "SITE_DESCRIPTION" => BuscaRapida::buscarSetting('SITE_DESCRIPTION'),
    "SITE_URL" => BuscaRapida::buscarSetting('SITE_URL'),
    "SITE_DOMAIN" => BuscaRapida::buscarSetting('SITE_DOMAIN'),
    "SITE_THEME" => BuscaRapida::buscarSetting('SITE_THEME'),
    "AUTHOR_GOOGLE" => BuscaRapida::buscarSetting('AUTHOR_GOOGLE'),
    "PUBLISHER_GOOGLE" => BuscaRapida::buscarSetting('PUBLISHER_GOOGLE'),
    "AUTHOR_FACEBOOK" => BuscaRapida::buscarSetting('AUTHOR_FACEBOOK'),
    "PUBLISHER_FACEBOOK" => BuscaRapida::buscarSetting('PUBLISHER_FACEBOOK'),
    "APP_ID_FACEBOOK" => BuscaRapida::buscarSetting('APP_ID_FACEBOOK'),
    "PROFILE_TWITTER" => BuscaRapida::buscarSetting('PROFILE_TWITTER'),
    "NAME_DEVELOPER" => BuscaRapida::buscarSetting('NAME_DEVELOPER'),
    "NAME_DEVELOPER" => BuscaRapida::buscarSetting('NAME_DEVELOPER'),
    "LINK_DEVELOPER" => BuscaRapida::buscarSetting('LINK_DEVELOPER'),
    "MAIL_HOST" => BuscaRapida::buscarSetting('MAIL_HOST'),
    "MAIL_NAME" => BuscaRapida::buscarSetting('MAIL_NAME'),
    "MAIL_USER" => BuscaRapida::buscarSetting('MAIL_USER'),
    "MAIL_PASS" => BuscaRapida::buscarSetting('MAIL_PASS'),
    "MAIL_PORT" => BuscaRapida::buscarSetting('MAIL_PORT'),
    "MAIL_ENCRYPT" => BuscaRapida::buscarSetting('MAIL_ENCRYPT')
];
extract($Settings);
?>


<div class="form_settings form_background">
    <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="action" value="update_settings">

        <legend class="legend-title icon-globe">Configurações Gerais</legend>

        <span class="form-control">
            <label>Título do Site:</label>
            <input type="text" name="SITE_NAME" placeholder="Digite um título para o site" value="<?= (!empty($SITE_NAME) ? $SITE_NAME : ''); ?>">
        </span>

        <span class="form-control">
            <label>Descrição do Site:</label>
            <input type="text" name="SITE_DESCRIPTION" placeholder="Digite uma descrição para o site" value="<?= (!empty($SITE_DESCRIPTION) ? $SITE_DESCRIPTION : ''); ?>">
        </span>

        <span class="form-control">
            <label>URL do Site (sem a '/' no final):</label>
            <input type="text" name="SITE_URL" placeholder="Digite o endereço do site sem a ‘/’ no final" value="<?= (!empty($SITE_URL) ? $SITE_URL : ''); ?>">
        </span>

        <span class="form-control">
            <label>Domínio do Site (www.meusite.com.br):</label>
            <input type="text" name="SITE_DOMAIN" placeholder="Digite o domínio do site de acordo com exemplo da legenda acima" value="<?= (!empty($SITE_DOMAIN) ? $SITE_DOMAIN : ''); ?>">
        </span>

        <span class="form-control">
            <label>Tema do Site:</label>
            <input type="text" name="SITE_THEME" placeholder="Digite o tema a ser utilizado no site" value="<?= (!empty($SITE_THEME) ? $SITE_THEME : ''); ?>">
        </span>


        <legend class="legend-title icon-testimonial">MEO (MEDIA ENGINE OPTIMIZATION)</legend>

        <span class="form-control">
            <label>Author Google (Perfil G+ do Desenvolvedor):</label>
            <input type="text" name="AUTHOR_GOOGLE" placeholder="Digite o perfil do g+ do desenvolvedor" value="<?= (!empty($AUTHOR_GOOGLE) ? $AUTHOR_GOOGLE : ''); ?>">
        </span>

        <span class="form-control">
            <label>Publisher Google (Perfil G+ da Empresa / Empreendedor):</label>
            <input type="text" name="PUBLISHER_GOOGLE" placeholder="Digite o perfil do g+ da empresa / empreendedor" value="<?= (!empty($PUBLISHER_GOOGLE) ? $PUBLISHER_GOOGLE : ''); ?>">
        </span>

        <span class="form-control">
            <label>Author Facebook (Perfil do FB do Desenvolvedor):</label>
            <input type="text" name="AUTHOR_FACEBOOK" placeholder="Digite o perfil do Facebook do desenvolvedor" value="<?= (!empty($AUTHOR_FACEBOOK) ? $AUTHOR_FACEBOOK : ''); ?>">
        </span>

        <span class="form-control">
            <label>Publisher Facebook (Perfil do FB da Empresa / Empreendedor):</label>
            <input type="text" name="PUBLISHER_FACEBOOK" placeholder="Digite o perfil do Facebook da empresa / empreendedor" value="<?= (!empty($PUBLISHER_GOOGLE) ? $PUBLISHER_GOOGLE : ''); ?>">
        </span>

        <span class="form-control">
            <label>App_Id do Facebook (Aplicativo do Facebook):</label>
            <input type="text" name="APP_ID_FACEBOOK" placeholder="Digite o id do aplicativo do Facebook" value="<?= (!empty($APP_ID_FACEBOOK) ? $APP_ID_FACEBOOK : ''); ?>">
        </span>

        <span class="form-control">
            <label>Perfil do Twitter (Empresa/ Empreendedor):</label>
            <input type="text" name="PROFILE_TWITTER" placeholder="Digite o perfil do Twitter" value="<?= (!empty($PROFILE_TWITTER) ? $PROFILE_TWITTER : ''); ?>">
        </span>

        <span class="form-control">
            <label>Nome do Desenvolvedor:</label>
            <input type="text" name="NAME_DEVELOPER" placeholder="Digite o nome do desenvolvedor" value="<?= (!empty($NAME_DEVELOPER) ? $NAME_DEVELOPER : ''); ?>">
        </span>

        <span class="form-control">
            <label>Link do Desenvolvedor:</label>
            <input type="text" name="LINK_DEVELOPER" placeholder="Digite o link do desenvolvedor" value="<?= (!empty($LINK_DEVELOPER) ? $LINK_DEVELOPER : ''); ?>">
        </span>
        
        <legend class="legend-title icon-testimonial">Mídias Sociais</legend>

        <span class="form-control">
            <label>Facebook:</label>
            <input type="text" name="URL_FACEBOOK" placeholder="Digite a URL do Facebook" value="<?= (!empty($URL_FACEBOOK) ? $URL_FACEBOOK : ''); ?>">
        </span>

        <span class="form-control">
            <label>Instagram:</label>
            <input type="text" name="URL_INSTAGRAM" placeholder="Digite a URL do Instagram" value="<?= (!empty($URL_INSTAGRAM) ? $URL_INSTAGRAM : ''); ?>">
        </span>
        
        <span class="form-control">
            <label>Token Instagram (Para exibir as fotos do perfil no site):</label>
            <input type="text" name="TOKEN_INSTAGRAM" placeholder="Digite o Token do Instagram" value="<?= (!empty($TOKEN_INSTAGRAM) ? $TOKEN_INSTAGRAM : ''); ?>">
        </span>

        <span class="form-control">
            <label>Youtube:</label>
            <input type="text" name="URL_YOUTUBE" placeholder="Digite a URL do Youtube" value="<?= (!empty($URL_YOUTUBE) ? $URL_YOUTUBE : ''); ?>">
        </span>

        <span class="form-control">
            <label>Twitter:</label>
            <input type="text" name="URL_TWITTER" placeholder="Digite a URL do Twitter" value="<?= (!empty($URL_TWITTER) ? $URL_TWITTER : ''); ?>">
        </span>

        <span class="form-control">
            <label>Linkedin:</label>
            <input type="text" name="URL_LINKEDIN" placeholder="Digite a URL do Linkedin" value="<?= (!empty($URL_LINKEDIN) ? $URL_LINKEDIN : ''); ?>">
        </span>
        
        <legend class="legend-title icon-testimonial">Trackeamento</legend>

        <span class="form-control">
            <label>Google Analytics:</label>
            <input type="text" name="GOOGLE_ANALYTICS_ID" placeholder="Digite o ID do Google Analytics" value="<?= (!empty($GOOGLE_ANALYTICS_ID) ? $GOOGLE_ANALYTICS_ID : ''); ?>">
        </span>

        <span class="form-control">
            <label>Google Adsense:</label>
            <input type="text" name="GOOGLE_ADSENSE_ID" placeholder="Digite o ID do Google Adsense" value="<?= (!empty($GOOGLE_ADSENSE_ID) ? $GOOGLE_ADSENSE_ID : ''); ?>">
        </span>

        <span class="form-control">
            <label>Google Adwords:</label>
            <input type="text" name="GOOGLE_ADWORDS_ID" placeholder="Digite o ID do Google Ads" value="<?= (!empty($GOOGLE_ADWORDS_ID) ? $GOOGLE_ADWORDS_ID : ''); ?>">
        </span>

        <span class="form-control">
            <label>Facebook Pixel:</label>
            <input type="text" name="FACEBOOK_PIXEL_ID" placeholder="Digite o ID do Pixel do Facebook" value="<?= (!empty($FACEBOOK_PIXEL_ID) ? $FACEBOOK_PIXEL_ID : ''); ?>">
        </span>
        
        <legend class="legend-title icon-mail">Servidor de E-mail</legend>

        <span class="form-control">
            <label>MailHost (Servidor de E-mail):</label>
            <input type="text" name="MAIL_HOST" placeholder="Digite o servidor do e-mail" value="<?= (!empty($MAIL_HOST) ? $MAIL_HOST : ''); ?>">
        </span>

        <span class="form-control">
            <label>MailName (Nome do Usuário):</label>
            <input type="text" name="MAIL_NAME" placeholder="Digite o nome do usuário de e-mail" value="<?= (!empty($MAIL_NAME) ? $MAIL_NAME : ''); ?>">
        </span>

        <span class="form-control">
            <label>MailUser (E-mail do Usuário):</label>
            <input type="text" name="MAIL_USER" placeholder="Digite o e-mail do usuário" value="<?= (!empty($MAIL_USER) ? $MAIL_USER : ''); ?>">
        </span>

        <span class="form-control">
            <label>MailPass (Senha):</label>
            <input type="password" name="MAIL_PASS" placeholder="Digite a senha" value="<?= (!empty($MAIL_PASS) ? $MAIL_PASS : ''); ?>">
        </span>

        <span class="form-control">
            <label>MailPort (Porta):</label>
            <input type="text" name="MAIL_PORT" placeholder="Digite a porta" value="<?= (!empty($MAIL_PORT) ? $MAIL_PORT : ''); ?>">
        </span>

        <span class="form-control">
            <label>MailEncrypt (Encriptação):</label>
            <input type="text" name="MAIL_ENCRYPT" placeholder="Digite uma encriptação ex: SSL ou TLS" value="<?= (!empty($MAIL_ENCRYPT) ? $MAIL_ENCRYPT : ''); ?>">
        </span>
        
        <legend class="legend-title icon-mail">Dados da Empresa</legend>

        <span class="form-control">
            <label>Nome da Empresa:</label>
            <input type="text" name="COMPANY_NAME" placeholder="Digite o nome da empresa" value="<?= (!empty($COMPANY_NAME) ? $COMPANY_NAME : ''); ?>">
        </span>

        <span class="form-control">
            <label>Resposnsável da Empresa:</label>
            <input type="text" name="COMPANY_NAME_OWNER" placeholder="Digite o nome do responsável da empresa" value="<?= (!empty($COMPANY_NAME_OWNER) ? $COMPANY_NAME_OWNER : ''); ?>">
        </span>

        <span class="form-control">
            <label>Endereço da Empresa:</label>
            <input type="text" name="COMPANY_ADDRESS" placeholder="Digite o endereço da emprésa" value="<?= (!empty($COMPANY_ADDRESS) ? $COMPANY_ADDRESS : ''); ?>">
        </span>

        <span class="form-control">
            <label>Cidade da Empresa:</label>
            <input type="text" name="COMPANY_CITY" placeholder="Digite a cidade da empresa" value="<?= (!empty($COMPANY_CITY) ? $COMPANY_CITY : ''); ?>">
        </span>

        <span class="form-control">
            <label>UF da Empresa:</label>
            <input type="text" name="COMPANY_UF" placeholder="Digite o UF da Empresa" value="<?= (!empty($COMPANY_UF) ? $COMPANY_UF : ''); ?>">
        </span>

        <span class="form-control">
            <label>CEP da Empresa:</label>
            <input type="text" name="COMPANY_CEP" placeholder="Digite o CEP da empresa" value="<?= (!empty($COMPANY_CEP) ? $COMPANY_CEP : ''); ?>">
        </span>
        
        <span class="form-control">
            <label>País da Empresa:</label>
            <input type="text" name="COMPANY_COUNTRY" placeholder="Digite o país da empresa" value="<?= (!empty($COMPANY_COUNTRY) ? $COMPANY_COUNTRY : ''); ?>">
        </span>

        <span class="form-control">
            <label>Telefones da Empresa:</label>
            <input type="text" name="COMPANY_TEL" placeholder="Digite os telefones da empresa" value="<?= (!empty($COMPANY_TEL) ? $COMPANY_TEL : ''); ?>">
        </span>
        
        <span class="form-control">
            <label>E-mail da Empresa:</label>
            <input type="text" name="COMPANY_EMAIL" placeholder="Digite o e-mail da empresa" value="<?= (!empty($COMPANY_EMAIL) ? $COMPANY_EMAIL : ''); ?>">
        </span>

        <div class="button_block">
            <button class="btn btn-green radius icon-check">Salvar</button>
        </div>

    </form>

    <?php include 'inc/loading_message.inc.php'; ?>
</div>
