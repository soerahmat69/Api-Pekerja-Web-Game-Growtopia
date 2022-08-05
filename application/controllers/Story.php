<?php
defined('BASEPATH') or exit('No direct script access allowed');
//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Story extends RestController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Story_Model');
    }

    public function s_get()
    {
        $id_story = $this->get('id_story');
        $data = $this->Story_Model->getStory($id_story);
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

    
    public function s_post()
    {
        $data = array(
            'id_story' => $this->post('id_story'),
            'id_user' => $this->post('id_user'),
            'pesan' => $this->post('pesan'),
            'tanggal' => $this->post('tanggal')
        );
        $cekdata = $this->Story_Model->getFilm($this->post('id_story'));
        //Jika semua data wajib diisi

        if (
            empty($data['pesan'])|| empty($data['id_user']) || empty($data['id_story'] || empty($data['tanggal']))
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
        }  elseif ($this->Story_Model->insertStory($data) > 0) {
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

    public function s_put()
    {
        $id_story = $this->put('id_story');
        $data = array(
            'id_story' => $this->post('id_story'),
            'id_user' => $this->post('id_user'),
            'pesan' => $this->post('pesan'),
            'tanggal' => $this->post('tanggal')
        );
        //Jika field npm tidak diisi
        if ($id_story == NULL) {
            $this->response(
                [
                    'status' => $id_story,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'NPM Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Jika data berhasil berubah
        } elseif ($this->Story_model->updateStory($data, $id_story) > 0) {
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

    public function s_delete()
    {
        $id_story = $this->delete('id_story');
        //Jika field npm tidak diisi
        if ($id_story == NULL) {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'NPM Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Kondisi ketika OK
        } elseif ($this->Story_Model->deleteStory($id_story) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,
                    'message' => 'Data Mahasiswa Dengan NPM ' . $id_story . ' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
            );
            //Kondisi gagal
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Data Mahasiswa Dengan NPM ' . $id_story . ' Tidak Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }

}
