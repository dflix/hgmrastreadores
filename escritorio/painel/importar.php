<?php 
require('../../_app/Config.inc.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $read = new Read();
        $read->ExeRead("prevenda");
        $read->getResult();
        
        foreach ($read->getResult() as $valor) {

//            $Dados = [
//                "id" => "",
//                "nome" => "",
//                "cpf" => "",     
//                "logradouro" => "",
//                "numero" => "",
//                "complemento" => "",
//                "cidade" => "",
//                "uf" => "",
//                "cep" => "",
//                "telcel" => "",
//                "email" => "",
//                "observacao" => ""
//            ];
            
            $id = $valor["id_venda"];
            $nome = $valor["cliente"];
            $cpf = $valor["cpf"];
            $logradouro = $valor["endereco"];
            $numero = $valor["numero"];
            $complemento = $valor["complemento"];
            $cidade = $valor["cidade"];
            $uf = $valor["uf"];
            $cep = $valor["cep"];
            $telcel = $valor["telcel"];
            $email = $valor["email"];
            $obs = $valor["marca"] . "|" . $valor["modelo"] . "|" . $valor["cor"] . "|" . $valor["placa"];
            
            
            $dado = $id . ";" . "$nome" . ";" . $cpf . ";" . $logradouro . ";" .$numero . ";" . $complemento .
                    ";" . $cidade . ";" . $uf . ";" . $cep . ";" . $telcel . ";" . $email . ";" . $obs  ."\n"; 
            
            echo $dado . "</br>";
            
            
               // Abre ou cria o arquivo bloco1.txt
//"a" representa que o arquivo é aberto para ser escrito
        $fp = fopen("importar.txt", "a");

        $escreve = fwrite($fp, "{$dado}");

        fclose($fp);
            
        }
        ?>
        
        
        
       
    </body>
</html>
