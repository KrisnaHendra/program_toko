<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require './application/third_party/phpoffice/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model', 'barang');
        $data = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        if (!isset($data)) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['data'] = $this->db->get_where('user', ['nama' => $this->session->userdata('nama')])->row_array();
        $data['title'] = 'Data Barang';
        $data['barang'] = $this->barang->view();
        $data['sum'] = $this->sum();
        $data['avg'] = $this->avg();
        $data['konten'] = 'admin/barang';
        $this->load->view('admin/template', $data);
    }

    public function tambah_barang()
    {
        $this->form_validation->set_rules('kode', 'Kode', 'trim|required|is_unique[barang.kode]', [
            'is_unique' => 'Kode Barang sudah ada!',
        ]);
        if ($this->form_validation->run() == false) {
            $data['data'] = $this->db->get_where('user', ['nama' => $this->session->userdata('nama')])->row_array();
            $data['title'] = 'Data Barang';
            $data['barang'] = $this->barang->view();
            $data['konten'] = 'admin/barang';
            $this->load->view('admin/template', $data);
        } else {
            $this->barang->tambah();
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<i class="fa fa-check-circle"></i> Data barang baru telah ditambahkan!
			</div>');
            redirect('barang', 'refresh');
        }
    }

    public function hapus_barang($id)
    {
        $this->barang->hapus($id);
        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<i class="fa fa-check-circle"></i> Data barang telah dihapus!
		</div>');
        redirect('barang', 'refresh');
    }

    public function update_barang()
    {
        $id_barang = $this->input->post('id_barang');
        $kode = $this->input->post('kode');
        $nama_barang = $this->input->post('nama');
        $keterangan = $this->input->post('keterangan');
        $harga = $this->input->post('harga');
        $harga_do = $this->input->post('harga_do');
        $stok = $this->input->post('stok');
        $updated = time();
        $data['barang'] = $this->barang->update($id_barang, $kode, $nama_barang, $keterangan, $harga, $harga_do, $stok, $updated);
        $this->session->set_flashdata('notif', '<div class="alert alert-primary alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<i class="fa fa-check-circle"></i> Data barang telah diubah!
		</div>');
        redirect('barang', 'refresh');
    }

    public function print_barang()
    {
        $data['barang'] = $this->barang->view();
        $this->load->view('admin/print_barang', $data);
    }

    public function excel_barang()
    {
        $data['barang'] = $this->barang->view();
        $this->load->view('admin/excel_barang', $data);
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

    public function export()
    {
        $semua_pengguna = $this->barang->export()->result();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama Barang')
            ->setCellValue('C1', 'Kode')
            ->setCellValue('D1', 'Keterangan')
            ->setCellValue('E1', 'Stok')
            ->setCellValue('F1', 'Harga Jual')
            ->setCellValue('G1', 'Harga DO')
            ->setCellValue('H1', 'Updated');

        $kolom = 2;
        $nomor = 1;
        foreach ($semua_pengguna as $pengguna) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, $pengguna->nama_barang)
                ->setCellValue('C' . $kolom, $pengguna->kode)
                ->setCellValue('D' . $kolom, $pengguna->keterangan)
                ->setCellValue('E' . $kolom, $pengguna->stok)
                ->setCellValue('F' . $kolom, number_format($pengguna->harga_jual))
                ->setCellValue('G' . $kolom, number_format($pengguna->harga_do))
                ->setCellValue('H' . $kolom, date('d F Y', $pengguna->updated));

            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Barang.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
