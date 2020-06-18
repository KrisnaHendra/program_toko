
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function show_user(){
        // $this->db->select('*');
        // return $this->db->get('user')->result_array();
        $admin = $this->db->query("SELECT * FROM user where id_user>1");
        return $admin->result_array();
    }

    public function show_admin(){
        $admin = $this->db->query("SELECT * FROM user where id_user=1");
        return $admin->result_array();
    }

    public function delete_user($id){
        $delete=$this->db->query(
            "DELETE FROM user WHERE id_user='$id'"
        );
        return $delete;
    }

    public function add_user(){
        $data=[
			'nama'=> $this->input->post('nama'),
			'username'=> $this->input->post('username'),
			'password'=> PASSWORD_HASH($this->input->post('password1'),PASSWORD_DEFAULT),
			'image' => 'default.jpg',
			'id_status' => $this->input->post('status'),
			'aktif' => 1,
			'created_at' => time()
		];
		$this->db->insert('user',$data);
    }

    public function lihat_catatan(){
        $this->db->select('*');
        return $this->db->get('catatan')->result_array();
    }

    public function delete_catatan($id){
        $delete=$this->db->query(
            "DELETE FROM catatan WHERE id_catatan='$id'"
        );
        return $delete;
    }

}

/* End of file ModelName.php */
