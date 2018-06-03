<div class="row">
    <div class="panel-heading">
<?php if ($numData > 0): ?>
        <h2>
            Proses Iput Nilai Tes Calon Peserta Didik PPDB Gelombang <?php echo $gel ?> Tahun Ajaran <?php echo $thn.'/'.($thn+1) ?>
        </h2>
    </div>
    <div class="col-lg-12">
        <b>Rasio Nilai Tes</b> merupakan hasil dari <i>nilai tes ybs dibagi nilai tes maksimal</i>
        <br>
        <b>Rasio Nilai Tes</b> merupakan nilai desimal antara 100.00 sampai 00000.00
    </div>
<?php else: ?>
    <h2>
        Input nilai tes tidak ditemukan dalam gelombang tahun ajaran ini.
    </h2>
<?php endif; ?>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class='dataTable_wrapper'>
                    <div class='table-toolbar' style='margin-bottom: 15px;'>
                        <div class='btn-group'>
                            <button class='btn btn-success btn-xs disabled'><?php echo $numData; ?> calon peserta didik terdaftar</button>
                        </div>
            <?php if ($numData > 0): ?>
                    </div>
                    <div claa="table-responsive">
                        <table cellspacing="0" width="100%" class='table col-sm-12 table-bordered table-striped table-condensed cf' id='dataTables-seleksi'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pendaftaran</th>
                                    <th>Nama</th>
                                    <th>Rasio Nilai Tes</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 0 ?>
                            <?php foreach($tesData as $row): ?>
                                <tr class=''>
                                    <td> <?php echo ++$no; ?></td>
                                    <td> <?php echo $row['kode']; ?> </td>
                                    <td> <?php echo $row['nama']; ?> </td>
                                    <td> <?php echo $row['nilai_tes']; ?> </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class='btn btn-primary btn-xs btn-responsive' href="<?php echo HOME.'/tes/update/'.$row['id_pendaftaran'] ?>" >
                                                <i class='fa fa-check'></i>
                                                perbarui
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <table class='table table-striped table-bordered table-hover' id='dataTables-seleksi'>
                    <tr>
                        <td>Data Tidak Ditemukan</td>
                    </tr>
                </table>
            <?php endif; ?>
            <br/>
            </div>
        </div>
    </div>
</div>
