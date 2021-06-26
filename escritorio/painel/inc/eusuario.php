<link href="css/bootstrap.min.css" rel="stylesheet">
<style type="text/javascript"> 

    var headertext = [];
    var headers = document.querySelectorAll("thead");
    var tablebody = document.querySelectorAll("tbody");

    for (var i = 0; i < headers.length; i++) {
        headertext[i]=[];
        for (var j = 0, headrow; headrow = headers[i].rows[0].cells[j]; j++) {
            var current = headrow;
            headertext[i].push(current.textContent);
        }
    } 

    for (var h = 0, tbody; tbody = tablebody[h]; h++) {
        for (var i = 0, row; row = tbody.rows[i]; i++) {
            for (var j = 0, col; col = row.cells[j]; j++) {
                col.setAttribute("data-th", headertext[h][j]);
            } 
        }
    }


</style>



<?php
//require('../../_app/Config.inc.php');
//require('../../_app/Config.inc.php');
?>

<?php
if (isset($_GET['del'])):
    echo "<p class=\"deletar\">Tem certeza que deseja remover esse registro <a href=\"index.php?p=eusuario&delyes={$_GET['del']}\">clique aqui</a> </br>";
    echo " <b>Cliente</b>{$_GET['del']} </p>";
endif;
if (isset($_GET['delyes'])):



    $deletar = new Delete();
    $deletar->ExeDelete("usuario", "WHERE id_usuario= :p", "p={$_GET['delyes']}");
    $deletar->getResult();
    if ($deletar->getResult()):
        echo "<p class=\"deletar\"> Registro {$_GET['delyes']} removido com sucesso </p>";
    endif;
endif;
?>

<section class="content"> 

    <h1 class="page-header"> BUSCAR </h1>

    <form action="index.php?p=eusuario" name="buscar" method="POST" class="form" enctype="multipart-form/data"> 

        <label class="col-md-12"> 
            Selecione o nivel de usuário
            <select name="nivel" class="form-control"> 
                <option value="1"> Financeiro </option>
                <option value="2"> Vendedor </option>
                <option value="3"> Instalador </option>
                <option value="4"> Lider </option>
                <option value="5"> Afiliado </option>
                <option value="6"> Administrador </option>
            </select>


        </label>


        <input type="submit" name="SendBuscar" value="BUSCAR" class="btn btn-primary" />


        <div class="clear"> </div>


    </form>

    <div class="clear"> </div>




    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Senha</th>
                <th>Nivel</th>
                <th>Editar</th>
                <th>Deletar</th>

            </tr>
        </thead>
        <tbody>


            <?php
            $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (isset($filtro)):

                $exibe = new Read();
                $exibe->ExeRead("usuario", "WHERE nivel = :p ", "p={$filtro['nivel']}");
                $exibe->getResult();

                foreach ($exibe->getResult() as $value) {

                    $status = $value['nivel'];

                    if ($status == '1'):
                        $exibestatus = "FINANCEIRO";
                    endif;
                    if ($status == '2'):
                        $exibestatus = "VENDEDOR";
                    endif;
                    if ($status == '3'):
                        $exibestatus = "INSTALADOR";
                    endif;
                    if ($status == '4'):
                        $exibestatus = "LIDER";
                    endif;
                    if ($status == '5'):
                        $exibestatus = "AFILIADO";
                    endif;
                    if ($status == '6'):
                        $exibestatus = "ADMINISTRADOR";
                    endif;

                    if (empty($value['avatar'])):
                        $avatar = "<span class=\"glyphicon glyphicon-user\" style=\"font-size:50px; color:#CCC;\"> </span>";
                        else:
                        $avatar = "<img src=\"uploads/{$value['avatar']}\" class=\"img-circle\" style=\"width:100px;\"  /> ";

                    endif;


                    echo "
              <tr>
          <td> {$avatar} </td>
          <td> {$value['nome']} </td>
          <td> {$value['email']}  - {$value['nivel']}  </td>
          <td> {$value['senha']} </td>
          <td> {$exibestatus} </td>
            <td> <a href=\"index.php?p=ausuario&id={$value['id_usuario']}\"><img src=\"img/editar.png\" /></a></td>
            <td> <a href=\"index.php?p=eusuario&del={$value['id_usuario']}\"><img src=\"img/deletar.png\" /></a></td></tr>
            
          "
                    . "";
                }


            else:

                $exibe = new Read();
                $exibe->ExeRead("usuario", "ORDER BY id_usuario DESC");
                $exibe->getResult();


                foreach ($exibe->getResult() as $value) {

                    $status = $value['nivel'];

                    if ($status == '1'):
                        $exibestatus = "FINANCEIRO";
                    endif;
                    if ($status == '2'):
                        $exibestatus = "VENDEDOR";
                    endif;
                    if ($status == '3'):
                        $exibestatus = "INSTALADOR";
                    endif;
                    if ($status == '4'):
                        $exibestatus = "LIDER";
                    endif;
                    if ($status == '5'):
                        $exibestatus = "LOJA";
                    endif;
                    if ($status == '6'):
                        $exibestatus = "ADMINISTRADOR";
                    endif;

                    if (empty($value['avatar'])):
                        $avatar = "<span class=\"glyphicon glyphicon-user\" style=\"font-size:50px; color:#CCC;\"> </span>";
                        else:
                        $avatar = "<img src=\"uploads/{$value['avatar']}\" class=\"img-circle\" style=\"width:100px;\" /> ";

                    endif;




                    echo "
              <tr>
          <td> {$avatar} </td>
          <td> {$value['nome']} </td>
          <td> {$value['email']} - {$value['nivel']} </td>
          <td> {$value['senha']} </td>
          <td> {$exibestatus} </td>
            <td> <a href=\"index.php?p=ausuario&id={$value['id_usuario']}\"><img src=\"img/editar.png\" /></a></td>
            <td> <a href=\"index.php?p=eusuario&del={$value['id_usuario']}\"><img src=\"img/deletar.png\" /></a></td></tr>

          "
                    . "";
                }
            endif;
            ?>

        </tbody>
    </table>





