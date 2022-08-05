<?php
defined("BASEPATH") or exit('No direct script access allowed');

class Pengawas_Model extends CI_Model
{
    private $t = 'pengawas';

    //fungsi untuk menampilkan data
    public function getPengawas($id_pengawas)
    {
        if ($id_pengawas) {
            $this->db->from($this->t);
            $this->db->where('id_pengawas', $id_pengawas);
            $this->db->join('user',' user.id_user = pengawas.id_pengawas');
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->t);
            $this->db->join('user',' user.id_user = pengawas.id_pengawas');
            $query = $this->db->get()->result_array();
            return $query;
        }

    }

    //fungsi untuk menambahkan data
    public function insertPengawas($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->t, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updatePengawas($data, $id_pengawas)
    {
        //Menggunakan Query Builder
        $this->db->update($this->t, $data, ['id_pengawas' => $id_pengawas]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deletePengawas($id_pengawas)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->t, ['id_pengawasa' => $id_pengawas]);
        return $this->db->affected_rows();
        // return $query;
    }
}
