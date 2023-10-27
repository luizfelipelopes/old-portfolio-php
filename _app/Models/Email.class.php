<?php

//require '_app/Library/PHPMailer/class.phpmailer.php';
//require('_app/Library/PHPMailer/class.phpmailer.php');
//require('_app/Library/PHPMailer/class.smtp.php');

/**
 * Email.class [ MODEL ]
 * Modelo responsável por configurar a PHPMailer, validar os dados e disparar e-mails do sistema!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Email {

    /** @var PHPMailer Description */
    private $Mail;

    /** EMAIL DATA */
    private $Data;

    /** CORPO DO E-MAIL */
    private $Assunto;
    private $Mensagem;

    /** REMETENTE */
    private $RemetenteNome;
    private $RemetenteEmail;

    /** DESTINO */
    private $DestinoNome;
    private $DestinoEmail;

    /** CONTROLE */
    private $Error;
    private $Result;

    function __construct() {
        $this->Mail = new PHPMailer;
        $this->Mail->Host = MAILHOST;
        $this->Mail->Port = MAILPORT;
        $this->Mail->SMTPSecure = MAILENCRYPT;
        $this->Mail->Username = MAILUSER;
        $this->Mail->Password = MAILPASS;
        $this->Mail->CharSet = 'UTF-8';
    }

    public function Enviar(array $Data) {
        $this->Data = $Data;
        $this->Clear();

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao enviar: Para enviar esse e-mail. Preencha os campos requisitados!", WS_ALERT];
            $this->Result = false;
            elseif ((isset($this->Data['cliente_email']) && !Check::Email($this->Data['cliente_email']) || (isset($this->Data['user_email']) && !Check::Email($this->Data['user_email'])))):
            $this->Error = ["Erro ao enviar: O e-mail que você informou não tem um formato válido!", WS_ALERT];
            $this->Result = false;
        else:
            $this->setMail();
            $this->Config();
            $this->sendMail();
        endif;
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

    // PRIVATES
    private function Clear() {
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);
    }

    private function setMail() {
        $this->Assunto = $this->Data['Assunto'];
        $this->Mensagem = $this->Data['Mensagem'];
        $this->RemetenteNome = MAILNOME;
        $this->RemetenteEmail = MAILUSER;
        $this->DestinoNome = $this->Data['DestinoNome'];
        $this->DestinoEmail = $this->Data['DestinoEmail'];

        $this->Data = null;
        $this->setMsg();
    }

    private function setMsg() {
        $this->Mensagem = "{$this->Mensagem}<hr><small>Recebida em: " . date('d/m;Y H:i') . "</small>";
    }

    private function Config() {
        //SMTP AUTH
        $this->Mail->isSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->isHTML();
        $this->Mail->SMTPOptions = array('ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //REMETENTE E RETORNO
        $this->Mail->From = MAILUSER;
        $this->Mail->FromName = $this->RemetenteNome;
        $this->Mail->addReplyTo($this->RemetenteEmail, $this->RemetenteNome);

        //ASSUNTO, MENSAGEM E DESTINO
        $this->Mail->Subject = $this->Assunto;
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->addAddress($this->DestinoEmail, $this->DestinoNome);
    }

    private function sendMail() {
        if ($this->Mail->send()):
            $this->Error = ["Obrigado por entrar em contato: Recebemos sua mensagem e estaremos respondendo em breve!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Erro ao enviar: Entre em contato com o admin. ({$this->Mail->ErrorInfo})", WS_ERROR];
            $this->Result = false;
        endif;
    }

}
