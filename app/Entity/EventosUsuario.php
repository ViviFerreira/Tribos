<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class EventosUsuario{
  public $idEventosUsuario;
  public $idEvento;
  public $idUsuario;
  
  public $table = 'eventosusuario';
  /**
   * Método responsável por cadastrar um novo usuario do evento 
   * @return boolean
   */
  public function participar(){
      //INSERIR NO BANCO 
      $obDatabase = new Database($this->table);
      $this->idEventosUsuario = $obDatabase->insert([
                                        'idEvento' => $this->idEvento,
                                        'idUsuario' => $this->idUsuario,
                                      ]);

      //RETORNAR SUCESSO
      return true;
  }

  /**
   * Método responsável por excluir o evento do usuario 
   * @return boolean
   */
  public function sair($idEvento, $idUsuario){
    return (new Database($this->table))->delete('idEvento = '.$idEvento, 'idUsuario = '.$idUsuario);
  }

  /**
   * Método responsável por obter todos os eventos dos usuarios
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public function getEventosUsuario($where = null, $order = null, $limit = null){
    return (new Database($this->table))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por buscar eventos de um usuário 
   * @param  integer $id
   * @return EventosUsuario
   */
  public function getEventoUsuario($idEvento, $idUsuario){
    return (new Database($this->table))->select('idEvento = '.$idEvento, 'idUsuario = '.$idUsuario)
                                  ->fetchObject(self::class);
  }

}