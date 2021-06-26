<?php

require('../_app/Library/PHPMailer/class.phpmailer.php');

/**
 * Email [ MODEL ]
 * Modelo responável por configurar a PHPMailer, validar os dados e disparar e-mails do sistema!
 * 
 * @copyright (c) year, Marcio. Leite ML SOLUÇÕES WEB
 *  */
class EnviaProtocoloAcasp {

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
        <img src=\"data:image/png;base64,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\" />
        <h2 style=\"font-family: Tahoma; font-size: 1.5em; color: #053a8a; margin-left: 10px; \">Protocolo de Atendimento Associação São Paulo {$_POST['protocolo']} </h2>
        <p> </p>
        <p>Recebemos a solicitação de {$_POST['categoria']} </p>
        <p> <b>Protocolo </b>= {$_POST['protocolo']} </p>
        <p> <b>Histórico </b>= {$_POST['historia']} </p>

        <p> Central de atendimento Associação São Paulo </p>
        <p> Telefones :(11) 2649-7348</p>
        <p> Site <a href=\"http://www.associacaosaopaulo.com.br\"> www.associacaosaopaulo.com.br </a></p>
        <p> E-mail <a href=\"mailto:contato@protegefacil.com.br\"> contato@associacaosaopaulo.com.br </a></p>
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
