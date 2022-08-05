<?php
defined("BASEPATH") or exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    private $t = 'admin_world';

    //fungsi untuk menampilkan data
    public function getAdmin($id_admin_world)
    {
        if ($id_admin_world) {
            $this->db->from($this->t);
            $this->db->where('id_admin_world', $id_admin_world);
            $this->db->join('user',' user.id_user = admin_world.id_admin_world');
            $this->db->select('id_admin_world,user.username,status,rate');
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->t);
            $this->db->join('user',' user.id_user = admin_world.id_admin_world');
            $this->db->select('id_admin_world,user.username,status,rate');
            $query = $this->db->get()->result_array();
            return $query;
        }

    }

    //fungsi untuk menambahkan data
    public function insertAdmin($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->t, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updatePengawas($data, $id_admin_world)
    {
        //Menggunakan Query Builder
        $this->db->update($this->t, $data, ['id_admin_world' => $id_admin_world]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deleteAdmin($id_admin_world)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->t, ['id_admin_world' => $id_admin_world]);
        return $this->db->affected_rows();
        // return $query;
    }
}
