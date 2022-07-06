<?php

namespace App\Models;
use CodeIgniter\Model;

class AntrianModel extends Model {
    protected $table = 'antrian';
    protected $primaryKey = 'id_antrian';
    protected $useAutoIncrement = TRUE; 
    protected $allowedFields = ['no_antrian', 'status', 'waktu_panggil', 'waktu_selesai', 'created_at', 'pelayanan_id', 'loket_id'];
}