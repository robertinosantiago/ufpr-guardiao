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
	 * Verifica se os dados de acesso do usuário (email e senha) estão associados a um sistema.
	 * Este método retorna um array com as informaçõe do usuário ou falso caso o dados sejam
	 * inválidos
	 * @param string $email
	 * @param string $senha
	 * @param string $sistema
	 * @return array | boolean
	 */
	public function acessoSistema($email, $senha, $sistema) {
		$hasher = new HmacPasswordHasher();
		$options = array(
				'fields' => array('Usuario.id', 'Usuario.nome', 'Usuario.email'),
				'joins' => array(
						array(
								'table' => $this->tablePrefix . 'nivel_papel_sistema_usuarios',
								'alias' => 'NivelPapelSistemaUsuario',
								'type' => 'inner',
								'conditions' => array('Usuario.id = NivelPapelSistemaUsuario.usuario_id')
						),
						array(
								'table' => $this->tablePrefix . 'sistemas',
								'alias' => 'Sistema',
								'type' => 'inner',
								'conditions' => array('Sistema.id = NivelPapelSistemaUsuario.sistema_id')
						)
				),
				'conditions' => array(
						'Usuario.email' => $email,
						'Usuario.senha' => $hasher->hash($senha),
						'Sistema.hash' => $sistema,
						'Usuario.ativo' => TRUE,
						'Usuario.excluido' => FALSE,
						'Sistema.ativo' => TRUE,
						'Sistema.excluido' => FALSE
				),
				'recursive' => -1
		);
		$usuario = $this->find('first', $options);
		
		if ($usuario) {
			$papeis = $this->NivelPapelSistemaUsuario->listaPapeisPorHashSistema($usuario['Usuario']['id'], $sistema);
			$niveis = $this->NivelPapelSistemaUsuario->listaNiveisPorHashSistema($usuario['Usuario']['id'], $sistema);
			
			foreach ($papeis as $papel) {
				$dado['id'] = $papel['Papel']['id'];
				$dado['titulo'] = $papel['Papel']['titulo'];
				$usuario['Papel'][] = $dado;
			}
			
			foreach ($niveis as $nivel) {
				$dado['id'] = $nivel['Nivel']['id'];
				$dado['titulo'] = $nivel['Nivel']['titulo'];
				$usuario['Nivel'][] = $dado;
			}
			
			return $usuario;
		}
		
		return FALSE;
		
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