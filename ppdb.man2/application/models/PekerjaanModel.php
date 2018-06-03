<?php
namespace Models;

/**
 * PekerjaanModel class - Pilihan jenis pekerjaan untuk Ayah dan Ibu
 *
 * table: t_pkj
 * column
 *  id_pkj: id pekerjaan
 *  pkj: jenis pekerjaan
 *  kategori
 *      0 -> Jenis pekerjaan untuk ayah dan Ibu
 *      1 -> Jenis pekerjaan untuk ayah
 *      2 -> Jenis pekerjaan untuk ibu
 *
 */
class PekerjaanModel extends \Core\Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil function - mengambil pilihan pekerjaan
     *
     * @param kategori - Integer
     */
    private function ambil($kategori = 0)
    {
        $query = 'SELECT id_pkj, pkj FROM ppdb_pendaftaran_ortu_pekerjaan WHERE kategori = :kt';
        $param = array('kt' => $kategori);
        return $this->db->query($query, $param);
    }

    private function ambilPilihan($kategori)
    {
        return array_merge($this->ambil($kategori), $this->ambil());
    }

    public function pilPkjAyah()
    {
        return $this->ambilPilihan(1);
    }

    public function pilPkjIbu()
    {
        return $this->ambilPilihan(2);
    }
}
