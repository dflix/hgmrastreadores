<?php require('../_app/Config.inc.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $doc = new Read();
        $doc->ExeRead("documentos", "ORDER BY id_doc ASC");
        $doc->getResult();
        
        foreach ($doc->getResult() as $value) {
            
            echo $value['doc'];
            echo "</br>";
            echo $value['placa'];
            
            $verid = new Read();
            $verid->ExeRead("prevendaacasp", "WHERE placa2 = :p", "p={$value['placa']}");
            $verid->getResult();
            
            if($verid->getResult()):
                
                

            $Dados = [
                "id_venda" => $verid->getResult()[0]['id_venda'],
                "ref" => "associacao"
            ];
            
            var_dump($Dados);
            
            $update = new Update();
            $update->ExeUpdate("documentos", $Dados, "WHERE placa = :s" , "s={$value['placa']}");
            $update->getResult();
            
            if($update->getResult()):
                echo "ATUALIZADO COM SUCESSO";
                else:
                echo "<b>NÃO ATUALIZADO</b>";
            endif;
            
            else:
                
                echo "NÃO ENCONTRADO";
            
             endif; 
            
            echo "<hr>";
}
        ?>
    </body>
</html>
