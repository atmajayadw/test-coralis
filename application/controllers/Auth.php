<?php

defined('BASEPATH') or exit ('No direct script access allowed');

class Auth extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index(){

        if(!$this->session->userdata('email')){

            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
    
            if($this->form_validation->run() == FALSE){

                $data['title'] = "Login" ;
                $this->load->view('templates/header', $data);
                $this->load->view('auth/index');
                $this->load->view('templates/footer');

            } else{
                $this->_login();
            }

        } else {
            redirect('user');
        }
                
    }

    private function _login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if($user){
            if(password_verify($password, $user['password'])){
                    $data = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'is_login' => 'logged_in'
                    ];

                    $this->session->set_userdata($data);
                    redirect('user');
            } else {
                $this->session->set_flashdata('error', 
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Wrong Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('auth');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Email is not registered!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }
    }
    
    public function registration(){

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'This Email is Already Registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',[
            'matches' => 'Password not match',
            'min_length' => 'Password too short'
        ]);
        
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('hintQuestion', 'hintQuestion', 'required|trim');
        $this->form_validation->set_rules('hintAnswer', 'hintAnswer', 'required|trim');


        if($this->form_validation->run() == FALSE){
            $data['title'] = "User Registration" ;
            $this->load->view('templates/header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/footer');
        } else {
            $name = htmlspecialchars($this->input->post('name',true));
            $email = htmlspecialchars($this->input->post('email',true));
            $password = password_hash($this->input->post('password1'),PASSWORD_DEFAULT);
            $hint_question = htmlspecialchars($this->input->post('hintQuestion',true));
            $hint_answer = htmlspecialchars($this->input->post('hintAnswer',true));
            $profile_picture = $this->upload();

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'hint_question' => $hint_question,
                'hint_answer' => $hint_answer,
                'profile_picture' => $profile_picture
            ];

            $this->User_model->createData($data); 
            $this->session->set_flashdata('message', 'created!');
            redirect('auth');
            
        }
    }

    public function upload(){
        $filename = $_FILES['profilePicture']['name'];
        $photoExtension = explode('.', $filename);
        $photoExtension = strtolower(end($photoExtension));

        $newFileName = uniqid();
        $newFileName .= '.';
        $newFileName .= $photoExtension;


        $config['upload_path']          = './uploads';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $newFileName;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profilePicture')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";

    }

    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('is_login');

        $this->session->set_flashdata('message', 'Logout!');
        redirect('auth');
    }

    public function forgot(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('is_login');
        $this->session->unset_userdata('hint_question');
        $this->session->unset_userdata('hint_answer');
        $this->session->unset_userdata('verification');


        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if($this->form_validation->run() == FALSE){
            $data['title'] = "Forgot" ;
            $this->load->view('templates/header', $data);
            $this->load->view('auth/forgot');
            $this->load->view('templates/footer');
        } else {

            $email = $this->input->post('email');
    
            $user = $this->db->get_where('users', ['email' => $email])->row_array();
    
            if($user){
                $data= [
                    'user_email' => $user['email'],
                    'hint_question' => $user['hint_question'],
                    'hint_answer' => $user['hint_answer'],
                    'verification' => 'pending'
                ];
                $this->session->set_userdata($data);
                redirect('auth/verify');
                
            }else{
                $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email is not registered!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('auth/forgot');
            }

        }
    }

    public function verify(){

        if($this->session->userdata('is_login')){
            redirect('user');
        } else if ($this->session->userdata('verification') !== "pending"){
            $this->session->unset_userdata('verification');
            redirect('auth/forgot');
        } 
        else if(!$this->session->userdata('hint_question')){
            redirect('auth/forgot');
        } 
        else {        
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('is_login');

            $this->form_validation->set_rules('hintAnswer', 'hintAnswer', 'required|trim');
    
            if($this->form_validation->run() == FALSE){
                    $data['title'] = "Verify" ;
                    $this->load->view('templates/header', $data);
                    $this->load->view('auth/verify', $data);
                    $this->load->view('templates/footer');
            } else {
                    $hint_answer = $this->session->userdata('hint_answer');
                    $user_answer = $this->input->post('hintAnswer');
    
                    if($user_answer === $hint_answer){
                        $data = [
                            'verification' => 'valid' 
                        ];
                        $this->session->set_userdata($data);
                        redirect('auth/changePassword');
                    } else {
                        $this->session->set_flashdata('error', 
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Wrong Answer!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                        redirect('auth/verify');
                    }
                }
            }
    }

    public function changePassword(){

        if($this->session->userdata('verification') !== "valid"){
            redirect('auth/forgot');    
        } else {
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',[
            'matches' => 'Password not match',
            'min_length' => 'Password too short']);

            $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|matches[password1]');

            if($this->form_validation->run() == FALSE){
                $data['title'] = "Change Password" ;
                $this->load->view('templates/header', $data);
                $this->load->view('auth/changePassword', $data);
                $this->load->view('templates/footer');
            } else {
                $email = $this->session->userdata('user_email');
                $password = password_hash($this->input->post('password1'),PASSWORD_DEFAULT);
        
                $user = $this->db->get_where('users', ['email' => $email])->row_array();

                $data = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' =>  $user['email'],
                    'password' => $password,
                    'hint_question' =>  $user['hint_question'],
                    'hint_answer' =>  $user['hint_answer'],
                    'profile_picture' =>  $user['profile_picture']
                ];
                
                $this->db->where('email', $email);
                $this->db->update('users', $data);

                $this->session->set_flashdata('message', 'Success change password! Please login');
                redirect('auth');
            }
        }        
    }
}
