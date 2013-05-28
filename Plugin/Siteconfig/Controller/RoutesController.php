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
 * TODO
 *
 * add uuid for every route better datamanagment
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
		$siteRoutes = $this->Route->find('all');		
		$this->set(compact(array('siteRoutes')));		
	}
	
	/**
	 * add route
	 * 
	 * @access public
	 * @author Nicolas Traeder <traeder@codebility.com>
	 */	
	public function manager_add() {
		if($this->request->is('post')) {
						
			$siteRoutes = $this->Route->find('all');						
		
			$siteRoutes[] = array(
					'url' => $this->data['Route']['url'],
					'route' => $this->data['Route']['route'],
					);
								
			if($this->Route->save($siteRoutes	)) {
				$this->Session->setFlash(__('Route saved'));				
			} else {				
				$this->Session->setFlash(__('Route could not be saved saved'));				
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
			$this->redirect(array('action' => 'index', 'manager' => true));
		}
				
		$siteRoutes = $this->Route->find('all');
		
		if(isset($siteRoutes[$number])) {
			unset($siteRoutes[$number]);
		}
		
		if($this->Route->save($siteRoutes,true)) {
			$this->Session->setFlash(__('Route deleted'));				
		} else {				
			$this->Session->setFlash(__('Route could not be deleted'));				
		}
		$this->redirect(array('action' => 'index', 'manager' => true));
	}
	
	/**
	 *
	 * edit single route with countid
	 * @access public
	 * @author Nicolas Traeder <traeder@codebility.com>
	 * @param integer $routenumber the number of the route
	 */
	public function manager_edit($routenumber = null) {	
		if(is_null($routenumber)) {
			$this->set('result','fail');
			$this->set('_serialize',array('result'));
			$this->render();
			return;
		}
		
		if(!$this->request->is('ajax')) $this->redirect(array('action' =>'index'));
		
		$siteRoutes = $this->Route->find('all');
		
		if(isset($siteRoutes[$routenumber])) {
			
			$siteRoutes[$routenumber] = array(
				'url' => $this->data['Route']['url'],
				'route' => $this->data['Route']['route'],
			);
			
			if($this->Route->save($siteRoutes,false)) {			
				$this->set('result','okay');	
			} else {				
				$this->set('result','fail');	
			}
			
		} else {
			$this->set('result',__('Routenumber not available!'));			
		}
		
		$this->set('_serialize',array('result'));
	}
	
}