<?php

//require '_app/Library/PHPMailer/class.phpmailer.php';
//require('_app/Library/PHPMailer/class.phpmailer.php');
//require('_app/Library/PHPMailer/class.smtp.php');

/**
 * EmailMail.class [ MODEL ]
 * Modelo responsável por configurar o Mail, validar os dados e disparar e-mails do sistema!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class EmailMail {

    /** @var PHPMailer Description */
    private $Host;
    private $Port;
    private $User;
    private $Pass;
    private $Charset;

    /** EMAIL DATA */
    private $Data;

    /** CORPO DO E-MAIL */
    private $Headers;
    private $Assunto;
    private $Mensagem;
    private $Subject;

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
        $this->Host = MAILHOST;
        $this->Port = MAILPORT;
//        $this->Mail->SMTPSecure = MAILENCRYPT;
        $this->User = MAILUSER;
        $this->Pass = MAILPASS;
        $this->CharSet = 'UTF-8';
    }

    public function Enviar(array $Data) {
        $this->Data = $Data;
        $this->Clear();

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao enviar: Para enviar esse e-mail. Preencha os campos requisitados!", WS_ALERT];
            $this->Result = false;
        elseif (!Check::Email($this->Data['cliente_email'])):
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
        $this->RemetenteNome = 'CARDI TAPETES';
        $this->RemetenteEmail = 'feleplopesti@gmail.com';
        $this->DestinoNome = $this->Data['DestinoNome'];
        $this->DestinoEmail = $this->Data['DestinoEmail'];

        $this->Data = null;
        $this->setHeaders();
        $this->setMsg();
    }

    
    
    private function setHeaders() {
            $this->Headers = "MIME-Version: 1.0" . PHP_EOL;
            $this->Headers .= 'Content-Type: text/html; charset="utf-8"' . PHP_EOL;
            $this->Headers .= 'Content-Transfer-Encoding: base64' . PHP_EOL;
            $this->Headers .= "X-Priority: 3" . PHP_EOL;
            $this->Headers .= "X-Mailer: ".SITENAME." Newsletter (".HOME.")" . PHP_EOL;
            $this->Headers .= "X-Subscription: Subscribed on {$this->RemetenteEmail}, via web form, by {$_SERVER['SERVER_ADDR']}, from {$_SERVER['SERVER_ADDR']}" . PHP_EOL;
            $this->Headers .= "X-Abuse-Info: Please forward a copy of this message, including all headers, to lipediamantina@hotmail.com" . PHP_EOL;
            $this->Headers .= "X-Abuse-Info: You can also report abuse here: lipediamantina@hotmail.com" . PHP_EOL;
            $this->Headers .= "X-Complaints-To: lipediamantina@hotmail.com" . PHP_EOL;
            $this->Headers .= "List-Unsubscribe: <mailto: {$this->RemetenteEmail}?subject=remover+launch+email+{$this->DestinoEmail}> <".HOME."/&lm=" . base64_encode($this->DestinoEmail) . ">" . PHP_EOL;
            $this->Headers .= "List-ID: {$this->RemetenteEmail}" . PHP_EOL;

            $this->Headers .= "To: {$this->DestinoEmail}" . PHP_EOL;
            $this->Headers .= "From: ".SITENAME." <{$this->RemetenteEmail}>" . PHP_EOL;
            $this->Headers .= "Reply-To: ".SITENAME." <{$this->RemetenteEmail}>" . PHP_EOL;
            $this->Headers .= "Return-Path: ".SITENAME." {$this->RemetenteEmail}" . PHP_EOL;
            $this->Headers .= "Organization: ".SITENAME." " . PHP_EOL;
    }
    
    private function setMsg() {
        $this->Mensagem = "{$this->Mensagem}<hr><small>Recebida em: " . date('d/m;Y H:i') . "</small>";
    }

    private function Config() {
        $this->Subject = "=?UTF-8?B?" . base64_encode($this->DestinoNome) . "?=";
    }

    private function sendMail() {
        
        
        $SendMail = mail($this->DestinoEmail, $this->Subject, base64_encode($this->Mensagem), $this->headers, "-f" . $this->RemetenteEmail);
        
        
        if ($SendMail):
            $this->Error = ["Obrigado por entrar em contato: Recebemos sua mensagem e estaremos respondendo em breve!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Erro ao enviar: Entre em contato com o admin. ({$this->RemetenteEmail})", WS_ERROR];
            $this->Result = false;
        endif;
    }

}
