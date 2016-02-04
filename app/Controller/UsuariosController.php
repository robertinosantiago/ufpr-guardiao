<?php
App::uses('AppController', 'Controller');

class UsuariosController extends AppController {
	
	public $uses = array('Usuario');
	public $helpers = array('SearchBox');
	public $components = array('Session', 'Crud');
	public $paginate = array();
	
	/**
	 * Exibe a listagem de Usuários
	 */
	public function index() {
		$this->setTitle(__('Usuarios'));
		$this->Session->write('urlBack', $this->request->here());
		$this->paginate = $this->Usuario->optionsPaginate();
	
		$query = null;
		if (isset($this->params->query['query'])) {
			$query = $this->params->query['query'];
			$this->termOfSearch($query, array('Usuario.nome', 'Usuario.email'));
		}
		$this->set('query', $query);
	
		$records = $this->paginate('Usuario');
		$this->set('records', $records);
	}
	
	/**
	 * Exibe o formulário de inclusão/alteração
	 */
	public function form() {
		$this->setTitle(__('Usuário'));
		$this->Session->write('urlBack', $this->referer());
	}
	
	/**
	 * Salva os dados submetido pelo formulário de inclusão/alteração
	 */
	public function save() {
		$this->Crud->saveData($this->Usuario, $this->request->data);
	}
	
	/**
	 * Carrega os dados para a edição por meio o formulário
	 * @param integer $id
	 */
	public function update($id = null) {
		$this->Session->write('urlBack', $this->referer());
		$this->setTitle(__('Usuário'));
		$this->Crud->loadData($this->Usuario, $id, false);
	}
	
	/**
	 * Realiza a exclusão de um registro
	 * @param integer $id
	 */
	public function delete($id = null) {
		$this->Crud->deleteData($this->Usuario, $id);
	}
	
	/**
	 * Realiza a exclusão de varios registros simultaneamente.
	 */
	public function deleteMany() {
		$this->Crud->deleteMany($this->Usuario, $this->request->data);
	}
	
	/**
	 * Realiza a alteração de status de um registro (ativo/inativo)
	 * @param integer $id
	 */
	public function status($id = null) {
		$this->Session->write('urlBack', $this->referer());
		$this->Crud->updateStatus($this->Usuario, $id);
	}
	
}