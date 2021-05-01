<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Usuario{
  public $idUsuario;
  public $nmUsuario;
  public $emailUsuario;
  public $senhaUsuario;
  
  public $table = 'usuario';
  /**
   * Método responsável por cadastrar um novo usuário no banco 
   * @return boolean
   */
  public function cadastrar(){
    //VERIFICA SE O EMAIL JÁ EXISTE
    $obDatabase = new Database($this->table);
    //MONTA A QUERY
    $query = "SELECT idUsuario FROM usuario WHERE emailUsuario = '{$this->emailUsuario}'";
    //EXECUTA A QUERY
    $query = $obDatabase->execute($query);
    if($query->rowCount() > 0){
    //CASO EXISTA RETORNA FALSE
      return false;
    }else{
      //INSERIR USUARIO NO BANCO 
      $obDatabase = new Database($this->table);
      $this->idUsuario = $obDatabase->insert([
                                        'nmUsuario'    => $this->nmUsuario,
                                        'emailUsuario' => $this->emailUsuario,
                                        'senhaUsuario' => md5($this->senhaUsuario),
                                      ]);

      //RETORNAR SUCESSO
      return true;
  }
}

public function logar(){
  //VERIFICA SE EMAIL E SENHA CORRESPONDEM 
  $senhaMd5 = md5($this->senhaUsuario);
  $obDatabase = new Database($this->table);
  //MONTA A QUERY
  $query = "SELECT idUsuario FROM usuario WHERE emailUsuario = '{$this->emailUsuario}' AND senhaUsuario = '$senhaMd5'";
  //EXECUTA A QUERY
  $query = $obDatabase->execute($query);
  
  if($query->rowCount() > 0){
    //ESTA CADASTRADA
    $dadoUser = $query->fetch(PDO::FETCH_ASSOC);
    session_start();
    $_SESSION['idUsuario'] = $dadoUser['idUsuario']; 
    return true;
  }else{
    //NÃO ESTÁ CADASTRADA
    return false;
  }
}

  /**
   * Método responsável por atualizar o usuario no banco de dados
   * @return boolean
   */
  public function atualizar(){
    return (new Database($this->table))->update('idUsuario = '.$this->idUsuario,[
                                    'nmUsuaio'     => $this->nmUsuario,
                                    'emailUsuario' => $this->emailUsuario,
                                    'senhaUsuario' => $this->senhaUsuario,
                                                              ]);
  }

  /**
   * Método responsável por excluir um usuário no banco de dados
   * @return boolean
   */
  public function excluir(){
    return (new Database($this->table))->delete('idUsuario = '.$this->idUsuario);
  }

  /**
   * Método responsável por obter os usuários do banco da dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public function getUsuarios($where = null, $order = null, $limit = null){
    return (new Database($this->table))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por buscar um usuário no banco de dados
   * @param  integer $id
   * @return Grupo
   */
  public function getUsuario($idUsuario){
    return (new Database($this->table))->select('idUsuario = '.$idUsuario)
                                  ->fetchObject(self::class);
  }

}