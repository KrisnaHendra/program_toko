
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public function view()
    {
        $this->db->select('*');
        // $this->db->order_by('nama_barang', 'asc');
        return $this->db->get('barang')->result_array();
    }

    public function tambah()
    {
        $data = [
            'kode' => $this->input->post('kode'),
            'nama_barang' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan'),
            'harga_jual' => $this->input->post('harga'),
            'harga_do' => $this->input->post('harga_do'),
            'stok' => $this->input->post('stok'),
            'updated' => time(),
        ];
        $this->db->insert('barang', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->delete('barang');
    }

    public function update($id_barang, $kode, $nama_barang, $keterangan, $harga, $harga_do, $stok, $updated)
    {
        $update = $this->db->query(
            "UPDATE barang SET kode='$kode',nama_barang='$nama_barang',keterangan='$keterangan',harga_jual='$harga',harga_do='$harga_do',stok='$stok',updated='$updated' WHERE id_barang='$id_barang'"
        );
        return $update;
    }

    public function find($id)
    {
        $result = $this->db->where('id_barang', $id)
            ->limit(1)
            ->get('barang');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function export()
    {
        $this->db->select('*');
        $this->db->from('barang');

        return $this->db->get();
    }

}

?>