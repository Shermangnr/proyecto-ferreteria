<?php
class Login_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public $table = "usuarios";  
    public $table_id = "id";     

    public function login($username, $password) {
        $this->db->where('nombre_usuario', $username);
        $query = $this->db->get($this->table);

        if ($query->num_rows() == 1) {
            $row = $query->row();
            if (password_verify($password, $row->contrasena)) {
                return $row;
            }
        } 
        return false;
    }
}
?>
