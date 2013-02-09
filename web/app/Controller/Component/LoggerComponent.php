<?php

class LoggerComponent extends Component {
  var $log_file = "files/logs/test_log.txt";

	public function update() {
    $response = array();
    $response['action'] = 'update';

    if (file_exists($this->log_file)) {
      $lines = file($this->log_file);
      $text = array();
      foreach ($lines as $line_num => $line) {
        $text[] = str_replace("\n", "", $line);
      }

      $response['status'] = "OK";
      $response['text'] = $text;
    } 

    echo json_encode($response);
	}

	public function send($device, $message) {
		if (($message) != "\n") {
      fwrite(fopen($this->log_file, 'a'), "<div><span>". $device . ": </span>" . $message . "</div>\n"); 
    }
	}

  public function reset() {
    if (file_exists($this->log_file)) {
      fwrite(fopen($this->log_file, 'w'), "");
    }
  }

}

?>