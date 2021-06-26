

<section class="main"> 

    <article>

        <h1> Atualizar Categorias</h1>

        <?php
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $catid = filter_input(INPUT_GET, 'idcateg', FILTER_VALIDATE_INT);
        $read = new Read;
        $read->ExeRead("ws_categories", "WHERE category_id = :id", "id={$catid}");
        $resgate = $read->getResult();

        if (isset($data)):
         
            require('models/AdminCategory.class.php');
            $update = new AdminCategory;
            $update->ExeUpdate($catid, $data);

            if ($update->getResult()):
              WSErro("<b>Sucesso:</b> A categoria <b>{$read->getResult()[0][category_title]}</b> foi ataulizada com sucesso no sistema!", WS_ACCEPT);
            //echo "Atualização realizada com sucesso";
            //echo "<script>location.href='painel.php?p=acateg</script>";

            else:
                WSErro("<b>FUDEU:</b> Deu alguma merda ai", WS_ERROR);
            //echo "Fudeu , deu alguma merda ai.";
            endif;


        
        
        else:


           
        endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data" >



            <label class="label">
                <p class="fontform">Titulo: </p>
                <input type="text" name="category_title" value="<?php echo $resgate[0]['category_title']; ?>" class="campos" />
            </label>

            <label class="label">
                <p class="fontform"><b>SEO</b> Descrição da categoria:</p>
                <input type="text" name="category_description" rows="5" value="<?php echo $resgate[0]['category_description']; ?>" maxlength="156" class="camposdescription" />
            </label>
            
                        <label class="label">
                <p class="fontform">Slug (URL da página) </p>
                <input type="text" name="category_name" value="<?php echo $resgate[0]['category_name']; ?>" class="campos" />
            </label>

            <label class="label">
                <p class="fontform">Categoria:</p>
                <label>
                    <select name="category_parent" id="select" class="campos">
                        <option value="<?php echo $resgate[0]['category_parent']; ?>">  Selecionar Categoria </option>
<?php
$read = new Read;
$read->ExeRead('ws_categories');
foreach ($read->getResult() as $categ):


    extract($categ);

    echo "<option value='{$categ['category_id']}'>  {$categ['category_title']} </option>";

endforeach;
?>


                    </select>
                    <label class="label">
                        <p class="fontform">Descrição da Categoria </p>
                        <textarea name="category_content" class="js_editor" rows="5"><?php echo $resgate[0]['category_content']; ?></textarea>
                    </label>

                    <input type="hidden" name="category_date" value="<?= date('d/m/Y H:i:s'); ?>" />

                    <input type="submit" class="btn green" value="Cadastrar Categoria" />                              



                    </form>

                    <article>
                        </section>