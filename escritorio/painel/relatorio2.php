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


        echo "Roubo/Furto R$0.000,00 a R$40.000,00 >>

Descrição Monitoramento R$49,00 + Proteção R$40,00 >> ID 12";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel12->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 0,00";

        $valor12 = $variavel12->getRowCount() * 0.00;

        echo "</br>";

        echo "Mensalidade R$ 89.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor12, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel13 = new Read();
        $variavel13->ExeRead("prevenda", "WHERE id_plano = :p ", "p=13");
        $variavel13->getResult();


        echo "Passeio - Roubo/Furto/Assistência R$0.000,00 a R$40.000,00 

>> Monitoramento R$49,00 + Proteção R$40,00 + Assistência R$14,90 >> ID 13";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel13->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor13 = $variavel13->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 103.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor13, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel14 = new Read();
        $variavel14->ExeRead("prevenda", "WHERE id_plano = :p ", "p=14");
        $variavel14->getResult();


        echo "Passeio - Roubo/Furto/Assistencia/Colisão R$0.000,00 a R$40.000,00 

Descrição Monitoramento R$49,00 + Proteção R$50,00 + Assistência R$14,90  >> ID 14";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel14->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor14 = $variavel14->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 113.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor14, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel15 = new Read();
        $variavel15->ExeRead("prevenda", "WHERE id_plano = :p ", "p=15");
        $variavel15->getResult();


        echo "Utilitário - Roubo/Furto/Assistencia/Colisão R$0.000,00 a R$40.000,00 

Descrição Monitoramento R$49,00 + Proteção R$50,00 + Assistência R$24,90   >> ID 15";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel15->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor15 = $variavel15->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 123.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor15, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel16 = new Read();
        $variavel16->ExeRead("prevenda", "WHERE id_plano = :p ", "p=16");
        $variavel16->getResult();


        echo "Passeio - Roubo/Furto R$40.001,00 a R$50.000,00 

Descrição Monitoramento R$49,00 + Proteção R$64,90  >> ID 16";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel16->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 0,00";

        $valor16 = $variavel16->getRowCount() * 0.00;

        echo "</br>";

        echo "Mensalidade R$ 113.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor16, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel17 = new Read();
        $variavel17->ExeRead("prevenda", "WHERE id_plano = :p ", "p=17");
        $variavel17->getResult();


        echo "Passeio - Roubo/Furto/Assistencia R$40.001,00 a R$50.000,00 

Descrição Monitoramento R$49,00 + Proteção R$55,00 + Assistência R$14,90  >> ID 17";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel17->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor17 = $variavel17->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 118.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor17, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel19 = new Read();
        $variavel19->ExeRead("prevenda", "WHERE id_plano = :p ", "p=19");
        $variavel19->getResult();


        echo " Passeio - Roubo/Furto/Assistencia/Colisão R$40.001,00 a R$50.000,00 

Descrição Monitoramento R$49,00 + Proteção R$85,00 + Assistência R$14,90 

ID 19  >>

Valor R$ 148.90   >> ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel19->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor19 = $variavel19->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 148.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor19, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel20 = new Read();
        $variavel20->ExeRead("prevenda", "WHERE id_plano = :p ", "p=20");
        $variavel20->getResult();


        echo " Utilitário - Roubo/Furto/Assistencia/Colisão R$40.001,00 a R$50.000,00 

Descrição Monitoramento R$49,00 + Proteção R$95,00 + Assistência R$24,90 

>> ID 20 

>> Valor R$ 158.90 
 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel20->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor20 = $variavel20->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 158.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor20, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel21 = new Read();
        $variavel21->ExeRead("prevenda", "WHERE id_plano = :p ", "p=21");
        $variavel21->getResult();


        echo " Plano Passeio - Roubo/Furto R$50.001,00 a R$70.000,00 

Descrição Monitoramento R$49,00 + Proteção R$80,00 

>> ID 21 

>> Valor R$ 129.00 
 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel21->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 0,00";

        $valor21 = $variavel21->getRowCount() * 0.00;

        echo "</br>";

        echo "Mensalidade R$ 129.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor21, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel22 = new Read();
        $variavel22->ExeRead("prevenda", "WHERE id_plano = :p ", "p=22");
        $variavel22->getResult();


        echo " Passeio - Roubo/Furto/Assistencia R$50.001,00 a R$70.000,00 

Descrição Monitoramento R$49,00 + Proteção R$79,10 + Assistência R$14,90 

>> ID 22 

