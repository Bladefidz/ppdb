<?php

namespace Models;

/**
 *
 */
class GelombangJalurModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getbyYearId($yearId)
    {
        $query = "SELECT * FROM ppdb_gelombang_jalur JOIN ppdb_gelombang, ppdb_jalur ".
            "WHERE ppdb_gelombang_jalur.id_gel = ppdb_gelombang.id_gel AND ppdb_gelombang_jalur.id_jalur = ppdb_jalur.id_jalur AND ppdb_gelombang.id_tahun_ajaran = :yi";
        $param = array(
            'yi' => $yearId
        );
        return $this->db->query($query, $param);
    }
}
