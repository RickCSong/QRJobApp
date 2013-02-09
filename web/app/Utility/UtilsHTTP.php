<?php

class UtilsHTTP {

	public static function getStatusCodeMessage($status) {  
		$codes = array(
			200 => 'OK',  
			201 => 'Created',  
			400 => 'Bad Request'
		);  

		return $codes[$status];
	}
	
}