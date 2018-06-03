<?php
namespace Models;

/**
 * PrestasiModel class
 */
class PrestasiModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();

        $this->db->table = 't_prestasi';
        $this->db->pk = 'id_prestasi';
    }

    public function pilPrestasi()
    {
        return $this->db->all();
    }
}
