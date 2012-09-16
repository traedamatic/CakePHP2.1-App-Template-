<?php
/**
 * UsersController
 * config driven userscontrolling
 *
 * @author Nicolas Traeder <traeder@codebility.com>
 * @license (http://www.opensource.org/licenses/mit-license.php) MIT License
 * @copyright Copyright 2012, Nicolas Traeder
 * @link https://github.com/traedamatic/CakePHP2.1-App-Template-
 *	
 */
class UsersController extends AppController {
	
	/*
	 * Controller name
	 *
	 * @var string
	 * @access public
	 */
	public $name = 'Users';

	/**
	 *
	 * beforeFilter
	 *
	 * @access public
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->deny();
		$this->Auth->allow(array('login','logout'));
	}
	
	/**
	 *
	 * login 
	 * handles the login action
	 * 
	 * @access public
	 */
	public function login() {
		$authEmail = $this->Auth->user('username');
		
		if(!empty($authEmail)) {
			$this->Session->setFlash(__("You are already loged in!"));
			$this->redirect("/");
		}
		
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
			}
		}
	}
	
	/**
	 *
	 * logout
	 * handles the logout action
	 * 
	 * @access public
	 */
	public function logout() {
		$this->Session->destroy();		
		$this->redirect($this->Auth->logout());
	}

	
	/**
	 *
	 * lists all users
	 * 
	 * @access public manager
	 */
	public function manager_index () {
		$users = $this->User->find('all');
		$this->set(compact("users"));
	}
	
	/**
	 *
	 * adds a new user to configfile
	 *
	 * @access public manager
	 */	
	public function manager_add() {
		if(!empty($this->data)) {						
		
			if($this->Auth->password($this->data['User']['retypepassword']) != 
					$this->Auth->password($this->data['User']['password'])) {
				$this->Session->setFlash(__("Password and retyped password are not the same!"),'/flash/error');
				$this->redirect(array('action' => 'manager_add'));
			}

			if($this->User->save($this->data)) {
				$this->Session->setFlash(__("User created"),'/flash/success');
			$this->redirect(array('action' => 'manager_index'));
			} else {
				$this->Session->setFlash(__("User could not be created"),'/flash/error');
				$this->redirect(array('action' => 'manager_add'));
			}
		}
	}
	
	/**
	 *
	 * deletes a user
	 *
	 * @access public manager
	 * @param string $username the username 
	 */
	public function manager_delete($username) {
		if($this->User->delete($username)){
			$this->Session->setFlash(__("User deleted"),'/flash/success');
			$this->redirect(array('action' => 'manager_index'));
		}
	}	
}