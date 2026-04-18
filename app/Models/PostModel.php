<?php 

// Namespace menentukan "alamat" folder file ini agar tidak bentrok dengan class lain
namespace App\Models; 

// Kita mengimpor class Model bawaan CodeIgniter agar bisa menggunakan fitur-fiturnya
use CodeIgniter\Model;

// Class PostModel mewarisi (extends) semua kemampuan dari class Model
class PostModel extends Model
{
    // $table memberi tahu CodeIgniter tabel mana yang akan diakses di database
    protected $table = "posts";

    // $allowedFields adalah "satpam" keamanan. Hanya kolom di daftar ini 
    // yang boleh diisi atau diubah melalui fungsi insert/update otomatis.
    protected $allowedFields = [
        "title",
        "content"
    ];
}