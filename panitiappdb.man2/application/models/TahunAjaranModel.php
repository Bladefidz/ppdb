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

    public function get()
    {
        $query = "SELECT * FROM ppdb_tahun_ajaran ORDER BY tahun_ajaran DESC";
        return $this->db->query($query);
    }

    public function getbyId($id)
    {
        $query = "SELECT tahun_ajaran FROM ppdb_tahun_ajaran WHERE id_tahun_ajaran = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function add($param)
    {
        $query = "INSERT INTO ppdb_tahun_ajaran(tahun_ajaran, aktif) VALUES(:thn, :ak)";
        return $this->db->query($query, $param);
    }

    public function update($param)
    {
        $query = "UPDATE ppdb_tahun_ajaran SET tahun_ajaran = :thn ".
            "WHERE id_tahun_ajaran = :id";
        return $this->db->query($query, $param);
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

    public function getThnAjar($yearId)
    {
        $query = "SELECT tahun_ajaran FROM ppdb_tahun_ajaran WHERE id_tahun_ajaran = :yearId";
        $param = array(
            'yearId' => $yearId
        );

        return $this->db->query($query, $param)[0]['tahun_ajaran'];
    }

    public function getActive()
    {
        $query = "SELECT * FROM ppdb_tahun_ajaran WHERE aktif = 1 LIMIT 1";
        return $this->db->query($query);
    }
}
