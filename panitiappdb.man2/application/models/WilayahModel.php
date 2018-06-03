<?php

namespace Models;

/**
 *
 */
class WilayahModel extends \Core\Model
{
    public function __construct()
    {
        parent::__construct();

        $this->db->table = "wilayah";
        $this->db->pk = "lokasi_ID";
    }

    public function getWilayah()
    {
        $query = 'SELECT * FROM wilayah '.
            'WHERE lokasi_kabupatenkota=:lkb AND lokasi_kecamatan=:lkc AND lokasi_kelurahan=:lkl '.
            'ORDER BY lokasi_nama';
        $param = array(
            'lkb' => 0,
            'lkc' => 0,
            'lkl' => 0
        );
        return $this->db->query($query, $param);
    }

    public function getKota($prov = '')
    {
        $this->provSelected = $prov;

        $query = 'SELECT * FROM wilayah '.
            'WHERE lokasi_propinsi=:lpro and lokasi_kecamatan=:lkc and lokasi_kelurahan=:lkl and lokasi_kabupatenkota!=:lkb '.
            'ORDER BY lokasi_nama';
        $param = array(
            'lpro' => $prov,
            'lkb' => 0,
            'lkc' => 0,
            'lkl' => 0
        );
        return $this->db->query($query, $param);
    }

    public function getKec($prov = '', $kota = '')
    {
        echo $prov.'&'.$kota;
        $query = 'SELECT * FROM wilayah '.
            'WHERE lokasi_propinsi=:lpro and lokasi_kecamatan!=:lkc and lokasi_kelurahan=:lkl and lokasi_kabupatenkota=:lkb '.
            'ORDER BY lokasi_nama';

        $param = array(
            'lpro' => $prov,
            'lkb' => $kota,
            'lkc' => 0,
            'lkl' => 0
        );
        return $this->db->query($query, $param);
    }

    public function getKel($prov = '', $kota = '', $kec = '')
    {
        $query = "SELECT * FROM wilayah ".
            "WHERE lokasi_propinsi=:lpro and lokasi_kecamatan=:lkc and lokasi_kelurahan!=:lkl and lokasi_kabupatenkota=:lkb ".
            "ORDER BY lokasi_nama";
        $param = array(
            'lpro' => $prov,
            'lkb' => $kota,
            'lkc' => $kec,
            'lkl' => 0
        );
        return $this->db->query($query, $param);
    }
}
