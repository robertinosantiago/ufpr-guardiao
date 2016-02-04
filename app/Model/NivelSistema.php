<?php
App::uses('AppModel', 'Model');

class NivelSistema extends AppModel {
	
	public $belongsTo = array('Nivel', 'Sistema');
	
	/**
	 * Realiza a associação entre um Nível de Acesso e um Sistema
	 * @param integer $sistema_id
	 * @param integer $nivel_id
	 * @return array|boolean
	 */
	public function adicionaNivel($sistema_id, $nivel_id) {
		$options = array(
				'Sistema' => array(
						'id' => $sistema_id
				),
				'Nivel' => array(
						'id' => $nivel_id
				)
		);
		return $this->saveAll($options, array('validate' => 'first'));
	}
	
	/**
	 * Remove a associação entre um Nível de Acesso e um Sistema
	 * @param integer $sistema_id
	 * @param integer $nivel_id
	 * @return boolean
	 */
	public function removeNivel($sistema_id, $nivel_id) {
		$options = array(
				'fields' => array(
						'NivelSistema.id'
				),
				'conditions' => array(
						'nivel_id' => $nivel_id,
						'sistema_id' => $sistema_id
				),
				'recursive' => -1
		);
		$dados = $this->find('first', $options);
		return $this->delete($dados['NivelSistema']['id']);
	}
}