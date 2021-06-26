		
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

<section class="content"> 


    <div class="row"> 

        <div class="col-md-12"> 
            <div class="page-header">
                <h3>BUSCAR </h3>  

            </div>

            <form action="index.php?p=eprotege" name="buscar" method="POST" class="form-responsive" enctype="multipart-form/data">

                <div class="col-md-2">
                    
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




                </div>

                <div class="col-md-10">


                    <input type="text" name="q" class="form-control col-md-6" />
                    </BR>
                    <input type="submit" name="SendBuscar" class="btn btn-primary" value="BUSCAR" class="btn btn-primary" />


                </div>



            </form>

        </div>


    </div>
    




    <?php
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($filtro)) {
        echo "<p style=\"text-align: center; padding:20px;\">Sua busca por <b>{$filtro['q']}</b> pelo filtro de <b>{$filtro['filtro']}</b> retornou seguinte resultados >><a href=\"index.php?p=eprotege\"> LIMPAR BUSCA</a></p>";
        ?>

    </section>


    <table class="table-responsive table-bordered ">

        <thead>
            <tr>
                <th>DATA</th>
                <th>DADOS &<br>
                    COBRANÇAS</th>
                <th>CÓD</th>
                <th>CLIENTE</th>
                <th>PLANO</th>
               <th>VEICULO</th>
                <th>PLACA</th>
                <th>VENDEDOR</th>
                <th>INSTALADOR</th>
                <th>STATUS</th>
                <th>TRANSF</th>
                <th>IMPRESSOS</th>
                <th>CONTRATOS</th>
                <th>EDIT</th>
                <th>PDF</th>



            </tr>
        <thead>

        <tbody>

            <?php
            $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
            $pager = new Pager('index.php?p=eprotege&atual=', 'Primeira', 'Ultima', '1');
            $pager->ExePager($atual, 5);

            $exibe = new Read();
            $exibe->ExeRead("prevenda", "WHERE {$filtro['filtro']} LIKE '%' :link '%' ORDER BY id_venda DESC", "link={$filtro['q']}");
            $exibe->getResult();

            foreach ($exibe->getResult() as $value) {


                $data = $value['data'];
                $dataatual = date("d/m/Y H:i:s", strtotime($data));

                $puxavendedor = $value['vendedor'];
                $puxapag = $value['placa'];
                $puxaat = $value['placa'];

                $atendimento = new Read();
                $atendimento->ExeRead("atendimento", "WHERE cliente = :p ORDER BY id DESC", "p={$puxaat}");
                $atendimento->getResult();
                if (!empty($atendimento->getResult()[0]['data'])):
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
                    <td>
                    <p class="botao2"><a href="index.php?p=dados&id=<?= $value['placa'] ?>" class="arruma" target="_blank" >TODOS<br>
                                DADOS</a> </p>  
                                <hr>
                                <p class="botao2"> 
                                
                                    <?php 
                                    
                                    $puxaboleto = $value['placa'];
                                    
                                    $boleto = new Read();
                                    $boleto->ExeRead("boletosantander", "WHERE documento = :p", "p={$puxaboleto}");
                                    $boleto->getResult();
                                    
                                    if(empty($boleto->getResult())):
                                        echo "<span><a href=\"index.php?p=cobrancasprotege&placa={$value['placa']}&plano={$value['plano']}\" class=\"arruma\" target=\"_blank\">CADASTRAR COBRANÇAS</a></span>";
                                    else:
                                        echo "<span><a href=\"index.php?p=cobrancasprotege&placa={$value['placa']}\" class=\"arruma\" target=\"_blank\">VISUALIZAR COBRANÇAS</a></span>";
                                    endif;
                                    
                                    ?>
                                
                                </p>
                    </td>
                    <td><?= $value['codigo'] ?></td>
                    <td><b><?= $value['cliente'] ?></b></td>
                    <td><?= $value['plano_desc'] ?>  >> Valor R$ <?= $value['plano'] ?></td>
                    <td><b><?= $value['modelo'] ?></b></td>
                    <td><?= $value['placa'] ?></td>
                    <td><?= $vend ?></td>
                    <td><?php
                        if (empty($value['instalador'])):

                            echo "Não agendado";

                        else:

                            echo $value['instalador'];
                        endif;
                        ?></td>
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

                        <p class="botaoimpresso"> <a class="arruma" href="index.php?p=tprotege&id=<?= $value['id_venda'] ?>">Transferência</a> </p>

                        <hr>

                        <p class="botaoimpresso"> <a class="arruma" href="transferencia.php?id=<?= $value['id_venda'] ?>" target="blank">Imprimir</a> </p>

                         <hr>

                    </td>
                    <td>

                        <p class="botaoimpresso"> <a class="arruma" href="adesao.php?id=<?= $value['id_venda'] ?>" target="blank">Adesão</a> </p>

                        <hr>

                        <p class="botaoimpresso"> <a class="arruma" href="vistoria.php?id=<?= $value['id_venda'] ?>" target="blank">Vistoria</a> </p>

                        <hr>

                    </td>

                    <td> 

                        <p class="botaoimpresso"> <a class="arruma" href="contrato.php?id=<?= $value['id_venda'] ?>" target="blank">Contrato 5%</a> </p>
                        <hr>
                        <p class="botaoimpresso"> <a class="arruma" href="contrato10.php?id=<?= $value['id_venda'] ?>" target="blank">Contrato 10%</a> </p>

                        <hr>
                        <p class="botaoimpresso"> <a class="arruma" href="contrato50.php?id=<?= $value['id_venda'] ?>" target="blank">Contrato 15%</a> </p>

                    </td>
                    <td><a href="index.php?p=aprotege&id=<?= $value['id_venda'] ?>" target="blank"><img src="img/editar.png" /></a></td>
                    <?php
                    $verdoc = new Read();
                    $verdoc->ExeRead("documentos", "WHERE placa = :p", "p={$value['placa']}");
                    $verdoc->getResult();
                    if ($verdoc->getResult()) {
                        ?>
                        <td><a href="index.php?p=upload&placa=<?= $value['placa'] ?>" target="blank"><img src="img/pdf.png" /></a></td>

                    <?php } else { ?>

                        <td> <p class="botao2 arruma"> <a href="index.php?p=upload&placa=<?= $value['placa'] ?>" target="blank" class="arruma">Enviar Doc </a> </p> </td>

                    <?php } ?>


                </tr>




            <?php } ?>


        </tbody>

    </table>


    <?php
    $pager->ExePaginator("prevenda");

    echo $pager->getPaginator();
    ?>




<?php } else { ?>

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
                <th>INSTALADOR</th>
               <th>STATUS</th>
                <th>TRANSF</th>
                <th>IMPRESSOS</th>
                <th>CONTRATOS</th>
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

            $exibe = new Read();
            $exibe->ExeRead("prevenda", "ORDER BY data DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
            $exibe->getResult();

            foreach ($exibe->getResult() as $value) {

                //$status= $value['status'];


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
                    <td><p class="botao2"><a href="index.php?p=dados&id=<?= $value['placa'] ?>" class="arruma" target="_blank" >TODOS<br>
                                DADOS</a> </p>  
                                <hr>
                                <p class="botao2"> 
                                
                                    <?php 
                                    
                                    $puxaboleto = $value['placa'];
                                    
                                    $boleto = new Read();
                                    $boleto->ExeRead("boletosantander", "WHERE documento = :p", "p={$puxaboleto}");
                                    $boleto->getResult();
                                    
                                    if(empty($boleto->getResult())):
                                        echo "<span><a href=\"index.php?p=cobrancasprotege&placa={$value['placa']}&plano={$value['plano']}\" class=\"arruma\" target=\"_blank\">CADASTRAR COBRANÇAS</a></span>";
                                    else:
                                        echo "<span><a href=\"index.php?p=cobrancasprotege&placa={$value['placa']}\" class=\"arruma\" target=\"_blank\">VISUALIZAR COBRANÇAS</a></span>";
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
                        if (empty($value['instalador'])):

                            echo "Não agendado";

                        else:

                            echo $value['instalador'];
                        endif;
                        ?></td>
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

                        <p class="botaoimpresso"> <a class="arruma" href="index.php?p=tprotege&id=<?= $value['id_venda'] ?>">Transferência</a> </p>

                        <hr>

                        <p class="botaoimpresso"> <a class="arruma" href="transferencia.php?id=<?= $value['id_venda'] ?>" target="blank">Imprimir</a> </p>

 <hr>
                    </td>
                    <td>

                        <p class="botaoimpresso"> <a class="arruma" href="adesao.php?id=<?= $value['id_venda'] ?>" target="blank">Adesão</a> </p>

                        <hr>

                        <p class="botaoimpresso"> <a class="arruma" href="vistoria.php?id=<?= $value['id_venda'] ?>" target="blank">Vistoria</a> </p>

                        <hr>

                    </td>

                    <td> 

                        <p class="botaoimpresso"> <a class="arruma" href="contrato.php?id=<?= $value['id_venda'] ?>" target="blank">Contrato 5%</a> </p>
                        <hr>
                        <p class="botaoimpresso"> <a class="arruma" href="contrato10.php?id=<?= $value['id_venda'] ?>" target="blank">Contrato 10%</a> </p>

                        <hr>
                        <p class="botaoimpresso"> <a class="arruma" href="contrato50.php?id=<?= $value['id_venda'] ?>" target="blank">Contrato 15%</a> </p>

                    </td>

                    <td><a href="index.php?p=aprotege&id=<?= $value['id_venda'] ?>"><img src="img/editar.png" /></a></td>

                    <?php
                    $verdoc = new Read();
                    $verdoc->ExeRead("documentos", "WHERE placa = :p", "p={$value['placa']}");
                    $verdoc->getResult();
                    if ($verdoc->getResult()) {
                        ?>
                        <td><a href="index.php?p=upload&placa=<?= $value['placa'] ?>" target="blank"><img src="img/pdf.png" /></a></td>

                    <?php } else { ?>

                        <td><p class="botao2 arruma"> <a href="index.php?p=upload&placa=<?= $value['placa'] ?>" target="blank" class="arruma">Enviar Doc </a> </p></td>

                    <?php } ?>


                </tr>


            <?php } ?>


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