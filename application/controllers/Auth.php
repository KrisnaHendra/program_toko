<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');

        if($this->form_validation->run()==FALSE){
            $this->load->view('auth/login');
        }else{
            $this->proses_login();
        }
    }

    public function proses_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user',['username'=>$username])->row_array();

        if($user){
            if(password_verify($password,$user['password'])){
                $data = [
                    'logged_in' => TRUE,
                    'nama' => $user['nama'],
                    'username' => $user['username'],
                    'password' => $user['password']
                ];
                $this->session->set_userdata($data);

                if($user['id_status']==1){
                    redirect('admin');
                }else{
                    redirect('kasir/transaksi','refresh');
                }
            } $this->session->set_flashdata('notif','<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-times-circle"></i> Password Salah!
            </div>');
            redirect('auth');
        }else{
            $this->session->set_flashdata('notif','<div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-times-circle"></i> Akun Tidak Ditemukan!
            </div>');
            redirect('auth');
        }
    }

    public function register(){
        $this->form_validation->set_rules('nama','Name','trim|required');
        $this->form_validation->set_rules('username','Email','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');

        if($this->form_validation->run()==FALSE){
            $this->load->view('auth/daftar');
        }else{
        $data = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'id_status' => 2,
                'aktif' => 1,
                'created_at' => time()
        ];
        $this->db->insert('user',$data);
        redirect('auth');
    }}

    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('password');
        $this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <i class="fa fa-times-circle"></i> You have been logged out!
        </div>');
        redirect('auth');

}
}
