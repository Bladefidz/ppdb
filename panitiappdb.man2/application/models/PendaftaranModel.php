<?php
namespace Models;

/**
 * Pendaftaran model class
 */
class PendaftaranModel extends \Core\Model
{
    private $baseJoinQuery = "SELECT * FROM ppdb_pendaftaran_data, ppdb_gelombang, ppdb_jalur, ppdb_pendaftaran_data_akademik, ppdb_pendaftaran_data_asal_sekolah, ppdb_validasi WHERE ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel AND ppdb_pendaftaran_data.id_jalur = ppdb_jalur.id_jalur AND ppdb_pendaftaran_data_akademik.id_pendaftaran = ppdb_pendaftaran_data.id_pendaftaran AND ppdb_pendaftaran_data.id_asal_skl = ppdb_pendaftaran_data_asal_sekolah.id_asal_skl AND ppdb_pendaftaran_data.id_validasi = ppdb_validasi.id_validasi ";

    public function __construct()
    {
        parent::__construct();
    }

    public function test($input)
    {
        $query = "INSERT INTO ppdb_test(test) VALUES (:test)";
        $this->db->query($query, $input);
    }

    public function getLastId()
    {
        // $query = "SELECT id_pendaftaran FROM ppdb_pendaftaran_data ORDER BY id_pendaftaran DESC LIMIT 1";
        // return $this->db->query($query)[0]['id_pendaftaran'];
        return $this->db->lastInsertId();
    }

