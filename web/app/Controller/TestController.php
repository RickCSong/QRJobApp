<?php
// Unit testing class
class TestController extends AppController {
	public $name = 'Test';
	public $components = array('Logger', 'RequestHandler');

	public function index() {
		$this->set("name", "test");
		$this->layout = 'default';
		$this->render('/Pages/Test/index');			
	}

	public function info() {
		$this->layout = '';
		$this->render('/Pages/Test/info');				
	}

	public function cake() {
		$this->layout = '';
		$this->render('/Pages/Test/cake');				
	}

	public function process() {
		$this->header('Content-Type: application/json');
		$this->autoRender = false;
	  $this->autoLayout = false;	

			$function = $_POST['function'];

	  switch($function) {
	    case('update'):
	    	$this->Logger->update();
	      break;
	    case('send'):
	    	$device = htmlentities(strip_tags($_POST['device']));
	      $message = htmlentities(strip_tags($_POST['message']));
	      $this->Logger->send($device, $message);
	      break;
	    case('reset'):
	    	$this->Logger->reset();
	    	break;
	    default: 
	    	$this->error();
	    	break;
	  }

    return;
	}

	public function error() {
		$response = array();
		$response['action'] = 'error';
		$response['status'] = 'ERROR';
		echo json_encode($response);
	}


}

?>