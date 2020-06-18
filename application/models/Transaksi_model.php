<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public function index()
    {
        $query = $this->db->query(
            "SELECT t.kode as invoice,t.*,d.*,b.* FROM transaksi t JOIN detail_transaksi d ON t.id_transaksi=d.id_transaksi JOIN barang b ON b.id_barang = d.id_barang GROUP BY t.kode, d.id_barang"
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
        for ($i = 0; $i < count($this->input->post('rowid')); $i++) {
            $stok = $this->db->where('id_barang', $this->input->post('id_barang')[$i])
                ->get('barang')
                ->row()
                ->stok;
            $qty = $this->input->post('qty')[$i];
            $sisa = $stok - $qty;
            $updatestok = array('stok' => $sisa);
            $this->db->where('id_barang', $this->input->post('id_barang')[$i])
                ->update('barang', $updatestok);
        }

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

}

/* End of file ModelName.php */
