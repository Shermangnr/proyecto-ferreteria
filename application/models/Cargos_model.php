<?php
class Cargos_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public $table = "cargos";
    public $table_id = "id";

    public function obtener_cargos() {
        return $this->db->select("*")
        ->from($this->table)
        ->get()
        ->result();
    }
}