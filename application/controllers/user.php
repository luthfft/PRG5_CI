<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class user extends RestController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    // show data user
    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $user = $this->db->get('users')->result();
        } else {
            $this->db->where('id', $id);
            $user = $this->db->get('users')->result();
        }
        $this->response($user, 200);
    }

    // insert new data to user
    function index_post()
    {
        $data = array(
            'username'           => $this->post('username'),
            'user_email'     => $this->post('user_email'),
            'user_status'     => $this->post('user_status'),
        );
        $insert = $this->db->insert('users', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data user
    function index_put()
    {
        $id = $this->put('user_id');
        $data = array(
            'username'           => $this->put('username'),
            'user_email'     => $this->put('user_email'),
            'user_status'     => $this->put('user_status'),
        );
        $this->db->where('user_id', $id);
        $update = $this->db->update('users', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete user
    function index_delete()
    {
        $id = $this->delete('user_id');
        $this->db->where('user_id', $id);
        $delete = $this->db->delete('users');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
