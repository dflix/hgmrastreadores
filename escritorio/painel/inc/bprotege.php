



<script type='text/javascript' src='js/jquery.js'></script>

<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>
<main> 

    <h3>Receber informações  </h3>

    <?php


    
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    $enviar = new EnviaProtocolo();
    
                    $form['assunto'] = 'Protocolo de Atendimento Rastreadores Protege';
                    $form['DestinoNome'] = 'comercial@protegefacil.com.br';
                    //$contato['DestinoEmail'] = 'comercial@protegefacil.com.br';
                    $form['DestinoEmail'] = $_POST['email'];
    
    $enviar->Enviar($form);
    $enviar->getResult();
    
    if($enviar->getResult()):
        
        echo "Enviado com sucesso";
        
        else:
        
        echo "Erro ao enviar";
    endif;
    
    
    unset($form['cadastro']);
    unset($form['DestinoNome']);
    unset($form['DestinoEmail']);
    unset($form['assunto']);
    
    $cadastro = new Create();
    $cadastro->exeCreate("atendimentoprotege", $form);
    $cadastro->getResult();
    
    if($cadastro->getResult()):
        
        echo "<div class=\"alert alert-success\" role=\"alert\">Cadastro Realizado com Sucesso cliente {$form['cliente']} Atendente {$form['atendente']}</div>";
        echo "<meta http-equiv=\"refresh\" content=5;url=\"index.php?p=eprotege\">";
      else:
          echo "<div class=\"alert alert-danger\" role=\"alert\">Ops, deu alguma merda, chame o Disbiriflix</div>";
    endif;
    
   //var_dump($form);
    
    ?>
    </main>