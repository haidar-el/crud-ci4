<?php
//namespace menentukan alamat folder ini agar tidak bentrok dengan class lain
namespace App\Models;

//kita mengimpor class model bawaan codeigniter agar bisa menggunakan fitur-fiturnya
use CodeIgniter\Model;

//class postmodel mewarisi (extends) semua kemampuan dari class model
class ArtikelModel extends Model
{
    protected $primaryKey = 'id';
    //$table memberitahu codeigniter tabel mana yang akan diakses di database
    protected $table = "artikel";

    //$allowedFields adalah "satpam" keamanan. hanya kolom di daftar ini
    //yang boleh diisi atau diubah melalui fungsi insert/update otomatis.
    protected $allowedFields = [
        'judul',
        'slug',
        'isi',
        'cover_image',
        'status',
    ];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}