<?php

/**
 *  View.class.php[HELPERS]
 * Classe por carregar template, povoar e exibir a View , povoar e incluir arquivos php no sistema
 * @copyright (c) year, Marcio Leite Up
 */
class View {

    private static $Data;
    private static $Keys;
    private static $Values;
    private static $Template;

   /**
     * <b>Carregar Template View:</b> informe o caminho e o nome do arquivo que deseja carregar como view.
     * Não precisa informar extenção. O arquivo deve ter o formato view<b>.tpl.html</b>
     * @param STRING $Template = Caminho / Nome_do_arquivo
     */
    public static function Load($Template) {
        self::$Template = (string) $Template;
        self::$Template = file_get_contents(self::$Template . '.tpl.html');
        
        
    }

    public static function Show(array $Data) {
        self::setKeys($Data);
        self::setValues();
        self::showView();
    }

    public static function Request($File, array $Data) {
        extract($Data);
        require("{$File}.inc.php");
    }

    //PRIVATES

    private static function setKeys($Data) {
        self::$Data = $Data;
        self::$Keys = explode( '&' ,'#' . implode ('#&#', array_keys(self::$Data)) . '#');
        
    }
       
    //Obtém os valores a serem inseridos nas chaves da view.
    private static function setValues() {
        self::$Values = array_values(self::$Data);
    }
    
    private static function showView() {
        echo str_replace(self::$Keys, self::$Values, self::$Template);
    }

}
