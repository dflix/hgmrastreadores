<?php

namespace Source\Core;

class Boletos {

    private $filtro;

    public function __construct() {

        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->filtro = $filtro;
    }

    public function boleto() {

        if (!empty($this->filtro)) {
            
           $pagarme = new \PagarMe\Client( CONF_PAGARME_TEST );
           
           $nome = new \Source\Models\Read();
           $nome->ExeRead("app_prevenda", "WHERE id = :a", "a={$this->filtro["cliente_id"]}");
           $nome->getResult();
            
          $transaction = $pagarme->transactions()->create([
    'amount' => $this->filtro["valor"],
    'payment_method' => 'boleto',
   
    'customer' => [
        'external_id' => "{$nome->getResult()[0]["id"]}",
        'name' => "{$nome->getResult()[0]["nome"]}",
        'type' => 'individual',
        'country' => 'br',
        'documents' => [
          [
            'type' => 'cpf',
            'number' => "{$nome->getResult()[0]["cpf_cnpj"]}"
          ]
        ],
        'phone_numbers' => [ '+551199999999' ],
        'email' => "{$nome->getResult()[0]["email"]}"
    ]
    
]);
            
            $Dados = [
                "fatura_id" => $this->filtro["fatura_id"],
                "payment_method" => "boleto",
                "boleto_url" => $transaction->boleto_url,
                "boleto_barcode" => $transaction->boleto_barcode,
                "cliente_id" => $this->filtro["cliente_id"],
                "parcela" => $this->filtro["parcela"],
                "transacao" => $transaction->tid,
                "amount" => $this->filtro["valor"],
                "status" => $transaction->status
            ];
            
            $transacao = new \Source\Models\Create();
            $transacao->ExeCreate("app_transacoes", $Dados);
            $transacao->getResult();
            
            if($transacao->getResult()){
                echo "<div class='alert alert-success'> Boleto Gerado com Sucesso acesse boleto <a href='$transaction->boleto_url' target='_blank'> clicando aqui </a> </div>";
            }else{
                echo "<div class='alert alert-danger'>erro ao gerar boleto</div>";
            }
                

            
        }
    }

}
