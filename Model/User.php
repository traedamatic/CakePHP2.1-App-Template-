<?php
/**
 *
 * User model
 * config driven userscontrolling
 *
 * @author Nicolas Traeder <traeder@codebility.com>
 * @license (http://www.opensource.org/licenses/mit-license.php) MIT License
 * @copyright Copyright 2012, Nicolas Traeder
 * @link https://github.com/traedamatic/CakePHP2.1-App-Template-
 *
 */
App::uses('AppModel','Model');
Configure::load('users');

class User extends AppModel {
  	
	/**
  	 *	@var string the name of the model
  	 *	@access public
  	 */
	public $name = 'User';

	/**
  	 *	@var boolean if the model has a database table
  	 *	@access public
  	 */
	public $useTable = false;
	
	/**
  	 *	@var array the schema of the model
  	 *	@access public
  	 */
	public $_schema = array(
		'username' => array(
			'type' => 'string',
			'length' => 255
			),
		'password' => array(
			'type' => 'text',
			'length' => 255
			)
	);

	/**
	 *  custom find method
	 *
	 *  it looks up the user in the config file and return
	 *  the user.
	 *  
	 *  @access public
	 *  @param string the type of the find call
	 *  @param array the conditions of the find call
	 *  @return array userdata or empty array
	 */  
  	public function find($type = 'first',$query = array()) {
		
		if($type == 'all') {
			$UsersInConfig = Configure::read('Auth.Users');
			$users = array();
			foreach($UsersInConfig as $username => $password) {
				array_push($users,array('User' => array('username' => $username )));
			}
			return $users;			
		}		
		
		$this->data = array(
			'User' => array(
				'username' => $query['conditions']['User.username'],
				'password' => $query['conditions']['User.password'],
			)
		);
		
		$UsersInConfig = Configure::read('Auth.Users');
		
		if(array_key_exists($this->data['User']['username'],$UsersInConfig)
			 && ($UsersInConfig[$this->data['User']['username']] == $this->data['User']['password']))
		{
			return array('User' => array('username' => $this->data['User']['username']));
			
		}
		
		return array();
  	}

	/**
	 *  custom save method
	 *
	 *  writes the new user to the config file
	 *
	 *  @access public	 
	 *  @param array the conditions of the find call
	 *  @return boolean success or failure
	 */  
  	public function save($data = NULL, $validate = true, $fieldList = array()) {
  		$this->data = $data;
  		
  		$UsersInConfig = array();
  		$UsersInConfig['Auth'] = Configure::read('Auth');

  		//user exists already 
  		if(array_key_exists($this->data['User']['username'], $UsersInConfig['Auth']['Users'])) {
  			return false;
  		}

  		$UsersInConfig['Auth']['Users'][$this->data['User']['username']] = 
  			AuthComponent::password($this->data['User']['password']);

  		return $this->_writeConfig($UsersInConfig);	
  	}
	
	/**
	 *  custom delete method
	 *
	 *  deletes the user from the configfile
	 *
	 *  @access public	 
	 *  @param string the username of the user
	 *  @return boolean success or failure
	 */  	
	public function delete($id = NULL,$cascade = true) {
		if(is_null($id)) {
			return false;
		}
		
		$UsersInConfig = array();
  		$UsersInConfig['Auth'] = Configure::read('Auth');
		
		if(array_key_exists($id, $UsersInConfig['Auth']['Users'])) {
  			unset($UsersInConfig['Auth']['Users'][$id]);
			
			return $this->_writeConfig($UsersInConfig);			
  		}
		
		return false;
		
	}
	
	/**
	 *  _writeConfig
	 *
	 * 	writes the configArray to file: app/Config/users.php	
	 *
	 *  @access private	 
	 *  @param mixed the data
	 *  @return boolean success or failure
	 */	
	private function _writeConfig($data = false) {
		if($data === false) {
			return false;
		}
		
		$configFileString = '<?php'."\n\r".'$config = ' . var_export($data,true).";";

  		if(file_put_contents(APP.DS.'Config'.DS.'users.php', $configFileString)) {
  			return true;
  		} 
	}  	
}