<?php
namespace Models;

/**
*
*/
class ContactModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getKonPanitia() {
        $query = 'SELECT * FROM ppdb_info WHERE kategori = :kt';
        $param = array('kt' => 1);
        return $this->db->query($query, $param);
    }
}
