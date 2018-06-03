<div class="row">
    <div class="col-lg-12">
        <div class="well well-sm">
            Proses Seleksi Calon Peserta Didik PPDB Tahun <?php echo $year ?> Gelombang <?php echo $gel ?>
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
