<?php


require'../../vendor/autoload.php';

$pagarme = new \PagarMe\Client( CONF_PAGARME_TEST );

$transactions = $pagarme->transactions()->getList();

foreach ($transactions as $key => $value){
//    echo $value->id . "</br>";
//    echo $value->status . "</br>";
    
    $read = new \Source\Models\Read();
    $read->ExeRead("app_transacoes", "WHERE transacao = :a ", "a={$value->id}");
     $puxa = $read->getResult()[0]["fatura_id"];
    
    $Dados = [
        "status" => $value->status
    ];
    
    $update = new \Source\Models\Update();
    $update->ExeUpdate("app_transacoes", $Dados, "WHERE fatura_id = :a", "a={$value->id}");
    $update->getResult();

    $atualizar = new \Source\Models\Update();
    $atualizar->ExeUpdate("app_faturas", $Dados,"WHERE id = :a ", "a={$puxa}");
    
}


var_dump($transactions);

