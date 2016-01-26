<?php

App::uses('AppModel', 'Model');

/**
 * Modelo que representa os Níveis de Usuários presentes no sistema
 */
class Nivel extends AppModel {

  public $validate = array(
    'titulo' => array(
      'rule' => 'notEmpty',
      'message' => 'O campo Título é obrigatório'
    )
  );
  
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
