<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    
    public function __CONSTRUCT() {
        parent::__CONSTRUCT();
        $this->load->model('Barang_model','barang');
    }

	public function index(){
        $this->load->library('mypdf');
        $data['barang']=$this->barang->view();
        $this->mypdf->generate('admin/laporan_pdf',$data);
    }
}
