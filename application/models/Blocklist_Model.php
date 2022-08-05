<?php
defined("BASEPATH") or exit('No direct script access allowed');

class Blocklist_Model extends CI_Model
{
    private $blocklist = 'blocklist';

    //fungsi untuk menampilkan data
    public function getBlocklist($id_block_list)
    {
        if ($id_block_list) {
            $this->db->from($this->blocklist);
            $this->db->where('id_block_list', $id_block_list);
            $this->db->join('user',' user.id_user = blocklist.id_block_list');
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->blocklist);
            $this->db->join('user',' user.id_user = blocklist.id_block_list');
            $query = $this->db->get()->result_array();
            return $query;
        }

    }

    //fungsi untuk menambahkan data
    public function insertBlocklist($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->blocklist, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updateBlocklist($data, $id_block_list)
    {
        //Menggunakan Query Builder
        $this->db->update($this->blocklist, $data, ['id_block_list' => $id_block_list]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deleteBlocklist($id_block_list)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->blocklist, ['id_block_list' => $id_block_list]);
        return $this->db->affected_rows();
        // return $query;
    }
}
