<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ternak_model extends CI_Model {

    public function pelanggan(){
        $query=$this->db->query("SELECT * FROM pelanggan");
        return $query->result_array();
    }

    public function tambah(){
        $data = [
            'nama_pelanggan' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat')
        ];
        $this->db->insert('pelanggan', $data);
    }

    public function hapus($id){
        $query=$this->db->query("DELETE FROM pelanggan WHERE id_pelanggan = '$id'");
    }

    public function update($id_pelanggan,$nama,$alamat){
        $query=$this->db->query("UPDATE pelanggan SET nama_pelanggan='$nama',alamat='$alamat' WHERE id_pelanggan = '$id_pelanggan'");
        return $query;
    }

    public function transaksi(){
        
    }

}

/* End of file Ternak_model.php */
