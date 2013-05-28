<?php
/**
 * SettingsController
 *
 * 
 * @package SiteConfig
 * @author Nicolas Traeder <traeder@codebility.com>
 * @license (http://www.opensource.org/licenses/mit-license.php) MIT License
 * @copyright Copyright 2012, Nicolas Traeder
 * @link https://github.com/traedamatic/CakePHP2.1-App-Template-
 *	
 */
class SettingsController extends SiteconfigAppController {
	
	/*
	 * Controller name
	 *
	 * @var string
	 * @access public
	 */
	public $name = 'Settings';

	/**
	 *
	 * beforeFilter
	 *
	 * @access public
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		//$this->Auth->deny();		
	}
	
	/**
	 *
	 * this function controlles the site config
	 * 
	 * - meta data
	 * - site title
	 * -..
	 * 
	 * @author Nicolas Traeder <traeder@codebility.com>
	 * @access public
	 */
	public function manager_index() {
		//$this->loadModel('Siteconfig.Setting');
		
		$settings = $this->Setting->find();
		$this->set(compact('settings'));
		
	}
	
	/**
	 * add settings
	 */
	public function manager_add() {
		if($this->request->is('post')) {
			if(!isset($this->data['Setting']['key'])) $this->redirect(array('action' =>'index'));
				
			$settings = $this->Setting->find('all');
					
			$key = $this->data['Setting']['key'];			
			
			if(isset($this->data['Setting']['namespace']) && !empty($this->data['Setting']['namespace'])) {
				$settings[$this->data['Setting']['namespace']][$key] = $this->data['Setting']['value'];
			} else {
				$settings[$key] = $this->data['Setting']['value'];
			}
			
			if($this->Setting->save(array('SiteSettings' => $settings))) {
				$this->Session->setFlash(__('Setting saved'));
			} else {				
				$this->Session->setFlash(__('Setting could not be saved saved'));
			}
			
			$this->redirect(array('controller' => 'settings', 'action' => 'index', 'manager' => true, 'plugin' => 'siteconfig'));
			
		}
	}
	
	/**
	 *
	 * delete sitesettings
	 */
	public function manager_delete($settingKey = null) {
		if(is_null($settingKey)) {
			$this->Session->setFlash(__('No Setting Key set'));
			$this->redirect(array('action' =>'index'));
		}
		
		$settingKeys = explode('.',$settingKey);
		
		if(isset($settingKeys[0])) {			
			$settings = $this->Setting->find();		
			if(isset($settingKeys[1])) {
				if(isset($settings[$settingKeys[0]][$settingKeys[1]])) {
					unset($settings[$settingKeys[0]][$settingKeys[1]]);
				} else {
					$this->Session->setFlash(__('Setting not found'));
				}
			} else {
				if(isset($settings[$settingKeys[0]])) {
					unset($settings[$settingKeys[0]]);
				} else {
					$this->Session->setFlash(__('Setting not found'));
				}	
			}
			
			if($this->Setting->save(array('SiteSettings' => $settings))) {
				$this->Session->setFlash(__('Setting deleted'));
			} else {
				$this->Session->setFlash(__('Setting could not be deleted'));
			}
						
		} else {
			$this->Session->setFlash(__('Setting Key not found'));
		}
				
		$this->redirect(array('action' =>'index'));
		
		
	}
	
	/**
	 *
	 * edit a setting 
	 */
	public function manager_edit() {
		if(!$this->request->is('post')) $this->redirect(array('action' =>'index'));
		if(!$this->request->is('ajax')) $this->redirect(array('action' =>'index'));
		
		$doSave = false;
		$settings = $this->Setting->find();
		$key = $this->data['Setting']['key'];
		$namespace = $this->data['Setting']['namespace'];
		if(!isset($key)) {
			$this->set('result','Error - Key not set');			
		} else {
			if(!empty($namespace)) {
				if(isset($settings[$namespace][$key])) {
					$settings[$namespace][$key] = $this->data['Setting']['value'];
					$doSave = true;
				} else {					
					$this->set('result','Error - Key or Namespace in Setting not found');
				}
			} else {
				if(isset($settings[$key])) {
					$settings[$key] = $this->data['Setting']['value'];
					$doSave = true;
				} else {
					$this->set('result','Error - Key in Setting not found');			
				}
			}
		}
			
		if($doSave === true) {
			if($this->Setting->save(array('SiteSettings' => $settings))) {
				$this->set('result','okay');			
			} else {
				$this->set('result','Error - Sitesettting could not be saved');			
			}
		}
		
		$this->set('_serialize', array('result'));
	}
}