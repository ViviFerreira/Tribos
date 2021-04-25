<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class GruposUsuario{
  public $idGrupoUsuario;
  public $idGrupo;
  public $idUsuario;
  public $table = 'gruposusuario';
  /**
   * Método responsável por cadastrar um novo grupo do usuário
   * @return boolean
   */
  public function participar(){
      //INSERIR NO BANCO 
      $obDatabase = new Database($this->table);
      $this->idGrupo = $obDatabase->insert([
                                        'idGrupo' => $this->idGrupo,
                                        'idUsuario' => $this->idUsuario,
                                      ]);

      //RETORNAR SUCESSO
      return true;
  }

  /**
   * Método responsável por excluir o grupo do usuario 
   * @return boolean
   */
  public function sair($idUsuario, $idGrupo){
    return (new Database($this->table))->delete('idUsuario = '.$idUsuario, 'idGrupo = '.$idGrupo);
  }

  /**
   * Método responsável por obter todos os grupos dos usuarios
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public function getGruposUsuario($where = null, $order = null, $limit = null){
    return (new Database($this->table))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por buscar grupos de um usuário 
   * @param  integer $id
   * @return GrupoUsuario
   */
  public function getGrupoUsuario($idUsuario, $idGrupo){
    return (new Database($this->table))->select('idUsuario = '.$idUsuario, 'idGrupo = '.$idGrupo)
                                  ->fetchObject(self::class);
  }

}