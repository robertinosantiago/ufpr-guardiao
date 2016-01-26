<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('Component', 'Controller');

/**
 * Classe que implementa as rotinas básicas de CRUD.
 *
 * @author Robertino Mendes Santiago Junior
 */
class CrudComponent extends Component {

    public $components = array('Session');
    private $controller;

    /**
     * Inicializa a variável controller
     * {@inheritDoc}
     * @see Component::initialize()
     */
    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
    }

    /**
     * Salva dos dados enviados via POST para um determinado modelo.
     * Caso os dados forem salvos corretamente, o fluxo é redirecionado para o caminho armazenado na sessão.
     * Caso os dados não forem salvos corretamente, o formulário é redendizado novamente.
     * Se os dados não vierem via POST, o fluxo é redirecionado para o caminho armazenado na sessão.
     * @param string $model
     * @param array $data
     */
    public function saveData($model = null, $data = array()) {
        if ($this->controller->request->is('post')) {
            $model->create();
            if ($model->saveAll($data, array('validate' => 'first'))) {
                $this->Session->setFlash(__('Salvo com sucesso'), 'flash_success');
                return $this->controller->redirect($this->Session->read('urlBack'));
            } else {
                $this->Session->setFlash(__('Não foi possível salvar'), 'flash_error');
                $this->controller->render('/' . $this->controller->name . '/form');
                
            }
        } else {
            return $this->controller->redirect($this->Session->read('urlBack'));
        }
    }

    /**
     * Recupera os dados do registro identificado pela variável primaryKey.
     * Caso não exista um registro com esse identificador, uma exceção é lançada.
     * É possível renderizar o formulário para edição.
     * @param string $model
     * @param integer $primaryKey
     * @param boolean $renderForm
     * @throws NotFoundException
     */
    public function loadData($model = null, $primaryKey = null, $renderForm = true) {
        if (!$model->exists($primaryKey)) {
            throw new NotFoundException(__('Registro não localizado'));
        }
        if ($this->controller->request->is('post')) {
            $options = array('conditions' => array($model->name . '.' . $model->primaryKey => $primaryKey));
            $this->controller->request->data = $model->find('first', $options);
            if ($renderForm) {
                $this->controller->render('/' . $this->controller->name . '/form');
            }
        } else {
            return $this->controller->redirect($this->Session->read('urlBack'));
        }
    }

    /**
     * 
     * @param string $model
     * @param integer $primaryKey
     * @throws NotFoundException
     */
    public function deleteData($model = null, $primaryKey = null) {
        if (!$model->exists($primaryKey)) {
            throw new NotFoundException(__('Registro não localizado'));
        }

        if ($this->controller->request->is('post')) {
            $options = array('fields' => array($model->name .'.id', $model->name . '.excluido'), 'conditions' => array($model->name . '.' . $model->primaryKey => $primaryKey));
            $registry = $model->find('first', $options);
            $registry[$model->name]['excluido'] = 1;
            if ($model->saveAll($registry, array('validate' => 'first'))) {
                $this->Session->setFlash(__('Excluído com sucesso'), 'flash_success');
            }
        }
        return $this->controller->redirect(array('action' => 'index'));
    }

    /**
     * 
     * @param string $model
     * @param integer $primaryKey
     * @throws NotFoundException
     */
    public function updateStatus($model = null, $primaryKey = null) {
        if (!$model->exists($primaryKey)) {
            throw new NotFoundException(__('Registro não localizado'));
        }

        if ($this->controller->request->is('post')) {
            $options = array('fields' => array($model->name .'.id', $model->name . '.ativo'), 'conditions' => array($model->name . '.' . $model->primaryKey => $primaryKey));
            $registry = $model->find('first', $options);
            $registry[$model->name]['ativo'] = !$registry[$model->name]['ativo'];
            if ($model->saveAll($registry, array('validate' => 'first'))) {
                $this->Session->setFlash(__('Alterado com sucesso'), 'flash_success');
            }
        }
        return $this->controller->redirect($this->Session->read('urlBack'));
    }

    /**
     * 
     * @param string $model
     * @param array $data
     */
    public function deleteMany($model = null, $data = array()) {
        $erro = array();
        if ($this->controller->request->is('post')) {
            foreach ($data['Records']['id'] as $key => $value) {
                $options = array('conditions' => array($model->name . '.' . $model->primaryKey => $value));
                $registry = $model->find('first', $options);
                $registry[$model->name]['excluido'] = 1;
                if (!$model->saveAll($registry, array('validate' => 'first'))) {
                    $erro[count($erro)] = $value;
                }
            }
            if (count($erro) == 0) {
                $this->Session->setFlash(__("Excluído com sucesso"), 'flash_success');
            } else {
                $this->Session->setFlash(__("Ocorreu um erro ao tentar excluir os seguintes registros: %s", implode(",", $erro)), 'flash_error');
            }
        }
        $this->controller->redirect(array('action' => 'index'));
    }

}
