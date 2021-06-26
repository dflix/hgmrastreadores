<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe responsavel por inserir, editar e excluir produtos da loja virtual
 *
 * @author Marcio Leite
 */
class AdminProdutos {
    
    private $Data;
    private $Result;
    private $Error;
    
    const Entity = "ws_prod";
    
    function __construct() {
        
        $this->setData();
        
    }
    
    public function exeCreate(array $Dados) {
        $this->Data = $this->Data;
        
        
        
    }
    
    private function setData() {
        $Cover = $this->Data['prod_cover'];
        
        $this->Data['prod_categ'] = $this->Data['prod_categ'];
        
    }
    
    

    
}
