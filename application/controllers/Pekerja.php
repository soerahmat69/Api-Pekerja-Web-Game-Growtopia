<?php
defined('BASEPATH') or exit('No direct script access allowed');
//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Pekerja extends RestController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pekerja_Model');
    }

    public function p_get()
    {
        $id_pekerja = $this->get('id_pekerja');
        $data = $this->Pekerja_Model->getStory($id_pekerja);
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
            'id_pekerja' => $this->post('id_story'),
            'id_user' => $this->post('id_user'),
            'kategori' => $this->post('kategori'),
            'status' => $this->post('status')
        );
        $cekdata = $this->Pekerja_Model->getPekerja($this->post('id_pekerja'));
        //Jika semua data wajib diisi

        if (
            empty($data['id_pekerja'])|| empty($data['id_user']) || empty($data['kategori'] || empty($data['status']))
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
        }  elseif ($this->Pekerja_Model->insertPekerja($data) > 0) {
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
        $id_pekerja = $this->put('id_pekerja');
        $data = array(
            'id_pekerja' => $this->post('id_story'),
            'id_user' => $this->post('id_user'),
            'kategori' => $this->post('kategori'),
            'status' => $this->post('status')
        );
        //Jika field npm tidak diisi
        if ($id_pekerja == NULL) {
            $this->response(
                [
                    'status' => $id_pekerja,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'NPM Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Jika data berhasil berubah
        } elseif ($this->Pekerja_Model->updatePekerja($data, $id_pekerja) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Mahasiswa Dengan NPM ' . $npm . ' Berhasil Diubah',
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
        $id_pekerja = $this->delete('id_pekerja');
        //Jika field npm tidak diisi
        if ($id_pekerja == NULL) {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'NPM Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Kondisi ketika OK
        } elseif ($this->Pekerja_Model->deletePekerja($id_pekerja) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,
                    'message' => 'Data Mahasiswa Dengan NPM ' . $id_pekerja . ' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
            );
            //Kondisi gagal
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Data Mahasiswa Dengan NPM ' . $id_pekerja . ' Tidak Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }

}
