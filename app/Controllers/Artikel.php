<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
    }

    // Menampilkan daftar artikel di halaman Admin
    public function index()
    {
        $data = [
            'artikel' => $this->artikelModel->orderBy('created_at', 'DESC')->paginate(5, 'artikel'),
            'pager'   => $this->artikelModel->pager
        ];

        return view('artikel/index', $data);
    }

    // Menampilkan Form untuk Tulis Artikel Baru
    public function create()
    {
        // Untuk fitur validasi yang gagal, kita passing session() ke view 
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('artikel/create', $data);
    }

    // Proses menyimpan artikel ke Database
    public function store()
    {
        // 1. Aturan Validasi
        if (!$this->validate([
            'judul' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Judul artikel wajib diisi.']
            ],
            'isi' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Isi artikel tidak boleh kosong.']
            ],
            'cover_image' => [
                'rules'  => 'max_size[cover_image,2048]|is_image[cover_image]|mime_in[cover_image,image/jpg,image/jpeg,image/png,image/webp]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar (Maks 2MB).',
                    'is_image' => 'File yang Anda pilih bukan gambar.',
                    'mime_in'  => 'Hanya format JPG/JPEG/PNG/WEBP yang diperbolehkan.'
                ]
            ]
        ])) {
            // Jika validasi gagal, kembali ke form create
            return redirect()->to('/artikel/create')->withInput();
        }

        // 2. Ambil file gambar
        $fileCover = $this->request->getFile('cover_image');
        $namaCover = null;

        if ($fileCover && $fileCover->isValid() && ! $fileCover->hasMoved()) {
            // Generate nama file random agar tidak bentrok
            $namaCover = $fileCover->getRandomName();
            // Pindahkan ke folder public/uploads agar bisa diakses browser
            $fileCover->move(FCPATH . 'uploads', $namaCover);
        }

        // 3. Generate Slug dari judul
        $judul = $this->request->getVar('judul');
        $slug = url_title($judul, '-', true);

        // 4. Simpan ke database
        $this->artikelModel->save([
            'judul'       => $judul,
            'slug'        => $slug,
            'isi'         => $this->request->getVar('isi'),
            'cover_image' => $namaCover,
            'status'      => $this->request->getVar('status') ?? 'published',
        ]);

        session()->setFlashdata('message', 'Artikel berhasil ditambahkan!');
        return redirect()->to('/artikel/index');
    }

    // Menampilkan Form Edit Data
    public function edit($id)
    {
        $artikel = $this->artikelModel->find($id);
        if (empty($artikel)) {
            session()->setFlashdata('error', 'Artikel tidak ditemukan.');
            return redirect()->to('/artikel/index');
        }

        $data = [
            'artikel'    => $artikel,
            'validation' => \Config\Services::validation()
        ];

        return view('artikel/edit', $data);
    }

    // Proses update artikel ke Database
    public function update($id)
    {
        $artikelLama = $this->artikelModel->find($id);

        if (!$this->validate([
            'judul' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Judul artikel wajib diisi.']
            ],
            'isi' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Isi artikel tidak boleh kosong.']
            ],
            'cover_image' => [
                'rules'  => 'max_size[cover_image,2048]|is_image[cover_image]|mime_in[cover_image,image/jpg,image/jpeg,image/png,image/webp]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar (Maks 2MB).',
                    'is_image' => 'File yang Anda pilih bukan gambar.',
                    'mime_in'  => 'Hanya format JPG/JPEG/PNG/WEBP yang diperbolehkan.'
                ]
            ]
        ])) {
            return redirect()->to('/artikel/edit/' . $id)->withInput();
        }

        // Menangani file gambar (opsional upload ganti gambar)
        $fileCover = $this->request->getFile('cover_image');
        $namaCover = $artikelLama['cover_image']; // tetap pakai yang lama sebagai default

        if ($fileCover && $fileCover->isValid() && ! $fileCover->hasMoved()) {
            $namaCover = $fileCover->getRandomName();
            $fileCover->move(FCPATH . 'uploads', $namaCover);

            // Hapus gambar lama jika ada dan bukan gambar default
            if (!empty($artikelLama['cover_image']) && file_exists(FCPATH . 'uploads/' . $artikelLama['cover_image'])) {
                unlink(FCPATH . 'uploads/' . $artikelLama['cover_image']);
            }
        }

        $judul = $this->request->getVar('judul');
        $slug = url_title($judul, '-', true);

        $this->artikelModel->update($id, [
            'judul'       => $judul,
            'slug'        => $slug,
            'isi'         => $this->request->getVar('isi'),
            'cover_image' => $namaCover,
            'status'      => $this->request->getVar('status') ?? 'published',
        ]);

        session()->setFlashdata('message', 'Artikel berhasil diperbarui!');
        return redirect()->to('/artikel/index');
    }

    // Menghapus Artikel
    public function delete($id)
    {
        $artikel = $this->artikelModel->find($id);

        if ($artikel) {
            // Hapus file gambarnya juga
            if (!empty($artikel['cover_image']) && file_exists(FCPATH . 'uploads/' . $artikel['cover_image'])) {
                unlink(FCPATH . 'uploads/' . $artikel['cover_image']);
            }
            $this->artikelModel->delete($id);
            session()->setFlashdata('message', 'Artikel berhasil dihapus!');
        }

        return redirect()->to('/artikel/index');
    }

    // (Opsional) Menampilkan artikel untuk pembaca di frontend
    public function show($slug)
    {
        $artikel = $this->artikelModel->where('slug', $slug)->first();

        if (empty($artikel)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'artikel' => $artikel
        ];

        return view('artikel/detail', $data);
    }
}