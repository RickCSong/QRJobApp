<?php

require_once(APP . 'Utility' . DS . 'DeviceResponse.php');

class DeviceComponent extends Component {

	var $deviceList = array(
		"thermostat" => array(
			"url" => "http://69.181.104.20/",
			"model" => array()
		)
	);

	private function validateRequest($device, $command) {
		$response = array(
		);

		if (empty($device)) {
			$response['success'] = false;
			$response['message'] = "Unable to detect device";
			return $response;
		}

		if (!isset($this->deviceList[$device])) {
			$response['success'] = false;
			$response['message'] = "Invalid Device: " . $device;
			return $response;
		}

		if (empty($command)) {
			$response['success'] = false;
			$response['message'] = "Unable to detect command";
			return $response;
		}

		$response['success'] = true;
		return $response;
	}

	public function process($device, $command, $attr) {
		spl_autoload_register(array($this, 'autoload'));

		$validateResponse = $this->validateRequest($device, $command);

		// Validate the request
		if (!$validateResponse['success']) {
			$response = new ErrorResponse($validateResponse['message']);
			$response->send();
			return $validateResponse;
		}

		// Set the device URL
		$url = $this->deviceList[$device]['url'];

		// Initialize device
		//switch($model) {
			$device = new ThermostatCT30($url);
		//}

		// Execute action and store response
		$response_body = $device->execute($command, $attr);

		// Execute cURL request and encapsulate response
		// TODO: move this out.
		$response = new DeviceResponse(200, $response_body, 'application/json');

		// Send response
		$response->send();

		return $response_body;
	}

	// TODO: Rename Device Autoloader
	public function autoload($class_name) {
  	// looks for 'classes/user.php';
	  $file = APP . 'Vendor/Devices/' . $class_name . '.php';
	  if(file_exists($file)) {
	  	require_once $file;
	  }
	}

}