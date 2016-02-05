<?php
App::uses ( 'AppModel', 'Model' );

/**
 * Modelo que representa os papeis disponíveis dentro do sistema
 *
 * @author Robertino
 *        
 */
class Papel extends AppModel {
	public $hasMany = array('PapelSistema', 'NivelPapelSistemaUsuario');
	
	public $validate = array (
			'titulo' => array (
					'rule' => 'notEmpty',
					'message' => 'O campo Título é obrigatório' 
			) 
	);
	
	/**
	 * Lista todos os papeis, em ordem alfabética de título,
	 * registrados e que não estão excluídos
	 */
	public function listarTodos() {
		$options = array (
				'fields' => array (
						'Papel.id',
						'Papel.titulo' 
				),
				'recursive' => - 1,
				'order' => array (
						'Papel.titulo' => 'asc' 
				),
				'conditions' => array (
						'Papel.excluido' => 0 
				) 
		);
		return $this->find ( 'list', $options );
	}
	
	/**
	 * Lista todos os papeis relacionados a um sistema
	 * @param integer $sistema_id
	 */
	public function listarPorSistema($sistema_id) {
		$options = array (
				'fields' => array (
						'Papel.id',
						'Papel.titulo' 
				),
				'joins' => array (
						array (
								'table' => $this->tablePrefix . 'papel_sistemas',
								'alias' => 'PapelSistema',
								'type' => 'inner',
								'conditions' => array (
										'Papel.id = PapelSistema.papel_id' 
								) 
						) 
				)
				,
				'conditions' => array (
						'PapelSistema.sistema_id' => $sistema_id,
						'Papel.excluido' => 0 
				),
				'order' => array (
						'Papel.titulo' => 'asc' 
				),
				'recursive' => - 1 
		);
		return $this->find ('list', $options );
	}
	
	/**
	 * Opções da paginação na view index
	 *
	 * @return array
	 */
	public function optionsPaginate() {
		$options = array (
				'limit' => 25,
				'fields' => array (
						'Papel.id',
						'Papel.titulo' 
				),
				'conditions' => array (
						'Papel.excluido = 0' 
				),
				'order' => array (
						'Papel.titulo' => 'asc' 
				) 
		);
		return $options;
	}
}