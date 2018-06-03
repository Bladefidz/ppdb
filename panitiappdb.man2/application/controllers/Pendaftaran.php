<?php
namespace Controllers;

use Models;
use Helpers;
use Helpers\Request;

/**
 * Pendaftaran class.
 */
class Pendaftaran extends \Core\Controller
{
    /**
     * Class Constructor
     *
     * Construct parent class and create instance of models or another controllers.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // Instance of controllers
        $this->user = new User();

        // Instance of models
        $this->pendaftaranModel = new Models\PendaftaranModel();
        $this->seleksiModel = new Models\SeleksiModel();
        $this->tahunAjaranModel = new Models\TahunAjaranModel();
        $this->sekolahAsalModel = new Models\SekolahAsalModel();
        $this->akademikModel = new Models\AkademikModel();
        $this->prestasiModel = new Models\PrestasiModel();
        $this->pekerjaanModel = new Models\PekerjaanModel();
        $this->gelombangModel = new Models\GelombangModel();
        $this->jalurModel = new Models\JalurModel();
        $this->wilayahModel = new Models\WilayahModel();
        $this->userModel = new Models\UserModel();
    }

    /**
     * Index method
     *
     * The main method of this controller.
     *
     * @return void
     */
    public function index()
    {
        if($this->user->isAdmin() || $this->user->isPegawai()) {
            $this->showPanel();
        } else {
            $this->view->responseDefault('403');
        }
    }

    /**
     * Show Panel method
     *
     * Show Pendaftaran Panel
     * @return void
     */
    private function showPanel()
    {
        // Get current status of student selection by comparing the selection milestone by current date.
        $gelStat = $this->gelombangModel->getGelStat();

        $data = array(
            'year' => date('Y'),
            'gelId' => $gelStat['id_gel'],
            'page' => "pendaftaran/panel_pendaftaran",
            'title' => "Pendaftaran",
            'menu' => "admin/menu"
        );

        $this->view->load('common/template', $data);
    }

    /**
     * Verification method
     *
     * Show verification page and do verification process
     * @return void
     */
    public function verifikasi()
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            // Get active registration year and get the year string and id.
            $thnAjar = $this->tahunAjaranModel->getActive();
            $thn = $thnAjar[0]['tahun_ajaran'];
            $thnId = $thnAjar[0]['id_tahun_ajaran'];

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data = array(
                    'valid' => false,
                    'notif' => null,
                    'thn' => $thn,
                    'pilThn' => $thnAjar,
                    'pilJuara' => $this->prestasiModel->getPilJuara(),
                    'pilTingkat' => $this->prestasiModel->getPilTingkat(),
                    'page' => "pendaftaran/verifikasi",
                    'title' => "Proses Verifikasi",
                    'menu' => "admin/menu"
                );
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama = strtoupper(Request::post('nama'));
                $skl = strtoupper(Request::post('skl'));
                $sklKab = ucwords(Request::post('skl_kab'));
                $sklKab = 'Kab. '.$sklKab; // Dilengkapi dengan awalan Kab.

                $idTerverivikasi = "1";
                $nisn = Request::post('nisn');
                $idGel = Request::post('id_gel');
                $gel = $this->gelombangModel->getbyId($idGel);

                // Assummed no test required, if test date not setted on any
                // registration date. Than any condidate registated there
                // have max scor test.
                if ($gel[0]['test_date'] === "0000-00-00") {
                    $ntes = 1;
                } else {
                    $ntes = 0;
                }

                // Checking the nisn conflict. If any candidate have been
                // registered, he/she not allowed to do registration twice at
                // same registration wave.
                $checkNisnParam = array(
                    'nisn' => (int) $nisn,
                    'gel' => $gel[0]['gelombang'],
                    'thn' => $thn
                );
                $ceknisn = $this->pendaftaranModel->wasVerified($checkNisnParam);

