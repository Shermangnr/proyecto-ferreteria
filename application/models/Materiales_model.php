<?php

class Materiales_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public $table = 'materiales';
    public $id = 'id';

    //?Agregar un nuevo material a la base de datos
    public function agregar_material($data) {
        return $this->db->insert($this->table, $data);
    }

    //? Obtener los materiales de la base de datos
    public function obtener_materiales() {
        return $this->db->select('id,
        codigo,
        nombre_material,
        cantidad,
        descripcion')
        ->from('materiales')
        ->order_by('nombre_material','asc')
        ->get()
        ->result();
    }

    //! EN USO [Home]
    /**
     * ? Funcion para traer un material en especifico
     * @param int $id es el id del material que se esta obteniendo
     * @return mixed
     */
    public function traer_material($id) {
        return $this->db->select('*')
        ->from($this->table)
        ->where('id', $id)
        ->get()
        ->row();
    }

    //! EN USO [Home]
    /**
     * ? Funcion para editar un material en especifico
     * @param int $id es el id del material que se va a modificar
     * @param object $datos son los datos que se van a modificar
     * @return mixed
     */
    public function editar_material ($id, $datos) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $datos);
        return $this->db->affected_rows();
    }
}
?>