    public function getVerifikasi($yearId)
    {
        $query = "SELECT * FROM ppdb_pendaftaran_data, ".
            "ppdb_gelombang, ppdb_pendaftaran_data_akademik, ppdb_pendaftaran_data_asal_sekolah, ppdb_validasi ".
            "WHERE ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel ".
            "AND ppdb_pendaftaran_data_akademik.id_pendaftaran = ppdb_pendaftaran_data.id_pendaftaran ".
            "AND ppdb_pendaftaran_data.id_asal_skl = ppdb_pendaftaran_data_asal_sekolah.id_asal_skl ".
            "AND ppdb_pendaftaran_data.id_validasi = ppdb_validasi.id_validasi ".
            "AND ppdb_gelombang.id_tahun_ajaran=:yi AND ppdb_pendaftaran_data.id_validasi=:vi";
        $param = array(
            'yi' => $yearId,
            'vi' => 1
        );
        return $this->db->query($query, $param);
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

    public function getPrestasi($id) {
        $query = "SELECT * FROM ppdb_pendaftaran_data_prestasi_juara WHERE id_pendaftaran = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }


    public function getIdbyNisn($nisn)
    {
        $query = "SELECT id_pendaftaran FROM ppdb_pendaftaran_data WHERE nisn = :nisn LIMIT 1";
        $param = array(
            'nisn' => $nisn
        );
        return $this->db->query($query, $param)[0]['id_pendaftaran'];
    }

    public function getNoDescbyYId($yearId)
    {
        $query = "SELECT no_pendaftaran FROM ppdb_pendaftaran_data JOIN ppdb_gelombang WHERE id_tahun_ajaran = :yi ".
            "ORDER BY no_pendaftaran DESC LIMIT 1";
        $param = array(
            'yi' => $yearId
        );
        return $this->db->query($query, $param)[0]['no_pendaftaran'];
    }

    public function getbyId($id)
    {
        $query = $this->baseJoinQuery."AND ppdb_pendaftaran_data.id_pendaftaran = :id";
        $param = array(
            'id' => $id,
        );
        return $this->db->query($query, $param);
    }

    public function getbyGelId($gelId)
    {
        $query = "SELECT * FROM ppdb_pendaftaran_data LEFT OUTER JOIN ppdb_gelombang USING (id_gel) ".
            "WHERE ppdb_pendaftaran_data.id_gel = :idGel";
        $param = array(
            'idgel' => $gelId,
        );
        return $this->db->query($query, $param);
    }

    public function getbyYearId($yearId)
    {
        $query = $this->baseJoinQuery."AND ppdb_gelombang.id_tahun_ajaran=:yi";
        $param = array(
            'yi' => $yearId,
        );
        return $this->db->query($query, $param);
    }

    public function getbyYidVid($yearId, $valId)
    {
        $query = $this->baseJoinQuery."AND ppdb_gelombang.id_tahun_ajaran=:yi AND ppdb_pendaftaran_data.id_validasi=:vi";
        $param = array(
            'yi' => $yearId,
            'vi' => $valId
        );
        return $this->db->query($query, $param);
    }

    public function getbyYidGidVid($yearId, $gelId, $ValId = null)
    {
        $query = $this->baseJoinQuery."AND ppdb_gelombang.id_tahun_ajaran=:yi ";

        if (!empty($gelId)) {
            $query .= "AND ppdb_pendaftaran_data.id_gel=:gi";
            $param = array(
                'yi' => $yearId,
                'gi' => $gelId
            );
        } elseif (!empty($valId)) {
            $query = "AND ppdb_pendaftaran_data.id_gel=:gi ";
            $query .= "AND ppdb_pendaftaran_data.id_validasi=:vi";
            $param = array(
                'yi' => $yearId,
                'gi' => $gelId,
                'vi' => $valId
            );
        } else {
            $param = array(
                'yi' => $yearId
            );
        }

        return $this->db->query($query, $param);
    }

    public function getAkademik($yearId, $gel, $jurId)
    {
        $query = $this->baseJoinQuery."AND ppdb_gelombang.id_tahun_ajaran=:yi AND ppdb_gelombang.gelombang=:g AND ppdb_jalur.id_jalur=:ji AND ppdb_pendaftaran_data.id_validasi=:vi";
        $param = array(
            'yi' => $yearId,
            'g' => $gel,
            'ji' => $jurId,
            'vi' => 3
        );
        return $this->db->query($query, $param);
    }

    public function verifikasi($data = array())
    {
        $query = "INSERT INTO ppdb_pendaftaran_data(nilai_tes, id_gel, id_validasi, id_asal_skl, nisn, nama) ".
            "VALUES(:nt, :idGel, :idVal, :idSkl, :nisn, :nama)";

        return $this->db->query($query, $data);
    }

    public function wasVerified($param = array())
    {
        $query = "SELECT * ".
            "FROM ppdb_pendaftaran_data as pd ".
            "LEFT OUTER JOIN ppdb_gelombang as g ".
                "ON(pd.id_gel = g.id_gel)".
            "INNER JOIN ppdb_tahun_ajaran as ta ".
                "ON(g.id_tahun_ajaran = ta.id_tahun_ajaran) ".
            "WHERE pd.nisn = :nisn AND g.gelombang = :gel AND ta.tahun_ajaran = :thn";

        return $this->db->query($query, $param);
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

    public function getPendaftaran($yearId)
    {
        $query = "SELECT * FROM ppdb_pendaftaran_data, ".
            "ppdb_jalur, ppdb_gelombang, ppdb_pendaftaran_data_akademik, ppdb_pendaftaran_data_asal_sekolah, ppdb_validasi ".
            "WHERE ppdb_pendaftaran_data.id_jalur = ppdb_jalur.id_jalur ".
            "AND ppdb_pendaftaran_data.id_gel = ppdb_gelombang.id_gel ".
            "AND ppdb_pendaftaran_data_akademik.id_pendaftaran = ppdb_pendaftaran_data.id_pendaftaran ".
            "AND ppdb_pendaftaran_data.id_asal_skl = ppdb_pendaftaran_data_asal_sekolah.id_asal_skl ".
            "AND ppdb_pendaftaran_data.id_validasi = ppdb_validasi.id_validasi ".
            "AND ppdb_gelombang.id_tahun_ajaran=:yi AND ppdb_pendaftaran_data.id_validasi=:vi";
        $param = array(
            'yi' => $yearId,
            'vi' => 3
        );
        return $this->db->query($query, $param);
    }

    public function tinjauan($thn, $valId)
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
            "COALESCE(j.nama_jalur, '') as nama_jalur ".
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
            "WHERE ta.tahun_ajaran = :t AND pd.id_validasi = :vi ORDER BY kode DESC";
        $param = array(
            't' => $thn,
            'vi' => $valId
        );
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

    public function numbyGelId($gelId)
    {
        $query = "SELECT COUNT(nama) as jml FROM ppdb_pendaftaran_data LEFT OUTER JOIN ppdb_gelombang USING (id_gel) ".
            "WHERE ppdb_pendaftaran_data.id_gel = :idgel";
        $param = array(
            'idgel' => $gelId,
        );
        return $this->db->query($query, $param)[0]['jml'];
    }

    public function numbyYearId($yearId)
    {
        $query = "SELECT COUNT(nama) AS p FROM ppdb_pendaftaran_data LEFT OUTER JOIN ppdb_gelombang ".
            "USING (id_gel) WHERE ppdb_gelombang.id_tahun_ajaran=:yi";
        $param = array(
            'yi' => $yearId,
        );
        return $this->db->query($query, $param)[0]['p'];
    }

    public function numbyYidVid($yearId, $validId)
    {
        $query = "SELECT COUNT(nama) AS p FROM ppdb_pendaftaran_data JOIN ppdb_gelombang JOIN ppdb_validasi ".
            "WHERE ppdb_pendaftaran_data.id_gel=ppdb_gelombang.id_gel AND ppdb_pendaftaran_data.id_validasi=ppdb_validasi.id_validasi ".
            "AND ppdb_gelombang.id_tahun_ajaran=:yi AND ppdb_pendaftaran_data.id_validasi=:vi";
        $param = array(
            'yi' => $yearId,
            'vi' => $validId
        );
        return $this->db->query($query, $param)[0]['p'];
    }

    public function updateVerifikasi($param)
    {
        $query = "UPDATE ".
            "ppdb_pendaftaran_data as pd, ".
            "ppdb_gelombang as g, ".
            "ppdb_pendaftaran_data_akademik as pda, ".
            "ppdb_pendaftaran_data_asal_sekolah as pdas, ".
            "ppdb_validasi as v ".
            "WHERE pd.id_gel = g.id_gel ".
            "AND pda.id_pendaftaran = pd.id_pendaftaran ".
            "AND pd.id_asal_skl = pdas.id_asal_skl ".
            "AND pd.id_validasi = v.id_validasi ".
            "SET ".
            "pd.id_gel=:gid, ".
            "pd.id_asal_skl=:sid, ".
            "pd.nisn=:nisn, ".
            "pd.nama=:nm, ".
            "WHERE ppdb_pendaftaran_data.id_pendaftaran=:id ";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function updatePrestasi()
    {

    }

    public function updatePendaftaran($param)
    {
        // pd.foto=:ft
        $query = "UPDATE ".
            "ppdb_pendaftaran_data as pd, ".
            "ppdb_gelombang as g, ".
            "ppdb_pendaftaran_data_akademik as pda, ".
            "ppdb_pendaftaran_data_asal_sekolah as pdas, ".
            "ppdb_validasi as v ".
            "WHERE pd.id_gel = g.id_gel ".
            "AND pda.id_pendaftaran = pd.id_pendaftaran ".
            "AND pd.id_asal_skl = pdas.id_asal_skl ".
            "AND pd.id_validasi = v.id_validasi ".
            "SET pd.id_gel=:gid, ".
            "pd.id_jalur=:jid, ".
            "pd.id_asal_skl=:sid, ".
            "pd.nilai_tes=:nt, ".
            "pd.nisn=:nisn, ".
            "pd.nama=:nm, ".
            "pd.jk=:jk, ".
            "pd.tmp_lahir=:tpl, ".
            "pd.tgl_lahir=:tgl, ".
            "pd.alamat=:al, ".
            "pd.rt=:rt, ".
            "pd.rw=:rw, ".
            "pd.lokasi_kelurahan=:kel, ".
            "pd.lokasi_kecamatan=:kec, ".
            "pd.lokasi_kabupatenkota=:kab, ".
            "pd.lokasi_provinsi=:prov, ".
            "pd.no_telp=:telp, ".
            "pd.no_hp=:hp, ".
            "pd.nama_ayah=:nma, ".
            "pd.nama_ibu=:nmi, ".
            "pd.pekerjaan_ayah=:pa, ".
            "pd.pekerjaan_ibu=:pi ".
            "WHERE ppdb_pendaftaran_data.id_pendaftaran=:id ";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function delete($id)
    {
        $query = "DELETE FROM ppdb_pendaftaran_data WHERE id_pendaftaran = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }

    public function deletePrestasi($id, $namaPres, $idJuara, $idTigkat)
    {
        $query = "DELETE FROM ppdb_pendaftaran_data_prestasi_juara ".
            "WHERE id_pendaftaran = :id ".
            "AND nama_prestasi = :nmp ".
            "AND id_prestasi_juara = :pjid ".
            "AND id_prestasi_tingkat = :ptid";
        $param = array(
            'id' => $id,
            'nmp' => $namaPres,
            'pjid' => $idJuara,
            'ptid' => $idTigkat
        );
        return $this->db->query($query, $param);
    }
}
