<?php
namespace Models;

/**
*
*/
class TesModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getGelOption($year)
    {
        $query = "SELECT ppdb_gelombang.id_gel, ppdb_gelombang.gelombang, ppdb_gelombang.test_date ".
            "FROM ppdb_gelombang INNER JOIN ppdb_tahun_ajaran ".
            "ON(ppdb_gelombang.id_tahun_ajaran = ppdb_tahun_ajaran.id_tahun_ajaran) ".
            "WHERE ppdb_gelombang.test_date != 0000-00-00 AND ppdb_tahun_ajaran.tahun_ajaran = :y";
        $param = array(
            'y' => $year
        );
        return $this->db->query($query, $param);
    }

    public function show($gelId)
    {
        $query = "SELECT ".
            "pd.id_pendaftaran, ".
            "ta.tahun_ajaran, ".
            "g.id_gel, ".
            "g.gelombang, ".
            "CONCAT(
                pd.id_validasi, ".
                "LPAD(SUBSTR(ta.tahun_ajaran, 3), 3, '0'), ".
                "g.gelombang,  ".
                "COALESCE(j.kode_jalur, ''), ".
                "LPAD(SUBSTR(pd.nisn, -4), 4, '0'), ".
                "IF(pd.no = 0000, '', pd.no)".
            ") as kode, ".
            "pd.nama, ".
            "pd.nilai_tes ".
            "FROM ppdb_pendaftaran_data as pd ".
            "LEFT OUTER JOIN ppdb_jalur as j ".
            "ON(pd.id_jalur = j.id_jalur) ".
            "INNER JOIN ppdb_validasi as v ".
            "INNER JOIN ppdb_gelombang as g ".
            "INNER JOIN ppdb_tahun_ajaran as ta ".
            "ON(
                pd.id_validasi = v.id_validasi ".
                "AND pd.id_gel = g.id_gel ".
                "AND g.id_tahun_ajaran = ta.id_tahun_ajaran ".
                "AND pd.id_validasi = v.id_validasi) ".
            "WHERE pd.id_validasi = :vi AND pd.id_gel = :gi";
        $param = array(
            'gi' => $gelId,
            'vi' => 3
        );
        return $this->db->query($query, $param);
    }

    public function get($id)
    {
        $query = "SELECT ".
            "pd.id_pendaftaran, ".
            "CONCAT(
                pd.id_validasi, ".
                "LPAD(SUBSTR(ta.tahun_ajaran, 3), 3, '0'), ".
                "g.gelombang,  ".
                "COALESCE(j.kode_jalur, ''), ".
                "LPAD(SUBSTR(pd.nisn, -4), 4, '0'), ".
                "IF(pd.no = 0000, '', pd.no)".
            ") as kode, ".
            "pd.nama, ".
            "pd.nilai_tes, ".
            "pd.id_gel ".
            "FROM ppdb_pendaftaran_data as pd ".
            "LEFT OUTER JOIN ppdb_jalur as j ".
            "ON(pd.id_jalur = j.id_jalur) ".
            "INNER JOIN ppdb_validasi as v ".
            "INNER JOIN ppdb_gelombang as g ".
            "INNER JOIN ppdb_tahun_ajaran as ta ".
            "ON(
                pd.id_validasi = v.id_validasi ".
                "AND pd.id_gel = g.id_gel ".
                "AND g.id_tahun_ajaran = ta.id_tahun_ajaran ".
                "AND pd.id_validasi = v.id_validasi) ".
            "WHERE pd.id_pendaftaran = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function update($nt, $id)
    {
        $query = "UPDATE ppdb_pendaftaran_data ".
            "SET nilai_tes = :nt ".
            "WHERE id_pendaftaran = :id";
        $param = array(
            'nt' => $nt,
            'id' => $id
        );
        return $this->db->query($query, $param);
    }
}
