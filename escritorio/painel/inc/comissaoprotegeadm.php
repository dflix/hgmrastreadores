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

    echo "<meta http-equiv=\"refresh\" content=1;url=\"index.php?p=comissaoprotegeadm&ano={$ano}&mes={$mes}&dia={$dia}&view=resultados\"> ";
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
                <label>VENDEDOR </label>
                <select name="vendedor" class="form-control">
                    
                    <option>Selecione o vendedor </option>
                    
                    <?php 
                    $vend = new Read();
                    $vend->ExeRead("usuario", "WHERE nivel = :n", "n=2");
                    $vend->getResult();
                    
                    foreach ($vend->getResult() as $value) {

                    ?>
                    
                    <option value="<?= $value['id_usuario'] ?>"> <?= $value['nome'] ?> </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3"> 
                <label>BUSCAR <span class="glyphicon glyphicon-search"> </span></label></BR>
                
                <input type="submit" name="p" value="comissaoprotegeadm" class="btn btn-primary" /></div>
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
<?php 
$filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if($filtro):
    
    $update = new Update();
    $update->ExeUpdate("prevenda", $filtro, "WHERE id_venda = :a", "a={$filtro['id_venda']}");
    $update->getResult();
    
    if($update->getResult()):
        echo "<div class=\"alert alert-success\" role=\"alert\">Comissões cadastradas com sucesso</div>";
    else:
        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao cadastrar comissões</div>";
    endif;
    
endif;

//var_dump($filtro);
?>
</section>

<section class="col-md-12"> 

    <table class="table-responsive table-striped table-bordered table-hover table-condensed col-md-12"> 
    
        <thead> 
            <tr> 
                <th>Data </th>
                <th>Cliente </th>
                <th>Veiculo </th>
                <th>Placa </th>
                <th>Comissão </th>
                <th>Comissão </th>
            </tr>
        </thead>
        
        <?php 
          if (isset($_GET['ano'])):

                    if ($_GET['dia'] == "mes"):

                        $ver = new Read();
                        $ver->ExeRead("prevenda", "WHERE MONTH(data) = :m AND YEAR(data) = :a", "m={$mes}&a={$ano}");
                        $ver->getResult();

                    //echo "Busca o mes e ano";

                    else:

                        $ver = new Read();
                        $ver->ExeRead("prevenda", "WHERE MONTH(data) = :m AND YEAR(data) = :a AND DAY(data) = :d", "m={$mes}&a={$ano}&d={$dia}");
                        $ver->getResult();

                    //echo "Busca o dia , mes e ano";

                    endif;

                endif;
        
        ?>
        
        <?php 
        
        $i = 0;
foreach ($ver->getResult() as $valor) {
    
    $i++;

        ?>
    
        <tbody> 
            <tr> 
                <td><?= date("d/m/Y H:i:s",strtotime($valor['data'])) ?> </td>
                <td><?= $valor['cliente'] ?> </td>
                <td><?= $valor['modelo'] ?> </td>
                <td><?= $valor['placa'] ?> </td>
                <td>R$ <?= $valor['comvend1'] ?> / R$ <?= $valor['comvend2'] ?> </td>
                <td>     
                  
                    <?php 
                    if(!empty($valor['comvend1'])):
                    ?>
                    
       <button type="button" class="btn btn-danger" 
              data-toggle="modal" data-target="#<?= $valor['id_venda'] ?>">
        Comissão
      </button> 
                
                <?php else: ?>
                    
       <button type="button" class="btn btn-success" 
              data-toggle="modal" data-target="#<?= $valor['id_venda'] ?>">
        Comissão
      </button>   
                    
                    
                <?php endif; ?>
                   
                </td>
            </tr>
        </tbody>
        
        
        
              <!-- Janela -->
      <div class="modal fade" id="<?= $valor['id_venda'] ?>">
        
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            
            <!-- cabecalho -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
              <h4 class="modal-title">Comissões</h4>
            </div>

            <!-- corpo -->
            <div class="modal-body">

                <h3>Conteudo e Formulario </h3>
                
                <p>Afiliado : <?php 
                $afiliado = new Read();
                $afiliado->ExeRead("usuario", "WHERE id_usuario = :a", "a={$valor['afiliado']}");
                $afiliado->getResult();
                
                if($afiliado->getResult()):
                    echo $afiliado->getResult()[0]['nome'];
                    else:
                    echo "Nao possui referecia de afiliado";
                endif;
                
                
                //$valor['afiliado'] ?>  </p>
                <p>Vendedor : <?php
                
                $vendedor = new Read();
                $vendedor->ExeRead("usuario", "WHERE id_usuario = :b", "b={$valor['vendedor']}");
                $vendedor->getResult();
                
                echo $vendedor->getResult()[0]['nome']; 
                
                //$valor['vendedor'] ?>  </p>
                <p>Supervidor : <?php
                $sup = new Read();
                $sup->ExeRead("usuario", "WHERE id_usuario = :c", "c={$valor['relacionado']}");
                $sup->getResult();
                
                echo $sup->getResult()[0]['nome'];
                
                 ?>  </p>
                
                <hr>
                
                <div class="row"> 
                    <form action="" method="post">
                        <?php 
                        if(empty($afiliado->getResult()[0]['nome'])):
  
                        ?>
                        
                   <div class="col-md-4"> 
                        <p>Comissão Afiliado </p>
                        <p> Não possui referencia </p>
                    </div>
                        
                        <?php else: ?>
                    <div class="col-md-4"> 
                        <p>Comissão Afiliado </p>
                        <input type="text"  name="comaf" value="<?=$valor['comaf'] ?>" class="dinheiro form-control" onkeypress="$(this).mask('###.00')" /> <!--name="comaf" --> 
                    </div>
                        <?php endif; ?>
                    <div class="col-md-4"> 
                        <p>Comissão Vendedor 1º Parcela </p>
                        <input type="text"  name="comvend1" value="<?=$valor['comvend1'] ?>" class="dinheiro form-control" onkeypress="$(this).mask('##.00')" />
                    </div>
                    <div class="col-md-4"> 
                        <p>Comissão Vendedor 2º Parcela </p>
                        <input type="text"  name="comvend2" value="<?=$valor['comvend2'] ?>" class="dinheiro form-control" onkeypress="$(this).mask('##.00')" />
                        <input type="hidden" name="id_venda" value="<?= $valor['id_venda'] ?>" />
                    </div>
                        
                        <div class="col-md-12"> <input type="submit" value="cadastrar" class="btn btn-success" /> </div>
                
                </div>
            </form>
            </div>

            <!-- rodape -->
            <div class="modal-footer">


            </div>

          </div>
        </div>

      </div>
        
<?php } ?>
    
    </table>

</section>

<section class="col-md-12"> 
    <h3>QUANTIDADE DE VENDAS <?= $i ?> </h3>
</section>

</br></br></br></br>

         