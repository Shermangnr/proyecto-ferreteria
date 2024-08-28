<?php
class Configuraciones_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public $table = "configuraciones";
    public $table_id = "id";

    public function obtener_tipo_factura($id_padre) {
        return $this->db->select("id, nombre")
        ->from($this->table)
        ->where('id_padre', $id_padre)
        ->get()
        ->result();
    }
}