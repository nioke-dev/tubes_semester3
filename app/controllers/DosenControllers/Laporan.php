<?php

class Laporan extends Controller
{
    public function __construct()
    {
        $this->middleware('AuthMiddleware')->handle();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Laporan';
        $data['laporan'] = $this->model('Laporan_model')->getAllLaporan();
        $data['nama'] = $this->model('User_model')->getUser();
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
        $data['tatib'] = $this->model('tatib_model')->getAllTatib();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('templates/headerNav', $data);
        $this->view('dosenRole/laporan/index', $data);
        $this->view('templates/footer', $data);
    }

    public function detail()
    {
        echo json_encode($this->model('Laporan_model')->getLaporanById($_POST['id_laporan']));
    }

    public function tambah()
    {
        // Handle file upload
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_FILES["file_bukti"]) && $_FILES["file_bukti"]["error"] == 0) {
                $target_dir = $_SERVER['DOCUMENT_ROOT'] . BASEPUBLIC . "/img/bukti_laporan/";
                $file_extension = strtolower(pathinfo($_FILES["file_bukti"]["name"], PATHINFO_EXTENSION));

                // Generate a unique filename using timestamp
                $filename = "file_" . time() . "." . $file_extension;
                $target_file = $target_dir . $filename;

                $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
                if (!in_array($file_extension, $allowed_types)) {
                    echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
                    exit;
                } else {
                    if (move_uploaded_file($_FILES["file_bukti"]["tmp_name"], $target_file)) {
                        // File upload success
                        $filesize = $_FILES["file_bukti"]["size"];
                        $filetype = $_FILES["file_bukti"]["type"];
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        exit;
                    }
                }
            } else {
                echo "No file was uploaded.";
                exit;
            }
        }

        // Handle data laporan
        if ($this->model('Laporan_model')->tambahDataLaporan($_POST, $filename, $filesize, $filetype) > 0) {
            $this->showSweetAlert('success', 'Berhasil', 'Data Laporan berhasil ditambahkan');
            header('Location: ' . BASEURL . '/DosenControllers/laporan');
            exit;
        } else {
            $this->showSweetAlert('error', 'Ooops', 'Data Laporan Gagal ditambahkan');
            header('Location: ' . BASEURL . '/DosenControllers/laporan');
            exit;
        }
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
    }



    // Fungsi untuk menghapus data laporan
    public function hapus($id_laporan)
    {
        if ($this->model('Laporan_model')->hapusDataLaporan($id_laporan) > 0) {
            $this->showSweetAlert('success', 'Berhasil', 'Data Laporan berhasil dihapus');
            header('Location: ' . BASEURL . '/DosenControllers/laporan');
            exit;
        } else {
            $this->showSweetAlert('error', 'Ooops', 'Data Laporan Gagal dihapus');
            header('Location: ' . BASEURL . '/DosenControllers/laporan');
            exit;
        }
    }
}
