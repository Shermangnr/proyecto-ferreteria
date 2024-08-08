<?php
class Tipo_identificacion_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public $table = "tipo_identificacion";
    public $table_id = "id";

    public function obtener_tipos() {
        return $this->db->select("*")
        ->from($this->table)
        ->get()
        ->result();
    }
}