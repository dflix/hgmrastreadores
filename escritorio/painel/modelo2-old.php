<?php 

    $trata = explode("|", $_POST['marca']);

$refe = $trata[1];

print_r($trata);


?>

<option> SELECIONE MODELO</option>
                        <?php 

//string json contendo os dados de um funcionário

$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/caminhoes/veiculos/{$trata[1]}.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;

foreach ( $itens as $e ) 
  
    { 
  
    $d= "|";
    echo "<option value=\"{$e['name']}{$d}{$e['id']}{$d}{$refe}\">{$e['name']} </option>";
 
    } 
    
   
?> 




