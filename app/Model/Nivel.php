<?php

App::uses('AppModel', 'Model');

/**
 * Modelo que representa os Níveis de Usuários presentes no sistema
 * @author Robertino
 *
 */
class Nivel extends AppModel {
	
	public $hasMany = array('NivelSistema', 'NivelPapelSistemaUsuario');

  public $validate = array(
    'titulo' => array(
      'rule' => 'notEmpty',
      'message' => 'O campo Título é obrigatório'
    )
  );
  
  /**
   * Lista todos os níveis de acesso, em ordem alfabética de título,
   * registrados e que não estão excluídos
   */
  public function listarTodos() {
  	$options = array (
  			'fields' => array (
  					'Nivel.id',
  					'Nivel.titulo'
  			),
  			'recursive' => - 1,
  			'order' => array (
  					'Nivel.titulo' => 'asc'
  			),
  			'conditions' => array (
  					'Nivel.excluido' => 0
  			)
  	);
  	return $this->find ( 'list', $options );
  }
  
  /**
   * Lista todos os níveis de acesso relacionados a um sistema
   * @param integer $sistema_id
   */
  public function listarPorSistema($sistema_id) {
  	$options = array (
  			'fields' => array (
  					'Nivel.id',
  					'Nivel.titulo'
  			),
  			'joins' => array (
  					array (
  							'table' => $this->tablePrefix . 'nivel_sistemas',
  							'alias' => 'NivelSistema',
  							'type' => 'inner',
  							'conditions' => array (
  									'Nivel.id = NivelSistema.nivel_id'
  							)
  					)
  			)
  			,
  			'conditions' => array (
  					'NivelSistema.sistema_id' => $sistema_id,
  					'Nivel.excluido' => 0
  			),
  			'order' => array (
  					'Nivel.titulo' => 'asc'
  			),
  			'recursive' => - 1
  	);
  	return $this->find ('list', $options );
  }
  
  /**
   * Opções da paginação na view index
   * @return array
   */
  public function optionsPaginate() {
  	$options = array(
  			'limit' => 25,
  			'fields' => array('Nivel.id', 'Nivel.titulo'),
  			'conditions' => array('Nivel.excluido = 0'),
  			'order' => array('Nivel.titulo' => 'asc')
  	);
  	return $options;
  }

}
