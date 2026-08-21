<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cast extends CI_Controller {
	public function index(){
		if(isset($_GET['invitation'])){
			$invitationCode=$_GET['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.event_name,e.event_desc,e.broadcast_allow,e.record_allow,e.valid_flag,e.schedule_on,e.duration,e.last_moderator_join,e.last_broadcast_on,e.moderator_join_flag,
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
					$isModerator=$row->moderator_flag==1?true:false;
					$isParticipant=$row->moderator_flag==0 && $row->participant_flag==1?true:false;
					$isAudience=$row->moderator_flag==0 && $row->participant_flag==0?true:false;
					$this->load->view('templates/full2column',array('isAudience'=>$isAudience,'isParticipant'=>$isParticipant,'view'=>'cast','roomName'=>$row->event_name,'navigate'=>'cast_moderator','left'=>'cast_left','isModerator'=>$isModerator,'eventData'=>$row));
				}else{
					echo 'You\'re Banned';
				}
				
			}else{
				echo 'Not Valid';
			}
			
		}else show_404();
	}
	function uuidv4(){
		$data = random_bytes(16);
		$data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
		$data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
		return vsprintf(
			'%s%s-%s-%s-%s-%s%s%s',
			str_split(bin2hex($data), 4)
		);
	}
	public function getTopMessage(){
		if(isset($_GET['invitation'])){
			$invitationCode=$_GET['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.valid_flag,
					u.user_id,u.user_name,u.email,u.moderator_flag, u.participant_flag,u.ban_flag
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
					$lastTime=$_GET['last_time'];
					$query = "
						SELECT m.message_id,m.message,m.delete_flag,m.create_on,m.user_id,u.user_name,
							IF(u.moderator_flag, 'moderator', IF(u.moderator_flag=false && u.participant_flag, 'participant', 'audince')) AS role 
							FROM cast_event_message m
							INNER JOIN cast_event e ON e.event_id=m.event_id
							INNER JOIN cast_event_user u ON u.user_id=m.user_id
							WHERE m.event_id=? AND m.create_on<?
							ORDER BY m.create_on DESC LIMIT 30";
					$result=$this->db->query($query, [
						$row->event_id,
						$lastTime
					])->result();
					$this->result->setData($result)->end();
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
	public function saveMessage(){
		if(isset($_POST['invitation'])){
			$invitationCode=$_POST['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.valid_flag,
					u.user_id,u.user_name,u.email,u.moderator_flag, u.participant_flag,u.ban_flag
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
					$message=$_POST['message'];
					$query = "
						INSERT INTO cast_event_message (
							message_id,
							event_id,
							user_id,
							create_on,
							message
						)
						VALUES (
							?,
							?,
							?,
							UTC_TIMESTAMP(),
							?
						)";
					$this->db->query($query, [
						$this->uuidv4(),
						$row->event_id,
						$row->user_id,
						$message
					]);
					$this->result->end();
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
	public function getjwtws(){
		if(isset($_GET['invitation'])){
			$invitationCode=$_GET['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.valid_flag,
					u.user_id,u.user_name,u.email,u.moderator_flag, u.participant_flag,u.ban_flag
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
					$this->result->setData(array('jwt'=>$jwtWs))->end();
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
	public function join(){
		if(isset($_GET['invitation'])){
			$invitationCode=$_GET['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.valid_flag,
					u.user_id,u.user_name,u.email,u.moderator_flag, u.participant_flag,u.ban_flag
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
					$this->db->query("
						UPDATE cast_event_user
						SET join_flag = 1
						WHERE user_id = ?
					", [$row->user_id]);
					if ($row->moderator_flag == 1) {
						$this->db->query("
								UPDATE cast_event
								SET moderator_join_flag = 1
								WHERE event_id = ?
							", [$row->event_id]);
					}
					$this->result->end();
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
	public function left(){
		if(isset($_GET['invitation'])){
			$invitationCode=$_GET['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.valid_flag,
					u.user_id,u.user_name,u.email,u.moderator_flag, u.participant_flag,u.ban_flag
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
					$this->db->query("
						UPDATE cast_event_user
						SET join_flag = 0
						WHERE user_id = ?
					", [$row->user_id]);
					if ($row->moderator_flag == 1) {
						$this->db->query("
								UPDATE cast_event
								SET moderator_join_flag = 0
								WHERE event_id = ?
							", [$row->event_id]);
					}
					$this->result->end();
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
	public function heartbeat(){
		if(isset($_GET['invitation'])){
			$invitationCode=$_GET['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.valid_flag,
					u.user_id,u.user_name,u.email,u.moderator_flag, u.participant_flag,u.ban_flag
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
					$this->db->query("
						UPDATE cast_event_user
						SET last_connect_on = UTC_TIMESTAMP()
						WHERE user_id = ?
					", [$row->user_id]);
					if ($row->moderator_flag == 1) {
						if(isset($_GET['broadcast']) && $_GET['broadcast']=='yes'){
							$this->db->query("
								UPDATE cast_event
								SET last_moderator_join = UTC_TIMESTAMP() , last_broadcast_on = UTC_TIMESTAMP()
								WHERE event_id = ?
							", [$row->event_id]);
						}else{
							$this->db->query("
								UPDATE cast_event
								SET last_moderator_join = UTC_TIMESTAMP()
								WHERE event_id = ?
							", [$row->event_id]);
						}
						
					}
					$this->result->end();
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
	public function getAccess(){
		if(isset($_GET['invitation'])){
			$invitationCode=$_GET['invitation'];
			$sql = "
				SELECT e.event_id,e.event_code,e.valid_flag,
					u.user_id,u.user_name,u.email,u.moderator_flag, u.participant_flag,u.ban_flag
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
						$jwtHost=$this->jwt->generateJWT($payload,$appSecret.'aud');
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
