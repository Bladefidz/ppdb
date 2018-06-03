<?php

namespace Controllers;

/**
 * Pendaftaran class.
 */
class Pendaftaran extends \Core\Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->tahunAjaranModel = new \Models\TahunAjaranModel();
        $this->gelombangModel = new \Models\GelombangModel();
        $this->jalurModel = $this->model->load("JalurModel");
        $this->pendaftaranModel = $this->model->load('PendaftaranModel');
        $this->prestasiModel = $this->model->load('PrestasiModel');
        $this->pendidikanModel = $this->model->load('PendidikanModel');
        $this->pekerjaanModel = $this->model->load('PekerjaanModel');
        $this->wilayahModel = $this->model->load('WilayahModel');
    }

    public function getRegAccess()
    {
        if (isset($_SESSION['no_pendft'])) {
            if ($this->gelombangModel->isOpen) {
                $this->inputData();
            } else {
                // gelombang pendaftaran ditutup
                $this->uri->redirect(HOME);
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    private function inputData()
    {
        if (isset($_SESSION['no_pendft'])) {
            $noPendft = $_SESSION['no_pendft'];
            $verifData = $this->pendaftaranModel->getbyId($noPendft);

            if(!empty($verifData)) {
                $thn = date('Y', strtotime($verifData[0]['recieve_date']));
                $yearId = $this->tahunAjaranModel->getThnAjarId($thn);

                $data = array(
                    'idp' => $noPendft,
                    'gel' => $verifData[0]['gelombang'],
                    'thnAjar' => $thn.'/'.($thn+1),
                    'nisn' => $verifData[0]['nisn'],
                    'nama' => $verifData[0]['nama'],
                    'skl' => $verifData[0]['nama_skl'],
                    'sklKab' => $verifData[0]['kabupaten_skl'],
                    'nbi' => $verifData[0]['nilai_un_bi'],
                    'nbing' => $verifData[0]['nilai_un_bing'],
                    'nmat' => $verifData[0]['nilai_un_mat'],
                    'nipa' => $verifData[0]['nilai_un_ipa'],
                    'pkjAy' => $this->pekerjaanModel->pilPkjAyah(),
                    'pkjIb' => $this->pekerjaanModel->pilPkjIbu(),
                    'pilJalur' => $this->jalurModel->getJalurbyYidGel($yearId, $verifData[0]['gelombang']),
                    'wilayah' => $this->wilayahModel->getWilayah(),
                    'valid' => false,
                    'notif' => null,
                    'page' => "ppdbonline/registration"
                );
                $this->view->load('common/dashboard', $data);

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    extract($_POST);

                    $idTerdaftar = "3";
                    $idGel = $this->gelombangModel->getGelStat()['id_gel'];
                    $newId = $jlr_pndftrn.$noPendft;

                    $pendaftaran = array(
                        'oldId' => $noPendft,
                        'newId' => $newId,
                        'ij' => $jlr_pndftrn,
                        'iv' => $idTerdaftar,
                        'jk' => $jk,
                        'tml' => $tmp_lahir,
                        'tgl' => date('Y-m-d', strtotime($thn_lahir.'-'.$bln_lahir.'-'.$tgl_lahir)),
                        'al' => $alamat,
                        'rt' => $rt,
                        'rw' => $rw,
                        'kl' => $kel,
                        'kc' => $kec,
                        'kb' => $kota,
                        'pv' => $prop,
                        'nt' => $no_telp,
                        'nh' => $no_hp,
                        'nma' => $nama_ay,
                        'nmi' => $nama_ib,
                        'pka' => $pkj_ay,
                        'pki' => $pkj_ib
                    );
                    $reg = $this->pendaftaranModel->register($pendaftaran);

                    if ($reg) {
                        $data['valid'] = true;
                        $data['notif'] = "Pendaftaran Sukses";
                        $_SESSION['id_to_print'] = $newId;
                        $this->uri->redirect(HOME.'/pendaftaran/cetak');
                    } else {
                        $data['notif'] = "Terjadi Kesalahan Pada Proses Pendaftaran";
                    }
                }
            } else {
                $this->responseDefault('404');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function getPilKota($prov)
    {
        $kota = $this->wilayahModel->getKota($prov);

        echo "<option selected value=''>Pilih Kota/Kab</option>";
        foreach ($kota as $kt) {
            echo "<option value='$kt[lokasi_kabupatenkota]'>$kt[lokasi_nama]</option>";
        }
    }

    public function getPilKec($prov, $kota)
    {
        $kec = $this->wilayahModel->getKec($prov, $kota);

        echo"<option selected value=''>Pilih Kecamatan</option>";
        foreach ($kec as $kc) {
            echo "<option value='$kc[lokasi_kecamatan]'>$kc[lokasi_nama]</option>";
        }
    }

    public function getPilKel($prov, $kota, $kec)
    {
        $kel = $this->wilayahModel->getKel($prov, $kota, $kec);

        echo"<option selected value=''>Pilih Kelurahan/Desa</option>";
        foreach ($kel as $kl) {
            echo "<option value='$kl[lokasi_kode]'>$kl[lokasi_nama]</option>";
        }
    }

    public function cetak()
    {
        if (isset($_SESSION['id_to_print'])) {
            $data['cpd'] = $this->pendaftaranModel->getbyId($_SESSION['id_to_print']);

            if ($data['cpd'][0]['id_validasi'] === 3) {
                $data['form'] = 'ppdbonline/bukti_pendaftaran';
            } else {
                $data['form'] = 'error/404';
            }

            $_SESSION['no_pendft'] = null;
            $_SESSION['nisn'] = null;
            $_SESSION['username'] = null;

            $this->view->load('common/cetak', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }
}
