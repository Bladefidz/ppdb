<?php
namespace Models;

/**
 * PendidikanModel class
 */
class PendidikanModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();

        $this->db->table = 't_pendidikan';
        $this->db->pk = 'id_penddk';
    }

    public function pilPendidikan()
    {
        return $this->db->all();
    }

    public function ubahPilihan()
    {
        # code...
    }
}
