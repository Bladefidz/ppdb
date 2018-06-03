<?php
namespace Models;

/**
 * PenghasilanModel class
 */
class PenghasilanModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();

        $this->db->table = 't_penghasilan';
        $this->db->pk = 'id_pnghsln';
    }

    public function pilPenghasilan()
    {
        return $this->db->all();
    }
}
