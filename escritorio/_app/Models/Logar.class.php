<?php

/**
 * Logar.class.php [ Model ]
 * Faz o login no sistema e direciona de acordo com nivel do usuario
 * @copyright (c) year, Marcio Leite 
 */
class Logar {

    private $Email;
    private $Senha;
    private $Error;
    private $Result;

    function __construct() {
        $this->Email = $_POST['email'];
        $this->Senha = $_POST['senha'];
        
        $this->Verifica();
    }
    
    //nivel1 1 = admin , nivel 2 = vendedor , nivel 3 = instalador, nivel 4 = lider  nivel 5 =lojista nivel 6 gerente

    private function Verifica() {

        $this->Email = $this->Email;
        $this->Senha = $this->Senha;

        $ler = new Read();
        $ler->ExeRead("usuario", "WHERE email= :e AND senha= :s", "e={$this->Email}&s={$this->Senha}");
        $ler->getResult();

        if (!empty($ler->getResult()[0]["nome"])):
            
                        
        $_SESSION['nome'] = setcookie('logprot_nome', "{$ler->getResult()[0]["nome"]}", (time() + (1 * 24 * 3600)));
        $_SESSION['id_usuario'] = setcookie('logprot_id_usuario', "{$ler->getResult()[0]["id_usuario"]}", (time() + (1 * 24 * 3600)));
        $_SESSION['email'] = setcookie('logprot_email', "{$ler->getResult()[0]["email"]}", (time() + (1 * 24 * 3600)));
        $_SESSION['nivel'] = setcookie('logprot_nivel', "{$ler->getResult()[0]["nivel"]}", (time() + (1 * 24 * 3600)));
        $_SESSION['relacionado'] = setcookie('logprot_relacionado', "{$ler->getResult()[0]["relacionado"]}", (time() + (1 * 24 * 3600)));
      
            
//        $_SESSION['nome'] = $ler->getResult()[0]["nome"];
//        $_SESSION['id_usuario'] = $ler->getResult()[0]["id_usuario"];
//        $_SESSION['email'] = $ler->getResult()[0]["email"];
//        $_SESSION['nivel'] = $ler->getResult()[0]["nivel"];
//        $_SESSION['relacionado'] = $ler->getResult()[0]["relacionado"];
//        
//         setcookie('loginprotege', "{$ler->getResult()[0]["nome"]}", (time() + (1 * 24 * 3600)));
        
        if($_SESSION['nivel'] == "1"){
            //administrador
          echo "<meta http-equiv=\"refresh\" content=1;url=\"painel/\">";  

        }
        if($_SESSION['nivel'] == "2"){
//            echo "redirecionando para /vendedor";
              echo "<meta http-equiv=\"refresh\" content=1;url=\"painel/\">";  
        }
        if($_SESSION['nivel'] == "3"){
//            echo "redirecionando para /instalador";
              echo "<meta http-equiv=\"refresh\" content=1;url=\"painel/\">";  
            //header("location:instalador/");
        }
        if($_SESSION['nivel'] == "4"){
              echo "<meta http-equiv=\"refresh\" content=1;url=\"painel/\">";  
//            echo "redirecionando para /lider";
           // header("location:lider/");
        }
        if($_SESSION['nivel'] == "5"){
              echo "<meta http-equiv=\"refresh\" content=1;url=\"painel/\">";  
//            echo "redirecionando para /lojista";
            //header("location:lojista/");
        }
        if($_SESSION['nivel'] == "6"){
              echo "<meta http-equiv=\"refresh\" content=1;url=\"painel/\">";  
//            echo "redirecionando para /seo";
           // header("location:seo/");
        }
        
           // header('location:painel.php');
            echo "<div class=\"alert alert-success\" role=\"alert\">Usuário encontrado aguarde redirecionamento</div>";
            echo "</br>";
            echo $_SESSION['nome'] . '/' . $_SESSION['nivel'];
        else:
            echo "<div class=\"alert alert-danger\" role=\"alert\">Usuário ou senha incorretos</div>";
        endif;
    }

}
