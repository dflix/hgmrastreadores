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



<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>
<main class="content"> 

    <h3 class="page-header">ATUALIZAR VENDA PROTEGE </h3>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($form && $form['button']):
        unset($form['button']);
    
    $datai = explode("/", $form['data_instalacao']);
    
    $form['data_instalacao'] = $datai['2'] . "-" . $datai['1'] . "-" . $datai['0'];

        $atualiza = new Update();
        $atualiza->ExeUpdate("prevenda", $form, "WHERE id_venda= :p", "p={$_GET['id']}");
        $atualiza->getResult();
        if ($atualiza->getResult()):
            echo "<div class=\"alert alert-success\" role=\"alert\">Atualização realizada com sucesso</div>";
        echo "<meta http-equiv=\"refresh\" content=2;url=\"index.php?p=eprotege\">";
            
        else:
            echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao atualizar cadastro</div>";
        endif;

//    $cadastra = new Create();
//    $cadastra->ExeCreate("prevenda", $form);
//    $cadastra->getResult();
//    if($cadastra->getResult()){
//        echo "<p class=\"cadastro\">cadastro realizado com sucesso</p>";
//       
//    }else{
//        echo "ERRO ao cadastrar";
//    }
    endif;

    //var_dump($form);

    $ver = new Read();
    $ver->ExeRead("prevenda", "WHERE id_venda= :p", "p={$_GET['id']}");
    $ver->getResult();
    $puxavendedor = $ver->getResult()[0]['vendedor'];
    $plano = $ver->getResult()[0]['plano'];
    ?>


    <form id="form1" name="form1" class="form" method="post" action="">
        <label class="cem">
            <p> VENDEDOR</p>
            <select name="vendedor" id="vendedor" class="form-control">
                <?php
                $vervend = new Read();
                $vervend->ExeRead("usuario", "WHERE id_usuario= :p", "p={$puxavendedor}");
                $vervend->getResult();

                echo "<option value=\"{$vervend->getResult()[0]['id_usuario']}\">{$vervend->getResult()[0]['nome']}</option>";
                ?>
                <option value=""> Selecione o Vendedor</option>
                <?php
                $vend = new Read();
                $vend->ExeRead("usuario", "WHERE nivel= :p ORDER BY nome ASC", "p=2");
                $vend->getResult();

                foreach ($vend->getResult() as $valor) {
                    echo "<option value=\"{$valor['id_usuario']}\">{$valor['nome']}</option>";
                }
                ?>



            </select>
        </label>
        <div class="clear"> </div>
        <h3 class="page-header">DADOS DO CLIENTE </h3>
        <div class="clear"> </div>
        <label class="setentaecinco">
            <p>CLIENTE :</p>
            <input name="cliente" class="form-control" type="text" id="cliente" size="75" value="<?= $ver->getResult()[0]['cliente']; ?>" />

        </label>  
        <label class="vinteecinco"><p>DATA NASCIMENTO</p>
            <input name="data_nasc" class="form-control" type="text" id="data_nasc" size="10" value="<?= $ver->getResult()[0]['data_nasc']; ?>" onKeyPress="MascaraData(form.data_nasc)" />
        </label>
        <label class="vinteecinco">
            <p>CPF / CNPJ </p>
            <input type="text" name="cpf" class="form-control" id="cpf" value="<?= $ver->getResult()[0]['cpf']; ?>" />
        </label>

        <label class="vinteecinco">
            <P>RG</P>
            <input type="text" name="rg" class="form-control" value="<?= $ver->getResult()[0]['rg']; ?>" id="rg" />
        </label>

        <label class="vinteecinco"><p>TEL: Residencial.</p>
            <input name="telres" type="text" class="form-control" id="telres" value="<?= $ver->getResult()[0]['telres']; ?>" onKeyPress="MascaraTelefone(form.telres)" size="12" />
        </label>
        <label class="vinteecinco"><p>TEL: Celular</p>
            <input name="telcel" type="text" class="form-control" id="telcel" value="<?= $ver->getResult()[0]['telcel']; ?>" onKeyPress="MascaraTelefone(form.telcel)" size="12" />
        </label>
        <div class="clear"> </div>
        <h3 class="page-header">DADOS DE COBRANÇA</h3>
        <div class="clear"> </div>
        <label class="vinte"><p>CEP</p>
            <input name="cep" class="form-control" type="text" id="cep" value="<?= $ver->getResult()[0]['cep']; ?>"  maxlength="9"
                   onblur="pesquisacep(this.value);" />
        </label>
        <label class="setenta"><p>END.RES:</p> 
            <input name="endereco" class="form-control" value="<?= $ver->getResult()[0]['endereco']; ?>" type="text" id="endereco" />
        </label>
        <label class="dez"><P>Numeroº</P>
            <input name="numero" class="form-control" type="text" id="numero" value="<?= $ver->getResult()[0]['numero']; ?>"  />
        </label>
        <div class="clear"> </div>
        <label class="vinteecinco"> 
            <p>COMPLEMENTO:</p>
            <input name="complemento" class="form-control" type="text" id="complemento" value="<?= $ver->getResult()[0]['complemento']; ?>" />
        </label>
        <label class="vinteecinco"><p>BAIRRO :</p>
            <input name="bairro" class="form-control" type="text" id="bairro" value="<?= $ver->getResult()[0]['bairro']; ?>"  />
        </label>
        <label class="vinteecinco"><p>CIDADE:</p>
            <input name="cidade" class="form-control" type="text" id="cidade" value="<?= $ver->getResult()[0]['cidade']; ?>"  />
        </label>
        <label class="vinteecinco"><p>UF:</p>
            <input name="uf" class="form-control" type="text" id="uf" value="<?= $ver->getResult()[0]['uf']; ?>" />
        </label>
        <div class="clear"> </div>

        <label class="cem"><p>EMAIL:</p>
            <input name="email" type="text" class="form-control" id="email" value="<?= $ver->getResult()[0]['email']; ?>" size="75" />
        </label>

        <div class="clear"> </div>
        
        <h3>BLOQUEIO</h3>
        
        <select name="bloqueio" class="form-control"> 
            <option value="<?= $ver->getResult()[0]['bloqueio']; ?>"> <?php 
            if($ver->getResult()[0]['bloqueio'] == "0"):
                echo "NÂO";
                else:
                echo "SIM";
            endif;
            ?> </option>
            <option value="0"> NÂO</option>
            <option value="1"> SIM</option>
        </select>
        
        
         <div class="clear"> </div>

        <h3>DADOS DO VEÍCULO</h3>
        <div class="clear"> </div>

        <label class="vinte"><p>VEICULO: </p>
            <input type="text" name="veiculo" class="form-control" id="marca" value="<?= $ver->getResult()[0]['veiculo']; ?>" />      
        </label>

        <label class="vinte"><p>MARCA: </p>
            <input type="text" name="marca" class="form-control" id="marca" value="<?= $ver->getResult()[0]['marca']; ?>" />      
        </label>
        <label class="vinte"><p>MODELO </p>
            <input type="text" name="modelo"  class="form-control" id="modelo" value="<?= $ver->getResult()[0]['modelo']; ?>" />
        </label>
        <label class="vinte">
            <p>ANO:</p>
            <input name="ano" type="text" class="form-control" id="ano" size="5" value="<?= $ver->getResult()[0]['ano']; ?>" />
        </label>
        <label class="vinte">
            <p>COR:</p>
            <input type="text" name="cor" class="form-control" id="cor" value="<?= $ver->getResult()[0]['cor']; ?>" />
        </label>
        <div class="clear"> </div>
        <label class="vinte">
            <p>CHASSI:</p>
            <input type="text" name="chassi" class="form-control" id="chassi" value="<?= $ver->getResult()[0]['chassi']; ?>" />
        </label>
        <label class="vinte">
            <p>RENAVAM:</p>
            <input type="text" name="renavam" id="renavam" class="form-control" value="<?= $ver->getResult()[0]['renavam']; ?>" />
        </label>
        <label class="vinte"><p>PLACA</p>
            <input type="text" name="placa" id="placa" class="form-control" value="<?= $ver->getResult()[0]['placa']; ?>" />
        </label>
        <label class="vinte"><p>FIPE</p>
            <input type="text" name="fipe" id="fipe" class="form-control" value="<?= $ver->getResult()[0]['fipe']; ?>" />
        </label>
        <label class="vinte"><p>VALOR</p>
            <input type="text" name="valor" id="valor" class="form-control" value="<?= $ver->getResult()[0]['valor']; ?>" />
        </label>
        <div class="clear"> </div>

        <h3>SELECIONE O PLANO</h3>
        <div class="clear"> </div>

       <?php 
       
       if(isset($_GET['editarplano'])){
       
       ?>
        
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
            <select name="tipo_plano" class="form-control"> 
                
            </select>
            </div>
            
            <div class="col-md-12">
            <label> Descrição do Plano </label>
            <select name="plano_desc" class="form-control"> 
             
            </select>
            </div>
            
            <div class="col-md-12">
            <label> Valor </label>
            <select name="plano" class="form-control"> 
             
            </select>
            </div>
         
         <div class="col-md-12"> 
    <a href="index.php?p=aprotege&id=<?= $_GET['id'] ?>"><p class="btn btn-primary"> Voltar </p></a>
</div>
         
         </div>

       <?php }else{ ?>
        
         <div class="row"> 
<!--            <div class="col-md-12">
            <label> Tipo </label>
            <select name="tipo" class="form-control"> 
                <option value="0"> Selecione o Plano </option>
                <option value="8"> Comodato </option>
                <option value="1"> Moto </option>
                <option value="2"> Carro </option>
                <option value="3"> Utilitario </option>
                <option value="4"> Cominhão </option>
                <option> Selecione </option>
                <option> Selecione </option>
            </select>
            </div>-->
            
            <div class="col-md-12">
            <label> Tipo Plano </label>
            <input type="text" name="tipo_plano" value="<?= $ver->getResult()[0]['tipo_plano']; ?>" class="form-control"/> 

            </div>
            
            <div class="col-md-12">
            <label> Descrição do Plano </label>
            <input type="text" name="plano_desc" value="<?= $ver->getResult()[0]['plano_desc']; ?>" class="form-control"/> 

            </div>
            
            <div class="col-md-12">
            <label> Valor </label>
            <input type="text" name="plano" value="<?= $ver->getResult()[0]['plano']; ?>" class="form-control"/> 
             
          
            </div>
         
<div class="col-md-12"> 
    <a href="index.php?p=aprotege&id=<?= $_GET['id'] ?>&editarplano=sim"><p class="btn btn-primary"> Alterar Plano </p></a>
</div>
         
         </div>

        <?php
//        $verplano = new Read;
//        $verplano->ExeRead("prevenda", "WHERE plano= :p", "p={$plano}");
//        $verplano->getResult();
//
//        echo"                      
//                                
//                            <div class=\"thumbnail col-md-2\" style=\"height:300px;\">
//                               <label> <input type=\"radio\" name=\"tipo_plano\" value=\"{$verplano->getResult()[0]['tipo_plano']}\" checked=\"\"  style=\"float:left; width:20px;\"> <b> Plano </b> {$verplano->getResult()[0]['tipo_plano']}</label> </br></br>
//                                <label><input type=\"radio\" name=\"plano_desc\" value=\"{$verplano->getResult()[0]['plano_desc']}\" checked=\"\" style=\"float:left; width:20px;\"> <b> Descrição </b> {$verplano->getResult()[0]['plano_desc']} </label></br></br>
//<label><input type=\"radio\" name=\"id_plano\" value=\"{$verplano->getResult()[0]['id_plano']}\" id=\"plano_{$verplano->getResult()[0]['id_plano']}\" checked=\"\" style=\"float:left; width:20px;\"> <b>ID </b> {$verplano->getResult()[0]['id_plano']} </label></br></br>
//                                    <label><input type=\"radio\" name=\"plano\" value=\"{$verplano->getResult()[0]['plano']}\" checked=\"\" style=\"float:left; width:20px;\"> <b> Valor R$</b> {$verplano->getResult()[0]['plano']} </label></br></br>
//
//                   
//                        <hr>
//                        
//                    </label></div>";
        ?>

        <?php
//        $readplano = new Read();
//        $readplano->ExeRead("planos", "WHERE ativo = :a ORDER BY id_plano ASC" , "a=1");
//        $readplano->getResult();
//
//
//        foreach ($readplano->getResult() as $plano) {
//
//            echo"   <div class=\"thumbnail col-md-2\" style=\"height:300px;\" >
//                               <label> <input type=\"radio\" name=\"tipo_plano\" value=\"{$plano['plano']}\"  style=\"float:left; width:20px;\"> <b> Plano </b> {$plano['plano']}</label> </br></br>
//                                <label><input type=\"radio\" name=\"plano_desc\" value=\"{$plano['descricao']}\" style=\"float:left; width:20px;\"> <b> Descrição </b> {$plano['descricao']} </label></br></br>
//<label><input type=\"radio\" name=\"id_plano\" value=\"{$plano['id_plano']}\" id=\"plano_{$plano['id_plano']}\" style=\"float:left; width:20px;\"> <b>ID </b> {$plano['id_plano']} </label></br></br>
//                                    <label><input type=\"radio\" name=\"plano\" value=\"{$plano['valor']}\" style=\"float:left; width:20px;\"> <b> Valor R$</b> {$plano['valor']} </label></br></br>
//
//                        
//                    </label>  </div>";
//        }
        ?>
        
        
        
       <?php } ?> 
        
        <div class="clear"> </div>
        <h3> DADOS DO CONTRATO </h3>
        <div class="clear"> </div>

        <label class="vinte">
            <p>Adesão</p>
            <input type="text" name="adesao" class="form-control" id="adesao" value="<?= $ver->getResult()[0]['adesao']; ?>" />
        </label>
        <label class="vinte">
            <P>Forma de pagamento</P> 
            <input name="pgto_adesao" class="form-control" type="text" id="pgto_adesao" value="<?= $ver->getResult()[0]['pgto_adesao']; ?>" size="75" />
        </label>
        <label class="vinte"><P>Contrato</P>
            <input name="codigo" type="text" class="form-control" value="<?= $ver->getResult()[0]['codigo']; ?>" id="codigo" />
        </label>
        <label class="vinte"><p>Status</p>
            <select name="status" id="status" class="form-control">
                <option value="<?= $status = $ver->getResult()[0]['status']; ?>"> <?php
                    if ($status == 1):
                        echo "Em analise";
                    endif;
                    if ($status == 2):
                        echo "Agendado";
                    endif;
                    if ($status == 3):
                        echo "Instalado";
                    endif;
                    if ($status == 4):
                        echo "Cancelado";
                    endif;
                    if ($status == 5):
                        echo "Cancelado e retirado";
                    endif;
                    if ($status == 6):
                        echo "Pausado";
                    endif;
                    ?> </option>
                <option value="#">Selecione Opção</option>
                <option value="1">Em Análise</option>
                <option value="2">Agendado</option>
                <option value="3">Instalado</option>
                <option value="4">Cancelado</option>
                <option value="5">Cancelado e retirado</option>
                <option value="6">Pausado</option>
            </select>
        </label>
        <label class="vinte">
            <p>Instalador</p>
            <select name="instalador" class="form-control">
                <?php
                $instalador = new Read();
                $instalador->ExeRead("usuario", "WHERE nivel = :p ORDER BY id_usuario ASC", "p=3");
                $instalador->getResult();
                foreach ($instalador->getResult() as $instalador) {
                    ?>
                    <option value=" <?= $instalador['id_usuario'] ?>"> <?= $instalador['nome'] ?> </option>
                <?php } ?>
            </select>
        </label>
        <div class="clear"> </div>
        <h3>DADOS DO INSTALADOR</h3>
        <div class="clear"> </div>

        <label class="vinte">
            <p>Data Instalação</p>
            <input type="text" name="data_instalacao" class="form-control" value="<?php $data = $ver->getResult()[0]['data_instalacao'];
            
            $dataa = explode("-", $data);
            
            echo $datab = $dataa['2'] . "/" . $dataa['1'] . "/" . $dataa['0'];
            
            ?>" onKeyPress="MascaraData(form.data_instalacao)" />
            </label>
        <label class="vinte"><p>Local Instalação</p>
            <textarea name="local_instalacao" class="form-control" > <?= $ver->getResult()[0]['local_instalacao'] ?> </textarea>
            </label>
        <label class="vinte"><p>Data Vencimento</p>
            
            <input type="text" name="diapgto" class="form-control" value="<?= $ver->getResult()[0]['diapgto'] ?>" />
           
            </label>
        <label class="vinte"> 
            <p> Contratos </p>
            <select name="contrato" class="form-control"> 
                <option value="<?= $ver->getResult()[0]['contrato']; ?>"> <?php 
                
                $vercontrato = new Read();
                $vercontrato->ExeRead("contrato", "WHERE id_contrato = :a", "a={$ver->getResult()[0]['contrato']}");
                $vercontrato->getResult();
                
                echo $vercontrato->getResult()[0]['contrato'] ; ?> </option>
                <?php 
                $contrato = new Read();
                $contrato->ExeRead("contrato", "ORDER BY id_contrato DESC" );
                $contrato->getResult();
                
                foreach ($contrato->getResult() as $value) {
                    
              
                ?>
                <option value="<?= $value['id_contrato'] ?>"> <?= $value['contrato'] ?> </option>
                <?php } ?>
            </select>
        </label>

