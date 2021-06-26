<?php
$dia = $_GET['dia'];
if (empty($dia)):
    $dia = date("d");
endif;
$mes = $_GET['mes'];
if (empty($mes)):
    $mes = date("m");
endif;
$ano = $_GET['ano'];
if (empty($ano)):
    $ano = date("Y");
endif;

if (empty($_GET['ano'])):

    echo "<meta http-equiv=\"refresh\" content=1;url=\"index.php?p=estatisticaporafiliado&ano={$ano}&mes={$mes}&dia={$dia}&view=resultados\"> ";
//header("location:index.php?p=fluxocaixa&ano={$ano}");
endif;
?>
<h2>Estatisticas </h2>

<section class="row col-md-12"> 
        <form action="" class="form" metdod="GET">

            <div class="col-md-2"> 
                <label>DIA </label>
                <select name="dia" class="form-control">

                    <option value="<?= $dia ?>"><?= $dia ?></option>   
                    <option value="mes">00 busca por mes</option>   
                    <option value="01">01</option>   
                    <option value="02">02</option>   
                    <option value="03">03</option>   
                    <option value="04">04</option>   
                    <option value="05">05</option>   
                    <option value="06">06</option>   
                    <option value="07">07</option>   
                    <option value="08">08</option>   
                    <option value="09">09</option>   
                    <option value="10">10</option> 
                    <option value="11">11</option>   
                    <option value="12">12</option>   
                    <option value="13">13</option>   
                    <option value="14">14</option>   
                    <option value="15">15</option>   
                    <option value="16">16</option>   
                    <option value="17">17</option>   
                    <option value="18">18</option>   
                    <option value="19">19</option>   
                    <option value="20">20</option>                   
                    <option value="21">21</option>   
                    <option value="22">22</option>   
                    <option value="23">23</option>   
                    <option value="24">24</option>   
                    <option value="25">25</option>   
                    <option value="26">26</option>   
                    <option value="27">27</option>   
                    <option value="28">28</option>   
                    <option value="29">29</option>   
                    <option value="30">30</option>
                    <option value="31">31</option>  
                </select>

            </div>

            <div class="col-md-3">
                <label>MES </label>
                <select name="mes" class="form-control">
                    <option value="<?= $mes ?>">  <?= $mes ?></option>
                    <option value="<?= "01" ?>">  <?= "JAN" ?></option>
                    <option value="<?= "02" ?>">  <?= "FEV" ?></option>
                    <option value="<?= "03" ?>">  <?= "MAR" ?></option>
                    <option value="<?= "04" ?>">  <?= "ABR" ?></option>
                    <option value="<?= "05" ?>">  <?= "MAI" ?></option>
                    <option value="<?= "06" ?>">  <?= "JUN" ?></option>
                    <option value="<?= "07" ?>">  <?= "JUL" ?></option>
                    <option value="<?= "08" ?>">  <?= "AGO" ?></option>
                    <option value="<?= "09" ?>">  <?= "SET" ?></option>
                    <option value="<?= "10" ?>">  <?= "OUT" ?></option>
                    <option value="<?= "11" ?>">  <?= "NOV" ?></option>
                    <option value="<?= "12" ?>">  <?= "DEZ" ?></option>
                </select>
            </div>

            <div class="col-md-3"> 
                <label>ANO </label>
                <select name="ano" class="form-control"> 


                    <option value="<?= $ano ?>"> <?= $ano ?> </option>
                    <option value="2018"> 2018 </option>
                    <option value="2019"> 2019 </option>
                    <option value="2020"> 2020 </option>
                    <option value="2021"> 2021 </option>
                    <option value="2022"> 2022 </option>
                    <option value="2023"> 2023 </option>
                    <option value="2024"> 2024 </option>
                    <option value="2025"> 2025 </option>
                </select> </div>
            
            <div class="col-md-3"> 
                <label>VENDEDOR </label>
                <select name="vendedor" class="form-control">
                    
                    <option>Selecione o vendedor </option>
                    
                    <?php 
                    $vend = new Read();
                    $vend->ExeRead("usuario", "WHERE nivel = :n", "n=5");
                    $vend->getResult();
                    
                    foreach ($vend->getResult() as $value) {

                    ?>
                    
                    <option value="<?= $value['id_usuario'] ?>"> <?= $value['nome'] ?> </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3"> 
                <label>BUSCAR <span class="glyphicon glyphicon-search"> </span></label></BR>
                
                <input type="submit" name="p" value="estatisticaporafiliado" class="btn btn-primary" /></div>
            <div class="clear"> </div>
        </form>
    </section>


  <section class="col-md-12"> 
        </br>
        <p style="font-size: 1.2em; font-weight: bold; color: #006699;"> Estatisticas do <?php
            if ($dia == "mes"):
                echo "mês de ";
            else:
                echo "dia  " . $dia;
            endif;
            ?> <?php
            if ($_GET['mes'] == "01"):
                echo "Janeiro";
            endif;
            if ($_GET['mes'] == "02"):
                echo "Fevereiro";
            endif;
            if ($_GET['mes'] == "03"):
                echo "Março";
            endif;
            if ($_GET['mes'] == "04"):
                echo "Abril";
            endif;
            if ($_GET['mes'] == "05"):
                echo "Maio";
            endif;
            if ($_GET['mes'] == "06"):
                echo "Junho";
            endif;
            if ($_GET['mes'] == "07"):
                echo "Julho";
            endif;
            if ($_GET['mes'] == "08"):
                echo "Agosto";
            endif;
            if ($_GET['mes'] == "09"):
                echo "Setembro";
            endif;
            if ($_GET['mes'] == "10"):
                echo "Outubro";
            endif;
            if ($_GET['mes'] == "11"):
                echo "Novembro";
            endif;
            if ($_GET['mes'] == "12"):
                echo "Dezembro";
            endif;
            ?> de <?= $_GET['ano'] ?> Vendedor = <?php
            
            $nomevend = new Read();
            $nomevend->ExeRead("usuario", "WHERE id_usuario = :a", "a={$_GET['vendedor']}");
            $nomevend->getResult();
            
            echo $nomevend->getResult()[0]['nome']; 
             ?> </p>


    </section>


<section class="row"> 
    
    <div class="col-md-2"> 
        <?php 
 if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $ver = new Read();
                        $ver->ExeRead("ws_traffic", "WHERE afiliado = :v AND  MONTH(data) = :m AND YEAR(data) = :a GROUP BY ip", "v={$_GET['vendedor']}&m={$mes}&a={$ano}");
                        $ver->getResult();
                        $ver->getRowCount();

                    //echo "Busca o mes e ano";

                    else:

                        $ver = new Read();
                        $ver->ExeRead("ws_traffic", "WHERE afiliado = :v AND  MONTH(data) = :m AND YEAR(data) = :a AND DAY(data) = :d GROUP BY ip", "v={$_GET['vendedor']}&m={$mes}&a={$ano}&d={$dia}");
                        $ver->getResult();
                         $ver->getRowCount();

                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
        

        ?>
        <h3 class="bg bg-success">Visitas no Site </br> </br></h3>
        <p style="text-align:center; font-size: 1.5em; font-weight: bold;"><?=  $ver->getRowCount(); ?></p>
    </div>
    
    <div class="col-md-2"> 
        
                <?php 
 if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $visitas = new Read();
                        $visitas->ExeRead("orcamento", "WHERE aff = :v AND  MONTH(data) = :m AND YEAR(data) = :a ", "v={$_GET['vendedor']}&m={$mes}&a={$ano}");
                        $visitas->getResult();
                        $visitas->getRowCount();

                    //echo "Busca o mes e ano";

                    else:

                        $visitas = new Read();
                        $visitas->ExeRead("orcamento", "WHERE aff = :v AND  MONTH(data) = :m AND YEAR(data) = :a AND DAY(data) = :d ", "v={$_GET['vendedor']}&m={$mes}&a={$ano}&d={$dia}");
                        $visitas->getResult();
                         $visitas->getRowCount();

                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
        

        ?>
        
        <h3 class="bg bg-info">Leads (Indicação Site) </h3>
         <p style="text-align:center; font-size: 1.5em; font-weight: bold;"><?=  $visitas->getRowCount(); ?></p>
    </div>
    
    <div class="col-md-2"> 
                <?php 
 if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $indempresa = new Read();
                        $indempresa->ExeRead("orcamento", "WHERE vendedor = :v AND  MONTH(data) = :m AND YEAR(data) = :a ", "v={$_GET['vendedor']}&m={$mes}&a={$ano}");
                        $indempresa->getResult();
                        $indempresa->getRowCount();

                    //echo "Busca o mes e ano";

                    else:

                        $indempresa = new Read();
                        $indempresa->ExeRead("orcamento", "WHERE vendedor = :v AND  MONTH(data) = :m AND YEAR(data) = :a AND DAY(data) = :d ", "v={$_GET['vendedor']}&m={$mes}&a={$ano}&d={$dia}");
                        $indempresa->getResult();
                         $indempresa->getRowCount();

                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
        

        ?>
        
        
        <h3 class="bg bg-info">Leads (Indicação Empresa) </h3>
        <p style="text-align:center; font-size: 1.5em; font-weight: bold;"><?=  $indempresa->getRowCount(); ?></p>
    </div>
    
    <div class="col-md-2">
        
                <?php 
 if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $indaff = new Read();
                        $indaff->ExeRead("leadafiliado", "WHERE relacionado = :v AND  MONTH(data) = :m AND YEAR(data) = :a ", "v={$_GET['vendedor']}&m={$mes}&a={$ano}");
                        $indaff->getResult();
                        $indaff->getRowCount();

                    //echo "Busca o mes e ano";

                    else:

                        $indaff = new Read();
                        $indaff->ExeRead("leadafiliado", "WHERE relacionado = :v AND  MONTH(data) = :m AND YEAR(data) = :a AND DAY(data) = :d ", "v={$_GET['vendedor']}&m={$mes}&a={$ano}&d={$dia}");
                        $indaff->getResult();
                         $indaff->getRowCount();

                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
        

        ?>
        
        <h3 class="bg bg-warning">Indicações Afiliados </h3>
        <p style="text-align:center; font-size: 1.5em; font-weight: bold;"><?=  $indaff->getRowCount(); ?></p>
    </div>
    
    <div class="col-md-2"> 
                <?php 
 if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $vendas = new Read();
                        $vendas->ExeRead("prevenda", "WHERE vendedor = :v AND  MONTH(data) = :m AND YEAR(data) = :a ", "v={$_GET['vendedor']}&m={$mes}&a={$ano}");
                        $vendas->getResult();
                        $vendas->getRowCount();

                    //echo "Busca o mes e ano";

                    else:

                        $vendas = new Read();
                        $vendas->ExeRead("prevenda", "WHERE vendedor = :v AND  MONTH(data) = :m AND YEAR(data) = :a AND DAY(data) = :d ", "v={$_GET['vendedor']}&m={$mes}&a={$ano}&d={$dia}");
                        $vendas->getResult();
                         $vendas->getRowCount();

                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
        

        ?>
        
        <h3 class="bg bg-danger">Vendas </br> </br></h3>
        <p style="text-align:center; font-size: 1.5em; font-weight: bold;"><?=  $vendas->getRowCount(); ?></p>

    </div>
    
    <div class="col-md-2"> 
    <h3 class="bg bg-success">Retorno em Vendas  </br> </h3>
    
    <?php 
    $retorno = $vendas->getRowCount() / $indempresa->getRowCount() * 100;
    ?>
    
    <p style="text-align:center; font-size: 1.5em; font-weight: bold;"> <?= $retorno ?> % </p>
    </div>

</section>

<style type="text/css"> 
h3{padding: 10px; font-size: 1.2em; text-align: center;}
</style>
    

