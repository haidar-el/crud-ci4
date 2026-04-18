<?php

namespace App\Models;

use CodeIgniter\Model;

class OprecModel extends Model
{
    protected $table            = 'oprec';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    protected $allowedFields    = [
        'nama', 
        'nim', 
        'jurusan', 
        'no_hp', 
        'email', 
        'divisi', 
        'alasan', 
        'berkas_cv', 
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nama'      => 'required',
        'nim'       => 'required',
        'jurusan'   => 'required',
        'no_hp'     => 'required',
        'email'     => 'required|valid_email',
        'divisi'    => 'required',
        'alasan'    => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
