<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public function index()
    {
        $query = $this->db->query(
            "SELECT t.kode as invoice,t.*,d.*,b.* FROM transaksi t JOIN detail_transaksi d ON t.id_transaksi=d.id_transaksi JOIN barang b ON b.id_barang = d.id_barang GROUP BY t.kode, d.id_barang ORDER BY tanggal DESC"
        )->result_array();
        $listHistory = [];
        foreach ($query as $k => $v) {
            $listHistory[$v['invoice']]['invoice'] = $v['invoice'];
            $listHistory[$v['invoice']]['id_transaksi'] = $v['id_transaksi'];
            $listHistory[$v['invoice']]['tanggal'] = $v['tanggal'];
            $listHistory[$v['invoice']]['nama_kasir'] = $v['nama_kasir'];
            $listHistory[$v['invoice']]['nama_pembeli'] = $v['nama_pembeli'];
            $listHistory[$v['invoice']]['total'] = $v['total'];
            $listHistory[$v['invoice']]['detail'][] = [
                'barang' => $v['nama_barang'],
                'jumlah' => $v['jumlah'],
            ];

        }
        // TES
        // echo "<pre>";
        // print_r($listHistory);die;
        // END TES
        return $listHistory;
    }

    public function hapus_history()
    {
        $query = $this->db->query("TRUNCATE TABLE transaksi");
        return $query;
    }

    public function simpan_cart_db($kode, $pembeli)
    {
        $object = array(
            'kode' => $kode,
            'nama_kasir' => $this->session->userdata('nama'),
            'nama_pembeli' => $pembeli,
            'total' => $this->cart->total(),
            'tanggal' => time(),
        );
        $this->db->insert('transaksi', $object);

        $tm_nota = $this->db->order_by('id_transaksi', 'desc')
            ->where('nama_kasir', $this->input->post('nama_kasir'))
            ->limit(1)
            ->get('transaksi')
            ->row();
        for ($i = 0; $i < count($this->input->post('rowid')); $i++) {
            $hasil[] = array(
                'id_transaksi' => $tm_nota->id_transaksi,
                'id_barang' => $this->input->post('id_barang')[$i],
                'jumlah' => $this->input->post('qty')[$i],
            );
        }
        $proses = $this->db->insert_batch('detail_transaksi', $hasil);
        if ($proses) {
            return $tm_nota->id_transaksi;
        } else {
            return 0;

        }
    }

    public function cek($id)
    {
        $cek_stok = $this->db->where('id_barang', $id)->get('barang')->row()->stok;
        if ($cek_stok == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public function cek_transaksi()
    {
        $query = $this->db->query("
		SELECT * FROM transaksi t join detail_transaksi d ON t.id_transaksi = d.id_transaksi join barang b on d.id_barang = d.id_barang WHERE t.id_transaksi=1
		");
        return $query;
    }

    public function simpan_telur($kode, $pembeli, $harga_telur, $jumlah_telur, $kurang_uang)
    {
        $telur = [
            'kode' => $kode,
            'nama_kasir' => $this->session->userdata('nama'),
            'nama_pembeli' => $pembeli,
            'total' => ($harga_telur * $jumlah_telur + $kurang_uang),
            'tanggal' => time(),
        ];
        $this->db->insert('transaksi', $telur);
    }

    public function simpan_cart_barcode($kode, $pembeli){
      $transaksi = [
        'kode' => $kode,
        'nama_kasir' => $this->session->userdata('nama'),
        'nama_pembeli' => $pembeli,
        'total' => $this->input->post('allTotal'),
        'tanggal' => time(),
      ];
      $this->db->insert('transaksi',$transaksi);
      $id_trans = $this->db->query("SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1")->result_array();
      // print_r($id_trans[0]['id_transaksi']);die;
      foreach($this->input->post('id') as $key =>$value){
      $detail[] = [
        'id_transaksi' => $id_trans[0]['id_transaksi'],
        'id_barang' => $this->input->post('id_barang')[$key],
        'jumlah' => $this->input->post('jumlah')[$key]
      ];
      }
      $this->db->insert_batch('detail_transaksi',$detail);
    }

    public function backFromStruk(){
      $query = $this->db->query("TRUNCATE TABLE cart");
      return $query;
    }

    public function dataCartBarcode(){
      $query = $this->db->query("SELECT * FROM cart c LEFT JOIN barang b ON b.kode = c.kode GROUP BY c.kode");
      return $query->result_array();
    }

}

/* End of file ModelName.php */