                if (empty($ceknisn)) {
                    $idSkl = $this->sekolahAsalModel->getSklId($skl, $sklKab);

                    if (empty($idSkl)) {
                        $this->sekolahAsalModel->inputDataSekolah($skl, $sklKab);
                        $idSkl = $this->sekolahAsalModel->getSklId($skl, $sklKab);
                    }

                    // Insert basic data of candidate.
                    $dataDasar = array(
                        'nt' => $ntes,
                        'idSkl' => $idSkl,
                        'idGel' => $idGel,
                        'idVal' => $idTerverivikasi,
                        'nisn' => $nisn,
                        'nama' => $nama
                    );
                    $dataDasarMasuk = $this->pendaftaranModel->verifikasi($dataDasar);
                    $idPendaftaran = $this->pendaftaranModel->getLastId();

                    if ($dataDasarMasuk) {
                        $nbi = Request::post('nilai_un_bi');
                        $nbing = Request::post('nilai_un_bing');
                        $nmat = Request::post('nilai_un_mat');
                        $nipa = Request::post('nilai_un_ipa');

                        // Insert candidate academic scor
                        $dataAka = array(
                            'idPndf' => $idPendaftaran,
                            'nbi' => $nbi,
                            'nbing' => $nbing,
                            'nmat' => $nmat,
                            'nipa' => $nipa
                        );
                        $dataAkaMasuk = $this->akademikModel->add($dataAka);

                        if ($dataAkaMasuk) {
                            // Count sum of input field's index in form.
                            $count = Request::post('count');

                            // Loop the input until reach max input and insert
                            // it one by one.
                            for($i=0; $i<=$count; $i++) {
                                $nmlb = strtoupper(Request::post('nama_lomba'.$i));
                                $pj = Request::post('pres_juara'.$i);
                                $pt = Request::post('pres_tngkt'.$i);

                                if (!empty($nmlb) && !empty($pj) && !empty($pt) && ($count > 0)) {
                                    $dataPres = array(
                                        'idPendf' => $idPendaftaran,
                                        'nml' => $nmlb,
                                        'ju' => $pj,
                                        'tg' => $pt
                                    );
                                } else {
                                    $dataPres = array(
                                        'idPendf' => $idPendaftaran,
                                        'nml' => null,
                                        'ju' => 4,
                                        'tg' => 6
                                    );
                                }

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
                } else {
                    $data['notif'] = "Calon Siswa Dengan NISN ".$nisn.
                        " Telah Terverifikasi Pada Gelombang ".$gel[0]['gelombang'].
                        " Tahun Ajaran ".$thn;
                }
            }

            $this->view->load('common/template', $data);

        } else {
            $this->view->responseDefault('403');
        }
    }

    /**
     * Prestasi method
     *
     * @used-by by ppdb.js
     * @param   String      $count      count the all field's index
     * @return void
     */
    public function prestasi($count)
    {
        $pilJuara = $this->prestasiModel->getPilJuara();
        $pilTingkat = $this->prestasiModel->getPilTingkat();
        $newJuaraName = "pres_juara".$count;

        echo "
        <div id='pres$count'>
            <div class='col-lg-12'>
                <div class='form-group'>
                    <input type='hidden' >
                    <label class='col-lg-2 control-label'>Nama Lomba</label>
                    <div class='col-lg-10'>
                        <input class='form-control' name='nama_lomba$count' type='text'>
                    </div>
                </div>
            </div>
            <div class='col-lg-12'>
                <div class='form-group'>
                    <label class='col-lg-2 control-label'>Juara</label>
                    <div class='col-lg-1'>
                        <select class='form-control' name='pres_juara$count'>
                            <option value='0' selected='selected'></option>";
                            foreach ($pilJuara as $pj):
                                echo "<option value='".$pj['id_prestasi_juara']."'>".$pj['no_juara']."</option>";
                            endforeach;
                        echo "</select>
                    </div>
                    <label class='col-lg-2 control-label'>Tingkat</label>
                    <div class='col-lg-3'>
                        <select class='form-control' name='pres_tngkt$count'>
                           <option value='0' selected='selected'></option>";
                            foreach ($pilTingkat as $pt):
                                echo "<option value='".$pt['id_prestasi_tingkat']."'>".$pt['nama_tingkat']."</option>";
                            endforeach;
                        echo "</select>
                    </div>
                </div>
            </div>
        </div>
        <div id='prestasi$count'>
        </div>";
    }

