<?php defined('BASEPATH') or exit('No direct script access allowed');

class materi_security_model extends CI_Model
{
    private $_table = "iot_polman";
    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getByUsernamePassword()
    {
        $post1 = $this->input->post();
        $username = $post1['username'];
        $password = $post1['password'];
        $array = array('username' => $username, 'password' => $password);
        $query = $this->db->get_where($this->_table, $array);
        return $query->row();
    }
}
