<?php
defined("BASEPATH") or exit('No direct script access allowed');

class Story_Model extends CI_Model
{
    private $story = 'story';

    //fungsi untuk menampilkan data
        public function getStory($id_story)
    {
        if ($id_story) {
            $this->db->from($this->story);
            $this->db->where('id_story', $id_story);
            $this->db->join('user','user.id_user = story.id_user');
            $this->db->select('id_story,user.username,pesan,tanggal');
            $query = $this->db->get()->row_array();
            return $query;
        } else {

            $this->db->from($this->story);
            $this->db->join('user','user.id_user = story.id_user');
            $this->db->select('id_story,user.username,pesan,tanggal');
            $query = $this->db->get()->result_array();
            return $query;
        }
    }

    
    //fungsi untuk menambahkan data
    public function insertStory($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->story, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updateStory($data, $id_story)
    {
        //Menggunakan Query Builder
        $this->db->update($this->story, $data, ['id_story' => $id_story]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deleteStory($id_story)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->story, ['id_story' => $id_story]);
        return $this->db->affected_rows();
        // return $query;
    }

}