<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\OprecModel;

class Oprec extends BaseController
{
    protected $oprecModel;

    public function __construct()
    {
        $this->oprecModel = new OprecModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Pendaftaran Open Recruitment',
            'validation' => \Config\Services::validation()
        ];
        return view('oprec/index', $data);
    }

    public function store()
    {
        // Validasi input
        if (!$this->validate([
            'nama'      => 'required',
            'nim'       => 'required',
            'jurusan'   => 'required',
            'no_hp'     => 'required',
            'email'     => 'required|valid_email',
            'divisi'    => 'required',
            'alasan'    => 'required',
            'berkas_cv' => [
                'rules'  => 'uploaded[berkas_cv]|max_size[berkas_cv,2048]|ext_in[berkas_cv,pdf]',
                'errors' => [
                    'uploaded' => 'Pilih file CV terlebih dahulu.',
                    'max_size' => 'Ukuran file maksimal 2MB.',
                    'ext_in'   => 'Format file harus PDF.'
                ]
            ]
        ])) {
            return redirect()->to('/oprec')->withInput()->with('validation', \Config\Services::validation());
        }

        // Ambil file CV
        $fileCV = $this->request->getFile('berkas_cv');

        // Generate nama file random
        $namaCV = $fileCV->getRandomName();

        // Pindahkan file ke folder public/uploads/cv
        $fileCV->move('uploads/cv', $namaCV);

        // Simpan ke database
        $this->oprecModel->save([
            'nama'      => $this->request->getVar('nama'),
            'nim'       => $this->request->getVar('nim'),
            'jurusan'   => $this->request->getVar('jurusan'),
            'no_hp'     => $this->request->getVar('no_hp'),
            'email'     => $this->request->getVar('email'),
            'divisi'    => $this->request->getVar('divisi'),
            'alasan'    => $this->request->getVar('alasan'),
            'berkas_cv' => $namaCV,
            'status'    => 'Pending'
        ]);

        return redirect()->to('/oprec/success')->with('pesan', 'Pendaftaran berhasil! Silakan tunggu informasi selanjutnya.');
    }

    public function success()
    {
        $data = [
            'title' => 'Pendaftaran Berhasil'
        ];
        return view('oprec/success', $data);
    }

    // --- Bagian Admin ---

    public function admin()
    {
        $data = [
            'title' => 'Admin - Open Recruitment',
            'pendaftar' => $this->oprecModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('oprec/admin', $data);
    }

    public function update_status($id)
    {
        $status = $this->request->getVar('status');

        $this->oprecModel->update($id, [
            'status' => $status
        ]);

        return redirect()->to('/oprec/admin')->with('pesan', 'Status peserta berhasil diubah.');
    }

    public function delete($id)
    {
        // Cari data berdasarkan ID
        $pendaftar = $this->oprecModel->find($id);

        if ($pendaftar) {
            // Hapus file CV jika ada
            if ($pendaftar['berkas_cv'] && file_exists('uploads/cv/' . $pendaftar['berkas_cv'])) {
                unlink('uploads/cv/' . $pendaftar['berkas_cv']);
            }

            // Hapus dari database
            $this->oprecModel->delete($id);

            return redirect()->to('/oprec/admin')->with('pesan', 'Data peserta berhasil dihapus.');
        }

        return redirect()->to('/oprec/admin')->with('error', 'Data peserta tidak ditemukan.');
    }
}
