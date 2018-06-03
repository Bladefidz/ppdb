<div class="row">
    <div class="col-md-10">
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
                    <th colspan="4" style="text-align: center">Bukti Verifikasi PPDB Gelombang <?php echo $cpd[0]['gelombang'] ?> MAN 2 Ponorogo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama Lengkap</td>
                    <td colspan="3"><b><?php echo $cpd[0]['nama'] ?></b></td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td colspan="3"><b><?php echo $cpd[0]['nisn'] ?></b></td>
                </tr>
                <tr>
                    <td>Asal Sekolah</td>
                    <td colspan="3"><b><?php echo $cpd[0]['nama_skl'] ?></b></td>
                </tr>
                <tr>
                    <td colspan="4"><hr></td>
                </tr>
                </tr>
                    <td colspan="4"><i>Gunakan Kode Verifikasi Dibawah Ini Untuk Melakukan Proses Pendaftaran</i></td>
                </tr>
                <tr>
                    <td>Kode Verifikasi</td>
                    <td colspan="3"><b><?php echo $cpd[0]['kode'] ?></b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
