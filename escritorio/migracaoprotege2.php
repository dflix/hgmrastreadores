<!DOCTYPE html>

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
        $verifica->ExeRead("prevenda", "WHERE codigo = :a", "a={$filtro['codigo']}");
        $verifica->getResult();
        
        if($verifica->getResult()):
            
            echo "<meta http-equiv=\"refresh\" content=3;url=\"migracaoprotege.php?protegefacil=sim\">";
        
        echo "JA EXISTE ESSE REGISTRO";
            
            else:
            
            $cadastra = new Create();
            $cadastra->ExeCreate("prevenda", $filtro);
            $cadastra->getResult();
            
            if($cadastra->getResult()):
                
                echo "CADASTRADO COM SUCESSO";
                echo "<meta http-equiv=\"refresh\" content=3;url=\"migracaoprotege.php?protegefacil=yes\">";
            endif;
            
        endif;

        ?>

        
<!--        <p> <a href="migracao.php?protegefacil=sim">Voltar </a> </p>-->