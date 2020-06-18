
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir_model extends CI_Model {

    public function history_transaksi(){
        $query=$this->db->query("SELECT * FROM transaksi WHERE nama_kasir='".$this->session->userdata('nama')."'");
        return $query->result_array();
    }


}

/* End of file ModelName.php */
