<?php
App::uses('AppModel', 'Model');
App::uses ( 'HmacPasswordHasher', 'Controller/Component/Auth' );

class Usuario extends AppModel {
	
	public $hasMany = array('NivelPapelSistemaUsuario');
	
	public $validate = array(
			'nome' => array(
					'rule' => 'notEmpty',
					'message' => 'O campo Nome é obrigatório'
			),
			'email' => array(
					'email' => array(
							'rule' => 'email',
							'message' => 'Formato de email inválido'
					),
					'unico' => array(
							'rule' => array('emailUnico'),
							'on' => 'create',
							'message' => 'Este email já está sendo utilizado'
					)
			),
			'senha' => array(
					'rule' => 'notEmpty',
					'message' => 'O campo Senha é obrigatório'
			)
	);
	
	/**
	 * Regra de validação. Evita que um email seja cadastrado
	 * mais de uma vez sem estar excluído
	 * @param array $check
	 * @return boolean
	 */
	public function emailUnico($check) {
		$options = array(
				'conditions' => array(
						'email' => $check['email'],
						'excluido' => 0
				),
				'recursive' => -1
		);
		$total = $this->find('count', $options);
		return $total <= 0;
	}
	
	/**
	 * Lista todos os usuários, em ordem alfabética de nome,
	 * registrados e que não estão excluídos
	 */
	public function listarTodos() {
		$options = array (
				'fields' => array (
						'Usuario.id',
						'Usuario.nome'
				),
				'recursive' => - 1,
				'order' => array (
						'Usuario.nome' => 'asc'
				),
				'conditions' => array (
						'Usuario.excluido' => 0
				)
		);
		return $this->find ( 'list', $options );
	}
	
	/**
	 * Opções da paginação na view index
	 * @return array
	 */
	public function optionsPaginate() {
		$options = array (
				'limit' => 25,
				'fields' => array (
						'Usuario.id',
						'Usuario.nome',
						'Usuario.email',
						'Usuario.ativo'
				),
				'conditions' => array (
						'Usuario.excluido = 0'
				),
				'order' => array (
						'Usuario.nome' => 'asc'
				)
		);
		return $options;
	}
	
	/**
	 * Encripta a senha quando um novo registro é inserido
	 *
	 * {@inheritDoc}
	 *
	 * @see Model::beforeSave()
	 */
	public function beforeSave($options = array()) {
		$hasher = new HmacPasswordHasher();
		
		if (isset($this->data['Usuario']['senha']) && !empty($this->data['Usuario']['senha'])) {
			$this->data['Usuario']['senha'] = $hasher->hash($this->data['Usuario']['senha']);
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
			if (isset ( $value ['Usuario'] ['ativo'] )) {
				$results [$key] ['Usuario'] ['ativoTexto'] = ($results [$key] ['Usuario'] ['ativo'] ? __ ( 'Sim' ) : __ ( 'Não' ));
			}
		}
		return parent::afterFind ( $results, $primary );
	}
}