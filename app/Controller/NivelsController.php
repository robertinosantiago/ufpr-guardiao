<?php

App::uses('AppController', 'Controller');

/**
 * Controlador dos Níveis de Usuários
 */
class NivelsController extends AppController {
	
	public $uses = array('Nivel');
	public $helpers = array('SearchBox');
	public $components = array('Session', 'Crud');
	public $paginate = array();

	/**
	 * Exibe a listagem de Níveis de Acesso
	 */
	public function index() {
		$this->setTitle(__('Níveis de Acesso'));
		$this->Session->write('urlBack', $this->request->here());
		$this->paginate = $this->Nivel->optionsPaginate();
		
		$query = null;
		if (isset($this->params->query['query'])) {
			$query = $this->params->query['query'];
			$this->termOfSearch($query, array('Nivel.titulo'));
		}
		$this->set('query', $query);
		
		$records = $this->paginate('Nivel');
		$this->set('records', $records);
	}
	
	/**
	 * Exibe o formulário de inclusão/alteração de Níveis de Acesso
	 */
	public function form() {
		$this->setTitle(__('Nível de acesso'));
		$this->Session->write('urlBack', $this->referer());
	}
	
	/**
	 * Salva os dados submetido pelo formulário de inclusão/alteração
	 */
	public function save() {
		$this->Crud->saveData($this->Nivel, $this->request->data);
	}
	
	/**
	 * Carrega os dados para a edição por meio o formulário
	 * @param integer $id
	 */
	public function update($id = null) {
		$this->Session->write('urlBack', $this->referer());
		$this->setTitle(__('Nível de acesso'));
		$this->Crud->loadData($this->Nivel, $id);
	}
	
	/**
	 * Realiza a exclusão de um registro
	 * @param integer $id
	 */
	public function delete($id = null) {
		$this->Crud->deleteData($this->Nivel, $id);
	}
	
	/**
	 * Realiza a exclusão de varios registros simultaneamente.
	 */
	public function deleteMany() {
		$this->Crud->deleteMany($this->Nivel, $this->request->data);
	}
	
	

}
