
        <?php
        
//        session_start();
//        
//        session_destroy();
        
//        unset($_COOKIE['loginprotege']);
        setcookie('loginprotege', null );
        
//        unset($_COOKIE['logprot_nome']);
        
        setcookie('logprot_nome', null);
        
       // unset($_COOKIE['logprot_id_usuario']);
        setcookie('logprot_id_usuario', null);
        
       // unset($_COOKIE['logprot_email']);
        setcookie('logprot_email', null);
        
       // unset($_COOKIE['logprot_nivel']);
        setcookie('logprot_nivel', null);
        
     //   unset($_COOKIE['logprot_relacionado']);
        setcookie('logprot_relacionado', null);
        
        echo "<meta http-equiv=\"refresh\" content=0;url=\"../index.php\">";
        
        
        ?>
