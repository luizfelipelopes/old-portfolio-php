<section class="contato container">
    <div class="info_contato">
        <div class="limite_view">
            <div class="content">

                <header class="container">
                    <h1>Entre em Contato</h1>
                    <p>Entre em contato pelo nosso WhatsApp ou utilize o formulário de contato.</p>
                </header>

                <div itemscope itemtype="https://schema.org/Person">
                    <meta itemprop="name" content="<?= NOME_RESPONSAVEL_EMPRESA; ?>">
                    <meta itemprop="jobTitle" content="Nutricionista">
                    <meta itemprop="jobTitle" content="Coach Nutricional">
                    <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                        <div class="info_endereco">
                            <!-- <p>Endereço:</p>
                            <p itemprop="streetAddress"><?= ENDERECO_EMPRESA; ?></p>
                            <p><?= CIDADE_EMPRESA; ?> – <?= UF_EMPRESA; ?> – <?= PAIS_EMPRESA; ?></p>
                            <p>CEP. <?= CEP_EMPRESA; ?></p> -->
                            <meta itemprop="addressLocality" content="<?= CIDADE_EMPRESA; ?>">
                            <meta itemprop="addressRegion" content="<?= UF_EMPRESA; ?>">
                            <meta itemprop="addressCountry" content="<?= PAIS_EMPRESA; ?>">
                            <meta itemprop="postalCode" content="<?= CEP_EMPRESA; ?>">
                        </div>

                        <div class="info_telefone">
                            <p>WhatsApp:</p>
                            <p>Tel. <?= TELEFONES_EMPRESA; ?></p>
                            <meta itemprop="telephone" content="<?= TELEFONES_EMPRESA; ?>">
                        </div>

                        <div class="info_email">
                            <p>E-mail:</p>
                            <p itemprop="email"><?= EMAIL_EMPRESA; ?></p>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="form_contato">
        <div class="limite_view">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="js_trigger_absolute"></div>

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

                <button class="btn btn-green radius fl-right ds-inblock">Enviar</button>
                <div class="load fl-right"></div>

                <div class="clear"></div>
            </form>
        </div>
    </div>

</section>
