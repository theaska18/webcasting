<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {
	public function index($roomName=""){
		if($roomName!==''){
			$this->load->view('view',array('roomName'=>$roomName));
		}else
			show_404();
	}
}
