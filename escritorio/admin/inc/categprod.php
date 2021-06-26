<section class="main"> 
    <header> 
        <h1>Categorias de Produtos</h1>
        <?php
        require('models/AdminProdCateg.php');

        $ver = new AdminProdCateg;
        // var_dump($ver );
        
//        $postatualiza = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//        if(!empty($postatualiza['ATUALIZAR'])):
//            unset($postatualiza['ATUALIZAR']);
//        endif;
//        var_dump($postatualiza);

        if (!empty($_GET['atualizar'])):

            $carrega = new Read;
            $carrega->ExeRead('ws_categprod', "WHERE categprod_id = :p", "p={$_GET['atualizar']}");
            $carrega->getResult();

        endif;
        ?>
    </header>

    <article>
        <form name="postform" action="" method="post">
            <label> 
                <p class="fontform"> Categoria de Produtos </p>
                <input type="text" name="categprod_title" class="campos" value="<?php 
                if(isset($_GET['atualizar'])):
         
                echo $carrega->getResult()[0]['categprod_title']; 
                           
                endif;?>" />
            </label>
            <label> 
                <p class="fontform"> Categoria Parente </p>
                
                <?php 
                if(isset($_GET['atualizar'])):
         
                echo 
                                            "<input type=\"radio\" name=\"categprod_parent\" value=\"{$carrega->getResult()[0]['categprod_parent']}\" id=\"RadioGroup1_\" checked />
                                            {$carrega->getResult()[0]['categprod_parent']}</label> </br>";
                           
                endif;?>

                <?php
                $categ = new Read;
                $categ->ExeRead("ws_categprod", "WHERE categprod_parent = :b ", "b=0");
                $categ->getResult();
                $i = 0;
                foreach ($categ->getResult() as $value) {
                    $i++;
                    extract($value);
                    ?>

                    <label>
                        <input type="radio" name="categprod_parent" value="<?php echo $puxar = $value['categprod_name']; ?>" id="RadioGroup1_<?php echo $i; ?>" />
                        <?php echo $value['categprod_title']; ?></label> </br>


                    <?php
                    $subcat = new Read;
                    $subcat->ExeRead("ws_categprod", "WHERE categprod_parent = :b ", "b=$puxar");
                    $subcat->getResult();
                    if (!empty($subcat->getResult())):

                        foreach ($subcat->getResult() as $sub) {
                            extract($sub);
                            ?>


                            --<input type="radio" name="categprod_parent" value="<?php echo $puxasub = $sub['categprod_name']; ?>" id="RadioGroup1_ " />
                            <?php echo $sub['categprod_title']; ?></label> </br>


                        <?php
                        $subsub = new Read;
                        $subsub->ExeRead("ws_categprod", "WHERE categprod_parent = :c", "c=$puxasub");
                        $subsub->getResult();
                        if (!empty($subsub->getResult())):
                            foreach ($subsub->getResult() as $ss) {
                                extract($ss);
                                ?>

                                ----<input type="radio" name="categprod_parent" value="<?php echo $puxasub = $ss['categprod_name']; ?>" id="RadioGroup1_ " />
                                <?php echo $ss['categprod_title']; ?></label> </br>


                                <?php
                            }


                        endif;
                        ?>

                        <?php
                    }

                endif;
                ?>


            <?php } ?>





            </label>

            <label> 
                <p class="fontform"> Descriçao da Categoria </p>
                <input type="text" name="categprod_description" class="camposdescription" value="
                       <?php 
                if(isset($_GET['atualizar'])):
         
                echo $carrega->getResult()[0]['categprod_description']; 
                           
                endif;?>" />
            </label>

            <label> 
                <p class="fontform"> Conteúdo da Categoria </p>
                <textarea  name="categprod_content" class="campos"  > 
                <?php 
                if(isset($_GET['atualizar'])):
         
                echo $carrega->getResult()[0]['categprod_content']; 
                           
                endif;?>
                </textarea>
            </label>
            <?php if(!empty($_GET['atualizar'])):
                echo "<input type=\"hidden\" name=\"id\" value=\"{$carrega->getResult()[0]['categprod_id']}\" />";
            endif; ?>
            <input type="hidden" name="categprod_date" value="<?= date('Y-m-d'); ?>" />
            <input type="submit" name="sendpost" <?php
            if (!empty($_GET['atualizar'])):
                echo "value=\"ATUALIZAR\"";
            else:
                echo "value=\"CADASTRAR\"";

            endif;
            ?>value="CADASTRAR" />



        </form> 

        <article>
            </section>


            <section> 
                <header> Categorias Cadastradas no Sistema </header>
                <article>
                    <div class="blocotopcategprod">
                        <div  class="bloco20"> Categoria </div>
                        <div  class="bloco20"> Categoria Parente </div>
                        <div  class="bloco20"> Categoria Slug </div>
                        <div  class="bloco20"> Descrição </div>
                        <div class="bloco5">EDITAR</div>
                        <div class="bloco5"> . </div>
                        <div class="bloco5">DELETAR</div>
                        <div class="clear"> </div>

                    </div>
                    <?php
                    $ver = new Read;
                    $ver->ExeRead("ws_categprod", "ORDER BY categprod_id DESC");
                    $ver->getResult();
                    foreach ($ver->getResult() as $valor) {
                        extract($valor);
                        ?>

                        <div class="blococategprod">
                            <div  class="bloco20"> <?php echo $valor['categprod_title']; ?> </div>
                            <div  class="bloco20"><?php echo $valor['categprod_parent']; ?></div>
                            <div  class="bloco20"> <?php echo $valor['categprod_name']; ?></div>
                            <div  class="bloco20"> <?php echo $valor['categprod_description']; ?> </div>
                            <div class="bloco5"><a href="painel.php?p=categprod&atualizar=<?php echo $valor['categprod_id']; ?>">EDITAR</a></div>
                            <div class="bloco5"> . </div>
                            <div class="bloco5"><a href="painel.php?p=categprod&del=<?php echo $valor['categprod_id']; ?>">DELETAR</a></div>
                            <div class="clear"> <hr> </div>

                        </div>
                    <?php } ?>

                </article>
            </section>