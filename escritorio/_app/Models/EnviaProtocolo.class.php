<?php

require('../_app/Library/PHPMailer/class.phpmailer.php');

/**
 * Email [ MODEL ]
 * Modelo responável por configurar a PHPMailer, validar os dados e disparar e-mails do sistema!
 * 
 * @copyright (c) year, Marcio. Leite ML SOLUÇÕES WEB
 *  */
class EnviaProtocolo {

    /** @var PHPMailer */
    private $Mail;

    /** EMAIL DATA  */
    private $Data;

    /** CORPO DO E-MAIL CONTEUDO DO EMAIL (HTML) */
    private $Assunto;
    private $Mensagem;

    /** REMETENTE */
    private $nome;
    private $email;

    /** DESTINO */
    private $DestinoNome;
    private $DestinoEmail;

    /** CONSTROLE */
    private $Error;
    private $Result;

    function __construct() {
        $this->Mail = new PHPMailer;
        $this->Mail->Host = MAILHOST;
        $this->Mail->Port = MAILPORT;
        $this->Mail->Username = MAILUSER;
        $this->Mail->Password = MAILPASS;
        $this->Mail->CharSet = 'UTF-8';
    }

    /**
     * <b>Enviar E-mail SMTP:</b> Envelope os dados do e-mail em um array atribuitivo para povoar o método.
     * Com isso execute este para ter toda a validação de envio do e-mail feita automaticamente.
     * 
     * <b>REQUER DADOS ESPECÍFICOS:</b> Para enviar o e-mail você deve montar um array atribuitivo com os
     * seguintes índices corretamente povoados:<br><br>
     * <i>
     * &raquo; Assunto<br>
     * &raquo; Mensagem<br>
     * &raquo; nome<br>
     * &raquo; email<br>
     * &raquo; DestinoNome<br>
     * &raquo; DestinoEmail
     * </i>
     */
    public function Enviar(array $Data) {
        $this->Data = $Data;
        $this->Clear();

//        if (in_array('', $this->Data)):
//            $this->Error = ['Erro ao enviar mensagem: Para enviar esse e-mail. Preencha os campos requisitados!', WS_ALERT];
//            $this->Result = false;
        if (!Check::Email($this->Data['email'])):
            $this->Error = ['Erro ao enviar mensagem: O e-mail que você informou não tem um formato válido. Informe seu E-mail!', WS_ALERT];
            $this->Result = false;
        else:
            $this->setMail();
            $this->Config();
            $this->sendMail();
        endif;
    }

    /**
     * <b>Verificar Envio:</b> Executando um getResult é possível verificar se foi ou não efetuado 
     * o envio do e-mail. Para mensagens execute o getError();
     * @return BOOL $Result = TRUE or FALSE
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com o erro e o tipo de erro.
     * @return ARRAY $Error = Array associatico com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Limpa código e espaços!
    private function Clear() {
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);
    }

    //Recupera e separa os atributos pelo Array Data.
    private function setMail() {
        $this->Assunto = $this->Data['assunto'];
//       // $this->mensagem = $this->Data['mensagem'];
        $this->email = $this->Data['email'];
        $this->data = $this->Data['data'];
//        $this->telefone = $this->Data['telefone'];
//        $this->celular = $this->Data['celular'];
//        $this->veiculo = $this->Data['veiculo'];
//        $this->valor = $this->Data['valor'];
        //$this->DestinoNome = $this->Data['nome'];
        $this->DestinoEmail = $this->Data['email'];


        //$this->Data = null;
        $this->setMsg();
    }

    //Formatar ou Personalizar a Mensagem!
    private function setMsg() {

        $this->Mensagem = " <main style=\"width: 100%; background: #ebebeb;\"> 
    
        
    
    <section style=\"width: 80%; margin:0 auto; background: #fff;\"> 
        <img src=\"http://www.protegefacil.com.br/themes/default/img/logo-protege.png\" />
        <h2 style=\"font-family: Tahoma; font-size: 1.5em; color: #053a8a; margin-left: 10px; \">Protocolo de Atendimento Protege {$_POST['protocolo']} </h2>
        <p> </p>
        <p>Recebemos a solicitação de {$_POST['categoria']} </p>
        <p> <b>Protocolo </b>= {$_POST['protocolo']} </p>
        <p> <b>Histórico </b>= {$_POST['historia']} </p>

        <p> Central de atendimento Protege Rastreadores </p>
        <p> Telefones :(11) 2649-7348</p>
        <p> Site <a href=\"http://www.protegefacil.com.br\"> www.protegefacil.com.br </a></p>
        <p> E-mail <a href=\"mailto:contato@protegefacil.com.br\"> contato@protegefacil.com.br </a></p>
        <p> E-mail de notificação, por gentileza não responder este e-mail.</p>
        <p> E-mail enviado em {$_POST['data']}.</p>
        </br></br></br></br></br>
    </section>

</main>
<style> 
p{ font-family: Tahoma, Arial; font-size: 1.0em; color:#999; margin-left: 10px;}
</style>";
    }

    //Configura o PHPMailer e valida o e-mail!
    private function Config() {
        //SMTP AUTH
        $this->Mail->IsSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->IsHTML();

        //REMETENTE E RETORNO
        $this->Mail->From = MAILUSER;
        $this->Mail->FromName = $this->nome;
        $this->Mail->AddReplyTo($this->email, $this->nome);

        //ASSUNTO, MENSAGEM E DESTINO
        $this->Mail->Subject = $this->Assunto;
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->AddAddress($this->email, $this->nome);
    }

    //Envia o e-mail!
    private function sendMail() {
        if ($this->Mail->Send()):
            $this->Error = ['Obrigado por realizar a cotação: Verifique a proposta em seu e-mail!', WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Erro ao enviar: Entre em contato com o admin. ( {$this->Mail->ErrorInfo} )", WS_ERROR];
            $this->Result = false;
        endif;
    }

}
