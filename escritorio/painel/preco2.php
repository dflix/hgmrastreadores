<?php 
session_start();

$fipe = explode("|", $_POST['preco']);


print_r($fipe);

?>

                        <?php 

//string json contendo os dados de um funcionário


 
$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/caminhoes/veiculo/{$fipe[2]}/{$fipe[3]}/{$fipe[1]}.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;

    
    echo "<option value=\"{$itens['preco']}\">{$itens['preco']} </option>";
    
    echo "";
 
?> 



