<?php 
session_start();
$_SESSION['marca'] = $_POST['marca'];
?>

<option> SELECIONE MODELO</option>
                        <?php 

//string json contendo os dados de um funcionário

$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/carros/veiculos/{$_POST['marca']}.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;

foreach ( $itens as $e ) 
   
    { 
    
    echo "<option value=\"{$e['id']}\">{$e['name']} </option>";

    
    
    } 
    
   
?> 




