<?php
namespace Models;

/**
*
*/
class TahunAjaranModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getActive()
    {
        $query = "SELECT * FROM ppdb_tahun_ajaran WHERE aktif = 1 LIMIT 1";
        return $this->db->query($query);
    }

    public function checkThnAjar($year)
    {
        $query = "SELECT * FROM ppdb_tahun_ajaran WHERE tahun_ajaran = :year";
        $param = array(
            'year' => $year
        );

        return $this->db->query($query, $param);
    }

    public function getThnAjarId($year)
    {
        $yearId = $this->checkThnAjar($year)[0]['id_tahun_ajaran'];

        return $yearId;
    }
}
