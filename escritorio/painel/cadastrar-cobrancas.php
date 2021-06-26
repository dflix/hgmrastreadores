<?php

session_start();
require('../_app/Config.inc.php');

$verifica = new Read();
$verifica->ExeRead("prevenda", "WHERE verifica = :p", "p=2");
$verifica->getResult();

foreach ($verifica->getResult() as $value) {
    
        if (empty($value['placa'])):

        $Arr = [
            "verifica" => 3
        ];

        $atualiza = new Update();
        $atualiza->ExeUpdate("prevenda", $Arr, "WHERE placa= :p", "p={$value['placa']}");
        $atualiza->getResult();
        if ($atualiza->getResult()):
            echo "<p class=\"cadastro\">Atualização realizada com sucesso</p>";
        else:
            echo "Erro ao atualizar cadastro";
        endif;
        
        else:

   

    echo "Placa : " . $value['placa'];
    echo "</br>";
    echo "Adesão : " . $value['data'];
    echo "</br>";
    echo "Plano : " . $value['plano'];
    echo "</br>";


    //  echo "</br>";
//
    //   echo "</br>";
    $valor = $value['plano'];
    $valor = str_replace(".", "", $valor); // Primeiro tira os pontos
    $valor = str_replace(",", "", $valor); // Depois tira a vírgula




    $i = 1;
    while ($i <= 12):

        $Date = $value['data'];

        $explodir = explode("-", $Date);

        $dia = 30;

        $DataBase = $explodir['0'] . $explodir['1'] . $dia;

        $vencimentos = date("Y-m-d", strtotime($DataBase . " + {$i} month"));

        $Dados = [
            "documento" => $value['placa'],
            "parcela" => $i,
            "emissao" => $DataBase,
            "vencimento" => $vencimentos,
            "valor" => $valor,
            "status" => 1,
            "tipo" => 1
        ];

        $cadastra = new Create();
        $cadastra->ExeCreate("boletosantander", $Dados);
        $cadastra->getResult();

        if ($cadastra->getResult()):

            echo "<b>cobrança {$i} Placa {$value['placa']} cadastrada com sucesso</b> </br>";

            if ($i >= 12):

                $Arr = [
                    "verifica" => 2
                ];

                $atualiza = new Update();
                $atualiza->ExeUpdate("prevenda", $Arr, "WHERE placa= :p", "p={$value['placa']}");
                $atualiza->getResult();
                if ($atualiza->getResult()):
                    echo "<p class=\"cadastro\">Atualização realizada com sucesso</p>";
                else:
                    echo "Erro ao atualizar cadastro";
                endif;

            endif;


        endif;


        print_r($Dados);
        $i ++;

    endwhile;
    
     endif;

    echo "<hr>";
}

echo $verifica->getRowCount();
?>
