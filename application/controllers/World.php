<?php
defined('BASEPATH') or exit('No direct script access allowed');
//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class World extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('World_Model');
    }

    //iniadalah n gegettt
    public function w_get()
    {
        $world_name = $this->get('world_name');
        $data = $this->World_Model->getWorld($world_name);
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

    public function w_post()
    {
        $data = array(
            'world_id' => $this->post('world_id'),
            'world_name' => $this->post('world_name'),
            'kategori' => $this->post('kategori'),
            'id_admin' => $this->post('id_admin'),
            'reward' => $this->post('reward'),
            'id_pengawas' => $this->post('id_pengawas')
        );

        $cekdata = $this->World_Model->getWorld($this->post('world_id'));
        if (
            empty($data['world_name'])|| empty($data['kategori']) || empty($data['id_admin']) || empty($data['id_admin'])|| empty($data['reward']) || empty($data['id_pengawas'])
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
        }  elseif ($this->World_Model->insertWorld($data) > 0) {
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
        }
        else {
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
    public function w_put()
    {
        $world_id = $this->put('world_id');
        $data = array(
            // 'world_id' => $this->post('world_id'),
            'world_name' => $this->put('world_name'),
            'kategori' => $this->put('kategori'),
            'id_admin' => $this->put('id_admin'),
            'reward' => $this->put('reward'),
            'id_pengawas' => $this->put('id_pengawas')
        );

        //Jika field npm tidak diisi
        if ($world_id == NULL) {
            $this->response(
                [
                    'status' => $world_id,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'World Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Jika data berhasil berubah
        } elseif ($this->World_Model->updateWorld($data, $world_id) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Wrold ' . $world_id . ' Berhasil Diubah',
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

    public function w_delete()
    {
        $world_id = $this->delete('world_id');
        //Jika field npm tidak diisi
        if ($world_id == NULL) {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'world Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Kondisi ketika OK
        } elseif ($this->World_Model->deleteWorld($world_id) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,
                    'message' => 'Data world ' . $world_id . ' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
            );
            //Kondisi gagal
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Data world ' . $world_id . ' Tidak Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }
}
