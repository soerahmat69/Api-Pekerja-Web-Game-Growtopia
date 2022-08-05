<?php
defined("BASEPATH") or exit('No direct script access allowed');

class Pekerja_Model extends CI_Model
{
    private $t = 'pekerja';

    //fungsi untuk menampilkan data
    public function getPekerja($id_pekerja)
    {
        if ($id_pekerja) {
            $this->db->from($this->t);
            $this->db->where('id_pekerja', $id_pekerja);
            $this->db->join('user',' user.id_user = pekerja.id_pekerja');
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->t);
            $this->db->join('user',' user.id_user = pekerja.id_pekerja');
            $query = $this->db->get()->result_array();
            return $query;
        }

    }

    //fungsi untuk menambahkan data
    public function insertPekerja($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->t, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updatePekerja($data, $id_pekerja)
    {
        //Menggunakan Query Builder
        $this->db->update($this->t, $data, ['id_pekerja' => $id_pekerja]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deletePekerja($id_pekerja)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->t, ['id_pekerja' => $id_pekerja]);
        return $this->db->affected_rows();
        // return $query;
    }
}
