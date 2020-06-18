<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

public function __construct()
{
	parent::__construct();
	$this->load->model('User_model','user');
	$data=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
	if(!isset($data)){
		redirect('auth');
	}
	
}

	public function index()
	{
		$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='Dashboard';
        $data['konten']='admin/dashboard';
        $data['sum']=$this->sum();
        $data['avg']=$this->avg();
		$this->load->view('admin/template',$data);
	}

	public function data_user(){
		$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='Data User';
		$data['sum']=$this->sum();
		$data['avg']=$this->avg();
		$data['user']=$this->user->show_user();
		$data['admin']=$this->user->show_admin();
		$data['konten']='admin/data_user';
		$this->load->view('admin/template', $data);
	}
	
	public function delete_user($id){
		$this->user->delete_user($id);
		$this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<i class="fa fa-trash"></i> User telah dihapus
		</div>');
		redirect('admin/data_user');
	}

	public function add_user(){
		
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|is_unique[user.nama]',[
			'is_unique' => 'Nama sudah terdaftar !'
		]);
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]',[
			'is_unique' => 'Username sudah terdaftar !'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]',[
			'min_length' => 'Password terlalu pendek',
			'matches' => 'Password tidak sama'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|matches[password1]');
		if($this->form_validation->run()==FALSE){
			$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
			$data['title']='Data User';
			$data['user']=$this->user->show_user();
			$data['admin']=$this->user->show_admin();
			$data['konten']='admin/data_user';
			$this->load->view('admin/template', $data);
		}else{
			$this->user->add_user();
			$this->session->set_flashdata('notif', '<div class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<i class="fa fa-check"></i> User baru telah ditambahkan
			</div>');
			redirect('admin/data_user');
		}
	}
	

	public function note(){
		$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='Catatan';
		$data['sum']=$this->sum();
		$data['avg']=$this->avg();
		$data['konten']='admin/note';
		$this->load->view('admin/template',$data);
	}

	public function lihat_catatan(){
		$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['note']=$this->user->lihat_catatan();
		$data['sum']=$this->sum();
		$data['avg']=$this->avg();
		$data['title']='Lihat Catatan';
		$data['konten']='admin/lihat_catatan';
		$this->load->view('admin/template',$data);
	}

	public function add_note(){
		$data=[
			'isi' => $this->input->post('catatan'),
			'created_at' => time()
		];
		$this->db->insert('catatan',$data);
		$this->session->set_flashdata('notif','');
		redirect('admin/note');
	}

	public function delete_catatan($id){
		$this->user->delete_catatan($id);
		$this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<i class="fa fa-trash"></i> Catatan telah dihapus
		</div>');
		redirect('admin/lihat_catatan');
	}

	public function sum(){
		$this->db->select('SUM(total) as total');
		$this->db->from('transaksi');
		return $this->db->get()->row()->total;
	}

	public function avg(){
		$this->db->select('AVG(total) as total');
		$this->db->from('transaksi');
		return $this->db->get()->row()->total;
	}

	public function profile(){
		$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='Profile';
		$data['sum']=$this->sum();
		$data['avg']=$this->avg();
		$data['konten']='admin/profile';
		$this->load->view('admin/template', $data);
	}
}
