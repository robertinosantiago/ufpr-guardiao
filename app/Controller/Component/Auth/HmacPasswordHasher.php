<?php
App::uses ( 'AbstractPasswordHasher', 'Controller/Component/Auth' );

/**
 * Classe que controla a geração e verificação de hash por meio do algoritmo HMAC
 * 
 * @author Robertino
 *        
 */
class HmacPasswordHasher extends AbstractPasswordHasher {
	
	/** Realiza a verificação de igualdade de dois hash
	 * {@inheritDoc}
	 * @see AbstractPasswordHasher::check()
	 */
	public function check($password, $hashedPassword) {
		return $hashedPassword === $this->hash ( $password );
	}
	
	/**
	 * Função que gera um hash por meio do algoritmo HMAC
	 * {@inheritDoc}
	 * @see AbstractPasswordHasher::hash()
	 */
	public function hash($password) {
		return hash_hmac ( 'sha256', $password, Configure::read ( 'Security.salt' ), false );
	}
}
