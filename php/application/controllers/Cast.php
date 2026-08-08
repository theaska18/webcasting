<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cast extends CI_Controller {
	public function index($roomName=""){
		if($roomName!==''){
			$this->load->view('templates/full2column',array('view'=>'cast','roomName'=>$roomName,'navigate'=>'cast_moderator','left'=>'cast_left'));
		}else
			show_404();
	}
}
