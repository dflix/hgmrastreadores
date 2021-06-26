<?php

require('_app/Library/PHPMailer/class.phpmailer.php');

/**
 * Email [ MODEL ]
 * Modelo responável por configurar a PHPMailer, validar os dados e disparar e-mails do sistema!
 * 
 * @copyright (c) year, Marcio. Leite ML SOLUÇÕES WEB
 *  */
class EnviaPropostaAcasp {

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
        // $this->mensagem = $this->Data['mensagem'];
        $this->nome = $this->Data['nome'];
        $this->email = $this->Data['email'];
        $this->telefone = $this->Data['telefone'];
        $this->celular = $this->Data['celular'];
        $this->veiculo = $this->Data['veiculo'];
        $this->valor = $this->Data['valor'];
        $this->DestinoNome = $this->Data['nome'];
        $this->DestinoEmail = $this->Data['email'];


        //$this->Data = null;
        $this->setMsg();
    }

    //Formatar ou Personalizar a Mensagem!
    private function setMsg() {

        $valorformata = number_format($_POST['valor'], 3, '', '');
        $novovalor = number_format($valorformata, 2, '.', '');

        $mensalidade = $novovalor / 100 * 0.3;
        $mesacasp = number_format($mensalidade, 2, '.', '.');


        $franquia = $novovalor / 100 * 3;
        
        $valorfranquia = number_format($franquia , 2, '.','.');

        if ($novovalor > 99999.00) {

            $rastreador = "130.00";
            $qtd = 2;

            $assistencia24hs = "65.00";
        }

        if ($novovalor < 99999.00) {

            $rastreador = "65.00";
            $qtd = 1;

            $assistencia24hs = "65.00";
        }

        $total = $mesacasp + $rastreador + $assistencia24hs;

        $soma = number_format($total, 2, '.', ',');




        $this->Mensagem = ""
                . "<img src=\"topo-acasp.jpg\" />"
                . "<p style=\" width:auto; height:auto; padding:10px; background: #333; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;\">Olá {$_POST['nome']} conforme solicitado segue cotação para seu caminhão.</p>"
                . "<p style=\" font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333; margin-left:10px;\">Principais benefícios dos associados ASSOCIAÇÃO SÃO PAULO.</p>"
                . "<ul style=\" font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; line-height:20px; font-weight:bold; margin-right:10px;\">"
                . " <li>Em caso de roubo ou furto e não recuperação do mesmo, indenização em 100% tabela FIPE</li>
                <li>Em caso de incêndio,colisão (parcial ou total) a associação São Paulo faz o concerto do veículo através das oficinas conveniadas, por uma franquia no valor de 3% sobre o valor do veículo. no seu carro a franquia é de R$ {$valorfranquia} </li> </ul>"
                ."<p style=\" width:auto; height:auto; padding:10px; background:#F60; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;\">Cobertura em território nacional.</p>"
                ."<p style=\" font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; margin-left:10px;\">É obrigatório a contratação de sistema de rastreamento.</p>"
                ."<p style=\" font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; margin-left:10px;\">no seu caso vc precisa de {$qtd} rastreador(es) no valor de R$ {$rastreador}"
                ." <p style=\" width:auto; height:auto; padding:10px; background: #999; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;\">Seu Caminhão : {$_POST['veiculo']}</p>"
                ."<p style=\" width:auto; height:auto; padding:10px; background: #999; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;\">Valor Caminhão: {$novovalor}</p>"
                ."<p style=\" width:auto; height:auto; padding:10px; background: #999; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;\">Mensalidade  ASSOCIAÇÃO  R$ {$mesacasp}</p>"
                ."<p style=\" width:auto; height:auto; padding:10px; background: #999; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;\">Assistência 24hs  R$ {$assistencia24hs}</p>"
                ."<p style=\" width:auto; height:auto; padding:10px; background:#F60; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;\">Mensalidade Total  R$ {$soma}</p>"
                ."<p style=\" font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; margin-left:10px;\">Para contratar ligue agora para (11)2649-7348 / (11)2649-7349 / (11)2649-7413 / (11)2649-7448 / (11)2219-1050   das 9:00 às 18:00hs.</p>
<p style=\" font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; margin-left:10px;\">Consulte o contrato de asssociado. clique aqui</p>
      <p style=\" font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; margin-left:10px;\">visite nosso site <a href=\"http://www.associacaosaopaulo.com.br\">http://www.associacaosaopaulo.com.br</a></p>"

                . "<hr><small>Recebida em: " . date('d/m/Y H:i') . "</small>";
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
