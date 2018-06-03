<?php
namespace Models;

/**
*
*/
class AkademikModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add($data = array())
    {
        $query = "INSERT INTO ppdb_pendaftaran_data_akademik(id_pendaftaran, nilai_un_bi, nilai_un_bing, nilai_un_mat, nilai_un_ipa) ".
            "VALUES(:idPndf, :nbi, :nbing, :nmat, :nipa)";
        return $this->db->query($query, $data);
    }
}
