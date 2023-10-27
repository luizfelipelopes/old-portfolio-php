<?php

/**
 * EmailMensseger.class [ HELPER ]
 * Classe responsável por executar de E-mails de acordo com a ocasião apropriada
 * @copyright (c) 2018, Luiz Felipe C. Lopes FLOWSTATE 
 */
class EmailMensseger {

    /**
     * <b>EmailMensagemContato</b>: Mensagem de notificação de notas lançadas
     * @param String $Nome
     * @param String $Email
     * @param String $Curso
     */
    public static function EmailMensagemContato($Nome, $Email, $Msg) {

        // MONTA ATRIBUTOS DO E-MAIL
        $InfoEmail = [
            "Assunto" => "[MENSAGEM DE CONTATOS] - Você recebeu uma mensagem em Gabadi Online",
            "DestinoNome" => NOME_RESPONSAVEL_EMPRESA,
            "DestinoEmail" => EMAIL_EMPRESA,
            "Mensagem" => "<p>Olá " . NOME_RESPONSAVEL_EMPRESA . ", uma pessoa entrou em contato com você pelo Formulário de Contatos da Gabadi Online, confira os dados:</p><p><b>Nome: {$Nome} </b></p><p><b>Email: {$Email}</b></p><p><b>Mensagem: </b>{$Msg}</p><p>Envie uma mensagem para ela!</p><p>Att.,</p>"
        ];

        $email = new Email();
        $email->Enviar($InfoEmail); // E-MAIL DE AVISO DE NOVO MATERIAL ENVIADO NA PLATAFORMA
//        var_dump($email);

        if ($email->getResult()):
            return true;
        endif;

        return false;
    }

    /**
     * <b>EmailRecuperarSenha</b>: Mensagem de nova senha para o usuário
     * @param String $Nome
     * @param String $Email
     * @param String $Senha
     */
    public static function EmailRecuperarSenha($Nome, $Email, $Senha) {

        // MONTA ATRIBUTOS DO E-MAIL
        $InfoEmail = [
            "Assunto" => "CONFERÊNCIA AVANTE - Suas Credenciais de Acesso",
            "DestinoNome" => $Nome,
            "DestinoEmail" => $Email,
            "Mensagem" => "Olá {$Nome}! <br> Suas credenciais estão logo abaixo:<br><br> e-mail: {$Email} <br> nova senha: {$Senha}<br><br>Atenciosamente!,<br> CONFERÊNCIA AVANTE"
        ];

        $email = new Email();
        $email->Enviar($InfoEmail); // E-MAIL DE AVISO DE NOVA SENHA DE ACESSO

        if ($email->getResult()):
            return true;
        endif;

        return false;
    }

    /**
     * <b>EmailSolicitacaoCompra</b>: Mensagem de solicitação de compra bem-sucedida
     * @param String $Nome
     * @param String $Email
     */
    public static function EmailSolicitacaoCompra($Nome, $Email) {

        // MONTA ATRIBUTOS DO E-MAIL
        $InfoEmail = [
            "Assunto" => "CET-RHEMA - Solicitação de Compra Realizada com Sucesso!",
            "DestinoNome" => $Nome,
            "DestinoEmail" => $Email,
            "Mensagem" => "Olá {$Nome}! <br> Sua solicitação de compra foi realizada com sucesso! <br> Entre em contato pelo <b>WhatsApp (38) 99917-8901</b> para realizar o pagamento!<br><br>Deus Abençõe!,<br> CET-RHEMA"
        ];

        $email = new Email();
        $email->Enviar($InfoEmail); // E-MAIL DE AVISO DE SOLICITAÇÂO DE COMPRA REALIZADA COM SUCESSO
    }

    /**
     * <b>EmailAvisoInscricaoComprador</b>: Mensagem de Notificação de Inscrição para Comprador
     */
    public static function EmailAvisoInscricaoComprador(array $Inscrito) {


        $InfoEmail = [
            "Assunto" => "Nilma Nayara - Recebemos Sua Compra, Aguardando Aproação!",
            "DestinoNome" => $Inscrito['cliente_name'],
            "DestinoEmail" => $Inscrito['cliente_email'],
            "Mensagem" => "<p>Olá {$Inscrito['cliente_name']}! <br> Acabamos de receber a sua inscrição para o <b>Emagreimento Definitio</b>! <br> Confira os dados logo abaixo:</p><br>"
            . "<p><b>Nome: </b>{$Inscrito['cliente_name']} {$Inscrito['cliente_lastname']}</p><br>"
            . "<p><b>E-mail: </b>{$Inscrito['cliente_email']}</p><br>"
            . "<br><br><p>Em bree oe reeberá o e-mail de omproação de pagamento.</p>"
            . "<br><br><p>Att.,</p><br> "
            . "<p>Nilma Nayara</p>"
        ];

        $email = new Email();
        $email->Enviar($InfoEmail); // E-MAIL DE AVISO DE NOVO MATERIAL ENVIADO NA PLATAFORMA

        if ($email->getResult()):
            return true;
        endif;

        return false;
    }

    /**
     * <b>EmailAvisoPagamentoAprovadoComprador</b>: Mensagem de Notificação de Pagamento Aprovado para Comprador
     */
    public static function EmailAvisoPagamentoAprovadoComprador(array $Inscrito) {

        $Cliente = BuscaRapida::buscarCliente($Inscrito['venda_cliente']);

        $InfoEmail = [
            "Assunto" => "NILMA NAYARA NUTRI E COACH - Seu Pagamento Foi Aprovado!",
            "DestinoNome" => $Cliente['cliente_name'],
            "DestinoEmail" => $Cliente['cliente_email'],
            "Mensagem" => "<p>Olá {$Cliente['cliente_name']}! <br> Seu pagamento referente ao <b>Pacote de Emagrecimento</b> acaba de ser aprovado!</p><br>"
            . "<br><br><p>Att.,</p><br> "
            . "<p>NILMA NAYARA NUTRI E COACH</p>"
        ];

        $email = new Email();
        $email->Enviar($InfoEmail); // E-MAIL DE AVISO DE NOVO MATERIAL ENVIADO NA PLATAFORMA

        if ($email->getResult()):
            return true;
        endif;

        return false;
    }

    /**
     * <b>EmailAvisoPagamento</b>: Mensagem de Notificação de Envio de Materiais
     * @param Array $Inscrito
     */
    public static function EmailAvisoPagamento(array $Inscrito) {

        $InfoEmail = [
            "Assunto" => "NILMA NAYARA NUTRI E COACH - Uma pessoa acaba de comprar um pacote de emagrecimento!",
            "DestinoNome" => "Nilma Nayara",
            "DestinoEmail" => MAIL_NOTIFICACOES_SISTEMA,
            "Mensagem" => "<p>Olá! <br> Uma pessoa acaba de comprar um <b>Pacote de Emagrecimento</b>! <br> Confira os dados logo abaixo:</p><br>"
            . "<p><b>Nome: </b>{$Inscrito['cliente_name']}</p><br>"
            . "<p><b>CPF: </b>{$Inscrito['cliente_cpf']}</p><br>"
            . "<p><b>E-mail: </b>{$Inscrito['cliente_email']}</p><br>"
            . "<br><br><p>Att.,</p><br> "
            . "<p>NILMA NAYARA NUTRI E COACH</p>"
        ];

        $email = new Email();
        $email->Enviar($InfoEmail); // E-MAIL DE AVISO DE NOVO MATERIAL ENVIADO NA PLATAFORMA
    }

}
