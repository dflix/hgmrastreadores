<?php

/**
 * Classe responsavel por cadastrar, atualizar e editar categorias dos produtos
 *
 * @author Marcio Leite
 */
class AdminProdCateg {

    private $Dados;
    private $Parente;
    private $Error;
    private $Result;

    const Entity = 'ws_categprod';

    function __construct() {
        //$this->Dados = $Dados;
        
        if(!empty($_GET['del'])):
            $this->Deleta();
        endif;

        if ($_POST['sendpost'] == "ATUALIZAR"):
            $this->setAtualiza();
            $this->Atualiza();
        endif;

        if ($_POST['sendpost'] == "CADASTRAR"):
            $this->setData();
            $this->Verifica();
            $this->Cadastra();
        endif;
    }

    public function ExeCreate(array $Dados) {
        $this->Dados = $Dados;
        if (in_array('', $this->Dados)):
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Para cadastrar uma categoria, preencha todos os campos!', WS_ALERT];

        else:
            $this->setData();


        endif;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    //Valida e cria os dados para realizar o cadastro

    public function setData() {


        $this->Dados['categprod_parent'] = ($_POST['categprod_parent'] == '' ? 0 : $_POST['categprod_parent']);
        $this->Dados['categprod_name'] = Check::Name($_POST['categprod_title']);
        $this->Dados['categprod_title'] = $_POST['categprod_title'];
        $this->Dados['categprod_description'] = $_POST['categprod_description'];
        $this->Dados['categprod_content'] = $_POST['categprod_content'];
        $this->Dados['categprod_date'] = $_POST['categprod_date'];
    }

    public function setAtualiza() {


        $this->Dados['categprod_parent'] = ($_POST['categprod_parent'] == '' ? 0 : $_POST['categprod_parent']);
        //$this->Dados['categprod_name'] = Check::Name($_POST['categprod_title']);
        $this->Dados['categprod_title'] = $_POST['categprod_title'];
        $this->Dados['categprod_description'] = $_POST['categprod_description'];
        $this->Dados['categprod_content'] = $_POST['categprod_content'];
        $this->Dados['categprod_date'] = $_POST['categprod_date'];
    }

    //PRIVATES

    private function Verifica() {
        $verifica = new Read;
        $verifica->ExeRead("ws_categprod", "WHERE categprod_title = :p", "p={$this->Dados['categprod_title']}");
        $verifica->getResult();
        if ($verifica->getResult()):
            $this->Dados['categprod_name'] = $this->Dados['categprod_name'] . '-' . $verifica->getRowCount();

        else:
            $this->Dados['categprod_name'] = Check::Name($_POST['categprod_title']);
        endif;
    }

    private function Atualiza() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Dados, "WHERE categprod_id = :p", "p={$_POST['id']}");
        $update->getResult();
        if (!empty($update->getResult())):
            WSErro("Categoria atualizada com Sucesso", WS_ACCEPT);

        else:
            WSErro("Categoria não atualizada , erro no sistema ", WS_ERROR);
        endif;
    }

    private function Cadastra() {
        $create = new Create;
        $create->ExeCreate(self::Entity, $this->Dados);
        $create->getResult();

        if (!empty($create->getResult())):
            WSErro("Categoria cadastrada com Sucesso", WS_ACCEPT);

        else:
            WSErro("Categoria não cadastrada , erro no sistema ", WS_ERROR);
        endif;
    }
    
    private function Deleta() {
        $del = new Delete;
        $del->ExeDelete(self::Entity, "WHERE categprod_id = :p", "p={$_GET['del']}");
        $del->getResult();
        
        if (!empty($del->getResult())):
            WSErro("Categoria deletada com Sucesso", WS_ACCEPT);

        else:
            WSErro("Categoria não deletada , erro no sistema ", WS_ERROR);
        endif;
        
    }

}
