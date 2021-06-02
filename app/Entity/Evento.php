<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Evento{
  public $idEvento;
  public $dtCriado;
  public $dtEvento;
  public $hrEvento;
  public $nmEvento;
  public $descEvento;
  public $qtPartsEvento;
  public $flEventoPrivado;
  public $localEvento;
  public $numLocalEvento;
  public $flAtivo;
  public $idGrupoCriou;

  public $table = 'evento';
  /**
   * Método responsável por cadastrar um novo evento no banco 
   * @return boolean
   */
  public function cadastrar(){
      //INSERIR NO BANCO 
      $obDatabase = new Database($this->table);
      $this->idEvento = $obDatabase->insert([
                                        'dtCriado' => $this->dtCriado,
                                        'dtEvento' => $this->dtEvento,
                                        'hrEvento' => $this->hrEvento,
                                        'nmEvento' => $this->nmEvento,
                                        'descEvento' => $this->descEvento,
                                        'qtPartsEvento' => $this->qtPartsEvento,
                                        'flEventoPrivado' => $this->flEventoPrivado,
                                        'LocalEvento' => $this->localEvento,
                                        'numLocalEvento' => $this->numLocalEvento,
                                        'flAtivo' => $this->flAtivo,
                                        'idGrupoCriou' => $this-> idGrupoCriou,
                                      ]);

      //RETORNAR SUCESSO
      return true;
  }

  /**
   * Método responsável por atualizar no banco de dados
   * @return boolean
   */
  public function atualizar(){
    return (new Database($this->table))->update('idEvento = '.$this->idEvento,[
                                      'dtCriado' => $this->dtCriado,
                                      'dtEvento' => $this->dtEvento,
                                      'hrEvento' => $this->hrEvento,
                                      'nmEvento' => $this->nmEvento,
                                      'descEvento' => $this->descEvento,
                                      'qtPartsEvento' => $this->qtPartsEvento,
                                      'flEventoPrivado' => $this->flEventoPrivado,
                                      'localEvento' => $this->localEvento,
                                      'numLocalEvento' => $this->numLocalEvento,
                                      'flAtivo' => $this->flAtivo,
                                      'idGrupoCriou' => $this-> idGrupoCriou,
                                                              ]);
  }

  /**
   * Método responsável por excluir um evento no banco de dados
   * @return boolean
   */
  public function excluir(){
    return (new Database($this->table))->delete('idEvento = '.$this->idEvento);
  }
  
  /**
   * Método responsável por inativar/fechar um evento
   */

  public function fechar(){
    return (new Database($this->table))->update('idEvento = '.$this->idEvento,[
                                        'flAtivo' => $this->flAtivo,
                                                              ]);
  }

  /**
   * Método responsável por obter os eventos do banco da dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public function getEventos($where = null, $order = null, $limit = null){
    return (new Database($this->table))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por obter a quantidade de eventos do banco da dados
   * @param  string $where
   * @return integer
   */
  public function getQntEventos($where = null){
    return (new Database($this->table))->select($where, null, null, null,'COUNT(*) as qtdEventos')
                                  ->fetchObject()
                                  ->qtdEventos;
  }

  /**
   * Método responsável por buscar um evento no banco de dados
   * @param  integer $id
   * @return Evento
   */
  public function getEvento($idEvento){
    return (new Database($this->table))->select('idEvento = '.$idEvento)
                                  ->fetchObject(self::class);
  }

}
