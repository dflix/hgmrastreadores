<section class="main"> 
    <header> 
        <h1>Configurações da Loja</h1>
        <?php 
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($post['sendform'])):
            unset($post['sendform']);
        
        $update = new Update;
        $update->ExeUpdate("ws_loja", $post, "WHERE ws_lojaid = :p", "p=1");
        $update->getResult();
        
        endif;
        
        ?>
        <?php         
        $read = new Read;
        $read->ExeRead('ws_loja', "WHERE ws_lojaid = :p", "p=1");
        $read->getResult();
        $verifica =  $read->getResult()[0]['status'];
        
        ?>
    </header>

    <article>

        <form action="" method="post" name="getform"> 
            <label> 
                <p> Ativar Loja Virtual</p>
                <label>
                    <input name="status" type="radio" id="config_0" value="1" 
                           <?php 
                           if($verifica == 1):
                               echo "checked";
                           endif;
                           ?>
                            />
                    Ativar</label>
                <br />
                <label>
                    <input name="status" type="radio" name="config" value="0" id="config_1"
                           <?php 
                           if($verifica == 0):
                               echo "checked";
                           endif;
                           ?>/>
                    Inativo</label>
                 <br /><br />
                 
                 <input type="submit" value="ALTERAR" name='sendform' />
                
                

            </label>


        </form>
        
        <?php 

        
        if($verifica == 0):
            
            $exibe = "INATIVO";
            
            else:
            
                $exibe = "ATIVO";
        endif;
        
       echo "</br></br>"
        . "<h2> Olá ".$_SESSION['userlogin']['user_name']."   </h2>
        <p> Sua loja virtual esta <b>{$exibe}</b> no sistema. </p>";
        
        ?>
        
        

        <article>
            </section>