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
        require('./_app/Config.inc.php');
        
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        //var_dump($filtro);
        
//        $verifica = new Read();
//        $verifica->ExeRead("prevenda", "WHERE codigo = :c", "c={$filtro['codigo']}");
//        $verifica->getResult();
//        
//        if($verifica->getResult()):
//            echo "<h1>ja existe</h1>";
//        else:
//            echo "deu alguma merda";
//        endif;
        
        $verifica = new Read();
        $verifica->ExeRead("orcamentoacasp", "WHERE email = :a", "a={$filtro['email']}");
        $verifica->getResult();
        
        if($verifica->getResult()):
            
            echo "<meta http-equiv=\"refresh\" content=3;url=\"migracao.php?protegefacil=sim\">";
        
        echo "JA EXISTE ESSE REGISTRO";
            
            else:
            
            $cadastra = new Create();
            $cadastra->ExeCreate("orcamentoacasp", $filtro);
            $cadastra->getResult();
            
            if($cadastra->getResult()):
                
                echo "CADASTRADO COM SUCESSO";
                echo "<meta http-equiv=\"refresh\" content=3;url=\"migracao.php?protegefacil=sim\">";
            endif;
            
        endif;

        ?>

        
<!--        <p> <a href="migracao.php?protegefacil=sim">Voltar </a> </p>-->