>> Valor R$ 143.00 
 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel22->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor22 = $variavel22->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 143.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor22, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel23 = new Read();
        $variavel23->ExeRead("prevenda", "WHERE id_plano = :p ", "p=23");
        $variavel23->getResult();


        echo " Passeio - Roubo/Furto/Assistencia/Colisão R$50.001,00 a R$70.000,00 

Descrição Monitoramento R$49,00 + Proteção R$115,00 + Assistência R$14,90 

>> ID 23 

>> Valor R$ 178.90 
 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel23->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor23 = $variavel23->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 178.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor23, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel24 = new Read();
        $variavel24->ExeRead("prevenda", "WHERE id_plano = :p ", "p=24");
        $variavel24->getResult();


        echo " Utilitário - Roubo/Furto/Assistencia/Colisão R$50.001,00 a R$70.000,00 

Descrição Monitoramento R$49,00 + Proteção R$115,00 + Assistência R$24,90 

ID 24 

Valor R$ 188.90 
 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel24->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor24 = $variavel24->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 188.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor24, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel26 = new Read();
        $variavel26->ExeRead("prevenda", "WHERE id_plano = :p ", "p=26");
        $variavel26->getResult();


        echo "Passeio - Roubo/Furto R$70.001,00 a R$90.000,00 

Descrição Monitoramento R$49,00 + Proteção R$58,00 

>> ID 26 

>> Valor R$ 135.00 

 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel26->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 26hs R$ 0,00";

        $valor26 = $variavel26->getRowCount() * 0.00;

        echo "</br>";

        echo "Mensalidade R$ 135.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor26, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel27 = new Read();
        $variavel27->ExeRead("prevenda", "WHERE id_plano = :p ", "p=27");
        $variavel27->getResult();


        echo "Passeio - Roubo/Furto R$70.001,00 a R$90.000,00 

Descrição Monitoramento R$49,00 + Proteção R$58,00 

>> ID 27 

>> Valor R$ 135.00 

 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel27->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 27hs R$ 0,00";

        $valor27 = $variavel27->getRowCount() * 0.00;

        echo "</br>";

        echo "Mensalidade R$ 135.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor27, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel28 = new Read();
        $variavel28->ExeRead("prevenda", "WHERE id_plano = :p ", "p=28");
        $variavel28->getResult();


        echo "Plano Passeio - Roubo/Furto/Assistencia/Colisão R$70.001,00 a R$90.000,00 

Descrição Monitoramento R$49,00 + Proteção R$121,00 + Assistência R$14,90 

>> ID 28 

>> Valor R$ 184.90 

 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel28->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 28hs R$ 14,90";

        $valor28 = $variavel28->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 184.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor28, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel29 = new Read();
        $variavel29->ExeRead("prevenda", "WHERE id_plano = :p ", "p=29");
        $variavel29->getResult();


        echo "Plano Utilitário - Roubo/Furto/Assistencia/Colisão R$70.001,00 a R$90.000,00 

Descrição Monitoramento R$49,00 + Proteção R$121,00 + Assistência R$24,90 

>> ID 29 

>> Valor R$ 194.90 

 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel29->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 29hs R$ 24,90";

        $valor29 = $variavel29->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 194.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor29, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel30 = new Read();
        $variavel30->ExeRead("prevenda", "WHERE id_plano = :p ", "p=30");
        $variavel30->getResult();


        echo "Plano Passeio - Roubo/Furto R$90.001,00 a R$120.000,00 

Descrição Monitoramento R$49,00 + Proteção R$119,00 

>> ID 30 

>> Valor R$ 168.00 

 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel30->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 30hs R$ 0,00";

        $valor30 = $variavel30->getRowCount() * 0.00;

        echo "</br>";

        echo "Mensalidade R$ 168.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor30, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel31 = new Read();
        $variavel31->ExeRead("prevenda", "WHERE id_plano = :p ", "p=31");
        $variavel31->getResult();


        echo "Plano Passeio - Roubo/Furto/Assistencia R$90.001,00 a R$120.000,00 

Descrição Monitoramento R$49,00 + Proteção R$109,00 + Assistência R$14,90 

>> ID 31 

>> Valor R$ 172.90 


 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel31->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 31hs R$ 0,00";

        $valor31 = $variavel31->getRowCount() * 0.00;

        echo "</br>";

        echo "Mensalidade R$ 168.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor31, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel32 = new Read();
        $variavel32->ExeRead("prevenda", "WHERE id_plano = :p ", "p=32");
        $variavel32->getResult();


        echo "Plano Passeio - Roubo/Furto/Assistencia/Colisão R$90.001,00 a R$120.000,00 

