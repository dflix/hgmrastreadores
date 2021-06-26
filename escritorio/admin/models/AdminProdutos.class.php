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
class AdminProdutos  {

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

        $this->Data['prod_categ'] = $_POST['prod_categ'];
        $this->Data['prod_slug'] = Check::Name($_POST['prod_nome']);
        $this->Data['prod_nome'] = $_POST['prod_nome'];
        $this->Data['prod_title'] = $_POST['prod_title'];
        $this->Data['prod_description'] = $_POST['prod_description'];
        $this->Data['prod_desc_curta'] = $_POST['prod_desc_curta'];
        $this->Data['prod_content'] = $_POST['prod_content'];
        $this->Data['prod_cover'] = $_FILES['post_cover'];
        $this->Data['prod_status'] = $_POST['prod_status'];
        $this->Data['prod_valor'] = $_POST['prod_valor'];
    }



}
