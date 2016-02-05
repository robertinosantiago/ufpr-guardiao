<?php
App::uses ( 'AppModel', 'Model' );
App::uses ( 'HmacPasswordHasher', 'Controller/Component/Auth' );

/**
 * Modelo que representa os sistemas que serão gerenciados
 *
 * @author Robertino
 *        
 */
class Sistema extends AppModel {
	
	public $hasMany = array('NivelSistema', 'PapelSistema', 'NivelPapelSistemaUsuario');
	
	public $validate = array (
			'nome' => array (
					'rule' => 'notEmpty',
					'message' => 'O nome do sistema deve ser preenchido' 
			) 
	);
	
	/**
	 * Opções da paginação na view index
	 *
	 * @return array
	 */
	public function optionsPaginate() {
		$options = array (
				'limit' => 25,
				'fields' => array (
						'Sistema.id',
						'Sistema.nome',
						'Sistema.ativo' 
				),
				'conditions' => array (
						'Sistema.excluido = 0' 
				),
				'order' => array (
						'Sistema.nome' => 'asc' 
				) 
		);
		return $options;
	}
	
	
	
	/**
	 * Retorna um registro específico, indexado pelo ID
	 * @param integer $id
	 */
	public function buscarPorId($id) {
		$options = array(
				'fields' => array(
						'Sistema.id',
						'Sistema.nome',
						'Sistema.descricao'
				),
				'conditions' => array(
						'Sistema.excluido' => 0,
						'Sistema.id' => $id
				),
				'recursive' => -1
		);
		return $this->find('first', $options);
	}
	
	
	
	/**
	 * Gera um novo hash quando um novo registro é inserido
	 *
	 * {@inheritDoc}
	 *
	 * @see Model::beforeSave()
	 */
	public function beforeSave($options = array()) {
		if (array_key_exists ( 'id', $this->data ['Sistema'] ) && empty ( $this->data ['Sistema'] ['id'] )) {
			$hasher = new HmacPasswordHasher ();
			$this->data ['Sistema'] ['hash'] = $hasher->hash ( time () . rand () );
		}
		return parent::beforeSave ( $options );
	}
	
	/**
	 * Altera para texto a informação contida no campo ativo (0 = Não e 1 = Sim)
	 * 
	 * {@inheritDoc}
	 *
	 * @see Model::afterFind()
	 */
	public function afterFind($results, $primary = false) {
		foreach ( $results as $key => $value ) {
			if (isset ( $value ['Sistema'] ['ativo'] )) {
				$results [$key] ['Sistema'] ['ativoTexto'] = ($results [$key] ['Sistema'] ['ativo'] ? __ ( 'Sim' ) : __ ( 'Não' ));
			}
		}
		return parent::afterFind ( $results, $primary );
	}
}