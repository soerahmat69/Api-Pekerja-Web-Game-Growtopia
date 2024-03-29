<?php
defined('BASEPATH') or exit('No direct script access allowed');
//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Pengawas extends RestController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengawas_Model');
    }

    public function p_get()
    {
        $id_pengawas = $this->get('id_pengawas');
        $data = $this->Pengawas_Model->getPengawas($id_pengawas);
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

    
    public function p_post()
    {
        $data = array(
            'id_pengawas' => $this->post('id_pengawas'),
            'id_user' => $this->post('id_user'),
            'time_on' => $this->post('time_on'),
            'rate' => $this->post('rate')
        );
        $cekdata = $this->Pengawas_Model->getPengawas($this->post('id_pengawas'));
        //Jika semua data wajib diisi

        if (
            empty($data['id_pengawas'])|| empty($data['id_user']) || empty($data['time_on'] || empty($data['rate']))
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
        }  elseif ($this->Pengawas_Model->insertPengawas($data) > 0) {
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

    public function p_put()
    {
        $id_pengawas = $this->put('id_pengawas');
        $data = array(
            'id_pengawas' => $this->put('id_pengawas'),
            'id_user' => $this->put('id_user'),
            'time_on' => $this->put('time_on'),
            'rate' => $this->put('rate')
        );
        //Jika field npm tidak diisi
        if ($id_pengawas == NULL) {
            $this->response(
                [
                    'status' => $id_pengawas,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_pengawas Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Jika data berhasil berubah
        } elseif ($this->Pengawas_Model->updatePengawas($data, $id_pengawas) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Pengawas  ' . $id_pengawas . ' Berhasil Diubah',
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

    public function p_delete()
    {
        $id_pengawas = $this->delete('id_pengawas');
        //Jika field npm tidak diisi
        if ($id_pengawas == NULL) {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_pengawas Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Kondisi ketika OK
        } elseif ($this->Pengawas_Model->deletePengawas($id_pengawas) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,
                    'message' => 'Data pengawas' . $id_pengawas . ' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
            );
            //Kondisi gagal
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Data Penagwas ' . $id_pengawas . ' Tidak Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }

}
