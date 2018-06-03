<?php
namespace Controllers;

/**
*
*/
class Verifikasi extends \Core\
{

    public function __construct()
    {
        parent::__construct();

        // Controllers instances
        $this->user = new \Controllers\User();

        // Models instances
        $this->verifikasiModel = new \Models\VerifikasiModel();
        $this->tahunAjaranModel = new \Models\TahunAjaranModel();
    }

    public function baru()
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $thnAjar = $this->tahunAjaranModel->getActive();
            $thn = $thnAjar[0]['tahun_ajaran'];
            $thnId = $thnAjar[0]['id_tahun_ajaran'];

            $data = array(
                'valid' => false,
                'notif' => null,
                'thn' => $thn,
                // 'pilThn' => $this->tahunAjaranModel->get(),
                'pilThn' => $thnAjar,
                'pilJuara' => $this->prestasiModel->getPilJuara(),
                'pilTingkat' => $this->prestasiModel->getPilTingkat(),
                'page' => "pendaftaran/verifikasi",
                'title' => "Proses Verifikasi",
                'menu' => "admin/menu"
            );

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama = strtoupper(\Helpers\Request::post('nama'));
                $skl = strtoupper(\Helpers\Request::post('skl');
                $sklKab = strtoupper(\Helpers\Request::post('skl_kab'));
                $idSkl = $this->sekolahAsalModel->getSklId($skl, $sklKab);

                if (empty($idSkl)) {
                    $this->sekolahAsalModel->inputDataSekolah($skl, $sklKab);
                    $idSkl = $this->sekolahAsalModel->getSklId($skl, $sklKab);
                }

                $idTerverivikasi = "1";
                $nisn = \Helpers\Request::post('nisn');
                $idGel = \Helpers\Request::post('idGel');
                $gel = $this->gelombangModel->getbyId($idGel);

                if($gel[0]['test_date'] === "0000-00-00") {
                    $ntes = 1;
                } else {
                    $ntes = 0;
                }

                $dataDasar = array(
                    'nt' => $ntes,
                    'idSkl' => \Helpers\Request::post('idSkl'),
                    'idGel' => $idGel,
                    'idVal' => $idTerverivikasi,
                    'nisn' => $nisn,
                    'nama' => $nama
                );
                $dataDasarMasuk = $this->pendaftaranModel->verifikasi($dataDasar);
                $idPendaftaran = $this->pendaftaranModel->getIdbyNisn($nisn);

                if ($dataDasarMasuk) {
                    $nbi = \Helpers\Request::post('nilai_un_bi');
                    $nbing = \Helpers\Request::post('nilai_un_bing');
                    $nmat = \Helpers\Request::post('nilai_un_mat');
                    $nipa = \Helpers\Request::post('nilai_un_ipa');
                    $dataAka = array(
                        'idPndf' => $idPendaftaran,
                        'nbi' => $nbi,
                        'nbing' => $nbing,
                        'nmat' => $nmat,
                        'nipa' => $nipa
                    );
                    $dataAkaMasuk = $this->akademikModel->add($dataAka);

                    if ($dataAkaMasuk) {
                        $namaLb = strtoupper(\Helpers\Request::post('nama_lomba'));
                        $juara = \Helpers\Request::post('pres_juara');
                        $tgkt = \Helpers\Request::post('pres_tngkt');

                        if (!empty($namaLb) && !empty($juara) && !empty($tgkt)) {
                            $dataPres = array(
                                'idPendf' => $idPendaftaran,
                                'nml' => $namaLb,
                                'ju' => $juara,
                                'tg' => $tgkt
                            );
                            $dataPresMasuk = $this->prestasiModel->add($dataPres);
                        }

                        // Tidak perlu melakukan validasi prestasi
                        $data['notif'] = "Verifikasi Sukses";
                        $data['valid'] = true;
                    } else {
                        $data['notif'] = "Kesalahan Pada Input Data Akademik";
                    }
                } else {
                    $data['notif'] = "Kesalahan Pada Input Data Dasar";
                }
            }

            $this->view->load('common/template', $data);

        } else {
            $this->view->responseDefault('403');
        }
    }

    public function data()
    {

    }
}
