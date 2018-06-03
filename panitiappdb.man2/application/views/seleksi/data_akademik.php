<div class="row">
    <div class="panel-heading">
        <h2>
            Data Calon Peserta Didik PPDB Tahun <?php echo $year ?> <span class="label label-info" style="font-size: 14px">Terdaftar</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class='table-responsive'>
                <?php if ($numDataCpd != 0): ?>
                    <div class='table-toolbar' style='margin-bottom: 15px;'>
                        <div class='btn-group'>
                            <button class='btn btn-success btn-xs disabled'><?php echo $numDataCpd; ?> calon peserta didik</button>
                        </div>
                        <div class='btn-group'>
                            <a href=<?php echo HOME.'/pendaftaran/verifikasi' ?>><button class='btn btn-primary btn-xs'>Data Baru <i class='glyphicon glyphicon-plus icon-white'></i></button></a>
                        </div>
                        <div class='btn-group pull-right'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle btn-xs'>Simpan <span class='caret'></span></button>
                            <ul class='dropdown-menu'>
                                <li><a href='#'>PDF</a></li>
                                <li><a href='#'>Excel</a></li>
                            </ul>
                        </div>
                    </div>
                    <table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='dataTables-pendaftaran'>
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>No Pendaftaran</th>
                                <th>Nama Lengkap</th>
                                <th>Gelombang</th>
                                <th>Nilai UAN BI</th>
                                <th>Nilai UAN BING</th>
                                <th>Nilai UAN MAT</th>
                                <th>Nilai UAN IPA</th>
                                <th>Nilai Tes</th>
                                <th>Skor Akademik</th>
                                <th>Keputusan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1 ?>
                        <?php foreach($dataCpd as $row): ?>
                            <tr class=''>
                                <td> <?php echo $no++ ?> </td>
                                <td> <?php echo $row['id_pendaftaran']; ?> </td>
                                <td> <?php echo $row['nama']; ?> </td>
                                <td> <?php echo $row['gelombang']; ?> </td>
                                <td> <?php echo $row['nilai_un_bi'] ?> </td>
                                <td> <?php echo $row['nilai_un_bing'] ?> </td>
                                <td> <?php echo $row['nilai_un_mat'] ?> </td>
                                <td> <?php echo $row['nilai_un_ipa'] ?> </td>
                                <td> <?php echo $row['nilai_tes']; ?> </td>
                                <td> <?php echo $row['skor_akademik']; ?></td>
                                <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                                    <a class='btn btn-primary btn-xs btn-block' href="<?php echo HOME.'/seleksi/data/update/'.$row['id_pendaftaran']; ?>" >
                                        <i class='glyphicon glyphicon-edit icon-white'></i>
                                        Terima
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>Tidak ada data</p>
            <?php endif; ?>
            <br/>
            </div>
        </div>
    </div>
</div>
