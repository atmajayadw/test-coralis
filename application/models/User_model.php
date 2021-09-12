<?php

class User_model extends CI_model{
    public function createData($data){
        $this->db->insert('users', $data);
    }
}