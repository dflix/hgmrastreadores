<?php

/**
 *  Configuracoes.class.php[TIPO]
 * Calsse responsavel por resolver e se comunicar com base configurações do painel 
 * Logotipo / midias socias / Telefones / inserir scripts
 * @copyright (c) year, Marcio Leite Up
 */
class Configuracoes {

    private $Data;
    private $Imagem;
    private $Error;
    private $Result;

    const Entity = 'ws_logotipo';

    public function ExeCreate(array $Data) {
$this->Create();
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }


    private function Create() {
        

        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O logotipo  foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

}
