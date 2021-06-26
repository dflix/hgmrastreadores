
<section class="col-md-12"> 
    <h3 class="page-header"> Seus dados de acesso são</h3>

    <?php
    $usu = new Read();
    $usu->ExeRead("usuario", "WHERE email = :p", "p={$_COOKIE['logprot_email']}");
    $usu->getResult();
    ?>
    <p> Email de acesso = <b> <?= $usu->getResult()[0]['email'] ?> </b></p>
    <p> Password = <b> <?= $usu->getResult()[0]['senha'] ?> </b></p>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($form['submit']):
        unset($form['submit']);

        $up = new Update();
        $up->ExeUpdate("usuario", $form, "WHERE id_usuario = :p", "p={$form['id_usuario']}");
        $up->getResult();

        if ($up->getResult()):

            echo "<div class=\"alert alert-success\" role=\"alert\">Senha Atualizada com Sucesso</div>";

        else:

            echo "<div class=\"alert alert-danger\" role=\"alert\">Senha não atualizada chame o Disbiriflix</div>";


        endif;


    endif;
    ?>

    <form class="form" action="" method="post" name="formusu">
        <h3> Alterar Senha</h3>

        <div class="form-group"> 
            <p> Alterar sua senha</p>
            <input type="text" class="form-control" name="senha" />
        </div>
        <div class="form-group"> 

            <input type="hidden"  name="id_usuario" value="<?= $_COOKIE['logprot_id_usuario'] ?>" />
            <input type="submit" class="btn btn-primary" name="submit" />
        </div>
    </form>

    <hr>



    <?php
//require('../_app/Config.inc.php');

    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if ($form && $form['sendImage']):

        $Dados = $form['id_usuario'];

        $upload = new UploadArquivo('uploads/');
        $imagem = $_FILES['imagem'];
        //var_dump($imagem);

        $upload->Image($imagem);
        if (!$upload->getResult()):
            WSErro("Erro ao enviar imagem:<br><small> {$upload->getError()} </small>", WS_ERROR);
        else:
           // WSErro("Arquivo enviado com sucesso:<br><smal> {$upload->getResult()}</smal>", WS_ACCEPT);



            $verifica = new Read();
            $verifica->ExeRead("usuario", "WHERE id_usuario = :p", "p={$_COOKIE['logprot_id_usuario']}");
            $verifica->getResult();

            if (isset($verifica->getResult()[0]['avatar'])):

                unlink("uploads/" . $verifica->getResult()[0]['avatar']);

                $Dados = [

                    "avatar" => $upload->getResult()
                ];

                $update = new Update();
                $update->ExeUpdate("usuario", $Dados, "WHERE id_usuario = :p", "p={$_COOKIE['logprot_id_usuario']}");
                $update->getResult();
                if ($update->getResult()):
                    echo "Atualização com sucesso " ;
                endif;


            else:

                $Dados = [

                    "avatar" => $ficheiro = $upload->getResult()
                ];

                $update = new Update();
                $update->ExeUpdate("usuario", $Dados, "WHERE id_usuario = :p", "p={$_COOKIE['logprot_id_usuario']}");
                $update->getResult();
                if ($update->getResult()):
                    echo "Atualização com sucesso imagem ." . $ficheiro = $upload->getResult();
                endif;


                $ficheiro = $upload->getResult();

            endif;

            echo "<hr>";



// var_dump($form);



        endif;

    endif;
    ?>
    <div class="col-md-12">

        <div class="col-md-12"> 
            <?php
            $avatar = new Read();
            $avatar->ExeRead("usuario", "WHERE id_usuario = :p", "p={$_COOKIE['logprot_id_usuario']}");
            $avatar->getResult();
            
                    
        if (empty($avatar->getResult()[0]['avatar'])):
                        $avatar = "<span class=\"glyphicon glyphicon-user\" style=\"font-size:50px; color:#CCC;\"> </span>";
                        else:
                        $avatar = "<img src=\"uploads/{$avatar->getResult()[0]['avatar']}\" class=\"img-circle\" style=\"width: 100px;\"/> ";

                    endif;
            
            ?>
           <?= $avatar ?>
        </div>

        <form name="fileForm" action="" class="form" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <p> Mudar Imagem Avatar </p>
                <input type="file" class="form-control" name="imagem"/>
            </div>


            <input type="hidden" name="id_usuario" value="<?= $_COOKIE['logprot_id_usuario'] ?>"  />

            <div class="col-md-12">
                <input type="submit" name="sendImage" value="enviar imagem" class="btn btn-primary"/>
            </div>
        </form>
    </div>



</section>

<section class="col-md-8"> 

    <h3 class="page-header">
        PERFIL </h3>
    
    <p> <b>Nome:</b> <?= $usu->getResult()[0]['nome'] ?> </p>
    <p> <b>CPF:</b> <?= $usu->getResult()[0]['cpf'] ?> </p>
    <p> <b>RG:</b> <?= $usu->getResult()[0]['rg'] ?> </p>
    <p> <b>Telefone Residencial:</b> <?= $usu->getResult()[0]['tel_res'] ?> </p>
    <p> <b>Telefone Celular:</b> <?= $usu->getResult()[0]['tel_cel'] ?> </p>

</section>
