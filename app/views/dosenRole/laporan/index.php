<!-- Flash message -->
<div class="row">
    <div class="col-lg-6">
        <?php Flasher::flash(); ?>
    </div>
</div>

<!-- Tambah Data Laporan -->
<div class="row mb-3">
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary tombolTambahDataLaporan" data-bs-toggle="modal" data-bs-target="#formModalLaporan">
            Tambah Data Laporan
        </button>
    </div>
</div>

<!-- Daftar Laporan -->
<div class="row">
    <h3>Daftar Laporan</h3>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Laporan</th>
                <th>Tanggal</th>
                <th>NIM Mahasiswa</th>
                <th>Nama Mahasiswa</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data['laporan'] as $laporan) : ?>
                <tr>
                    <th><?= $no++; ?></th>
                    <td><?= $laporan['id_laporan']; ?></td>
                    <td><?= $laporan['tgl_laporan']; ?></td>
                    <td><?= $laporan['nim_mahasiswa']; ?></td>
                    <td><?= $laporan['nama_mahasiswa']; ?></td>
                    <td><?= $laporan['kelas_mahasiswa']; ?></td>
                    <?php if ($laporan['status_sanksi'] == 'Baru') : ?>
                        <td><span class="badge bg-success"><?= $laporan['status_sanksi']; ?></span></td>
                    <?php endif; ?>
                    <td>
                        <a href="<?= BASEURL; ?>/AdminControllers/laporan/detail/<?= $laporan['id_laporan']; ?>" class="badge bg-primary tampilModalDetailLaporan" data-bs-toggle="modal" data-bs-target="#detailModalLaporan" data-id_laporan="<?= $laporan['id_laporan']; ?>">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Modal Detail Laporan -->
<div class="modal fade" id="detailModalLaporan" tabindex="-1" aria-labelledby="detailModalLaporanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLaporanLabel">Detail Data Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p><strong>ID Laporan:</strong> <span id="detailIdLaporan"></span></p>
                </div>
                <div class="form-group">
                    <p><strong>Nim Mahasiswa:</strong> <span id="detailNimMahasiswa"></span></p>
                </div>

                <div class="form-group">
                    <p><strong>Nama:</strong> <span id="detailNamaMahasiswa"></span></p>
                </div>

                <div class="form-group">
                    <p><strong>Kelas:</strong> <span id="detailKelasMahasiswa"></span></p>
                </div>

                <div class="form-group">
                    <p><strong>Nip Dosen:</strong> <span id="detailNipDosen"></span></p>
                </div>

                <div class="form-group">
                    <p><strong>Deskripsi:</strong> <span id="detailDeskripsi"></span></p>
                </div>

                <div class="form-group">
                    <p><strong>Tingkat Sanksi:</strong> <span id="detaiTingkatSaknsi"></span></p>
                </div>

                <div class="form-group">
                    <p><strong>Bukti Laporan:</strong></p>
                    <img id="detailBuktiLaporan" alt="Bukti Laporan" style="max-width: 100%;" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah Laporan -->
<div class="modal fade" id="formModalLaporan" aria-labelledby="formModalLaporanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="formModalLaporanLabel">Tambah Data Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/DosenControllers/laporan/tambah" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_user" id="id_user">
                    <div class="form-group">
                        <label for="nim_ahasiswa" class="form-label">Mahasiswa</label>
                        <select class="form-select select-mahasiswa-laporkan" id="nim_mahasiswa" name="nim_mahasiswa" autocomplete="off" required>
                            <?php
                            foreach ($data['mahasiswa'] as $mahasiswa) : ?>
                                <option value="<?= $mahasiswa['nim_mahasiswa']; ?>"><?= $mahasiswa['nama_mahasiswa']; ?> - <?= $mahasiswa['kelas_mahasiswa']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tingkat_sanksi" class="form-label">Tingkat Sanksi</label>
                        <select class="form-control choices-single select-tatib-tingkatSanksi" id="id_tingkatSanksi" name="id_tingkatSanksi" autocomplete="off" required>
                            <option></option>
                            <?php
                            foreach ($data['tatib'] as $tatib) : ?>
                                <option value="<?= $tatib['id_tingkatSanksi']; ?>"><?= $tatib['deskripsi']; ?> - <?= $tatib['tingkat_sanksi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control" name="deskripsi" rows="4" cols="50" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file_bukti" class="form-label">Upload Bukti Pelanggaran</label>
                        <input type="file" class="form-control" name="file_bukti" id="file_bukti" required>
                    </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-success">Kirim</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>