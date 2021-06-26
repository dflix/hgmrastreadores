<main>
    <div class="page-header"> 
        <h3> Indicações do Site </h3>


    </div> 

    <div class="col-md-12"> 

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Veiculo</th>
          
                    <th>Telefone 1</th>
                    <th>Telefone 2</th>
                    <th>Status</th>
                    <th>Historico</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
<!--   				<tr>
                            <td>Notebook 980</td>
                            <td>HP</td>
                            <td>R$ 1.800,00</td>
                    </tr>

                    </tr>-->


                <!--    <div class="background dez"> Data </div>
                    <div class="background vinte">Nome </div>
                    <div class="background vinte">Email </div>
                    <div class="background dez">Veiculo </div>
                    <div class="background dez">Valor </div>
                    <div class="background dez">Celular </div>
                    <div class="background dez">Telefone </div>
                    <div class="background dez">Vendedor </div>
                    <hr>
                    <div class="clear"> </div>-->

                <?php
                $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                $pager = new Pager('index.php?p=indicacaoafiliado&atual=', 'Primeira', 'Ultima', '1');
                $pager->ExePager($atual, 10);

                if ($_COOKIE['logprot_nivel'] == "5"):
                    $exibe = new Read();
                    $exibe->ExeRead("orcamento", "WHERE aff = :p ORDER BY id_orca DESC LIMIT :limit OFFSET :offset", "p={$_COOKIE['logprot_id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                else:

                    $exibe = new Read();
                    $exibe->ExeRead("orcamento", "ORDER BY id_lead DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                endif;



                foreach ($exibe->getResult() as $value) {
                    ?>
                    <tr>
                        <td> <?php
                            $data = $value['data'];
                            $exibedata = date('d/m/Y H:i:s', strtotime($data));
                            echo $exibedata;
                            ?>  </td>
                        <td><span class="branquinho">.</span><b><?php echo $value['nome']; ?> </b></td>
                        <td><span class="branquinho">.</span><?php echo $value['email']; ?> </td>
                        <td><span class="branquinho">.</span><?php echo $value['veiculo']; ?> </td>

                        <td><span class="branquinho">.</span><?php echo $value['telefone']; ?> </td>
                        <td><span class="branquinho">.</span><?php echo $value['celular']; ?> </td>
                        <td> <?php 
                        $status = $value['status'];
                            if ($status == "1"):
                                echo "<div class=\"alert alert-info\" role=\"alert\">Aguardando Atendimento</div>";
                            endif;
                            if ($status == "2"):
                                echo "<div class=\"alert alert-warning\" role=\"alert\">Em Atendimento</div>";
                            endif;
                            if ($status == "3"):
                                echo "<div class=\"alert alert-success\" role=\"alert\">Vendido</div>";
                            endif;
                            if ($status == "4"):
                                echo "<div class=\"alert alert-danger\" role=\"alert\">Não Vendido</div>";
                            endif;
                        
                        ?>  </td>
                        <td><span class="branquinho">.</span><?php echo $value['historico']; 
                            
                            ?>

                        </td>
                        
                        <td>  <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?= $value['id_orca'] ?>">
                                Editar
                            </button> </td>
                    </tr>


                    
                                  <!-- Janela -->
            <div class="modal fade" id="<?php echo $value['id_orca'] ?>" data-backdrop="static">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- cabecalho -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                            <h4 class="modal-title">DADOS DO CLIENTE <?php echo $value['id_orca'] ?></h4>
                        </div>

                        <!-- corpo -->
                        <div class="modal-body">

 

                            <section>
                                <h1 class="destaque">Hitorico</h1>
                            </section>
                            
                            <form action="" method="post"> 
                                <div class="form-group"> 
                                
                                </div>
                            
                            </form>




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
        $pager->ExePaginator("orcamento");

        echo $pager->getPaginator();
        ?>


    </div>

</main>


