<section class="main"> 

    <article>

        <h1>Inserir Usuarios</h1>

        <?php
        
       
        
       
        
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        unset($post['cadastra']);


        if (isset($post)):
            require('models/AdminUser.class.php');

            $cadastra = new AdminUser;
            $cadastra->ExeCreate($post);
            $cadastra->getResult();
//        $cadastra = new Create;
//        $cadastra->ExeCreate('ws_users', $post);
//        $cadastra->getResult();
        
        if(!$cadastra->getResult()):
           echo "Cadastro efetuado com sucesso"; 
            else:
            echo "Deu merda no cadastro";  
        endif;
           

        endif;
        
         $deleta = filter_input(INPUT_GET, 'del' , FILTER_VALIDATE_INT);
         require('models/AdminUser.class.php');
         $del = new AdminUser;
         $del->ExeDelete($deleta);
         $del->getResult();
         
         if(!$del->getResult()):
             echo "Usuário deletado com sucesso do sistema";
         endif;




        ?>

        <form action="" method="post" enctype="multipart/form-data" >

            <label> 
                <p> Nome </p>
                <input type="text"name="user_name" class="campos"/> 
            </label>

            <label> 
                <p> Sobrenome</p>
                <input type="text"name="user_lastname" class="campos"/> 
            </label>

            <label> 
                <p> E-mail</p>
                <input type="text"name="user_email" class="campos"/> 
            </label>

            <label> 
                <p> Senha</p>
                <input type="password"name="user_password" class="campos"/> 
            </label>

            <label> 
                <p> Nivel</p>
                <select name="user_level" class="campos"> 
                    <option value="3"> Administrador </option>
                    <option value="2"> Vendedores </option>

                </select> 
            </label


            <input type="hidden" name="user_registration" value="<?php echo date('Y-m-d H:i:s') ?>" />
            <input type="submit" value="Cadastrar "  name="cadastra"> 

        </form>

        <article>
            </section>

            <section> 
                <header> Usuários Cadastrados </header>
                <article> 

                    <div class="blocousertop"> 

                        <div class="bloco8"> 
                            DATA
                        </div>

                        <div class="bloco8"> 
                            Nome
                        </div>

                        <div class="bloco8"> 
                            Sobrenome
                        </div>
                        <div class="bloco8"> 
                            Nome
                        </div>
                        <div class="bloco8"> 
                            Senha
                        </div>
                        <div class="bloco8"> 
                            Nivel
                        </div>
                        <div class="bloco8"> 
                            Editar
                        </div>
                        <div class="bloco8"> 
                            Excluir
                        </div>
                    </div>



                    <?php
                    $leruser = new Read;
                    $leruser->ExeRead('ws_users');
                    $leruser->getResult();

                    foreach ($leruser->getResult() as $usuario) {
                        ?>
                        <div class="blocoecateg"> 
                            <div class="bloco8"> 
                                <p style="font-size: 10px;"> <?php echo date('d/m/Y  H:i:s', strtotime($usuario['user_registration'])) . " hs"; ?> </p>
                            </div>

                            <div class="bloco8"> 
                                <?php echo $usuario['user_name']; ?>
                            </div>

                            <div class="bloco8"> 
                                <?php echo $usuario['user_lastname']; ?>
                            </div>
                            <div class="bloco8"> 
                                <?php echo substr($usuario['user_email'], 0, 15) . "...";

                                //$usuario['user_email']; 
                                ?>
                            </div>
                            <div class="bloco8"> 
                                <?php
                                echo substr($usuario['user_password'], 0, 10);
                                //echo $usuario['user_password']; 
                                ?>
                            </div>
                            <div class="bloco8"> 
                                <?php
                                if ($usuario['user_level'] == "3") {
                                    echo "ADMINISTRADOR";
                                }
                                if ($usuario['user_level'] == "2") {
                                    echo "VENDEDOR";
                                }
                                ?>
                            </div>
                            <div class="bloco8"> 
                                <a href="painel.php?p=ausuario&user_id=<?php echo $usuario['user_id']; ?>"> <img src='icons/act_edit.png' /></a>
                            </div>
                            <div class="bloco8"> 
                                 <a href="painel.php?p=iusuario&del=<?php echo $usuario['user_id']; ?>"> <img src='icons/act_delete.png' /></a>
                            </div>
                        </div>
<?php } ?>


                </article>
            </section>