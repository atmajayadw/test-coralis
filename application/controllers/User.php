<?php

defined('BASEPATH') or exit ('No direct script access allowed');

class User extends CI_Controller{

    public function index(){
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        if($this->session->userdata('email')){
            $this->load->view('templates/header', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Please login first!');
            redirect('auth');
        }
    }
}