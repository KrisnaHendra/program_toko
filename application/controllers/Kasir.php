<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Barang_model','barang');
		$this->load->model('Transaksi_model','trans');
		$this->load->model('Kasir_model','kasir');
		$data=$this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
		if(!isset($data)){
		redirect('auth');
	}
    }
    

    public function index()
    {
        $data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['barang']=$this->barang->view();
		$data['sum']=$this->sum();
		$data['avg']=$this->avg();
        $data['title']='Kasir';
        $data['konten']='kasir/index';
        $this->load->view('kasir/template', $data);
    }

    public function transaksi(){
        $data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='Transaksi';
		$data['barang']=$this->barang->view();
		$data['sum']=$this->sum();
		$data['avg']=$this->avg();
		$data['konten']='kasir/transaksi';
        $this->load->view('kasir/template', $data);
    }
    public function transaksi_do(){
        $data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['title']='Transaksi DO';
		$data['barang']=$this->barang->view();
		$data['sum']=$this->sum();
		$data['avg']=$this->avg();
		$data['konten']='kasir/transaksi_do';
        $this->load->view('kasir/template', $data);
    }
// BINGUNGGG
public function add_cart($id){
	$cek_stok=$this->trans->cek($id);
	if ( $cek_stok == 0){
		$this->session->set_flashdata('notif', '<div class="alert alert-info d-flex align-items-center mt-3" role="alert">
		<div class="flex-00-auto">
			<i class="fa fa-fw fa-info-circle"></i>
		</div>
		<div class="flex-fill ml-3">
			<p class="mb-0 font-weight-bold">STOK BARANG HABIS !</p>
		</div>
	</div>');
		redirect('kasir/transaksi','refresh');
	}
	$barang = $this->barang->find($id);
	$data = array(
		'id'      		=> $barang->id_barang,
		'name'    		=> $barang->nama_barang,
		'qty'     		=> 1,
		'price'   		=> $barang->harga_jual,
		'keterangan'    => $barang->keterangan
	);
	$this->cart->insert($data);
	redirect('kasir/transaksi','refresh');
}
public function add_cart_do($id){
	$cek_stok=$this->trans->cek($id);
	if ( $cek_stok == 0){
		$this->session->set_flashdata('notif', '<div class="alert alert-info d-flex align-items-center mt-3" role="alert">
		<div class="flex-00-auto">
			<i class="fa fa-fw fa-info-circle"></i>
		</div>
		<div class="flex-fill ml-3">
			<p class="mb-0 font-weight-bold">STOK BARANG HABIS !</p>
		</div>
	</div>');
		redirect('kasir/transaksi','refresh');
	}
	$barang = $this->barang->find($id);
	$data = array(
		'id'      		=> $barang->id_barang,
		'name'    		=> $barang->nama_barang,
		'qty'     		=> 1,
		'price'   		=> $barang->harga_do,
		'keterangan'    => $barang->keterangan
	);
	$this->cart->insert($data);
	redirect('kasir/transaksi_do','refresh');
}

	public function hapus_cart($id)
	{
		$data=array(
				'rowid'=>$id,
				'qty'=>0
			);
		$this->cart->update($data);
		redirect('kasir/transaksi');
	}
	public function hapus_cart_do($id)
	{
		$data=array(
				'rowid'=>$id,
				'qty'=>0
			);
		$this->cart->update($data);
		redirect('kasir/transaksi_do');
	}

	public function update_cart(){
		$data=array(
			'rowid'=>$this->input->post('rowid'),
			'qty'=>$this->input->post('qty')
		);
	$this->cart->update($data);
	redirect('kasir/transaksi');
	}

	public function hapus(){
		$this->cart->destroy();
		redirect('kasir/transaksi');
	}
	public function hapus_do(){
		$this->cart->destroy();
		redirect('kasir/transaksi_do');
	}

	public function print(){
		$this->load->view('kasir/struk');
	}

	public function selesai(){
		$this->cart->destroy();
		redirect('kasir/transaksi');
	}
	public function selesai_do(){
		$this->cart->destroy();
		redirect('kasir/transaksi');
	}

	public function simpan_transaksi(){
		if ($this->input->post('update')) {
			for ($i=0; $i < count($this->input->post('rowid')); $i++) { 
				$data=array(
						'rowid' => $this->input->post('rowid')[$i],
						'qty' => $this->input->post('qty')[$i]
					);
				$this->cart->update($data);
			}
			redirect('kasir/transaksi');
	   } elseif ($this->input->post('bayar')) {
		//    $this->form_validation->set_rules('nama_kasir', 'Kasir', 'trim|required');
		//    $this->form_validation->set_rules('nama_pembeli', 'Nama Pembeli', 'trim|required');
			$kode = $this->input->post('kode');
			$pembeli = $this->input->post('pembeli');
			
		//    if ($this->form_validation->run() == TRUE) {
			   $id=$this->trans->simpan_cart_db($kode,$pembeli);
			   if ($id) {
				$data['kode'] = $this->input->post('kode');
				$data['pembeli'] = $this->input->post('pembeli');
				$data['bayar'] = $this->input->post('jumlah_bayar');
				$this->load->view('kasir/struk', $data, FALSE);
			   }
			
		//    } else {
		// 	   $this->session->set_flashdata('notif', 'Nama Kasir atau Pembeli harus diisi!!!');
		// 	   redirect('kasir/transaksi');
		//    }
	   }
	}
	public function simpan_transaksi_do(){
		if ($this->input->post('update')) {
			for ($i=0; $i < count($this->input->post('rowid')); $i++) { 
				$data=array(
						'rowid' => $this->input->post('rowid')[$i],
						'qty' => $this->input->post('qty')[$i]
					);
				$this->cart->update($data);
			}
			redirect('kasir/transaksi_do');
	   } elseif ($this->input->post('bayar')) {
	
			$kode = $this->input->post('kode');
			$pembeli = $this->input->post('pembeli');
			   $id=$this->trans->simpan_cart_db($kode,$pembeli);
			   if ($id) {
				$data['kode'] = $this->input->post('kode');
				$data['pembeli'] = $this->input->post('pembeli');
			
				$this->load->view('kasir/struk_do', $data, FALSE);
			   }
		
	   }
	}
// HABIS

	public function history(){
		$data['data']=$this->db->get_where('user',['nama'=>$this->session->userdata('nama')])->row_array();
		$data['history']=$this->kasir->history_transaksi();
		$data['sum']=$this->sum();
		$data['avg']=$this->avg();
		$data['title']='History Transaksi';
		$data['konten']='kasir/history';
		$this->load->view('kasir/template',$data);
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
		$data['konten']='kasir/profile';
		$this->load->view('kasir/template', $data);
	}
	

}

/* End of file Controllername.php */
