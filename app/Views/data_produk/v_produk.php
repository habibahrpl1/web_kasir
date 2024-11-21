<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>

    <!--link bootstrap-->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!--link -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome-free-6.6.0-web/css/all.min.css') ?>">

</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <h3 class="text-center">Data Produk</h3>
                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data data-bs-target="#modalTambahProduk"><i class="fa-solid fa-cart-plus"></i>Tambah Data</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="container mt-5">
                    <table class="table table-bordered" id="produkTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        <tbody>
                            <!--Data akan dimasukkan melalui ajax-->
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalTambahProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahProduk" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h1 class="modal-title fs-5" id="modalTambahProdukLabel">Tambah Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formProduk">
                            <div class="row mb-3">
                                <label for="namaProduk" class="col-form-label">Nama Produk</label>
                                <div class="cl-sm-8">
                                    <input type="text" class="form-control" id="namaProduk" name="namaProduk">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="hargaProduk" class="col-sm-4 col-form-label">Harga</label>
                                <div class="cl-sm-8">
                                    <input type="number" step="0.01" class="form-control" id="hargaProduk">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="stokProduk" class="col-sm-4 col-form-label">Stok</label>
                                <div class="cl-sm-8">
                                    <input type="number" class="form-control" id="stokProduk">
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" id="simpanProduk" class="btn btn-primary float-end">Simpan</button>
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


                        <script src="<?= base_url("assets/jquery-3.7.1.min.js") ?>"></script>
                        <script src="<?= base_url("assets/js/bootstrap.min.js") ?>"></script>

                        <script>
                            $(document).ready(function() {
                                function tampilProduk() {
                                    $.ajax({
                                        url: '<?= base_url('produk/tampil') ?>',
                                        type: 'GET',
                                        dataType: 'json',
                                        success: function(hasil) {
                                            if (hasil.status === 'success') {
                                                var produkTable = $('#produkTable tbody');
                                                produkTable.empty(); //Hapus semua isi tabel

                                                var produk = hasil.produk;
                                                var no = 1;

                                                //looping untuk memasukkan data ke dalam tabel
                                                produk.forEach(function(item) {
                                                    var row = '<tr>' +
                                                        '<td>' + no + '</td>' +
                                                        '<td>' + item.nama_produk + '</td>' +
                                                        '<td>' + item.harga + '</td>' +
                                                        '<td>' + item.stok + '</td>' +
                                                        '<td>' +
                                                        '<button class="btn btn-warning btn-sm editProduk" data-id="' + item.produk_id + '" data-bs-toggle="modal" data-bs-target="#modalEditProduk"><i class="fa-solid fa-pencil"></i> Edit</button> ' +
                                                        '<button class="btn btn-danger btn-sm hapusProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-trash-can"></i> Hapus</button> ' +
                                                        '</td>' +
                                                        '</tr>';
                                                    produkTable.append(row);
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

                                tampilProduk();
                                $("#simpanProduk").on("click", function() {
                                    var formData = {
                                        nama_produk: $('#namaProduk').val(),
                                        harga: $('#hargaProduk').val(),
                                        stok: $('#stokProduk').val()
                                    };
                                    console.log(formData);

                                    $.ajax({
                                        url: '<?= base_url('produk/simpan'); ?>',
                                        type: 'POST',
                                        data: formData,
                                        dataType: 'json',
                                        success: function(hasil) {
                                            if (hasil.status === 'success') {
                                                //alert(hasil.message);
                                                $('#modalTambahProduk').modal('hide');
                                                $('#formProduk')[0].reset();
                                                tampilProduk();
                                            } else {
                                                alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            alert('Terjadi kesalahan: ' + error);
                                        }
                                    });
                                });

                                // Fungsi untuk menghapus produk
                                $('#produkTable').on('click', '.hapusProduk', function() {
                                    var id = $(this).attr('data-id')
                                    console.log(id);

                                    $.ajax({
                                        url: `http://localhost:8080/produk/delete/${id}`,
                                        type: 'DELETE',
                                        success: function(response) {
                                            $('#modalHapus').modal('hide');
                                            alert('Berhasil Hapus data');
                                            tampilProduk()
                                        }
                                    })
                                });
                            });

                            // Fungsi untuk mengedit produk
                            $('#produkTable').on('click', '.editProduk', function() {
                                var row = $(this).closest('tr'); // Menangkap baris yang berisi tombol edit
                                var id = $(this).data('id'); // Mendapatkan ID produk

                                // Menetapkan nilai input di modal sesuai dengan data produk di tabel
                                document.getElementById('namaProdukEdit').value = row.find('td:eq(1)').text();
                                document.getElementById('hargaProdukEdit').value = row.find('td:eq(2)').text();
                                document.getElementById('stokProdukEdit').value = row.find('td:eq(3)').text();

                                // Menangani klik pada tombol simpan di modal edit
                                $('#editProdukSimpan').off('click').on('click', function() {
                                    // Mengambil nilai dari form input
                                    var formData = {
                                        'id_produk': id,
                                        'nama_produk': document.getElementById('namaProdukEdit').value,
                                        'harga': document.getElementById('hargaProdukEdit').value,
                                        'stok': document.getElementById('stokProdukEdit').value
                                    };

                                    // Konfirmasi sebelum mengedit produk
                                    if (confirm('Apakah anda yakin ingin edit produk ini?')) {
                                        // Kirimkan permintaan AJAX untuk mengupdate produk
                                        $.ajax({
                                            url: '<?= base_url('produk/updateProduk') ?>',
                                            type: 'POST',
                                            dataType: 'json',
                                            data: formData,
                                            success: function(hasil) {
                                                if (hasil.status === 'success') {
                                                    // Tutup modal setelah berhasil
                                                    $('#modalEditProduk').modal('hide');
                                                    $('#formProduk')[0].reset();

                                                    // Perbarui data di tabel tanpa memuat ulang
                                                    row.find('td:eq(1)').text(formData.nama_produk);
                                                    row.find('td:eq(2)').text(formData.harga);
                                                    row.find('td:eq(3)').text(formData.stok);

                                                } else {
                                                    // Tampilkan pesan kesalahan jika update gagal
                                                    alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                                                }
                                            },
                                            error: function(xhr, status, error) {
                                                // Tangani kesalahan AJAX
                                                alert('Terjadi kesalahan saat mengupdate data produk');
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditProduk" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalEditProduk">Edit Produk</h1>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formProduk">
                        <div class="row mb-3">
                            <label for="namaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaProdukEdit" name="namaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hargaProduk" class="col-sm-4 col-from-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="number" step="0.01" class="form-control" id="hargaProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stokProduk" class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stokProdukEdit">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="editProdukSimpan">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- <body>
    <div class="container">
        <div class="card-header header-margin" style="display: flex; justify-content: center;">
            <h3 class="card_title" style="color: black;">
                <strong>Data Produk</strong>
            </h3>
        </div>
        <div class="card-body text-center button-margin" style="display: flex; justify-content: flex-end;">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fa-solid fa-plus"></i>
                <a>Tambah Data</a>
            </button>
        </div>
    </div> -->

<!-- </body>
</html> -->