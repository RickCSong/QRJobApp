<?php

class DevicesController extends AppController {
	public $components = array('Logger', 'Device', 'RequestHandler');
	public $autoRender = false;
	public $autoLayout = false;

	public function parse() {
		$inputDevice = $_POST['inputDevice'];
		$input = $_POST['input'];
		$input = escapeshellarg($input);

		$this->Logger->send($inputDevice, "Input: " . $input);

		$command = escapeshellcmd("python files/python/ParseInput.py " . $input);
		
		$str_command = exec($command);
		$str_command = str_replace('\'','"',$str_command);

		$parsedInput = json_decode($str_command, true);

		$this->Logger->send($inputDevice, "Response: " . $str_command);

		if (!isset($parsedInput["device"])) {
			$parsedInput["device"] = null;
		}

		if (!isset($parsedInput["command"])) {
			$parsedInput["command"] = null;
		}

		if (!isset($parsedInput["attr"])) {
			$parsedInput["attr"] = null;
		}

		$response = $this->process($parsedInput["device"], $parsedInput["command"], $parsedInput["attr"]);
		$this->Logger->send('console', $response['message']);
		
		return;
	}

	public function process() {
		$device = $_POST['device'];
		$command = $_POST['command'];
		$attr = json_decode(stripslashes($_POST['attr']), true);

		$this->Device->process($device, $command, $attr);
		return;
	}

	public function beforeFilter() {
		parent::beforeFilter();

		if ($this->RequestHandler->isAjax()) {
      		Configure::write('debug', 0);
    	}
	}
}


?>