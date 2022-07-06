<?php
namespace App\Models;

use CodeIgniter\Model;

class PelayananModel extends Model {
    protected $table = 'pelayanan';
    protected $primaryKey = 'id_pelayanan';
    protected $setAutoIncrement = TRUE;
    protected $allowedFields = ['kode_pelayanan', 'nama_pelayanan'];
}