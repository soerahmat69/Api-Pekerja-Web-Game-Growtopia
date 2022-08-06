<?php
defined("BASEPATH") or exit('No direct script access allowed');

class User_Model extends CI_Model
{
    private $t = 'user';

    //fungsi untuk menampilkan data
    public function getUser($id_user)
    {
        if ($id_user) {
            $this->db->from($this->t);
            $this->db->where('id_user', $id_user);
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->t);
            $query = $this->db->get()->result_array();
            return $query;
        }

    }

    //fungsi untuk menambahkan data
    public function insertUser($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->t, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updateUser($data, $id_user)
    {
        //Menggunakan Query Builder
        $this->db->update($this->t, $data, ['id_user' => $id_user]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deleteUser($id_user)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->t, ['id_user' => $id_user]);
        return $this->db->affected_rows();
        // return $query;
    }
}
