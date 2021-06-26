<!-- Transferencia de titularidade -->
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

//<?php
//if (empty($_GET['metodo'])):
//    echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=tprotege&metodo=carros&id={$_GET['id']}\">";
//    $metodo = "";
//    else:
//
//    if (isset($_GET['metodo'])):
//
//        if ($_GET['metodo'] == "carros"):
//            $metodo = "";
//        endif;
//        if ($_GET['metodo'] == "caminhoes"):
//            $metodo = "2";
//        endif;
//
//    endif;
//
//endif;
//?> 

<!-- Adicionando Javascript -->
<script type="text/javascript" >

    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('endereco').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('uf').value = ("");

    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('uf').value = (conteudo.uf);

        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('uf').value = "...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }
    ;

</script>
<style type="text/javascript"> 

    var headertext = [];
    var headers = document.querySelectorAll("thead");
    var tablebody = document.querySelectorAll("tbody");

    for (var i = 0; i < headers.length; i++) {
        headertext[i]=[];
        for (var j = 0, headrow; headrow = headers[i].rows[0].cells[j]; j++) {
            var current = headrow;
            headertext[i].push(current.textContent);
        }
    } 

    for (var h = 0, tbody; tbody = tablebody[h]; h++) {
        for (var i = 0, row; row = tbody.rows[i]; i++) {
            for (var j = 0, col; col = row.cells[j]; j++) {
                col.setAttribute("data-th", headertext[h][j]);
            } 
        }
    }


</style>



<script type='text/javascript' src='js/jquery.js'></script>


<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>

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

<main class="content"> 

    <h1>TRANSFERÊNCIA PROTEGE </h1>

<?php
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if ($form && $form['button']):
    
    
    if($form['acao'] == "1"):
        unset($form['marca_t']);
        unset($form['modelo_t']);
        unset($form['ano_t']);
        unset($form['placa_t']);
        unset($form['cor_t']);
        unset($form['chassi_t']);
        unset($form['renavam_t']);
        unset($form['fipe_t']);
        unset($form['marca1']);
        unset($form['modelo1']);
        unset($form['ano1']);
        unset($form['fipe']);
        unset($form['valor']);
        unset($form['chassi']);
        unset($form['renavam']);
        unset($form['cor']);
        unset($form['placa']);
        unset($form['marca']);
        unset($form['modelo']);
        unset($form['ano']);
        unset($form['acao']);
        unset($form['button']);
    endif;
    
    
        if($form['acao'] == "2"):

        unset($form['acao']);
        unset($form['button']);

        
        $marca1 = explode("|", $form['marca1']);
        $form['marca'] = $marca1['0'];
        
        
        $modelo1 = explode("|", $form['modelo1']);
        $form['modelo'] = $modelo1['3'];
        
        
        $ano1 = explode("|", $form['ano1']);
        $form['ano'] = $ano1['4'];
        
                unset($form['marca1']);
        unset($form['modelo1']);
        unset($form['ano1']);
        
    endif;
    



    $atualiza = new Update();
    $atualiza->ExeUpdate("prevenda", $form, "WHERE id_venda= :p", "p={$_GET['id']}");
    $atualiza->getResult();
    if ($atualiza->getResult()):
        echo "<div class=\"alert alert-success\" role=\"alert\">Atualização realizada com sucesso</div>";
        echo "<meta http-equiv=\"refresh\" content=5;url=\"index.php?p=eprotege\">";
    else:
        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao atualizar</div>";
    endif;

endif;

echo "<pre>",

var_dump($form) , "</pre>";

$ver = new Read();
$ver->ExeRead("prevenda", "WHERE id_venda= :p", "p={$_GET['id']}");
$ver->getResult();
$puxavendedor = $ver->getResult()[0]['vendedor'];
$plano = $ver->getResult()[0]['plano'];
?>


    <form id="form1" name="form1" class="form" method="post" action="">


        <div class="col-md-12">
            <h3 class="page-header">Vendedor</h3>


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
        </div>
<div class="row">
        <div class="col-md-12">
            <h1 class="page-header">DADOS DO CLIENTE</h1>

        </div>
