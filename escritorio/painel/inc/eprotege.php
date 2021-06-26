


<?php
if (isset($_GET['del'])):
    echo "<p class=\"deletar\">Tem certeza que deseja remover esse registro <a href=\"index.php?p=eprotege&delyes={$_GET['del']}\">clique aqui</a> </br>";
    echo " <b>Cliente</b>{$_GET['del']} </p>";
endif;
if (isset($_GET['delyes'])):
    $deletar = new Delete();
    $deletar->ExeDelete("prevenda", "WHERE id_venda= :p", "p={$_GET['delyes']}");
    $deletar->getResult();
    if ($deletar->getResult()):
        echo "<p class=\"deletar\"> Registro {$_GET['delyes']} removido com sucesso </p>";
    endif;
endif;
?>

<section class="row"> 




    <div class="col-md-2"> </div>

    <div class="col-md-12"> 
        <div class="page-header">
            <h3>BUSCAR </h3>  

        </div>
        <div class="col-md-12">
            <form action="index.php?p=eprotege" name="buscar" method="POST" class="form-responsive form-inline" enctype="multipart-form/data">

                <div class="col-md-12">

                    <div class="radio">
                        <label>
                            <input type="radio" name="filtro" value="cliente"> NOME
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="filtro" value="codigo"> CONTRATO
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="filtro" value="placa"> PLACA
                        </label>
                    </div>

                    <input type="text" name="q" class="form-control"  />
                    <input type="submit" name="SendBuscar"  value="BUSCAR" class="btn btn-primary" />


                </div>

                <div class="col-md-3 ">



                </div>

                <div class="col-md-2">


                </div>

        </div>



        </form>
            
            <div class="col-md-12">
            
                <?php 
                $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                unset($filtro["sinistro"]);
                
               if($filtro["bo"]){
                
                $cad = new Create();
                $cad->exeCreate("sinistros", $filtro);
                $cad->getResult();
                if($cad->getResult()){
                  echo "<div class='alert alert-success'>Cadastro realizado com sucesso </div>";  
                }else{
                  echo "<div class='alert alert-danger'>Erro ao cadastrar sinistros </div>";  
                }
               }
                ?>
            
            </div>

    </div>

    </br>
</div>

<hr>

