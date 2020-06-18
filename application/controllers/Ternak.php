<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ternak extends CI_Controller {

    public function __construct()
{
	parent::__construct();
	$this->load->model('Ternak_model','ternak');
	$this->load->model('Barang_model','barang');
	$data=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
	if(!isset($data)){
		redirect('auth');
	}
	
}

    public function data_pelanggan()
    {
        $data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='Data Pelanggan';
        $data['konten']='admin/data_pelanggan';
        $data['sum']=$this->sum();
        $data['avg']=$this->avg();
        $data['pelanggan']=$this->ternak->pelanggan();
		$this->load->view('admin/template',$data);
    }

    public function add_pelanggan(){
       $this->ternak->tambah();
       $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<i class="fa fa-user"></i> Data Pelanggan telah ditambahkan!
		</div>');
       redirect('ternak/data_pelanggan');
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
    
    public function delete_pelanggan($id){
		$this->ternak->hapus($id);
		$this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<i class="fa fa-check-circle"></i> Data Pelanggan telah dihapus!
		</div>');
		redirect('ternak/data_pelanggan','refresh');
    }
    
    public function update_pelanggan(){
        $id_pelanggan = $this->input->post('id_pelanggan');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $this->ternak->update($id_pelanggan,$nama,$alamat);
        $this->session->set_flashdata('notif', '<div class="alert alert-primary alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<i class="fa fa-check-circle"></i> Data Pelanggan telah diubah!
		</div>');
		redirect('ternak/data_pelanggan');
	}
	
	public function transaksi() {
		$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='Transaksi ternak';
		$data['konten']='admin/transaksi_ternak';
		$data['pelanggan']=$this->ternak->pelanggan();
		$data['barang']=$this->barang->view();
        $data['sum']=$this->sum();
        $data['avg']=$this->avg();
        $data['transaksi']=$this->ternak->transaksi();
		$this->load->view('admin/template',$data);
	}

	public function history_ternak() {
		$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='History Ternak';
        $data['konten']='admin/ternak';
        $data['sum']=$this->sum();
        $data['avg']=$this->avg();
        $data['pelanggan']=$this->ternak->pelanggan();
		$this->load->view('admin/template',$data);
	}

}

/* End of file Ternak.php */
