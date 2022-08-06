<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        // $this->load->model('Pekerja_Model');
    }

	public function index()
	{
		$this->load->view('login');
	}

	public function registrasi()
	{
		$this->load->view('registrasi');
	}

	public function registrasi_akun()
	{

		$this->db->where('username', $this->input->post('username'));
		$lol = $this->db->get('user')->num_rows();

		if ($lol > 0) {

			// redirect(base_url('index.php/welcome/registrasi'));
			echo "username yang anda masukan sudah ada ";
		} else {

			
			$data = [
				'username' => $this->input->post('username'),
				'password' => $this->input->post('pass')
			];

			$this->db->insert('user', $data);

			
			redirect(base_url('login/registrasi'));
		}
	}

	function generate()
	{
		$this->load->view('generate');
	}

	function regenarate()
	{
		$data = [
			'apikey'
		];
	}

	function login()
	{
		$data = [
			'username' => $this->input->post('username'),
			'password' => $this->input->post('pass')
		];
		$this->db->where($data);
		$mcdy = $this->db->get('user')->num_rows();

		if ($mcdy > 0) {

			$this->db->where('username', $this->input->post('username'));
			$ses = $this->db->get('user')->result_array();
			foreach ($ses as $sess) {

				$data_session = [
					'username' => $sess['username'],
					'status' => "login"
				];
				$this->session->set_userdata($data_session);
				if ($sess['username'] != null) {
				redirect(base_url("api_key/generate"));
				
				}
				echo 'Gak Boleh Kosong';
			}
		} else {
			echo 'cobalah membuat akun di form registrasi';
		}
	}
}
