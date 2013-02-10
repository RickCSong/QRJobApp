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
class DataController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Main';
	public $uses = array('Job', 'User', 'Application');
	public $components = array('RequestHandler');

	public function applicants() {
		$allUsers = $this->User->find('all');
        $this->viewClass = 'Json';

        $returnArray = array();

        foreach ($allUsers as $user) {
            array_push($returnArray, $user['User']);
        }

		$this->set('data', $returnArray);
		/*
		$json = "[{\"id\":\"1\",\"firstName\":\"Ivan\",\"lastName\":\"Van\",\"phone\":\"911-911-9111\",\"email\":\"ivan@gmail.com\",\"school\":\"Rice University\",\"resume\":null},{\"id\":\"2\",\"firstName\":\"Rick\",\"lastName\":\"Song\",\"phone\":\"123-456-7890\",\"email\":\"rickcsong@gmail.com\",\"school\":\"Rice University\",\"resume\":null},{\"id\":\"3\",\"firstName\":\"Hassaan\",\"lastName\":\"Markhiani\",\"phone\":\"098-765-4321\",\"email\":\"hassaan@gmail.com\",\"school\":\"University of Texas\",\"resume\":null}]";
		$data = json_decode($json);
		$this->viewClass = 'Json';
		$this->set('data', $data);
		*/
		$this->set('_serialize', 'data');
	}

	public function jobs() {
        $allJobs = $this->Job->find('all');
        /*
		$json = "[{\"id\":\"1\",\"title\":\"Software Engineer\",\"company\":\"Google\",\"location\":\"Mountain View, CA\",\"duration\":\"Full-time\",\"description\":null},{\"id\":\"2\",\"title\":\"Hardware Engineer\",\"company\":\"Apple\",\"location\":\"Cupertino, CA\",\"duration\":\"Full-time\",\"description\":null},{\"id\":\"3\",\"title\":\"Software Engineer Intern\",\"company\":\"Amazon\",\"location\":\"Seattle, WA\",\"duration\":\"Intern\",\"description\":null}]";
		$data = json_decode($json);
		*/
		$this->viewClass = 'Json';

        $returnArray = array();

        foreach ($allJobs as $job) {
            array_push($returnArray, $job['Job']);
        }

		$this->set('data', $returnArray);
		$this->set('_serialize', 'data');
	}

    public function applications() {
        $allApplications = $this->Application->find('all');
		$this->viewClass = 'Json';

        $returnArray = array();

        foreach ($allApplications as $app) {
            array_push($returnArray, $app['Application']);
        }

		$this->set('data', $returnArray);
		$this->set('_serialize', 'data');
    }

    /*
	public function applications() {
		$json = "[{\"id\":\"1\",\"user_id\":\"1\",\"job_id\":\"1\",\"time\":\"1360472993\"},{\"id\":\"2\",\"user_id\":\"2\",\"job_id\":\"1\",\"time\":\"1360482993\"},{\"id\":\"3\",\"user_id\":\"3\",\"job_id\":\"1\",\"time\":\"1360492993\"},{\"id\":\"4\",\"user_id\":\"1\",\"job_id\":\"2\",\"time\":\"1360452993\"},{\"id\":\"5\",\"user_id\":\"2\",\"job_id\":\"2\",\"time\":\"1360462993\"},{\"id\":\"6\",\"user_id\":\"1\",\"job_id\":\"3\",\"time\":\"1360492993\"}]";
		$data = json_decode($json);
		$this->viewClass = 'Json';
		$this->set('data', $data);
		$this->set('_serialize', 'data');
	}
	*/
}
