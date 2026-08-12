<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Result {
	public $code = '00', $message = '', $time = null, $total = null, $data = null;
	private $ci;
	function __construct() {
		$this->ci = &get_instance();
	}
	public function success($message, $data = array(), $total = null) {
		$this->message = $message;
		$this->data = $data;
		$this->code = '00';
		$this->total = $total;
		$this->end();
	}
	public function end() {
		$ci = &get_instance();
		//$this->ci->query->end();
		$this->time = date("Y-m-d H:i:s");
		if ($this->total == null) {
			unset($this->total);
		}
		if($this->code != '00'){
			http_response_code(500);
		}
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this);
		exit ();
	}
	public function error($message) {
		$this->message = $message;
		$this->code = '01';
		$this->end();
	}
	public function warning($message) {
		$this->message = $message;
		$this->code = '02';
		$this->end();
	}
	public function privilege() {
		$this->message = 'Not Have Access.';
		$this->code = '03';
		$this->end();
	}
	public function session() {
		$this->message = 'Session Expired.';
		$this->code = '04';
		$this->end();
	}
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	public function setData($data) {
		$this->data = $data;
		return $this;
	}
	public function setTotal($data) {
		$this->data = $data;
		return $this;
	}
}
