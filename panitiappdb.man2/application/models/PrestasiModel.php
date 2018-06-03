<?php
namespace Models;

/**
 * PrestasiModel class
 */
class PrestasiModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getPilJuara()
    {
        $query = "SELECT * FROM ppdb_prestasi_juara WHERE nilai_juara != 0 ORDER BY no_juara ASC ";
        return $this->db->query($query);
    }

    public function getPilTingkat()
    {
        $query = "SELECT * FROM ppdb_prestasi_tingkat WHERE nilai_tingkat != 0 ORDER BY no_tingkat ASC";
        return $this->db->query($query);
    }

    public function add($data = array())
    {
        $query = "INSERT INTO ppdb_pendaftaran_data_prestasi_juara VALUES(:idPendf, :nml, :ju, :tg)";
        return $this->db->query($query, $data);
    }

    public function update()
    {

    }
}
