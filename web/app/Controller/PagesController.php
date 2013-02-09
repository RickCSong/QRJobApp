<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {
	public $name = "Pages";

	public function index() {
		$this->set('name', 'Home');
		$this->render('/Pages/Home/index');
	}

	public function manage() {
		$this->set('name', 'Manage');
		$this->render('/Pages/Manage/index');
	}

	public function setup() {
		$this->render('/Pages/Manage/setup');
	}

	public function beforeFilter() {
		$this->Auth->allow('index'); // Maybe place in AppController
		parent::beforeFilter();
	}
}

?>