<div class="col-md-2"> </div>
<div class="col-md-10">
    <?php
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($filtro["q"])) {
        echo "<p style=\"text-align: center; padding:20px;\">Sua busca por <b>{$filtro['q']}</b> pelo filtro de <b>{$filtro['filtro']}</b> retornou seguinte resultados >><a href=\"index.php?p=eprotege\"> LIMPAR BUSCA</a></p>";
        ?>




        <table class="table-responsive table-bordered ">


            <thead>
                <tr>
                    <th>DATA</th>
                    <th>DADOS &
                        COBRANÇAS</th>
                    <th>CÓD</th>
                    <th>CLIENTE</th>
                    <th>PLANO</th>
                    <th>VEICULO</th>
                    <th>PLACA</th>
    <!--                <th>AFILIADO</th>-->
                    <th>VENDEDOR</th>

                    <th>STATUS</th>
                    <th>SINISTROS</th>
                    <th>TRANSF / EDIT</th>
                    
                    <th>IMPRESSOS</th>
    <!--                <th>DOC</th>-->
                    <th>EDIT</th>
                    <th>PDF</th>
                   



                </tr>
            <thead>




            <tbody>

                <?php
                // ESSA PARTE COM FILTRO DE PESQUISA

                $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                $pager = new Pager('index.php?p=eprotege&atual=', 'Primeira', 'Ultima', '1');
                $pager->ExePager($atual, 20);

                if ($_COOKIE['logprot_nivel'] == "2"):

                    $exibe = new Read();
                    $exibe->ExeRead("prevenda", "WHERE {$filtro['filtro']} LIKE '%' :link '%' AND vendedor = :v", "link={$filtro['q']}&v={$_COOKIE['logprot_id_usuario']}");
                    $exibe->getResult();

                else:
                    $exibe = new Read();
                    $exibe->ExeRead("prevenda", "WHERE {$filtro['filtro']} LIKE '%' :link '%'", "link={$filtro['q']}");
                    $exibe->getResult();

                endif;

                $i = 1;

                foreach ($exibe->getResult() as $value) {

                    $i++;

                    //$status= $value['status'];
                    $openmodal = $value['placa'];

                    $data = $value['data'];
                    $dataatual = date("d/m/Y H:i:s", strtotime($data));

                    $puxavendedor = $value['vendedor'];
                    $puxapag = $value['placa'];
                    $puxaat = $value['placa'];

                    $atendimento = new Read();
                    $atendimento->ExeRead("atendimento", "WHERE cliente = :p ORDER BY id DESC", "p={$puxaat}");
                    $atendimento->getResult();
                    if (empty($atendimento->getResult()[0]['data'])):
                        $historia = "Não possui atendimeto registrado";
                        $dataatendimento = "Nada consta";
                    else:
                        $historia = $atendimento->getResult()[0]['historia'];
                        $dataatendimento = date("d/m/Y", strtotime($atendimento->getResult()[0]['data']));
                    endif;


                    $pagamento = new Read();
                    $pagamento->ExeRead('pagos', "WHERE confcli = :p ORDER BY id DESC", "p={$puxapag}");
                    $pagamento->getResult();
                    if (isset($pagamento->getResult()[0]['data'])):
                        $datapagamento = $pagamento->getResult()[0]['data'];

                    endif;
                    if (empty($pagamento->getResult()[0]['data'])):

                        $datapagamentofinal = "Não consta pagamentos no sistema";
                    else:

                        $datapagamentofinal = date("d/m/Y", strtotime($datapagamento));

                    endif;


                    $vendedor = new Read();
                    $vendedor->ExeRead('usuario', "WHERE id_usuario = :p", "p={$puxavendedor}");
                    $vendedor->getResult();
                    if (isset($vendedor->getResult()[0]['nome'])):
                        $vend = $vendedor->getResult()[0]['nome'];
                    endif;
                    ?>

                    <tr>
                        <td><?= $dataatual ?></td>
            <!--                    <td><p class="botao2"><a href="index.php?p=dados&id=<?= $value['placa'] ?>" class="arruma" target="_blank" >TODOS<br>
                                    DADOS</a> </p>  -->
                        <td>



                            <button type="button" class="btn btn-info" 
                                    data-toggle="modal" data-target="#<?= $value['id_venda'] ?>">
                                <span class="glyphicon glyphicon-eye-open"> </span> DADOS
                            </button>
                            <hr>
                            <p class="botao2"> 

                                <?php
                                $puxaboleto = $value['placa'];

                                $boleto = new Read();
                                $boleto->ExeRead("boletosantander", "WHERE documento = :p", "p={$puxaboleto}");
                                $boleto->getResult();

                                if ($_COOKIE['logprot_nivel'] <> "2"):

                                    if (empty($boleto->getResult())):
                                        echo "<span><a href=\"index.php?p=cobrancasprotege&placa={$value['placa']}&plano={$value['plano']}\" class=\"btn btn-success\" target=\"_blank\">CADASTRAR </br> COBRANÇAS</a></span>";
                                    else:
                                        echo "<span><a href=\"index.php?p=cobrancasprotege&placa={$value['placa']}\" class=\"btn btn-info\" target=\"_blank\">VISUALIZAR </br>COBRANÇAS</a></span>";
                                    endif;

                                endif;
                                ?>

                            </p>
                        </td>
                        <td><?= $value['codigo'] ?></td>
                        <td><b><?= $value['cliente'] ?></b></td>
                        <td><?= $value['plano_desc'] ?> >> Valor R$ <?= $value['plano'] ?></td>
                        <td><b><?= $value['modelo'] ?></b></td>
                        <td><?= $value['placa'] ?></td>

                        <td><?= $vend ?></td>

                        <td><?php
                            if ($value['status'] == "1"):
                                echo $status = "<p class=\"aguardando\"> Em analise </p>";
                            endif;
                            if ($value['status'] == "2"):
                                echo $status = "<p class=\"agendado\"> Agendado </p>";
                            endif;
                            if ($value['status'] == "3"):
                                echo $status = "<p class=\"instalado\"> Instalado </p>";
                            endif;
                            if ($value['status'] == "4"):
                                echo $status = "<p class=\"cancelado\"> Cancelado </p>";
                            endif;
                            if ($value['status'] == "5"):
                                echo $status = "<p class=\"cancelado\"> Cancelado Retirado </p>";
                            endif;
                            if ($value['status'] == "6"):
                                echo $status = "<p class=\"cancelado\"> Pausado </p>";
                            endif;
                            ?></td>
                        
                        <td> 
                        
                                                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal<?= $value['id_venda'] ?>">
  Sinistros
</button>
                                                
     <?php 
     $verifica = new Read();
     $verifica->ExeRead("sinistros", "WHERE codigo = :a ", "a={$value['codigo']}");
     $verifica->getResult();
     
     if($verifica->getResult()){
     ?>
                                                <hr>
                                                <p class="alert alert-success">  <a href="sinistros.php?codigo=<?= $value['codigo'] ?>" target="_blank">Sinistros </a></p>
                                                
     <?php }else{ ?>
      
    <p class="alert alert-warning">  Não existe sinistros </p>
                                                
     <?php } ?>

<!-- Modal -->
<div class="modal fade" id="Modal<?= $value['id_venda'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sinistro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <div class="row">
      <form action="" method="post"> 
          
          <div class="col-md-6"> 
              <label> Contrato </label>
              <input type="text" name="codigo" value="<?= $value['codigo'] ?>" class="form-control" />
          </div>
          
          <div class="col-md-6"> 
              <label> BO </label>
              <input type="text" name="bo"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Veiculo </label>
              <input type="text" name="veiculo" value="<?= $value['veiculo'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Marca </label>
              <input type="text" name="marca" value="<?= $value['marca'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Modelo </label>
              <input type="text" name="modelo" value="<?= $value['modelo'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Ano</label>
              <input type="text" name="ano" value="<?= $value['ano'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Cor</label>
              <input type="text" name="cor" value="<?= $value['cor'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Placa</label>
              <input type="text" name="placa" value="<?= $value['placa'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Chassi</label>
              <input type="text" name="chassi" value="<?= $value['chassi'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Renavam</label>
              <input type="text" name="renavam" value="<?= $value['renavam'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Fipe</label>
              <input type="text" name="fipe" value="<?= $value['fipe'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-12"> <h3 class="border-bottom"> Ocorrência </h3> </div>
          <div class="col-md-12"> 
              <label> Ocorrência </label> 
              <textarea class="form-control" name="ocorrencia"> </textarea>
          </div>
          
          <div class="col-md-12"> <h3 class="border-bottom"> Serviços </h3> </div>
          <div class="col-md-12"> 
              <label> Serviços Realizados </label> 
              <textarea class="form-control" name="servicos"> </textarea>
          </div>
          
          <div class="col-md-12"> <h3 class="border-bottom"> Franquia e Pagamento </h3> </div>
          <div class="col-md-12"> 
              <label> Franquia e Condições de Pagamento </label> 
              <textarea class="form-control" name="pagamento"> </textarea>
          </div>
          
          <div class="col-md-12"> 
              <input type="hidden" name="data" value="<?= date("Y-m-d H:i:s") ?>" />
              <input type="submit" name="sinistro" value="cadastrar" class="btn btn-success" />
          </div>
              
          
          
      
      </form>
      </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
                        
                        </td>
                        
                        <td>

                            <p> <a  href="index.php?p=ttprotege&id=<?= $value['id_venda'] ?>"><span class="glyphicon glyphicon-user btn btn-primary">Titularidade</span></a> </p>

                            <hr>
                            <p> <a  href="index.php?p=tprotege&id=<?= $value['id_venda'] ?>"><span class="glyphicon glyphicon-road btn btn-success">Veículo</span></a> </p>


                        </td>
                        <td>

                            <p class="botaoimpresso"> <a class="glyphicon glyphicon-file btn btn-primary" href="adesao.php?id=<?= $value['id_venda'] ?>" target="blank">Adesão</a> </p>


                            <p class="botaoimpresso"> <a class="glyphicon glyphicon-file btn btn-primary" href="transferencia.php?id=<?= $value['id_venda'] ?>" target="blank">Titularidade</a> </p>


                            <p class="botaoimpresso"> <a class="glyphicon glyphicon-file btn btn-primary" href="transferencia.php?id=<?= $value['id_venda'] ?>&veiculo=sim" target="blank">Veiculo</a> </p>

                            
                            <p> <a class="glyphicon glyphicon-file btn btn-success" href="contrato-basic.php?id=<?= $value['id_venda'] ?>" target="blank">Contrato </a> </p>
                           
                            <p> <a class="glyphicon glyphicon-file btn btn-warning" href="recibo.php?id=<?= $value['id_venda'] ?>" target="blank">Recibo </a> </p>


                        </td>



                        <td><a href="index.php?p=aprotege&id=<?= $value['id_venda'] ?>"><span class="glyphicon glyphicon-pencil" style="font-size:25px;"> </span></a></td>

                        <?php
                        $verdoc = new Read();
                        $verdoc->ExeRead("documentos", "WHERE id_venda = :p", "p={$value['id_venda']}");
                        $verdoc->getResult();
                        if ($verdoc->getResult()) {
                            ?>
                            <td><a href="index.php?p=upload&id_venda=<?= $value['id_venda'] ?>&ref=protege" target="blank"><span class="glyphicon glyphicon-file" style="font-size:25px;"> </span> </a></td>

                        <?php } else { ?>

                            <td><p class="botao2 arruma"> <a href="index.php?p=upload&id_venda=<?= $value['id_venda'] ?>&ref=protege" target="blank" class="arruma">Enviar Doc </a> </p></td>

                        <?php } ?>

<!--                        <td><a href="index.php?p=eprotege&del=<?= $value['id_venda'] ?>"> <span class="glyphicon glyphicon-remove" style="font-size:25px; color:red;" ></span> </a> </td>-->

                    </tr>

                <div class="modal fade" id="<?= $value['id_venda'] ?>" data-backdrop="static">

                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- cabecalho -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                                <h4 class="modal-title">CLIENTE ID <?= $value['id_venda'] ?></h4>
                            </div>

                            <!-- corpo -->
                            <div class="modal-body">


                                <?php
                                $puxa = $value['id_venda'];

                                $dados = new Read();
                                $dados->ExeRead("prevenda", "WHERE id_venda = :p", "p={$puxa}");
                                $dados->getResult();
                                ?>

                                <section>
                                    <h1 class="destaque">DADOS DO CLIENTE</h1>
                                </section>

                                <label class="dez"> 
                                    <p class="background padding">Código </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['codigo']; ?>  </p>
                                </label>

                                <label class="vinte"> 
                                    <p class="background padding">Data de Adesão </p>
                                    <p class="padding"> <?= date("d/m/Y H:i:s", strtotime($dados->getResult()[0]['data'])); ?>  </p>
                                </label>

                                <label class="quarenta"> 
                                    <p class="background padding"> Cliente </p>
                                    <p class="padding">  <?= $dados->getResult()[0]['cliente']; ?> </p>

                                </label>
                                <label class="quinze"> 
                                    <p class="background padding"> CPF </p>
                                    <p class="padding">  <?= $dados->getResult()[0]['cpf']; ?> </p>

                                </label>
                                <label class="quinze"> 
                                    <p class="background padding"> RG </p>
                                    <p class="padding">  <?= $dados->getResult()[0]['rg']; ?> </p>

                                </label>



                                <label class="vinte"> 
                                    <p class="background padding"> MARCA </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['marca']; ?> </p>   
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> MODELO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['modelo']; ?> </p>   
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> ANO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['ano']; ?> </p>   
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> COR </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['cor']; ?> </p>   
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> PLACA </p>
                                    <p class="padding"> <?= $placacli = $dados->getResult()[0]['placa']; ?> </p>   
                                </label>

                                <label class="oitenta"> 
                                    <p class="background padding"> ENDEREÇO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['endereco']; ?> </p>
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> NUMERO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['numero']; ?> </p>
                                </label>

                                <label class="cinquenta"> 
                                    <p class="background padding"> COMPLEMENTO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['complemento']; ?> </p>
                                </label>
                                <label class="dez"> 
                                    <p class="background padding"> CEP </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['cep']; ?> </p>
                                </label>
                                <label class="quinze"> 
                                    <p class="background padding"> BAIRRO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['bairro']; ?> </p>
                                </label>
                                <label class="quinze"> 
                                    <p class="background padding"> CIDADE </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['cidade']; ?> </p>
                                </label>
                                <label class="dez"> 
                                    <p class="background padding"> ESTADO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['uf']; ?> </p>
                                </label>


                                <label class="cinquenta"> 
                                    <p class="background padding"> EMAIL </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['email']; ?> </p>
                                </label>
                                <label class="vinteecinco"> 
                                    <p class="background padding"> TELEFONE CELULAR </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['telcel']; ?> </p>
                                </label>
                                <label class="vinteecinco"> 
                                    <p class="background padding"> TELEFONE RESIDENCIAL </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['telres']; ?> </p>
                                </label>

                                <div class="clear"> </div>

                                <section> 
                                    <h1 class="destaque">DADOS DO PLANO</h1>
                                    <label class="trintaetres"> 
                                        <p class="background padding"> Tipo Plano</p>
                                        <p class="padding"> <?= $dados->getResult()[0]['tipo_plano']; ?> </p>
                                    </label>
                                    <label class="trintaetres"> 
                                        <p class="background padding"> Descrição Plano</p>
                                        <p class="padding"> <?= $dados->getResult()[0]['plano_desc']; ?> </p>
                                    </label>
                                    <label class="trintaetres"> 
                                        <p class="background padding"> Plano</p>
                                        <p class="padding"> <?= $dados->getResult()[0]['plano']; ?> </p>
                                    </label>
                                    <div class="clear"> </div>
                                </section>

                                <section>
                                    <h1 class="page-header">DADOS DE PAGAMENTO</h1>

                                    <?php
//        $dadospagto = new Read();
//        $dadospagto->ExeRead("baixasantander", "WHERE placa = :p", "p={$dados->getResult()[0]['placa']}");
//        $dadospagto->getResult();
//
//        if (empty($dadospagto->getResult()[0]['placa'])):
//
//            echo "Não consta pagamentos em nosso banco de dados";
//
//        else:
//
//
//            foreach ($dadospagto->getResult() as $value) {
//
//                $data = date("d/m/Y", strtotime($value['data']));
//                $valor = number_format($value['valor'] / 100, 2, ",", ".");
//
//                echo "<label class=\"cinquenta\"> 
//    <p class=\"background padding\"> CLIENTE </p>
//    <p class=\"padding\"> {$value['nome']} </p>
//</label>
//<label class=\"vinteecinco\"> 
//    <p class=\"background padding\"> DATA </p>
//    <p class=\"padding\"> {$data} </p>
//</label>
//<label class=\"vinteecinco\"> 
//    <p class=\"background padding\"> VALOR </p>
//    <p class=\"padding\">R$ {$valor} </p>
//</label>
//
//<div class=\"clear background padding\"> </div>";
//            }
//
//        endif;
                                    ?>




                                    <div class="col-md-12" style="background: #fff;">

                                        <div class="col-md-1 background"> Documento</div>
                                        <div class="col-md-1 background"> Parcela</div>
                                        <div class="col-md-2 background"> Valor</div>
                                        <div class="col-md-2 background"> Vencimento</div>
                                        <div class="col-md-2 background"> Pago</div>
                                        <div class="col-md-2 background"> Tipo</div>
                                        <div class="col-md-2 background" > Status</div>




                                        <?php
                                        $cadastradas = new Read();
                                        $cadastradas->ExeRead("boletosantander", "WHERE documento = :p ORDER BY parcela ASC", "p={$value['placa']}");
                                        $cadastradas->getResult();

                                        foreach ($cadastradas->getResult() as $value) {

                                            $vencimento = date("d/m/Y", strtotime($value['vencimento']));

                                            $tipo = $value['tipo'];

                                            if ($tipo == "1"):
                                                $tipo = "Monitoramento";
                                            endif;
                                            if ($tipo == "2"):
                                                $tipo = "Adesão";
                                            endif;
                                            if ($tipo == "3"):
                                                $tipo = "Outros";
                                            endif;

                                            $status = $value['status'];

                                            $valor = number_format($value['valor'] / 100, 2, ",", ".");



                                            echo "<div class=\"col-md-1\"> <span class=\"fontep\">{$value['documento']}</div>";
                                            echo "<div class=\"col-md-1\"> {$value['parcela']}  </div>";
                                            echo "<div class=\"col-md-2\"> R$ {$valor}</div>";
                                            echo "<div class=\"col-md-2\"> {$vencimento}</div>";
                                            echo "<div class=\"col-md-2\"> {$value['pg']}</div>";
                                            echo "<div class=\"col-md-2\"> {$tipo}</div>";
                                            if ($status == "1"):
                                                echo "<div class=\"col-md-2\"> <span class=\"vermelho\"> EM ABERTO </span> </div>";
                                            endif;
                                            if ($status == "2"):
                                                echo "<div class=\"col-md-2\"> <span class=\"verde\"> Pago </span></div>";
                                            endif;

                                            echo "<hr>";
                                        }
                                        ?>


                                    </div>





                                    <section> 
                                        <h1 class="destaque"> HISTÓRICO DE ATENDIMENTO</h1>

                                        <?php
                                        $exibeatendimento = new Read();
                                        $exibeatendimento->ExeRead("atendimentoprotege", "WHERE cliente = :p ORDER BY id DESC LIMIT :limit OFFSET :offset", "p={$puxa}&limit=5&offset={$pager->getOffset()}");
                                        $exibeatendimento->getResult();

                                        if (empty($exibeatendimento->getResult())):
                                            echo "Nao possui histórico de atendimento";
                                        else:


                                            foreach ($exibeatendimento->getResult() as $retorno) {
                                                $data = date("d/m/Y H:i:s", strtotime($retorno['data']));
                                                ?>



                                                <div class="vinteecinco"> 
                                                    <p class="background padding"> DATA </p>
                                                    <p class="padding"> <?php echo $data ?> </p>
                                                </div>
                                                <div class="vinteecinco"> 
                                                    <p class="background padding"> HISTÓRICO </p>
                                                    <p class="padding"> <?php echo $retorno['historia'] ?> </p>
                                                </div>

                                                <div class="vinteecinco"> 
                                                    <p class="background padding"> CATEGORIA </p>
                                                    <p class="padding"> <?php echo $retorno['categoria'] ?> </p>
                                                </div>
                                                <div class="vinteecinco"> 
                                                    <p class="background padding"> ATENDENTE </p>
                                                    <p class="padding"> <?php echo $retorno['atendente'] ?> </p>
                                                </div>

                                                <div class="clear"> </div><hr>


                                                <?php
                                            }
                                        endif;
                                        ?>


                                        </br>

                                        <h2> INSERIR HISTÓRICO DE ATENDIMENTO </h2>



                                        <form action="index.php?p=bprotege" method="post" class="form" enctype="multipart-form/data"> 

                                            <div class="col-md-12">
                                                <p>HISTÓRICO </p>
                                                <textarea name="historia" class="form-control">  </textarea>
                                            </div>

                                            <div class="col-md-12 form-inline"> 
                                                <p>TIPO DE ATENDIMENTO </p> 
                                                <label>
                                                    <input type="radio" name="categoria" value="geral"> Geral
                                                </label>
                                                <label>
                                                    <input type="radio" name="categoria" value="segundavia"> 2º Via Boleto
                                                </label>
                                                <label>
                                                    <input type="radio" name="categoria" value="manutencao"> Manutenção
                                                </label>
                                                <label>
                                                    <input type="radio" name="categoria" value="guincho"> Guincho
                                                </label>
                                                <label>
                                                    <input type="radio" name="categoria" value="sinistro"> Sinistros
                                                </label>
                                                <label>
                                                    <input type="radio" name="categoria" value="cancelamentos"> Cancelamentos
                                                </label>
                                                <label>
                                                    <input type="radio" name="categoria" value="teste"> Teste Mensal
                                                </label>
                                            </div>

                                            <div class="col-md-12"> 
                                                <input type="hidden" name="cliente" value="<?= $puxa; ?>" />
                                                <input type="hidden" name="email" value="<?= $dados->getResult()[0]['email']; ?>" />
                                                <input type="hidden" name="data" value="<?= date("Y-m-d H:i:s"); ?>" />
                                                <input type="hidden" name="atendente" value="<?= $_COOKIE['logprot_nome']; ?>" />
                                                <input type="hidden" name="protocolo" value="<?= date("hisYmd") . $puxa; ?>" />
                                                <input type="submit" name="cadastro" value="CADASTRAR" class="btn btn-primary" />
                                            </div>
                                        </form>
                                    </section>

                            </div>

                            <!-- rodape -->
                            <div class="modal-footer">

                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Cancelar
                                </button>


                            </div>

                        </div>
                    </div>

                </div>




            <?php } ?>




            </tbody>

        </table>


        <?php
        $pager->ExePaginator("prevenda");

        echo $pager->getPaginator();
        ?>




    <?php } else { ?>

        <!-- Aqui é parte resultados naturais-->

        <table class="table-responsive table-bordered ">


            <thead>
                <tr>
                    <th>DATA</th>
                    <th>DADOS &
                        COBRANÇAS</th>
                    <th>CÓD</th>
                    <th>CLIENTE</th>
                    <th>PLANO</th>
                    <th>VEICULO</th>
                    <th>PLACA</th>
                    <th>VENDEDOR</th>

                    <th>STATUS</th>
                    <th>SINISTROS</th>
                    <th>TRANSF / EDIT</th>
                    <th>IMPRESSOS</th>
    <!--                <th>DOC</th>-->
                    <th>EDIT</th>
                    <th>PDF</th>
                    



                </tr>
            <thead>




            <tbody>

                <?php
                // ESSA PARTE É SEM FILTRO DE PERSQUISA O RESULTADOS NATURAISS

                $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                $pager = new Pager('index.php?p=eprotege&atual=', 'Primeira', 'Ultima', '1');
                $pager->ExePager($atual, 5);

                if ($_COOKIE['logprot_nivel'] == "2"):

                    $exibe = new Read();
                    $exibe->ExeRead("prevenda", "WHERE vendedor = :v ORDER BY data DESC LIMIT :limit OFFSET :offset", "v={$_COOKIE['logprot_id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                else:
                    $exibe = new Read();
                    $exibe->ExeRead("prevenda", "ORDER BY data DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                endif;


                $i = 1;

                foreach ($exibe->getResult() as $value) {

                    $i++;

                    //$status= $value['status'];
                    $openmodal = $value['placa'];

                    $data = $value['data'];
                    $dataatual = date("d/m/Y H:i:s", strtotime($data));

                    $puxavendedor = $value['vendedor'];
                    $puxapag = $value['placa'];
                    $puxaat = $value['placa'];

                    $atendimento = new Read();
                    $atendimento->ExeRead("atendimento", "WHERE cliente = :p ORDER BY id DESC", "p={$puxaat}");
                    $atendimento->getResult();
                    if (empty($atendimento->getResult()[0]['data'])):
                        $historia = "Não possui atendimeto registrado";
                        $dataatendimento = "Nada consta";
                    else:
                        $historia = $atendimento->getResult()[0]['historia'];
                        $dataatendimento = date("d/m/Y", strtotime($atendimento->getResult()[0]['data']));
                    endif;


                    $pagamento = new Read();
                    $pagamento->ExeRead('pagos', "WHERE confcli = :p ORDER BY id DESC", "p={$puxapag}");
                    $pagamento->getResult();
                    if (isset($pagamento->getResult()[0]['data'])):
                        $datapagamento = $pagamento->getResult()[0]['data'];

                    endif;
                    if (empty($pagamento->getResult()[0]['data'])):

                        $datapagamentofinal = "Não consta pagamentos no sistema";
                    else:

                        $datapagamentofinal = date("d/m/Y", strtotime($datapagamento));

                    endif;


                    $vendedor = new Read();
                    $vendedor->ExeRead('usuario', "WHERE id_usuario = :p", "p={$puxavendedor}");
                    $vendedor->getResult();
                    if (isset($vendedor->getResult()[0]['nome'])):
                        $vend = $vendedor->getResult()[0]['nome'];
                    endif;
                    ?>

                    <tr>
                        <td><?= $dataatual ?></td>
            <!--                    <td><p class="botao2"><a href="index.php?p=dados&id=<?= $value['placa'] ?>" class="arruma" target="_blank" >TODOS<br>
                                    DADOS</a> </p>  -->
                        <td>



                            <button type="button" class="btn btn-info" 
                                    data-toggle="modal" data-target="#<?= $value['id_venda'] ?>">
                                <span class="glyphicon glyphicon-eye-open"> </span> DADOS
                            </button>
                            <hr>
                            <p class="botao2"> 

                                <?php
                                $puxaboleto = $value['placa'];

                                $boleto = new Read();
                                $boleto->ExeRead("boletosantander", "WHERE documento = :p", "p={$puxaboleto}");
                                $boleto->getResult();

                                if ($_COOKIE['logprot_nivel'] <> "2"):



                                    if (empty($boleto->getResult())):
                                        echo "<span><a href=\"index.php?p=cobrancasprotege&placa={$value['placa']}&plano={$value['plano']}\" class=\"btn btn-success\" target=\"_blank\">CADASTRAR </br> COBRANÇAS</a></span>";
                                    else:
                                        echo "<span><a href=\"index.php?p=cobrancasprotege&placa={$value['placa']}\" class=\"btn btn-info\" target=\"_blank\">VISUALIZAR </br>COBRANÇAS</a></span>";
                                    endif;

                                endif;
                                ?>

                            </p>
                        </td>
                        <td><?= $value['codigo'] ?></td>
                        <td><b><?= $value['cliente'] ?></b></td>
                        <td><?= $value['plano_desc'] ?> >> Valor R$ <?= $value['plano'] ?></td>
                        <td><b><?= $value['modelo'] ?></b></td>
                        <td><?= $value['placa'] ?></td>
                        <td><?= $vend ?></td>

                        <td><?php
                            if ($value['status'] == "1"):
                                echo $status = "<p class=\"aguardando\"> Em analise </p>";
                            endif;
                            if ($value['status'] == "2"):
                                echo $status = "<p class=\"agendado\"> Agendado </p>";
                            endif;
                            if ($value['status'] == "3"):
                                echo $status = "<p class=\"instalado\"> Instalado </p>";
                            endif;
                            if ($value['status'] == "4"):
                                echo $status = "<p class=\"cancelado\"> Cancelado </p>";
                            endif;
                            if ($value['status'] == "5"):
                                echo $status = "<p class=\"cancelado\"> Cancelado Retirado </p>";
                            endif;
                            if ($value['status'] == "6"):
                                echo $status = "<p class=\"cancelado\"> Pausado </p>";
                            endif;
                            ?></td>
                        
                        <td> 
                        
                        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal<?= $value['id_venda'] ?>">
  Sinistros
</button>
                         <?php 
     $verifica = new Read();
     $verifica->ExeRead("sinistros", "WHERE codigo = :a ", "a={$value['codigo']}");
     $verifica->getResult();
     
     if($verifica->getResult()){
     ?>
                        <hr>
                        <p class="alert alert-success">  <a href="sinistros.php?codigo=<?= $value['codigo'] ?>" target="_blank">Sinistros </a></p>
                                                
     <?php }else{ ?>
      
    <p class="alert alert-warning">  Não existe sinistros </p>
                                                
     <?php } ?>

<!-- Modal -->
<div class="modal fade" id="Modal<?= $value['id_venda'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sinistro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <div class="row">
      <form action="" method="post"> 
          
          <div class="col-md-6"> 
              <label> Contrato </label>
              <input type="text" name="codigo" value="<?= $value['codigo'] ?>" class="form-control" />
          </div>
          
          <div class="col-md-6"> 
              <label> BO </label>
              <input type="text" name="bo"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Veiculo </label>
              <input type="text" name="veiculo" value="<?= $value['veiculo'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Marca </label>
              <input type="text" name="marca" value="<?= $value['marca'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Modelo </label>
              <input type="text" name="modelo" value="<?= $value['modelo'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Ano</label>
              <input type="text" name="ano" value="<?= $value['ano'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Cor</label>
              <input type="text" name="cor" value="<?= $value['cor'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Placa</label>
              <input type="text" name="placa" value="<?= $value['placa'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Chassi</label>
              <input type="text" name="chassi" value="<?= $value['chassi'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Renavam</label>
              <input type="text" name="renavam" value="<?= $value['renavam'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-4"> 
              <label> Fipe</label>
              <input type="text" name="fipe" value="<?= $value['fipe'] ?>"  class="form-control" />
          </div>
          
          <div class="col-md-12"> <h3 class="border-bottom"> Ocorrência </h3> </div>
          <div class="col-md-12"> 
              <label> Ocorrência </label> 
              <textarea class="form-control" name="ocorrencia"> </textarea>
          </div>
          
          <div class="col-md-12"> <h3 class="border-bottom"> Serviços </h3> </div>
          <div class="col-md-12"> 
              <label> Serviços Realizados </label> 
              <textarea class="form-control" name="servicos"> </textarea>
          </div>
          
          <div class="col-md-12"> <h3 class="border-bottom"> Franquia e Pagamento </h3> </div>
          <div class="col-md-12"> 
              <label> Franquia e Condições de Pagamento </label> 
              <textarea class="form-control" name="pagamento"> </textarea>
          </div>
          
          <div class="col-md-12"> 
              <input type="hidden" name="data" value="<?= date("Y-m-d H:i:s") ?>" />
              <input type="submit" name="sinistro" value="cadastrar" class="btn btn-success" />
          </div>
              
          
          
      
      </form>
      </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
                        
                        </td>
                        
                        <td>
                            
                            <p> <a  href="index.php?p=ttprotege&id=<?= $value['id_venda'] ?>"><span class="glyphicon glyphicon-user btn btn-warning">Titularidade</span></a> </p>

                            <hr>

                            <p> <a  href="index.php?p=tprotege&id=<?= $value['id_venda'] ?>"><span class="glyphicon glyphicon-road btn btn-warning">Veículo</span></a> </p>


                        </td>
                        <td>

                            <p class="botaoimpresso"> <a class="glyphicon glyphicon-file btn btn-primary" href="adesao.php?id=<?= $value['id_venda'] ?>" target="blank">Adesão</a> </p>



                            <p class="botaoimpresso"> <a class="glyphicon glyphicon-file btn btn-primary" href="transferencia.php?id=<?= $value['id_venda'] ?>" target="blank">Titularidade</a> </p>



                            <p class="botaoimpresso"> <a class="glyphicon glyphicon-file btn btn-primary" href="transferencia.php?id=<?= $value['id_venda'] ?>&veiculo=sim" target="blank">Veiculo</a> </p>

                            <p> <a class="glyphicon glyphicon-file btn btn-success" href="contrato-basic.php?id=<?= $value['id_venda'] ?>" target="blank">Contrato </a> </p>
                             <p> <a class="glyphicon glyphicon-file btn btn-warning" href="recibo.php?id=<?= $value['id_venda'] ?>" target="blank">Recibo </a> </p>


                        </td>
                        <!--
                                            <td> 
                                                
                                                <p> <a class="glyphicon glyphicon-file btn btn-success" href="contrato-basic.php?id=<?= $value['id_venda'] ?>" target="blank">Contrato </a> </p>
                        
                                                
                        
                                            </td>-->

                        <td><a href="index.php?p=aprotege&id=<?= $value['id_venda'] ?>"><span class="glyphicon glyphicon-pencil" style="font-size:25px;"> </span></a></td>

                        <?php
                        $verdoc = new Read();
                        $verdoc->ExeRead("documentos", "WHERE id_venda = :p", "p={$value['id_venda']}");
                        $verdoc->getResult();
                        if ($verdoc->getResult()) {
                            ?>
                            <td><a href="index.php?p=upload&id_venda=<?= $value['id_venda'] ?>&ref=protege" target="blank"><span class="glyphicon glyphicon-file" style="font-size:25px;"> </span> </a></td>

                        <?php } else { ?>

                            <td><p class="botao2 arruma"> <a href="index.php?p=upload&id_venda=<?= $value['id_venda'] ?>&ref=protege" target="blank" class="arruma">Enviar Doc </a> </p></td>

                        <?php } ?>

                        <!--<td><a href="index.php?p=eprotege&del=<?= $value['id_venda'] ?>"> <span class="glyphicon glyphicon-remove" style="font-size:25px; color:red;" ></span> </a> </td>-->
                    </tr>

                <div class="modal fade" id="<?= $value['id_venda'] ?>" data-backdrop="static">

                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- cabecalho -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                                <h4 class="modal-title">CLIENTE <?= $value['id_venda'] ?></h4>
                            </div>

                            <!-- corpo -->
                            <div class="modal-body">


                                <?php
                                $puxa = $value['id_venda'];

                                $dados = new Read();
                                $dados->ExeRead("prevenda", "WHERE id_venda = :p", "p={$puxa}");
                                $dados->getResult();
                                ?>

                                <section>
                                    <h1 class="destaque">DADOS DO CLIENTE</h1>
                                </section>

                                <label class="dez"> 
                                    <p class="background padding">Código </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['codigo']; ?>  </p>
                                </label>

                                <label class="vinte"> 
                                    <p class="background padding">Data de Adesão </p>
                                    <p class="padding"> <?= date("d/m/Y H:i:s", strtotime($dados->getResult()[0]['data'])); ?>  </p>
                                </label>

                                <label class="quarenta"> 
                                    <p class="background padding"> Cliente </p>
                                    <p class="padding">  <?= $dados->getResult()[0]['cliente']; ?> </p>

                                </label>
                                <label class="quinze"> 
                                    <p class="background padding"> CPF </p>
                                    <p class="padding">  <?= $dados->getResult()[0]['cpf']; ?> </p>

                                </label>
                                <label class="quinze"> 
                                    <p class="background padding"> RG </p>
                                    <p class="padding">  <?= $dados->getResult()[0]['rg']; ?> </p>

                                </label>



                                <label class="vinte"> 
                                    <p class="background padding"> MARCA </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['marca']; ?> </p>   
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> MODELO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['modelo']; ?> </p>   
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> ANO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['ano']; ?> </p>   
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> COR </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['cor']; ?> </p>   
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> PLACA </p>
                                    <p class="padding"> <?= $placacli = $dados->getResult()[0]['placa']; ?> </p>   
                                </label>

                                <label class="oitenta"> 
                                    <p class="background padding"> ENDEREÇO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['endereco']; ?> </p>
                                </label>
                                <label class="vinte"> 
                                    <p class="background padding"> NUMERO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['numero']; ?> </p>
                                </label>

                                <label class="cinquenta"> 
                                    <p class="background padding"> COMPLEMENTO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['complemento']; ?> </p>
                                </label>
                                <label class="dez"> 
                                    <p class="background padding"> CEP </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['cep']; ?> </p>
                                </label>
                                <label class="quinze"> 
                                    <p class="background padding"> BAIRRO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['bairro']; ?> </p>
                                </label>
                                <label class="quinze"> 
                                    <p class="background padding"> CIDADE </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['cidade']; ?> </p>
                                </label>
                                <label class="dez"> 
                                    <p class="background padding"> ESTADO </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['uf']; ?> </p>
                                </label>


                                <label class="cinquenta"> 
                                    <p class="background padding"> EMAIL </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['email']; ?> </p>
                                </label>
                                <label class="vinteecinco"> 
                                    <p class="background padding"> TELEFONE CELULAR </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['telcel']; ?> </p>
                                </label>
                                <label class="vinteecinco"> 
                                    <p class="background padding"> TELEFONE RESIDENCIAL </p>
                                    <p class="padding"> <?= $dados->getResult()[0]['telres']; ?> </p>
                                </label>

                                <div class="clear"> </div>

                                <section> 
                                    <h1 class="destaque">DADOS DO PLANO</h1>
                                    <label class="trintaetres"> 
                                        <p class="background padding"> Tipo Plano</p>
                                        <p class="padding"> <?= $dados->getResult()[0]['tipo_plano']; ?> </p>
                                    </label>
                                    <label class="trintaetres"> 
                                        <p class="background padding"> Descrição Plano</p>
                                        <p class="padding"> <?= $dados->getResult()[0]['plano_desc']; ?> </p>
                                    </label>
                                    <label class="trintaetres"> 
                                        <p class="background padding"> Plano</p>
                                        <p class="padding"> <?= $dados->getResult()[0]['plano']; ?> </p>
                                    </label>
                                    <div class="clear"> </div>
                                </section>

                                <section>
                                    <div class="page-header">
                                        <h3 class="destaque">DADOS DE PAGAMENTO</h3>
                                    </div>

                                    <?php
//        $dadospagto = new Read();
//        $dadospagto->ExeRead("baixasantander", "WHERE placa = :p", "p={$dados->getResult()[0]['placa']}");
//        $dadospagto->getResult();
//
//        if (empty($dadospagto->getResult()[0]['placa'])):
//
//            echo "Não consta pagamentos em nosso banco de dados";
//
//        else:
//
//
//            foreach ($dadospagto->getResult() as $value) {
//
//                $data = date("d/m/Y", strtotime($value['data']));
//                $valor = number_format($value['valor'] / 100, 2, ",", ".");
//
//                echo "<label class=\"cinquenta\"> 
//    <p class=\"background padding\"> CLIENTE </p>
//    <p class=\"padding\"> {$value['nome']} </p>
//</label>
//<label class=\"vinteecinco\"> 
//    <p class=\"background padding\"> DATA </p>
//    <p class=\"padding\"> {$data} </p>
//</label>
//<label class=\"vinteecinco\"> 
//    <p class=\"background padding\"> VALOR </p>
//    <p class=\"padding\">R$ {$valor} </p>
//</label>
//
//<div class=\"clear background padding\"> </div>";
//            }
//
//        endif;
                                    ?>

                                    <div class="col-md-12" style="background: #fff;">

                                        <div class="col-md-1 background"> Documento</div>
                                        <div class="col-md-1 background"> Parcela</div>
                                        <div class="col-md-2 background"> Valor</div>
                                        <div class="col-md-2 background"> Vencimento</div>
                                        <div class="col-md-2 background"> Pago</div>
                                        <div class="col-md-2 background"> Tipo</div>
                                        <div class="col-md-2 background" > Status</div>




                                        <?php
                                        $cadastradas = new Read();
                                        $cadastradas->ExeRead("boletosantander", "WHERE documento = :p ORDER BY parcela ASC", "p={$value['placa']}");
                                        $cadastradas->getResult();

                                        foreach ($cadastradas->getResult() as $value) {

                                            $vencimento = date("d/m/Y", strtotime($value['vencimento']));

                                            $tipo = $value['tipo'];

                                            if ($tipo == "1"):
                                                $tipo = "Monitoramento";
                                            endif;
                                            if ($tipo == "2"):
                                                $tipo = "Adesão";
                                            endif;
                                            if ($tipo == "3"):
                                                $tipo = "Outros";
                                            endif;

                                            $status = $value['status'];

                                            $valor = number_format($value['valor'] / 100, 2, ",", ".");



                                            echo "<div class=\"col-md-1\"> <span class=\"fontep\">{$value['documento']}</div>";
                                            echo "<div class=\"col-md-1\"> {$value['parcela']}  </div>";
                                            echo "<div class=\"col-md-2\"> R$ {$valor}</div>";
                                            echo "<div class=\"col-md-2\"> {$vencimento}</div>";
                                            echo "<div class=\"col-md-2\"> {$value['pg']}</div>";
                                            echo "<div class=\"col-md-2\"> {$tipo}</div>";
                                            if ($status == "1"):
                                                echo "<div class=\"col-md-2\"> <span class=\"vermelho\"> EM ABERTO </span> </div>";
                                            endif;
                                            if ($status == "2"):
                                                echo "<div class=\"col-md-2\"> <span class=\"verde\"> Pago </span></div>";
                                            endif;

                                            echo "<hr>";
                                        }
                                        ?>


                                    </div>




                                </section>
                                <hr>
                                <section> 
                                    <h1 class="destaque"> HISTÓRICO DE ATENDIMENTO</h1>

                                    <?php
                                    $exibeatendimento = new Read();
                                    $exibeatendimento->ExeRead("atendimentoprotege", "WHERE cliente = :p ORDER BY id DESC LIMIT :limit OFFSET :offset", "p={$puxa}&limit=5&offset={$pager->getOffset()}");
                                    $exibeatendimento->getResult();

                                    if (empty($exibeatendimento->getResult())):
                                        echo "Nao possui histórico de atendimento";
                                    else:


                                        foreach ($exibeatendimento->getResult() as $retorno) {
                                            $data = date("d/m/Y H:i:s", strtotime($retorno['data']));
                                            ?>



                                            <div class="vinteecinco"> 
                                                <p class="background padding"> DATA </p>
                                                <p class="padding"> <?php echo $data ?> </p>
                                            </div>
                                            <div class="vinteecinco"> 
                                                <p class="background padding"> HISTÓRICO </p>
                                                <p class="padding"> <?php echo $retorno['historia'] ?> </p>
                                            </div>
                                            <div class="vinteecinco"> 
                                                <p class="background padding"> CATEGORIA </p>
                                                <p class="padding"> <?php echo $retorno['categoria'] ?> </p>
                                            </div>

                                            <div class="vinteecinco"> 
                                                <p class="background padding"> ATENDENTE </p>
                                                <p class="padding"> <?php echo $retorno['atendente'] ?> </p>
                                            </div>

                                            <div class="clear"> </div><hr>


                                            <?php
                                        }
                                    endif;
                                    ?>


                                    </br>

                                    <h2> INSERIR HISTÓRICO DE ATENDIMENTO </h2>

                                    <?php
                                    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                                    if ($form && $form['cadastro']):
                                        unset($form['cadastro']);

                                        $cadastra = new Create();
                                        $cadastra->ExeCreate("atendimentoprotege", $form);
                                        $cadastra->getResult();
                                        if ($cadastra->getResult()):
                                            echo "Atendimento cadastrado com sucesso operador <b> {$_COOKIE['logprot_nome']} </b>";

                                        else:
                                            echo "Erro ao cadastrar atendimento";
                                        endif;
                                    endif;

                                    var_dump($form);
                                    ?>

                                    <form action="index.php?p=bprotege" method="post" class="form" enctype="multipart-form/data"> 

                                        <div class="col-md-12">
                                            <p>HISTÓRICO </p>
                                            <textarea name="historia" class="form-control">  </textarea>
                                        </div>

                                        <div class="col-md-12 form-inline"> 
                                            <p>TIPO DE ATENDIMENTO </p> 
                                            <label>
                                                <input type="radio" name="categoria" value="geral"> Geral
                                            </label>
                                            <label>
                                                <input type="radio" name="categoria" value="segundavia"> 2º Via Boleto
                                            </label>
                                            <label>
                                                <input type="radio" name="categoria" value="manutencao"> Manutenção
                                            </label>
                                            <label>
                                                <input type="radio" name="categoria" value="guincho"> Assist 24hs
                                            </label>
                                            <label>
                                                <input type="radio" name="categoria" value="sinistro"> Sinistros
                                            </label>
                                            <label>
                                                <input type="radio" name="categoria" value="cancelamentos"> Cancelamentos
                                            </label>
                                            <label>
                                                <input type="radio" name="categoria" value="teste mensal"> Teste Mensal
                                            </label>
                                        </div>

                                        <div class="col-md-12"> 
                                            <input type="hidden" name="cliente" value="<?= $puxa; ?>" />
                                            <input type="hidden" name="email" value="<?= $dados->getResult()[0]['email']; ?>" />
                                            <input type="hidden" name="data" value="<?= date("Y-m-d H:i:s"); ?>" />
                                            <input type="hidden" name="atendente" value="<?= $_COOKIE['logprot_nome']; ?>" />
                                            <input type="hidden" name="protocolo" value="<?= date("hisYmd") . $puxa; ?>" />
                                            <input type="submit" name="cadastro" value="CADASTRAR" class="btn btn-primary" />
                                        </div>
                                    </form>
                                </section>


                            </div>

                            <!-- rodape -->
                            <div class="modal-footer">

                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Cancelar
                                </button>


                            </div>

                        </div>
                    </div>

                </div>




            <?php } ?>




            </tbody>

        </table>


        <?php
        $pager->ExePaginator("prevenda");

        echo $pager->getPaginator();
        ?>



        <!-- Janela -->





    <?php } ?>



</div>
</section>








<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
