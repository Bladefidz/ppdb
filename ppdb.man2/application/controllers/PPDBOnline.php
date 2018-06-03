<?php
namespace Controllers;

class PPDBOnline extends \Core\Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->pendaftaranModel = new \Models\PendaftaranModel();
        $this->tahunAjaranModel = new \Models\TahunAjaranModel();
        $this->gelombangModel = new \Models\GelombangModel();
        $this->jalurModel = new \Models\JalurModel();
        $this->pekerjaanModel = new \Models\PekerjaanModel();
        $this->wilayahModel = new \Models\WilayahModel();
        $this->ppdbOnlineModel = new \Models\PPDBOnlineModel();
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data['notif'] = '';
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            extract($_POST);

            $nama = strtoupper($this->formHelper->Post($nama));
            $kode = $this->formHelper->Post($kode);
            $nisn = $this->formHelper->Post($nisn);

            // Samakan panjang nisn
            $nisnLen = 10;
            $nisn = str_pad((string)$nisn, $nisnLen, "0", STR_PAD_LEFT);

            $hasilCari = $this->ppdbOnlineModel->cari($nisn);
            // tinggal looping buat cari nomor pendaftaran
            if (count($hasilCari > 0) && $hasilCari[0]['id_validasi'] == 1 && $hasilCari[0]['kode'] == $kode) {
                $_SESSION['no_pendft'] = $hasilCari[0]['kode'];
                $_SESSION['id'] = $hasilCari[0]['id_pendaftaran'];
                $_SESSION['nisn'] = $nisn;
                $_SESSION['username'] = $nama;
                $_SESSION['gelombang'] = $hasilCari[0]['gelombang'];
                $_SESSION['thn_ajar'] = $hasilCari[0]['tahun_ajaran'];

                if ($this->gelombangModel->isOpen) {
                    $this->uri->redirect(HOME."/ppdbonline/daftar");
                } else {
                    $data['notif'] = 'Gelombang Pendaftaran Sudah Ditutup!';
                }

            } else {
                $data['notif'] = 'Akses Ditolak';
            }
        } else {
            $this->view->responseDefault('403');
        }

        $this->view->load("ppdbonline/login", $data);
    }

    private function createNoPendaftaran($thnId)
    {
        $lastNo = $this->ppdbOnlineModel->getLastNoPendaftaran($thnId);
        $no = $lastNo+1;
        return $no;
    }

    public function daftar()
    {
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $verifData = $this->ppdbOnlineModel->getVerifikasibyId($id);
            $gelId = $verifData[0]['id_gel'];

            if(!empty($verifData)) {
                $thnAjar = $this->tahunAjaranModel->getActive();
                $thn = $thnAjar[0]['tahun_ajaran'];
                $thnId = $thnAjar[0]['id_tahun_ajaran'];

                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $data = array(
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
                        'pilJalur' => $this->jalurModel->getJalurbyYidG($thnId, $verifData[0]['gelombang']),
                        'wilayah' => $this->wilayahModel->getWilayah(),
                        'valid' => false,
                        'notif' => null,
                        'title' => "Proses Pendaftaran",
                        'menu' => "common/menu",
                        'page' => "ppdbonline/daftar"
                    );
                    $this->view->load('common/template', $data);
                } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                    extract($_POST);

                    $idTerdaftar = "3";

                    /**
                     * fotonya belum ('foto' => $foto)
                     * is adalah id_seleksi dengan nilai constans (1)
                     **/
                    $pendaftaran = array(
                        'id' => $id,
                        'iv' => $idTerdaftar,
                        'ij' => $jlr_pndftrn,
                        'is' => 1,
                        'no' => $this->createNoPendaftaran($thnId),
                        'jk' => $jk,
                        'tml' => ucwords($tmp_lahir),
                        'tgl' => date('Y-m-d', strtotime($thn_lahir.'-'.$bln_lahir.'-'.$tgl_lahir)),
                        'al' => strtoupper($alamat),
                        'rt' => $rt,
                        'rw' => $rw,
                        'kl' => $kel,
                        'kc' => $kec,
                        'kb' => $kota,
                        'pv' => $prop,
                        'nt' => $no_telp,
                        'nh' => $no_hp,
                        'nma' => strtoupper($nama_ay),
                        'nmi' => strtoupper($nama_ib),
                        'pka' => $pkj_ay,
                        'pki' => $pkj_ib
                    );
                    $reg = $this->ppdbOnlineModel->pendaftaran($pendaftaran);

                    if ($reg) {
                        $data['valid'] = true;
                        $data['notif'] = "Pendaftaran Sukses";
                        $_SESSION['id_to_print'] = $id;
                    } else {
                        $data['notif'] = "Terjadi Kesalahan Pada Proses Pendaftaran";
                    }

                    $data['page'] = '';
                    $data['page'] = '<h1>Selamat anda telah terdaftar sebagai calon peserta didik baru MAN 2 Ponrogo. Silahkan cetak dan simpan bukti pendaftaran anda.</h1>';
                    $this->view->load('common/template', $data);
                    $this->uri->redirect(HOME.'/ppdbonline/cetak');
                }
            } else {
                $this->view->responseDefault('404');
            }
        } else {
            $this->uri->redirect(HOME);
        }
    }

    public function kota($prov)
    {
        $kota = $this->wilayahModel->getKota($prov);

        echo "<option selected value=''>Pilih Kota/Kab</option>";
        foreach ($kota as $kt) {
            echo "<option value='$kt[lokasi_kabupatenkota]'>$kt[lokasi_nama]</option>";
        }
    }

    public function kecamatan($prov, $kota)
    {
        $kec = $this->wilayahModel->getKec($prov, $kota);

        echo"<option selected value='00'>Pilih Kecamatan</option>";
        foreach ($kec as $kc) {
            echo "<option value='$kc[lokasi_kecamatan]'>$kc[lokasi_nama]</option>";
        }
    }

    public function kelurahan($prov, $kota, $kec)
    {
        $kel = $this->wilayahModel->getKel($prov, $kota, $kec);

        echo"<option selected value='0000'>Pilih Kelurahan/Desa</option>";
        foreach ($kel as $kl) {
            echo "<option value='$kl[lokasi_kelurahan]'>$kl[lokasi_nama]</option>";
        }
    }

    public function cetak()
    {
        if (isset($_SESSION['id_to_print'])) {
            $data['cpd'] = $this->ppdbOnlineModel->detail($_SESSION['id_to_print']);

            if ($data['cpd'][0]['id_validasi'] === 3) {
                $data['form'] = 'ppdbonline/bukti_pendaftaran';
            } else {
                $data['form'] = 'error/404';
            }

            $_SESSION['id'] = null;
            $_SESSION['no_pendft'] = null;
            $_SESSION['nisn'] = null;
            $_SESSION['username'] = null;

            $this->view->load('common/cetak', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function pantau()
    {
        if (isset($_SESSION['no_pendft'])) {
            $cpd = $this->pendaftaranModel->getbyYidGid($_SESSION['id_thn_ajar'], $_SESSION['id_gel']);

            $data = array(
                'yearId' => $_SESSION['id_thn_ajar'],
                'year' => $_SESSION['thn_ajar'],
                'gel' => $cpd[0]['gelombang'],
                'dataCpd' => $cpd,
                'numDataCpd' => count($cpd),
                'title' => "PPDB Online",
                'menu' => "common/menu",
                'page' => "ppdbonline/pantau"
            );
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function pengumuman()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data['title'] = "pengumuman";
            $data['menu'] = "common/menu";
            $data['page'] = "ppdbonline/pengumuman";
            $this->view->load('common/template', $data);
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $kode = \Helpers\Input::Post($_POST['nopend']);
            $nisn = \Helpers\Input::Post($_POST['nisn']);

            // Samakan panjang nisn
            $nisnLen = 10;
            $nisn = str_pad((string)$nisn, $nisnLen, "0", STR_PAD_LEFT);

            $hasilCari = $this->ppdbOnlineModel->cari($nisn);
            // tinggal looping buat cari nomor pendaftaran
            if (count($hasilCari > 0) && $hasilCari[0]['id_validasi'] == 3 && $hasilCari[0]['kode'] == $kode) {
                $data['page'] = "";
                $data['title'] = "pengumuman";
                $data['menu'] = "common/menu";
                $data['thn'] = $hasilCari[0]['tahun_ajaran'];
                $data['gel'] = $hasilCari[0]['gelombang'];
                $data['kode'] = $hasilCari[0]['kode'];
                $data['nama'] = $hasilCari[0]['nama'];
                if (!empty($hasilCari[0]['status_terima'])) {
                    $jalurTerima = $this->jalurModel->getbyId($hasilCari[0]['status_terima'])[0]['nama_jalur'];
                    $data['hasil'] = "Selamat and diterima sebagai calon peserta didik di jalur $jalurTerima";
                } else {
                    $data['hasil'] = "Maaf, anda belum berhasil lolos seleksi. Jangan menyerah untuk tetap semangat belajar!";
                }
                $data['page'] = "ppdbonline/pengumuman_hasil";
                $this->view->load('common/template', $data);
            } else {
                $this->uri->redirect(HOME.'/pengumuman');
            }
        } else {
            $this->view->responseDefault('404');
        }
    }

    public function logout()
    {
        $this->sessionHandler->stop();
        if (!$this->sessionHandler->isStarted) {
            $this->uri->redirect(HOME);
        }
    }
}
