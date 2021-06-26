<?php

require('../_app/Library/PHPMailer/class.phpmailer.php');

/**
 * Email [ MODEL ]
 * Modelo responável por configurar a PHPMailer, validar os dados e disparar e-mails do sistema!
 * 
 * @copyright (c) year, Marcio. Leite ML SOLUÇÕES WEB
 *  */
class EnviaProposta {

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
        if (!Check::Email($_POST['email'])):
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
       
        $this->nome = $this->Data['nome'];
        $this->email = $this->Data['email'];
        $this->html = $this->Data['html'];
        $this->id_usuario = $this->Data['id_usuario'];
        //$this->data = $this->Data['data'];
        $this->DestinoNome = $this->Data['DestinoNome'];
        $this->DestinoEmail = $this->Data['DestinoEmail'];


        $this->Data = null;
        $this->setMsg();
    }

    //Formatar ou Personalizar a Mensagem!
    private function setMsg() {
        
        $data = date("d/m/Y H:i:s");
        
        $envia = new Read();
        $envia->ExeRead("proposta", "WHERE id_proposta = :p", "p={$_POST['html']}");
        $envia->getResult();

        $this->Mensagem = ""
                . "<div style='width:100%;'><img src='http://www.rastreadoresprotege.com.br/uploads/images/2017/08/logo-protege-1501600162.png' /></div>"
                . "<p>Olá {$this->nome}  </p>"
                . "".$envia->getResult()[0]['proposta']
            
                        . "<p>Proposta enviada em {$data}</p>"
                        . "<p>Caso queira cancelar recebimento de nossa newslleter clique aqui</p>";
    }

    //Configura o PHPMailer e valida o e-mail!
    private function Config() {
        //SMTP AUTH
        $this->Mail->IsSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->IsHTML();

        //REMETENTE E RETORNO
        $this->Mail->From = MAILUSER;
        $this->Mail->FromName = "Rastreadores Protege";
        $this->Mail->AddReplyTo($this->email, $this->nome);

        //ASSUNTO, MENSAGEM E DESTINO
        $this->Mail->Subject = $_POST['assunto'];
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->AddAddress($this->email, $this->nome);
    }

    //Envia o e-mail!
    private function sendMail() {
        if ($this->Mail->Send()):
            $this->Error = ['Obrigado por entrar em contato: Recebemos sua mensagem e estaremos respondendo em breve!', WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Erro ao enviar: Entre em contato com o admin. ( {$this->Mail->ErrorInfo} )", WS_ERROR];
            $this->Result = false;
        endif;
    }

}
