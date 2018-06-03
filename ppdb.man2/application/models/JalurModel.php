<?php

namespace Models;

/**
 *
 */
class JalurModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();

        $this->thnAjarModel = new \Models\TahunAjaranModel();
    }

    public function getJalur()
    {
        $query = "SELECT * FROM ppdb_jalur";
        return $this->db->query($query);
    }

    public function getbyId($id)
    {
        $query = "SELECT * FROM ppdb_jalur WHERE id_jalur = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function getJalurbyGelid($gelId)
    {
        $query = "SELECT * FROM ppdb_jalur INNER JOIN ppdb_gelombang_jalur INNER JOIN ppdb_gelombang ".
            "WHERE ppdb_jalur.id_jalur = ppdb_gelombang_jalur.id_jalur ".
            "AND ppdb_gelombang.id_gel = ppdb_gelombang_jalur.id_gel ".
            "AND ppdb_gelombang.id_gel = :ig";
        $param = array(
            'ig' => $gelId
        );

        return $this->db->query($query, $param);
    }

    public function getJalurYear($year)
    {
        $query = "SELECT * FROM ppdb_jalur INNER JOIN ppdb_gelombang_jalur INNER JOIN ppdb_gelombang ".
            "WHERE ppdb_jalur.id_jalur = ppdb_gelombang_jalur.id_jalur ".
            "AND ppdb_gelombang.id_gel = ppdb_gelombang_jalur.id_gel ".
            "AND ppdb_gelombang.id_tahun_ajaran = :idTh";
        $param = array(
            'idTh' => $this->thnAjarModel->getThnAjarId($year)
        );

        return $this->db->query($query, $param);
    }

    public function getJalurbyYidG($yearId, $gel)
    {
        $query = "SELECT * FROM ppdb_jalur INNER JOIN ppdb_gelombang_jalur INNER JOIN ppdb_gelombang ".
            "WHERE ppdb_jalur.id_jalur = ppdb_gelombang_jalur.id_jalur ".
            "AND ppdb_gelombang.id_gel = ppdb_gelombang_jalur.id_gel ".
            "AND ppdb_gelombang.id_tahun_ajaran = :idTh ".
            "AND ppdb_gelombang.gelombang = :gel";
        $param = array(
            'idTh' => $yearId,
            'gel' => $gel
        );

        return $this->db->query($query, $param);
    }

    public function getTotalPagu($year)
    {
        $query = "SELECT SUM(daya_tampung) as pagu FROM ppdb_jalur INNER JOIN ppdb_gelombang_jalur INNER JOIN ppdb_gelombang ".
            "WHERE ppdb_jalur.id_jalur = ppdb_gelombang_jalur.id_jalur ".
            "AND ppdb_gelombang.id_gel = ppdb_gelombang_jalur.id_gel ".
            "AND ppdb_gelombang.id_tahun_ajaran = :idTh";
        $param = array(
            'idTh' => $this->thnAjarModel->getThnAjarId($year)
        );

        return $this->db->query($query, $param);
    }
}
