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
class MainController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Main';
	public $uses = array('Job', 'User', 'Qualification');

	public function index() {
		$this->redirect(array('controller' => 'main', 'action' => 'jobs'));
	}

	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */
	public function jobs() {
		$this->set('name', 'Jobs');
		$this->render('/Pages/jobs');	
	}

	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */	
	public function applications() {
		$this->set('name', 'Applications');
		$this->render('/Pages/applications');
	}

	public function download() {
		$this->render('/Pages/download');
	}

	public function test() {
        $test = $this->Job->find('all');
        $this->set('test', $test);

		$this->render('/Pages/test');
	}

    public function createjob() {
        $this->Job->save(
            array('Job' => array(
                'title' => $this->params['form'],
                'field' => 1,
                'company' => 1,
                'location' => 1,
                'duration' => 1,
                'description' => 1,
                'area' => 1
            ))
        );
    }
}
