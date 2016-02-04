<?php
App::uses('AppModel', 'Model');

class NivelPapelSistemaUsuario extends AppModel {
	
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
	
}