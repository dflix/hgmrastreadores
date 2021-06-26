		
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



<?php
//require('../../_app/Config.inc.php');
?>

<?php
if (isset($_GET['del'])):
    echo "<p class=\"deletar\">Tem certeza que deseja remover esse registro <a href=\"index.php?p=eacasp&delyes={$_GET['del']}\">clique aqui</a> </br>";
    echo " <b>Cliente</b>{$_GET['del']} </p>";
endif;
if (isset($_GET['delyes'])):
    $deletar = new Delete();
    $deletar->ExeDelete("prevendaacasp", "WHERE id_venda= :p", "p={$_GET['delyes']}");
    $deletar->getResult();
    if ($deletar->getResult()):
        echo "<p class=\"deletar\"> Registro {$_GET['delyes']} removido com sucesso </p>";
    endif;
endif;
?>

<section class="buscar"> 

    <h1> BUSCAR ASSOCIAÇÃO </h1>

    <form action="index.php?p=eacasp" name="buscar" method="POST" class="form-inline" enctype="multipart-form/data"> 

        <div class="col-md-3">

            <div class="radio">
                <label>
                    <input type="radio" name="filtro" value="associado"> NOME
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="filtro" value="contrato"> CONTRATO
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="filtro" value="placa1"> PLACA
                </label>
            </div>




        </div>

        <!--                <div class="col-md-3"> 
                    <select name="filtro" class="form-control">
                        <option value="#"> SELECIONE  </option>
                        <option value="associado"> NOME </option>
                        <option value="contrato"> CONTRATO </option>
                        <option value="placa1"> PLACA </option>
                        
                    </select>
                    
                   
                    
                        </div>-->





        <div class="col-md-9"> 
            <input type="text" name="q" class="form-control" />
            <input type="submit" name="SendBuscar" value="BUSCAR" class="btn btn-primary" />
        </div>

        <div class="clear"> </div>


    </form>

    <?php
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($filtro)) {
        echo "<p style=\"text-align: center; padding:20px;\">Sua busca por <b>{$filtro['q']}</b> pelo filtro de <b>{$filtro['filtro']}</b> retornou seguinte resultados >><a href=\"index.php?p=eacasp\"> LIMPAR BUSCA</a></p>";
        ?>

    </section>



    <table class="table-responsive table-bordered ">
        <thead>
            <tr>
                <td width="3%" height="42">DATA</td>
                <td width="5%">TODOS<br>
                    DADOS</td>
                <td width="5%">COD</td>
                <td width="26%">CLIENTE</td>
                <td width="13%">VEICULO</td>
                <td width="12%">PLACA</td>
                <td width="15%">PROTEGE</td>
                <td width="7%">VENDEDOR</td>
                <td width="3%">STATUS</td>
                <td width="5%">TRANSF</td>
                <td width="5%">DOC</td>
                <td width="2%">EDIT</td>
                <td width="2%">PDF</td>
 
            </tr>
        <thead>

        <tbody>

            <?php
            // ESSA PARTE É BUSCA 



            $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
            $pager = new Pager('index.php?p=eacasp&atual=', 'Primeira', 'Ultima', '1');
            $pager->ExePager($atual, 5);
            
                        if ($_COOKIE['logprot_nivel'] == "2"):
                 $exibe = new Read();
            $exibe->ExeRead("prevendaacasp", "WHERE {$filtro['filtro']} LIKE '%' :link '%' AND vendedor = :c", "link={$filtro['q']}&c={$_COOKIE['logprot_id_usuario']}");
            $exibe->getResult();


            else:
                $exibe = new Read();
            $exibe->ExeRead("prevendaacasp", "WHERE {$filtro['filtro']} LIKE '%' :link '%'", "link={$filtro['q']}");
            $exibe->getResult();

            endif;

          

            foreach ($exibe->getResult() as $value) {


                if ($value['status'] == "1"):
                    $status = "<p class=\"aguardando\"> Em analise </p>";
                endif;
                if ($value['status'] == "2"):
                    $status = "<p class=\"agendado\"> Agendado </p>";
                endif;
                if ($value['status'] == "3"):
                    $status = "<p class=\"instalado\"> Instalado </p>";
                endif;
                if ($value['status'] == "4"):
                    $status = "<p class=\"cancelado\"> Cancelado </p>";
                endif;

                $data = $value['data'];
                $dataatual = date("d/m/Y", strtotime($data));

                $puxavendedor = $value['vendedor'];
                $puxapag = $value['associado'];
                $puxaat = $value['contrato'];

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
                    <td><?php echo $dataatual ?></td>
                    <td>                        <button type="button" class="btn btn-info" 
                                                        data-toggle="modal" data-target="#<?php echo $value['id_venda'] ?>">
                            <span class="glyphicon glyphicon-eye-open"> </span> DADOS
                        </button> 

                        <hr>
                        <p class="botao2"> 

                            <?php
                            $puxaboleto = $value['placa1'];

                            $boleto = new Read();
                            $boleto->ExeRead("boletoscaixa", "WHERE documento = :p", "p={$puxaboleto}");
                            $boleto->getResult();

                            if (empty($boleto->getResult())):
                                echo "<span><a href=\"index.php?p=cobrancasacasp&placa={$value['placa1']}&mescasp={$value['mesacasp']}&assist={$value['assist']}\" class=\"btn btn-success\" target=\"_blank\">CADASTRAR </br> COBRANÇAS</a></span>";
                            else:
                                echo "<span><a href=\"index.php?p=cobrancasacasp&placa={$value['placa1']}\" class=\"btn btn-info\" target=\"_blank\">VISUALIZAR </br>COBRANÇAS</a></span>";
                            endif;
                            ?>

                        </p>


                    </td>
                    <td><?php echo $value['contrato'] ?></td>
                    <td><b><?php echo $value['associado'] ?></b></td>
                    <td><?php echo $value['marca_modelo1'] ?></td>
                    <td><b><?php echo $value['placa1'] ?></b></td>
                    <td> 


                        <?php
                        $protege = new Read();
                        $protege->ExeRead("prevenda", "WHERE id_venda = :p", "p={$value['id_venda']}");
                        $protege->getResult();

                        if ($protege->getResult()):
                            echo "<p class=\"vermelho\"> Contrato {$protege->getResult()[0]['codigo']} </p><p class=\"verde\"> Usuario cadastrado </p> <p> <a href=\"index.php?p=aprotege&id={$protege->getResult()[0]['id_venda']}\" target=\"blank\">Editar os dados </a></p> ";
                        else:
                            echo "Usuario não cadastrado </br>Inserir numero contrato PROTEGE abaixo </br> "
                            . "<form action=\"inserirprotege.php\" method=\"post\" target=\"blank\" >"
                            . "<input type=\"text\" name=\"codigo\" class=\"form-control\"/>"
                            . "<input type=\"submit\" value=\"cadastra\" class=\"btn btn-primary\" />"
                            . "<input type=\"hidden\" name=\"id\" value=\"{$value['placa1']}\" />"
                            . "</form>"
                            . "<a href=\"inserirprotege.php?id={$value['placa1']}\" target=\"blank\">Inserir Dados </a>";

                        endif;
                        ?>

                    </td>
                    <td><?php echo $vend ?></td>
                    <td><?php echo $status ?></td>
                    <td>
                        </br>
                        <p> <a  href="index.php?p=ttacasp&id=<?php echo $value['id_venda'] ?>"> <span class="glyphicon glyphicon-user btn btn-warning">Titularidade</span></a> </p>
                        </br>
                        <hr>
                        </br>
                        <p> <a  href="index.php?p=tacasp&id=<?php echo $value['id_venda'] ?>"> <span class="glyphicon glyphicon-road btn btn-warning">Veiculo</span></a> </p>
                        </br>
                        <hr>
<!--                        </br>
                        <p > <a class="arruma btn-primary" href="transferencia-acasp.php?id=<?php //echo $value['id_venda'] ?>" target="blank">Imprimir Adesão</a> </p>
                        </br>-->
                        <p > <a class="arruma btn btn-primary" href="transferencia-acasp.php?id=<?php echo $value['id_venda'] ?>&veiculo=sim" target="blank">Titularidade</a> </p>
                          </br>
                        <p > <a class="arruma btn btn-primary" href="transferencia-acasp.php?id=<?php echo $value['id_venda'] ?>" target="blank">Veiculo</a> </p>
  </br>
<!--                        <p > <a class="arruma btn btn-primary" href="vistoria-acaspt.php?id=<?php //echo $value['id_venda'] ?>" target="blank">Imprimir Vistoria</a> </p>-->
  </br>
                    </td>
                    <td>
                        </br>
                        <p class="botaoimpresso"> <a class="arruma btn btn-success" href="adesao-acasp.php?id=<?php echo $value['id_venda'] ?>" target="_blank">Adesão</a> </p>
                        </br>
                        <hr>
                        </br>
                        <p class="botaoimpresso"> <a class="arruma btn btn-success" href="vistoria-acasp.php?id=<?php echo $value['id_venda'] ?>" target="blank">Vistoria</a> </p>
                        </br>
                        <hr>
                        </br>
                        <p class="botaoimpresso"> <a class="arruma btn btn-success" href="contrato-associacao.php?id=<?php echo $value['id_venda'] ?>" target="blank">Contrato</a> </p>
                    </td>
                    <td><a href="index.php?p=aacasp&id=<?php echo $value['id_venda'] ?>" target="blank"><span class="glyphicon glyphicon-pencil" style="font-size:25px;"> </span></a></td>
                    <?php
                    $verdoc = new Read();
                    $verdoc->ExeRead("documentos", "WHERE id_venda = :p", "p={$value['id_venda']}");
                    $verdoc->getResult();
                    if ($verdoc->getResult()) {
                        ?>
                        <td><a href="index.php?p=uploadacasp&id_venda=<?= $value['id_venda'] ?>&ref=associacao" target="blank" class="glyphicon glyphicon-file" style="font-size:25px;"></a></td>

                    <?php } else { ?>

                        <td> <p class="botao2 arruma"> <a href="index.php?p=uploadacasp&id_venda=<?= $value['id_venda'] ?>&categoria=documentos&ref=associacao" target="blank" class="arruma">Enviar Doc </a> </p> </td>

                    <?php } ?>

<!--                    <td> <a href="index.php?p=eacasp&del=<?= $value['id_venda'] ?>"><span class="glyphicon glyphicon-remove" style="font-size:25px; color:red;" ></span></a></td>-->

                </tr>

                <!-- Janela -->
            <div class="modal fade" id="<?php echo $value['id_venda'] ?>" data-backdrop="static">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- cabecalho -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                            <h4 class="modal-title">DADOS DO CLIENTE ID <?php echo $value['id_venda'] ?></h4>
                        </div>

                        <!-- corpo -->
                        <div class="modal-body">

                            <?php
                            $puxa = $value['id_venda'];

                            $dados = new Read();
                            $dados->ExeRead("prevendaacasp", "WHERE id_venda = :p", "p={$puxa}");
                            $dados->getResult();
                            ?>

                            <section>
                                <h1 class="destaque">DADOS DO CLIENTE</h1>
                            </section>

                            <label class="dez"> 
                                <p class="background padding">Cóntrato </p>
                                <p class="padding"> <?= $dados->getResult()[0]['contrato']; ?>  </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding">Data de Adesão </p>
                                <p class="padding"> <?= date("d/m/Y H:i:s", strtotime($dados->getResult()[0]['data'])); ?>  </p>
                            </label>

                            <label class="quarenta"> 
                                <p class="background padding"> Cliente </p>
                                <p class="padding">  <?= $dados->getResult()[0]['associado']; ?> </p>

                            </label>
                            <label class="quinze"> 
                                <p class="background padding"> CPF </p>
                                <p class="padding">  <?= $dados->getResult()[0]['cpf']; ?> </p>

                            </label>
                            <label class="quinze"> 
                                <p class="background padding"> RG </p>
                                <p class="padding">  <?= $dados->getResult()[0]['rg']; ?> </p>

                            </label>



                            <label class="quarenta"> 
                                <p class="background padding"> MARCA E MODELO </p>
                                <p class="padding"> <?= $dados->getResult()[0]['marca_modelo1']; ?> </p>   
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> ANO </p>
                                <p class="padding"> <?= $dados->getResult()[0]['ano1']; ?> </p>   
                            </label>
                            <label class="vinte"> 
                                <p class="background padding"> COR </p>
                                <p class="padding"> <?= $dados->getResult()[0]['cor1']; ?> </p>   
                            </label>
                            <label class="vinte"> 
                                <p class="background padding"> PLACA </p>
                                <p class="padding"> <?= $dados->getResult()[0]['placa1']; ?> </p>   
                            </label>

                            <label class="oitenta"> 
                                <p class="background padding"> ENDEREÇO </p>
                                <p class="padding"> <?= $dados->getResult()[0]['logradouro']; ?> </p>
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
                                <p class="padding"> <?= $dados->getResult()[0]['localidade']; ?> </p>
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

                            <label class="vinte"> 
                                <p class="background padding"> Mensalidade Associação </p>
                                <p class="padding"> <?= $dados->getResult()[0]['mesacasp']; ?> </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> Assistencia 24hs </p>
                                <p class="padding"> <?= $dados->getResult()[0]['assist']; ?> </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> Boleto Associação </p>
                                <p class="padding"> <?= $boleto = $dados->getResult()[0]['mesacasp'] + $dados->getResult()[0]['assist']; ?> </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> Rastreador </p>
                                <p class="padding"> <?= $dados->getResult()[0]['mesrastreador']; ?> </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> Mensalidade Total </p>
                                <p class="padding"> <?= $dados->getResult()[0]['mestotal']; ?> </p>
                            </label>

                            <div class="clear"> </div>



                            <section>
                                <h1 class="destaque">DADOS DE PAGAMENTO</h1>


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
                                    $cadastradas->ExeRead("boletosantander", "WHERE documento = :p ORDER BY parcela ASC", "p={$value['placa1']}");
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
                                        echo "<div class=\"col-md-2\"> " . date("d/m/Y", strtotime($value['pg'])) . "</div>";
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
                                $exibeatendimento->ExeRead("atendimentoacasp", "WHERE cliente = :p ORDER BY id DESC LIMIT :limit OFFSET :offset", "p={$puxa}&limit=5&offset={$pager->getOffset()}");
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
                                            <p class="background padding"> ATENDENTE </p>
                                            <p class="padding"> <?php echo $retorno['atendente'] ?> </p>
                                        </div>

                                        <div class="vinteecinco"> 
                                            <p class="background padding"> CATEGORIA </p>
                                            <p class="padding"> <?php echo $retorno['categoria'] ?> </p>
                                        </div>

                                        <div class="clear"> </div><hr>


                                        <?php
                                    }
                                endif;
                                ?>


                                </br>

                                <h2> INSERIR HISTÓRICO DE ATENDIMENTO </h2>



                                <form action="index.php?p=bacasp" method="post" enctype="multipart-form/data"> 

                                    <div class="col-md-12">
                                        <p>HISTÓRICO </p>
                                        <textarea name="historia" class="form-control"> </textarea>
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


        <?php }
        ?>







    </tbody>

    </table>


    <?php
    $pager->ExePaginator("prevenda");

    echo $pager->getPaginator();
    ?>


    <!-- daqui pra baixo é o codigo sem filtro -->

