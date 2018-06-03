<?php
namespace Models;

/**
*
*/
class SeleksiModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getbyGelId($gelId)
    {
        $query = "SELECT ".
            "CONCAT(
                ppdb_pendaftaran_data.id_validasi, ".
                "LPAD(SUBSTR(ppdb_tahun_ajaran.tahun_ajaran, 3), 3, '0'), ".
                "ppdb_gelombang.gelombang,  ".
                "COALESCE(ppdb_jalur.kode_jalur, ''), ".
                "LPAD(SUBSTR(ppdb_pendaftaran_data.nisn, -4), 4, '0'), ".
                "IF(ppdb_pendaftaran_data.no = 0000, '', ppdb_pendaftaran_data.no)".
            ") as kode, ".
            "ppdb_pendaftaran_data.id_pendaftaran, ".
            "ppdb_pendaftaran_data.nama, ".
            "ppdb_gelombang.gelombang, ".
            "ppdb_pendaftaran_data.id_jalur as id_jalur_pilihan, ".
            "ppdb_jalur.nama_jalur as pilihan, ".
            "ppdb_seleksi.skor_akademik as max_skor_akademik, ".
            "ppdb_seleksi.skor_prestasi as max_skor_prestasi, ".
            "ppdb_seleksi.skor_tes as max_skor_tes, ".
            "@un := (ROUND(((ppdb_pendaftaran_data_akademik.nilai_un_bi+ppdb_pendaftaran_data_akademik.nilai_un_bing+ppdb_pendaftaran_data_akademik.nilai_un_mat+ppdb_pendaftaran_data_akademik.nilai_un_ipa)/400), 2)*ppdb_seleksi.skor_akademik) AS sel_skor_un, ".
            "prestasi.sel_skor_prestasi, ".
            "@tes :=  (ppdb_pendaftaran_data.nilai_tes*ppdb_seleksi.skor_tes) as sel_skor_tes, ".
            "@un+prestasi.sel_skor_prestasi+@tes as skor_total, ".
            "ppdb_penerimaan.id_jalur as id_jalur_penerimaan, ".
            "(SELECT ppdb_jalur.nama_jalur FROM ppdb_jalur WHERE ppdb_jalur.id_jalur = ppdb_penerimaan.id_jalur) as keputusan ".
            "FROM ".
            "ppdb_pendaftaran_data ".
            "LEFT OUTER JOIN ppdb_jalur ".
            "ON(ppdb_pendaftaran_data.id_jalur = ppdb_jalur.id_jalur) ".
            "LEFT OUTER JOIN ppdb_penerimaan ".
            "ON(ppdb_pendaftaran_data.id_pendaftaran = ppdb_penerimaan.id_pendaftaran) ".
            "INNER JOIN ppdb_gelombang ".
            "INNER JOIN ppdb_tahun_ajaran ".
            "INNER JOIN ppdb_pendaftaran_data_akademik ".
            "INNER JOIN (
                SELECT ppdb_pendaftaran_data_prestasi_juara.id_pendaftaran, ".
                "SUM(ppdb_prestasi_juara.nilai_juara*ppdb_prestasi_tingkat.nilai_tingkat) as sel_skor_prestasi ".
                "FROM ppdb_pendaftaran_data_prestasi_juara ".
                "INNER JOIN ppdb_prestasi_juara ".
                "INNER JOIN ppdb_prestasi_tingkat ".
                "ON(
                    ppdb_pendaftaran_data_prestasi_juara.id_prestasi_juara = ppdb_prestasi_juara.id_prestasi_juara ".
                    "AND ppdb_pendaftaran_data_prestasi_juara.id_prestasi_tingkat = ppdb_prestasi_tingkat.id_prestasi_tingkat) ".
                "GROUP BY ppdb_pendaftaran_data_prestasi_juara.id_pendaftaran) as prestasi ".
            "ON(ppdb_pendaftaran_data.id_pendaftaran = prestasi.id_pendaftaran) ".
            "INNER JOIN ppdb_seleksi ".
            "ON(
                 ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel ".
                 "AND ppdb_gelombang.id_tahun_ajaran = ppdb_tahun_ajaran.id_tahun_ajaran ".
                 "AND ppdb_pendaftaran_data.id_pendaftaran = ppdb_pendaftaran_data_akademik.id_pendaftaran ".
                 "AND ppdb_pendaftaran_data.id_seleksi = ppdb_seleksi.id_seleksi) ".
            "WHERE ppdb_pendaftaran_data.id_gel = :gi ".
            "GROUP BY ppdb_pendaftaran_data.id_pendaftaran ".
            "ORDER BY skor_total DESC";
        $param = array(
            'gi' => $gelId
        );
        return $this->db->query($query, $param);
    }

    public function getbyId($id)
    {
        $query = "SELECT ".
            "CONCAT(
                ppdb_pendaftaran_data.id_validasi, ".
                "LPAD(SUBSTR(ppdb_tahun_ajaran.tahun_ajaran, 3), 3, '0'), ".
                "ppdb_gelombang.gelombang,  ".
                "COALESCE(ppdb_jalur.kode_jalur, ''), ".
                "LPAD(SUBSTR(ppdb_pendaftaran_data.nisn, -4), 4, '0'), ".
                "IF(ppdb_pendaftaran_data.no = 0000, '', ppdb_pendaftaran_data.no)".
            ") as kode, ".
            "ppdb_pendaftaran_data.id_pendaftaran, ".
            "ppdb_pendaftaran_data.nama, ".
            "ppdb_pendaftaran_data.id_gel, ".
            "ppdb_gelombang.gelombang, ".
            "ppdb_pendaftaran_data.id_jalur as id_jalur_pilihan, ".
            "ppdb_jalur.nama_jalur as pilihan, ".
            "@un := (ROUND(((ppdb_pendaftaran_data_akademik.nilai_un_bi+ppdb_pendaftaran_data_akademik.nilai_un_bing+ppdb_pendaftaran_data_akademik.nilai_un_mat+ppdb_pendaftaran_data_akademik.nilai_un_ipa)/400), 2)*ppdb_seleksi.skor_akademik) AS skor_un, ".
            "@pres := (ppdb_prestasi_juara.nilai_juara*ppdb_prestasi_tingkat.nilai_tingkat) as skor_prestasi, ".
            "@tes :=  (ppdb_pendaftaran_data.nilai_tes*ppdb_seleksi.skor_tes) AS skor_tes, ".
            "(@un+@pres+@tes) as skor_total, ".
            "ppdb_penerimaan.id_jalur as id_jalur_penerimaan, ".
            "(SELECT ppdb_jalur.nama_jalur FROM ppdb_jalur WHERE ppdb_jalur.id_jalur = ppdb_penerimaan.id_jalur) as keputusan ".
            "FROM ppdb_pendaftaran_data ".
            "LEFT OUTER JOIN ppdb_jalur ".
            "ON(ppdb_pendaftaran_data.id_jalur = ppdb_jalur.id_jalur) ".
            "LEFT OUTER JOIN ppdb_penerimaan ".
            "ON(ppdb_pendaftaran_data.id_pendaftaran = ppdb_penerimaan.id_pendaftaran) ".
            "INNER JOIN ppdb_gelombang ".
            "INNER JOIN ppdb_tahun_ajaran ".
            "INNER JOIN ppdb_pendaftaran_data_akademik ".
            "INNER JOIN ppdb_pendaftaran_data_prestasi_juara ".
            "INNER JOIN ppdb_prestasi_juara ".
            "INNER JOIN ppdb_prestasi_tingkat ".
            "INNER JOIN ppdb_seleksi ".
            "ON (
                 ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel ".
                 "AND ppdb_gelombang.id_tahun_ajaran = ppdb_tahun_ajaran.id_tahun_ajaran ".
                 "AND ppdb_pendaftaran_data.id_pendaftaran = ppdb_pendaftaran_data_akademik.id_pendaftaran ".
                 "AND ppdb_pendaftaran_data.id_seleksi = ppdb_seleksi.id_seleksi ".
                 "AND ppdb_pendaftaran_data.id_pendaftaran = ppdb_pendaftaran_data_prestasi_juara.id_pendaftaran ".
                 "AND ppdb_prestasi_juara.id_prestasi_juara = ppdb_pendaftaran_data_prestasi_juara.id_prestasi_juara ".
                 "AND ppdb_prestasi_tingkat.id_prestasi_tingkat = ppdb_pendaftaran_data_prestasi_juara.id_prestasi_tingkat ".
                 "AND ppdb_pendaftaran_data.id_pendaftaran = :id) ".
            "GROUP BY ppdb_pendaftaran_data.id_pendaftaran ";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function getKuotaGelombang($gelId)
    {
        $query = "SELECT sum(daya_tampung) FROM ppdb_gelombang_jalur WHERE id_gel = :gi";
        $param = array(
            'gi' => $gelId
        );
        return $this->db->query($query, $param);
    }

    public function getKuotaJalur($gelId)
    {
        $query = "SELECT id_jalur, nama_jalur, daya_tampung ".
            "FROM ppdb_gelombang_jalur ".
            "LEFT OUTER JOIN ppdb_jalur ".
            "USING(id_jalur) ".
            "WHERE id_gel = :gi ".
            "ORDER BY daya_tampung";
        $param = array(
            'gi' => $gelId
        );
        return $this->db->query($query, $param);
    }

    public function addKeputusan($idPendaftaran, $idJalur)
    {
        $query = "INSERT INTO ppdb_penerimaan(id_pendaftaran, id_jalur) VALUES (:id, :ji)";
        $param = array(
            'id' => $idPendaftaran,
            'ji' => $idJalur
        );
        return $this->db->query($query, $param);
    }

    public function getKeputusan($id)
    {
        $query = "SELECT ppdb_pendaftaran_data.id_pendaftaran, ppdb_pendaftaran_data.id_gel, ppdb_pendaftaran_data.nama, ".
            "ppdb_penerimaan.id_jalur, ".
            "(SELECT ppdb_jalur.nama_jalur FROM ppdb_jalur WHERE ppdb_jalur.id_jalur = ppdb_penerimaan.id_jalur) as keputusan ".
            "FROM ppdb_pendaftaran_data ".
            "LEFT OUTER JOIN ppdb_jalur ".
            "ON(ppdb_pendaftaran_data.id_jalur = ppdb_jalur.id_jalur) ".
            "LEFT OUTER JOIN ppdb_penerimaan ".
            "ON(ppdb_pendaftaran_data.id_pendaftaran = ppdb_penerimaan.id_pendaftaran) ".
            "WHERE ppdb_pendaftaran_data.id_pendaftaran = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function updateKeputusan($idPendaftaran, $idJalur)
    {
        $query = "UPDATE ppdb_penerimaan SET id_jalur = :ji WHERE id_pendaftaran = :id";
        $param = array(
            'id' => $idPendaftaran,
            'ji' => $idJalur
        );
        return $this->db->query($query, $param);
    }

    public function getDiterima($year)
    {
        $query = "SELECT * FROM ppdb_pendaftaran_data ".
            "RIGHT OUTER JOIN ppdb_penerimaan ".
            "ON(ppdb_pendaftaran_data.id_pendaftaran = ppdb_penerimaan.id_pendaftaran) ".
            "INNER JOIN ppdb_gelombang ".
            "ON(ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel) ".
            "INNER JOIN ppdb_tahun_ajaran ".
            "ON(ppdb_gelombang.id_tahun_ajaran = ppdb_tahun_ajaran.id_tahun_ajaran) ".
            "WHERE ppdb_tahun_ajaran.tahun_ajaran = :y";
        $param = array(
            'y' => $year
        );
        return $this->db->query($query, $param);
    }
}
