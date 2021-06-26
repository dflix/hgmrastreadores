<section class="main"> 

    <header> <h1>Inserir Scripts no Head do Site</h1>
        <article>
            <?php
            $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($post['sendpost'])):
                unset($post['sendpost']);

                $cadastra = new Create;
                $cadastra->ExeCreate('ws_script', $post);
                $cadastra->getResult();

                if ($cadastra->getResult()):

                    WSErro('Script cadastrado com sucesso na página', WS_ACCEPT);
                else:
                    WSErro('Erro ao cadastrar script', WS_ERROR);

                endif;
            endif;

            if (!empty($_GET['del'])):
                $deleta = new Delete;
                $deleta->ExeDelete('ws_script', "WHERE id_script = :p", "p={$_GET['del']}");
                $deleta->getResult();
                if (!empty($deleta->getResult())):
                    WSErro('Script deletado com sucesso do sistema', WS_ACCEPT);
                else:
                    WSErro('Erro ao deletar script', WS_ERROR);
                endif;
            endif;

            if (!empty($_GET['edit'])):

                $update = new Update;
                $update->ExeUpdate('ws_script', $post, "WHERE id_script = :p", "p={$_GET['edit']}");
                $update->getResult();
                if (!empty($update->getResult())):
                    WSErro('Script atualizado com sucesso na página', WS_ACCEPT);
                else:
                    WSErro('Erro ao atualizar script', WS_ERROR);
                endif;
            endif;




            if (!empty($_GET['edit'])):
                $carrega = new Read;
                $carrega->ExeRead('ws_script', "WHERE id_script = :p", "p={$_GET['edit']}");
                $carrega->getResult();




                echo "<form action=\"\" method=\"post\" > 
            <label> 
                <p class=\"fontform\">Nome do Script </p>
                <input type=\"text\" name=\"script_nome\" class=\"campos\" value=\"{$carrega->getResult()[0]['script_nome']}\" />
            </label>

            <label> 
                <p class=\"fontform\">Script </p>
                <input type=\"text\" name=\"script\" value=\"{$carrega->getResult()[0]['script']}\" class=\"camposdescription\" />
            </label>
            </br>
            <input type=\"submit\" name=\"sendpost\" value=\"CADASTRAR\" />

        </form>";

            else:

                echo "        <form action=\"\" method=\"post\" > 
            <label> 
                <p class=\"fontform\">Nome do Script </p>
                <input type=\"text\" name=\"script_nome\" class=\"campos\" value=\"\" />
            </label>

            <label> 
                <p class=\"fontform\">Script </p>
                <input type=\"text\" name=\"script\" value=\"\" class=\"camposdescription\" />
            </label>
            </br>
            <input type=\"submit\" name=\"sendpost\" value=\"CADASTRAR\" />

        </form>";


            endif;
            ?>


        </article>
</section>

<section>

    <article>


        <div class="blocoformulariotop">
            <div class="blocoformulario20"> Titulo Script </div>
            <div class="blocoformulario70"> Script </div>
            <div class="blocoformulario5">Editar </div>
            <div class="blocoformulario5">Deletar </div>
            <div class="clear"> </div>
        </div>

        <?php
        $read = new Read;
        $read->ExeRead('ws_script');
        $read->getResult();
        if (!empty($read->getResult())):
            foreach ($read->getResult() as $valor) {
                extract($valor);
                echo "  <div class=\"blocoformulario\">
            <div class=\"blocoformulario20\"> {$valor['script_nome']} </div>
            <div class=\"blocoformulario70\"> {$valor['script']} </div>
            <div class=\"blocoformulario5\"><a href=\"painel.php?p=scripts&edit={$valor['id_script']}\">Editar </a> </div>
            <div class=\"blocoformulario5\"><a href=\"painel.php?p=scripts&del={$valor['id_script']}\">Deletar </a> </div>
            <div class=\"clear\"> </div>
        </div>";
            }
        endif;
        ?>



    </article>
</section>