<main>
    <div class="page-header"> 
        <h3> Indicações dos Afiliados </h3>

        <?php 
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if($filtro):
            
            $up = new Update();
        $up->ExeUpdate("leadafiliado", $filtro, "WHERE id_lead = :a", "a={$filtro['id_lead']}");
        $up->getResult();
        
        if($up->getResult()):
           echo "<div class=\"alert alert-success\" role=\"alert\">Atualizado com sucesso</div>"; 
            else:
           echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao atualizar</div>";  
        endif;
            
            
        endif;
        
        //var_dump($filtro);
        ?>

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
                    <th>Afiliado</th>
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

                if ($_COOKIE['logprot_nivel'] == "2"):
                    $exibe = new Read();
                    $exibe->ExeRead("leadafiliado", "WHERE relacionado = :p ORDER BY id_lead DESC LIMIT :limit OFFSET :offset", "p={$_COOKIE['logprot_id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                else:

                    $exibe = new Read();
                    $exibe->ExeRead("leadafiliado", "ORDER BY id_lead DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
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

                        <td><span class="branquinho">.</span><?php echo $value['tel1']; ?> </td>
                        <td><span class="branquinho">.</span><?php echo $value['tel2']; ?> </td>
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
                        <td> <?php //echo $value['afiliado']; 
                        $af = new Read();
                        $af->ExeRead("usuario", "WHERE id_usuario = :a", "a={$value['afiliado']}");
                        $af->getResult();
                        
                        echo $af->getResult()[0]['nome'];
                        ?> </td>
                        <td><span class="branquinho">.</span><?php echo $value['historico']; 
                            
                            ?>

                        </td>
                        
                        <td>  <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?= $value['id_lead'] ?>">
                                Editar
                            </button> </td>
                    </tr>


                    
                                  <!-- Janela -->
            <div class="modal fade" id="<?php echo $value['id_lead'] ?>" data-backdrop="static">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- cabecalho -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                            <h4 class="modal-title">DADOS DO CLIENTE <?php echo $value['id_lead'] ?></h4>
                        </div>

                        <!-- corpo -->
                        <div class="modal-body">

 

                            <section>
                                <h1 class="destaque">Histórico</h1>
                            </section>
                            
                            <div class="col-md-3">Cliente: <?php echo $value['nome'] ?>  </div>
                            <div class="col-md-2">Email: <?php echo $value['email'] ?>  </div>
                            <div class="col-md-2">Telefone 1: <?php echo $value['tel1'] ?>  </div>
                            <div class="col-md-2">Telefone 2: <?php echo $value['tel2'] ?>  </div>
                            <div class="col-md-3">Veiculo: <?php echo $value['veiculo'] ?>  </div>
                            
                            <form action="" method="post"> 
                                <div class="form-group">
                                    <textarea class="form-control" name="historico"> </textarea>
                                    
                                </div>
                                <input type="hidden" name="id_lead" value="<?php echo $value['id_lead'] ?>" />
                                <input type="submit" class="btn btn-primary" value="alterar historico" />
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
        $pager->ExePaginator("leadafiliado");

        echo $pager->getPaginator();
        ?>


    </div>

</main>


