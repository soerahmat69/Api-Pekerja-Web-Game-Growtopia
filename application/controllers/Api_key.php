<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api_key extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        // $this->methods['index_get']['limit'] = 2;
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $data = [
            'username' => $this->session->userdata('username')
        ];
        $this->load->view('login', $data);
    }

    public function generate()
    {

        $this->db->where('username', $this->session->userdata('username'));
        $this->db->join('keys', 'user.id_user = keys.user_id', 'left');
        $lol =  $this->db->get('user')->result();
        if (isset($lol)) {
            $data = [
                'username' => $this->session->userdata('username'),
                'keys' => $lol
            ];
            $this->load->view('generate', $data);
        } else {
            $data = [
                'username' => $this->session->userdata('username')
            ];
            $this->load->view('generate', $data);
        }
    }

    function generated()
    {
        $this->load->model('Generate_Key');
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->join('keys', 'user.id_user = keys.id', 'left');
        $lol = $this->db->get('user')->result();
        if (!isset($lol[0]->key)) {
            $data = [
                'user_id' => $lol[0]->id_user,
                'key' => $this->Generate_Key->generateRandomString()
            ];

            $this->db->insert('keys', $data);
            redirect(base_url('api_key/generate'));
        } else {
            redirect(base_url('api_key/generate'));
        }
    }
}
