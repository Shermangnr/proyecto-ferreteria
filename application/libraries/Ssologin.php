<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Ssologin {
	private $curl;
	private $url;
	private $status;
	private $json_response;
	private $aplicacion = 0;
	public function ingresar($user, $pw) {
		$data = (object) array(
			'password' => codificarssl($pw,KEY_SSOLOGIN),
			'username' => $user,
			'aplicacion' => $this->aplicacion
		);
		$params = 'datos='. codificar($data);
		return $this->ejecutar('datos', $params);
	}
	public function validar($user) {
		$data = (object) array(
			'username' => codificarssl($user,KEY_SSOLOGIN),
			'aplicacion' => $this->aplicacion
		);
		$params = 'datos='. codificar($data);
		return $this->ejecutar('validar', $params);
	}
	private function ejecutar($url, $params) {
		$this->url = SSOLOGIN . $url;
		$this->curl = curl_init($this->url);
		curl_setopt($this->curl, CURLOPT_HEADER, false);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->curl, CURLOPT_POST, true);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);
		if (ENVIRONMENT !== 'production') {
			curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
		}
		$this->json_response = curl_exec($this->curl);
		$this->status = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
		$response = $this->errores();
		if (empty($response['success'])) {
			if (!empty($response['errores']))
				$response['errores'] = join('<br>', $response['errores']);
		}
		curl_close($this->curl);
		return $response;
	}
	private function errores($code = 200) {
		if ($this->status != $code) {
			$response['errores']['1'] = "Error: call to token URL $this->url failed with status $this->status";
			$response['errores']['2'] = "Response $this->json_response, curl_error " . curl_error($this->curl) . ', curl_errno ' . curl_errno($this->curl);
		} else {
			$response = json_decode($this->json_response, true);
		}
		return $response;
	}
}