</div>
        <div class="row">
        <div class="col-md-4"><p>CLIENTE :</p>
            <input name="cliente" type="text" class="form-control" id="cliente" size="75" value="<?= $ver->getResult()[0]['cliente']; ?>" />
        </div>
        <div class="col-md-4">
            <p>DATA NASCIMENTO</p>
            <input name="data_nasc" type="text" id="data_nasc" class="form-control" size="10" value="<?= $ver->getResult()[0]['data_nasc']; ?>" onKeyPress="MascaraData(form.data_nasc)" />
        </div>
        <div class="col-md-4"><p>CPF: </p>
            <input type="text" class="form-control" name="cpf" id="cpf" value="<?= $ver->getResult()[0]['cpf']; ?>" onKeyPress="MascaraCPF(form.cpf)" />

        </div>
      
            


        <div class="col-md-4"><P>RG</P>
            <input type="text" class="form-control" name="rg" value="<?= $ver->getResult()[0]['rg']; ?>" id="rg" />
        </div>
        <div class="col-md-4"><p>TEL: Residencial.</p>
            <input name="telres" type="text" id="telres" class="form-control" value="<?= $ver->getResult()[0]['telres']; ?>" onKeyPress="MascaraTelefone(form.telres)" size="12" />  
        </div>

        <div class="col-md-4"><p>TEL: Celular</p>
            <input name="telcel" type="text" id="telcel" class="form-control" value="<?= $ver->getResult()[0]['telcel']; ?>" onKeyPress="MascaraTelefone(form.telcel)" size="12" />
        </div>
            
              </div>
        

        <div class="page-header">
            <h3>DADOS DE COBRANÇA</h3></div>
        
