<?php

class Dosen extends Controller
{
    public function index()
    {
        $data['judul'] = 'DPA';
        $data['dpa'] = $this->model('Dpa_model')->getAllDpa();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('templates/headerNav', $data);
        $this->view('dosen/index', $data);
        $this->view('templates/footer', $data);
    }

    public function detail()
    {
        echo json_encode($this->model('Dpa_model')->getDpaByNip($_POST['nip_dosen']));
    }

    public function tambah()
    {
        if ($this->model('Dpa_model')->tambahUserDpa($_POST) > 0) {
            # code...
            $dataUser['userDpaId'] = $this->model('Dpa_model')->getUserDPByNip($_POST);

            if (
                $this->model('Dpa_model')->tambahDataDpa($_POST, $dataUser) > 0
            ) {

                $this->showSweetAlert('success', 'Berhasil', 'Data Dosen berhasil ditambahkan');
                header('Location: ' . BASEURL . '/dosen');
                exit;
            } else {
                $this->showSweetAlert('error', 'Ooops', 'Data Dosen Gagal ditambahkan');
                header('Location: ' . BASEURL . '/dosen');
                exit;
            }
        } else {
            $this->showSweetAlert('error', 'Ooops', 'Data Dosen Gagal ditambahkan');
            header('Location: ' . BASEURL . '/dosen');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Dosen_model')->hapusDataDosen($id) > 0) {
            // Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/dosen');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/dosen');
            exit;
        }
    }

    public function getubah()
    {
        echo json_encode($this->model('Dosen_model')->getDosenById($_POST['id']));
    }

    public function ubah()
    {
        if ($this->model('Dosen_model')->ubahDataDosen($_POST) > 0) {
            // Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/dosen');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/dosen');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = 'Daftar Dosen';
        $data['dsn'] = $this->model('Dosen_model')->cariDataDosen();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('templates/headerNav', $data);
        $this->view('dosen/index', $data);
        $this->view('templates/footer', $data);
    }
}
