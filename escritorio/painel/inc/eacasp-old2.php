



<?php
//require('../../_app/Config.inc.php');
?>

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



    <!-- fim da div busca -->

    <table class="table-responsive table-bordered" >

        <thead>
            <tr align="left" bgcolor="#333333" style="color:#FFF;" >
                <td width="3%" height="42">DATA</td>
                <td width="5%">TODOS<br>
                    DADOS</td>
                <td width="5%">CONTRATO</td>
                <td width="26%">CLIENTE</td>
                <td width="13%">VEICULO</td>
                <td width="9%">PLACA</td>
                <td width="7%">VENDEDOR</td>
                <td width="3%">STATUS</td>
                <td width="7%">TRANSF</td>
                <td width="8%">DOC</td>
                <td width="4%">EDIT</td>



            </tr>
        <thead>

        <tbody>

            <?php
            $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
            $pager = new Pager('index.php?p=eprotege&atual=', 'Primeira', 'Ultima', '1');
            $pager->ExePager($atual, 10);

            $exibe = new Read();
            $exibe->ExeRead("prevendaacasp", "WHERE {$filtro['filtro']} LIKE '%' :link '%'", "link={$filtro['q']}");
            $exibe->getResult();

            foreach ($exibe->getResult() as $value) {

                $data = $value['data'];
                $dataatual = date("d/m/Y H:i:s", strtotime($data));

                $puxavendedor = $value['vendedor'];
                $puxapag = $value['cliente'];
                $puxaat = $value['codigo'];

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


                $datapagamentofinal = date("d/m/Y", strtotime($datapagamento));


                $vendedor = new Read();
                $vendedor->ExeRead('usuario', "WHERE id_usuario = :p", "p={$puxavendedor}");
                $vendedor->getResult();
                if (isset($vendedor->getResult()[0]['nome'])):
                    $vend = $vendedor->getResult()[0]['nome'];
                endif;

                echo"      <tr style=\" font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#333;\">
           <td>{$dataatual}</td>
    <td>Todos os dados </td>
    <td>{$value['contrato']}</td>
    <td>{$value['associado']}</td>
    <td>{$value['marca_modelo1']}</td>
    <td>{$value['placa1']}</td>
    <td>{$vend}</td>
    <td>{$value['status']}</td>
    <td>
     </br>
        <p> <a href=\"index.php?p=tprotege&id={$value['id_venda']}\">Transferência</a> </p>
        </br>
        <hr>
        </br>
        <p> <a href=\"##\">Imprimir</a> </p>
         </br>
    
    </td>
    <td>
        </br>
        <p> <a href=\"##\">Adesão</a> </p>
        </br>
        <hr>
        </br>
        <p> <a href=\"##\">Vistoria</a> </p>
         </br>
        <hr>
        </br>
        <p> <a href=\"##\">Contrato</a> </p>
    </td>
    <td><a href=\"index.php?p=aprotege&placa={$value['placa1']}\"><img src=\"img/editar.png\" /></a></td>
   
      
          
          
      </tr>
      

    
    "
                ;
            }
            ?>


        </tbody>

    </table>


    <?php
    $pager->ExePaginator("prevenda");

    echo $pager->getPaginator();
    ?>




<?php }else { ?>

    <table class="table table-striped table-bordered table-hover table-condensed">

        <thead>
            <tr >
                <th width="3%" height="42">DATA</th>
                <th width="5%">TODOS<br>
                    DADOS</th>
                <th width="5%">CONTRATO</th>
                <th width="26%">CLIENTE</th>
                <th width="13%">VEICULO</th>
                <th width="9%">PLACA</th>
                <th width="7%">VENDEDOR</th>
                <th width="3%">STATUS</th>

                <th width="8%">DOC</th>
                <th width="4%">EDIT</th>



            </tr>
        <thead>

        <tbody>

            <?php
            // ESSA PARTE É SEM FILTRO DE PERSQUISA O RESULTADOS NATURAISS

            $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
            $pager = new Pager('index.php?p=eprotege&atual=', 'Primeira', 'Ultima', '1');
            $pager->ExePager($atual, 10);

            $exibe = new Read();
            $exibe->ExeRead("prevendaacasp", "WHERE vendedor = :p ORDER BY id_venda DESC LIMIT :limit OFFSET :offset", "p={$_SESSION['id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
            $exibe->getResult();

            foreach ($exibe->getResult() as $value) {

                $status = $value['status'];
//          if($status = "1"):
//              $status = "<p class=\"aguardando\"> Em analise </p>";
//          endif;
//          if($status = "2"):
//              $status = "<p class=\"agendado\"> Agendado </p>";
//          endif;
//          if($status = "3"):
//              $status = "<p class=\"instalado\"> Instalado </p>";
//          endif;
//          if($status = "4"):
//              $status = "<p class=\"cancelado\"> Cancelado </p>";
//          endif;

                $data = $value['data'];
                $dataatual = date("d/m/Y H:i:s", strtotime($data));

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

                echo"      <tr style=\" font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#333;\">
           <td>{$dataatual}</td>
    <td>Todos os dados </td>
    <td>{$value['contrato']}</td>
    <td>{$value['associado']}</td>
    <td>{$value['marca_modelo1']}</td>
    <td>{$value['placa1']}</td>
    <td>{$vend}</td>
    <td>{$status}</td>
    
    <td>
 </br>
        <p> <a href=\"adesao-acasp.php?id={$value['id_venda']}\" target=\"blank\">Adesão</a> </p>
        </br>
        <hr>
        </br>
        <p> <a href=\"vistoria-acasp.php?id={$value['id_venda']}\" target=\"blank\">Vistoria</a> </p>
         </br>
        <hr>
        </br>
        <p> <a href=\"regulamento.php?id={$value['id_venda']}\" target=\"blank\">Contrato</a> </p>
    </td>
    <td><a href=\"index.php?p=aacasp&placa={$value['placa1']}\"><span class=\"glyphicon glyphicon-pencil\" style=\"font-size:25px;\"> </span></a></td>
 
          
          
      </tr>
      
    	
    
    "
                ;
            }
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