<?php
App::uses('AppController', 'Controller');

/**
 * Controlador dos Papeis
 * @author Robertino
 *
 */
class PapelsController extends AppController {
	public $uses = array('Papel');
	public $helpers = array('SearchBox');
	public $components = array('Session', 'Crud');
	public $paginate = array();
	
	/**
	 * Exibe a listagem de Papeis
	 */
	public function index() {
		$this->setTitle(__('Papéis'));
		$this->Session->write('urlBack', $this->request->here());
		$this->paginate = $this->Papel->optionsPaginate();
	
		$query = null;
		if (isset($this->params->query['query'])) {
			$query = $this->params->query['query'];
			$this->termOfSearch($query, array('Papel.titulo'));
		}
		$this->set('query', $query);
	
		$records = $this->paginate('Papel');
		$this->set('records', $records);
	}
	
	/**
	 * Exibe o formulário de inclusão/alteração
	 */
	public function form() {
		$this->setTitle(__('Nível de acesso'));
		$this->Session->write('urlBack', $this->referer());
	}
	
	/**
	 * Salva os dados submetido pelo formulário de inclusão/alteração
	 */
	public function save() {
		$this->Crud->saveData($this->Papel, $this->request->data);
	}
	
	/**
	 * Carrega os dados para a edição por meio o formulário
	 * @param integer $id
	 */
	public function update($id = null) {
		$this->Session->write('urlBack', $this->referer());
		$this->setTitle(__('Nível de acesso'));
		$this->Crud->loadData($this->Papel, $id);
	}
	
	/**
	 * Realiza a exclusão de um registro
	 * @param integer $id
	 */
	public function delete($id = null) {
		$this->Crud->deleteData($this->Papel, $id);
	}
	
	/**
	 * Realiza a exclusão de varios registros simultaneamente.
	 */
	public function deleteMany() {
		$this->Crud->deleteMany($this->Papel, $this->request->data);
	}
}