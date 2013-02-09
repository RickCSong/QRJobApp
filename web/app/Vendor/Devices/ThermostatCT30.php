<?php

define("OFF", 0);
define("HEAT", 1);
define("COOL", 2);
define("AUTO", 3);

class ThermostatCT30 { 
	private $url;
	private $ch;
	private $commands = array(
		"getState",
		"setState",
		"getName",
		"setName",
		"getTemp",
		"setTemp",
		"raiseTemp",
		"lowerTemp"
	);

	public function __construct($url) {
		$this->url = $url;
	}

	public function execute($command, $attr) {
		if (!in_array($command, $this->commands)) {
			$response = array();
			$response['message'] = "Command for Thermostat CT-30 was not found";
			$response['error'] = true;
			return false;
		}

		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
		curl_setopt($this->ch, CURLOPT_TIMEOUT, 3); // times out after 4s

		$response = call_user_func_array(array($this, $command), array($attr));

		curl_close($this->ch);
		return $response;
	}

	public function getTemp() {
		$response = array();

		// Initialize cURL
		curl_setopt($this->ch, CURLOPT_URL, $this->url . 'tstat');
		curl_setopt($this->ch, CURLOPT_POST, 0);  
		$tstat = json_decode(curl_exec($this->ch), true);
		if (empty($tstat)) {
			$response['message'] = "Unable to retrieve thermostat temperature";
			$response['error'] = true;
			return $response;
		}

		$temp = $tstat['temp'];
		$target_temp = $tstat['t_heat'];
		$response['message'] = "Current Temperature: " . $temp . ", Target Temperature: " . $target_temp;
		$response['error'] = false;

		return $response;
	}

	private function getState() {
		$response = array();

		// Initialize cURL
		curl_setopt($this->ch, CURLOPT_URL, $this->url . 'tstat');
		curl_setopt($this->ch, CURLOPT_POST, 0);  
		$tstat = json_decode(curl_exec($this->ch), true);
		if (empty($tstat)) {
			$response['message'] = "Unable to retrieve thermostat mode";
			$response['error'] = true;
			return $response;
		}

		$mode = $tstat['tmode'];

		// TODO: Possibly change to specific modes
		if ($mode > 0) {
			$response['message'] = "Thermostat is currently ON";	
		} else {
			$response['message'] = "Thermostat is currently OFF";	
		}

		$response['error'] = false;

		return $response;
	}

	private function getName() {
		$response = array();

		// Initialize cURL
		curl_setopt($this->ch, CURLOPT_URL, $this->url . 'sys/name');
		curl_setopt($this->ch, CURLOPT_POST, 0);  
		$sysName = json_decode(curl_exec($this->ch), true);
		if (empty($sysName)) {
			$response['message'] = "Unable to retrieve thermostat name";
			$response['error'] = true;
			return $response;
		}

		$name = $sysName['name'];

		// TODO: Possibly change to specific modes
		$response['message'] = "Thermostat Name: " . $name;	
		$response['error'] = false;

		return $response;
	}

	private function setTemp($attr) {
		$response = array();

		if (!isset($attr['temperature'])) {
			$response['message'] = "Missing parameter for setTemp: temperature";
			$response['error'] = false;
			return $response;
		}

		curl_setopt($this->ch, CURLOPT_URL, $this->url . 'tstat');

		$newTemp = $attr['temperature'];
		$curlAttr = array(
			"t_heat" => $newTemp,
			"t_cool" => $newTemp
		);

		curl_setopt($this->ch, CURLOPT_POST, count($curlAttr));  // Set number of arguments.
		if (count($curlAttr) > 0) {
			$curlAttr = json_encode($curlAttr);
			$curlAttr = preg_replace( "/\"(\d+)\"/", '$1', $curlAttr );
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $curlAttr);  // Set arguments.
		}

		$result = json_decode(curl_exec($this->ch), true);

