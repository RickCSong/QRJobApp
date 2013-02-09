<?php

require_once(APP . 'Utility' . DS . 'UtilsHTTP.php');

class DeviceResponse extends CakeResponse {

	public function __construct($code = 200, $body = '', $type = 'application/json') {
		$httpHeader = 'HTTP/1.1 ' .  $code . ' ' . UtilsHTTP::getStatusCodeMessage($code);
		$contentType = 'Content-type: ' . $type;
		
		parent::__construct(array(
			'header' => array( 
				$httpHeader,
				$contentType),
			'statusCode' => 200,
			'body' => json_encode($body)
		));
	}	
}

class ErrorResponse extends CakeResponse {
	public function __construct($body = '') {
		$code = 400;
		$type = 'application/json';
		$httpHeader = 'HTTP/1.1 ' .  $code . ' ' . UtilsHTTP::getStatusCodeMessage($code);
		$contentType = 'Content-type: ' . $type;
		$response_body = array(
			'message' => $body,
			'error' => true
		);

		parent::__construct(array(
			'header' => array( 
				$httpHeader,
				$contentType),
			'statusCode' => 200,
			'body' => json_encode($body)
		));
	}	
}

?>