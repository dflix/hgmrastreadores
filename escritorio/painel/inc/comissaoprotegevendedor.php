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

    echo "<meta http-equiv=\"refresh\" content=1;url=\"index.php?p=comissaoprotegevendedor&ano={$ano}&mes={$mes}&dia={$dia}&view=resultados\"> ";
//header("location:index.php?p=fluxocaixa&ano={$ano}");
endif;
?>
<h2>Comissões Protege </h2>

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
                <label>BUSCAR <span class="glyphicon glyphicon-search"> </span></label></BR>
                
                <input type="submit" name="p" value="comissaoprotegevendedor" class="btn btn-primary" /></div>
            <div class="clear"> </div>
        </form>
    </section>


  <section class="col-md-12"> 
        </br>
        <p style="font-size: 1.2em; font-weight: bold; color: #006699;"> Vendas do <?php
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
                echo "Desembro";
            endif;
            ?> de <?= $_GET['ano'] ?> </p>


    </section>


<section class="col-md-12"> 

    <table class="table-responsive table-striped table-bordered table-hover table-condensed col-md-12"> 
    
        <thead> 
            <tr> 
                <th>Data </th>
                <th>Cliente </th>
                <th>Veiculo </th>
                <th>Placa </th>
                <th>Plano </th>
                <th>Afiliado </th>
                <th>Comissão </th>
            </tr>
        </thead>
        
        <?php 
          if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $ver = new Read();
                        $ver->ExeRead("prevenda", "WHERE relacionado = :v AND  MONTH(data) = :m AND YEAR(data) = :a", "v={$_COOKIE['logprot_id_usuario']}&m={$mes}&a={$ano}");
                        $ver->getResult();

                    //echo "Busca o mes e ano";

                    else:

                        $ver = new Read();
                        $ver->ExeRead("prevenda", "WHERE relacionado = :v AND  MONTH(data) = :m AND YEAR(data) = :a AND DAY(data) = :d", "v={$_COOKIE['logprot_id_usuario']}&m={$mes}&a={$ano}&d={$dia}");
                        $ver->getResult();

                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
        
        ?>
        
        <?php 
        $total = 0;
        $total2 = 0;
foreach ($ver->getResult() as $valor) {
    
    $total += $valor['comvend1'];
    $total2 += $valor['comvend2'];
        ?>
    
        <tbody> 
            <tr> 
                <td><?= date("d/m/Y H:i:s",strtotime($valor['data'])) ?> </td>
                <td><?= $valor['cliente'] ?> </td>
                <td><?= $valor['modelo'] ?> </td>
                <td><?= $valor['placa'] ?> </td>
                <td><?= $valor['plano_desc'] ?> / R$ <?= $valor['plano'] ?> </td>
                <td><?php 
                $aff= new Read();
                $aff->ExeRead("usuario", "WHERE id_usuario = :a", "a={$valor['afiliado']}");
                $aff->getResult();
                
                if($aff->getResult()):
                    echo "<b class='bg bg-success'>". $aff->getResult()[0]['nome']. "</b>";
                    else:
                    echo "<p class='bg bg-danger'>Sem referência</p>";
                endif;
                        
                $valor['afiliado'] ?> </td>
                <td>1º parcela = <?= $valor['comvend1'] ?>
                    <hr>
                    2º parcela = <?= $valor['comvend2'] ?>
                </td>
            </tr>
        </tbody>
        
<?php } ?>
    
    </table>

</section>

<section class="col-md-12"> 
    </br></br>
    <h4>  Total de Comissões 1º Parcela R$<?= number_format($total,2 , "." , ".") ?> </h4>
    </br>
    <h4>  Total de Comissões 2º Parcela R$<?= number_format($total2,2 , "." , ".") ?> </h4>
</section>

</br></br></br></br>