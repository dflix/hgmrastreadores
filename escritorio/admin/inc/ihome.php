
<section class="main"> 

    <article>

        <h1> Inserir Home Page</h1>

        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);



        if (isset($post) && $post['SendPostForm']):
            $post['post_status'] = ($post['SendPostForm'] == 'Cadastrar' ? '0' : '1' );
            $post['post_cover'] = ( $_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null );
            unset($post['SendPostForm']);


            require('models/AdminHome.class.php');
            $cadastra = new AdminHome;
            $cadastra->ExeUpdate(1, $post);


            if ($cadastra->getResult()):

                if (!empty($_FILES['gallery_covers']['tmp_name'])):
                    $sendGallery = new AdminHome;
                    $sendGallery->gbSend($_FILES['gallery_covers'], $cadastra->getResult());
                endif;

                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;


        $ler = new Read;
        $ler->ExeRead('ws_home', "WHERE post_id = :p", "p=1");
        $ler->getResult();
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data" >
            <label> 
                <img src="../uploads/<?php echo $ler->getResult()[0]['post_cover'] ?>" width="150" />
            </label>
            </br>
            <label class="label">
                <p class="fontform">Imagem de Capa:</p>
                <input type="file" name="post_cover" />
            </label>

            <label class="label">
                <p class="fontform">Titulo: </p>
                <input type="text" name="post_title" value="<?php echo $ler->getResult()[0]['post_title'] ?>" class="campos" />
            </label>

            <label class="label">
                <p class="fontform"><b>SEO</b> Descrição do Post:</p>
                <input type="text" name="post_description" rows="5" value="<?php echo $ler->getResult()[0]['post_description'] ?>" maxlength="156" class="camposdescription" />
            </label>

            <input type="hidden" name="post_category" value="<?php echo "home"; ?>"  />


            <label class="label">
                <p class="fontform">Descrição da Categoria </p>
                <textarea name="post_content" class="js_editor" rows="5"><?php echo $ler->getResult()[0]['post_content'] ?></textarea>
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
                    if (empty($cadastra)):
                        echo "não tem imagens cadastradas";

                    else:

                        $puxaimg = new Read;
                        $puxaimg->ExeRead('ws_posts_gallery', "WHERE post_id = :p", "p=1");
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


                        <?php $verifica = $ler->getResult()[0]['post_type']; ?>


                        <input type="radio" name="post_type"  value="rascunho" <?php if ($verifica == "rascunho"): echo "checked";
                        endif;
                        ?> id="publicar_0" />
                        Rascunho</label>
                    <br />
                    <label>
                        <input type="radio" name="post_type" value="post" <?php if ($verifica == "post"): echo "checked";
                               endif;
                        ?>  id="publicar_1" />
                        Publicar</label>
                    <br />
                    <h4> Ativar Formulário de Captura </h4>
                    <select name="post_formcap" id="select">
                        <option value="<?php echo $ler->getResult()[0]['post_formcap'] ?>"> <?php echo $ler->getResult()[0]['post_formcap'] ?> </option>
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
                        <option value="<?php echo $ler->getResult()[0]['post_author'] ?>"> <?php echo $ler->getResult()[0]['post_author'] ?> </option>
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
            <input type="hidden" name="post_status" value="1" />


            <input type="submit"  value="Cadastrar" name="SendPostForm" />                              



        </form>

        <article>
            </section>

<div class="clear"> <hr> </div>
<section class="blocoadmin" id="destaque"> 
    <header> Selecionar Paginas em Destaque</header>
    <article>
                        <form action="#destaque"  method="post" id="destaque" >
                        
                        <?php
                        $formdest = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        unset($formdest['sendpostdest']);
                        if(!empty($formdest)):
                            
                        
                        $inserirdest = new Create;
                        $inserirdest->ExeCreate('ws_destaquehome', $formdest);
                        
                        endif;
                       
                        
                        ?>
                    <select name="destaque"> 
                        <?php if (!empty($ler->getResult()[0]['destaque1'])):
                            ?>
                            <option > Selecionar Página em destaque </option>
                        <?php endif; ?>
                        <?php
                        $dest = new Read;
                        $dest->ExeRead('ws_posts', "ORDER BY post_id DESC");
                        $dest->getResult();
                        if (!empty($dest->getResult())):

                            foreach ($dest->getResult() as $value) {
                                extract($value);
                                echo " <option name=\"destaque\" value=\"{$value['post_name']}\"> {$value['post_title']} </option> ";
                            }

                        endif;
                        ?>

                    </select>
                        
                        <input type="submit" name="sendpostdest" value="SELECIONAR" />
                        
                         </form>
        </br> <hr>
        <h3> Páginas em Destaque </h3>
        <?php 
        $leitura = new Read;
        $leitura->ExeRead('ws_destaquehome');
        $leitura->getResult();
        $i = 0;
        if(!empty($leitura->getResult())):
            foreach ($leitura->getResult() as $value) {
            $i++;
            extract($value);
            echo "<p>{$i} - {$value['destaque']} </p>";
                
            }
        endif;
        ?>
    </article>
</section>
  <div class="clear"> </div>