<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>

    <!--link bootstrap-->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!--link -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome-free-6.6.0-web/css/all.min.css') ?>">

</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <h3 class="text-center">Data Pelanggan</h3>
                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data data-bs-target="#modalTambahPelanggan"><i class="fa-solid fa-user"></i>Tambah Pelanggan</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="container mt-5">
                    <table class="table table-bordered" id="pelangganTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        <tbody>
                            <!--Data akan dimasukkan melalui ajax-->
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahPelanggan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalTambahPelangganLabel">Tambah Pelanggan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPelanggan">
                        <div class="row mb-3">
                            <label for="namaPelanggan" class="col-form-label">Nama Pelanggan</label>
                            <div class="cl-sm-8">
                                <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamatPelanggan" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="cl-sm-8">
                                <input type="text" class="form-control" id="alamatPelanggan" name="alamatPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nomorTelepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                            <div class="cl-sm-8">
                                <input type="number" class="form-control" id="nomorPelanggan">
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" id="simpanPelanggan" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan">Simpan</button>
                    </div>
                    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-heade">
                                    <h1 class="modal-title " id="modalHapusLabel">Konfirmasi Hapus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"> &times; </span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-danger" id="btnHapus">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEditPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditPelanggan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalEditPelanggan">Edit Pelanggan</h1>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPelanggan">
                        <div class="row mb-3">
                            <label for="namaPelangganEdit" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                            <div class="cl-sm-8">
                                <input type="text" class="form-control" id="namaPelangganEdit" name="namaPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamatPelangganEdit" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="cl-sm-8">
                                <input type="text" class="form-control" id="alamatPelangganEdit" name="alamatPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nomorPelangganEdit" class="col-sm-4 col-form-label">No.Telepon</label>
                            <div class="cl-sm-8">
                                <input type="number" class="form-control" id="nomorPelangganEdit">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="editPelangganSimpan">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url("assets/jquery-3.7.1.min.js") ?>"></script>

    <script>
        $(document).ready(function() {
            function tampilPelanggan() {
                $.ajax({
                    url: '<?= base_url('pelanggan/tampil') ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            var pelangganTable = $('#pelangganTable tbody');
                            pelangganTable.empty(); //Hapus semua isi tabel

                            var pelanggan = hasil.pelanggan;
                            var no = 1;

                            //looping untuk memasukkan data ke dalam tabel
                            pelanggan.forEach(function(item) {
                                var row = '<tr>' +
                                    '<td>' + no + '</td>' +
                                    '<td>' + item.nama_pelanggan + '</td>' +
                                    '<td>' + item.alamat + '</td>' +
                                    '<td>' + item.nomor_tlp + '</td>' +
                                    '<td>' +
                                    '<button class="btn btn-warning btn-sm editPelanggan" data-id="' + item.pelanggan_id + '" data-bs-toggle="modal" data-bs-target="#modalEditPelanggan"><i class="fa-solid fa-pencil"></i> Edit</button> ' +
                                    '<button class="btn btn-danger btn-sm hapusPelanggan" data-id="' + item.pelanggan_id + '"><i class="fa-solid fa-trash-can"></i> Hapus</button> ' +
                                    '</td>' +
                                    '</tr>';
                                pelangganTable.append(row);
                                no++;
                            });
                        } else {
                            alert('Gagal mengambil data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            }
            //tambah
            tampilPelanggan();
            $("#simpanPelanggan").on("click", function() {
                var formData = {
                    nama_pelanggan: $('#namaPelanggan').val(),
                    alamat: $('#alamatPelanggan').val(),
                    nomor_tlp: $('#nomorPelanggan').val()
                };
                // console.log(formData);

                $.ajax({
                    url: '<?= base_url('pelanggan/simpan'); ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalTambahPelanggan').modal('hide');
                            tampilPelanggan();
                        } else {
                            alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });

            // Fungsi untuk menghapus pelanggan
            $('#pelangganTable').on('click', '.hapusPelanggan', function() {
                                    var id = $(this).attr('data-id')
                                    console.log(id);

                                    $.ajax({
                                        url: `http://localhost:8080/pelanggan/delete/${id}`,
                                        type: 'POST',
                                        success: function(response) {
                                            $('#modalHapus').modal('hide');
                                            alert('Berhasil Hapus data');
                                            tampilPelanggan()
                                        }
                                    })
                                });
                            });
            //edit
            $('#pelangganTable').on('click', '.editPelanggan', function() {
                var row = $(this).closest('tr');
                var id = $(this).data('id'); // Mendapatkan ID pelanggan  

                // Menetapkan nilai input di modal sesuai dengan data produk di tabel
                document.getElementById('namaPelangganEdit').value = row.find('td:eq(1)').text();
                document.getElementById('alamatPelangganEdit').value = row.find('td:eq(2)').text();
                document.getElementById('nomorPelangganEdit').value = row.find('td:eq(3)').text();

                // Menangani klik pada tombol simpan di modal edit
                $('#editPelangganSimpan').off('click').on('click', function() {
                    var formData = {
                        'pelanggan_id': id,
                        'nama_pelanggan': document.getElementById('namaPelangganEdit').value,
                        'alamat': document.getElementById('alamatPelangganEdit').value,
                        'nomor_tlp': document.getElementById('nomorPelangganEdit').value
                    };

                    if (confirm('Apakah anda yakin ingin edit pelanggan ini?')) {
                        $.ajax({
                            url: '<?= base_url('pelanggan/updatePelanggan') ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            success: function(hasil) {
                                if (hasil.status === 'success') {
                                    // Menutup modal dan mereset form
                                    $('#modalEditPelanggan').modal('hide');
                                    $('#formPelanggan')[0].reset();
                                    tampilPelanggan();
                                    // Update data pada tabel tanpa me-reload halaman
                                    var updatedRow = row; // Pilih baris yang diedit
                                    row.find('td:eq(1)').text(formData.nama_pelanggan); // Update nama
                                    row.find('td:eq(2)').text(formData.alamat); // Update alamat
                                    row.find('td:eq(3)').text(formData.nomor_tlp); // Update nomor telepon
                                } else {
                                    alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    }
                });
            });
    </script>
</body>
<script src="<?= base_url("assets/js/bootstrap.min.js") ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>