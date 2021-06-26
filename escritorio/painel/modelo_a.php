<?php 
session_start();


$trata = explode("/", $_POST['marca']);
//print_r($trata);

$_SESSION['marca'] = $trata[0];

$_SESSION['marca1'] = $trata[1];

?>

<option> SELECIONE MODELO <?= $trata[0] ?> / <?= $trata[1] ?> </option>
                        <?php 

//string json contendo os dados de um funcionário

$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/carros/veiculos/{$_SESSION['marca']}.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;

$d = "/";

foreach ( $itens as $e ) 
   
    { 
    
    echo "<option value=\"{$e['id']}{$d}{$e['name']}\">{$e['name']} </option>";

    
    
    } 
    
   
?> 




