<?php

App::uses('AppModel', 'Model');

/**
 * Modelo que representa os Níveis de Usuários presentes no sistema
 */
public class Nivel extends AppModel {

  public $validate = array(
    'titulo' => array(
      'rule' => 'notEmpty',
      'message' => 'O campo Título é obrigatório'
    )
  );

}
