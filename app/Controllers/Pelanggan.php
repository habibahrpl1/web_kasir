<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use CodeIgniter\Controller;

class Pelanggan extends Controller
{
    protected $PelangganModel;

    public function __construct()
    {
        $this->PelangganModel = new PelangganModel();
    }

    public function index()
    {
        return view('data_pelanggan/v_pelanggan');
    }

    public function tampil_pelanggan()
    {
        // Ambil data pelanggan
        $pelanggan = $this->PelangganModel->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'pelanggan' => $pelanggan
        ]);
    }

    public function simpan_pelanggan()
    {
        //validasi input dari AJAX
        $data = [
            'nama_pelanggan'  => $this->request->getPost('nama_pelanggan'),
            'alamat'          => $this->request->getPost('alamat'),
            'nomor_tlp'   => $this->request->getPost('nomor_tlp')
        ];

        // Validasi input
        if (!$this->validate([
            'nama_pelanggan' => 'required',
            'alamat'         => 'required',
            'nomor_tlp'  => 'required|numeric'
        ])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        // Simpan data pelanggan
        if ($this->PelangganModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data pelanggan berhasil disimpan'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan data pelanggan'
            ]);
        }
    }


    public function hapus_pelanggan($id)
    {
        // Cek apakah produk dengan ID yang diberikan ada di database
        $produk = $this->PelangganModel->find($id);
        if (!$produk) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Produk tidak ditemukan',
            ]);
        }

        // Hapus produk
        if ($this->PelangganModel->delete($id)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Produk berhasil dihapus',
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal menghapus produk',
            ]);
        }
    }
    


    public function updatePelanggan()
    {
        $data = [
            'id_pelanggan'    => $this->request->getPost('id_pelanggan'),
            'nama_pelanggan'  => $this->request->getPost('nama_pelanggan'),
            'alamat'          => $this->request->getPost('alamat'),
            'nomor_tlp'   => $this->request->getPost('nomor_tlp')
        ];

        // Validasi input
        if (!$this->validate([
            'nama_pelanggan' => 'required',
            'alamat'         => 'required',
            'nomor_tlp'  => 'required|numeric'
        ])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors() // Menambahkan pesan error yang lebih spesifik
            ]);
        }

        // Update data pelanggan
        if ($this->PelangganModel->save($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data pelanggan berhasil diperbarui'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal memperbarui data pelanggan'
            ]);
        }
    }
}
