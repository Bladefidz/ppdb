<?php
namespace Models;

/**
*
*/
class SekolahAsalModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getSklId($namaSkl, $sklKab)
    {
        $query = "SELECT id_asal_skl FROM ppdb_pendaftaran_data_asal_sekolah ".
            "WHERE nama_skl=:ns AND kabupaten_skl=:ks";
        $param = array(
            'ns' => $namaSkl,
            'ks' => $sklKab
        );

        $dataSkl = $this->db->query($query, $param);

        if ($this->db->numRows > 0) {
            return $dataSkl[0]['id_asal_skl'];
        } else {
            return null;
        }
    }

    public function inputDataSekolah($namaSkl, $sklKab)
    {
        $query = "INSERT INTO ppdb_pendaftaran_data_asal_sekolah (nama_skl, kabupaten_skl) ".
            "VALUES (:ns, :ks)";
        $param = array(
            'ns' => $namaSkl,
            'ks' => $sklKab
        );

        return $this->db->query($query, $param);
    }
}
