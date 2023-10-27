<!DOCTYPE html>
<!--
<b>Contato:</b> Disponibiliza Formas de Contato com a Gabadi
Desenvolvido por Luiz Felipe Lopes - 28/12/2018 às 10:06hrs
-->
<!--CORPO DO SITE--> 
<main>

    <div class="contact_container">
        <section class="contact" itemscope itemtype="https://schema.org/Organization">

            <header>
                <h1 class="icon-comment">Entre em Contato</h1>
                <h2>Mande-nos um recado ou sugestões através do nosso formulário de contato</h2>
            </header>

            <div class="contact_address">
                <meta itemprop="name" content="<?= NOME_RESPONSAVEL_EMPRESA; ?>">
                <p class="contact_address_title">Endereço:</p>
                <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                    <p class="contact_address_church"><?= NOME_EMPRESA; ?></p>
                    <p class="contact_address_street" itemprop="streetAddress"><?= ENDERECO_EMPRESA; ?></p>
                    <p class="contact_address_city"><?= CIDADE_EMPRESA . ' - ' . UF_EMPRESA; ?></p>
                    <p class="contact_address_cep">CEP: <?= CEP_EMPRESA; ?></p>
                    <meta itemprop="addressLocality" content="<?= CIDADE_EMPRESA; ?>">
                    <meta itemprop="addressRegion" content="<?= UF_EMPRESA; ?>">
                    <meta itemprop="addressCountry" content="<?= PAIS_EMPRESA; ?>">
                    <meta itemprop="postalCode" content="<?= CEP_EMPRESA; ?>">
                </div>
            </div>

            <div class="contact_mail">
                <p class="contact_mail_title">E-mail:</p>
                <p class="contact_mail_arroba" itemprop="email"><?= EMAIL_EMPRESA; ?></p>
            </div>

        </section>

        <div class="contact_form">
            <form method="post" name="contact_form" enctype="multipart/form-data">
                <div class="trigger-absolute js_trigger_absolute"></div>

                <input type="hidden" name="action" value="receber_email_contato">

                <label class="form-field">
                    <span>Nome:</span>
                    <input type="text" name="comentario_nome" required>
                </label>
                <label class="form-field">
                    <span>E-mail:</span>
                    <input type="email" name="comentario_email" required>
                </label>
                <label class="form-field">
                    <span>Mensagem:</span>
                    <textarea rows="5" name="comentario_mensagem" required></textarea>
                </label>

                <button class="btn radius">Enviar</button>
                <!--<div class="load fl-right"></div>-->

            </form>
        </div>
    </div>
</main>

<?php include REQUIRE_PATH . '/inc/loading_message.inc.php'; ?>
