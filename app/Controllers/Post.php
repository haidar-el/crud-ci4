<?php namespace App\Controllers;

/**
 * MENGHUBUNGKAN KE FILE LAIN:
 * 1. Controller: Dasar dari class ini (Wajib).
 * 2. PostModel: Menghubungkan ke folder 'app/Models/PostModel.php' 
 * untuk akses ke Database.
 */
use CodeIgniter\Controller;
use App\Models\PostModel; 

class Post extends Controller
{
    /**
     * FUNGSI INDEX (Menampilkan List Data)
     * Mengambil data dari DATABASE melalui Model dan mengirimnya ke VIEW.
     */
    public function index()
    {
        // Menghubungkan ke file Model (PostModel.php)
        $postModel = new PostModel();

        // Mengambil layanan Pagination dari sistem CodeIgniter
        $pager = \Config\Services::pager();

        // Menyiapkan paket data untuk dikirim ke View
        $data = array(
            // Mengambil data dari tabel dengan batas 2 baris per halaman
            'posts' => $postModel->paginate(2, 'post'),
            // Mengambil info navigasi halaman
            'pager' => $postModel->pager
        );

        // MENGIRIM DATA KE: file di 'app/Views/post-index.php'
        //print_r($data['posts']);
        //die();
        return view('post-index', $data);
    }

    /**
     * FUNGSI CREATE (Halaman Tambah Data)
     * Hanya menampilkan form kosong.
     */
    public function create()
    {
        // MENGARAH KE: file di 'app/Views/post-create.php'
        return view('post-create');
    }

    /**
     * FUNGSI STORE (Proses Simpan Data)
     * Mengambil data dari INPUT USER (Form) lalu menyimpannya ke DATABASE.
     */
    public function store()
    {
        // Memuat alat bantu (helper) untuk form dan alamat web (URL)
        helper(['form', 'url']);

        // Melakukan validasi (pengecekan) input user
        $validation = $this->validate([
            'title' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Masukkan Judul Post']
            ],
            'content' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Masukkan Konten Post.']
            ],
        ]);

        if (!$validation) {
            // JIKA GAGAL: Balikkan ke file 'app/Views/post-create.php' dengan pesan error
            return view('post-create', [
                'validation' => $this->validator
            ]);
        } else {
            // JIKA BERHASIL: Hubungkan ke Model untuk simpan data
            $postModel = new PostModel();

            // MENYIMPAN KE DATABASE: Mengambil data dari form $_POST
            $postModel->insert([
                'title'   => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
            ]);

            // Membuat pesan sementara (Flash Message)
            session()->setFlashdata('message', 'Post Berhasil Disimpan');

            // REDIRECT (Pindah Halaman): Kembali ke daftar list (Fungsi Index)
            return redirect()->to(base_url('post'));
        }
    }

/**
     * FUNGSI EDIT (Halaman Edit Data)
     */
    public function edit($id)
    {
        // Hubungkan ke Model
        $postModel = new PostModel();

        // Cari data berdasarkan ID
        $postData = $postModel->find($id);

        // --- TAMBAHAN PENGECEKAN (PENTING) ---
        // Jika data kosong (tidak ketemu), kembalikan ke halaman index
        if (empty($postData)) {
            session()->setFlashdata('message', 'Data tidak ditemukan atau ID salah!');
            return redirect()->to(base_url('post'));
        }

        // Jika data ada, kirim ke View
        $data = array(
            'post' => $postData
        );
        return view('post-edit', $data);
    }

    /**
     * FUNGSI UPDATE (Proses Ubah Data)
     * Mengupdate data lama di DATABASE dengan data baru dari Form.
     */
    public function update($id)
    {
        helper(['form', 'url']);

        // Validasi input
        $validation = $this->validate([
            'title'   => ['rules' => 'required', 'errors' => ['required' => 'Masukkan Judul Post.']],
            'content' => ['rules' => 'required', 'errors' => ['required' => 'Masukkan Konten Post.']],
        ]);

        if (!$validation) {
            $postModel = new PostModel();
            // JIKA GAGAL: Balikkan ke View edit sambil membawa data lama agar form tidak kosong
            return view('post-edit', [
                'post'       => $postModel->find($id),
                'validation' => $this->validator
            ]);
        } else {
            $postModel = new PostModel();

            // UPDATE DATABASE: Cari data berdasarkan ID, lalu timpa dengan data baru dari form
            $postModel->update($id, [
                'title'   => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
            ]);

            session()->setFlashdata('message', 'Post Berhasil Diupdate');
            return redirect()->to(base_url('post'));
        }
    }

    /**
     * FUNGSI DELETE (Proses Hapus Data)
     * Menghapus data permanen dari DATABASE berdasarkan ID.
     */
    public function delete($id)
    {
        $postModel = new PostModel();

        // Cari datanya dulu, jika ada baru hapus
        $post = $postModel->find($id);

        if($post) {
            $postModel->delete($id);

            // Membuat pesan sementara (Flash Message)
            session()->setFlashdata('message', 'Post Berhasil Dihapus');

            // Kembali ke daftar utama
            return redirect()->to(base_url('post'));
        }
    }
}