<main class="content"> 
    <div class="page-header">
    <h3> Calcular Associação </h3>
    </div>
    <?php
    //require('../../_app/Config.inc.php');
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if(isset($form)):
        
    
    
  $marca = explode("|", $form['marca1']);
   $newmarca = $marca[0] ;
    
    $modelo = explode("|", $form['modelo1']);
    
    $modelo = $modelo['0'] ;
    
    $ano = explode("|", $form['ano1']);
     $ano = $ano['0'];
     
     $placa = $form['placa'];
     
     $valorestimado =  $form['valor'];
     
     $valorestimado = str_replace("R$ ", "", $valorestimado); // Primeiro tira os pontos
$valorestimado = str_replace(".", "", $valorestimado); // Primeiro tira os pontos
$valorestimado = str_replace(",", "", $valorestimado); // Depois tira a vírgula


 $valorestimado = number_format($valorestimado / 100, 2, ".", "");

endif;
   //var_dump($form);
    ?>

    <script type='text/javascript' src='js/jquery.js'></script>

    <script src="js/jquery-1.2.6.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {


        $('select[@name=veiculo]').change(function() {
            $.post('marca.php',
                    {veiculo: $(this).val()},
            function(veiculo) {

                $('select[@name=marca1]').html(veiculo)

            }

            )


        })

        $('select[@name=marca1]').change(function() {
            $.post('modelo.php',
                    {marca: $(this).val()},
            function(modelo) {

                $('select[@name=modelo1]').html(modelo)

            }

            )


        })
        $('select[@name=modelo1]').change(function() {
            $.post('ano.php',
                    {ano: $(this).val()},
            function(ano) {

                $('select[@name=ano1]').html(ano)

            }

            )


        })
        $('select[@name=ano1]').change(function() {
            $.post('codigofipe.php',
                    {codigofipe: $(this).val()},
            function(codigofipe) {

                $('select[@name=fipe]').html(codigofipe)

            }

            )


        })

        $('select[@name=ano1]').change(function() {
            $.post('preco.php',
                    {preco: $(this).val()},
            function(preco) {

                $('select[@name=valor]').html(preco)

            }

            )


        })


        $('select[@name=ano1]').change(function() {
            $.post('combustivel.php',
                    {combustivel: $(this).val()},
            function(combustivel) {

                $('select[@name=combustivel]').html(combustivel)

            }

            )


        })





    })
    function MM_openBrWindow(theURL, winName, features) { //v2.0
        window.open(theURL, winName, features);
    }
</script> 


    <h3 class="page-header"> DADOS DO VEICULO / CAVALO </h3>

    <form name="orcamento" class="form-group" action="" method="post" enctype="multipart/form-data" > 

                 <div class="form-group col-md-2">
            <label >VEICULO: </label>
            <select name="veiculo" class="form-control"> 
                <option> Selecione o veiculo</option>
                <option value="motos"> Motos</option>
                <option value="carros"> Carros</option>
                <option value="caminhoes"> Caminhão</option>

            </select>
        </div>
        
 <div class="form-group col-md-2">
            <label >MARCA: </label>

            <select name="marca1" class="form-control"> </select>
        </div>

        <div class="form-group col-md-2">
            <label>MODELO </label>
            <select name="modelo1" id="modelo1" class="form-control"> </select>
            </label>
        </div>

        <div class="form-group col-md-2">
            <label>ANO:</label>
            <select name="ano1"  id="ano1" class="form-control"  > </select>

        </div>

        <div class="form-group col-md-2">
            <label>
                CODIGO FIPE:</label>
            <select  name="fipe" id="fipe" class="form-control" > </select>

        </div>

        <div class="form-group col-md-2">
            <label>
                VALOR:</label>
            <select  name="valor" id="valor" class="form-control"> </select>

        </div>



        <!--        <label class="cinquenta">
                    <p> Valor do Veículo </p>
                    
    
                <input name="valor" type="text" id="valor"  style="width:250px; padding:10px;" />
                exemplo R$120.000,00 digitar 120000.00
                </label>-->


        <div class="form-group col-md-3"> 
            <p> Assistência 24HS</p>
            <select name="assistencia24hs" class="form-control" id="assistencia24hs" >
                <option value="0.00">Selecione a opção</option>

                <option value="65.00">Sim R$65,00 Caminhão Pesado</option>
                <option value="75.00">Sim R$75,00 Caminhão Pesado</option>
                <option value="0.00">Não R$0,00</option>
            </select>
        </div>

        <div class="form-group col-md-3"> 
            <p> Placa</p>
            <input type="text" name="placa" class="form-control" />

        </div>
        
        <div class="form-group col-md-6"> 
            <p> Valor do Implemento / Carreta</p>
            <input type="text" name="implemento" onKeyPress="MascaraMoeda(form.implemento)" class="form-control" />

        </div>
        </br>
        
       

     



<?php

if(isset($form)):
    

$valor = $form['valor'];

$valor = str_replace("R$ ", "", $valor); // Primeiro tira os pontos
$valor = str_replace(".", "", $valor); // Primeiro tira os pontos
$valor = str_replace(",", "", $valor); // Depois tira a vírgula


$total = number_format($valor / 100, 2, ".", "");

if(empty($form['implemento'])):
  
    $form['implemento'] = 0;

else:

$imple = $form['implemento'];

$imple = str_replace("R$ ", "", $imple); // Primeiro tira os pontos
$imple = str_replace(".", "", $imple); // Primeiro tira os pontos
$imple = str_replace(",", "", $imple); // Depois tira a vírgula

$imple;


$implemento = number_format($imple / 100, 2, ".", "");

 $implemento;
 endif;


 $somatotal = $valor + $imple;
 
?>


        <?php
        if ($valor > 9999999) {
            $qtd = 2;
        } else {
            $qtd = 1;
        }

       $qtd;
        ?>



        <?php
        //$rastreador = 75.00;
        
        if($qtd == 1):
            $protege = "75.00";
            else:
            $protege = "140.00";
        endif;
        ?>
        <?php
        //$protege = $rastreador * $qtd;
        $rt = number_format($protege, 2, ".", "")
        ?>




        <?php
        $calculaacasp = $somatotal / 100 * 0.3;
        $mescasp = number_format($calculaacasp / 100, 2, ".", ".");
        $mescasp;
        ?>

<?php
$assist = $form['assistencia24hs'];
 $assist;
?>
      


        <?php
        $soma = $rt + $mescasp + $assist;

        endif; 
        ?>
  

        </br>
        
      
        </br>
        <div class="col-md-12">
        <input type="submit" name="calcular" value="CALCULAR" class="btn btn-warning" />
        </div>
    </form>







</main>
