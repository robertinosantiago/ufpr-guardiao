<?php

App::uses('AppModel', 'Model');

public class Nivel extends AppModel {

  public $validate = array(
    'titulo' => array(
      'rule' => 'notEmpty',
      'message' => 'O campo Título é obrigatório'
    )
  );

}
