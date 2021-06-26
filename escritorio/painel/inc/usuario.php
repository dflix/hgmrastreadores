<main> 

    <h1> Usuários </h1>
    <?php 
   //require('../../_app/Config.inc.php');
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    

        
    
    var_dump($form);
    ?>
    
    <form name="assitencia" action="" method="post" enctype="multipart/form-data" > 
        
        <label> 
            <p> Nome</p>
            <input type="text" name="nome" />
        </label>
        </br>
        <label> 
            <p> Email</p>
            <input type="text" name="email"  />
        </label>
        </br>
        <label> 
            <p> Senha</p>
            <input type="text" name="senha"  />
        </label>
        </br>
        <label> 
            <p> Nivel</p>
            <select name="nivel"> 
                <option value="1"> Admin / Financeiro </option>
                <option value="2"> Vendedor </option>
                <option value="3"> Instalador </option>
                <option value="4"> Lider </option>
                <option value="5"> Lojista </option>
                <option value="6"> SEO / MASTER </option>
            
            </select>
            
        </label>
        </br>
        <label> 
            <input type="hidden" name="ativo" value="1" /> 
            <input type="submit" name="sendassist" value="CADASTRAR" />
        </label>
        </br>
    
    
    </form>
    
    
    <hr><hr> </br> </br>
    
    <?php 
    
    $atualiza = filter_input(INPUT_GET, 'atu' , FILTER_VALIDATE_INT);
    
    if(isset($atualiza)):
 
        $update = new Update();
    $update->ExeUpdate("usuario", $atualiza, "WHERE id_usuario = :p", "p={$_GET['atu']}");
    $update->getResult();
    
    if($update->getResult()):
        echo "cadastro atualizado com sucesso";
    endif;
        
    endif;
    
    $deleta = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);
  
    if(isset($deleta)):
        
        $deletar = new Delete();
    $deletar->ExeDelete("usuario", "WHERE id = :p", "p={$deleta}");
    $deletar->getResult();
    if($deletar->getResult()):
        echo "Registro removido com sucesso";
    else:
        echo "ERRO ao remover registro";
    endif;
        
    endif;
    
    $exibe = new Read();
    $exibe->ExeRead("usuario", "ORDER BY nivel ASC");
    $exibe->getResult();
    
    foreach ($exibe->getResult() as $value) {
        
        echo "    <section class=\"vinte\"> 
            <p> <b>Usuario:</b> </p>
            <p> .{$value['nome']}</p>
            </section>
            <section class=\"vinte\"> 
            <p> <b>Login:</b> </p>
            <p> .{$value['email']}</p>
            </section>
            <section class=\"vinte\"> 
            <p> <b>Senha:</b> </p>
            <p> .{$value['senha']}</p>
            </section>
            <section class=\"vinte\"> 
            <p> <b>Nivel:</b> </p>
            <p> .{$value['nivel']}</p>
            </section>
            <section class=\"vinte\"> 
            <p> Editar: </p>
            <hr>
            <p> Deletar:</p>
            </section>
            <hr></br><hr>
            <div class=\"clear\"> </div>
       
  ";
            
        
    }
    
    ?>
    
    
   
      
</main>
</br> </br></br> </br>