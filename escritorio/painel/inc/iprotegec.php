<script type='text/javascript' src='js/jquery.js'></script>

<script src="js/jquery-1.2.6.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {


        $('select[@name=tipo]').change(function() {
            $.post('tipo_plano.php',
                    {tipo_plano: $(this).val()},
            function(tipo_plano) {

                $('select[@name=tipo_plano]').html(tipo_plano)

            }

            )


        })

        $('select[@name=tipo_plano]').change(function() {
            $.post('plano_desc.php',
                    {plano_desc: $(this).val()},
            function(plano_desc) {

                $('select[@name=plano_desc]').html(plano_desc)

            }

            )


        })

        $('select[@name=tipo_plano]').change(function() {
            $.post('plano.php',
                    {plano: $(this).val()},
            function(plano) {

                $('select[@name=plano]').html(plano)

            }

            )


        })

        
    })
    function MM_openBrWindow(theURL, winName, features) { //v2.0
        window.open(theURL, winName, features);
    }
</script> 



<!--<script type='text/javascript' src='js/jquery.js'></script>


<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>-->
<main class="content"> 


    
<!--     <img src="img/ivenda2.png" width="auto" />-->


    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($form && $form['button']):
        unset($form['button']);
    
    $cadastra = new Update();
    $cadastra->ExeUpdate("prevenda", $form, "WHERE placa = :p", "p={$_GET['placa']}");
    $cadastra->getResult();
    
    if($cadastra->getResult()) {
        
            echo "<p class=\"cadastro\">cadastro realizado com sucesso</p>";
            echo "<meta http-equiv=\"refresh\" content=2;url=\"index.php?p=iprotegeb&placa={$_GET['placa']}\">";
        
        
    }else{
        echo "Erro ao cadastrar";
    }


    endif;

   // var_dump( $form);
    ?>


    <form id="form1" name="form1" method="post" action="">



             <div class="page-header">
            <h3> SELECIONE O PLANO</h3> 
        </div>
        <div class="row"> 
            <div class="col-md-12">
            <label> Tipo </label>
            <select name="tipo" class="form-control"> 
                <option value="0"> Selecione o Plano </option>
                <option value="8"> Comodato </option>
                <option value="1"> Moto </option>
                <option value="2"> Carro </option>
                <option value="3"> Utilitario </option>
                <option value="4"> Cominhão </option>
<!--                <option> Selecione </option>
                <option> Selecione </option>-->
            </select>
            </div>
            
            <div class="col-md-12">
            <label> Tipo Plano </label>
            <select name="tipo_plano" class="form-control"> </select>
            </div>
            
            <div class="col-md-12">
            <label> Descrição do Plano </label>
            <select name="plano_desc" class="form-control"> </select>
            </div>
            
            <div class="col-md-12">
            <label> Valor </label>
            <select name="plano" class="form-control"> </select>
            </div>


        <?php
//        $readplano = new Read();
//        $readplano->ExeRead("planos", "WHERE ativo = :a ORDER BY plano ASC" , "a=1");
//        $readplano->getResult();
//
//        foreach ($readplano->getResult() as $plano) {
//
//            echo"                       
//                                
//                            <div class=\"col-md-3 thumbnail\" style='height:250px'>
//                               <label> <input type=\"radio\" name=\"tipo_plano\" value=\"{$plano['plano']}\" style=\"float:left; width:20px;\"> <b> Plano </b> {$plano['plano']}</label> </br></br>
//                                <label><input type=\"radio\" name=\"plano_desc\" value=\"{$plano['descricao']}\" style=\"float:left; width:20px;\"> <b> Descrição </b> {$plano['descricao']} </label></br></br>
//<label><input type=\"radio\" name=\"id_plano\" value=\"{$plano['id_plano']}\" id=\"plano_{$plano['id_plano']}\" style=\"float:left; width:20px;\"> <b>ID </b> {$plano['id_plano']} </label></br></br>
//                                    <label><input type=\"radio\" name=\"plano\" value=\"{$plano['valor']}\" style=\"float:left; width:20px;\"> <b> Valor R$</b> {$plano['valor']} </label></br></br>
//
//      
//                        
//                    </label> </div>";
//        }
        ?>
            </div>
       
        
        
               <div class="page-header">
            <h3> DADOS DE ADESÃO</h3> 
        </div>
            
        <div class="form-group col-md-3">
                <label>
                    Adesão</label>
                    <input type="text" name="adesao" id="adesao" class="form-control" placeholder="450.00" />
        </div>
        
        <div class="form-group col-md-3">
            <label>Forma de pagamento</label> 
            <select name="formapgto_adesao" class="form-control"> 
                                    <option value="1"> DINHEIRO</option>
                                    <option value="2"> CARTÃ MAQUINA</option>
                                    <option value="3"> CARTÃ PAGSEGURO</option>
                                    <option value="4"> BOLETO</option>
                                    <option value="5"> CHEQUE</option>
                                </select>
                </div>
        
        
        <div class="form-group col-md-3">
        
            <label>Forma de pagamento</label>
                    <input name="pgto_adesao" type="text" id="pgto_adesao" class="form-control" size="75" />
               
        </div>
        
        <div class="form-group col-md-3">

            <label>data vencimento</label>>
            <input name="vencimento" type="text" id="vencimento" class="form-control" placeholder="30"  />
                
        </div>
            

               <div class="form-group col-md-12">
                           
                            <input type="submit" name="button" id="button" value="SEGUIR" class="btn btn-primary"  />
                        </div>
            

                </form>



                </main>
<div class="clear"> </div>