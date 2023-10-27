<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pré-Briefing do Projeto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/boot.css" />

    </head>
    <body>
        <header class="al-center m-top3">
            <h1>Pré-Briefing do Projeto</h1>
        </header>

        <section class="container">

            <div class="content">

                <form action="" method="post" enctype="multipart/form-data">

                    <article class="form_responsavel js_responsavel container">

                        <div class="content">
                            <header class="container m-bottom3 al-center">
                                <h1 class="m-bottom1">Dados do Responsável</h1>
                                <p>Dados do Responsável pela contratação do serviço</p>
                            </header>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Nome Completo<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_nome" placeholder="Digite o nome completo" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Nacionalidade<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_nacionalidade" placeholder="Nacionalidade" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Estado Civil<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <select name="brefing_estadocivil" required>
                                    <option selected="">Selecione</option>
                                    <option value="solteiro">Solteiro(a)</option>
                                    <option value="casado">Casado(a)</option>
                                    <option value="divorciado">Divorciado(a)</option>
                                    <option value="viuvo">Viúvo(a)</option>
                                </select>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Profissão<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_profissao" placeholder="Profissão" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Identidade<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_identidade" placeholder="Identidade" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">CPF<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input id="cpf" type="text" name="brefing_cpf" placeholder="CPF" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Endereço<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_endereco" placeholder="Endereço" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Número<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_numero" placeholder="Número" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Cidade<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_cidade" placeholder="Cidade" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Estado<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_uf" placeholder="Estado" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">CEP<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_cep" placeholder="CEP" required>
                            </label>

                            <div class="clear"></div>
                        </div>
                    </article>

                    <article class="form_empresa js_empresa container">

                        <div class="content">
                            <header class="container m-bottom3 al-center">
                                <h1 class="m-bottom1">Dados da Empresa</h1>
                                <p>Dados da Empresa responsável pela contratação do serviço</p>
                            </header>

                            <label class="form-field col-49">
                                <span class="form-legend">Nome da Empresa</span>
                                <input type="text" name="brefing_empresa" placeholder="Nome da Empresa">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">CNPJ</span>
                                <input type="text" name="brefing_cnpj" placeholder="CNPJ">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Inscrição Estadual</span>
                                <input type="text" name="brefing_inscricao_estadual" placeholder="Inscrição Estadual">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Endereço:</span>
                                <input type="text" name="brefing_endereco_empresa" placeholder="Endereço da Empresa">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Número:</span>
                                <input type="text" name="brefing_numero_empresa" placeholder="Número da Empresa">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Cidade:</span>
                                <input type="text" name="brefing_cidade_empresa" placeholder="Cidade da Empresa">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Estado:</span>
                                <input type="text" name="brefing_uf_empresa" placeholder="Estado da Empresa">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">CEP:</span>
                                <input type="text" name="brefing_cep_empresa" placeholder="CEP da Empresa">
                            </label>

                            <div class="clear"></div>
                        </div>
                    </article>

                    <article class="form_contato js_contato container">

                        <div class="content">
                            <header class="container m-bottom3 al-center">
                                <h1 class="m-bottom1">Dados de Contato</h1>
                                <p>Dados de Contato para comunicação durante o projeto.</p>
                            </header>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Telefone<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_telefone" placeholder="Telefone de Contato" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">E-mail<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="brefing_email" placeholder="E-mail de contato" required>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Skype(Opcional)</span>
                                <input type="text" name="brefing_skype" placeholder="Skype">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Outros:</span>
                                <input type="text" name="brefing_outros" placeholder="Outra Forma de Contato">
                            </label>

                            <div class="clear"></div>
                        </div>
                    </article>

                    <article class="form_redes_sociais js_redes container">

                        <div class="content">
                            <header class="container m-bottom3 al-center">
                                <h1 class="m-bottom1">Sites e Redes Sociais</h1>
                                <p>Dados de Redes Sociais e Domínios do Projeto.</p>
                            </header>

                            <label class="form-field col-49">
                                <span class="form-legend">Domínio (Caso tenha)</span>
                                <input type="text" name="brefing_dominio" placeholder="Domínio (Endereço para o site, ex: https://www.site.com.br) caso já tenha um">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Facebook (Link)</span>
                                <input type="text" name="brefing_facebook" placeholder="Facebook (Link da Página)">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Google Plus (Link)</span>
                                <input type="text" name="brefing_google" placeholder="Google+ (Link do Perfil)">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Twitter:</span>
                                <input type="text" name="brefing_twitter" placeholder="Twitter(Link do Perfil)">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Instagram:</span>
                                <input type="text" name="brefing_instagram" placeholder="Instagram(Link do Perfil)">
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend">Outros:</span>
                                <input type="text" name="brefing_outros" placeholder="Outras Redes Sociais">
                            </label>

                            <div class="clear"></div>
                        </div>
                    </article>

                    <article class="form_materiais js_materiais container">

                        <div class="content">
                            <header class="container m-bottom3 al-center">
                                <h1 class="m-bottom1">Materiais</h1>
                                <p>Materiais Para a Execução do Projeto.</p>
                            </header>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Logo<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="file" name="briefing_logo" title="Logo" class="j_imagem" required/>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Imagens do Evento<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="file" name="briefing_imagens_evento[]" multiple title="Imagens" class="j_imagem" required/>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Imagens dos Ministrantes<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="file" name="briefing_imagens_ministrantes[]" multiple title="Imagens" class="j_imagem" required/>
                            </label>

                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Data do Evento<span class="cl-red pos-absolute right-10">*</span></span>
                                <input type="text" name="brefing_data_evento" placeholder="Datas do Evento" required>
                            </label>

                            <label class="form-field">
                                <span class="form-legend pos-relative">Vídeos dos Ministrantes (Links)<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <textarea rows="5" name="briefing_videos_ministantes" title="Vídeos" required></textarea>
                            </label>

                            <label class="form-field">
                                <span class="form-legend pos-relative">Informações (Textos de Objetivo, Quem Somos, etc..)<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <textarea rows="10" name="briefing_info" title="Informações" required></textarea>
                            </label>

                            <div class="clear"></div>
                        </div>
                    </article>

                    <button class="btn btn-green radius j_btn fl-right">Enviar!</button>
                    <div title="Carregando" class="load fl-right"></div>

                </form>

                <div class="clear"></div>
            </div>
        </section>


    </body>
    
    <script src="../_cdn/jquery.js"></script>
    <script src="../_cdn/jquery.form.js"></script>
    <script src="../_cdn/jmask.js"></script>
    <script src="../_cdn/scripts.js"></script>
    
</html>
