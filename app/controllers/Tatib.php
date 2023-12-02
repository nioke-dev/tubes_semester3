<?php

class Tatib extends Controller
{
    public function index()
    {
        $data['judul'] = 'Daftar Tatib';
        $data['tatib'] = $this->model('Tatib_model')->getAllTatib();
        $data['nama'] = $this->model('User_model')->getUser();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('templates/headerNav', $data);
        $this->view('tatib/index', $data);
        $this->view('templates/footer', $data);
    }

    public function detail()
    {
        echo json_encode($this->model('Tatib_model')->getTatibById($_POST['id_tatib']));
    }


    public function tambah()
    {
        if (
            $this->model('Tatib_model')->tambahDataTatib($_POST) > 0
        ) {
            $this->showSweetAlert('success', 'Berhasil', 'Data Tatib Berhasil Ditambahkan');
            header('Location: ' . BASEURL . '/tatib');
            exit;
        } else {
            $this->showSweetAlert('error', 'Gagal', 'Data Tatib Gagal Ditambahkan');
            header('Location: ' . BASEURL . '/tatib');
            exit;
        }
    }

    public function hapus($id_tatib)
    {
        if ($this->model('Tatib_model')->hapusDataTatib($id_tatib) > 0) {
            $this->showSweetAlert('success', 'Berhasil', 'Data Tatib Berhasil Dihapus');
            header('Location: ' . BASEURL . '/tatib');
            exit;
        } else {
            $this->showSweetAlert('success', 'Gagal', 'Data Tatib Gagal Dihapus');
            header('Location: ' . BASEURL . '/tatib');
            exit;
        }
    }

    public function getubah()
    {
        echo json_encode($this->model('Tatib_model')->getTatibById(['id_tatib' => $_POST['id_tatib']]));
    }

    public function ubah()
    {
        if ($this->model('Tatib_model')->ubahDataTatib($_POST) > 0) {
            $this->showSweetAlert('success', 'Berhasil', 'Data Tatib Berhasil Diubah');
            header('Location: ' . BASEURL . '/tatib');
            exit;
        } else {
            $this->showSweetAlert('error', 'Gagal', 'Data Tatib Gagal Diubah');
            header('Location: ' . BASEURL . '/tatib');
            exit;
        }
    }

    public function cari()
    {
        $data['judul'] = 'Daftar Tatib';
        $data['tatib'] = $this->model('Tatib_model')->cariDataTatib();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('templates/headerNav', $data);
        $this->view('tatib/index', $data);
        $this->view('templates/footer', $data);
    }
}
