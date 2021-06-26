<?php

session_start();
require('../_app/Config.inc.php');



$verifica = new Read();
$verifica->ExeRead("prevendaacasp", "WHERE verificado = :p", "p=1");
$verifica->getResult();

foreach ($verifica->getResult() as $value) {
    
        if (empty($value['placa1'])):

        $Arr = [
            "verificado" => 2
        ];

        $atualiza = new Update();
        $atualiza->ExeUpdate("prevendaacasp", $Arr, "WHERE placa1= :p", "p={$value['placa1']}");
        $atualiza->getResult();
        if ($atualiza->getResult()):
            echo "<p class=\"cadastro\">Atualização realizada com sucesso</p>";
        else:
            echo "Erro ao atualizar cadastro";
        endif;
        
        else:



    echo "Placa : " . $value['placa1'];
    echo "</br>";
    echo "Adesão : " . $value['data'];
    echo "</br>";
    echo "Plano : " . $value['mesacasp'];
    echo "</br>";
    echo "Assistencia : " . $value['assist'];
    echo "</br>";
    
    $mensalidade = $value['mesacasp'] + $value['assist'];
    
        echo "Mes Acasp : " . $mensalidade;
    echo "</br>";

    //  echo "</br>";
//
    //   echo "</br>";
    $valor = $mensalidade;
    $valor = str_replace(".", "", $valor); // Primeiro tira os pontos
    $valor = str_replace(",", "", $valor); // Depois tira a vírgula




    $i = 1;
    while ($i <= 12):

        $Date = $value['data'];

        $explodir = explode("-", $Date);

        $dia = 15;

        $DataBase = $explodir['0'] . $explodir['1'] . $dia;

        $vencimentos = date("Y-m-d", strtotime($DataBase . " + {$i} month"));

        $Dados = [
            "documento" => $value['placa1'],
            "parcela" => $i,
            "emissao" => $DataBase,
            "vencimento" => $vencimentos,
            "valor" => $valor,
            "status" => 1,
            "tipo" => 1
        ];

        $cadastra = new Create();
        $cadastra->ExeCreate("boletoscaixa", $Dados);
        $cadastra->getResult();

        if ($cadastra->getResult()):

            echo "<b>cobrança {$i} Placa {$value['placa1']} cadastrada com sucesso</b> </br>";

            if ($i >= 12):

                $Arr = [
                    "verificado" => 2
                ];

                $atualiza = new Update();
                $atualiza->ExeUpdate("prevendaacasp", $Arr, "WHERE placa1= :p", "p={$value['placa1']}");
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

echo "Total de cadastros" . $verifica->getRowCount();
?>