<!--            <tr> 
            <div><?php //include ("inc/cep.php"); ?> </td>
        </div>-->
        
          <div class="row">
        <div class="col-md-2">
            <p>CEP</p>
            <input name="cep" type="text" class="form-control" id="cep" value="<?= $ver->getResult()[0]['cep']; ?>"  maxlength="9"
                   onblur="pesquisacep(this.value);" />
        </div>


        <div class="col-md-9"  ><p>END.RES:</p>

            <input name="endereco" class="form-control" value="<?= $ver->getResult()[0]['endereco']; ?>" type="text" id="endereco" />
        </div>


        <div class="col-md-1"  ><P>Numero
                º</P>
            <input name="numero" type="text" class="form-control" id="numero" value="<?= $ver->getResult()[0]['numero']; ?>"  />
        </div>
              
          </div>

        <div class="col-md-3"  >
            <p>COMPLEMENTO:</p>
            <input name="complemento" class="form-control" type="text" id="complemento" value="<?= $ver->getResult()[0]['complemento']; ?>" />

        </div>

        <div class="col-md-3"  ><p>BAIRRO :</p>
            <input name="bairro" class="form-control" type="text" id="bairro" value="<?= $ver->getResult()[0]['bairro']; ?>"  />
        </div>

        <div class="col-md-3"  ><p>CIDADE:</p>
            <input name="cidade" class="form-control" type="text" id="cidade" value="<?= $ver->getResult()[0]['cidade']; ?>"  />     
        </div>

        <div class="col-md-3"  ><p>UF:</p>
            <input name="uf" class="form-control" type="text" id="uf" value="<?= $ver->getResult()[0]['uf']; ?>" />
        </div>

        <div class="col-md-12" ><p>EMAIL:</p>
            <input name="email" type="text" class="form-control" id="email" value="<?= $ver->getResult()[0]['email']; ?>" size="75" />
        </div>

        
        <div class="page-header"  ><h2>DADOS DO VEÍCULO</h2>
        </div>
        
        

        <div class="col-md-3"  ><p>MARCA: 
            </p>
            <input type="text" class="form-control" name="marca_t" id="marca" value="<?= $ver->getResult()[0]['marca']; ?>" />
        </div>

        <div class="col-md-3"  ><p>MODELO </p>
            <input type="text" class="form-control" name="modelo_t" id="modelo" value="<?= $ver->getResult()[0]['modelo']; ?>" />
        </div>

        <div class="col-md-3"  ><p>ANO:</p>
            <input name="ano_t" type="text" class="form-control" id="ano" size="5" value="<?= $ver->getResult()[0]['ano']; ?>" />  
        </div>

        <div class="col-md-3"  ><p>COR:</p>
            <input type="text" class="form-control" name="cor_t" id="cor" value="<?= $ver->getResult()[0]['cor']; ?>" />
        </div>

        <div class="col-md-3" ><p>CHASSI:</p>
            <input type="text" class="form-control" name="chassi_t" id="chassi" value="<?= $ver->getResult()[0]['chassi']; ?>" />
        </div>


        <div class="col-md-3"  ><p>RENAVAM:</p>
            <input type="text" class="form-control" name="renavam_t" id="renavam" value="<?= $ver->getResult()[0]['renavam']; ?>" />
        </div>

        <div class="col-md-3"  ><p>PLACA</p>
            <input type="text" class="form-control" name="placa_t" id="placa" value="<?= $ver->getResult()[0]['placa']; ?>" />
        </div>
        <div class="col-md-3"  ><p>FIPE</p>
            <input type="text" class="form-control" name="fipe_t" id="fipe" value="<?= $ver->getResult()[0]['fipe']; ?>" />
        </div>

        <!--  Aqui é os dados abiaxo do transferencia-->

        <div class="row">
        <div class="page-header">
          
        </div> </div>
        
        <div class="row">
            
    <div>
            <h3> DADOS DO VEÍCULO </h3>
            <a href="index.php?p=tprotege&id=<?= $_GET['id'] ?>&metodo=manual" class="btn btn-info">ALTERAR  MÉTODO</a>
        </div>

          <div class="form-group col-md-2">
            <label >VEICULO: </label>
            <select name="veiculo" class="form-control"> 
                <option> Selecione o veiculo</option>
                <option value="motos"> Moto</option>
                <option value="carros"> Carros</option>
                <option value="caminhoes"> Caminhão</option>

            </select>
        </div>
            
            <?php 
            if(isset($_GET['metodo']) && $_GET['metodo'] == "manual"){
            ?>
            
                    <div class="form-group col-md-2">
            <label >MARCA: </label>

            <input type="text" name="marca1" class="form-control" /> 
        </div>

        <div class="form-group col-md-2">
            <label>MODELO </label>
            <input type="text" id="modelo1" name="modelo1" class="form-control" /> 
            </label>
        </div>

        <div class="form-group col-md-2">
            <label>ANO:</label>
            <input type="text" name="ano1"  id="ano1" class="form-control" /> 

        </div>

        <div class="form-group col-md-2">
            <label>
                CODIGO FIPE:</label>
            <input type="text"  name="fipe" id="fipe" class="form-control" /> 
        </div>

        <div class="form-group col-md-2">
            <label>
                VALOR:</label>
            <input type="text"  name="valor" id="valor" class="form-control" /> 

        </div>
            
            
            <?php }else{ ?>

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

            <?php } ?>

        <div class="form-group col-md-3">
            <label>
                CHASSI:</label>
                <input type="text" name="chassi" id="chassi" class="form-control" />
            
        </div>

        <div class="form-group col-md-3">
            <label>
                RENAVAM:</label>
                <input type="text" name="renavam" id="renavam" class="form-control" />
            
        </div>

        <div class="form-group col-md-3">
            <label>COR:</label>
            
            <input type="text" name="cor" id="cor" class="form-control" />
        </div>
        
        <div class="form-group col-md-3">

            <label>PLACA</label>
            <input type="text" name="placa" id="placa" class="form-control" />
        </label>
        </div>        
            

<!--        <div class="form-group col-md-3">
            <label >MARCA: </label>

<?php
//string json contendo os dados de um funcionário



//$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/{$_GET['metodo']}/marcas.json");
//$json_str = json_decode($json_file, true);
//$itens = $json_str;
//
//
//
//
//
//echo "<select name=\"marca1\" class=\"form-control\" id=\"marca1\"> <option> SELECIONE A MARCA</option>";
//
//$d = "|";
//
//foreach ($itens as $e) {
//
//    echo "<option value=\"{$e['name']}{$d}{$e['id']}\">{$e['name']} </option>";
//}