Descrição Monitoramento R$49,00 + Proteção R$149,00 + Assistência R$14,90 

>> ID 32 

>> Valor R$ 212.90 



 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel32->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 32hs R$ 14,90";

        $valor32 = $variavel32->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 212.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor32, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel33 = new Read();
        $variavel33->ExeRead("prevenda", "WHERE id_plano = :p ", "p=33");
        $variavel33->getResult();


        echo "Plano Utilitário - Roubo/Furto/Assistencia/Colisão R$90.001,00 a R$120.000,00 

Descrição Monitoramento R$49,00 + Proteção R$163,90 + Assistência R$24,90 

>> ID 33 

>> Valor R$ 237.80 




 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel33->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 33hs R$ 24,90";

        $valor33 = $variavel33->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 237.80";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor33, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel34 = new Read();
        $variavel34->ExeRead("prevenda", "WHERE id_plano = :p ", "p=34");
        $variavel34->getResult();


        echo "Plano Utilitário - Roubo/Furto/Assistencia/Colisão R$90.001,00 a R$120.000,00 

Descrição Monitoramento R$49,00 + Proteção R$163,90 + Assistência R$24,90 

>> ID 34 

>> Valor R$ 237.80 




 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel34->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor34 = $variavel34->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 237.80";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor34, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel35 = new Read();
        $variavel35->ExeRead("prevenda", "WHERE id_plano = :p ", "p=35");
        $variavel35->getResult();


        echo "Plano Passeio - Roubo/Furto/Assistencia R$120.001,00 a R$150.000,00 

Descrição Monitoramento R$49,00 + Proteção R$178,00 + Assistência R$14,90 

>> ID 35 

>> Valor R$ 241.90 





 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel35->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor35 = $variavel35->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 241.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor35, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel36 = new Read();
        $variavel36->ExeRead("prevenda", "WHERE id_plano = :p ", "p=36");
        $variavel36->getResult();


        echo "Plano Passeio - Roubo/Furto/Assistencia/Colisão R$120.001,00 a R$150.000,00 

Descrição Monitoramento R$49,00 + Proteção R$223,00 + Assistência R$14,90 

>> ID 36 

>> Valor R$ 286.90 





 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel36->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor36 = $variavel36->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 286.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor36, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel37 = new Read();
        $variavel37->ExeRead("prevenda", "WHERE id_plano = :p ", "p=37");
        $variavel37->getResult();


        echo "Plano Utilitário - Roubo/Furto/Assistencia/Colisão R$120.001,00 a R$150.000,00 

Descrição Monitoramento R$49,00 + Proteção R$237,90 + Assistência R$24,90 

>> ID 37 

>> Valor R$ 311.00 






 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel37->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor37 = $variavel37->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 311.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor37, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel47 = new Read();
        $variavel47->ExeRead("prevenda", "WHERE id_plano = :p ", "p=47");
        $variavel47->getResult();


        echo "Plano Passeio - Roubo/Furto/Assistencia/Colisão R$0.001,00 a R$40.000,00 

Descrição Monitoramento R$49,00 + Proteção R$45,90 + Assistência R$14,90 

>> ID 47 

>> Valor R$ 109.00 





 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel47->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor47 = $variavel47->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 109.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor47, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel49 = new Read();
        $variavel49->ExeRead("prevenda", "WHERE id_plano = :p ", "p=49");
        $variavel49->getResult();


        echo "Plano Passeio - Roubo/Furto/Assistencia/Colisão R$0.001,00 a R$40.000,00 

Descrição Monitoramento R$49,00 + Proteção R$64,90 + Assistência R$14,90 

>> ID 49 

>> Valor R$ 128.80 





 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel49->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor49 = $variavel49->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 128.80";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor49, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel50 = new Read();
        $variavel50->ExeRead("prevenda", "WHERE id_plano = :p ", "p=50");
        $variavel50->getResult();


        echo "Plano Passeio - Proteção R$40.001,00 a R$50.000,00 

Descrição Monitoramento R$49,00 + Proteção R$72,60 + Assistêcia 24hs R$14,90 

>> ID 50 

>> Valor R$ 136.50 






 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel50->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor50 = $variavel50->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 136.50";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor50, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel51 = new Read();
        $variavel51->ExeRead("prevenda", "WHERE id_plano = :p ", "p=51");
        $variavel51->getResult();


        echo "Plano Utilitário - Roubo/Furto/Assistencia/Colisão 

