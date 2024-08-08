<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();        
	}

    public function index() {
        $this->load->view('login/login');
    }

	public function ingresar() {
        header('Content-Type: application/json');
		if (!empty($this->formData->nombre_usuario) && !empty($this->formData->contrasena)) {			
            $data = $this->load->model('Usuario_model');

            $data = $this->Usuario_model->traer_usuario($this->formData->nombre_usuario);
            if(empty($data)) {
                $this->json(array(
                    'resp' => 0,
                    'msg' => 'Usted no se encuentra registrado'
                ));
            }else{
                $contrasena_encriptada =  hash('sha256', crypt($this->formData->contrasena, '$1$Qk/.Z.1.$'));
                
                if($contrasena_encriptada === $data->contrasena){
                    $nombre_completo = $data->nombre_empleado .' '. $data->apellido_empleado;
                    $datos = array(
                        'id' => $data->id,
                        'usuario' => $data->nombre_usuario,
                        'correo' => $data->correo,
                        'nombre_completo' => $nombre_completo,
                        'numero_identificacion' => $data->numero_identificacion,
                        'foto_perfil' => $data->foto_perfil,
                        'id_cargo' => $data->id_cargo
                    );

                    $this->session->datosusuario = (object) $datos;                    
                    
                    $this->json(array(
                        'resp' => 1
                    ));
                }else{
                    $this->json(array(
                        'resp' => 0,
                        'msg' => 'Contraseña incorrecta'
                    ));
                }
            }

        }else{
            $this->json(array(
                'resp' => 0,
                'msg' => 'Los campos no pueden estar vacios'
            ));
        }
	}
	public function salir() {
		$this->session->datosusuario = null;
		redirect(IP_SERVER.'login');
	}
	public function logout() {
		if (!empty($this->formData->usuario)) {
			$this->updateuser($this->formData->usuario);
			$this->reques->data = 'Logout';
			$this->deletefiles();
		} else {
			$this->iffalse('no token');
		}
		unset($this->session->datosusuario);
		$this->json();
	}
	
	private function updateuser($usuario, $data = '') {
		if (empty($data)) {
			$data = ['token' => '', 'roles' => '', 'tiempo' => ''];
		}
		$this->lg->update($usuario, $data);
	}
}
