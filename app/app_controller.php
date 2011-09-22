<?php

class AppController extends Controller {

	var $components = array('Auth', 'Session', 'Image', 'RequestHandler', 'Email');
	var $helpers = array('Html', 'Form', 'Time', 'Javascript', 'Ajax', 'Session');

	function beforeFilter() {
		$this->Auth->authorize = 'controller';
		$this->Auth->loginAction = array('admin' => false, 'controller' => 'users', 'action' => 'login');
		$this->Auth->logoutRedirect = array('admin' => false, 'controller' => 'articles', 'action' => 'index');
		$this->Auth->loginRedirect = array('admin' => true, 'controller' => 'articles', 'action' => 'index');
		$this->Auth->allow('add', 'login', 'logout', 'index', 'view', 'display');
		$this->Auth->loginError = __('Uw gebruikersnaam of wachtwoord is fout!', true);
		$this->Auth->authError = __('U bent niet gemachtigd om deze locatie te bezoeken!', true);

		if (isset($this->params['admin']))
			$this->layout = 'admin';
	}

	function isAuthorized() {
		return true;
	}

}

?>
