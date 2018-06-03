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

    public function getPedoman()
    {
        $query = "SELECT pedoman FROM ppdb_info";
        return $this->db->query($query)[0]['pedoman'];
    }

    public function updatePedoman($pedoman)
    {
        $query = "UPDATE ppdb_info SET pedoman = :pd";
        $param = array(
            'pd' => $pedoman
        );

        return $this->db->query($query, $param);
    }

    public function getAlur()
    {
        $query = "SELECT alur FROM ppdb_info";
        return $this->db->query($query)[0]['alur'];
    }

    public function updateAlur($alur)
    {
        $query = "UPDATE ppdb_info SET alur = :al";
        $param = array(
            'al' => $alur
        );

        return $this->db->query($query, $param);
    }
}
