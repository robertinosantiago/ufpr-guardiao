<?php

App::uses('AppController', 'Controller');

/**
 * Controlador dos Sistemas
 * @author Robertino
 *
 */
class SistemasController extends AppController {
	
	public $uses = array('Sistema', 'Papel', 'PapelSistema', 'Nivel', 'NivelSistema');
	public $helpers = array('SearchBox');
	public $components = array('Session', 'Crud');
	public $paginate = array();

	/**
	 * Exibe a listagem de Sistemas
	 */
	public function index() {
		$this->setTitle(__('Sistemas'));
		$this->Session->write('urlBack', $this->request->here());
		$this->paginate = $this->Sistema->optionsPaginate();
		
		$query = null;
		if (isset($this->params->query['query'])) {
			$query = $this->params->query['query'];
			$this->termOfSearch($query, array('Sistema.titulo'));
		}
		$this->set('query', $query);
		
		$records = $this->paginate('Sistema');
		$this->set('records', $records);
	}
	
	/**
	 * Exibe o formulário de inclusão/alteração
	 */
	public function form() {
		$this->setTitle(__('Sistema'));
		$this->Session->write('urlBack', $this->referer());
	}
	
	/**
	 * Salva os dados submetido pelo formulário de inclusão/alteração
	 */
	public function save() {
		$this->Crud->saveData($this->Sistema, $this->request->data);
	}
	
	/**
	 * Carrega os dados para a edição por meio o formulário
	 * @param integer $id
	 */
	public function update($id = null) {
		$this->Session->write('urlBack', $this->referer());
		$this->setTitle(__('Nível de acesso'));
		$this->Crud->loadData($this->Sistema, $id);
	}
	
	/**
	 * Realiza a exclusão de um registro
	 * @param integer $id
	 */
	public function delete($id = null) {
		$this->Crud->deleteData($this->Sistema, $id);
	}
	
	/**
	 * Realiza a exclusão de varios registros simultaneamente.
	 */
	public function deleteMany() {
		$this->Crud->deleteMany($this->Sistema, $this->request->data);
	}
	
	/**
	 * Realiza a alteração de status de um registro (ativo/inativo)
	 * @param integer $id
	 */
	public function status($id = null) {
		$this->Crud->updateStatus($this->Sistema, $id);
	}
	
	/**
	 * Permite associar papeis (tipos de pessoas autorizadas) a cada sistema
	 * @param integer $sistema_id
	 * @throws NotFoundException
	 */
	public function papeis($sistema_id = NULL) {
		if (!$this->Sistema->exists($sistema_id)) {
			throw new NotFoundException(__('Não foi possível localizar este registro'));
		}
		
		$this->Session->write('urlBack', $this->referer());

		if ($this->request->is('post')) {
			$sistema = $this->Sistema->buscarPorId($sistema_id);
			$papeis = $this->Papel->listarTodos();
			$papeis_sistema = $this->Papel->listarPorSistema($sistema_id);
			
			$this->set('sistema', $sistema);
			$this->set('papels', $papeis);
			$this->set('papels_sistema', $papeis_sistema);
		} else {
			$this->redirect($this->Session->read('urlBack'));
		}
	}
	
	/**
	 * Realiza a associação de um Papel a um Sistema por meio de requisição Ajax
	 */	
	public function adicionaPapel() {
		if ($this->request->is("ajax")) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$sistema_id = $this->request->data['sistemaId'];
			$papel_id = $this->request->data['papelId'];
			
			try {
				$this->PapelSistema->adicionaPapel($sistema_id, $papel_id);
			} catch (Exception $e) { }
			
			$dados = $this->Papel->listarPorSistema($sistema_id);
			$return = array();
			foreach ($dados as $key => $value) {
				$return[$key] = $value;
			}
			echo json_encode($return);
		}
	}
	
	/**
	 * Remove a associação de um Papel a um Sistema por meio de requisição Ajax
	 */
	public function removePapel() {
		if ($this->request->is('ajax')) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$sistema_id = $this->request->data['sistemaId'];
			$papel_id = $this->request->data['papelId'];
			
			try {
				$this->PapelSistema->removePapel($sistema_id, $papel_id);
			} catch (Exception $e) { }
			
			$dados = $this->Papel->listarPorSistema($sistema_id);
			$return = array();
			foreach ($dados as $key => $value) {
				$return[$key] = $value;
			}
			echo json_encode($return);
		}
	}
	
	/**
	 * Permite associar níveis de acesso a cada sistema
	 * @param integer $sistema_id
	 * @throws NotFoundException
	 */
	public function niveis($sistema_id = null) {
		if (!$this->Sistema->exists($sistema_id)) {
			throw new NotFoundException(__('Não foi possível localizar este registro'));
		}
		
		$this->Session->write('urlBack', $this->referer());
		
		if ($this->request->is('post')) {
			$sistema = $this->Sistema->buscarPorId($sistema_id);
			$niveis = $this->Nivel->listarTodos();
			$niveis_sistema = $this->Nivel->listarPorSistema($sistema_id);
				
			$this->set('sistema', $sistema);
			$this->set('nivels', $niveis);
			$this->set('nivels_sistema', $niveis_sistema);
		} else {
			$this->redirect($this->Session->read('urlBack'));
		}
	}
	
	/**
	 * Realiza a associação de um Nível de Acesso a um Sistema por meio de requisição Ajax
	 */
	public function adicionaNivel() {
		if ($this->request->is("ajax")) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$sistema_id = $this->request->data['sistemaId'];
			$nivel_id = $this->request->data['nivelId'];
				
			try {
				$this->NivelSistema->adicionaNivel($sistema_id, $nivel_id);
			} catch (Exception $e) { }
				
			$dados = $this->Nivel->listarPorSistema($sistema_id);
			$return = array();
			foreach ($dados as $key => $value) {
				$return[$key] = $value;
			}
			echo json_encode($return);
		}
	}
	
	/**
	 * Remove a associação de um Nível de Acesso a um Sistema por meio de requisição Ajax
	 */
	public function removeNivel() {
		if ($this->request->is('ajax')) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$sistema_id = $this->request->data['sistemaId'];
			$nivel_id = $this->request->data['nivelId'];
				
			try {
				$this->NivelSistema->removeNivel($sistema_id, $nivel_id);
			} catch (Exception $e) { }
				
			$dados = $this->Nivel->listarPorSistema($sistema_id);
			$return = array();
			foreach ($dados as $key => $value) {
				$return[$key] = $value;
			}
			echo json_encode($return);
		}
	}
	

}
