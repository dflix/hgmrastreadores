<?php

// CONFIGRAÇÕES DO SITE ####################

define('HOST','www.hgmrastreadores.com.br');
define('USER','hgmras52_dflix');
define('PASS','dflix7778');
define('DBSA','hgmras52_dflix');

// DEFINE SERVIDOR DE E-MAIL ################
define('MAILUSER', 'contato@hgmrastreadores.com.br');
define('MAILPASS', 'dflix7778');
define('MAILPORT', '587');
define('MAILHOST', 'mail.hgmrastreadores.com.br');

// DEFINE IDENTIDADE DO SITE ################
define('SITENAME', 'HGM Rastreadores com Seguro');
define('SITEDESC', 'Rastreamento com seguro para carros, utilitários e caminhão, cobertura roubo furto acidentes e assistencia 24hs');

// DEFINE A BASE DO SITE ####################
define('HOME', 'http://localhost/hgmrastreadores');
define('THEME', 'moderna');

define('INCLUDE_PATH', HOME .  '/' . 'themes' .  '/' . THEME);
define('REQUIRE_PATH', 'themes' . '/' . THEME);


// AUTO LOAD DE CLASSES ####################
function __autoload($Class) {
	

    $cDir =  [ 'Conn' , 'Helpers' , 'Models' ];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists("".__DIR__."/{$dirName}/{$Class}.class.php") && !is_dir("".__DIR__."/{$dirName}/{$Class}.class.php")):
            include_once (  "".__DIR__."/{$dirName}/{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi poss�vel incluir ".__DIR__."/{$dirName}/{$Class}.class.php", E_USER_ERROR);
        die;
    endif;
 
}

// TRATAMENTO DE ERROS #####################
//CSS constantes :: Mensagens de Erro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

//WSErro :: Exibe erros lançados :: Front
function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie):
        die;
    endif;
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');
