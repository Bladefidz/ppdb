<div class="row">
    <div class="col-md-8">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="1" style="text-align: center">
                        <img src="<?php echo HOME.'/assets/img/image004.png' ?>" alt="" style="width: 100px; height:100px">
                    </th>
                    <th colspan="2" style="font-size: 12pt; font-weight: bold; text-align: center">
                        <p>KEMENTERIAN AGAMA<br>
                        MADRASAH ALIYAH NEGERI 2 PONOROGO<br>
                        PANITIA PPDB TAHUN PELAJARAN <?php echo $cpd[0]['tahun_ajaran'].'/'.($cpd[0]['tahun_ajaran']+1) ?><br>
                        Jl. Soekarno-Hatta 381 Ponorogo</p>
                    </th>
                    <th colspan="1" style="text-align: center">
                        <img src="<?php echo HOME.'/assets/img/kop.png' ?>" alt="" style="width: 100px; height:100px">
                    </th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: center">Bukti Pendaftaran PPDB Gelombang <?php echo $cpd[0]['gelombang'] ?> MAN 2 Ponorogo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nomor Pendaftaran</td>
                    <td colspan="2"><b><?php echo $cpd[0]['kode'] ?></b></td>
                    <td colspan="1" rowspan="5">Foto 3x4</td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td colspan="2"><b><?php echo $cpd[0]['nama'] ?></b></td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td colspan="2"><b><?php echo $cpd[0]['nisn'] ?></b></td>
                </tr>
                <tr>
                    <td>Asal Sekolah</td>
                    <td colspan="2"><b><?php echo $cpd[0]['nama_skl'] ?></b></td>
                </tr>
                <tr>
                    <td>Pilihan</td>
                    <td colspan="2"><b><?php echo $cpd[0]['nama_jalur'] ?></b></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p><i>Peringatan:</i>
                        <br>
                        Bukti Pendaftaran harap anda simpan dengan baik karena akan dipakai sebagai persyaratan mengikuti <b>ujian masuk dan daftar ulang</b>.
                        </p>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>a/n <b><?php echo $cpd[0]['nama_ayah'] ?></b>
                        <br>
                        Menyetujui data diatas
                        <br>
                        Ortu/wali siswa terdaftar
                        </p>
                    </td>
                    <td colspan="2">
                        <p>
                        <br>
                        Menyetujui data diatas
                        <br>
                        Siswa terdaftar
                    </td>
                </tr>
                <tr style="height:80px">
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2">(...................................)</td>
                    <td colspan="2"><b><?php echo $cpd[0]['nama'] ?></b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
