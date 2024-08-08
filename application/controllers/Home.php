<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/third_party/Autoloader.php';
require_once 'application/third_party/psr/Autoloader.php';
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Usuario_model');
        $this->load->model('Tipo_identificacion_model');
        $this->load->model('Cargos_model');
        $this->load->model('Materiales_model');
        $this->load->library('session');

        if (empty($this->session->datosusuario)) {
            redirect('login');
		}
	}
    // Mostrar el formulario del login
	public function index() {    
		$this->vista('pagina_principal/pagina_principal', [
            'inicio' => 'inicio',
        ]);
	}
    // Autenticar al usuario
    public function authenticate() {
        $username = $this->input->post('nombre_usuario');
        $password = $this->input->post('contrasena');

        $user = $this->Login_model->login($username, $password);

        if ($user) {
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('nombre_usuario', $user->nombre_usuario);
            redirect('home/pagina_principal'); 
        } else {
            $data['error'] = "Nombre de usuario o contraseña incorrectos.";
            log_message('error', 'Authentication failed for user: ' . $username);
            $this->load->view('login/login', $data);
        }
    }

    public function pagina_principal() {
        if(!$this->session->userdata('user_id')) {
            redirect('home'); 
        }
        $this->vista('pagina_principal/pagina_principal', [
            'inicio' => 'inicio',
        ]);
    }

    public function logout() {
        // Destruir todas las sesiones
        $this->session->sess_destroy();
        
        // Redirigir a la página de login
        redirect('home');
    }
	
    public function registro_usuarios() {
        $tipos = $this->Tipo_identificacion_model->obtener_tipos();
        $cargos = $this->Cargos_model->obtener_cargos();
        $this->vista('registro_usuarios/registro_usuarios', [
            'inicio' => 'registro',
            'tipos' => $tipos,
            'cargos' => $cargos
        ]);
    }

    // Guardar un usuario en la base de datos
    public function guardar_usuario() {
        $this->load->helper('url');
        $this->load->library('form_validation');        
        
        $this->form_validation->set_rules('nombre_empleado', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido_empleado', 'Apellido', 'required');
        $this->form_validation->set_rules('tipo_identificacion', 'Tipo de identificación', 'required');
        $this->form_validation->set_rules('numero_identificacion', 'Número de identificación', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
        $this->form_validation->set_rules('cargo', 'Cargo', 'required');
        $this->form_validation->set_rules('nombre_usuario', 'Nombre de usuario', 'required');
        // $this->form_validation->set_rules('contrasena', 'Contraseña', 'required');
        // $this->form_validation->set_rules('foto_perfil', 'Foto de perfil', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Si la validación falla, recarga el formulario con errores
            $this->registro_usuarios();
        } else {
            // Si la validación es exitosa, guarda el usuario
            $id = $this->input->post('id');

            $data = array(
                'nombre_empleado' => $this->input->post('nombre_empleado'),
                'apellido_empleado' => $this->input->post('apellido_empleado'),
                'id_tipo_identificacion' => $this->input->post('tipo_identificacion'),
                'numero_identificacion' => $this->input->post('numero_identificacion'),
                'correo' => $this->input->post('correo'),
                'id_cargo' => $this->input->post('cargo'),
                'nombre_usuario' => $this->input->post('nombre_usuario')
                // 'foto_perfil' => $this->input->post('foto_perfil')
            );

            if (empty($id)) {
                $data['contrasena'] = hash('sha256', crypt($this->formData->contrasena, '$1$Qk/.Z.1.$'));
                $this->Usuario_model->insertar_usuario($data);
    
                $this->session->set_flashdata('registro_exito', 'Usuario registrado exitosamente');
                
                // Redirige a una página de éxito o muestra un mensaje
                redirect('home/registro_usuarios');
            }else{
                $this->Usuario_model->editar_usuarios($id, $data);

                $this->session->set_flashdata('actualizacion_exito', 'Usuario actualizado exitosamente');

                redirect('home/listado_usuarios');
            }

            
        }
    }

    // Mostrar el listado de usuarios    
    public function listado_usuarios() {
        $usuarios = $this->Usuario_model->obtener_usuarios();
        $this->vista('listado_usuarios/listado_usuarios', [
            'inicio' => 'listado',
            'usuarios' => $usuarios
        ]);
    }

    //? Eliminar usuarios
    public function eliminar_usuario(){
        $id = $this->input->post('id');

        $respuesta = $this->Usuario_model->eliminar_usuario($id);

        $valor = 0;
        $msg = '';

        if($respuesta){
            $valor = 1;
            $msg = 'Usuario eliminado';
        }else{
            $msg = 'Error al eliminar';
        }

        $this->json([
            'resp' => $valor,
            'msg' => $msg
        ]);
    }

    public function editar_usuarios($id){
        $tipos = $this->Tipo_identificacion_model->obtener_tipos();
        $cargos = $this->Cargos_model->obtener_cargos();
        $usuario = $this->Usuario_model->obtener_un_usuario($id);

        $this->vista('editar_usuarios/editar_usuarios', [
            'inicio' => 'editar',
            'tipos' => $tipos,
            'cargos' => $cargos,
            'usuario'=> $usuario
        ]);
    }

    public function inventario() {
        $materiales = $this->Materiales_model->obtener_materiales();        
        $this->vista('inventario/inventario', [
            'inicio' => 'inventario',
            'materiales' => $materiales
        ]);
    }

    public function agregar_material() {
        $this->vista('agregar_material/agregar_material', [
            'inicio' => 'agregar'
        ]);
    }

    // Guardar un material en la base de datos
    public function guardar_material() {
        $this->load->helper('url');
        $this->load->library('form_validation'); // Cargar la librería de validación
    
        // Establecer reglas de validación
        $this->form_validation->set_rules('nombre_material', 'Nombre de material', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');
        $this->form_validation->set_rules('codigo', 'Codigo', 'required');
        $this->form_validation->set_rules('fecha_creacion', 'Fecha de creacion', 'required');
        $this->form_validation->set_rules('tamano', 'Tamano', 'required');
        $this->form_validation->set_rules('precio_unitario', 'Precio unitario', 'required');
    
        // Verificar si la validación falla
        if ($this->form_validation->run() === FALSE) {
            $this->agregar_material(); // Mostrar el formulario nuevamente si hay errores de validación
        } else {
            $id = $this->input->post('id'); // Obtener el ID del material (si existe)
    
            // Obtener el nombre del usuario de la sesión
            $usuario_creador = $this->session->datosusuario->usuario;
    
            // Recopilar los datos del formulario
            $data = array(
                'nombre_material' => $this->input->post('nombre_material'),
                'descripcion' => $this->input->post('descripcion'),
                'cantidad' => $this->input->post('cantidad'),
                'codigo' => $this->input->post('codigo'),
                'fecha_creacion' => $this->input->post('fecha_creacion'),
                'tamano' => $this->input->post('tamano'),
                'precio_unitario' => $this->input->post('precio_unitario'),
                'usu_creador' => $usuario_creador
            );
    
            // Verificar si se trata de una inserción o una actualización
            if (empty($id)) {
                $this->Materiales_model->agregar_material($data); // Agregar un nuevo material
                $this->session->set_flashdata('agregar_exito', 'Material agregado exitosamente'); // Mensaje de éxito
                redirect('home/agregar_material'); // Redirigir al formulario nuevamente
            }
        }
    }

    public function traer_material($id) {
        $material = $this->Materiales_model->traer_material($id);
        
        $this->json([
            'resp' => 1,
            'material' => $material
        ]);
    }

    public function editar_material () {
        $id = $this->formData->id;        
        unset($this->formData->id);
        $datos = $this->formData;
        $this->Materiales_model->editar_material($id, $datos);
        $this->json([
            'resp' => 1,
            'mensaje' => 'Material actualizado!'
        ]);
    }

    public function facturas() {
        $this->vista('facturas/facturas', [
            'inicio' => 'facturas',
        ]);
    }
}
