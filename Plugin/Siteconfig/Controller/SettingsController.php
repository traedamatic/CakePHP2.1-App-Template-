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
						
			if(isset($this->data['NewSetting'])) {
				$this->request->data['SiteSettings'][$this->data['NewSetting']['key']] = $this->data['NewSetting']['value'];
				unset($this->request->data['NewSetting']);
			}
						
			if(isset($this->data['NewMetaSetting'])) {
				$this->request->data['SiteSettings']['meta'][$this->data['NewMetaSetting']['key']] = $this->data['NewMetaSetting']['value'];
				unset($this->request->data['NewMetaSetting']);
			}
			
			if($this->Setting->save($this->data)) {
				$this->Session->setFlash('Einstellungen gespeichert');
			} else {				
				$this->Session->setFlash('Einstellungen  konnten nicht gespeichert');				
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
			$this->set('result','fail');
			$this->render('Elements/ajax','ajax');
			return;
		}
		
		$settingKeys = explode('.',$settingKey);
		
		if(isset($settingKeys[0])) {			
			$settings = $this->Setting->find();
			debug($settings);
			if(isset($settingKeys[1])) {
				if(isset($settings[$settingKeys[0]][$settingKeys[1]])) {
					unset($settings[$settingKeys[0]][$settingKeys[1]]);
				} else {
					$result = 'fail';
				}
			} else {
				if(isset($settings[$settingKeys[0]])) {
					unset($settings[$settingKeys[0]]);
				} else {
					$result = 'fail';
				}	
			}
			
			if($this->Setting->save(array('SiteSettings' => $settings))) {
				$result = 'okay';
			} else {
				$result = 'fail';
			}
						
		} else {
			$result = 'fail';
		}
		
		
		$this->set('result',$result);
		$this->render('Elements/ajax','ajax');
		
		
	}
	
	/**
	 *
	 * edit a setting 
	 */
	public function manager_edit() {
		if(!$this->request->is('post')) $this->redirect(array('action' =>'index'));
		if(!$this->request->is('ajax')) $this->redirect(array('action' =>'index'));
		
		
		debug($this->data);		
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