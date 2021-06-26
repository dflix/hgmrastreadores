
<section class="main"> 

    <header> 
        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($post)):
            unset($post['SendForm']);

            $inserir = new Create;
            $inserir->ExeCreate('ws_telefones', $post);
            $inserir->getResult();

            if ($inserir->getResult()):
                WSErro("Cadastro com sucesso {$post[0]['telefone']}", WS_ACCEPT);
            else:
                WSErro("Deu merda", WS_ERROR);
            endif;


        endif;

        $del = $_GET['del'];
        if (isset($del)):


            $deleta = new Delete;
            $deleta->ExeDelete('ws_telefones', "WHERE id_tel = :p", "p={$del}");
            $deleta->getResult();

            if (!empty($deleta->getResult())):

                WSErro("Telefone deletado com sucesso! ", WS_ERROR);

            else:

                WSErro("Vixi não deletou chame o programador para arrumar ! ", WS_ERROR);
            endif;
        endif;
        ?>
        <h1>Inserir Telefones</h1>
    </header>

    <article>
        <form action="" name="PostForm" method="post" enctype="multipart/form-data">

            <label>
                <p class="fontform"> Telefone </p>

                <input type="text" name="numero" class="campos" />
            </label>

            <label>

                <p class="fontform"> Operadora </p>
                <select name="operadora" class="campos"> 
                    <option value="TIM"> TIM </option>
                    <option value="VIVO"> VIVO </option>
                    <option value="CLARO"> CLARO </option>
                    <option value="OUTROS"> OUTROS </option>
                </select>
            </label>

            <p class="fontform"> Tipo de Telefone </p>
            <select name="tipo" class="campos"> 
                <option value="fixo"> Fixo </option>
                <option value="celular"> Celular </option>
                <option value="whatsapp"> Whatsapp </option>

            </select>
            </label>
            </br>
            <input type="submit" name="SendForm" value="Cadastrar Telefone" />

        </form>

        <hr>

        <div class="blocoecateg"> 

            <div class="datablocotop"> 
                Tipo
            </div>

            <div class="categoriablocotop"> 
                Telefone
            </div>

            <div class="descricaoblocotop"> 
                Operadora
            </div>


            <div class="deletarblocotop"> 
                DEL
            </div>
        </div>

<?php
$read = new Read;
$read->ExeRead('ws_telefones', "ORDER BY id_tel DESC");
$read->getResult();

if (empty($read->getResult())):

    echo "Não existe telefones cadastrados no sistema!";

else:


    foreach ($read->getResult() as $exibe) {
        ?>


                <div class='blocoecateg'> 

                    <div class='databloco'> 
                <?php echo $exibe['tipo']; ?>
                    </div>

                    <div class='categoriabloco'> 
        <?php echo $exibe['numero']; ?>
                    </div>

                    <div class='descricaobloco'> 
        <?php echo $exibe['operadora']; ?>
                    </div>


                    <div class='deletarbloco'> 
                        <a href="painel.php?p=telefones&del=<?php echo $exibe['id_tel']; ?>"> <img src='icons/act_delete.png' /> </a>
                    </div>
                </div>

    <?php } endif; ?>

        <article>
            </section>