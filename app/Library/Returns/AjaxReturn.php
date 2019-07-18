<?php

namespace App\Library\Returns;

use \Session;

class AjaxReturn {

	private $success_title = '';
	private $success_message = '';
	private $error_title = '';
	private $error_message = '';
	private $action = false;
	private $response = null;

	public function setResult($action, $title, $message) {
		if($action) {
			$this->action = true;
			$this->success_title = $title;
			$this->success_message = $message;
		} else {
			$this->action = false;
			$this->error_title = $title;
			$this->error_message = $message;
		}
	}

	public function setResponse($response) {
		$this->response = $response;
	}

	public function getReturn() {
		return array(
			'action'			=> $this->action,
			'response'			=> $this->response,
			'title'				=> $this->action?$this->success_title:$this->error_title,
			'message'			=> $this->action?$this->success_message:$this->error_message,
			'success_title'		=> $this->success_title,
			'success_message'	=> $this->success_message,
			'error_title'		=> $this->error_title,
			'error_message'		=> $this->error_message);
	}

	public function getJsonReturn() {
		return json_encode(array(
			'action'			=> $this->action,
			'response'			=> $this->response,
			'title'				=> $this->action?$this->success_title:$this->error_title,
			'message'			=> $this->action?$this->success_message:$this->error_message,
			'success_title'		=> $this->success_title,
			'success_message'	=> $this->success_message,
			'error_title'		=> $this->error_title,
			'error_message'		=> $this->error_message));
	}

}