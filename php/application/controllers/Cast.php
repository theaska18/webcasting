<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cast extends CI_Controller {
	public function index(){
		if(isset($_GET['invitation'])){
			$invitationCode=$_GET['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.event_name,e.event_desc,e.broadcast_allow,e.record_allow,e.valid_flag,e.schedule_on,e.duration,e.last_moderator_join,
					u.user_id,u.user_name,u.email,u.moderator_flag, u.participant_flag,u.message_allow,u.pooling_allow,u.ban_flag,invitation_code, e.organization,e.message_allow as event_message_allow,e.pooling_allow as event_pooling_allow
				FROM cast_event_user u
				INNER JOIN cast_event e
					ON e.event_id = u.event_id
				WHERE u.invitation_code = ?
				LIMIT 1
			";

			$row = $this->db->query($sql, [$invitationCode])->row();
			if($row->valid_flag==1){
				if($row->ban_flag==0){
					// echo json_encode($row);
					$isModerator=$row->moderator_flag==1?true:false;
					$this->load->view('templates/full2column',array('jwtWs'=>$this->getJwtWS(),'view'=>'cast','roomName'=>$row->event_name,'navigate'=>'cast_moderator','left'=>'cast_left','isModerator'=>$isModerator,'eventData'=>$row));
				}else{
					echo 'You\'re Banned';
				}
				
			}else{
				echo 'Not Valid';
			}
			
			// $appSecret = 'webcast'; 
			// $isExpired=$this->jwt->isExpired($jwt,$appSecret);
			// if(!$isExpired){
			// 	$data=$this->jwt->getData($jwt,$appSecret);
			// 	$isModerator=$data['context']['user']['moderator'];
			// 	$this->load->view('templates/full2column',array('view'=>'cast','roomName'=>$roomName,'navigate'=>'cast_moderator','left'=>'cast_left','jwt'=>$jwt,'isModerator'=>$isModerator,'jwtData'=>$data['context']));
			// }else
			// 	$this->load->view('templates/1column',array('view'=>'page_not_found'));
			
		}else show_404();
	}
	function getJwtWS(){
		$appId = 'webcast';              // dari Jitsi / 8x8
		$appSecret = 'webcast';      // PRIVATE KEY / SECRET
		$domain = 'jitsi.ckamal.com';          // domain j
		$now = time();
		$exp = $now + (60 * 60); // 1 jam

		$payload = [
			"aud" => "jitsi",
			"iss" => $appId,
			"sub" => $domain,
			"exp" => $exp,
			"nbf" => $now
		];
		$jwtWs=$this->jwt->generateJWT($payload,$appSecret);
		return $jwtWs;
	}
	public function getAccess(){
		if(isset($_GET['invitation'])){
			$invitationCode=$_GET['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.event_name,e.event_desc,e.broadcast_allow,e.record_allow,e.valid_flag,e.schedule_on,e.duration,e.last_moderator_join,
					u.user_id,u.user_name,u.email,u.moderator_flag, u.participant_flag,u.message_allow,u.pooling_allow,u.ban_flag,invitation_code, e.organization,e.message_allow as event_message_allow,e.pooling_allow as event_pooling_allow
				FROM cast_event_user u
				INNER JOIN cast_event e
					ON e.event_id = u.event_id
				WHERE u.invitation_code = ?
				LIMIT 1
			";

			$row = $this->db->query($sql, [$invitationCode])->row();
			if(!$row){
				$this->result->error("Invitation is not valid.");
			}
			$isModerator=$row->moderator_flag==1?true:false;
			if($row->valid_flag==1){
				if($row->ban_flag==0){
					$appId = 'webcast';            // dari Jitsi / 8x8
					$appSecret = 'webcast';      // PRIVATE KEY / SECRET
					$domain = 'jitsi.ckamal.com';          // domain ji
					$now = time();
					$exp = $now + (60 * 60); // 1 jam
					$payload=array();
					$jwtHost='';
					if($isModerator){
						$payload = [
							"aud" => "jitsi",
							"iss" => $appId,
							"sub" => $domain,
							"room" => $row->event_code,
							"exp" => $exp,
							"nbf" => $now,
							"context" => [
								"user" => [
									"name" => $row->user_name,
									'email'=>$row->email,
									"moderator" => true
								],
								"features" => [
									"recording" => true,
									"livestreaming" => true,
								]
							]
						];
						$jwtHost=$this->jwt->generateJWT($payload,$appSecret);
					}else if($row->participant_flag==1){
						$payload = [
							"aud" => "jitsi",
							"iss" => $appId,
							"sub" => $domain,
							"room" => $row->event_code,
							"exp" => $exp,
							"moderator"=> false,
							"nbf" => $now,
							"context" => [
								"user" => [
									"name" => $row->user_name,
									'email'=>$row->email,
									"moderator" => false,
									"role"=> "visitor" 
								]
							]
						];
						$jwtHost=$this->jwt->generateJWT($payload,$appSecret);
					}else{
						$this->result->error("Invitation is Banned.");
					}
					$this->result->setData(array('jwt'=>$jwtHost))->end();
				}else{
					$this->result->error("Invitation is Banned.");
				}
				
			}else{
				$this->result->error("Invitation is not valid.");
			}



			
		}else{
			$this->result->error("parameter 'invitation' is required.");
		}
	}
}
