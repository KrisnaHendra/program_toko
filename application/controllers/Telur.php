<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telur extends CI_Controller {

    public function __construct()
{
	parent::__construct();
	$this->load->model('Barang_model','barang');
	$this->load->model('Transaksi_model','trans');
	$data=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
	if(!isset($data)){
		redirect('auth');
	}
}

	public function index()
	{
		$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='Transaksi Telur';
		$data['sum']=$this->sum();
		$data['avg']=$this->avg();
		$data['konten']='admin/kasir_telur';
        $this->load->view('admin/template',$data); 
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
    
    public function transaksi_telur(){
			$harga_telur = $this->input->post('harga_telur');
			$jumlah_telur = $this->input->post('jumlah_telur');
			$kurang_uang = $this->input->post('kurang_uang');
			$kode = $this->input->post('kode');
			$pembeli = $this->input->post('pembeli');
			$data['harga_telur'] = $this->input->post('harga_telur');
			$data['jumlah_telur'] = $this->input->post('jumlah_telur');
			$data['kurang_uang'] = $this->input->post('kurang_uang');
			$data['catatan'] = $this->input->post('catatan');
			$data['kode'] = $this->input->post('kode');
			$data['pembeli'] = $this->input->post('pembeli');
            $id=$this->trans->simpan_telur($kode,$pembeli,$harga_telur,$jumlah_telur,$kurang_uang);
			$this->load->view('admin/struk_telur', $data, FALSE);
	   }
    
}