//echo "</select>";
?> 
        </div>
        
        

        <div class="form-group col-md-3">
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


        <div class="form-group col-md-3">
            <label>CHASSI:</label>
            <input type="text" name="chassi" class="form-control" id="chassi" />

        </div>

        <div class="form-group col-md-3">
            <label>
                RENAVAM:</label>
            <input type="text" name="renavam" id="renavam" class="form-control" />

        </div>

        <div class="form-group col-md-3">
            <label>COR:</label>

            <input type="text" name="cor" id="cor" class="form-control" />
        </div>

        <div class="form-group col-md-3">

            <label>PLACA</label>
            <input type="text" name="placa" id="placa" class="form-control" />
            </label>
        </div>-->

        <!--             <div>
                        <div  >ASISTÊNCIA 24 HORAS</td>
                    </div>
                   <div>
                        <div  ><label>
                                <select name="assistencia" id="assistencia">
                                    <option>SELECIONE A OPÇÃO</option>
                                    <option value="0.00">Sem Assistencia R$0.00</option>
                                    <option value="14.90"> Opção 1 R$14.90</option>
                                    <option value="24.90">Opção 2 R$24.90</option>
                                </select>
                            </label></td>
                    </div>-->
        
         <div class="col-md-12"> . </div>

         <div class="page-header" ><h3>SELECIONE O PLANO</h3> </div>


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
    <a href="index.php?p=tprotege&id=<?= $_GET['id'] ?>"><p class="btn btn-primary"> Voltar </p></a>
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
    <a href="index.php?p=tprotege&id=<?= $_GET['id'] ?>&editarplano=sim"><p class="btn btn-primary"> Alterar Plano </p></a>
</div>
         
         </div>

   
        
        
        
       <?php } ?> 



         <div class="clear"> . </div>
            <div class="page-header" >
                <h3> DADOS DA TRANSFERÊNCIA 

                </h3> 
            </div>

            <div class="col-md-4" >
                <label>Taxa de Transferência</label>
                <input type="text" class="form-control" name="taxa" value="<?= $ver->getResult()[0]['taxa']; ?>" id="taxa"  />
            </div>
            <div class="col-md-4" >
                <label>Forma de pagamento Taxa</label> 
                <input name="pagto_taxa" type="text" class="form-control" id="pagto_taxa" value="<?= $ver->getResult()[0]['pagto_taxa']; ?>" size="75" />
            </div>

            <div class="col-md-4" ><label>Contrato</label>
                <input name="codigo"  class="form-control" type="text" value="<?= $ver->getResult()[0]['codigo']; ?>" id="codigo" />
            </div>

            <div>
                <div class="col-md-3" ><label>Status</label>


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
            ?> </option>
                        <option value="#">Selecione Opção</option>
                        <option value="1">Em Análise</option>
                        <option value="2">Agendado</option>
                        <option value="3">Instalado</option>
                        <option value="4">Cancelado</option>
                    </select></td>
                </div>
                <div>
                    <div class="col-md-3" ><label>data vencimento</label> 
                        <input name="vencimento" class="form-control" value="<?= $ver->getResult()[0]['vencimento']; ?>" type="text" id="vencimento" " />
                    </div>

                    
                    <div class="col-md-3"> 
                        <label>Contrato </label>
                        <select name="contrato" class='form-control'> 
                            <option value="<?= $ver->getResult()[0]['contrato']; ?>"> <?= $ver->getResult()[0]['contrato']; ?> </option>
                            <?php 
                            $vcontrato = new Read();
                            $vcontrato->ExeRead("contrato", "ORDER BY id_contrato ASC" );
                            $vcontrato->getResult();
                            foreach ( $vcontrato->getResult() as $value) {
          
                            ?>
                            <option value="<?= $value['id_contrato'] ?>"> <?= $value['contrato']  ?> (<?= $value['id_contrato'] ?>) </option>
                            
                            <?php } ?>
                        
                        </select>
                    </div>
                    
                    
                                        
                    <div class="col-md-3"> 
                        <label>Ação </label>
                        <select name="acao" class='form-control'> 
                            <option value="1"> Somente editar </option>
                            <option value="2"> Realizar transferencia </option>
                        
                        </select>
                    </div>

                    <div class="col-md-12" >
                        </br> </br>
                        <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
                        <input type="hidden" name="id_venda" value="<?= $ver->getResult()[0]['id_venda']; ?>" />
                        <input type="hidden" name="datatransf" value="<?= date("Y-m-d"); ?>" />
                        <input type="submit" name="button" id="button" value="CADASTRAR TRANSFERÊNCIA"  class="btn btn-primary"  />
                        </br> </br>
                    </div>


                    </form>



                    </main>