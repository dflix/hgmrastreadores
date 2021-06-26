<?php


require '../vendor/autoload.php';

$read = new Source\Models\Read();
$read->ExeRead("prevenda", "ORDER BY id_venda DESC");
$read->getResult();
$i = 0;
foreach ($read->getResult() as $valor) {
    $i++;
    echo $i . "</br>";
    echo $valor["id_venda"] . "</br>";
    echo $valor["codigo"] . "</br>";
    echo $valor["cliente"] . "</br>";
    echo $valor["data_nasc"] . "</br>";
    echo $valor["cpf"] . "</br>";
    echo $valor["rg"] . "</br>";
    echo $valor["telres"] . "</br>";
    echo $valor["telcel"] . "</br>";
    echo $valor["email"] . "</br>";
    echo $valor["endereco"] . "</br>";
    echo $valor["numero"] . "</br>";
    echo $valor["complemento"] . "</br>";
    echo $valor["bairro"] . "</br>";
    echo $valor["cidade"] . "</br>";
    echo $valor["cep"] . "</br>";
    echo $valor["uf"] . "</br>";
    echo $valor["veiculo"] . "</br>";
    echo $valor["marca"] . "</br>";
    echo $valor["modelo"] . "</br>";
    echo $valor["ano"] . "</br>";
    echo $valor["cor"] . "</br>";
    echo $valor["placa"] . "</br>";
    echo $valor["chassi"] . "</br>";
    echo $valor["renavam"] . "</br>";
    echo $valor["fipe"] . "</br>";
    echo $valor["valor"] . "</br>";
    echo $valor["data"] . "</br>";
    echo "<hr>";
}



