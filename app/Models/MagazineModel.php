<?php

namespace App\Models;

use CodeIgniter\Model;

class MagazineModel extends Model
{
    protected $table      = 'magazines';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'description', 'file_path', 'cover_image', 'issue_date','price', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
