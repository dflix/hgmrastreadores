<?php


/**
 *  Tags.class.php[TIPO]
 * Classe responsavel por montar as tags do site
 * @copyright (c) year, Marcio Leite Up
 */
class Tags {
    
    private $File;
    private $Link;
    private $Data;
    private $Tags;
    
    /* dados povoados*/
    
    private $seoTags;
    private $seoData;
    
    function __construct($File , $Link) {
        $this->File = strip_tags(trim($File));
        $this->Link = strip_tags(trim($Link));
       
    }
    /**
     * Obter as tags title e description 
     */
    public function getTags() {
        $this->checkData();
        return $this->seoTags;
    }
    /**
     * Faz a captura com banco de dados do post 
     */
    public function getData() {
        $this->checkData();
        return $this->seoData;
    }
    
    //PRIVATES
    
    private function checkData() {
        if(!$this->seoData):
            $this->getSeo();
        endif;
        
    }
    
    private function getSeo() {
        
        $ReadSeo = new Read;
        
        switch ($this->File):
            
            case 'pagina':
                break;
            case 'categoria':
                break;
            case 'subcategoria':
                break;
            case 'busca':
                break;
            
            default :
            $this->Data = [SITENAME . ' Seu guia de comras ' . SITEDESC ];
        endswitch;
        
    }
    
    private function verifica() {
        
    }
    

    
}
