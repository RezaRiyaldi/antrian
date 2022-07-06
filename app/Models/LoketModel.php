<?php

namespace App\Models;
use CodeIgniter\Model;

class LoketModel extends Model {
    protected $table = 'loket';
    protected $primaryKey = 'id_loket';
    protected $useAutoIncrement = TRUE; 
    protected $allowedFields = ['nama_loket', 'pelayanan_id'];
}