		if (isset($result['success'])) {
			$response['message'] = "Temperature is now set to " . $newTemp;
			$response['error'] = false;
			return $response;
		} else {
			$response['message'] = "Unable to set the temperature to " . $newTemp;
			$response['error'] = true;
			return $response;
		}
	}


	private function setState($attr) {
		if (!isset($attr['state'])) {
			$response['message'] = "Missing parameter for setState: state";
			$response['error'] = false;
			return $response;
		}

		curl_setopt($this->ch, CURLOPT_URL, $this->url . 'tstat');

		$newState = $attr['state'];
		if (strtolower($newState) == "on") {
			$newState = AUTO;
		} else {
			$newState = OFF;
		}

		$curlAttr = array(
			"tmode" => $newState
		);

		error_log(print_r($curlAttr, true));

		curl_setopt($this->ch, CURLOPT_POST, count($curlAttr));  // Set number of arguments.
		if (count($curlAttr) > 0) {
			$curlAttr = json_encode($curlAttr);
			$curlAttr = preg_replace( "/\"(\d+)\"/", '$1', $curlAttr );
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $curlAttr);  // Set arguments.
		}

		$result = json_decode(curl_exec($this->ch), true);

		if (isset($result['success'])) {
			$response['message'] = "Thermostat is now " . $attr['state'];
			$response['error'] = false;
			return $response;
		} else {
			$response['message'] = "Unable to turn the thermostat " . $attr['state'];
			$response['error'] = true;
			return $response;
		}
	}

	private function setName($attr) {
		if (!isset($attr['name'])) {
			$response['message'] = "Missing parameter for setName: name";
			$response['error'] = false;
			return $response;
		}

		curl_setopt($this->ch, CURLOPT_URL, $this->url . 'sys/name');

		$newName = $attr['name'];
		$curlAttr = array(
			"name" => $newName
		);

		curl_setopt($this->ch, CURLOPT_POST, count($curlAttr));  // Set number of arguments.
		if (count($curlAttr) > 0) {
			$curlAttr = json_encode($curlAttr);
			$curlAttr = preg_replace( "/\"(\d+)\"/", '$1', $curlAttr );
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $curlAttr);  // Set arguments.
		}

		$result = json_decode(curl_exec($this->ch), true);

		if (isset($result['success'])) {
			$response['message'] = "Thermostat's name is now set to: " . $newName;
			$response['error'] = false;
			return $response;
		} else {
			$response['message'] = "Unable to set the thermostat's name to: " . $newName;
			$response['error'] = true;
			return $response;
		}
	}

	private function raiseTemp($attr) {
		$response = array();

		if (!isset($attr['temperature'])) {
			$response['message'] = "Missing parameter for raiseTemp: temperature";
			$response['error'] = false;
			return $response;
		}

		curl_setopt($this->ch, CURLOPT_URL, $this->url . 'tstat');
		curl_setopt($this->ch, CURLOPT_POST, 0);  
		$tstat = json_decode(curl_exec($this->ch), true);

		if (empty($tstat)) {
			$response['message'] = "Unable to retrieve thermostat current temperature";
			$response['error'] = true;
			return $response;
		}

		$curTemp = $tstat['t_heat'];
		$newTemp = $curTemp + $attr['temperature'];
		$curlAttr = array(
			"t_heat" => $newTemp,
			"t_cool" => $newTemp
		);

		curl_setopt($this->ch, CURLOPT_POST, count($curlAttr));  // Set number of arguments.
		if (count($curlAttr) > 0) {
			$curlAttr = json_encode($curlAttr);
			$curlAttr = preg_replace( "/\"(\d+)\"/", '$1', $curlAttr );
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $curlAttr);  // Set arguments.
		}

		$result = json_decode(curl_exec($this->ch), true);

		if (isset($result['success'])) {
			$response['message'] = "Raised temperature by " . $attr['temperature'] . " degree.  Temperature is now set to " . $newTemp;
			$response['error'] = false;
			return $response;
		} else {
			$response['message'] = "Unable to set the temperature to " . $newTemp;
			$response['error'] = true;
			return $response;
		}
	}

	private function lowerTemp($attr) {
		$response = array();

		if (!isset($attr['temperature'])) {
			$response['message'] = "Missing parameter for raiseTemp: temperature";
			$response['error'] = false;
			return $response;
		}

		curl_setopt($this->ch, CURLOPT_URL, $this->url . 'tstat');
		curl_setopt($this->ch, CURLOPT_POST, 0);  
		$tstat = json_decode(curl_exec($this->ch), true);

		if (empty($tstat)) {
			$response['message'] = "Unable to retrieve thermostat current temperature";
			$response['error'] = true;
			return $response;
		}

		$curTemp = $tstat['t_heat'];
		$newTemp = $curTemp - $attr['temperature'];
		$curlAttr = array(
			"t_heat" => $newTemp,
			"t_cool" => $newTemp
		);

		curl_setopt($this->ch, CURLOPT_POST, count($curlAttr));  // Set number of arguments.
		if (count($curlAttr) > 0) {
			$curlAttr = json_encode($curlAttr);
			$curlAttr = preg_replace( "/\"(\d+)\"/", '$1', $curlAttr );
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $curlAttr);  // Set arguments.
		}

		$result = json_decode(curl_exec($this->ch), true);

		if (isset($result['success'])) {
			$response['message'] = "Lowered temperature by " . $attr['temperature'] . " degree.  Temperature is now set to " . $newTemp;
			$response['error'] = false;
			return $response;
		} else {
			$response['message'] = "Unable to set the temperature to " . $newTemp;
			$response['error'] = true;
			return $response;
		}
	}
}