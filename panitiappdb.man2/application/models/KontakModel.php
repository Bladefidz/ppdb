<?php
namespace Models;

/**
*
*/
class KontakModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add($param = array())
    {
        $query = "INSERT INTO ppdb_kontak(nama_kontak, alamat, telepon, hp, email, kategori) ".
            "VALUES(:nk, :al, :tl, :hp, :em, :kt)";
        return $this->db->query($query, $param);
    }

    public function getKontak()
    {
        $query = "SELECT * FROM ppdb_kontak";
        return $this->db->query($query);
    }

    public function getKontakbyId($id)
    {
        $query = "SELECT * FROM ppdb_kontak WHERE id_kontak = $id";
        return $this->db->query($query);
    }

    public function update($param = array())
    {
        $query = "UPDATE ppdb_kontak SET nama_kontak = :nk, alamat = :al, telepon = :tl, hp = :hp, email = :em ".
            "WHERE id_kontak = :id";
        return $this->db->query($query, $param);
    }

    public function delete($id)
    {
        $query = "DELETE FROM ppdb_kontak WHERE id_kontak = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }
}