Descrição Monitoramento R$49,00 + Proteção R$64,90 + Assistência R$24,90 

>> ID 51 

>> Valor R$ 138.80 


 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel51->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor51 = $variavel51->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 138.80";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor51, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel52 = new Read();
        $variavel52->ExeRead("prevenda", "WHERE id_plano = :p ", "p=52");
        $variavel52->getResult();


        echo "Plano Utilitário - Roubo/Furto/Assistencia/Colisão 

Descrição Monitoramento R$49,00 + Proteção R$129,90 + Assistência R$24,90 

>> ID 52 

>> Valor R$ 203.80 



 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel52->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor52 = $variavel52->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 138.80";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor52, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel53 = new Read();
        $variavel53->ExeRead("prevenda", "WHERE id_plano = :p ", "p=53");
        $variavel53->getResult();


        echo "Plano Utilitário - Roubo/Furto/Assistencia/Colisão 

Descrição Monitoramento R$49,00 + Proteção R$135,90 + Assistência R$24,90 

>> ID 53 

>> Valor R$ 209.80 



 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel53->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor53 = $variavel53->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 209.80";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor53, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel55 = new Read();
        $variavel55->ExeRead("prevenda", "WHERE id_plano = :p ", "p=55");
        $variavel55->getResult();


        echo "Plano Utilitário - Roubo/Furto 

Descrição Monitoramento R$49,00 + Proteção R$74,10 + Assistência R$24,90 

>> ID 55 

>> Valor R$ 148.00 



 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel55->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor55 = $variavel55->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 148.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor55, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel56 = new Read();
        $variavel56->ExeRead("prevenda", "WHERE id_plano = :p ", "p=56");
        $variavel56->getResult();


        echo "Plano Passeio - Roubo/Furto/Assistencia/Colisão R$0.001,00 a R$40.000,00 

Descrição Monitoramento R$49,00 + Proteção R$65,90 

>> ID 56 

>> Valor R$ 114.90 



 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel56->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 14,90";

        $valor56 = $variavel56->getRowCount() * 14.90;

        echo "</br>";

        echo "Mensalidade R$ 114.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor56, 2, ",", ".") . "</b>";

        echo "<hr>";


        $variavel57 = new Read();
        $variavel57->ExeRead("prevenda", "WHERE id_plano = :p ", "p=57");
        $variavel57->getResult();


        echo "Plano PLANO ROUBO + FURTO + ASSISTÊCIA 24HS 

Descrição Monitoramento R$49,00 + Proteção R$149,00 + Assistência R$24,90 

>> ID 57 

>> Valor R$ 222.90 



 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel57->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 24,90";

        $valor57 = $variavel57->getRowCount() * 24.90;

        echo "</br>";

        echo "Mensalidade R$ 222.90";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor57, 2, ",", ".") . "</b>";

        echo "<hr>";

        $variavel58 = new Read();
        $variavel58->ExeRead("prevenda", "WHERE id_plano = :p ", "p=58");
        $variavel58->getResult();


        echo " Plano PLANO ROUBO + FURTO +ASSISTENCIA 24HS 

Descrição Monitoramento R$49,00 + Proteção R$99,00 + Assistência R$ 65,00 

>> ID 58 

>> Valor R$ 164.00 



 ";

        echo "<br>";

        echo "Total de usuários <b>" . $variavel58->getRowCount() . "</b>";

        echo "<br>";

        echo "Assistencia 24hs R$ 65,00";

        $valor58 = $variavel58->getRowCount() * 65.00;

        echo "</br>";

        echo "Mensalidade R$ 164.00";

        echo "</br>";

        echo "Arrecadação total Assistência R$ <b>" . number_format($valor58, 2, ",", ".") . "</b>";

        echo "<hr>";

        $total = $valor12 + $valor13 + $valor14 + $valor15 + $valor16 + $valor17 + $valor19 + $valor20 + $valor21 + $valor22 + $valor23 + $valor24 + $valor26 + $valor27 + $valor28 + $valor29 + $valor30 + $valor31 + $valor32 + $valor33 + $valor34 + $valor35 + $valor36 + $valor37 + $valor47 + $valor49 + $valor50 + $valor51 + $valor52 + $valor53 + $valor55 + $valor56 + $valor57 + $valor58;

        echo "<h1> Assistência 24hs Arrecadação R$ " . number_format($total, 2, ",", ".") . "</h1>";
        ?>
    </body>
</html>