<?php } else { ?>

    <table class="table-responsive table-bordered ">

        <thead>
            <tr>
                <th>DATA</th>
                <th>TODOS<br>
                    DADOS</td>
                <th>COD</th>
                <th>CLIENTE</th>
                <th>VEICULO</th>
                <th>PLACA</th>
                <th>PROTEGE</th>
                <th>VENDEDOR</th>
                <th>STATUS</th>
                <th>TRANSF</th>
                <th>DOC</th>
                <th>EDIT</th>
                <th>PDF</th>
               



            </tr>
        <thead>

        <tbody>

            <?php
            // ESSA PARTE É SEM FILTRO DE PERSQUISA O RESULTADOS NATURAISS

            $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
            $pager = new Pager('index.php?p=eacasp&atual=', 'Primeira', 'Ultima', '1');
            $pager->ExePager($atual, 5);

            if ($_COOKIE['logprot_nivel'] == "2"):
                $exibe = new Read();
                $exibe->ExeRead("prevendaacasp", "WHERE vendedor = :p ORDER BY id_venda DESC LIMIT :limit OFFSET :offset", "p={$_COOKIE['logprot_id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                $exibe->getResult();


            else:
                $exibe = new Read();
                $exibe->ExeRead("prevendaacasp", "ORDER BY id_venda DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                $exibe->getResult();

            endif;

            foreach ($exibe->getResult() as $value) {


                if ($value['status'] == "1"):
                    $status = "<p class=\"aguardando\"> Em analise </p>";
                endif;
                if ($value['status'] == "2"):
                    $status = "<p class=\"agendado\"> Agendado </p>";
                endif;
                if ($value['status'] == "3"):
                    $status = "<p class=\"instalado\"> Instalado </p>";
                endif;
                if ($value['status'] == "4"):
                    $status = "<p class=\"cancelado\"> Cancelado </p>";
                endif;

                $data = $value['data'];
                $dataatual = date("d/m/Y", strtotime($data));

                $puxavendedor = $value['vendedor'];
                $puxapag = $value['associado'];
                $puxaat = $value['contrato'];

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


                $vendedor = new Read();
                $vendedor->ExeRead('usuario', "WHERE id_usuario = :p", "p={$puxavendedor}");
                $vendedor->getResult();
                if (isset($vendedor->getResult()[0]['nome'])):
                    $vend = $vendedor->getResult()[0]['nome'];
                endif;
                ?>

                <tr>
                    <td><?php echo $dataatual ?></td>
                    <td>                        <button type="button" class="btn btn-info" 
                                                        data-toggle="modal" data-target="#<?php echo $value['placa1'] ?>">
                            <span class="glyphicon glyphicon-eye-open"> </span> DADOS
                        </button> 

                        <hr>
                        <p class="botao2"> 

                            <?php
                            $puxaboleto = $value['placa1'];

                            $boleto = new Read();
                            $boleto->ExeRead("boletoscaixa", "WHERE documento = :p", "p={$puxaboleto}");
                            $boleto->getResult();

                            if (empty($boleto->getResult())):
                                echo "<span><a href=\"index.php?p=cobrancasacasp&placa={$value['placa1']}&mescasp={$value['mesacasp']}&assist={$value['assist']}\" class=\"btn btn-success\" target=\"_blank\">CADASTRAR </br> COBRANÇAS</a></span>";
                            else:
                                echo "<span><a href=\"index.php?p=cobrancasacasp&placa={$value['placa1']}\" class=\"btn btn-info\" target=\"_blank\">VISUALIZAR </br>COBRANÇAS</a></span>";
                            endif;
                            ?>

                        </p>

                    </td>
                    <td><?php echo $value['contrato'] ?></td>
                    <td><b><?php echo $value['associado'] ?></b></td>
                    <td><?php echo $value['marca_modelo1'] ?></td>
                    <td><b><?php echo $value['placa1'] ?></b></td>
                    <td> 


                        <?php
                        $protege = new Read();
                        $protege->ExeRead("prevenda", "WHERE placa = :p", "p={$value['placa1']}");
                        $protege->getResult();

                        if ($protege->getResult()):
                            echo "<p class=\"vermelho\"> Contrato {$protege->getResult()[0]['codigo']} </p><p class=\"verde\"> Usuario cadastrado </p> <p> <a href=\"index.php?p=aprotege&id={$protege->getResult()[0]['id_venda']}\" target=\"blank\">Editar os dados </a></p> ";
                        else:
                            echo "Usuario não cadastrado </br>Inserir numero contrato PROTEGE abaixo </br> "
                            . "<form action=\"inserirprotege.php\" method=\"post\" target=\"blank\" >"
                            . "<input type=\"text\" name=\"codigo\" class=\"form-control\"/>"
                            . "<input type=\"submit\" value=\"cadastra\" class=\"btn btn-primary\" />"
                            . "<input type=\"hidden\" name=\"id\" value=\"{$value['placa1']}\" />"
                            . "</form>"
                            . "<a href=\"inserirprotege.php?id={$value['placa1']}\" target=\"blank\">Inserir Dados </a>";

                        endif;
                        ?>

                    </td>
                    <td><?php echo $vend ?></td>
                    <td><?php echo $status ?></td>
                    <td>
                        </br>
                        <p> <a  href="index.php?p=ttacasp&id=<?php echo $value['id_venda'] ?>"> <span class="glyphicon glyphicon-user btn btn-warning">Titularidade</span></a> </p>
                        </br>
                      
                        </br>
                        <p> <a  href="index.php?p=tacasp&id=<?php echo $value['id_venda'] ?>"> <span class="glyphicon glyphicon-road btn btn-warning">Veiculo</span></a> </p>
                        </br>
                     
                        </br>
                        <p> <a  href="transferencia-acasp.php?id=<?php echo $value['id_venda'] ?>&veiculo=sim" target="blank" class="glyphicon glyphicon-file btn btn-primary">Titularidade</a> </p>
                        </br>
                      
                        </br>
                        <p> <a  href="transferencia-acasp.php?id=<?php echo $value['id_venda'] ?>" target="blank" class="glyphicon glyphicon-file btn btn-primary">Veiculo</a> </p>
                        </br>

                    </td>
                    <td>
                      
                        <span> <a class="glyphicon glyphicon-file btn btn-success" href="adesao-acasp.php?id=<?php echo $value['id_venda'] ?>" target="_blank">Adesão</a> </span>
                        <hr>

                        <span> <a class="glyphicon glyphicon-file btn btn-success" href="vistoria-acasp.php?id=<?php echo $value['id_venda'] ?>" target="blank">Vistoria</a> </span>
                        <hr>
                        <span> <a class="glyphicon glyphicon-file btn btn-success" href="vistoria-acaspt.php?id=<?php echo $value['id_venda'] ?>" target="blank">Vistoria Tranf</a> </span>
                        <hr>
                      
                        
                        <span> <a class="glyphicon glyphicon-file btn btn-success" href="contrato-associacao.php?id=<?php echo $value['id_venda'] ?>" target="blank">Contrato</a> </span>
                    </td>
                    <td><a href="index.php?p=aacasp&id=<?php echo $value['id_venda'] ?>" target="blank"><span class="glyphicon glyphicon-pencil" style="font-size:25px;"> </span></a></td>
                    <?php
                    $verdoc = new Read();
                    $verdoc->ExeRead("documentos", "WHERE id_venda = :p", "p={$value['id_venda']}");
                    $verdoc->getResult();
                    if ($verdoc->getResult()) {
                        ?>
                        <td><a href="index.php?p=uploadacasp&id_venda=<?= $value['id_venda'] ?>&ref=associacao" target="blank" class="glyphicon glyphicon-file" style="font-size:25px;"></a></td>

                    <?php } else { ?>

                        <td> <p class="botao2 arruma"> <a href="index.php?p=uploadacasp&id_venda=<?= $value['id_venda'] ?>&ref=associacao" target="blank" class="arruma">Enviar Doc </a> </p> </td>

                    <?php } ?>

                    <!--<td> <a href="index.php?p=eacasp&del=<?= $value['id_venda'] ?>"><span class="glyphicon glyphicon-remove" style="font-size:25px; color:red;" ></span></a></td>-->

                </tr>

                <!-- Janela -->
            <div class="modal fade" id="<?php echo $value['placa1'] ?>" data-backdrop="static">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- cabecalho -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                            <h4 class="modal-title">DADOS DO CLIENTE <?php echo $value['placa1'] ?></h4>
                        </div>

                        <!-- corpo -->
                        <div class="modal-body">

                            <?php
                            $puxa = $value['id_venda'];

                            $dados = new Read();
                            $dados->ExeRead("prevendaacasp", "WHERE id_venda = :p", "p={$puxa}");
                            $dados->getResult();
                            ?>

                            <section>
                                <h1 class="destaque">DADOS DO CLIENTE</h1>
                            </section>

                            <label class="dez"> 
                                <p class="background padding">Cóntrato </p>
                                <p class="padding"> <?= $dados->getResult()[0]['contrato']; ?>  </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding">Data de Adesão </p>
                                <p class="padding"> <?= date("d/m/Y H:i:s", strtotime($dados->getResult()[0]['data'])); ?>  </p>
                            </label>

                            <label class="quarenta"> 
                                <p class="background padding"> Cliente </p>
                                <p class="padding">  <?= $dados->getResult()[0]['associado']; ?> </p>

                            </label>
                            <label class="quinze"> 
                                <p class="background padding"> CPF </p>
                                <p class="padding">  <?= $dados->getResult()[0]['cpf']; ?> </p>

                            </label>
                            <label class="quinze"> 
                                <p class="background padding"> RG </p>
                                <p class="padding">  <?= $dados->getResult()[0]['rg']; ?> </p>

                            </label>



                            <label class="quarenta"> 
                                <p class="background padding"> MARCA E MODELO </p>
                                <p class="padding"> <?= $dados->getResult()[0]['marca_modelo1']; ?> </p>   
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> ANO </p>
                                <p class="padding"> <?= $dados->getResult()[0]['ano1']; ?> </p>   
                            </label>
                            <label class="vinte"> 
                                <p class="background padding"> COR </p>
                                <p class="padding"> <?= $dados->getResult()[0]['cor1']; ?> </p>   
                            </label>
                            <label class="vinte"> 
                                <p class="background padding"> PLACA </p>
                                <p class="padding"> <?= $dados->getResult()[0]['placa1']; ?> </p>   
                            </label>

                            <label class="oitenta"> 
                                <p class="background padding"> ENDEREÇO </p>
                                <p class="padding"> <?= $dados->getResult()[0]['logradouro']; ?> </p>
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
                                <p class="padding"> <?= $dados->getResult()[0]['localidade']; ?> </p>
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

                            <label class="vinte"> 
                                <p class="background padding"> Mensalidade Associação </p>
                                <p class="padding"> <?= $dados->getResult()[0]['mesacasp']; ?> </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> Assistencia 24hs </p>
                                <p class="padding"> <?= $dados->getResult()[0]['assist']; ?> </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> Boleto Associação </p>
                                <p class="padding"> <?= $boleto = $dados->getResult()[0]['mesacasp'] + $dados->getResult()[0]['assist']; ?> </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> Rastreador </p>
                                <p class="padding"> <?= $dados->getResult()[0]['mesrastreador']; ?> </p>
                            </label>

                            <label class="vinte"> 
                                <p class="background padding"> Mensalidade Total </p>
                                <p class="padding"> <?= $dados->getResult()[0]['mestotal']; ?> </p>
                            </label>

                            <div class="clear"> </div>


                            <section>
                                <h1 class="destaque">DADOS DE PAGAMENTO</h1>

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
                                    $cadastradas->ExeRead("boletoscaixa", "WHERE documento = :p ORDER BY parcela ASC", "p={$value['placa1']}");
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
                                $exibeatendimento->ExeRead("atendimentoacasp", "WHERE cliente = :p ORDER BY id DESC LIMIT :limit OFFSET :offset", "p={$puxa}&limit=5&offset={$pager->getOffset()}");
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
                                            <p class="background padding"> ATENDENTE </p>
                                            <p class="padding"> <?php echo $retorno['atendente'] ?> </p>
                                        </div>
                                        <div class="vinteecinco"> 
                                            <p class="background padding"> CATEGORIA </p>
                                            <p class="padding"> <?php echo $retorno['categoria'] ?> </p>
                                        </div>

                                        <div class="clear"> </div><hr>


                                        <?php
                                    }
                                endif;
                                ?>


                                </br>

                                <h2> INSERIR HISTÓRICO DE ATENDIMENTO </h2>



                                <form action="index.php?p=bacasp" method="post" enctype="multipart-form/data"> 

                                    <div class="col-md-12">
                                        <p>HISTÓRICO </p>
                                        <textarea name="historia" class="form-control"> </textarea>
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
                                            <input type="radio" name="categoria" value="teste mensal"> Teste Mensal
                                        </label>
                                    </div>


                                    <div class="col-md-12"> 
                                        <input type="hidden" name="cliente" value="<?= $puxa; ?>" />
                                        <input type="hidden" name="data" value="<?= date("Y-m-d H:i:s"); ?>" />
                                        <input type="hidden" name="atendente" value="<?= $_COOKIE['logprot_nome']; ?>" />
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



            

        <?php }
        ?>







    </tbody>

    </table>


    <?php
    $pager->ExePaginator("prevenda");

    echo $pager->getPaginator();
    ?>
<?php } ?>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var recipientnome = button.data('whatevernome')
        var recipientdetalhes = button.data('whateverdetalhes')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('ID do Curso: ' + recipient)
        modal.find('#id_curso').val(recipient)
        modal.find('#recipient-name').val(recipientnome)
        modal.find('#detalhes-text').val(recipientdetalhes)
    })
</script>