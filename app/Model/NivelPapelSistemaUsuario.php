<?php
App::uses('AppModel', 'Model');

class NivelPapelSistemaUsuario extends AppModel {
	
	public $belongsTo = array('Nivel', 'Papel', 'Sistema', 'Usuario');
	
	/**
	 * Retorna a listagem dos Usuários associados a um Sistema de acordo com o Nível
	 * de Acesso e o Papel
	 * @param integer $nivel_id
	 * @param integer $papel_id
	 * @param integer $sistema_id
	 * @return array
	 */
	public function listaUsuarios($nivel_id, $papel_id, $sistema_id) {
		$options = array(
				'fields' => array(
						'Usuario.id',
						'Usuario.nome'
				),
				'joins' => array(
						array(
								'table' => $this->tablePrefix . 'usuarios',
								'alias' => 'Usuario',
								'type' => 'inner',
								'conditions' => array('Usuario.id = NivelPapelSistemaUsuario.usuario_id')
						)
				),
				'conditions' => array(
						'NivelPapelSistemaUsuario.nivel_id' => $nivel_id,
						'NivelPapelSistemaUsuario.papel_id' => $papel_id,
						'NivelPapelSistemaUsuario.sistema_id' => $sistema_id
				),
				'order' => array(
						'Usuario.nome' => 'asc'
				),
				'recursive' => -1
		);
		return $this->find('list', $options);
	}
	
	/**
	 * Adiciona Usuários a um Sistema de acordo com o Nível de Acesso e o Papel
	 * @param integer $nivel_id
	 * @param integer $papel_id
	 * @param integer $sistema_id
	 * @param array $usuarios
	 */
	public function adicionaUsuarios($nivel_id, $papel_id, $sistema_id, $usuarios) {
		foreach ($usuarios as $usuario) {
			$dados = array(
					'NivelPapelSistemaUsuario' => array(
							'nivel_id' => $nivel_id,
							'papel_id' => $papel_id,
							'sistema_id' => $sistema_id,
							'usuario_id' => $usuario
					)
			);
			try {
				$this->saveAll($dados, array('validate' => 'first'));
			} catch (Exception $e) {
			}
		}
	}
	
	/**
	 * Remove Usuários de um Sistema de acordo com o Nível de Acesso e o Papel
	 * @param integer $nivel_id
	 * @param integer $papel_id
	 * @param integer $sistema_id
	 * @param array $usuarios
	 */
	public function removeUsuarios($nivel_id, $papel_id, $sistema_id, $usuarios) {
		foreach ($usuarios as $usuario) {
			$options = array(
					'fields' => array(
							'NivelPapelSistemaUsuario.id'
					),
					'conditions' => array(
							'papel_id' => $papel_id,
							'nivel_id' => $nivel_id,
							'sistema_id' => $sistema_id,
							'usuario_id' => $usuario
					),
					'recursive' => -1
			);
			$dados = $this->find('first', $options);
			try {
				$this->delete($dados['NivelPapelSistemaUsuario']['id']);
			} catch (Exception $e) {
			}
		}
	}
	
	/**
	 * Retorna a lista de Papéis de um Usuário para um determinado sistema. O sistema é localizado
	 * por meio do código HASH atribuído no banco de dados.
	 * @param integer $usuario_id
	 * @param string $hash_sistema
	 * @return array
	 */
	public function listaPapeisPorHashSistema($usuario_id, $hash_sistema) {
		$options = array(
				'fields' => array('Papel.id', 'Papel.titulo'),
				'joins' => array(
						array(
								'table' => $this->tablePrefix . 'usuarios',
								'alias' => 'Usuario',
								'type' => 'inner',
								'conditions' => array('Usuario.id = NivelPapelSistemaUsuario.usuario_id')
						),
						array(
								'table' => $this->tablePrefix . 'papels',
								'alias' => 'Papel',
								'type' => 'inner',
								'conditions' => array('Papel.id = NivelPapelSistemaUsuario.papel_id')
						),
						array(
								'table' => $this->tablePrefix . 'papel_sistemas',
								'alias' => 'PapelSistema',
								'type' => 'inner',
								'conditions' => array('Papel.id = PapelSistema.papel_id')
						),
						array(
								'table' => $this->tablePrefix . 'sistemas',
								'alias' => 'Sistema',
								'type' => 'inner',
								'conditions' => array('Sistema.id = PapelSistema.sistema_id')
						)
				),
				'conditions' => array(
						'Usuario.id' => $usuario_id,
						'Sistema.hash' => $hash_sistema,
						'Papel.excluido' => FALSE,
						'Sistema.ativo' => TRUE,
						'Sistema.excluido' => FALSE
				),
				'recursive' => -1
		);
		return $this->find('all', $options);
	}
	
	/**
	 * Retorna a lista de Níveis de Acesso de um Usuário para um determinado sistema. O sistema é localizado
	 * por meio do código HASH atribuído no banco de dados.
	 * @param integer $usuario_id
	 * @param string $hash_sistema
	 * @return array
	 */
	public function listaNiveisPorHashSistema($usuario_id, $hash_sistema) {
		$options = array(
				'fields' => array('Nivel.id', 'Nivel.titulo'),
				'joins' => array(
						array(
								'table' => $this->tablePrefix . 'usuarios',
								'alias' => 'Usuario',
								'type' => 'inner',
								'conditions' => array('Usuario.id = NivelPapelSistemaUsuario.usuario_id')
						),
						array(
								'table' => $this->tablePrefix . 'nivels',
								'alias' => 'Nivel',
								'type' => 'inner',
								'conditions' => array('Nivel.id = NivelPapelSistemaUsuario.nivel_id')
						),
						array(
								'table' => $this->tablePrefix . 'nivel_sistemas',
								'alias' => 'NivelSistema',
								'type' => 'inner',
								'conditions' => array('Nivel.id = NivelSistema.nivel_id')
						),
						array(
								'table' => $this->tablePrefix . 'sistemas',
								'alias' => 'Sistema',
								'type' => 'inner',
								'conditions' => array('Sistema.id = NivelSistema.sistema_id')
						)
				),
				'conditions' => array(
						'Usuario.id' => $usuario_id,
						'Sistema.hash' => $hash_sistema,
						'Nivel.excluido' => FALSE,
						'Sistema.ativo' => TRUE,
						'Sistema.excluido' => FALSE
				),
				'recursive' => -1
		);
		return $this->find('all', $options);
	}
	
}