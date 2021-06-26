<?php


/**
 *  Create.class.php[TIPO]
 * Classe criada para gerenciar instruções mysql para o banco
 * @copyright (c) year, Marcio Leite Up
 */
class Create extends Conn {
    
    private $Tabela;
    private $Dados;
    private $Result;
    
    /**@var PDOstatement*/
    private $Create; 
    
    /** @var PDO*/
    private $Conn;
    
    /**
     * <br> ExeCreate: </br> Executa um cadastro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array atribuitivo com nome de coluna e valor
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco
     * @param array $Dados = Informe um array atribuitivo ( Nome da Coluna => Valor )
     */
    
    public function exeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Tabela = $Dados;
        
        $this->getSyntaxe();
        
    }
    
    /**
     * Essa função cria o resultado para manipular os dados
     */
    public function getResult() {
        
        return $this->Result;
    }
    
    /**
     * ****************************************
     * **********PRIVATE METHODS***************
     * ****************************************
     */
    
    private function Connect() {
        $this->Conn = parent::getConn();//ja obtive a conexão ja tenho meu PDO
        $this->Create = $this->Conn->prepare($this->Create);
        
    }
    
    private function getSyntaxe() {
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})"; //isso vai montar a query
         
    }
    
   private function Execute() {
       
   }
    
    
}
