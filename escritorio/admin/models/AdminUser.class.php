<?php

/**
 *  AdminUser.class.php[TIPO]
 * Classe responsavel por cadastrar usuarios no sistema
 * @copyright (c) year, Marcio Leite Up
 */
class AdminUser {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    const Entity = 'ws_users';


    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->setName();
        
        $this->Create();
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }
    
    public function ExeDelete($UserId) {
        $this->Post = $UserId;
        
        $deleta = new Delete;
        $deleta->ExeDelete(self::Entity, "WHERE user_id = :p", "p={$UserId}");
        
         $this->Error = ["O usuario <b>{$UserId['user_name']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
         $this->Result = true;
        
    }

    private function setName() {
        
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE user_email = :t ", "t={$this->Data['user_email']}");
        if($readName->getResult()):
            echo " Ja existe um cadastro com esse email";
        echo " <a href='painel.php?p=iusuario'> voltar </a>";
        die;
 
        endif;


    }
    
    private function Create() {
        $cad = new Create;
        $cad->ExeCreate(self::Entity, $this->Data);
        $cad->getResult();
        if(!empty($cad->getResult())):
            echo "cadastro com sucesso";
            else:
            echo "deu merda";
        endif;
        
    }
    
        

}