    /**
     * Get last registration number
     *
     * @param String|Integer    $thnId      Get id of registration year
     * @return Integer
     */
    private function createNoPendaftaran($thnId)
    {
        $lastNo = $this->pendaftaranModel->getLastNoPendaftaran($thnId);
        $no = $lastNo+1;
        return $no;
    }

    /**
     * Regitration
     *
     * Display registration form and process registration data of verified candidates.
     * @uses Pendaftaran::createNoPendaftaran($thnId)
     * @param registration id
     * @return void
     */
    public function daftar()
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $id = \Helpers\Request::post('cpd_id');

            // Get data of verified candidate and generate registration wave id.
            $verifData = $this->pendaftaranModel->getVerifikasibyId($id);
            $gelId = $verifData[0]['id_gel'];

            if(!empty($verifData)) {
                $thnAjar = $this->tahunAjaranModel->getActive();
                $thn = $thnAjar[0]['tahun_ajaran'];
                $thnId = $thnAjar[0]['id_tahun_ajaran'];

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
                    'menu' => "admin/menu",
                    'page' => "pendaftaran/daftar"
                );
                $this->view->load('common/template', $data);

                if (isset($_POST['id'])) {
                    $idTerdaftar = "3";

                    /**
                     * fotonya belum ('foto' => $foto)
                     * is adalah id_seleksi dengan nilai constans (1)
                     **/
                    $pendaftaran = array(
                        'id' => Request::post('id'),
                        'iv' => Request::post('idTerdaftar'),
                        'ij' => Request::post('jlr_pndftrn'),
                        'is' => 1,
                        'no' => $this->createNoPendaftaran(Request::post('thnId')),
                        'jk' => Request::post('jk'),
                        'tml' => ucwords(Request::post('tmp_lahir')),
                        'tgl' => date('Y-m-d', strtotime(Request::post('thn_lahir').'-'.Request::post('bln_lahir').'-'.Request::post('tgl_lahir'))),
                        'al' => strtoupper(Request::post('alamat')),
                        'rt' => Request::post('rt'),
                        'rw' => Request::post('rw'),
                        'kl' => Request::post('kel'),
                        'kc' => Request::post('kec'),
                        'kb' => Request::post('kota'),
                        'pv' => Request::post('prop'),
                        'nt' => Request::post('no_telp'),
                        'nh' => Request::post('no_hp'),
                        'nma' => strtoupper(Request::post('nama_ay')),
                        'nmi' => strtoupper(Request::post('nama_ib')),
                        'pka' => Request::post('pkj_ay'),
                        'pki' => Request::post('pkj_ib')
                    );
                    $reg = $this->pendaftaranModel->pendaftaran($pendaftaran);

                    if ($reg) {
                        $data['valid'] = true;
                        $data['notif'] = "Pendaftaran Sukses";
                    } else {
                        $data['notif'] = "Terjadi Kesalahan Pada Proses Pendaftaran";
                    }

                    $this->uri->redirect(HOME.'/pendaftaran/data/'.$gelId);
                }
            } else {
                $this->view->responseDefault('404');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    /**
     * Show data
     *
     * @param String|Integer    $valId      Validation id
     * @return void
     */
    public function data($subject)
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $thnAktif = $this->tahunAjaranModel->getActive();
            $year = $thnAktif[0]['tahun_ajaran'];
            $yearId = $thnAktif[0]['id_tahun_ajaran'];

            $data = array(
                'yearId' => $yearId,
                'year' => $year,
                'menu' => "admin/menu",
            );

            if ($subject === "terverifikasi") {
                $cpd = $this->pendaftaranModel->tinjauan($year, 1);

                $data['cpd'] = $cpd;
                $data['numDataCpd'] = count($cpd);
                $data['page'] = "pendaftaran/data_terverifikasi";
                $this->view->load('common/template', $data);
            } elseif ($subject === "terdaftar") {
                $cpd = $this->pendaftaranModel->tinjauan($year, 3);

                $data['cpd'] = $cpd;
                $data['numDataCpd'] = count($cpd);
                $data['page'] = "pendaftaran/data_terdaftar";
                $this->view->load('common/template', $data);
            } else {
                $this->uri->redirect(HOME.'/pendaftaran');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    /**
     * Edit method
     *
     * Get: Show and selectionn edit page.
     * Post: Handling the edit process.
     * @param   String|Integer      $id     Registration id
     * @param   String|Integer      $valId  Validation id
     * @return void
     */
    public function edit()
    {
        if ($this->user->isAdmin()) {
            if (Request::has('cpd_id') && Request::has('val_id')) {
                $id = Request::post('cpd_id');
                $valId = Request::post('val_id');

                $thnAjar = $this->tahunAjaranModel->get();
                $data['pilThn'] = $thnAjar;
                $data['pilJuara'] = $this->prestasiModel->getPilJuara();
                $data['pilTingkat'] = $this->prestasiModel->getPilTingkat();

                if ($valId == "1") {
                    $cpd = $this->pendaftaranModel->getVerifikasibyId($id);
                    $data['cpd'] = $cpd;
                    $data['prestasi'] = $this->pendaftaranModel->getPrestasi($cpd[0]['id_pendaftaran']);
                    $data['page'] = "pendaftaran/verifikasi_edit";
                } elseif ($valId == "3") {
                    $data['page'] = "pendaftaran/daftar_edit";
                } else {
                    $this->view->responseDefault('404');
                }

                $data['menu'] = "admin/menu";
                $this->view->load('common/template', $data);
            } elseif(Request::has('name') && Request::has('skl')) {
                // Get id
                $id = $cpd[0]['id_pendaftaran'];

                // Request post
                $nama = strtoupper(Request::post('nama'));
                $skl = strtoupper(Request::post('skl'));
                $sklKab = ucwords(Request::post('skl_kab'));
                $nisn = Request::post('nisn');
                $idGel = Request::post('id_gel');
                $nbi = Request::post('nilai_un_bi');
                $nbing = Request::post('nilai_un_bing');
                $nmat = Request::post('nilai_un_mat');
                $nipa = Request::post('nilai_un_ipa');

                $idSkl = $this->sekolahAsalModel->getSklId($skl, $sklKab);

                if (empty($idSkl)) {
                    $this->sekolahAsalModel->inputDataSekolah($skl, $sklKab);
                    $idSkl = $this->sekolahAsalModel->getSklId($skl, $sklKab);
                }

                $dataDasarMasuk = $this->pendaftaranModel->updateVerifikasi($data);

                if ($dataDasarMasuk) {
                    $count = Request::post('count');

                    for($i=0; $i<=$count; $i++) {
                        $nmlb = strtoupper(Request::post('nama_lomba'.$i));
                        $pj = Request::post('pres_juara'.$i);
                        $pt = Request::post('pres_tngkt'.$i);

                        if (!empty($nmlb) && !empty($pj) && !empty($pt) && ($count > 0)) {
                            $dataPres = array(
                                'idPendf' => $idPendaftaran,
                                'nml' => $nmlb,
                                'ju' => $pj,
                                'tg' => $pt
                            );
                        } else {
                            $dataPres = array(
                                'idPendf' => $idPendaftaran,
                                'nml' => null,
                                'ju' => 4,
                                'tg' => 6
                            );
                        }

                        $dataPresMasuk = $this->prestasiModel->add($dataPres);
                    }
                }

                $this->uri->redirect(HOME."/pendaftaran/data/".$valId);
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    /**
     * Delete method
     *
     * Handling the delete action
     * @param String|Integer    $id         Registration id
     * @param String|Integer    $valId      Validation id
     * @return void
     */
    public function delete($id, $valId)
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $this->pendaftaranModel->delete($id);
            $this->uri->redirect(HOME."/pendaftaran/data/".$valId);
        } else {
            $this->view->responseDefault('403');
        }
    }

    /**
     * Cetak method
     *
     * Print output or document generated from database.
     * @param String|Integer    $valId      Validation id
     * @param String|Integer    $id         Registration id
     * @return void
     */
    public function cetak($valId ,$id)
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            if ($valId === "1") {
                $cpd = $this->pendaftaranModel->detail($id);
                $data['cpd'] = $cpd;
                $data['title'] = "PPDB - MAN2 Ponorogo - Cetak Bukti Verifikasi Calon Peserta Didik";
                $data['form'] = 'pendaftaran/bukti_verifikasi';
            } elseif ($valId === "3") {
                $cpd = $this->pendaftaranModel->detail($id);
                $data['cpd'] = $cpd;
                $data['title'] = "PPDB - MAN2 Ponorogo - Cetak Bukti Pendaftaran Calon Peserta Didik";
                $data['form'] = 'pendaftaran/bukti_pendaftaran';
            } else {
                $data['form'] = 'error/404';
            }
            $this->view->load('common/cetak', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    /**
     * Gelombang method
     *
     * Get registration wave by ajax get request.
     * @used-by ppdb.js
     * @param String|Integer    $year       Regsitration year
     * @return void
     */
    public function gelombang($year)
    {
        $gels = $this->gelombangModel->getGelsYear($year);

        foreach ($gels as $gel) {
            echo "<option value='$gel[id_gel]' selected>$gel[gelombang]</option>";
        }
    }

    /**
     * Kota method
     *
     * Get city name and id by ajax get request.
     * @used-by ppdb.js
     * @param String|Integer    $prov       Province id
     * @return void
     */
    public function kota($prov)
    {
        $kota = $this->wilayahModel->getKota($prov);

        echo "<option selected value=''>Pilih Kota/Kab</option>";
        foreach ($kota as $kt) {
            echo "<option value='$kt[lokasi_kabupatenkota]'>$kt[lokasi_nama]</option>";
        }
    }

    /**
     * Kecamatan method
     *
     * Get distric name and id by ajax get request.
     * @used-by ppdb.js
     * @param String|Integer    $prov       Province id
     * @param String|Integer    $kota       City id
     * @return void
     */
    public function kecamatan($prov, $kota)
    {
        $kec = $this->wilayahModel->getKec($prov, $kota);

        echo"<option selected value='00'>Pilih Kecamatan</option>";
        foreach ($kec as $kc) {
            echo "<option value='$kc[lokasi_kecamatan]'>$kc[lokasi_nama]</option>";
        }
    }

    /**
     * Kelurahan method
     *
     * Get village name and id by ajax get request.
     * @used-by ppdb.js
     * @param String|Integer    $prov       Province id
     * @param String|Integer    $kota       City id
     * @param String|Integer    $kec        Distric id
     * @return void
     */
    public function kelurahan($prov, $kota, $kec)
    {
        $kel = $this->wilayahModel->getKel($prov, $kota, $kec);

        echo"<option selected value='0000'>Pilih Kelurahan/Desa</option>";
        foreach ($kel as $kl) {
            echo "<option value='$kl[lokasi_kelurahan]'>$kl[lokasi_nama]</option>";
        }
    }
}
