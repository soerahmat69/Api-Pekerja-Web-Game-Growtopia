<?php
defined("BASEPATH") or exit('No direct script access allowed');

class World_Model extends CI_Model
{
    private $world = 'world as w';

    //fungsi untuk menampilkan data
    public function getWorld($world_name)
    {
        if ($world_name) {


          

            $this->db->from($this->world);
            $this->db->where('world_name', $world_name);
            $this->db->join('user as zoez',' zoez.id_user = w.id_admin');
            $this->db->join('user as zoe',' zoe.id_user = w.id_pengawas');
            $this->db->join('kategori_pekerja',' kategori_pekerja.id_kateg = w.kategori');
            $this->db->select('world_id,world_name,nama_kategori,reward,zoez.growid as admin,zoe.growid as pengawas');
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->world);
            $this->db->join('user as zoez',' zoez.id_user = w.id_admin');
            $this->db->join('user as zoe',' zoe.id_user = w.id_pengawas');
            $this->db->join('kategori_pekerja',' kategori_pekerja.id_kateg = w.kategori');
            $this->db->select('world_id,world_name,nama_kategori,reward,zoez.growid as admin');
            $query = $this->db->get()->result_array();
            return $query;
        }

    }

    //fungsi untuk menambahkan data
    public function insertWorld($data)
    {
        //Menggunakan Query Builderthis
        $this->db->set($data);
        $this->db->insert( $this->db->dbprefix . 'world');
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updateWorld($data, $world_id)
    {
        //Menggunakan Query Builder
        $this->db->update('world', $data, ['world_id' => $world_id]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deleteWorld($world_id)
    {
        //Menggunakan Query Builder
        $this->db->delete('world', ['world_id' => $world_id]);
        return $this->db->affected_rows();
        // return $query;
    }
}
