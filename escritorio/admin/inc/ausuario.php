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
            if (!$cadastra->getResult()):
                echo "Erro no cadastro";
            else:
                echo "Usuario <b>{$post['user_email']} </b> cadastrado com sucesso";
            endif;

        endif;



//        $cadastra = new Create;
//        $cadastra->ExeCreate('ws_users', $post);
//        $cadastra->getResult();
//        
//        if(!$cadastra->getResult()):
//           echo "Erro no cadastro"; 
//            else:
//            echo "Usuario cadastrado com sucesso";  
//        endif;
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


            </section>