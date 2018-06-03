<?php
namespace models;

/**
*
*/
class PPDBOnlineModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVerifikasibyId($id)
    {
        $query = "SELECT * FROM ppdb_pendaftaran_data, ".
            "ppdb_gelombang, ppdb_pendaftaran_data_akademik, ppdb_pendaftaran_data_asal_sekolah, ppdb_validasi ".
            "WHERE ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel ".
            "AND ppdb_pendaftaran_data_akademik.id_pendaftaran = ppdb_pendaftaran_data.id_pendaftaran ".
            "AND ppdb_pendaftaran_data.id_asal_skl = ppdb_pendaftaran_data_asal_sekolah.id_asal_skl ".
            "AND ppdb_pendaftaran_data.id_validasi = ppdb_validasi.id_validasi ".
            "AND ppdb_pendaftaran_data.id_pendaftaran=:id ".
            "AND ppdb_pendaftaran_data.id_validasi=:vi";
        $param = array(
            'id' => $id,
            'vi' => 1
        );
        return $this->db->query($query, $param);
    }

    public function getLastNoPendaftaran($yearId)
    {
        $query = "SELECT no FROM ppdb_pendaftaran_data, ppdb_gelombang ".
            "WHERE ppdb_gelombang.id_tahun_ajaran=:yi AND ppdb_pendaftaran_data.id_validasi=:vi ".
            "ORDER BY no DESC LIMIT 1";
        $param = array(
            'yi' => $yearId,
            'vi' => 3
        );

        $no = $this->db->query($query, $param);

        if (empty($no)) {
            return "0";
        } else {
            return $no[0]['no'];
        }
    }

    public function pendaftaran($param = array())
    {
        // fotone gorong;
        $query = "UPDATE ppdb_pendaftaran_data ".
            "SET id_validasi = :iv, id_jalur = :ij, id_seleksi = :is, no = :no, jk = :jk, ".
            "tmp_lahir = :tml, tgl_lahir = :tgl, alamat = :al, rt = :rt, rw = :rw, ".
            "lokasi_kelurahan = :kl, lokasi_kecamatan = :kc, lokasi_kabupatenkota = :kb, lokasi_provinsi = :pv, ".
            "no_telp = :nt, no_hp = :nh, nama_ayah = :nma, ".
            "nama_ibu = :nmi, pekerjaan_ayah = :pka, pekerjaan_ibu = :pki ".
            "WHERE id_pendaftaran = :id";
        return $this->db->query($query, $param);
    }

    public function detail($id)
    {
        $query = "SELECT ".
            "pd.id_pendaftaran, ".
            "pd.id_validasi, ".
            "CONCAT(
                pd.id_validasi, ".
                "LPAD(SUBSTR(ta.tahun_ajaran, 3), 3, '0'), ".
                "g.gelombang,  ".
                "COALESCE(j.kode_jalur, ''), ".
                "LPAD(SUBSTR(pd.nisn, -4), 4, '0'), ".
                "IF(pd.no = 0000, '', pd.no)".
            ") as kode, ".
            "pd.nisn, ".
            "pd.nama, ".
            "pdas.nama_skl, ".
            "g.gelombang, ".
            "ta.tahun_ajaran, ".
            "COALESCE(j.nama_jalur, '') as nama_jalur, ".
            "COALESCE(pd.nama_ayah, '') as nama_ayah ".
            "from ppdb_pendaftaran_data as pd ".
            "INNER JOIN ppdb_gelombang as g ".
            "INNER JOIN ppdb_tahun_ajaran as ta ".
            "INNER JOIN ppdb_pendaftaran_data_asal_sekolah as pdas ".
                "ON(
                    pd.id_gel = g.id_gel ".
                    "AND g.id_tahun_ajaran = ta.id_tahun_ajaran ".
                    "AND pd.id_asal_skl = pdas.id_asal_skl
                ) ".
            "LEFT OUTER JOIN ppdb_jalur as j ".
                "ON(
                    pd.id_jalur = j.id_jalur
                ) ".
            "WHERE pd.id_pendaftaran = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function pengumuman($id)
    {
        $query = "SELECT * FROM ppdb_pendaftaran_data ".
            "RIGHT OUTER JOIN ppdb_penerimaan ".
            "ON(ppdb_pendaftaran_data.id_pendaftaran = ppdb_penerimaan.id_pendaftaran) ".
            "INNER JOIN ppdb_gelombang ".
            "ON(ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel) ".
            "INNER JOIN ppdb_tahun_ajaran ".
            "ON(ppdb_gelombang.id_tahun_ajaran = ppdb_tahun_ajaran.id_tahun_ajaran) ".
            "WHERE ppdb_pendaftaran_data.id_pendaftaran = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function cari($nisn)
    {
        $query = "SELECT ".
            "pd.id_pendaftaran, ".
            "pd.id_validasi, ".
            "CONCAT(
                pd.id_validasi, ".
                "LPAD(SUBSTR(ta.tahun_ajaran, 3), 3, '0'), ".
                "g.gelombang,  ".
                "COALESCE(j.kode_jalur, ''), ".
                "LPAD(SUBSTR(pd.nisn, -4), 4, '0'), ".
                "IF(pd.no = 0000, '', pd.no)".
            ") as kode, ".
            "pd.nisn, ".
            "pd.nama, ".
            "pdas.nama_skl, ".
            "g.gelombang, ".
            "ta.tahun_ajaran, ".
            "COALESCE(j.nama_jalur, '') as pilihan, ".
            "p.id_jalur as status_terima ".
            "from ppdb_pendaftaran_data as pd ".
            "INNER JOIN ppdb_gelombang as g ".
            "INNER JOIN ppdb_tahun_ajaran as ta ".
            "INNER JOIN ppdb_pendaftaran_data_asal_sekolah as pdas ".
                "ON(
                    pd.id_gel = g.id_gel ".
                    "AND g.id_tahun_ajaran = ta.id_tahun_ajaran ".
                    "AND pd.id_asal_skl = pdas.id_asal_skl
                ) ".
            "LEFT OUTER JOIN ppdb_jalur as j ".
                "ON(
                    pd.id_jalur = j.id_jalur
                ) ".
            "LEFT OUTER JOIN ppdb_penerimaan as p ".
                "ON(
                    pd.id_pendaftaran = p.id_pendaftaran
                ) ".
            "WHERE pd.nisn = :nisn";
        $param = array(
            'nisn' => $nisn
        );
        return $this->db->query($query, $param);
    }

    public function getDiterima($id)
    {
        $query = "SELECT * FROM ppdb_pendaftaran_data ".
            "LEFT OUTER JOIN ppdb_penerimaan ".
            "ON(ppdb_pendaftaran_data.id_pendaftaran = ppdb_penerimaan.id_pendaftaran) ".
            "INNER JOIN ppdb_gelombang ".
            "ON(ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel) ".
            "INNER JOIN ppdb_tahun_ajaran ".
            "ON(ppdb_gelombang.id_tahun_ajaran = ppdb_tahun_ajaran.id_tahun_ajaran) ".
            "WHERE ppdb_pendaftaran_data = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }
}
