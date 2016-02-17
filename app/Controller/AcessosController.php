<?php
App::uses('AppController', 'Controller');

class AcessosController extends AppController {
	
	public $components = array('RequestHandler');
	public $uses = array('Usuario');
	
	
	public function index() {
		$this->Usuario->acessoSistema('robertino@ufpr.br', '123456', 'bbb95c3acda95306dcd952de487c80ebc8756a550d4347e98d72e8ad259b105b');
	}
	
	public function acessoUsuario() {
		$email = $this->request->data['email'];
		$senha = $this->request->data['senha'];
		$sistema = $this->request->data['sistema'];
		
		$usuario = $this->Usuario->acessoSistema($email, $senha, $sistema);
		
		
	}
	
}