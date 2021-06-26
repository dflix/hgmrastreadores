<main class="content"> 
    <div class="page-header">
    <h3> Calcular Associação </h3>
    </div>
    <?php
    //require('../../_app/Config.inc.php');

    ?>

    <script type='text/javascript' src='js/jquery.js'></script>

    <script src="js/jquery-1.2.6.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {

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

                    $('select[@name=fipe1]').html(codigofipe)

                }

                )


            })

            $('select[@name=ano1]').change(function() {
                $.post('preco.php',
                        {preco: $(this).val()},
                function(preco) {

                    $('select[@name=valor1]').html(preco)

                }

                )


            })


            $('select[@name=ano]').change(function() {
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

        <div class="form-group col-md-2"
        <p> 
                Marca </p>
            <?php
//string json contendo os dados de um funcionário

//
//
//            $json_file = file_get_contents("http://fipeapi.appspot.com/api/1/caminhoes/marcas.json");
//            $json_str = json_decode($json_file, true);
//            $itens = $json_str;
//
//
//
//            echo "<select class=\"form-control\" name=\"marca1\" id=\"marca1\"> ";
//
//
//
//
//            $d = "|";
//
//            foreach ($itens as $e) {
//
//                echo "<option class=\"form-control\" value=\"{$e['name']}{$d}{$e['id']}\">{$e['name']} </option>";
//            }
//
//            echo "</select>";
            
            ?> 
             <input type="text" name="marca1" class="form-control" />
        </div>
        
        
        
        <div class="form-group col-md-3"> 
            <p>Modelo </p>
            <input name="modelo1" class="form-control" /> 

        </div>
        
        <div class="form-group col-md-2"> 
            <p>Ano </p>
            <input name="ano1" class="form-control" /> 

        </div>
        
        <div class="form-group col-md-2"> 
            <p>Fipe </p>
            <input name="fipe1" class="form-control" /> 
        </div>
        
        <div class="form-group col-md-2"> 
            <p>Valor </p>
            <input name="valor1" class="form-control" /> 
        </div>



        <!--        <label class="cinquenta">
                    <p> Valor do Veículo </p>
                    
<?php
//        $valor = "R$ 86.588,50";
//
//$valor = str_replace("R$ " , "" , $valor ); // Primeiro tira os pontos
//$valor = str_replace("." , "" , $valor ); // Primeiro tira os pontos
//$valor = str_replace("," , "" , $valor); // Depois tira a vírgula
//
//echo $valor; echo "</br>";
//
// $total = number_format($valor / 100, 2 , ",", ".");
// 
// echo $total;
?>
                    
                <input name="valor" type="text" id="valor"  style="width:250px; padding:10px;" />
                exemplo R$120.000,00 digitar 120000.00
                </label>-->


        <div class="form-group col-md-3"> 
            <p> Assistência 24HS</p>
            <select name="assistencia24hs" class="form-control" id="assistencia24hs" >
                <option value="0.00">Selecione a opção</option>
<!--                <option value="10.00">Sim R$10,00</option>
                <option value="20.00">Sim R$20,00</option>
                <option value="24.90">Sim R$24,90 Utilitário Passeio</option>
                <option value="34.90">Sim R$34,90 Utilitário Carga</option>
                <option value="49.00">Sim R$49,00 Caminhão Pesado</option>-->
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
$valor = $form['valor1'];

$valor = str_replace("R$ ", "", $valor); // Primeiro tira os pontos
$valor = str_replace(".", "", $valor); // Primeiro tira os pontos
$valor = str_replace(",", "", $valor); // Depois tira a vírgula

$valor;


$total = number_format($valor / 100, 2, ".", "");

$total;

$imple = $form['implemento'];

$imple = str_replace("R$ ", "", $imple); // Primeiro tira os pontos
$imple = str_replace(".", "", $imple); // Primeiro tira os pontos
$imple = str_replace(",", "", $imple); // Depois tira a vírgula

$imple;


$implemento = number_format($imple / 100, 2, ".", "");

 $implemento;


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
        //$rastreador = 65.00;
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

         
        ?>
  

        </br>
        
      
        </br>
        <div class="col-md-12">
        <input type="submit" name="sendassist" value="CALCULAR" class="btn btn-warning" />
        </div>
    </form>







</main>
