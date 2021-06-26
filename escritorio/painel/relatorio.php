<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require('../_app/Config.inc.php');

        $variavel12 = new Read();
        $variavel12->ExeRead("prevenda", "WHERE id_plano = :p ", "p=12");
        $variavel12->getResult();


        echo "Quantidade de usuario de 00.000,00 a 40.000,00 assistencia R$0,00 >> ID 12";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel12->getRowCount() . "</b>";

        $valor12 = $variavel12->getRowCount() * 0.00;

        echo "</br>";

        echo "Mensalidade R$ 89.00";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor12, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel13 = new Read();
        $variavel13->ExeRead("prevenda", "WHERE id_plano = :p ", "p=13");
        $variavel13->getResult();


        echo "Quantidade de usuario de 00.000,00 a 40.000,00 assistencia R$14,90 >> ID 13";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel13->getRowCount() . "</b>";

        $valor13 = $variavel13->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 103.90";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor13, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel14 = new Read();
        $variavel14->ExeRead("prevenda", "WHERE id_plano = :p ", "p=14");
        $variavel14->getResult();


        echo "Quantidade de usuario de 00.000,00 a 40.000,00 assistencia R$14,90 >> ID 14";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel14->getRowCount() . "</b>";

        $valor14 = $variavel14->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 113.90";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor14, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel15 = new Read();
        $variavel15->ExeRead("prevenda", "WHERE id_plano = :p ", "p=15");
        $variavel15->getResult();


        echo "Quantidade de usuario de 00.000,00 a 40.000,00 assistencia R$24,90 >>";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel15->getRowCount() . "</b>";

        $valor15 = $variavel15->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 113.90";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor15, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel19 = new Read();
        $variavel19->ExeRead("prevenda", "WHERE id_plano = :p ", "p=19");
        $variavel19->getResult();


        echo "Quantidade de usuario de 40.000,00 a 50.000,00 assistencia R$14,90 >> ID 19";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel19->getRowCount() . "</b>";

        $valor19 = $variavel19->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 148.90";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor19, 2, ",", ".") . "</b>";

        echo "<hr>";
        
        $variavel20 = new Read();
        $variavel20->ExeRead("prevenda", "WHERE id_plano = :p ", "p=20");
        $variavel20->getResult();


        echo "Quantidade de usuario de 40.000,00 a 50.000,00 assistencia R$24,90 >> ID 20";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel20->getRowCount() . "</b>";

        $valor20 = $variavel20->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 158.90";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor20, 2, ",", ".") . "</b>";

        echo "<hr>";
        

        
        $variavel23 = new Read();
        $variavel23->ExeRead("prevenda", "WHERE id_plano = :p ", "p=23");
        $variavel23->getResult();


        echo "Quantidade de usuario de 50.000,00 a 70.000,00 assistencia R$14,90 >> ID 23";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel23->getRowCount() . "</b>";

        $valor23 = $variavel23->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 178.90";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor23, 2, ",", ".") . "</b>";

        echo "<hr>";
        
        $variavel24 = new Read();
        $variavel24->ExeRead("prevenda", "WHERE id_plano = :p ", "p=24");
        $variavel24->getResult();


        echo "Quantidade de usuario de 50.000,00 a 70.000,00 assistencia R$24,90 >> ID 24";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel24->getRowCount() . "</b>";

        $valor24 = $variavel24->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 178.90";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor24, 2, ",", ".") . "</b>";

        echo "<hr>";
        
        $variavel27 = new Read();
        $variavel27->ExeRead("prevenda", "WHERE id_plano = :p ", "p=27");
        $variavel27->getResult();


        echo "Quantidade de usuario de 70.000,00 a 90.000,00 assistencia R$14,90 >> ID 27";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel27->getRowCount() . "</b>";

        $valor27 = $variavel27->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 149.90";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor27, 2, ",", ".") . "</b>";

        echo "<hr>";
        
        $variavel28 = new Read();
        $variavel28->ExeRead("prevenda", "WHERE id_plano = :p ", "p=28");
        $variavel28->getResult();


        echo "Quantidade de usuario de 70.000,00 a 90.000,00 assistencia R$14,90 >> ID 28";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel28->getRowCount() . "</b>";

        $valor28 = $variavel28->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 184.90";

        echo "</br>";

        echo "Arrecadação total R$ <b>" . number_format($valor28, 2, ",", ".") . "</b>";

        echo "<hr>";
        ?>
    </body>
</html>
