<?php

namespace Source\Core;

class Remessa {

    public function __construct() {

        $datahoje = date("Y-m-d");
        $dia = date("d");
        $mes = date("m");
        $ano = date("Y");
        $exibeano = substr($ano, 2);
        
        $readLote = new \Source\Models\Read();
        $readLote->ExeRead("app_remessa", "ORDER BY id DESC");
        $readLote->getResult();
        //$lote = 0;
        $lote = $readLote->getResult()[0]["lote"] + 1;
        
       $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
       $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

        //aqui gera header do arquivo *******************************************
        //Código do Banco na Compensação 3 posição final 3
        $h1 = "033";
        $h1 = str_pad($h1, 3, "0", STR_PAD_LEFT);
//        //Lote de Serviço 4 posição final 7
        $h2 = $lote;
        $h2 = str_pad($h2, 4, "0", STR_PAD_LEFT);
//       008 - 008 Tipo de registro N 001 0
        $h3 = "0";
        $h3 = str_pad($h3, 1, "0", STR_PAD_LEFT);
//        009 - 016 Reservado (uso Banco) A 008 Brancos
        $h4 = " ";
        $h4 = str_pad($h4, 8, " ", STR_PAD_LEFT);
//        //Tipo de Inscrição da Empresa 18 18 1 - Num *G005
        $h5 = "2";
        $h5 = str_pad($h5, 1, "0", STR_PAD_LEFT);
//       018 – 032 Nº de inscrição da empresa N 015 
        $h6 = "036726851000163";
        $h6 = str_pad($h6, 15, "0", STR_PAD_LEFT);
//      033 – 047 Código de Transmissão N 015 
        $h7 = "221900003801004";
        $h7 = str_pad($h7, 15, "0", STR_PAD_LEFT);
//      048 - 072 Reservado (uso Banco) A 025 Brancos 
        $h8 = " ";
        $h8 = str_pad($h8, 25, " ", STR_PAD_LEFT);
//       073 - 102 Nome da empresa A 030 
        $h9 = "HGM PROTECAO E RECUPERACAO DE";
        $h9 = str_pad($h9, 30, " ", STR_PAD_LEFT);
//      103 - 132 Nome do Banco A 030
        $h10 = "BANCO SANTANDER";
        $h10 = str_pad($h10, 30, " ", STR_PAD_LEFT);
//      133 - 142 Reservado (uso Banco) A 010 Brancos 
        $h11 = " ";
        $h11 = str_pad($h11, 10, " ", STR_PAD_LEFT);
//      143 - 143 Código remessa N 001 1 = Remessa
        $h12 = "1";
        $h12 = str_pad($h12, 1, "0", STR_PAD_LEFT);
//     144 - 151 Data de geração do arquivo N 008 
        $h13 = date("dmY");
        $h13 = str_pad($h13, 8, " ", STR_PAD_LEFT);
//     152 - 157 Reservado (uso Banco) A 006 Brancos 
        $h14 = " ";
        $h14 = str_pad($h14, 6, " ", STR_PAD_LEFT);
//    158 - 163 Nº seqüencial do arquivo N 006 
        $h15 = $lote;
        $h15 = str_pad($h15, 6, "0", STR_PAD_LEFT);
//     164 - 166 Nº da versão do layout do arquivo N 003 040 
        $h16 = "040";
        $h16 = str_pad($h16, 3, "0", STR_PAD_LEFT);
//     167 - 240 Reservado (uso Banco) A 074 Brancos 
        $h17 = " ";
        $h17 = str_pad($h17, 74, " ", STR_PAD_LEFT);

echo "Header".$header = $h1.$h2.$h3.$h4.$h5.$h6.$h7.$h8.$h9.$h10.$h11.$h12.$h13.$h14.$h15.$h16.$h17."\n";

        echo "</br>Quantidade caracteres Header : " . $contardois = strlen($header) . "</br>";
//
//
//
//        // aqui gera arquivo de lote *************************************
//       001 - 003 Código do Banco na compensação N 003 033 
        $hl_1 = "033";
        $h1_1 = str_pad($hl_1, 3, "0", STR_PAD_LEFT);
//      004 - 007 Numero do lote remessa N 004
        $hl_2 = $lote;
        $hl_2 = str_pad($hl_2, 4, "0", STR_PAD_LEFT);
//      008 - 008 Tipo de registro N 001 1 
        $hl_3 = "1";
        $hl_3 = str_pad($hl_3, 1, "0", STR_PAD_LEFT);
//      009 - 009 Tipo de operação A 001 R (Remessa) 
        $h1_4 = "R";
        $h1_4 = str_pad($h1_4, 1, "R", STR_PAD_LEFT);
//      010 - 011 Tipo de serviço N 002 
        $hl_5 = "01";
        $hl_5 = str_pad($hl_5, 2, "0", STR_PAD_LEFT);
//      012 - 013 Reservado (uso Banco) A 002 Brancos
        $hl_6 = " ";
        $hl_6 = str_pad($hl_6, 2, " ", STR_PAD_LEFT);
//      014 - 016 Nº da versão do layout do lote N 003 030 
        $hl_7 = "030";
        $hl_7 = str_pad($hl_7, 3, "0", STR_PAD_LEFT);
//     017 - 017 Reservado (uso Banco) A 001 
        $hl_8 = " ";
        $hl_8 = str_pad($hl_8, 1, " ", STR_PAD_LEFT);
//      018 - 018 Tipo de inscrição da empresa N 001 
        $hl_9 = "2";
        $hl_9 = str_pad($hl_9, 1, "0", STR_PAD_LEFT);
//       019 - 033 Nº de inscrição da empresa N 015 
        $hl_10 = "36726851000163";
        $hl_10 = str_pad($hl_10, 15, "0", STR_PAD_LEFT);
//      034 – 053 Reservado (uso Banco) A 020 Brancos 
        $hl_11 = " ";
        $hl_11 = str_pad($hl_11, 20, " ", STR_PAD_LEFT);
//       054 - 068 Código de Transmissão N 015 
        $hl_12 = "221900003801004";
        $hl_12 = str_pad($hl_12, 15, "0", STR_PAD_LEFT);
//      069 – 073 Reservado uso Banco A 005 Brancos 
        $hl_13 = " ";
        $hl_13 = str_pad($hl_13, 5, " ", STR_PAD_LEFT);
//     074 - 103 Nome do Beneficiário A 030 
        $hl_14 = "HGM PROTECAO E RECUPERACAO DE";
        $hl_14 = str_pad($hl_14, 30, " ", STR_PAD_LEFT);
//      104 - 143 Mensagem 1 A 040 
        $hl_15 = " ";
        $hl_15 = str_pad($hl_15, 40, " ", STR_PAD_LEFT);
//      144 - 183 Mensagem 2 A 040 
        $hl_16 = " ";
        $hl_16 = str_pad($hl_16, 40, " ", STR_PAD_LEFT);
//      184 - 191 Número remessa/retorno N 008 
        $hl_17 = $lote;
        $hl_17 = str_pad($hl_17, 8, "0", STR_PAD_LEFT);
//      192 - 199 Data da gravação remessa/retorno N 008 DDMMAAAA 
        $hl_18 = date("dmY");
        $hl_18 = str_pad($hl_18, 8, " ", STR_PAD_LEFT);
//      200 - 240 Reservado (uso Banco) A 041 
        $hl_19 = " ";
        $hl_19 = str_pad($hl_19, 41, " ", STR_PAD_LEFT);
//        //Número Remessa/Retorno 184 191 8 - Num G079
    
//
echo "Header Lote". $headerLote =$h1_1.$hl_2.$hl_3.$h1_4.$hl_5.$hl_6.$hl_7.$hl_8.$hl_9.$hl_10.$hl_11.$hl_12.$hl_13.$hl_14.$hl_15.$hl_16.$hl_17.$hl_18.$hl_19."\n";
        ;
//
echo "</br>Quantidade caracteres Header Lote : " . $contartres = strlen($headerLote) . "</br>";

        // Abre ou cria o arquivo bloco1.txt
//"a" representa que o arquivo é aberto para ser escrito
        $fp = fopen("remessa/CB{$dia}{$mes}{$exibeano}.REM", "a");

        $escreve = fwrite($fp, "{$header}{$headerLote}");

        fclose($fp);


        $agora = date("Y-m-d");

        $buscar = date('Y-m-d', strtotime("+15 days", strtotime($agora)));

        echo " Data query {$buscar}";

        //verifica as faturas a serem geradas 15 dias apos 
        $verifica = new \Source\Models\Read();
        $verifica->ExeRead("app_faturas", "WHERE repetir_em = :a", "a={$buscar}");
        $verifica->getResult();

        $i = 0;
//

         // aqui faz o registro da remessa
        $readLote = new \Source\Models\Read();
        $readLote->ExeRead("app_remessa", "ORDER BY id DESC");
        $readLote->getResult();
        
        $lote = $readLote->getResult()[0]["lote"] + 1;
        
         $Cad = [
            "remessa" => "remessa/CB{$dia}{$mes}{$exibeano}.REM",
            "data" => date("Y-m-d"),
            "lote" => $lote
        ];
        
        $cadRemessa = new \Source\Models\Create();
        $cadRemessa->ExeCreate("app_remessa", $Cad);
        
        $b = 0;
//
        foreach ($verifica->getResult() as $value) {
            $i++;
            
            $b += 2;
            $totalValor += $value["valor"];

            $vencimento = date('Y-m-d', strtotime($value["vencimento_em"]));

           // $ndata = date("Ym"); // 6 caracteres
           // $nid = $value["id"];
            $nid = str_pad($value["id"], 6, "0", STR_PAD_LEFT);
            $nid2 = str_pad($value["cliente_id"], 6, "0", STR_PAD_LEFT);
            
            $nidtotal = $nid . $nid2;
            
        $np = $b - 1 ;
        $nq =  $b ;
          echo $inverso =  strrev($nidtotal) . "</br>";
          
        echo "<i>Inverso 1 = ".  $v1 = $inverso[0] * 2 . "</i></br>";
        echo "<i>Inverso 2 = ".  $v2 = $inverso[1] * 3 . "</i></br>";
        echo "<i>Inverso 3 = ".  $v3 = $inverso[2] * 4 . "</i></br>";
        echo "<i>Inverso 4 = ".  $v4 = $inverso[3] * 5 . "</i></br>";
        echo "<i>Inverso 5 = ".  $v5 = $inverso[4] * 6 . "</i></br>";
        echo "<i>Inverso 6 = ".  $v6 = $inverso[5] * 7 . "</i></br>";
        echo "<i>Inverso 7 = ".  $v7 = $inverso[6] * 8 . "</i></br>";
        echo "<i>Inverso 8 = ".  $v8 = $inverso[7] * 9 . "</i></br>";
        echo "<i>Inverso 9 = ".  $v9 = $inverso[8] * 2 . "</i></br>";
        echo "<i>Inverso 10 = ".  $v10 = $inverso[9] * 3 . "</i></br>";
        echo "<i>Inverso 11 = ".  $v11 = $inverso[10] * 4 . "</i></br>";
        echo "<i>Inverso 12 = ".  $v12 = $inverso[11] * 5 . "</i></br>";
        
        $soma = $v1 + $v2 + $v3 + $v4 + $v5 + $v6 + $v7 + $v8 + $v9 + $v10 + $v11 + $v12 ;
        
        echo "<b>soma Total " . $soma ."</b></br>";
        
        $resto = $soma % 11;
        
        $div = 11 - $resto;
        
       
        
        echo "<b>Divide por 11 Resto é  </b>" .$resto. "</br>";
            
            $nosso = $nidtotal . $div;
            

          echo "<b>Nosso Numero é ".   $nosso . "</b></br>";
            echo "Registro Quantidade = " . $i . "</br>";

            //Segmento P
            //001 - 003 Código do Banco na compensação N 003 033 
            $p1 = "033";
            $p1 = str_pad($p1, 3, "0", STR_PAD_LEFT);
            //004 - 007 Numero do lote remessa N 004
            $p2 = $lote;
            $p2 = str_pad($p2, 4, "0", STR_PAD_LEFT);
            //008 - 008 Tipo de registro N 001
            $p3 = "3";
            $p3 = str_pad($p3, 1, "0", STR_PAD_LEFT);
           // 009 - 013 Nº seqüencial do registro de lote N 005
            $p4 = $np;
            $p4 = str_pad($p4, 5, "0", STR_PAD_LEFT);
            //014 - 014 Cód. Segmento do registro detalhe A 001 P 
            $p5 = "P";
            $p5 = str_pad($p5, 1, "P", STR_PAD_LEFT);
            //015 - 015 Reservado (uso Banco) A 001
            $p6 = " ";
            $p6 = str_pad($p6, 1, " ", STR_PAD_LEFT);
            //016 - 017 Código de movimento remessa N 002
            $p7 = "01";
            $p7 = str_pad($p7, 2, "0", STR_PAD_LEFT);
            //018 –021 Agência do Destinatária N 004
            $p8 = "2219";
            $p8 = str_pad($p8, 4, "0", STR_PAD_LEFT);
            //022 –022 Dígito da Ag do Destinatária N 001
            $p9 = "5";
            $p9 = str_pad($p9, 1, "0", STR_PAD_LEFT);
            //023 - 031 Número da conta corrente N 009
            $p10 = "013003100";
            $p10 = str_pad($p10, 9, "0", STR_PAD_LEFT);
            //032 – 032 Dígito verificador da conta N 001
            $p11 = "4";
            $p11 = str_pad($p11, 1, "0", STR_PAD_LEFT);
            //033 - 041 Conta cobrança Destinatária FIDC N 009
            $p12 = "0";
            $p12 = str_pad($p12, 9, "0", STR_PAD_LEFT);
            //042 - 042 Dígito da conta cobrança
            //Destinatária FIDC N 001
            $p13 = "0";
            $p13 = str_pad($p13, 1, "0", STR_PAD_LEFT);
            //043 - 044 Reservado (uso Banco) A 002 Brancos 
            $p14 = " ";
            $p14 = str_pad($p14, 2, " ", STR_PAD_LEFT);
            //045 –057 Identificação do título no Banco N 013
            $p15 = $nosso;
            $p15 = str_pad($p15, 13, "0", STR_PAD_LEFT);
            //058 - 058 Tipo de cobrança A 001
            $p16 = "5";
            $p16 = str_pad($p16, 1, "0", STR_PAD_LEFT);
            //059 - 059 Forma de Cadastramento N 001
            $p17 = "1";
            $p17 = str_pad($p17, 1, "0", STR_PAD_LEFT);
            //060 - 060 Tipo de documento N 001 
            $p18 = "1";
            $p18 = str_pad($p18, 1, " ", STR_PAD_LEFT);
            //061 –061 Reservado (uso Banco) A 001 
            $p19 = " ";
            $p19 = str_pad($p19, 1, " ", STR_PAD_LEFT);
            //062 - 062 Reservado (uso Banco) A 001 Brancos 
//            $p20 = date('dmY', strtotime($value["vencimento_em"]));
//            $p20 = str_pad($p20, 8, "0", STR_PAD_LEFT);
            $p20 = " ";
            $p20 = str_pad($p20, 1, " ", STR_PAD_LEFT);
            //063 - 077 Nº do documento A 015 Seu número
            $p21 = $value["id"];
            $p21 = str_pad($p21, 15, "0", STR_PAD_LEFT);
            //078 - 085 Data de vencimento do título N 008 DDMMAAAA 
            $p22 = date('dmY', strtotime($value["vencimento_em"]));
            $p22 = str_pad($p22, 8, "0", STR_PAD_LEFT);
            //086 - 100 Valor nominal do título N 015
            $p23 = $value["valor"];
            $p23 = str_pad($p23, 15, "0", STR_PAD_LEFT);
            //101 - 104 Agência encarregada da cobrança
//FIDC N 004
            $p24 = "0";
            $p24 = str_pad($p24, 4, "0", STR_PAD_LEFT);
            //105 – 105 Dígito da Agência do Beneficiário
//FIDC N 001
            $p25 = "0";
            $p25 = str_pad($p25, 1, " ", STR_PAD_LEFT);
            //106 - 106 Reservado (uso Banco) A 001
            $p26 = " ";
            $p26 = str_pad($p26, 1, " ", STR_PAD_LEFT);
            //107 – 108 Espécie do título N 002
            $p27 = "04";
            $p27 = str_pad($p27, 2, "0", STR_PAD_LEFT);
            //109 - 109 Identif. de título Aceito/Não Aceito A 001
            $p28 = "N";
            $p28 = str_pad($p28, 1, " ", STR_PAD_LEFT);
            //110 - 117 Data da emissão do título N 008 DDMMAAAA

            $p29 = date('dmY', strtotime($value["vencimento_em"]));
            $p29 = str_pad($p29, 8, "0", STR_PAD_LEFT);
            //118 - 118 Código do juros de mora N 001
            $p30 = "3";
            $p30 = str_pad($p30, 1, "0", STR_PAD_LEFT);
            //119 - 126 Data do juros de mora N 008
           // $p31 = date('dmY', strtotime($value["vencimento_em"]));
            $p31 = "0";
            $p31 = str_pad($p31, 8, "0", STR_PAD_LEFT);
            //127 - 141 Valor da mora/dia ou Taxa mensal N 015
            $p32 = "0";
            $p32 = str_pad($p32, 15, "0", STR_PAD_LEFT);
            //142 - 142 Código do desconto 1 N 001
            $p33 = "2";
            $p33 = str_pad($p33, 1, "0", STR_PAD_LEFT);
            //143 - 150 Data de desconto 1 N 008
            $p34 = date('dmY', strtotime($value["vencimento_em"]));
            $p34 = str_pad($p34, 8, "0", STR_PAD_LEFT);
            //151 - 165 Valor ou Percentual do desconto
//concedido N 015
            $p35 = "0";
            $p35 = str_pad($p35, 15, "0", STR_PAD_LEFT);
            //166 - 180 Valor do IOF a ser recolhido N 015
            $p36 = "0";
            $p36 = str_pad($p36, 15, "0", STR_PAD_LEFT);
            //181 - 195 Valor do abatimento N 015 2 
            $p37 = "0";
            $p37 = str_pad($p37, 15, "0", STR_PAD_LEFT);
            //196 - 220 Identificação do título na empresa A 025
            $p38 = $nosso;
            $p38 = str_pad($p38, 25, "0", STR_PAD_LEFT);
            //221 - 221 Código para protesto N 001
            $p39 = "3";
            $p39 = str_pad($p39, 1, " ", STR_PAD_LEFT);
            //222 - 223 Número de dias para protesto N 002
            $p40 = "0";
            $p40 = str_pad($p40, 2, "0", STR_PAD_LEFT);
            //224 - 224 Código para Baixa/Devolução N 001
            $p41 = "3";
            $p41 = str_pad($p41, 1, "0", STR_PAD_LEFT);
            //225 – 225 Reservado (uso Banco) N 001
            $p42 = "0";
            $p42 = str_pad($p42, 1, "0", STR_PAD_LEFT);
            //226 - 227 Número de dias para
//Baixa/Devolução N 002
            $p43 = "0";
            $p43 = str_pad($p43, 2, "0", STR_PAD_LEFT);
            //228 - 229 Código da moeda N 002
             $p44 = "00";
            $p44 = str_pad($p44, 2, "0", STR_PAD_LEFT);
            //230 –240 Reservado (uso Banco) A 011
              $p45 = " ";
            $p45 = str_pad($p45, 11, " ", STR_PAD_LEFT);
            


echo $p = $p1.$p2.$p3.$p4.$p5.$p6.$p7.$p8.$p9.$p10.$p11.$p12.$p13.$p14.$p15.$p16.$p17.$p18.$p19.$p20.$p21.
        $p22.$p23.$p24.$p25.$p26.$p27.$p28.$p29.$p30.$p31.$p32.$p33.$p34.$p35.$p36.$p37.$p38.$p39.$p40.$p41.$p42.$p43.$p44.$p45."\n";

            // 

            echo "</br>Quantidade caracteres Linha Segmento P : " . $contar = strlen($p) . "</br>";
      
//
//
//            //SEGMENTO Q
//            //001 - 003 Código do Banco na compensação N 003
            $q1 = "033";
            $q1 = str_pad($q1, 3, "0", STR_PAD_LEFT);
//            //004 - 007 Numero do lote remessa N 004
            $q2 = $lote;
            $q2 = str_pad($q2, 4, "0", STR_PAD_LEFT);
//            //008 - 008 Tipo de registro N 001
            $q3 = "3";
            $q3 = str_pad($q3, 1, "3", STR_PAD_LEFT);
//            //009 - 013 Nº seqüencial do registro no lote N 005
            $q4 = $nq;
            $q4 = str_pad($q4, 5, "0", STR_PAD_LEFT);
//            //014 - 014 Cód. segmento do registro detalhe A 001
            $q5 = "Q";
            $q5 = str_pad($q5, 1, "Q", STR_PAD_LEFT);
//            //015 - 015 Reservado (uso Banco) A 001
            $q6 = " ";
            $q6 = str_pad($q6, 1, " ", STR_PAD_LEFT);
//            //016 - 017 Código de movimento remessa N 002
            $q7 = "00";
            $q7 = str_pad($q7, 2, "0", STR_PAD_LEFT);
//            //018 - 018 Tipo de inscrição do Pagador N 001
            $q8 = "9";
            $q8 = str_pad($q8, 1, "0", STR_PAD_LEFT);
//            //019 - 033 Número de inscrição do Pagador N 015
            $q9 = "0";
            $q9 = str_pad($q9, 15, "0", STR_PAD_RIGHT);
//            //034 - 073 Nome Pagador A 040 
            $cliente = new \Source\Models\Read();
            $cliente->ExeRead("app_clientes", "WHERE cliente_id = :a", "a={$value["cliente_id"]}");
            $cliente->getResult();
         
            $q10 = str_replace($comAcentos, $semAcentos, $cliente->getResult()[0]["nome"]);
    
            $q10 = str_pad($q10, 40, " ", STR_PAD_RIGHT);
            
 //           echo "VAriavel q10 tem" . strlen($q10) . " caracteres </br>";
//            //074 - 113 Endereço Pagador A 040
            $enderecoCliente = new \Source\Models\Read();
            $enderecoCliente->ExeRead("app_enderecos", "WHERE cliente_id = :a", "a={$value["cliente_id"]}");
            $enderecoCliente->getResult();
//
            $q11 = $enderecoCliente->getResult()[0]["logradouro"] . " " . $enderecoCliente->getResult()[0]["numero"] ;
             $q11 = str_replace($comAcentos, $semAcentos, $q11);
            $q11 = str_pad($q11, 40, " ", STR_PAD_RIGHT);
//            
//            //114 - 128 Bairro Pagador A 015
            $q12 = trim($enderecoCliente->getResult()[0]["bairro"]);
            $q12 = str_replace($comAcentos, $semAcentos, $q12);
            $q12 = str_pad($q12, 15, " ", STR_PAD_RIGHT);
//            //129 - 133 Cep Pagador N 005 
            $cep1 = $enderecoCliente->getResult()[0]["cep"];
            $parte = substr($cep1, 0, 5);

            $q13 = $parte;
            $q13 = str_pad($q13, 5, "0", STR_PAD_RIGHT);
//            //134 - 136 Sufixo do Cep do Pagador N 003 
            $parte2 = substr($cep1,5 , 8);
            $q14 = $parte2;
            $q14 = str_pad($q14, 3, "0", STR_PAD_RIGHT);
//            //137 - 151 Cidade do Pagador A 015
            $q15 = $enderecoCliente->getResult()[0]["cidade"];
            $q15 = str_replace($comAcentos, $semAcentos, $q15);
            $q15 = str_pad($q15, 15, "0", STR_PAD_RIGHT);
//            //152 - 153 Unidade da Federação do Pagador A 002
            $q16 = $enderecoCliente->getResult()[0]["uf"];
            $q16 = str_pad($q16, 2," ", STR_PAD_RIGHT);
//            //154 - 154 Tipo de inscrição Sacador/avalista N 001
            $q17 = "0";
            $q17 = str_pad($q17, 1,"0",STR_PAD_LEFT);
//            //155 - 169 Nº de inscrição Sacador/avalista N 015
            $q18 = "0";
            $q18 = str_pad($q18, 15,"0", STR_PAD_LEFT);
//            //170 - 209 Nome do Sacador/avalista A 040
            $q19 = " ";
            $q19 = str_pad($q19, 40, " ", STR_PAD_LEFT);
//            //210 –212 Identificador de carne N 003
            $q20 = "0";
            $q20 = str_pad($q20, 3, "0", STR_PAD_LEFT);
//            //213 –215 Seqüencial da Parcela ou número
//inicial da parcela N 003 
            $q21 = $value["js_parcelas"];
            $q21 = str_pad($q21, 3, " ", STR_PAD_LEFT);
//            //216 –218 Quantidade total de parcelas N 003
            $q22 = "0";
            $q22 = str_pad($q22, 3, "0", STR_PAD_LEFT);
            //219 – 221 Número do plano N 003
            //
             $q23 = "1";
            $q23 = str_pad($q23, 3, "0", STR_PAD_LEFT);
            //222 - 240 Reservado (uso Banco) A 019 Brancos 
            $q24 = " ";
            $q24 = str_pad($q24, 19, " ", STR_PAD_LEFT);
//
  echo $q = $q1.$q2.$q3.$q4.$q5.$q6.$q7.$q8.$q9.$q10.$q11.$q12.$q13.$q14.$q15.$q16.$q17.$q18.$q19.$q20.$q21.$q22.$q23.$q24."\n";
//
//            // 
//
           echo "</br>Quantidade caracteres Linha Segmento Q : " . $contar = strlen($q) . "</br>";
//            
//            //Segmento R
//        //Código do Banco na Compensação 1 3 3 - Num G001
//        $r1 = "033";
//        $r1 = str_pad($r1, 3, "0", STR_PAD_LEFT);
//        //Lote de Serviço 4 7 4 - Num *G002
//        $r2 = $lote;
//        $r2 = str_pad($r2, 4, "0", STR_PAD_LEFT);
//        //Tipo de Registro 8 8 1 - Num ‘3’ *G003
//        $r3 = "3";
//        $r3 = str_pad($r3,1,"0",STR_PAD_LEFT);
//        //Nº Sequencial do Registro no Lote 9 13 5 - Num *G038
//        $r4 = $i;
//        $r4 = str_pad($r4,5,"0", STR_PAD_LEFT);
//        //Cód. Segmento do Registro Detalhe 14 14 1 - Alfa ‘R’ *G039
//        $r5 = "R";
//        $r5 = str_pad($r5, 1, " ", STR_PAD_LEFT);
//        //Uso Exclusivo FEBRABAN/CNAB 15 15 1 - Alfa Brancos G004
//        $r6 = " ";
//        $r6 = str_pad($r6,1," ", STR_PAD_LEFT);
//        //Código de Movimento Remessa 16 17 2 - Num *C004
//        $r7 = "2";
//        $r7 = str_pad($r7, 2, "0",STR_PAD_LEFT);
//        //Código do Desconto 2 18 18 1 - Num *C021
//        $r8 = "3";
//        $r8 = str_pad($r8,1,"0",STR_PAD_LEFT);
//        //Data do Desconto 2 19 26 8 - Num C022
//        $r9 = date("dmY");
//        $r9 = str_pad($r9, 8, "0", STR_PAD_LEFT);
//        //Valor/Percentual a ser Concedido 27 41 13 2/5 Num C023
//        $r10 = "0";
//        $r10 = str_pad($r10, 15, "0", STR_PAD_LEFT);
//        //Código do Desconto 3 42 42 1 - Num *C021
//        $r11 = "1";
//        $r11 = str_pad($r11,1, "0", STR_PAD_LEFT);
//        //Data do Desconto 3 43 50 8 - Num C022
//         $r12 = date("dmY");
//        $r12 = str_pad($r12, 8, "0", STR_PAD_LEFT);
//        //Desconto 3 Valor/Percentual a Ser Concedido 51 65 13 2/5 Num Brancos C023
//        $r13 = "10";
//        $r13 = str_pad($r13, 15, "0", STR_PAD_LEFT);
//        //Código da Multa 66 66 1 - Alfa G073
//        $r14 = "2";
//        $r14 = str_pad($r14, 1, "0", STR_PAD_LEFT);
//        //Data da Multa 67 74 8 - Num G074
//        $r15 = date("dmY");
//        $r15 = str_pad($r15, 8,"0", STR_PAD_LEFT);
//        //Valor/Percentual a Ser Aplicado 75 89 13 2/5 Num G075
//        $r16 = "10";
//        $r16 = str_pad($r16, 15, "0", STR_PAD_LEFT);
//        //Informação ao Pagador 90 99 10 - Alfa *C036
//        $r17 = " ";
//        $r17 = str_pad($r17, 10, " ", STR_PAD_LEFT);
//        //Mensagem 3 100 139 40 - Alfa *C037
//        $r18 = " ";
//        $r18= str_pad($r18, 40, " ", STR_PAD_LEFT);
//        //Mensagem 4 140 179 40 - Alfa *C037
//        $r19 = " ";
//        $r19 = str_pad($r19, 40," ", STR_PAD_LEFT);
//        //Uso Exclusivo FEBRABAN/CNAB 180 199 20 - Alfa Brancos G004
//        $r20 = " ";
//        $r20 = str_pad($r20, 20, " ", STR_PAD_LEFT);
//       //Cód. Ocor. do Pagador 200 207 8 - Num *C038
//        $r21 = "3";
//        $r21 = str_pad($r21, 8,"0", STR_PAD_LEFT);
//        //Cód. do Banco na Conta do Débito 208 210 3 - Num G001
//        $r22 = "000";
//        $r22 = str_pad($r22, 3,"0", STR_PAD_LEFT);
//        //Código da Agência do Débito 211 215 5 - Num *G008
//        $r23 = "00399";
//        $r23 = str_pad($r23, 5, "0", STR_PAD_LEFT);
//        //Dígito Verificador da Agência 216 216 1 - Alfa *G009
//        $r24 = "9";
//        $r24 = str_pad($r24, 1, "0", STR_PAD_LEFT);
//        //Conta Corrente para Débito 217 228 12 - Num *G010
//        $r25 = "130031004";
//        $r25 = str_pad($r25, 12, "0", STR_PAD_LEFT);
//        //Dígito Verificador da Conta 229 229 1 - Alfa *G011
//        $r26 = "7";
//        $r26 = str_pad($r26,1,"0", STR_PAD_LEFT);
//        //Dígito Verificador Ag/Conta 230 230 1 - Alfa *G012
//        $r27 = " ";
//        $r27 = str_pad($r27, 1, " ", STR_PAD_LEFT);
//        //Aviso para Débito Automático 231 231 1 - Num *C039
//        $r28 = "1";
//        $r28 = str_pad($r28, 1, "0", STR_PAD_LEFT);
//        //Uso Exclusivo FEBRABAN/CNAB 232 240 9 - Alfa Brancos G004
//        $r29 = " ";
//        $r29 = str_pad($r29, 9, " ", STR_PAD_LEFT);
//        
//        
//       echo $r = $r1.$r2.$r3.$r4.$r5.$r6.$r7.$r8.$r9.$r10.$r11.$r12.$r13.$r14.$r15.$r16.$r17.$r18.$r19.$r20.$r21.$r22.$r23.$r24.$r25.$r26.$r27.$r28.$r29. "\n"; 
//       
//        echo "</br>Quantidade caracteres Segmento R : " . $contar2 = strlen($r). "</br>";
//               


            $fp = fopen("remessa/CB{$dia}{$mes}{$exibeano}.REM", "a");

            $content = $p . $q ;
            $escreve = fwrite($fp, "{$content}");

            fclose($fp);
            
            
            $Dados = [
                        "modo" => $value["modo"],
                        "descricao" => $value["descricao"],
                        "vencimento_em" => date('Y-m-d', strtotime("+1 month", strtotime($value["vencimento_em"]))),
                        "valor" => $value["valor"],
                        "nosso_numero" => $nosso,
                        "cliente_id" => $value["cliente_id"],
                        "carteira_id" => $value["carteira_id"],
                        "carteira" => "Empresa",
                        "categoria_id" => $value["categoria_id"],
                        "tipo" => $value["tipo"],
                        "js_parcelas" => $value["js_parcelas"] + 1,
                        "user_id" => $_SESSION["user_id"],
                        "status" => $value["status"],
                        "repetir_em" => date('Y-m-d', strtotime("+2 month", strtotime($value["vencimento_em"])))
                    ];
            
                // realiza o cadastro da nova fatura.
                $cad = new \Source\Models\Create();
                $cad->ExeCreate("app_faturas", $Dados);
                $cad->getResult();
                
                
            
       }
//        
//        
//        //aqui gera o trailler
//        
        //001 - 003 Código do Banco na compensação N 003
        $tl_1 = "033";
        $tl_1 = str_pad($tl_1, 3, "0", STR_PAD_LEFT);
        //004 - 007 Numero do lote remessa N 004
        $tl_2 = $lote;
        $tl_2 = str_pad($tl_2, 4, "0", STR_PAD_LEFT);
        //008 - 008 Tipo de registro N 001
        $tl_3 = "5";
        $tl_3 = str_pad($tl_3, 1, "0", STR_PAD_LEFT);      
        //009 - 017 Reservado (uso Banco) N 009 Brancos 

        $tl_4 = " ";
        $tl_4 = str_pad($tl_4, 9, " ", STR_PAD_LEFT);
        
        //018 - 023 Quantidade de registros do lote N 006
        $totals = $i * 2 + 3;
        
        $tl_5 = $totals;
        $tl_5 = str_pad($tl_5 ,6,"0", STR_PAD_LEFT);
        //024 - 240 Reservado (uso Banco) A 217 Brancos 
        $tl_6 = " ";
        $tl_6 = str_pad($tl_6, 217," ",STR_PAD_LEFT);

        
        
        $traillerLote = $tl_1.$tl_2.$tl_3.$tl_4.$tl_5.$tl_6.  "\n"; 
                
          echo "</br>Quantidade caracteres Trailler de Lote : " . $contar2 = strlen($traillerLote). "</br>";
//               
//          
//        //Código do Banco na Compensação 1 3 3 - Num G001
          $ta_1 = "033";
          $ta_1 = str_pad($ta_1,3,"0",STR_PAD_LEFT);
          //004 - 007 Numero do lote remessa N 004
          $ta_2 = "9999";
          $ta_2 = str_pad($ta_2, 4,"0",STR_PAD_LEFT);
          //008 - 008 Tipo de registro N 001
          $ta_3 = "9";
          $ta_3 = str_pad($ta_3, 1, "0", STR_PAD_LEFT);
          //009 - 017 Reservado (uso Banco) N 009
          $ta_4 = " ";
          $ta_4 = str_pad($ta_4,9," ",STR_PAD_LEFT);
          //018 - 023 Quantidade de lotes do arquivo N 006
          $ta_5 = $i;
          $ta_5 = str_pad($ta_5,6,"0", STR_PAD_LEFT);
          //024 - 029 Quantidade de registros do arquivo N 006
          $ta_6 = $i * 2 + 4;
          $ta_6 = str_pad($ta_6,6,"0",STR_PAD_LEFT);
          //030 - 240 Reservado (uso Banco) A 211 Brancos 
          $ta_7 = " ";
          $ta_7 = str_pad($ta_7, 211," ",STR_PAD_LEFT);
          //Uso Exclusivo FEBRABAN/CNAB 36 240 205 - Alfa Brancos G004
          $t_febraban = " ";
          $t_febraban = str_pad($t_febraban, 205," ", STR_PAD_LEFT);
          
          $traillerArquivo = $ta_1 . $ta_2 . $ta_3 . $ta_4 . $ta_5 . $ta_6 . $ta_7 ;
        
         echo "</br>Quantidade caracteres Trailler de Arquivo : " . $contar5 = strlen($traillerArquivo). "</br>";
          
          
//          
//          
          $fp = fopen("remessa/CB{$dia}{$mes}{$exibeano}.REM", "a");

         $content = $traillerLote . $traillerArquivo;
        $escreve = fwrite($fp, "{$content}");

        fclose($fp); 
        
        
        
        
    }

}
