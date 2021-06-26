<section class="main"> 

    <header> <h1>Inserir Auto Responder</h1> 
        <?php
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($form['sendpost'])):
            unset($form['sendpost']);

            $cadastra = new Create;
            $cadastra->ExeCreate('ws_propostas', $form);
            $cadastra->getResult();

            if (!empty($cadastra->getResult())):
                WSErro("Auto Responder cadastrado com sucesso", WS_ACCEPT);
            else:
                WSErro("Deu merda ai", WS_ERROR);
            endif;
        endif;
        //var_dump($form);
        ?>
    </header>

    <article>

        <?php
        if (!empty($_GET['del'])):
            $deleta = new Delete;
            $deleta->ExeDelete('ws_propostas', "WHERE id_proposta = :p", "p={$_GET['del']}");
            $deleta->getResult();
            
             if (!empty($deleta->getResult())):
                    WSErro("Auto Responder deletado com sucesso", WS_ACCEPT);
                else:
                    WSErro("Deu merda ai", WS_ERROR);
                endif;

        endif;

        if (!empty($_GET['edit'])):

            $read = new Read;
            $read->ExeRead('ws_propostas');
            $read->getResult();

            $formedit = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($formedit['sendpostedit'])):
                unset($formedit['sendpostedit']);

                $update = new Update;
                $update->ExeUpdate('ws_propostas', $formedit, "WHERE id_proposta = :p", "p={$_GET['edit']}");
                $update->getResult();

                if (!empty($update->getResult())):
                    WSErro("Auto Responder atualizado com sucesso", WS_ACCEPT);
                else:
                    WSErro("Deu merda ai", WS_ERROR);
                endif;


            endif;

            echo "<form name=\"PostForm\" action=\"\" method=\"post\" enctype=\"multipart/form-data\" >

            <label> 
                <p class=\"fonteform\"> NOME AUTO RESPONDER </p>
                <input type=\"text\" name=\"nome_proposta\" class=\"campos\" value=\"{$read->getResult()[0]['nome_proposta']}\" />
            </label>
            <label> 
            <p class=\"fonteform\" > HTML DE RESPOSTA </p>
            <textarea name=\"proposta\" value=\"{$read->getResult()[0]['proposta']}\"> </textarea>
            </label>
            </br>
            <label> 
                <input type=\"submit\" name=\"sendpostedit\" value=\"cadastrar\" />
            </label>
        </form>";

        else:

            echo "<form name=\"PostForm\" action=\"\" method=\"post\" enctype=\"multipart/form-data\" >

            <label> 
                <p class=\"fonteform\"> NOME AUTO RESPONDER </p>
                <input type=\"text\" name=\"nome_proposta\" class=\"campos\" />
            </label>
            <label> 
            <p class=\"fonteform\" > HTML DE RESPOSTA </p>
            <textarea name=\"proposta\"> </textarea>
            </label>
            </br>
            <label> 
                <input type=\"submit\" name=\"sendpost\" value=\"cadastrar\" />
            </label>
        </form>";


        endif;
        ?>



        <div class="blocoformulariotop">
            <div class="blocoformulario20"> Nome da Proposta </div>
            <div class="blocoformulario70"> HTML Auto Responder </div>
            <div class="blocoformulario5">Editar </div>
            <div class="blocoformulario5">Deletar </div>
            <div class="clear"> </div>
        </div>

        <?php
        $resultado = new Read;
        $resultado->ExeRead('ws_propostas');
        $resultado->getResult();

        if (!empty($resultado->getResult())):

            foreach ($resultado->getResult() as $view) {
                extract($view);

                echo "<div class=\"blocoformulario\">
            <div class=\"blocoformulario20\"> {$view['nome_proposta']} </div>
            <div class=\"blocoformulario70\"> {$view['proposta']} </div>
            <div class=\"blocoformulario5\"><a href=\"painel.php?p=formularios&edit={$view['id_proposta']}\">Editar</a> </div>
            <div class=\"blocoformulario5\"><a href=\"painel.php?p=formularios&del={$view['id_proposta']}\">Deletar</a> </div>
            <div class=\"clear\"> </div>
        </div>";
            }

        endif;
        ?>

        <!--                <div class="blocoformulario">
                    <div class="blocoformulario20"> Nome da Proposta </div>
                    <div class="blocoformulario70"> HTML Auto Responder </div>
                    <div class="blocoformulario5">Editar </div>
                    <div class="blocoformulario5">Deletar </div>
                    <div class="clear"> </div>
                </div>-->

        <article>
            </section>