<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->model('Transaksi_model', 'trans');
      $data = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
      if (!isset($data)) {
          redirect('auth');
      }
  }

	public function index(){
    $data['data'] = $this->db->get_where('user', ['nama' => $this->session->userdata('nama')])->row_array();
    $data['title'] = 'Laporan Penjualan';
    $data['sum'] = $this->sum();
    $data['avg'] = $this->avg();
    $data['barang'] = $this->db->query("SELECT * FROM barang")->result_array();
    $data['transaksi'] = $this->db->query("SELECT * FROM transaksi GROUP BY kode")->result_array();
    $data['konten'] = 'admin/laporan_penjualan';
    $data['listData'] = $this->db->query("SELECT * FROM transaksi WHERE MONTH(tanggal)='00'")->result_array();
    $data['bulan'] = '';
    $data['tahun'] = '';
    $this->load->view('admin/template',$data);
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

    public function getData(){
      $data['data'] = $this->db->get_where('user', ['nama' => $this->session->userdata('nama')])->row_array();
      $data['title'] = 'Laporan Penjualan';
      $data['sum'] = $this->sum();
      $data['avg'] = $this->avg();
      $data['konten'] = 'admin/laporan_penjualan';
      // Search
      $periodeBulan = date("m",strtotime($this->input->get('periode')));
      $periodeTahun = date("Y",strtotime($this->input->get('periode')));
      $jenis = $this->input->get('jenis_transaksi');
      // print_r($jenis);die;
      $data['listData'] = $this->db->query("SELECT * FROM transaksi WHERE MONTH(DATE_FORMAT(FROM_UNIXTIME(tanggal), '%Y-%m-%d'))=".$periodeBulan." AND kode LIKE '%".$jenis."%' GROUP BY kode ORDER BY tanggal ASC")->result_array();
      $data['bulan'] = date("F",strtotime($this->input->get('periode')));
      $data['tahun'] = date("Y",strtotime($this->input->get('periode')));
      $this->load->view('admin/template',$data);
    }

}
