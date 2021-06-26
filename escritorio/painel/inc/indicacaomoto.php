<main>
    <div class="page-header"> 
        <h3> Indicações MOTO </h3>


    </div> 

    <div class="col-md-12"> 

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Veiculo</th>
                    <th>Valor</th>
                    <th>Celular</th>
                    <th>Telefone</th>
                    <th>Vendedor</th>
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
                $pager = new Pager('index.php?p=indicacaomoto&atual=', 'Primeira', 'Ultima', '1');
                $pager->ExePager($atual, 10);

                if ($_COOKIE['logprot_nivel'] == "2"):
                    $exibe = new Read();
                    $exibe->ExeRead("lead", "WHERE vendedor = :p ORDER BY id_lead DESC LIMIT :limit OFFSET :offset", "p={$_COOKIE['logprot_id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                else:

                    $exibe = new Read();
                    $exibe->ExeRead("lead", "ORDER BY id_lead DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
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
                        <td><span class="branquinho">.</span><b><?php
                                $puxaplano = $value['valor'];


                                if ($puxaplano == 7):
                                    echo "R$0.000,00 à R$40.000,00 ";
                                endif;
                                if ($puxaplano == 8):
                                    echo "R$40.000,00 à R$50.000,00 ";
                                endif;
                                if ($puxaplano == 9):
                                    echo "R$50.000,00 à R$70.000,00 ";
                                endif;
                                if ($puxaplano == 10):
                                    echo "R$70.000,00 à R$90.000,00 ";
                                endif;
                                if ($puxaplano == 11):
                                    echo "R$90.000,00 à R$120.000,00 ";
                                endif;
                                if ($puxaplano == 12):
                                    echo "R$120.000,00 à R$150.000,00 ";
                                endif;
                                ?> </b> </td>
                        <td><span class="branquinho">.</span><?php echo $value['celular']; ?> </td>
                        <td><span class="branquinho">.</span><?php echo $value['telefone']; ?> </td>
                        <td><span class="branquinho">.</span><?php
                            $vend = new Read();
                            $vend->ExeRead("usuario", "WHERE id_usuario= :p", "p={$value['vendedor']}");
                            $vend->getResult();
                            
                            if($vend->getResult()):
                                echo "<p class=\"azul\">{$vend->getResult()[0]['nome']}</p>";
                                else:
                                echo "<p class=\"azul\"><b>Selecione Vendedor</b></p>";
                            endif;

                            
                            ?>

                            <?php
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if($form && $form['indicacao']):
            unset($form['indicacao']);
            
        $indicar = new Update();
        $indicar->ExeUpdate("lead", $form, "WHERE id_lead= :p", "p={$form['id_lead']}");
        $indicar->getResult();
        
                if($indicar->getResult()):
            echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=indicacaomoto&moto=yes\">";
        endif;
        
            
        endif;
                            ?>

                                  <form action="" method="post" class="form"> 
                                        
                                        <label> 
                                            <select name="vendedor" class="form-control"> 
                                                <option value="#"> Selecione Vendedor</option>
                            <?php
                            $loopvend = new Read();
                            $loopvend->ExeRead("usuario", "WHERE nivel = :p", "p=2");
                            $loopvend->getResult();

                            foreach ($loopvend->getResult() as $valor) {
                                echo "<option value=\"{$valor['id_usuario']}\"> {$valor['nome']}</option>";
                            }
                            ?>
                              
                                            </select>
                                        </label>
                                        <input type="hidden" name="id_lead" value="<?php echo $value['id_lead']; ?>" />
                                        
                                        <input type="submit" value="enviar" name="indicacao" class="btn btn-success" />
                                    
                                    </form>





                        </td>
                    </tr>



                <?php } ?>

            </tbody>
        </table>

        <?php
        $pager->ExePaginator("lead");

        echo $pager->getPaginator();
        ?>


    </div>

</main>


