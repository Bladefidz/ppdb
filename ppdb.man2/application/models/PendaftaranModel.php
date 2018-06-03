<?php

namespace Models;

/**
 * Pendaftaran model class
 */
class PendaftaranModel extends \Core\Model
{
     private $baseJoinQuery = "SELECT * FROM ppdb_pendaftaran_data ".
        "JOIN ppdb_gelombang JOIN ppdb_jalur JOIN ppdb_pendaftaran_data_akademik ".
        "JOIN ppdb_pendaftaran_data_prestasi_juara JOIN ppdb_pendaftaran_data_asal_sekolah JOIN ppdb_validasi ".
        "WHERE ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel ".
        "AND ppdb_pendaftaran_data.id_jalur = ppdb_jalur.id_jalur ".
        "AND ppdb_pendaftaran_data_akademik.id_pendaftaran = ppdb_pendaftaran_data.id_pendaftaran ".
        "AND ppdb_pendaftaran_data.id_asal_skl = ppdb_pendaftaran_data_asal_sekolah.id_asal_skl ".
        "AND ppdb_pendaftaran_data.id_validasi = ppdb_validasi.id_validasi ";

    public function __construct()
    {
        parent::__construct();
    }

    public function getbyId($id)
    {
        $query = $this->baseJoinQuery."AND ppdb_pendaftaran_data.id_pendaftaran = :id";
        $param = array(
            'id' => $id,
        );

        return $this->db->query($query, $param);
    }

    public function getbyNisn($nisn)
    {
        $query = $this->baseJoinQuery."AND ppdb_pendaftaran_data.nisn = :nisn";
        $param = array(
            'nisn' => $nisn,
        );

        return $this->db->query($query, $param);
    }

    public function getbyIdNisnYid($id, $nisn, $yearId)
    {
        $query = $this->baseJoinQuery."AND ppdb_pendaftaran_data.id_pendaftaran = :id AND ppdb_pendaftaran_data.nisn = :nisn AND ppdb_gelombang.id_tahun_ajaran=:yi";
        $param = array(
            'id' => $id,
            'nisn' => $nisn,
            'yi' => $yearId
        );

        return $this->db->query($query, $param);
    }

    public function getbyYidGid($yearId, $gelId)
    {
        $query = $this->baseJoinQuery."AND ppdb_gelombang.id_tahun_ajaran=:yi AND ppdb_gelombang.id_gel=:gi";
        $param = array(
            'yi' => $yearId,
            'gi' => $gelId
        );
        return $this->db->query($query, $param);
    }

    public function register($data)
    {
        // pantau
        $query = "UPDATE ppdb_pendaftaran_data ".
            "SET id_pendaftaran = :newId, id_jalur = :ij, id_validasi = :iv, jk = :jk, ".
            "tmp_lahir = :tml, tgl_lahir = :tgl, alamat = :al, rt = :rt, rw = :rw, ".
            "kelurahan = :kl, kecamatan = :kc, kabupaten = :kb, provinsi = :pv, ".
            "no_telp = :nt, no_hp = :nh, nama_ayah = :nma, ".
            "nama_ibu = :nmi, pekerjaan_ayah = :pka, pekerjaan_ibu = :pki ".
            "WHERE id_pendaftaran = :oldId";
        return $this->db->query($query, $data);
    }
}
