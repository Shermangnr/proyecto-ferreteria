<?php
class Usuario_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    public $table = 'usuarios';
    public $id = 'id';

    //? Obtener un usuario por usuario.
    public function traer_usuario($nombre_usuario){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('nombre_usuario',$nombre_usuario);
        $query = $this->db->get();
        return $query->row();
    } 

    public function insertar_usuario($data) {
        return $this->db->insert('usuarios', $data);
    } 
    
    public function eliminar_usuario($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function editar_usuarios($id, $data) { 
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    
    public function obtener_usuarios() {
        return $this->db->select('u.id, 
        u.nombre_empleado, 
        u.apellido_empleado, 
        u.id_tipo_identificacion, 
        u.numero_identificacion, 
        u.correo, 
        u.id_cargo, 
        u.nombre_usuario,
        ti.nombre as nombre_tipo_identificacion,
        c.nombre as nombre_cargo')
        ->from('usuarios as u')
        ->join('tipo_identificacion as ti','ti.id = u.id_tipo_identificacion')
        ->join('cargos as c','c.id = u.id_cargo')
        ->order_by('u.nombre_empleado','asc')
        ->get()
        ->result();

    }

    public function obtener_un_usuario($id) {
        return $this->db->select ('u.id, 
        u.nombre_empleado, 
        u.apellido_empleado, 
        u.id_tipo_identificacion, 
        u.numero_identificacion, 
        u.correo, 
        u.id_cargo, 
        u.nombre_usuario,
        ti.nombre as nombre_tipo_identificacion,
        c.nombre as nombre_cargo')
        ->from('usuarios as u')
        ->join('tipo_identificacion as ti','ti.id = u.id_tipo_identificacion')
        ->join('cargos as c','c.id = u.id_cargo')
        ->where('u.id', $id)
        ->get()
        ->row();

    }        
}
?>
