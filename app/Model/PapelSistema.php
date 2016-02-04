<?php
App::uses('AppModel', 'Model');

class PapelSistema extends AppModel {
	
	public $belongsTo = array('Papel', 'Sistema');
	
	/**
	 * Realiza a associação entre um Papel e um Sistema
	 * @param integer $sistema_id
	 * @param integer $papel_id
	 * @return array|boolean
	 */
	public function adicionaPapel($sistema_id, $papel_id) {
		$options = array(
				'Sistema' => array(
						'id' => $sistema_id
				),
				'Papel' => array(
						'id' => $papel_id
				)
		);
		return $this->saveAll($options, array('validate' => 'first'));
	}
	
	/**
	 * Remove a associação entre um Papel e um Sistema
	 * @param integer $sistema_id
	 * @param integer $papel_id
	 * @return boolean
	 */	
	public function removePapel($sistema_id, $papel_id) {
		$options = array(
				'fields' => array(
						'PapelSistema.id'
				),
				'conditions' => array(
						'papel_id' => $papel_id,
						'sistema_id' => $sistema_id
				),
				'recursive' => -1
		);
		$dados = $this->find('first', $options);
		return $this->delete($dados['PapelSistema']['id']);
	}
	
}