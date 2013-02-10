<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PhoneController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Phone';
	public $uses = array('User', 'Job', 'JobToUser');

	public function login() {
		
	}

	public function apply() {
		if (!isset($this->params['url']['job']) || 
			!isset($this->params['url']['user']) || 
			!isset($this->params['url']['timestamp'])) {
			$this->redirect(array('controller' => 'main', 'action' => 'download'));
		} else {
			$this->set('job', $this->params['url']['job']);		    
			$this->set('user', $this->params['url']['user']);
			$this->set('timestamp', $this->params['url']['timestamp']);
	
            $userParam = $this->params['url']['user'];
            $jobParam = $this->params['url']['job'];

            $user = $this->User->find('first', array('email' => array($userParam)));
            $job = $this->Job->find('first', array('id' => array($jobParam)));

            $jobToUser = $this->JobToUser->save(
                array('JobToUser' => array('job_id' => $jobParam, 'email' => $userParam))
            );

			$this->render('/Pages/apply');	
		}
	}

}
