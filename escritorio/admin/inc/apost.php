
<section class="main"> 

    <article>

        <h1> Editar Postagem</h1>

        <?php
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

 
        
        $postid = filter_input(INPUT_GET, 'idpost', FILTER_VALIDATE_INT);
        $read = new Read;
        $read->ExeRead("ws_posts", "WHERE post_id = :id", "id={$postid}");
        $resgate = $read->getResult();

        if (isset($data)):

        require('models/AdminPost.class.php');
        $update = new AdminPost;
        $update->ExeUpdate($postid, $data);

        if ($update->getResult()):
            
 
            
        WSErro("<b>Sucesso:</b> O Post <b>{$read->getResult()[0]['post_title']}</b> foi ataulizada com sucesso no sistema!", WS_ACCEPT);


        else:
        WSErro("<b>FUDEU:</b> Deu alguma merda ai", WS_ERROR);
        //echo "Fudeu , deu alguma merda ai.";
        endif;
        endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data" >

            <label class="label">
                <p class="fontform">Imagem de Capa:</p>
                <input type="file" name="post_cover" />
            </label>

            <label class="label">
                <p class="fontform">Titulo: </p>
                <input type="text" name="post_title" value="<?php print_r ($resgate[0]['post_title']); ?>" class="campos" />
            </label>

            <label class="label">
                <p class="fontform"><b>SEO</b> Descrição do Post:</p>
                <input type="text" name="post_description" rows="5" value="<?php print_r ($resgate[0]['post_description']); ?>" maxlength="156" class="camposdescription" />
            </label>

            <label class="label">
                <p class="fontform">Categoria:</p>
                <label>
                    <select name="post_category" id="select" class="campos">
                        <option value="<?php print_r ($resgate[0]['post_category']); ?>">  <?php print_r ($resgate[0]['post_category']); ?> </option>
<?php
$read = new Read;
$read->ExeRead('ws_categories');
foreach ($read->getResult() as $categ):


extract($categ);

echo "<option value='{$categ['category_name']}'>  {$categ['category_title']} </option>";

endforeach;
?>


                    </select>
                    <label class="label">
                        <p class="fontform">Descrição da Categoria </p>
                        <textarea name="post_content" class="js_editor" rows="5">
<?php print_r ($resgate[0]['post_content']); ?>
                        </textarea>
                    </label>

                    <section class="blocoadmin"> 
                        <header> 
                            <h1>Galeria de Imagens do Post</h1> 
                        </header>
                        <article>
                            <label class="label">             
                                <span class="field">Enviar Galeria:</span>
                                <input type="file" multiple name="gallery_covers[]" />
                            </label> 
                        </article>
                    </section>

                    <section class="blocoadminimg"> 
                        <header> 
                            <h1>Biblioteca de Imagens </h1> 
                        </header>
                        <article>
<?php
$puxaimg = new Read;
$puxaimg->ExeRead('ws_posts_gallery', "WHERE post_id = :p", "p={$postid}");
$puxaimg->getResult();

foreach ($puxaimg->getResult() as $img):
?>
                            <section class='imggal'> 
                                <header> <img src="icons/act_edit.png" /> <span style="color: #fff;">||</span> <img src="icons/act_inative.png" /> </header>
                                <img src="../uploads/<?php echo $img['gallery_image']; ?>" width="75"  /> 
                            
                            </section>

                            <?php endforeach; ?>

                            <div class="clear"> </div>
                        </article>
                    </section>


                    <div class="clear"> </div>


                    <section class="blocoadmin"> 
                        <header> 
                            <h1>Salva Post Como</h1> 
                        </header>
                        <article>

                            <label>
                                <input type="radio" name="post_type" value="rascunho" id="publicar_0" />
                                Rascunho</label>
                            <br />
                            <label>
                                <input type="radio" name="post_type" value="post" id="publicar_1" />
                                Publicar</label>
                            <br />
                            <h4> Ativar Formulário de Captura </h4>
                            <select name="post_formcap" id="select">
                                <option value="null"> Selecione Formulário de Captura. </option>
                                <option value="null"> Sem formulários </option>
                                <option value="formulario carro">Formulario Carro</option>
                                <option value="formulario caminhão">Formulario Caminhão</option>
                            </select>                    
                        </article>
                    </section>



                    <section class="blocoadmin"> 
                        <header> 
                            <h1> Autor do Post </h1> 
                        </header>
                        <article>


                            <select name="post_author" id="select">
                                <option value="#">Selecione Autor</option>
<?php
$user = new Read;
$user->ExeRead('ws_users', 'ORDER BY user_id ASC');
$user->getResult();

foreach ($user->getResult() as $usuario) {
echo "<option value='{$usuario['user_id']}'>{$usuario['user_name']}</option>";
}
?>

                            </select>

                        </article>
                    </section>

                    <div class="clear"> </div>
                    <input type="hidden" name="post_date" value="<?= date('d/m/Y H:i:s'); ?>" />


                    <input type="submit"  value="Cadastrar"  />                              



                    </form>

                    <article>
                        </section>