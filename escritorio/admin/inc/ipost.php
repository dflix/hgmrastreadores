
<section class="main"> 

    <article>

        <h1> Inserir Postagem</h1>

        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if (isset($post) && $post['SendPostForm']):
            $post['post_status'] = ($post['SendPostForm'] == 'Cadastrar' ? '0' : '1' );
            $post['post_cover'] = ( $_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null );
            unset($post['SendPostForm']);

            require('models/AdminPost.class.php');
            $cadastra = new AdminPost;
            $cadastra->ExeCreate($post);
             
            if ($cadastra->getResult()):
                
                

                if (!empty($_FILES['gallery_covers']['tmp_name'])):
                    $sendGallery = new AdminPost;
                    $sendGallery->gbSend($_FILES['gallery_covers'], $cadastra->getResult());
                endif;

                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;
        
//        var_dump($cadastra->getResult());
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data" >

            <label class="label">
                <p class="fontform">Imagem de Capa:</p>
                <input type="file" name="post_cover" />
            </label>

            <label class="label">
                <p class="fontform">Titulo: </p>
                <input type="text" name="post_title" value="<?php print_r ($post['post_title']); ?>" class="campos" />
            </label>

            <label class="label">
                <p class="fontform"><b>SEO</b> Descrição do Post:</p>
                <input type="text" name="post_description" rows="5" value="<?php print_r ($post['post_description']); ?>" maxlength="156" class="camposdescription" />
            </label>

            <label class="label">
                <p class="fontform">Categoria:</p>
                <label>
                    <select name="post_category" id="select" class="campos">
                        <option value="<?php print_r ($post['post_category']); ?>">  Selecionar Categoria </option>
                         <option value="<?php echo "pagina"; ?>">  Inserir como página </option>
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
                        <textarea name="post_content" class="js_editor" rows="5"><?php print_r ($post['post_content']); ?></textarea>
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
                            
                            if(empty($cadastra)):
                                echo "não tem imagens cadastradas";                               
                                    
                               else:
 
                            $puxaimg = new Read;
                            $puxaimg->ExeRead('ws_posts_gallery', "WHERE post_id = :p", "p={$cadastra->getResult()}");
                            $puxaimg->getResult();
                            
                            foreach ($puxaimg->getResult() as $img):
                               echo " <div class='imggal'> <img src='../uploads/{$img['gallery_image']} ?>' width='75'  /> </div>";     
  
                           
                            endforeach;
                             endif;
                            ?>
                            
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
                                <?php 
                                $captura = new Read;
                                $captura->ExeRead('ws_propostas');
                                $captura->getResult();
                                if(!empty($captura->getResult())):
                                    
                                    foreach ($captura->getResult() as $formulario) {
                                    extract($formulario);
                                    echo "<option value=\"{$formulario['nome_proposta']}\">{$formulario['nome_proposta']}</option>";
                                        
                                    }
                                endif;
                                
                                ?>
                                
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
                    

                    <input type="submit"  value="Cadastrar" name="SendPostForm" />                              



                    </form>

                    <article>
                        </section>