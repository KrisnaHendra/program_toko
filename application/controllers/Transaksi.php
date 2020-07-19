<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model', 'barang');
        $this->load->model('Transaksi_model', 'trans');
        $data = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        if (!isset($data)) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['data'] = $this->db->get_where('user', ['nama' => $this->session->userdata('nama')])->row_array();
        $data['title'] = 'Transaksi';
        $data['barang'] = $this->barang->view();
        $data['sum'] = $this->sum();
        $data['avg'] = $this->avg();
        $data['konten'] = 'admin/transaksi';
        $this->load->view('admin/template', $data);
    }

    public function history()
    {
        $data['data'] = $this->db->get_where('user', ['nama' => $this->session->userdata('nama')])->row_array();
        $data['transaksi'] = $this->trans->index();
        $data['sum'] = $this->sum();
        $data['avg'] = $this->avg();
        $data['title'] = 'History Transaksi';
        $data['konten'] = 'admin/history_transaksi';
        $data['tot_transaksi'] = $this->db->query("SELECT COUNT(id_transaksi) as total FROM transaksi")->result_array();
        $data['tot_pendapatan'] = $this->db->query("SELECT SUM(total) as pendapatan FROM transaksi")->result_array();
        // $data['tot_transaksi'] = $this->db->query("SELECT COUNT(id) as total FROM transaksi")->result_array();
        $this->load->view('admin/template', $data);
    }

    public function hapus_history()
    {
        $this->trans->hapus_history();
        $this->session->set_flashdata('notif', 'Berhasil');
        redirect('transaksi/history');
    }

    public function add_cart($id)
    {
        $cek_stok = $this->trans->cek($id);
        if ($cek_stok == 0) {
            $this->session->set_flashdata('notif', '<div class="alert alert-info d-flex align-items-center mt-3" role="alert">
			<div class="flex-00-auto">
				<i class="fa fa-fw fa-info-circle"></i>
			</div>
			<div class="flex-fill ml-3">
				<p class="mb-0 font-weight-bold">STOK BARANG HABIS !</p>
			</div>
		</div>');
            redirect('transaksi', 'refresh');
        }
        $barang = $this->barang->find($id);
        $data = array(
            'id' => $barang->id_barang,
            'name' => $barang->nama_barang,
            'qty' => 1,
            'price' => $barang->harga_jual,
            'keterangan' => $barang->keterangan,
        );
        $this->cart->insert($data);
        redirect('transaksi', 'refresh');
    }
    public function add_cart_do($id)
    {
        $cek_stok = $this->trans->cek($id);
        if ($cek_stok == 0) {
            $this->session->set_flashdata('notif', '<div class="alert alert-info d-flex align-items-center mt-3" role="alert">
			<div class="flex-00-auto">
				<i class="fa fa-fw fa-info-circle"></i>
			</div>
			<div class="flex-fill ml-3">
				<p class="mb-0 font-weight-bold">STOK BARANG HABIS !</p>
			</div>
		</div>');
            redirect('transaksi', 'refresh');
        }
        $barang = $this->barang->find($id);
        $data = array(
            'id' => $barang->id_barang,
            'name' => $barang->nama_barang,
            'qty' => 1,
            'price' => $barang->harga_do,
            'keterangan' => $barang->keterangan,
        );
        $this->cart->insert($data);
        redirect('transaksi/transaksi_do', 'refresh');
    }

    public function hapus_cart($id)
    {
        $data = array(
            'rowid' => $id,
            'qty' => 0,
        );
        $this->cart->update($data);
        redirect('transaksi');
    }

    public function hapus_cart_do($id)
    {
        $data = array(
            'rowid' => $id,
            'qty' => 0,
        );
        $this->cart->update($data);
        redirect('transaksi/transaksi_do');
    }

    public function update_cart()
    {
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty' => $this->input->post('qty'),
        );
        $this->cart->update($data);
        redirect('transaksi');
    }

    public function hapus()
    {
        $this->cart->destroy();
        redirect('transaksi');
    }
    public function hapus_do()
    {
        $this->cart->destroy();
        redirect('transaksi/transaksi_do');
    }

    function print() {
        $this->load->view('admin/struk');
    }

    public function simpan()
    {
        $data = [
            'kode' => $this->input->post('kode'),
            'nama_kasir' => $this->session->userdata('nama'),
            'nama_pembeli' => 'Shalsabella',
            'total' => $this->cart->total(),
            'tanggal' => time(),
        ];
        $this->db->insert('transaksi', $data);
        redirect('transaksi');
    }

    public function save_trans()
    {
        if ($this->input->post('update')) {
            for ($i = 0; $i < count($this->input->post('rowid')); $i++) {
                $data = array(
                    'rowid' => $this->input->post('rowid')[$i],
                    'qty' => $this->input->post('qty')[$i],
                );
                $this->cart->update($data);
            }
            redirect('transaksi');
        } elseif ($this->input->post('bayar')) {
            //    $this->form_validation->set_rules('nama_kasir', 'Kasir', 'trim|required');
            //    $this->form_validation->set_rules('nama_pembeli', 'Nama Pembeli', 'trim|required');
            $kode = $this->input->post('kode');
            $pembeli = $this->input->post('pembeli');
            $catatan = $this->input->post('catatan');

            //    if ($this->form_validation->run() == TRUE) {
            $id = $this->trans->simpan_cart_db($kode, $pembeli, $catatan);
            if ($id) {
                $data['kode'] = $this->input->post('kode');
                $data['pembeli'] = $this->input->post('pembeli');
                $data['bayar'] = $this->input->post('jumlah_bayar');
                $this->load->view('admin/struk', $data, false);
            }

            //        } else {
            //            $this->session->set_flashdata('notif', 'Nama Kasir atau Pembeli harus diisi!!!');
            //            redirect('transaksi');
            //        }
        }
    }
    public function save_trans_do()
    {
        if ($this->input->post('update')) {
            for ($i = 0; $i < count($this->input->post('rowid')); $i++) {
                $data = array(
                    'rowid' => $this->input->post('rowid')[$i],
                    'qty' => $this->input->post('qty')[$i],
                );
                // print_r($data);die;
                $this->cart->update($data);
            }
            redirect('transaksi/transaksi_do');
        } elseif ($this->input->post('bayar')) {

            $kode = $this->input->post('kode');
            $pembeli = $this->input->post('pembeli');
            $catatan = $this->input->post('catatan');

            $id = $this->trans->simpan_cart_db($kode, $pembeli, $catatan);
            if ($id) {
                $data['kode'] = $this->input->post('kode');
                $data['pembeli'] = $this->input->post('pembeli');
                $data['catatan'] = $this->input->post('catatan');
                $this->load->view('admin/struk_do', $data, false);
            }

        }
    }

    public function selesai()
    {
        $this->cart->destroy();
        redirect('transaksi');
    }

    public function cek_transaksi($id)
    {
        $this->trans->cek_transaksi($id);
    }

    public function sum()
    {
        $this->db->select('SUM(total) as total');
        $this->db->from('transaksi');
        return $this->db->get()->row()->total;
    }
    public function avg()
    {
        $this->db->select('AVG(total) as total');
        $this->db->from('transaksi');
        return $this->db->get()->row()->total;
    }
// TRANSAKSI DO
    public function transaksi_do()
    {
        $data['data'] = $this->db->get_where('user', ['nama' => $this->session->userdata('nama')])->row_array();
        $data['title'] = 'Transaksi DO';
        $data['barang'] = $this->barang->view();
        $data['sum'] = $this->sum();
        $data['avg'] = $this->avg();
        $data['konten'] = 'admin/transaksi_do';
        $this->load->view('admin/template', $data);
    }
// END DO

    public function telur()
    {
        $data['data'] = $this->db->get_where('user', ['nama' => $this->session->userdata('nama')])->row_array();
        $data['title'] = 'Transaksi Telur';
        $data['sum'] = $this->sum();
        $data['avg'] = $this->avg();
        $data['konten'] = 'admin/kasir_telur';
        $this->load->view('admin/template', $data);
    }


    public function trans_otomatis(){
      $data['data'] = $this->db->get_where('user', ['nama' => $this->session->userdata('nama')])->row_array();
      $data['title'] = 'Transaction';
      $data['sum'] = $this->sum();
      $data['avg'] = $this->avg();
      $data['konten'] = 'admin/transaksi_otomatis';
      // Olah Transaksi Barcode
      $data['view'] = $this->db->query("SELECT * FROM cart c LEFT JOIN barang b ON b.kode = c.kode GROUP BY c.kode")->result_array();
      $data['total'] = $this->db->query("SELECT SUM(subtotal) as total FROM cart")->result_array();
      $this->load->view('admin/template',$data);
    }

    public function transaksiBarcode(){
      $barcode = $this->db->query("SELECT kode FROM barang")->result_array();
      $listKode = [];
      foreach ($barcode as $key => $value) {
        $listKode[$key] = $value['kode'];
      }
      $array = implode(',',$listKode);
      // $this->form_validation->set_rules('kode','Kode','trim|required|in_list[01]');
      $this->form_validation->set_rules('kode','Kode','trim|required|numeric|is_unique[cart.kode]|in_list['.$array.']',[
        'numeric' => 'Kode Barcode Salah!',
        'is_unique' => 'Barang sudah masuk dalam keranjang',
        'in_list' => 'Kode Barcode Tidak Terdaftar!'
      ]);

      if($this->form_validation->run()==FALSE){
        $this->session->set_flashdata('swal','swal("Kode Barcode Salah!");');
        $this->trans_otomatis();
      }else{
        // print_r($this->input->post('kode'));die;
        $kode = $this->input->post('kode');
        $query = $this->db->query("SELECT * FROM barang WHERE kode = ".$kode."")->result_array();
        $getData = [];
        foreach($query as $key => $value){
          $getData['harga'] = $value['harga_jual'];
        }
        $data = [
          'kode' => $this->input->post('kode'),
          'harga' => $getData['harga'],
          'jumlah' => 1,
          'subtotal' => $getData['harga']
        ];
        $this->db->insert('cart',$data);
        redirect('transaksi/trans_otomatis');
      }
    }

    public function deleteCartBarcode($id){
      $this->db->query("DELETE FROM cart WHERE id = '$id'");
      redirect('transaksi/trans_otomatis');
    }

    public function deleteAllCart(){
      $this->db->query("TRUNCATE TABLE cart");
      redirect('transaksi/trans_otomatis');
    }

    public function saveCartBarcode(){
      if ($this->input->post('update')) {
          foreach($this->input->post('id') as $key =>$value){
            $data[] = [
              'id' => $this->input->post('id')[$key],
              'harga' => $this->input->post('harga')[$key],
              'jumlah' => $this->input->post('jumlah')[$key],
              'subtotal' => ($this->input->post('harga')[$key])*$this->input->post('jumlah')[$key]
            ];
          }
          $this->db->update_batch('cart',$data,'id');
          redirect('transaksi/trans_otomatis');
      } elseif ($this->input->post('print')) {
          if($this->db->count_all('cart')>0){
          $kode = $this->input->post('kode');
          $pembeli = $this->input->post('pembeli');
          $catatan = $this->input->post('catatan');
          // print_r($kode);die;
          $id = $this->trans->simpan_cart_barcode($kode, $pembeli);
          $data['kode'] = $this->input->post('kode');
          $data['pembeli'] = $this->input->post('pembeli');
          $data['catatan'] = $this->input->post('catatan');
          $data['data'] = $this->trans->dataCartBarcode();
          $data['allTotal'] = $this->db->query("SELECT SUM(subtotal) as total FROM cart")->result_array();
          $this->load->view('admin/strukBarcode', $data, false);
        }else{
          $this->session->set_flashdata('notif','<div class="alert alert-danger d-flex align-items-center justify-content-between" role="alert">
                                        <div class="flex-fill mr-3">
                                            <p class="mb-0"><b>Error! </b> Keranjang masih kosong</p>
                                        </div>
                                        <div class="flex-00-auto">
                                            <i class="fa fa-fw fa-times-circle"></i>
                                        </div>
                                    </div>');
          redirect('transaksi/trans_otomatis');
        }
      }
    }

    public function backFromStruk(){
      $this->trans->backFromStruk();
      redirect('transaksi/trans_otomatis');
    }
// end
}
