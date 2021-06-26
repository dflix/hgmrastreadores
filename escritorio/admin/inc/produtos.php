
    
    <script type="text/javascript">
        $(document).ready(function(){
              $("input.dinheiro").maskMoney({showSymbol:true, symbol:"", decimal:",", thousands:"."});
        });
    </script>
    
<section class="main"> 
    <header> 
        <h1>PRODUTOS</h1>
        <?php
        require('models/InsertProduts.class.php');


        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $upload = new InsertProduts('../uploads/');
        if (!empty($_FILES['post_cover'])):

            $imagem = $_FILES['post_cover'];
            $upload->image($_FILES['post_cover']);
            $upload->getResult();
            if (!empty($upload->getResult())):
                WSErro("Imagem enviada com sucesso {$upload->getResult()}", WS_ACCEPT);
            else:
                WSErro("Imagem enviada {$upload->getError()}", WS_ERROR);
            endif;
           // var_dump($upload);
        endif;

        if (!empty($_FILES['gallery_covers']['tmp_name'])):
            $idprod = new Read;
        $idprod->ExeRead('ws_prod', "ORDER BY prod_id DESC");
        $idprod->getResult();
        $idproduto = $idprod->getResult()[0]['prod_id'];
            
            $galery = new InsertProduts();
            $galery->gbSend($_FILES['gallery_covers'] , $idproduto);
            
            //var_dump($galery);
        endif;
        ?>
    </header>            

    <article>

        <form action="" method="post" name="postprodutos" enctype="multipart/form-data"> 

            <label> 
                <p class="fontform"> Categoria </p>


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
                        <input type="radio" name="prod_categ" value="<?php echo $puxar = $value['categprod_name']; ?>" id="RadioGroup1_<?php echo $i; ?>" />
                        <?php echo $value['categprod_title']; ?></label> </br>


                    <?php
                    $subcat = new Read;
                    $subcat->ExeRead("ws_categprod", "WHERE categprod_parent = :b ", "b=$puxar");
                    $subcat->getResult();
                    if (!empty($subcat->getResult())):

                        foreach ($subcat->getResult() as $sub) {
                            extract($sub);
                            ?>


                            --<input type="radio" name="prod_categ" value="<?php echo $puxasub = $sub['categprod_name']; ?>" id="RadioGroup1_ " />
                            <?php echo $sub['categprod_title']; ?></label> </br>


                        <?php
                        $subsub = new Read;
                        $subsub->ExeRead("ws_categprod", "WHERE categprod_parent = :c", "c=$puxasub");
                        $subsub->getResult();
                        if (!empty($subsub->getResult())):
                            foreach ($subsub->getResult() as $ss) {
                                extract($ss);
                                ?>

                                ----<input type="radio" name="prod_categ" value="<?php echo $puxasub = $ss['categprod_name']; ?>" id="RadioGroup1_ " />
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

            <label class="label">
                <p class="fontform">Imagem Principal:</p>
                <input type="file" name="post_cover" />
            </label>


            <label> 
                <p class="fontform"> Nome do Produto </p>
                <input type="text" name="prod_nome" class="campos" />
            </label>

            <label> 
                <p class="fontform"> Descrição Curta </p>
                <input type="text" name="prod_desc_curta" class="camposdescription" />
            </label>

            <label> 
                <p class="fontform"> Detalhes do Produto </p>
                <textarea name="prod_content"> </textarea>
            </label>

            <label> 
                <p class="fontform" > Preço do Produto  de </p>
                 
                <input type="text" name="prod_valor" class="dinheiro" />
                </br>

            </label>
            

            <h2> SEO TAGS </h2>


            <label> 
                <p class="fontform"> Meta Title  </p>
                <input type="text" name="prod_title" class="campos" />
            </label>

            <label> 
                <p class="fontform"> Meta Description  </p>
                <input type="text" name="prod_description" class="camposdescription" />
            </label>

            </BR>

            <label class="label">             
                <span class="fontform">Enviar Galeria:</span>
                <input type="file" multiple name="gallery_covers[]" />
            </label> 

            </BR>
            <input type="hidden" name="prod_status" value="1" />
            <input type="submit" name="sendprod" value="CADASTRAR" /> 

        </form>


        <article>
            </section>
    
    

