<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jwt {
	public $ci = null;
	function __construct() {
		$this->ci = &get_instance();
	}
	public function generateJWT($payload, $secretKey) {
		// Header
		$header = array('alg' => 'HS256', 'typ' => 'JWT');
		$encodedHeader = $this->base64UrlEncode(json_encode($header));
		// Payload
		$encodedPayload = $this->base64UrlEncode(json_encode($payload));
		// Signature
		$signature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $secretKey, true);
		$encodedSignature = $this->base64UrlEncode($signature);
		// JWT
		$jwt = $encodedHeader . '.' . $encodedPayload . '.' . $encodedSignature;
		return $jwt;
	}
	private function base64UrlEncode($data) {
		$base64 = base64_encode($data);
		$base64Url = str_replace(array('+', '/', '='), array('-', '_', ''), $base64);
		return $base64Url;
	}
	public function isExpired($jwt, $secretKey) {
		// // Memisahkan token menjadi header, payload, dan signature
		// list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);
		// // Mengecek tanda tangan token
		// $signature = $this->base64UrlDecode($encodedSignature);
		// $expectedSignature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $secretKey, true);
		// // Membandingkan tanda tangan yang diharapkan dengan tanda tangan yang ada
		// if ($signature === $expectedSignature) {
		// 	$payload = json_decode($this->base64UrlDecode($encodedPayload), true);
		// 	$currentTime = time();
		// 	$expirationTime = $payload['exp'];
		// 	// Memeriksa keberlakuan token sesi
		// 	if ($currentTime > $expirationTime) {
		// 		return false; // Token sesi habis
		// 	} else {
		// 		return true; // Token sesi masih berlaku
		// 	}
		// }
		// return false; // Token tidak valid

		$sesi = array();
		if($this->isJWT($jwt)){
			$jwt=str_replace('Bearer ','',$jwt);
			list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);
			$signature = $this->base64UrlDecode($encodedSignature);
			$expectedSignature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $secretKey, true);
			// Membandingkan tanda tangan yang diharapkan dengan tanda tangan yang ada
			if ($signature === $expectedSignature) {
				$sesi = json_decode($this->base64UrlDecode($encodedPayload), true);
				$currentTime = time();
				$expirationTime = $sesi['exp'];
				// Memeriksa keberlakuan token sesi
				if ($currentTime > $expirationTime) {
					return true;
					// header("Location: ".base_url());
					// exit; 

					// $this->ci->result->session();
				} else {
					return false;
				}
			}else{

				return true;
				// $this->ci->result->error("Authorization Not Valid [1].");
			}
		}else{
			return true;
			// $this->ci->result->error("Authorization Not Valid [2].");
		}
	}
	private function base64UrlDecode($data) {
		$base64Url = str_replace(array('-', '_'), array('+', '/'), $data);
		$base64 = base64_decode($base64Url);
		return $base64;
	}
	private function isJWT($string) {
		// JWTs consist of three parts separated by dots
		$parts = explode('.', $string);

		// A valid JWT should have exactly three parts
		if (count($parts) !== 3) {
			return false;
		}

		// Check if each part is base64-encoded
		foreach ($parts as $part) {
			$part = str_replace(array('-', '_'), array('+', '/'), $part);
			if (!base64_decode($part, true)) {
				return false;
			}
		}

		return true;
	}
	public function getData($jwt, $secretKey) {
		$sesi = array();
		if($this->isJWT($jwt)){
			$jwt=str_replace('Bearer ','',$jwt);
			list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);
			$signature = $this->base64UrlDecode($encodedSignature);
			$expectedSignature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $secretKey, true);
			// Membandingkan tanda tangan yang diharapkan dengan tanda tangan yang ada
			if ($signature === $expectedSignature) {
				$sesi = json_decode($this->base64UrlDecode($encodedPayload), true);
				$currentTime = time();
				$expirationTime = $sesi['exp'];
				// Memeriksa keberlakuan token sesi
				if ($currentTime > $expirationTime) {
					// header("Location: ".base_url());
					// exit; 

					// $this->ci->result->session();
				} else {
					return $sesi;//['data']; // Token sesi masih berlaku
				}
			}else{
				header("HTTP/1.1 403 Forbidden");
				// $this->ci->result->error("Authorization Not Valid [1].");
			}
		}else{
			header("HTTP/1.1 403 Forbidden");
			// $this->ci->result->error("Authorization Not Valid [2].");
		}
		return $sesi; // Hak akses tidak valid
		// $sesi = array();
		// if ($jwt != '') {
		// 	// Memisahkan token menjadi header, payload, dan signature
		// 	list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);
		// 	// Mengecek tanda tangan token
		// 	$signature = $this->base64UrlDecode($encodedSignature);
		// 	$expectedSignature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $secretKey, true);
		// 	// Membandingkan tanda tangan yang diharapkan dengan tanda tangan yang ada
		// 	if ($signature === $expectedSignature) {
		// 		$sesi = json_decode($this->base64UrlDecode($encodedPayload), true);
		// 		// Memeriksa hak akses
		// 	}
		// }
		// return $sesi; // Hak akses tidak valid
	}
	public function getAccess($jwt, $secretKey) {
		$sesi = array();
		if($this->isJWT($jwt)){
			$jwt=str_replace('Bearer ','',$jwt);
			list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);
			$signature = $this->base64UrlDecode($encodedSignature);
			$expectedSignature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $secretKey, true);
			// Membandingkan tanda tangan yang diharapkan dengan tanda tangan yang ada
			if ($signature === $expectedSignature) {
				$sesi = json_decode($this->base64UrlDecode($encodedPayload), true);
				$currentTime = time();
				$expirationTime = $sesi['exp'];
				// Memeriksa keberlakuan token sesi
				if ($currentTime > $expirationTime) {
					$this->ci->result->session();
				} else {
					return $sesi['access']; // Token sesi masih berlaku
				}
			}else{
				header("HTTP/1.1 403 Forbidden");
				// $this->ci->result->error("Authorization Not Valid [1].");
			}
		}else{
			header("HTTP/1.1 403 Forbidden");
			// $this->ci->result->error("Authorization Not Valid [2].");
		}
		return $sesi; // Hak akses tidak valid
		// $sesi = array();
		// if ($jwt != '') {
		// 	// Memisahkan token menjadi header, payload, dan signature
		// 	list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $jwt);
		// 	// Mengecek tanda tangan token
		// 	$signature = $this->base64UrlDecode($encodedSignature);
		// 	$expectedSignature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $secretKey, true);
		// 	// Membandingkan tanda tangan yang diharapkan dengan tanda tangan yang ada
		// 	if ($signature === $expectedSignature) {
		// 		$sesi = json_decode($this->base64UrlDecode($encodedPayload), true);
		// 		// Memeriksa hak akses
		// 	}
		// }
		// return $sesi; // Hak akses tidak valid
	}

}