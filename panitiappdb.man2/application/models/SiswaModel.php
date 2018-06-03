<?php
namespace Models;

use Core\Model;

/**
 * SiswaModel class
 */
class SiswaModel extends Model
{

    public function __construct()
    {
        parent::__construct();

        $this->db->table = 'data_siswa';
        $this->db->pk = 'id_siswa';
    }

    public function jumlahSiswa()
    {
        return $this->db->count('s_nama');
    }

    public function semuaData()
    {
        return $this->db->all();
    }
}
