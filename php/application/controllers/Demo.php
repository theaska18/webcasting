<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$appId = 'webcast';              // dari Jitsi / 8x8
		$appSecret = 'webcast';      // PRIVATE KEY / SECRET
		$domain = 'jitsi.ckamal.com';          // domain jitsi kamu
		$roomName=$this->generateRoomName();
		$hostName=$this->generateRoomName('host');
		$presenterName=$this->generateRoomName('presenter');
		$audienceName=$this->generateRoomName('audience');
		$now = time();
		$exp = $now + (60 * 60); // 1 jam

		$payload = [
			"aud" => "jitsi",
			"iss" => $appId,
			"sub" => $domain,
			"room" => $roomName,
			"exp" => $exp,
			"nbf" => $now,
			"context" => [
				"user" => [
					"name" => $hostName,
					"moderator" => true
				],
				"features" => [
					"recording" => true,
					"livestreaming" => true,
				]
			]
		];
		$jwtHost=$this->jwt->generateJWT($payload,$appSecret);
		$now = time();
		$exp = $now + (60 * 60); // 1 jam
		$payload = [
			"aud" => "jitsi",
			"iss" => $appId,
			"sub" => $domain,
			"room" => $roomName,
			"exp" => $exp,
			"moderator"=> false,
			"nbf" => $now,
			"context" => [
				"user" => [
					"name" => $presenterName,
					"moderator" => false,
					"role"=> "visitor" 
				]
			]
		];
		$jwtPresenter=$this->jwt->generateJWT($payload,$appSecret);
		$jwtAudience=$this->jwt->generateJWT($payload,$appSecret);
		$this->load->view('templates/1column',array('view'=>'demo','roomName'=>$roomName,'hostName'=>$hostName,'presenterName'=>$presenterName,'audienceName'=>$audienceName,'jwtHost'=>$jwtHost,'jwtPresenter'=>$jwtPresenter,'jwtAudience'=>$jwtAudience));
	}
	function generateRoomName($type='room',$length = 8) {
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$random = substr(str_shuffle($characters), 0, $length);
		return $type.'_' . $random;
	}
}
