<?php
/**
 * RoutesController
 *
 * 
 * @package SiteConfig
 * @author Nicolas Traeder <traeder@codebility.com>
 * @license (http://www.opensource.org/licenses/mit-license.php) MIT License
 * @copyright Copyright 2012, Nicolas Traeder
 * @link https://github.com/traedamatic/CakePHP2.1-App-Template-
 *
 *	
 */
class RoutesController extends SiteconfigAppController {
	
	/*
	 * Controller name
	 *
	 * @var string
	 * @access public
	 */
	public $name = 'Routes';

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
	 * this function enables the routes config
	 * @access public
	 * @author Nicolas Traeder <traeder@codebility.com>
	 *
	 */
	public function manager_index() {
					
		$siteRoutes = $this->Route->find();
		//find all Pages
		$pages = ClassRegistry::init('Page')->find('list',array('fields' => array('Page.alias','Page.title'), 'recursive' => 0));
		
		$this->set(compact(array('siteRoutes','pages')));
		
	}
	
	/**
	 * add route
	 * 
	 * @access public
	 * @author Nicolas Traeder <traeder@codebility.com>
	 */	
	public function manager_add() {
		if($this->request->is('post')) {
						
			if($this->Route->save($this->data)) {
				$this->Session->setFlash('Routen gespeichert');				
			} else {				
				$this->Session->setFlash('Routen konnten nicht gespeichert');				
			}
			
			$this->redirect(array('controller' => 'routes', 'action' => 'index', 'manager' => true, 'plugin' => 'siteconfig'));
			
		}
	}
	
	/**
	 * delete a route
	 * 
	 * @access public
	 * @author Nicolas Traeder <traeder@codebility.com>
	 */
	public function manager_delete($number = null) {
		if(is_null($number)) {
			$this->set('result','fail');
			$this->render('Elements/ajax','ajax');
			return;
		}
				
		$siteRoutes = $this->Route->find();
		
		if(isset($siteRoutes[$number])) {
			unset($siteRoutes[$number]);
		}
		
		if($this->Route->save($siteRoutes,true)) {
			$result = 'okay';
		} else {				
			$result = 'fail';
		}
		$this->set('result',$result);
		$this->render('Elements/ajax','ajax');
	}
	
}