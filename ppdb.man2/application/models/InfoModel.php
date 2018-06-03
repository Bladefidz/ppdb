<?php
namespace Models;

/**
*
*/
class InfoModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAlur()
    {
        $query = "SELECT alur FROM ppdb_info";
        return $this->db->query($query)[0]['alur'];
    }

    public function getPedoman()
    {
        $query = "SELECT pedoman FROM ppdb_info";
        return $this->db->query($query)[0]['pedoman'];
    }
}
