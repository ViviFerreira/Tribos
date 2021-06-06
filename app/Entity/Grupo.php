<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Grupo{
  public $idGrupo;
  public $nmGrupo;
  public $descGrupo;
  public $flAtivo;
  public $idUsuarioCriou;
  
  public $table = 'grupo';
  /**
   * Método responsável por cadastrar um novo grupo no banco 
   * @return boolean
   */
  public function cadastrar(){
    //VERIFICA SE O GRUPO/TRIBO JÁ EXISTE
    $obDatabase = new Database($this->table);
    //MONTA A QUERY
    $query = "SELECT idGrupo FROM grupo WHERE nmGrupo = '{$this->nmGrupo}'";
    //EXECUTA A QUERY
    $query = $obDatabase->execute($query);
    if($query->rowCount() > 0){
    //CASO EXISTA RETORNA FALSE
      return false;
    }else{
      //INSERIR NO BANCO 
      $obDatabase = new Database($this->table);
      $this->idGrupo = $obDatabase->insert([
                                        'nmGrupo'   => $this->nmGrupo,
                                        'descGrupo' => $this->descGrupo,
                                        'flAtivo' => $this->flAtivo,
                                        'idUsuarioCriou' => $this->idUsuarioCriou,
                                      ]);

      //RETORNAR SUCESSO
      return true;
  }
}
  /**
   * Método responsável por atualizar no banco de dados
   * @return boolean
   */
  public function atualizar(){
    return (new Database($this->table))->update('idGrupo = '.$this->idGrupo,[
                                        'nmGrupo'   => $this->nmGrupo,
                                        'descGrupo' => $this->descGrupo,
                                        'flAtivo' => $this->flAtivo,
                                        'idUsuarioCriou' => $this->idUsuarioCriou,
                                                              ]);
  }

  /**
   * Método responsável por excluir um grupo no banco de dados
   * @return boolean
   */
  public function excluir(){
    return (new Database($this->table))->delete('idGrupo = '.$this->idGrupo);
  }
  
  
  /**
   * Método responsável por obter os grupos do banco da dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public function getGrupos($where = null, $and = null, $order = null, $limit = null){
    return (new Database($this->table))->select($where, $and, $order, $limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por obter a quantidade de grupos do banco da dados
   * @param  string $where
   * @return integer
   */
  public function getQntGrupos($where = null){
    return (new Database($this->table))->select($where, null, null, null,'COUNT(*) as qtdGrupos')
                                  ->fetchObject()
                                  ->qtdGrupos;
  }



  /**
   * Método responsável por buscar um grupo no banco de dados
   * @param  integer $id
   * @return Grupo
   */
  public function getGrupo($idGrupo){
    return (new Database($this->table))->select('idGrupo = '.$idGrupo)
                                  ->fetchObject(self::class);
  }

}