<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cast extends CI_Controller {
	public function index($roomName="",$jwt=''){
		if($roomName!==''){
			$appSecret = 'webcast'; 
			$isExpired=$this->jwt->isExpired($jwt,$appSecret);
			if(!$isExpired){
				$data=$this->jwt->getData($jwt,$appSecret);
				$isModerator=$data['context']['user']['moderator'];
				$this->load->view('templates/full2column',array('view'=>'cast','roomName'=>$roomName,'navigate'=>'cast_moderator','left'=>'cast_left','jwt'=>$jwt,'isModerator'=>$isModerator,'jwtData'=>$data['context']));
			}else
				$this->load->view('templates/1column',array('view'=>'page_not_found'));
			
		}else
			show_404();
	}
}
