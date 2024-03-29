<?php
defined('BASEPATH') or exit('No direct script access allowed');
//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Admin_world extends RestController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Model');
    }

    public function a_get()
    {
        $id_admin_world = $this->get('id_admin_world');
        $data = $this->Admin_Model->getAdmin($id_admin_world);
        if ($data) {
            $this->response(
                [
                    'data' => $data,
                    'status' => 'Data Berhasil Ditampilkan',
                    'response_code' => RestController::HTTP_OK
                ],
                RestController::HTTP_OK
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Data Gagal Ditampilkan',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }

    
    public function a_post()
    {
        $data = array(
            'id_admin_world' => $this->post('id_admin_world'),
            'id_user' => $this->post('id_user'),
            'status' => $this->post('status'),
            'rate' => $this->post('rate')
        );
        $cekdata = $this->Admin_Model->getAdmin($this->post('id_admin_world'));
        //Jika semua data wajib diisi

        if (
            empty($data['id_admin_world'])|| empty($data['id_user']) || empty($data['status'] || empty($data['rate']))
        ) {
            $this->response(
                [ 
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Data Yang Dikirim Tidak Boleh Ada Yang Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );

            //Jika data tersimpan
        }  elseif ($this->Admin_Model->insertAdmin($data) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Berhasil Ditambahkan',
                ],
                RestController::HTTP_CREATED
            );
        }
        elseif ($cekdata) {
            $this->response(
                [
                'status' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Data Sudah Ada',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Gagal Menambahkan Data',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }

    public function a_put()
    {
        $id_admin_world = $this->put('id_admin_world');
        $data = array(
            'id_admin_world' => $this->put('id_admin_world'),
            'id_user' => $this->put('id_user'),
            'status' => $this->put('status'),
            'rate' => $this->post('rate')
        );
        //Jika field npm tidak diisi
        if ($id_admin_world == NULL) {
            $this->response(
                [
                    'status' => $id_admin_world,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_admin_world Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Jika data berhasil berubah
        } elseif ($this->Admin_Model->updateAdmin($data, $id_admin_world) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Admin ' . $id_admin_world . ' Berhasil Diubah',
                ],
                RestController::HTTP_CREATED
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Gagal Mengubah Data',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }

    public function a_delete()
    {
        $id_admin_world = $this->delete('id_admin_world');
        //Jika field npm tidak diisi
        if ($id_admin_world == NULL) {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_admin_world Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Kondisi ketika OK
        } elseif ($this->Admin_Model->deleteAdmin($id_admin_world) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,
                    'message' => 'Data Admin  ' . $id_admin_world . ' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
            );
            //Kondisi gagal
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Data Admin ' . $id_admin_world . ' Tidak Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }

}