<label class="vinte"><p>Data Próximo Vencimento</p>
<input name="vencimento" class="form-control" value="<?= $ver->getResult()[0]['vencimento']; ?>" type="text" id="vencimento" />
</label>
        <div class="clear"> </div>
        
        <div class="cem"> <h3>Recibo </h3> </div> 
        
        <label class="trinta"><p>Valor Recibo</p>
<input name="valor_recibo" class="form-control" value="<?= $ver->getResult()[0]['valor_recibo']; ?>" type="text" id="vencimento" />
</label>
        
        <label class="setenta"><p>Descrição</p>
<input name="descricao_recibo" class="form-control" value="<?= $ver->getResult()[0]['descricao_recibo']; ?>" type="text" id="vencimento" />
</label>

          <div class="clear"> </div>
        <div class="clear"> </div>
        <label>
                    <input type="hidden" name="data" value="<?= $ver->getResult()[0]['data']; ?>" />
                    <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
                    <input type="hidden" name="id_venda" value="<?= $ver->getResult()[0]['id_venda']; ?>" />
                    <input type="hidden" name="operador" value="<?= $_COOKIE['logprot_id_usuario'] ?>" />
                    <input type="submit" name="button" id="button" value="ATUALIZAR" class="btn btn-primary"  />
                </label>

    </form>



</main>