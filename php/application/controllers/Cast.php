<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cast extends CI_Controller {
	public function index($roomName=""){
		if($roomName!==''){
			$this->load->view('cast',array('roomName'=>$roomName));
		}else
			show_404();
	}
}
